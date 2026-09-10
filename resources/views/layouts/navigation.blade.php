<nav x-data="{ open: false }" class="border-b border-[#233A30] bg-ink">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex min-w-0">
                <div class="shrink-0 flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="font-display text-xl font-medium tracking-normal text-paper">
                        Portofolio<span class="text-gold">.</span>
                    </a>
                </div>

                <div class="hidden space-x-2 sm:ms-10 sm:flex sm:items-center">
                    <a href="{{ route('dashboard') }}" class="border-b px-1 py-5 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'border-gold text-paper' : 'border-transparent text-[#AEBBAE] hover:text-paper' }}">
                        Dashboard
                    </a>

                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('stocks.index') }}" class="border-b px-1 py-5 text-sm font-medium transition {{ request()->routeIs('stocks.*') ? 'border-gold text-paper' : 'border-transparent text-[#AEBBAE] hover:text-paper' }}">
                            Master Saham
                        </a>
                    @else
                        <a href="{{ route('transactions.index') }}" class="border-b px-1 py-5 text-sm font-medium transition {{ request()->routeIs('transactions.*') ? 'border-gold text-paper' : 'border-transparent text-[#AEBBAE] hover:text-paper' }}">
                            Transaksi
                        </a>

                        <a href="{{ route('journals.index') }}" class="border-b px-1 py-5 text-sm font-medium transition {{ request()->routeIs('journals.*') ? 'border-gold text-paper' : 'border-transparent text-[#AEBBAE] hover:text-paper' }}">
                            Jurnal
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 rounded px-3 py-2 text-sm font-medium text-[#AEBBAE] transition hover:text-paper">
                            <div>{{ Auth::user()->name }}</div>
                            <div>
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded p-2 text-[#AEBBAE] transition hover:text-paper">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-[#233A30] sm:hidden">
        <div class="space-y-1 px-4 pb-3 pt-2">
            <a href="{{ route('dashboard') }}" class="block border-l-2 px-3 py-2 text-sm {{ request()->routeIs('dashboard') ? 'border-gold text-paper' : 'border-transparent text-[#AEBBAE]' }}">
                Dashboard
            </a>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('stocks.index') }}" class="block border-l-2 px-3 py-2 text-sm {{ request()->routeIs('stocks.*') ? 'border-gold text-paper' : 'border-transparent text-[#AEBBAE]' }}">
                    Master Saham
                </a>
            @else
                <a href="{{ route('transactions.index') }}" class="block border-l-2 px-3 py-2 text-sm {{ request()->routeIs('transactions.*') ? 'border-gold text-paper' : 'border-transparent text-[#AEBBAE]' }}">
                    Transaksi
                </a>

                <a href="{{ route('journals.index') }}" class="block border-l-2 px-3 py-2 text-sm {{ request()->routeIs('journals.*') ? 'border-gold text-paper' : 'border-transparent text-[#AEBBAE]' }}">
                    Jurnal
                </a>
            @endif
        </div>

        <div class="border-t border-[#233A30] pb-1 pt-4">
            <div class="px-4">
                <div class="text-base font-medium text-paper">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-[#AEBBAE]">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-[#AEBBAE] hover:text-paper">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-[#AEBBAE] hover:text-paper"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
