<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="text-3xl font-bold text-gray-800">
                    Inicio
                </h2>

                <p class="text-gray-500 mt-1">
                    Bienvenido {{ Auth::user()->name }}
                </p>

            </div>

            <div class="text-right">

                <p class="font-semibold text-lg text-gray-800">

                    {{ Auth::user()->role->nombre }}

                </p>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-6">

            {{-- ================= INDICADORES ================= --}}

            <div class="dashboard-grid">

                <div class="kpi-card">

                    <div class="kpi-number">

                        {{ $totalUps }}

                    </div>

                    <div class="kpi-title">

                        UPS registradas

                    </div>

                </div>

                <div class="kpi-card">

                    <div class="kpi-number text-green-600">

                        {{ $disponibles }}

                    </div>

                    <div class="kpi-title">

                        Disponibles

                    </div>

                </div>

                <div class="kpi-card">

                    <div class="kpi-number text-yellow-500">

                        {{ $laboratorio }}

                    </div>

                    <div class="kpi-title">

                        En laboratorio

                    </div>

                </div>

                <div class="kpi-card">

                    <div class="kpi-number text-blue-600">

                        {{ $prestamo }}

                    </div>

                    <div class="kpi-title">

                        En préstamo

                    </div>

                </div>

                <div class="kpi-card">

                    <div class="kpi-number text-purple-600">

                        {{ $devolucion }}

                    </div>

                    <div class="kpi-title">

                        Lista para devolución

                    </div>

                </div>

            </div>

            {{-- ================= SEGUNDA FILA ================= --}}

            <div class="dashboard-second mt-6">

                <div class="panel">

                    <div class="panel-title">

                        Actividad reciente

                    </div>

                    @if($actividadReciente->count())

                        <div class="space-y-4">

                            @foreach($actividadReciente as $evento)

                                <div class="border-b pb-3">

                                    <div class="font-semibold">

                                        UPS {{ $evento->ups->numero_identificador }}

                                    </div>

                                    <div class="text-gray-600 text-sm">

                                        {{ $evento->tipoEvento->nombre }}

                                    </div>

                                    <div class="text-gray-400 text-xs">

                                        {{ $evento->usuario->name }}

                                        ·

                                        {{ $evento->fecha_hora }}

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <p class="text-gray-400">

                            Aún no existen eventos registrados.

                        </p>

                    @endif

                </div>

                <div class="panel">

                    <div class="panel-title">

                        Accesos rápidos

                    </div>

                    <div class="grid grid-cols-2 gap-3">

                        <a
                            href="{{ route('ups.index') }}"
                            class="btn-secondary text-center">

                            Gestión UPS

                        </a>

                        <a
                            href="{{ route('ups.create') }}"
                            class="btn-primary text-center">

                            Registrar UPS

                        </a>

                        <button
                            class="btn-secondary opacity-50 cursor-not-allowed">

                            Registrar Evento

                        </button>

                        <button
                            class="btn-secondary opacity-50 cursor-not-allowed">

                            Reportes

                        </button>

                    </div>

                </div>

            </div>

            {{-- ================= PRIORIDAD ================= --}}

            <div class="panel mt-6">

                <div class="panel-title">

                    Equipos que requieren atención

                </div>

                <p class="text-gray-400">

                    En este panel aparecerán automáticamente las UPS que lleven demasiado tiempo en laboratorio,
                    equipos pendientes de devolución, intervenciones críticas y cualquier situación que requiera
                    atención inmediata del supervisor.

                </p>

            </div>

        </div>

    </div>

</x-app-layout>