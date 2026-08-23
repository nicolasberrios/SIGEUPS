<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpsRequest;
use App\Http\Requests\UpdateUpsRequest;
use App\Models\Estado;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Propietario;
use App\Models\Ubicacion;
use App\Models\Ups;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UpsController extends Controller
{
    /**
     * Listado y búsqueda de UPS.
     */
    public function index(Request $request): View
    {
        $texto = trim($request->input('q', ''));

        $estado = $request->input('estado');

        $propietario = $request->input('propietario');

        $ubicacion = $request->input('ubicacion');

        $ups = Ups::with([
            'modelo.marca',
            'propietario',
            'estadoActual',
            'ubicacionActual',
        ])

        ->when($texto, function ($query) use ($texto) {

            $query->where(function ($q) use ($texto) {

                $q->where(
                    'numero_identificador',
                    'like',
                    "%{$texto}%"
                )

                ->orWhere(
                    'numero_serie',
                    'like',
                    "%{$texto}%"
                )

                ->orWhereHas('modelo', function ($modelo) use ($texto) {

                    $modelo->where(
                        'nombre',
                        'like',
                        "%{$texto}%"
                    );
                })

                ->orWhereHas('modelo.marca', function ($marca) use ($texto) {

                    $marca->where(
                        'nombre',
                        'like',
                        "%{$texto}%"
                    );
                })

                ->orWhereHas('propietario', function ($propietario) use ($texto) {

                    $propietario->where(
                        'nombre',
                        'like',
                        "%{$texto}%"
                    );
                });
            });
        })

        ->when($estado, function ($query) use ($estado) {

            $query->where(
                'estado_actual_id',
                $estado
            );
        })

        ->when($propietario, function ($query) use ($propietario) {

            $query->where(
                'propietario_id',
                $propietario
            );
        })

        ->when($ubicacion, function ($query) use ($ubicacion) {

            $query->where(
                'ubicacion_actual_id',
                $ubicacion
            );
        })

        ->orderBy('numero_identificador')

        ->paginate(15)

        ->withQueryString();

        return view('ups.index', [

            'ups' => $ups,

            'texto' => $texto,

            'estados' => Estado::orderBy('nombre')->get(),

            'propietarios' =>
                Propietario::orderBy('nombre')->get(),

            'ubicaciones' =>
                Ubicacion::orderBy('nombre')->get(),

            'estadoSeleccionado' => $estado,

            'propietarioSeleccionado' => $propietario,

            'ubicacionSeleccionada' => $ubicacion,
        ]);
    }

    /**
     * Formulario para registrar una UPS.
     */
    public function create(): View
    {
        return view('ups.create', [

            'marcas' => Marca::orderBy('nombre')->get(),

            'modelos' => Modelo::orderBy('nombre')->get(),

            'propietarios' =>
                Propietario::orderBy('nombre')->get(),

            'estados' => Estado::orderBy('nombre')->get(),

            'ubicaciones' =>
                Ubicacion::orderBy('nombre')->get(),
        ]);
    }

    /**
     * Guarda una nueva UPS.
     */
    public function store(
        StoreUpsRequest $request
    ): RedirectResponse {

        $datos = $request->validated();

        unset($datos['foto_principal']);

        Ups::create($datos);

        return redirect()

            ->route('ups.index')

            ->with(
                'success',
                'UPS registrada correctamente.'
            );
    }

    /**
     * Muestra la ficha y el historial de la UPS.
     */
    public function show(Ups $up): View
    {
        $up->load([

            'modelo.marca',

            'propietario',

            'estadoActual',

            'ubicacionActual',

            'eventos' => function ($query) {

                $query->with([

                    'tipoEvento',

                    'usuario',

                    'estadoResultante',

                    'ubicacionResultante',
                ])

                ->orderByDesc('fecha_hora');
            },
        ]);

        return view(
            'ups.show',
            compact('up')
        );
    }

    /**
     * Formulario de edición de una UPS.
     */
    public function edit(Ups $up): View
    {
        return view('ups.edit', [

            'ups' => $up,

            'marcas' => Marca::orderBy('nombre')->get(),

            'modelos' => Modelo::orderBy('nombre')->get(),

            'propietarios' =>
                Propietario::orderBy('nombre')->get(),

            'estados' => Estado::orderBy('nombre')->get(),

            'ubicaciones' =>
                Ubicacion::orderBy('nombre')->get(),
        ]);
    }

    /**
     * Actualiza una UPS.
     */
    public function update(
        UpdateUpsRequest $request,
        Ups $up
    ): RedirectResponse {

        $datos = $request->validated();

        unset($datos['foto_principal']);

        $up->update($datos);

        return redirect()

            ->route('ups.index')

            ->with(
                'success',
                'UPS actualizada correctamente.'
            );
    }

    /**
     * Elimina una UPS.
     */
    public function destroy(
        Ups $up
    ): RedirectResponse {

        $up->delete();

        return redirect()

            ->route('ups.index')

            ->with(
                'success',
                'UPS eliminada correctamente.'
            );
    }
}