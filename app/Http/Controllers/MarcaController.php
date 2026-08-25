<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MarcaController extends Controller
{
    public function index(Request $request): View
    {
        $texto = trim($request->input('q', ''));

        $marcas = Marca::withCount('modelos')
            ->when($texto, function ($query) use ($texto) {
                $query->where('nombre', 'like', "%{$texto}%");
            })
            ->orderBy('nombre')
            ->paginate(15)
            ->withQueryString();

        return view('catalogos.marcas.index', [
            'marcas' => $marcas,
            'texto' => $texto,
        ]);
    }

    public function create(): View
    {
        return view('catalogos.marcas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100', 'unique:marcas,nombre'],
        ]);

        Marca::create($datos);

        return redirect()
            ->route('catalogos.marcas.index')
            ->with('success', 'Marca creada correctamente.');
    }

    public function edit(Marca $marca): View
    {
        return view('catalogos.marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('marcas', 'nombre')->ignore($marca->id),
            ],
        ]);

        $marca->update($datos);

        return redirect()
            ->route('catalogos.marcas.index')
            ->with('success', 'Marca actualizada correctamente.');
    }

    public function destroy(Marca $marca): RedirectResponse
    {
        if ($marca->modelos()->exists()) {
            return redirect()
                ->route('catalogos.marcas.index')
                ->with('error', 'No se puede eliminar la marca porque tiene modelos asociados.');
        }

        $marca->delete();

        return redirect()
            ->route('catalogos.marcas.index')
            ->with('success', 'Marca eliminada correctamente.');
    }
}