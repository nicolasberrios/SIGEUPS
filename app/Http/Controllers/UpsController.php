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

        // La fotografía la implementaremos más adelante.
        unset($datos['foto_principal']);

        Ups::create($datos);

        return redirect()
            ->route('ups.index')
            ->with('success', 'UPS registrada correctamente.');
    }

    /**
     * Ver detalle.
     */
    public function show(Ups $up): View
    {
        return view('ups.show', compact('up'));
    }

    /**
     * Formulario de edición.
     */
    public function edit(Ups $up): View
    {
        return view('ups.edit', [
            'ups' => $up,
            'marcas' => Marca::orderBy('nombre')->get(),
            'modelos' => Modelo::orderBy('nombre')->get(),
            'propietarios' => Propietario::orderBy('nombre')->get(),
            'estados' => Estado::orderBy('nombre')->get(),
            'ubicaciones' => Ubicacion::orderBy('nombre')->get(),
        ]);
    }

    /**
     * Actualizar UPS.
     */
    public function update(UpdateUpsRequest $request, Ups $up): RedirectResponse
    {
        $datos = $request->validated();

        unset($datos['foto_principal']);

        $up->update($datos);

        return redirect()
            ->route('ups.index')
            ->with('success', 'UPS actualizada correctamente.');
    }

    /**
     * Eliminar UPS.
     */
    public function destroy(Ups $up): RedirectResponse
    {
        $up->delete();

        return redirect()
            ->route('ups.index')
            ->with('success', 'UPS eliminada correctamente.');
    }
}