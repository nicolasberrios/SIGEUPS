<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Ups;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentoController extends Controller
{
    public function store(Request $request, Ups $up): RedirectResponse
    {
        $request->validate([
            'documento' => [
                'required',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
                'max:10240',
            ],
        ]);

        $archivo = $request->file('documento');

        $ruta = $archivo->store('documentos', 'public');

        Documento::create([
            'ups_id' => $up->id,
            'evento_id' => null,
            'usuario_id' => auth()->id(),
            'nombre_original' => $archivo->getClientOriginalName(),
            'ruta' => $ruta,
            'extension' => $archivo->getClientOriginalExtension(),
            'tamano' => $archivo->getSize(),
        ]);

        return redirect()
            ->route('ups.show', $up)
            ->with('success', 'Documento subido correctamente.');
    }

    public function download(Documento $documento): StreamedResponse
    {
        return Storage::disk('public')->download(
            $documento->ruta,
            $documento->nombre_original
        );
    }

    public function destroy(Documento $documento): RedirectResponse
    {
        $up = $documento->ups;

        Storage::disk('public')->delete($documento->ruta);

        $documento->delete();

        return redirect()
            ->route('ups.show', $up)
            ->with('success', 'Documento eliminado correctamente.');
    }
}