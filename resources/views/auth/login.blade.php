<x-guest-layout>
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Masuk akun</p>
        <h2 class="mt-2 font-display text-3xl font-medium text-ink">Lanjutkan pencatatan portofolio.</h2>
        <p class="mt-3 text-sm leading-6 text-[#6B6A61]">Gunakan akunmu untuk membaca posisi, transaksi, dan jurnal investasi pribadi.</p>
    </div>

    <x-auth-session-status class="mt-6 border-l-4 border-[#476B4E] bg-[#EEF2E7] px-4 py-3 text-sm text-[#3F5F45]" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6 border-t border-[#DAD6C9] pt-8">
        @csrf

        <div>
            <label for="email" class="text-sm font-semibold text-[#3D3C36]">Email</label>
            <input id="email" class="mt-2 block w-full rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink placeholder:text-[#9A9485] focus:border-ink focus:ring-ink" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-[#9A5A46]" />
        </div>

        <div>
            <label for="password" class="text-sm font-semibold text-[#3D3C36]">Password</label>
            <input id="password" class="mt-2 block w-full rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink focus:border-ink focus:ring-ink" type="password" name="password" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-[#9A5A46]" />
        </div>

        <div class="flex items-center justify-between gap-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-[#CFC8B8] bg-[#FBFAF6] text-ink focus:ring-ink" name="remember">
                <span class="ms-2 text-sm text-[#6B6A61]">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-[#476B4E] hover:text-ink" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="flex flex-col gap-3 border-t border-[#DAD6C9] pt-6 sm:flex-row sm:items-center sm:justify-between">
            @if (Route::has('register'))
                <a class="text-sm font-medium text-[#6B6A61] hover:text-ink" href="{{ route('register') }}">
                    Belum punya akun?
                </a>
            @endif

            <button type="submit" class="rounded bg-ink px-4 py-2 text-sm font-semibold text-paper transition hover:bg-[#143125]">
                Masuk
            </button>
        </div>
    </form>
</x-guest-layout>
