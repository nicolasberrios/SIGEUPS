<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ModeloController extends Controller
{
    public function index(Request $request): View
    {
        $texto = trim($request->input('q', ''));

        $modelos = Modelo::with('marca')
            ->withCount('ups')
            ->when($texto, function ($query) use ($texto) {
                $query->where('nombre', 'like', "%{$texto}%")
                    ->orWhereHas('marca', function ($q) use ($texto) {
                        $q->where('nombre', 'like', "%{$texto}%");
                    });
            })
            ->orderBy('nombre')
            ->paginate(15)
            ->withQueryString();

        return view('catalogos.modelos.index', [
            'modelos' => $modelos,
            'texto' => $texto,
        ]);
    }

    public function create(): View
    {
        return view('catalogos.modelos.create', [
            'marcas' => Marca::orderBy('nombre')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'marca_id' => ['required', 'exists:marcas,id'],
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('modelos', 'nombre')
                    ->where('marca_id', $request->input('marca_id')),
            ],
        ]);

        Modelo::create($datos);

        return redirect()
            ->route('catalogos.modelos.index')
            ->with('success', 'Modelo creado correctamente.');
    }

    public function edit(Modelo $modelo): View
    {
        return view('catalogos.modelos.edit', [
            'modelo' => $modelo,
            'marcas' => Marca::orderBy('nombre')->get(),
        ]);
    }

    public function update(Request $request, Modelo $modelo): RedirectResponse
    {
        $datos = $request->validate([
            'marca_id' => ['required', 'exists:marcas,id'],
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('modelos', 'nombre')
                    ->where('marca_id', $request->input('marca_id'))
                    ->ignore($modelo->id),
            ],
        ]);

        $modelo->update($datos);

        return redirect()
            ->route('catalogos.modelos.index')
            ->with('success', 'Modelo actualizado correctamente.');
    }

    public function destroy(Modelo $modelo): RedirectResponse
    {
        if ($modelo->ups()->exists()) {
            return redirect()
                ->route('catalogos.modelos.index')
                ->with('error', 'No se puede eliminar el modelo porque tiene UPS asociadas.');
        }

        $modelo->delete();

        return redirect()
            ->route('catalogos.modelos.index')
            ->with('success', 'Modelo eliminado correctamente.');
    }
}