@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Gestión de UPS
            </h1>

            <p class="text-gray-500 mt-1">
                Administración de equipos UPS registrados en el sistema.
            </p>
        </div>

        <a href="{{ route('ups.create') }}"
           class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg">

            + Registrar UPS

        </a>

    </div>

    <div class="bg-white rounded-xl shadow">

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="text-left px-4 py-3">Foto</th>

                    <th class="text-left px-4 py-3">Identificador</th>

                    <th class="text-left px-4 py-3">Marca</th>

                    <th class="text-left px-4 py-3">Modelo</th>

                    <th class="text-left px-4 py-3">Propietario</th>

                    <th class="text-left px-4 py-3">Estado</th>

                    <th class="text-left px-4 py-3">Ubicación</th>

                </tr>

            </thead>

            <tbody>

            @forelse($ups as $equipo)

                <tr class="border-t">

                    <td class="px-4 py-3">
                        —
                    </td>

                    <td class="px-4 py-3">
                        {{ $equipo->numero_identificador }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $equipo->modelo->marca->nombre }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $equipo->modelo->nombre }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $equipo->propietario->nombre }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $equipo->estadoActual->nombre }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $equipo->ubicacionActual->nombre }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center py-12 text-gray-500">

                        No existen UPS registradas.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection