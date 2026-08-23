<nav class="bg-white border-b shadow-sm">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-16">

            {{-- Logo y navegación --}}

            <div class="flex items-center space-x-10">

                <a
                    href="{{ route('dashboard') }}"
                    class="text-2xl font-bold text-red-600">

                    SIGEUPS

                </a>

                <div class="hidden md:flex items-center space-x-6">

                    <a
                        href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard')
                            ? 'text-red-600 font-semibold'
                            : 'text-gray-700 hover:text-red-600' }}">

                        Inicio

                    </a>

                    <a
                        href="{{ route('ups.index') }}"
                        class="{{ request()->routeIs('ups.*')
                            ? 'text-red-600 font-semibold'
                            : 'text-gray-700 hover:text-red-600' }}">

                        UPS

                    </a>

                    <a
                        href="{{ route('eventos.index') }}"
                        class="{{ request()->routeIs('eventos.*')
                            ? 'text-red-600 font-semibold'
                            : 'text-gray-700 hover:text-red-600' }}">

                        Eventos

                    </a>

                </div>

            </div>

            {{-- Usuario --}}

            <div class="flex items-center gap-5">

                <div class="text-right">

                    <div class="font-semibold">

                        {{ Auth::user()->name }}

                    </div>

                    <div class="text-xs text-gray-500">

                        {{ Auth::user()->role->nombre }}

                    </div>

                </div>

                <form
                    method="POST"
                    action="{{ route('logout') }}">

                    @csrf

                    <button
                        type="submit"
                        class="text-gray-500 hover:text-red-600">

                        Salir

                    </button>

                </form>

            </div>

        </div>

    </div>

</nav>