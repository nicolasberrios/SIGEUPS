<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function index(Request $request): View
    {
        $texto = trim($request->input('q', ''));

        $usuarios = User::with('role')
            ->when($texto, function ($query) use ($texto) {
                $query->where(function ($q) use ($texto) {
                    $q->where('name', 'like', "%{$texto}%")
                        ->orWhere('email', 'like', "%{$texto}%")
                        ->orWhereHas('role', function ($r) use ($texto) {
                            $r->where('nombre', 'like', "%{$texto}%");
                        });
                });
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('usuarios.index', [
            'usuarios' => $usuarios,
            'texto' => $texto,
        ]);
    }

    public function create(): View
    {
        return view('usuarios.create', [
            'roles' => Role::orderBy('nombre')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'activo' => ['nullable', 'boolean'],
        ]);

        User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'role_id' => $datos['role_id'],
            'password' => Hash::make($datos['password']),
            'activo' => $request->boolean('activo'),
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $usuario): View
    {
        return view('usuarios.edit', [
            'usuario' => $usuario,
            'roles' => Role::orderBy('nombre')->get(),
        ]);
    }

    public function update(Request $request, User $usuario): RedirectResponse
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($usuario->id),
            ],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'activo' => ['nullable', 'boolean'],
        ]);

        $usuario->name = $datos['name'];
        $usuario->email = $datos['email'];

        if ($usuario->id !== auth()->id()) {
            $usuario->role_id = $datos['role_id'];
            $usuario->activo = $request->boolean('activo');
        }

        if (! empty($datos['password'])) {
            $usuario->password = Hash::make($datos['password']);
        }

        $usuario->save();

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function toggleActivo(User $usuario): RedirectResponse
    {
        if ($usuario->id === auth()->id()) {
            return redirect()
                ->route('usuarios.index')
                ->with('error', 'No puedes desactivar tu propio usuario.');
        }

        $usuario->update([
            'activo' => ! $usuario->activo,
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Estado del usuario actualizado correctamente.');
    }
}