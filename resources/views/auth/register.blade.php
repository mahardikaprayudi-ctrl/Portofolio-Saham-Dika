<x-guest-layout>
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Daftar akun</p>
        <h2 class="mt-2 font-display text-3xl font-medium text-ink">Mulai catatan investasi pribadi.</h2>
        <p class="mt-3 text-sm leading-6 text-[#6B6A61]">Buat akun untuk menyimpan transaksi, jurnal analisis, dan ringkasan profit/loss milikmu sendiri.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6 border-t border-[#DAD6C9] pt-8">
        @csrf

        <div>
            <label for="name" class="text-sm font-semibold text-[#3D3C36]">Nama</label>
            <input id="name" class="mt-2 block w-full rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink placeholder:text-[#9A9485] focus:border-ink focus:ring-ink" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-[#9A5A46]" />
        </div>

        <div>
            <label for="email" class="text-sm font-semibold text-[#3D3C36]">Email</label>
            <input id="email" class="mt-2 block w-full rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink placeholder:text-[#9A9485] focus:border-ink focus:ring-ink" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-[#9A5A46]" />
        </div>

        <div>
            <label for="password" class="text-sm font-semibold text-[#3D3C36]">Password</label>
            <input id="password" class="mt-2 block w-full rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink focus:border-ink focus:ring-ink" type="password" name="password" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-[#9A5A46]" />
        </div>

        <div>
            <label for="password_confirmation" class="text-sm font-semibold text-[#3D3C36]">Konfirmasi password</label>
            <input id="password_confirmation" class="mt-2 block w-full rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink focus:border-ink focus:ring-ink" type="password" name="password_confirmation" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-[#9A5A46]" />
        </div>

        <div class="flex flex-col gap-3 border-t border-[#DAD6C9] pt-6 sm:flex-row sm:items-center sm:justify-between">
            <a class="text-sm font-medium text-[#6B6A61] hover:text-ink" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit" class="rounded bg-ink px-4 py-2 text-sm font-semibold text-paper transition hover:bg-[#143125]">
                Daftar
            </button>
        </div>
    </form>
</x-guest-layout>
