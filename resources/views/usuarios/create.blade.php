<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Crear usuario

        </h2>

    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form method="POST" action="{{ route('usuarios.store') }}">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>

                            <label class="block mb-2 font-semibold">Nombre</label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
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
                                value="{{ old('email') }}"
                                class="w-full rounded border-gray-300">

                            @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">Rol</label>

                            <select name="role_id" class="w-full rounded border-gray-300">

                                @foreach($roles as $role)

                                    <option
                                        value="{{ $role->id }}"
                                        @selected(old('role_id') == $role->id)>

                                        {{ $role->nombre }}

                                    </option>

                                @endforeach

                            </select>

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
                                    checked
                                    class="rounded border-gray-300">

                                <span>Usuario activo</span>

                            </label>

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">Contraseña</label>

                            <input
                                type="password"
                                name="password"
                                class="w-full rounded border-gray-300">

                            @error('password')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror

                        </div>

                        <div>

                            <label class="block mb-2 font-semibold">Confirmar contraseña</label>

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

                            Guardar usuario

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