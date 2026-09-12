<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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

                    @if (Route::has('login'))
                        <div class="flex items-center gap-5">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="border-b border-gold px-1 py-5 text-sm font-medium text-paper">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-[#AEBBAE] transition hover:text-paper">
                                    Masuk
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="rounded bg-gold px-4 py-2 text-sm font-semibold text-ink transition hover:bg-[#B8923D]">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </nav>

            <main>
                <section class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 lg:grid-cols-[1.18fr_0.82fr] lg:px-8 lg:py-20">
                    <div class="border-b border-[#DAD6C9] pb-10 lg:border-b-0 lg:border-r lg:pr-12">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Portofolio saham pribadi</p>
                        <h1 class="mt-4 max-w-4xl font-display text-5xl font-medium leading-[1.05] text-ink sm:text-6xl">
                            Catat investasi saham dan jurnal keputusan dengan tenang.
                        </h1>
                        <p class="mt-6 max-w-2xl text-base leading-7 text-[#6B6A61]">
                            Portofolio membantu investor pribadi mencatat transaksi beli/jual, menulis alasan analisis, dan membaca profit/loss otomatis tanpa tampilan yang mendorong keputusan emosional.
                        </p>

                        @if (Route::has('register'))
                            <div class="mt-8">
                                <a href="{{ route('register') }}" class="inline-flex rounded bg-ink px-5 py-3 text-sm font-semibold text-paper transition hover:bg-[#143125]">
                                    Mulai Sekarang
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="lg:pt-7">
                        <p class="font-display text-2xl font-medium text-ink">Fokus aplikasi</p>
                        <div class="mt-6 divide-y divide-[#E4DFD2] border-y border-[#DAD6C9]">
                            <div class="grid grid-cols-[64px_1fr] gap-4 py-5">
                                <p class="font-mono text-sm font-semibold text-ink">01</p>
                                <div>
                                    <h2 class="font-semibold text-ink">Catat transaksi beli/jual saham</h2>
                                    <p class="mt-1 text-sm leading-6 text-[#6B6A61]">Setiap lot, harga, dan tanggal disimpan rapi seperti buku besar pribadi.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-[64px_1fr] gap-4 py-5">
                                <p class="font-mono text-sm font-semibold text-ink">02</p>
                                <div>
                                    <h2 class="font-semibold text-ink">Tulis jurnal analisis</h2>
                                    <p class="mt-1 text-sm leading-6 text-[#6B6A61]">Keputusan investasi punya konteks, bukan hanya angka masuk dan keluar.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-[64px_1fr] gap-4 py-5">
                                <p class="font-mono text-sm font-semibold text-ink">03</p>
                                <div>
                                    <h2 class="font-semibold text-ink">Kalkulasi profit/loss otomatis</h2>
                                    <p class="mt-1 text-sm leading-6 text-[#6B6A61]">Posisi portofolio mudah dibaca dengan angka monospace yang presisi.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-[64px_1fr] gap-4 py-5">
                                <p class="font-mono text-sm font-semibold text-ink">04</p>
                                <div>
                                    <h2 class="font-semibold text-ink">Harga saham dari Yahoo Finance</h2>
                                    <p class="mt-1 text-sm leading-6 text-[#6B6A61]">Harga acuan dapat diperbarui agar pencatatan tetap dekat dengan kondisi pasar.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="border-t border-[#DAD6C9]">
                <div class="mx-auto max-w-7xl px-4 py-5 text-xs leading-5 text-[#807B6D] sm:px-6 lg:px-8">
                    Dibuat oleh Wiadhynata Mahardika Putra Prayudi (Dika), siswa SMK Telkom Makassar jurusan Rekayasa Perangkat Lunak (RPL), tugas praktik kejuruan.
                </div>
            </footer>
        </div>
    </body>
</html>
