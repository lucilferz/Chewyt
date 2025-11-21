<nav x-data="{ open: false }" class="glass-nav sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-bold text-xl tracking-tight text-slate-800 flex items-center gap-2">
                        🍬 Chewyt<span class="text-pink-400">Pad</span>
                    </a>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-bold text-slate-500 hover:text-slate-900">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="text-sm font-bold text-slate-500 hover:text-slate-900">
                        Kategori
                    </x-nav-link>
                    <x-nav-link :href="route('notes.index')" :active="request()->routeIs('notes.*')" class="text-sm font-bold text-slate-500 hover:text-slate-900">
                        Catatan
                    </x-nav-link>

                    <!-- TOMBOL KHUSUS ADMIN (Hanya muncul untuk Admin) -->
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="ml-4 px-4 py-2 rounded-full bg-slate-900 text-white text-xs font-bold hover:bg-black transition shadow-sm flex items-center gap-2">
                            🛡️ Admin Panel
                        </a>
                    @endif
                </div>
            </div>

            <!-- User Menu (Kanan) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-bold text-slate-500 hover:text-slate-700 transition bg-slate-50 px-3 py-1 rounded-full border border-slate-100">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <!-- Link Admin juga ditaruh di dropdown biar gampang -->
                        @if(Auth::user()->role === 'admin')
                            <x-dropdown-link :href="route('admin.dashboard')" class="text-indigo-600 font-bold bg-indigo-50">
                                🛡️ Ke Admin Panel
                            </x-dropdown-link>
                            <div class="border-t border-gray-100 my-1"></div>
                        @endif

                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-500 font-bold">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-slate-100">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categories.index')">Kategori</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('notes.index')">Catatan</x-responsive-nav-link>
            
            @if(Auth::user()->role === 'admin')
                <div class="my-2 border-t border-gray-100"></div>
                <x-responsive-nav-link :href="route('admin.dashboard')" class="text-indigo-600 font-bold bg-indigo-50 rounded-lg">
                    🛡️ Admin Panel
                </x-responsive-nav-link>
            @endif
        </div>
        <div class="pt-4 pb-1 border-t border-slate-100 px-4 pb-4">
            <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
            <div class="mt-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 text-sm font-bold w-full text-left">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>