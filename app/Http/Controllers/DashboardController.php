<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Ups;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUps = Ups::count();

        $disponibles = Ups::whereHas('estadoActual', function ($query) {
            $query->where('nombre', 'Disponible');
        })->count();

        $laboratorio = Ups::whereHas('estadoActual', function ($query) {
            $query->where('nombre', 'En laboratorio');
        })->count();

        $prestamo = Ups::whereHas('estadoActual', function ($query) {
            $query->where('nombre', 'En préstamo');
        })->count();

        $devolucion = Ups::whereHas('estadoActual', function ($query) {
            $query->where('nombre', 'Lista para devolución');
        })->count();

        $actividadReciente = Evento::with([
            'ups',
            'tipoEvento',
            'usuario',
        ])
            ->latest('fecha_hora')
            ->take(8)
            ->get();

        $estadosAtencion = [
            'En laboratorio',
            'En préstamo',
            'Lista para devolución',
        ];

        $equiposAtencion = Ups::with([
            'modelo.marca',
            'propietario',
            'estadoActual',
            'ubicacionActual',
            'eventos' => function ($query) {
                $query->latest('fecha_hora');
            },
        ])
            ->whereHas('estadoActual', function ($query) use ($estadosAtencion) {
                $query->whereIn('nombre', $estadosAtencion);
            })
            ->get()
            ->map(function ($up) {

                $ultimoEventoEstado = $up->eventos
                    ->where('estado_resultante_id', $up->estado_actual_id)
                    ->sortByDesc('fecha_hora')
                    ->first();

                $fechaReferencia = $ultimoEventoEstado
                    ? $ultimoEventoEstado->fecha_hora
                    : $up->updated_at;

                $up->fecha_estado_actual = $fechaReferencia;

                $up->dias_en_estado = now()->diffInDays($fechaReferencia);

                return $up;

            })
            ->filter(function ($up) {
                return $up->fecha_estado_actual <= now()->subMonths(3);
            })
            ->sortByDesc('dias_en_estado')
            ->values();

        return view('dashboard', [
            'totalUps' => $totalUps,
            'disponibles' => $disponibles,
            'laboratorio' => $laboratorio,
            'prestamo' => $prestamo,
            'devolucion' => $devolucion,
            'actividadReciente' => $actividadReciente,
            'equiposAtencion' => $equiposAtencion,
        ]);
    }
}