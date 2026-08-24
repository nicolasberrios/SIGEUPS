<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">

                    Administración de usuarios

                </h2>

                <p class="text-gray-500">

                    Gestión de accesos, roles y estado de usuarios.

                </p>

            </div>

            <a href="{{ route('usuarios.create') }}"
               class="btn-primary">

                Crear usuario

            </a>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-6">

            @if(session('success'))

                <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded">

                    {{ session('success') }}

                </div>

            @endif

            @if(session('error'))

                <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded">

                    {{ session('error') }}

                </div>

            @endif

            <div class="panel mb-5">

                <form method="GET" action="{{ route('usuarios.index') }}">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        <div class="md:col-span-3">

                            <label class="block mb-2 font-semibold">

                                Buscar usuario

                            </label>

                            <input
                                type="text"
                                name="q"
                                value="{{ $texto }}"
                                placeholder="Nombre, correo o rol..."
                                class="w-full border rounded-lg px-4 py-3">

                        </div>

                        <div class="flex items-end gap-3">

                            <button
                                type="submit"
                                class="btn-primary">

                                Buscar

                            </button>

                            <a
                                href="{{ route('usuarios.index') }}"
                                class="btn-secondary">

                                Limpiar

                            </a>

                        </div>

                    </div>

                </form>

            </div>

            <div class="panel">

                <table class="table-sigeups">

                    <thead>

                        <tr>

                            <th>Nombre</th>

                            <th>Correo</th>

                            <th>Rol</th>

                            <th>Estado</th>

                            <th></th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($usuarios as $usuario)

                            <tr>

                                <td>

                                    <strong>{{ $usuario->name }}</strong>

                                </td>

                                <td>

                                    {{ $usuario->email }}

                                </td>

                                <td>

                                    {{ $usuario->role->nombre ?? 'Sin rol' }}

                                </td>

                                <td>

                                    @if($usuario->activo)

                                        <span class="text-green-700 font-semibold">

                                            Activo

                                        </span>

                                    @else

                                        <span class="text-red-700 font-semibold">

                                            Inactivo

                                        </span>

                                    @endif

                                </td>

                                <td class="text-right whitespace-nowrap">

                                    <a
                                        href="{{ route('usuarios.edit', $usuario) }}"
                                        class="btn-secondary">

                                        Editar

                                    </a>

                                    @if($usuario->id !== auth()->id())

                                        <form
                                            method="POST"
                                            action="{{ route('usuarios.toggle-activo', $usuario) }}"
                                            class="inline ml-2">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="text-red-600 font-semibold hover:text-red-800">

                                                {{ $usuario->activo ? 'Desactivar' : 'Activar' }}

                                            </button>

                                        </form>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center py-8 text-gray-500">

                                    No se encontraron usuarios.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="mt-6">

                    {{ $usuarios->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>