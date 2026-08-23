<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventoRequest;
use App\Models\Estado;
use App\Models\Evento;
use App\Models\TipoEvento;
use App\Models\Ubicacion;
use App\Models\Ups;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class EventoController extends Controller
{
    /**
     * Muestra el listado y los filtros de eventos.
     */
    public function index(Request $request): View
    {
        $texto = trim($request->input('q', ''));

        $upsId = $request->input('ups');

        $tipoEventoId = $request->input('tipo_evento');

        $usuarioId = $request->input('usuario');

        $fechaDesde = $request->input('fecha_desde');

        $fechaHasta = $request->input('fecha_hasta');

        $eventos = Evento::with([
            'ups.modelo.marca',
            'tipoEvento',
            'usuario',
            'estadoResultante',
            'ubicacionResultante',
        ])

        ->when($texto, function ($query) use ($texto) {

            $query->where(function ($q) use ($texto) {

                $q->where('comentario', 'like', "%{$texto}%")

                    ->orWhereHas('ups', function ($ups) use ($texto) {

                        $ups->where(
                            'numero_identificador',
                            'like',
                            "%{$texto}%"
                        )

                        ->orWhere(
                            'numero_serie',
                            'like',
                            "%{$texto}%"
                        );
                    })

                    ->orWhereHas('tipoEvento', function ($tipo) use ($texto) {

                        $tipo->where(
                            'nombre',
                            'like',
                            "%{$texto}%"
                        );
                    })

                    ->orWhereHas('usuario', function ($usuario) use ($texto) {

                        $usuario->where(
                            'name',
                            'like',
                            "%{$texto}%"
                        );
                    });
            });
        })

        ->when($upsId, function ($query) use ($upsId) {

            $query->where('ups_id', $upsId);
        })

        ->when($tipoEventoId, function ($query) use ($tipoEventoId) {

            $query->where('tipo_evento_id', $tipoEventoId);
        })

        ->when($usuarioId, function ($query) use ($usuarioId) {

            $query->where('usuario_id', $usuarioId);
        })

        ->when($fechaDesde, function ($query) use ($fechaDesde) {

            $query->whereDate('fecha_hora', '>=', $fechaDesde);
        })

        ->when($fechaHasta, function ($query) use ($fechaHasta) {

            $query->whereDate('fecha_hora', '<=', $fechaHasta);
        })

        ->orderByDesc('fecha_hora')

        ->paginate(15)

        ->withQueryString();

        return view('eventos.index', [

            'eventos' => $eventos,

            'ups' => Ups::orderBy('numero_identificador')->get(),

            'tiposEvento' => TipoEvento::orderBy('categoria')
                ->orderBy('nombre')
                ->get(),

            'usuarios' => User::where('activo', true)
                ->orderBy('name')
                ->get(),

            'texto' => $texto,

            'upsSeleccionada' => $upsId,

            'tipoEventoSeleccionado' => $tipoEventoId,

            'usuarioSeleccionado' => $usuarioId,

            'fechaDesde' => $fechaDesde,

            'fechaHasta' => $fechaHasta,
        ]);
    }

    /**
     * Muestra el formulario para registrar un evento.
     */
    public function create(Request $request): View
    {
        return view('eventos.create', [

            'ups' => Ups::with([
                'modelo.marca',
                'estadoActual',
                'ubicacionActual',
            ])

            ->orderBy('numero_identificador')

            ->get(),

            'tiposEvento' => TipoEvento::orderBy('categoria')
                ->orderBy('nombre')
                ->get(),

            'estados' => Estado::orderBy('categoria')
                ->orderBy('nombre')
                ->get(),

            'ubicaciones' => Ubicacion::orderBy('nombre')
                ->get(),

            'upsSeleccionada' => $request->integer('ups') ?: null,
        ]);
    }

    /**
     * Guarda el evento y actualiza la situación actual de la UPS.
     */
    public function store(
        StoreEventoRequest $request
    ): RedirectResponse {

        $datos = $request->validated();

        $usuarioId = $request->user()->id;

        $evento = DB::transaction(function () use (
            $datos,
            $usuarioId
        ) {

            $ups = Ups::query()
                ->lockForUpdate()
                ->findOrFail($datos['ups_id']);

            $evento = Evento::create([

                ...$datos,

                'usuario_id' => $usuarioId,
            ]);

            $ups->update([

                'estado_actual_id' =>
                    $datos['estado_resultante_id'],

                'ubicacion_actual_id' =>
                    $datos['ubicacion_resultante_id'],
            ]);

            return $evento;
        });

        return redirect()

            ->route('eventos.show', $evento)

            ->with(
                'success',
                'Evento registrado correctamente.'
            );
    }

    /**
     * Muestra el detalle de un evento.
     */
    public function show(Evento $evento): View
    {
        $evento->load([

            'ups.modelo.marca',

            'ups.propietario',

            'tipoEvento',

            'usuario.role',

            'estadoResultante',

            'ubicacionResultante',
        ]);

        return view(
            'eventos.show',
            compact('evento')
        );
    }
}