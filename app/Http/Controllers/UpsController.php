<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpsRequest;
use App\Models\Estado;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Propietario;
use App\Models\Ubicacion;
use App\Models\Ups;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UpsController extends Controller
{
    /**
     * Listado de UPS.
     */
    public function index(): View
    {
        $ups = Ups::with([
            'modelo.marca',
            'propietario',
            'estadoActual',
            'ubicacionActual',
        ])
        ->orderBy('id', 'desc')
        ->paginate(15);

        return view('ups.index', compact('ups'));
    }

    /**
     * Formulario de creación.
     */
    public function create(): View
    {
        return view('ups.create', [
            'marcas' => Marca::orderBy('nombre')->get(),
            'modelos' => Modelo::orderBy('nombre')->get(),
            'propietarios' => Propietario::orderBy('nombre')->get(),
            'estados' => Estado::orderBy('nombre')->get(),
            'ubicaciones' => Ubicacion::orderBy('nombre')->get(),
        ]);
    }

    /**
     * Guarda una nueva UPS.
     */
    public function store(StoreUpsRequest $request): RedirectResponse
    {
        $datos = $request->validated();

        // La fotografía la implementaremos en el siguiente Sprint.
        unset($datos['foto_principal']);

        Ups::create($datos);

        return redirect()
            ->route('ups.index')
            ->with('success', 'UPS registrada correctamente.');
    }

    /**
     * Ver detalle.
     */
    public function show(Ups $up)
    {
        //
    }

    /**
     * Formulario de edición.
     */
    public function edit(Ups $up)
    {
        //
    }

    /**
     * Actualizar.
     */
    public function update(UpdateUpsRequest $request, Ups $up)
    {
        //
    }

    /**
     * Eliminar.
     */
    public function destroy(Ups $up)
    {
        //
    }
}