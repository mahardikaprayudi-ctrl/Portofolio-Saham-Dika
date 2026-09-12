<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Portofolio') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;500;600&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-paper font-sans text-ink antialiased">
        <div class="min-h-screen">
            <nav class="border-b border-[#233A30] bg-ink">
                <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                    <a href="{{ url('/') }}" class="font-display text-xl font-medium tracking-normal text-paper">
                        Portofolio<span class="text-gold">.</span>
                    </a>

                    <div class="flex items-center gap-5">
                        <a href="{{ route('login') }}" class="border-b border-gold px-1 py-5 text-sm font-medium text-paper">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hidden text-sm font-medium text-[#AEBBAE] transition hover:text-paper sm:inline">
                                Daftar
                            </a>
                        @endif
                    </div>
                </div>
            </nav>

            <main class="mx-auto grid min-h-[calc(100vh-4rem)] max-w-7xl gap-10 px-4 py-10 sm:px-6 lg:grid-cols-[0.82fr_1.18fr] lg:px-8 lg:py-14">
                <aside class="border-b border-[#DAD6C9] pb-8 lg:border-b-0 lg:border-r lg:pr-10">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Akses portofolio</p>
                    <h1 class="mt-3 font-display text-4xl font-medium leading-tight text-ink">
                        Catatan investasi yang tenang dan terukur.
                    </h1>
                    <p class="mt-5 text-sm leading-6 text-[#6B6A61]">
                        Masuk untuk mencatat transaksi, menulis alasan keputusan, dan membaca posisi portofolio tanpa distraksi visual.
                    </p>

                    <dl class="mt-8 divide-y divide-[#E4DFD2] border-t border-[#DAD6C9]">
                        <div class="grid grid-cols-[72px_1fr] py-4">
                            <dt class="font-mono text-sm font-semibold text-ink">01</dt>
                            <dd class="text-sm text-[#3D3C36]">Transaksi beli dan jual tercatat sebagai ledger.</dd>
                        </div>
                        <div class="grid grid-cols-[72px_1fr] py-4">
                            <dt class="font-mono text-sm font-semibold text-ink">02</dt>
                            <dd class="text-sm text-[#3D3C36]">Jurnal membantu keputusan tetap berbasis data.</dd>
                        </div>
                        <div class="grid grid-cols-[72px_1fr] py-4">
                            <dt class="font-mono text-sm font-semibold text-ink">03</dt>
                            <dd class="text-sm text-[#3D3C36]">Profit/loss dibaca dengan aksen matang, bukan sinyal panik.</dd>
                        </div>
                    </dl>
                </aside>

                <section class="w-full max-w-md lg:ml-auto lg:pt-3">
                    {{ $slot }}
                </section>
            </main>
        </div>
    </body>
</html>
