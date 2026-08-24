<?php

namespace App\Http\Controllers;

use App\Models\Fotografia;
use App\Models\Ups;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotografiaController extends Controller
{
    public function store(Request $request, Ups $up): RedirectResponse
    {
        $request->validate([
            'imagen' => ['required', 'image', 'max:4096'],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ]);

        $ruta = $request
            ->file('imagen')
            ->store('fotografias', 'public');

        Fotografia::create([
            'ups_id' => $up->id,
            'evento_id' => null,
            'usuario_id' => auth()->id(),
            'ruta' => $ruta,
            'descripcion' => $request->input('descripcion'),
        ]);

        return redirect()
            ->route('ups.show', $up)
            ->with('success', 'Fotografía subida correctamente.');
    }

    public function destroy(Fotografia $fotografia): RedirectResponse
    {
        $up = $fotografia->ups;

        Storage::disk('public')->delete($fotografia->ruta);

        $fotografia->delete();

        return redirect()
            ->route('ups.show', $up)
            ->with('success', 'Fotografía eliminada correctamente.');
    }
}