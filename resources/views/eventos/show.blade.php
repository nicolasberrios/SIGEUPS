<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center gap-4">

            <div>

                <h2 class="text-2xl font-bold text-gray-800">

                    Detalle del evento

                </h2>

                <p class="text-gray-500">

                    Registro de trazabilidad N.º {{ $evento->id }}.

                </p>

            </div>

            <div class="flex gap-3">

                <a
                    href="{{ route('ups.show', $evento->ups) }}"
                    class="btn-secondary px-5">

                    Ver UPS

                </a>

                <a
                    href="{{ route('eventos.index') }}"
                    class="btn-primary px-5">

                    Volver

                </a>

            </div>

        </div>

    </x-slot>

    <div class="py-6">

        <div class="max-w-5xl mx-auto px-6">

            @if(session('success'))

                <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-5 py-4 text-green-800">

                    {{ session('success') }}

                </div>

            @endif

            {{-- ================= DATOS DEL EVENTO ================= --}}

            <div class="panel mb-6">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div>

                        <p class="text-sm text-gray-500">

                            Fecha y hora

                        </p>

                        <p class="font-semibold text-lg">

                            {{ $evento->fecha_hora->format('d-m-Y H:i') }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            Tipo de evento

                        </p>

                        <p class="font-semibold text-lg">

                            {{ $evento->tipoEvento->nombre }}

                        </p>

                        <p class="text-sm text-gray-500">

                            {{ $evento->tipoEvento->categoria }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            Registrado por

                        </p>

                        <p class="font-semibold text-lg">

                            {{ $evento->usuario->name }}

                        </p>

                        <p class="text-sm text-gray-500">

                            {{ $evento->usuario->role->nombre }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            UPS

                        </p>

                        <p class="font-semibold text-lg">

                            {{ $evento->ups->numero_identificador }}

                        </p>

                        <p class="text-sm text-gray-500">

                            {{ $evento->ups->modelo->marca->nombre }}
                            {{ $evento->ups->modelo->nombre }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            Estado resultante

                        </p>

                        <p class="font-semibold text-lg">

                            {{ $evento->estadoResultante->nombre }}

                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">

                            Ubicación resultante

                        </p>

                        <p class="font-semibold text-lg">

                            {{ $evento->ubicacionResultante->nombre }}

                        </p>

                    </div>

                </div>

            </div>

            {{-- ================= COMENTARIO ================= --}}

            <div class="panel">

                <h3 class="text-xl font-semibold mb-4">

                    Comentario

                </h3>

                @if($evento->comentario)

                    <p class="whitespace-pre-line text-gray-700">

                        {{ $evento->comentario }}

                    </p>

                @else

                    <p class="text-gray-500">

                        No se agregó un comentario.

                    </p>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>