<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PropietarioController extends Controller
{
    public function index(Request $request): View
    {
        $texto = trim($request->input('q', ''));

        $propietarios = Propietario::withCount('ups')
            ->when($texto, function ($query) use ($texto) {
                $query->where('nombre', 'like', "%{$texto}%")
                    ->orWhere('sucursal', 'like', "%{$texto}%");
            })
            ->orderBy('nombre')
            ->paginate(15)
            ->withQueryString();

        return view('catalogos.propietarios.index', [
            'propietarios' => $propietarios,
            'texto' => $texto,
        ]);
    }

    public function create(): View
    {
        return view('catalogos.propietarios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'sucursal' => ['nullable', 'string', 'max:100'],
        ]);

        Propietario::create($datos);

        return redirect()
            ->route('catalogos.propietarios.index')
            ->with('success', 'Propietario creado correctamente.');
    }

    public function edit(Propietario $propietario): View
    {
        return view('catalogos.propietarios.edit', compact('propietario'));
    }

    public function update(Request $request, Propietario $propietario): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'sucursal' => ['nullable', 'string', 'max:100'],
        ]);

        $propietario->update($datos);

        return redirect()
            ->route('catalogos.propietarios.index')
            ->with('success', 'Propietario actualizado correctamente.');
    }

    public function destroy(Propietario $propietario): RedirectResponse
    {
        if ($propietario->ups()->exists()) {
            return redirect()
                ->route('catalogos.propietarios.index')
                ->with('error', 'No se puede eliminar el propietario porque tiene UPS asociadas.');
        }

        $propietario->delete();

        return redirect()
            ->route('catalogos.propietarios.index')
            ->with('success', 'Propietario eliminado correctamente.');
    }
}