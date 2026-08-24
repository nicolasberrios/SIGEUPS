<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Editar usuario

        </h2>

    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form method="POST" action="{{ route('usuarios.update', $usuario) }}">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label class="block mb-2 font-semibold">Nombre</label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $usuario->name) }}"
                                class="w-full rounded border-gray-300">

                            @error('name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">Correo electrónico</label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $usuario->email) }}"
                                class="w-full rounded border-gray-300">

                            @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">Rol</label>

                            <select
                                name="role_id"
                                class="w-full rounded border-gray-300"
                                @disabled($usuario->id === auth()->id())>

                                @foreach($roles as $role)

                                    <option
                                        value="{{ $role->id }}"
                                        @selected(old('role_id', $usuario->role_id) == $role->id)>

                                        {{ $role->nombre }}

                                    </option>

                                @endforeach

                            </select>

                            @if($usuario->id === auth()->id())

                                <p class="text-sm text-gray-500 mt-1">

                                    No puedes cambiar tu propio rol.

                                </p>

                            @endif

                            @error('role_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">Estado</label>

                            <label class="inline-flex items-center gap-2 mt-2">

                                <input
                                    type="checkbox"
                                    name="activo"
                                    value="1"
                                    @checked(old('activo', $usuario->activo))
                                    @disabled($usuario->id === auth()->id())
                                    class="rounded border-gray-300">

                                <span>Usuario activo</span>

                            </label>

                            @if($usuario->id === auth()->id())

                                <p class="text-sm text-gray-500 mt-1">

                                    No puedes desactivar tu propio usuario.

                                </p>

                            @endif

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">Nueva contraseña</label>

                            <input
                                type="password"
                                name="password"
                                class="w-full rounded border-gray-300">

                            <p class="text-sm text-gray-500 mt-1">

                                Dejar vacío para mantener la actual.

                            </p>

                            @error('password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">Confirmar nueva contraseña</label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="w-full rounded border-gray-300">

                        </div>

                    </div>

                    <div class="mt-8 flex gap-3">

                        <button
                            type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">

                            Guardar cambios

                        </button>

                        <a
                            href="{{ route('usuarios.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 px-6 py-2 rounded">

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>