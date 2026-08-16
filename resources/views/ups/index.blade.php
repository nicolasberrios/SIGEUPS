<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de UPS
            </h2>

            <a href="{{ route('ups.create') }}"
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                + Registrar UPS

            </a>

        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-4 py-3 text-left">UPS</th>

                            <th class="px-4 py-3 text-left">Estado</th>

                            <th class="px-4 py-3 text-left">Propietario</th>

                            <th class="px-4 py-3 text-left">Marca</th>

                            <th class="px-4 py-3 text-left">Modelo</th>

                            <th class="px-4 py-3 text-left">Potencia</th>

                            <th class="px-4 py-3 text-left">Ubicación</th>

                            <th class="px-4 py-3 text-center">Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($ups as $equipo)

                        <tr class="border-t hover:bg-gray-50">

                            <td class="px-4 py-3 font-semibold">
                                {{ $equipo->numero_identificador }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $equipo->estadoActual->nombre }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $equipo->propietario->nombre }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $equipo->modelo->marca->nombre }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $equipo->modelo->nombre }}
                            </td>

                            <td class="px-4 py-3">
                                {{ number_format($equipo->potencia_kva,2) }} kVA
                            </td>

                            <td class="px-4 py-3">
                                {{ $equipo->ubicacionActual->nombre }}
                            </td>

                            <td class="px-4 py-3 text-center">

                                <a href="{{ route('ups.edit',$equipo) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">

                                    Editar

                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="8" class="text-center py-10 text-gray-500">

                                No existen UPS registradas.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-6">
                {{ $ups->links() }}
            </div>

        </div>

    </div>

</x-app-layout>