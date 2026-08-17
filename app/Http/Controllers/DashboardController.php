<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Evento;
use App\Models\Ups;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUps = Ups::count();

        $disponibles = Ups::whereHas('estadoActual', function ($q) {
            $q->where('nombre', 'Disponible');
        })->count();

        $prestamo = Ups::whereHas('estadoActual', function ($q) {
            $q->where('nombre', 'En préstamo');
        })->count();

        $laboratorio = Ups::whereHas('estadoActual', function ($q) {
            $q->where('nombre', 'En laboratorio');
        })->count();

        $devolucion = Ups::whereHas('estadoActual', function ($q) {
            $q->where('nombre', 'Lista para devolución');
        })->count();

        $actividadReciente = Evento::with([
            'ups',
            'tipoEvento',
            'usuario'
        ])
        ->latest('fecha_hora')
        ->take(8)
        ->get();

        return view('dashboard', compact(
            'totalUps',
            'disponibles',
            'prestamo',
            'laboratorio',
            'devolucion',
            'actividadReciente'
        ));
    }
}