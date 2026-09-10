<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Admin</p>
                <h2 class="font-display text-3xl font-medium text-ink">
                    Master Saham
                </h2>
            </div>
            <a href="{{ route('stocks.create') }}" class="inline-flex w-fit items-center rounded bg-gold px-4 py-2 text-sm font-semibold text-ink transition hover:bg-[#B8923D]">
                Tambah saham
            </a>
        </div>
    </x-slot>

    <div class="bg-paper py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 border-l-4 border-[#476B4E] bg-[#EEF2E7] px-4 py-3 text-sm text-[#3F5F45]">
                    {{ session('success') }}
                </div>
            @endif

            <section class="grid gap-5 border-b border-[#DAD6C9] pb-6 lg:grid-cols-[1fr_auto] lg:items-end">
                <form method="GET" class="grid gap-3 sm:grid-cols-[minmax(0,1fr)_220px_auto]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama..." class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink placeholder:text-[#9A9485] focus:border-ink focus:ring-ink">
                    <select name="sector" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink focus:border-ink focus:ring-ink">
                        <option value="">Semua sektor</option>
                        @foreach ($stocks->pluck('sector')->unique()->filter() as $sector)
                            <option value="{{ $sector }}" {{ request('sector') == $sector ? 'selected' : '' }}>{{ $sector }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="rounded bg-ink px-4 py-2 text-sm font-semibold text-paper transition hover:bg-[#143125]">Filter</button>
                </form>

                <form action="{{ route('stocks.update-prices') }}" method="POST" onsubmit="return confirm('Update semua harga saham dari Yahoo Finance?')">
                    @csrf
                    <button type="submit" class="rounded border border-[#CFC8B8] px-4 py-2 text-sm font-semibold text-[#3D3C36] transition hover:border-ink hover:text-ink">
                        Update harga
                    </button>
                </form>
            </section>

            <section class="mt-8">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] text-left text-sm">
                        <thead>
                            <tr class="border-b border-[#DAD6C9]">
                                <th class="py-3 pr-4 text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Kode</th>
                                <th class="px-4 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Nama emiten</th>
                                <th class="px-4 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Sektor</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Harga acuan</th>
                                <th class="py-3 pl-4 text-right text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E4DFD2]">
                            @forelse ($stocks as $stock)
                                <tr>
                                    <td class="py-4 pr-4 font-mono font-semibold text-ink">{{ $stock->code }}</td>
                                    <td class="px-4 py-4 text-[#3D3C36]">{{ $stock->name }}</td>
                                    <td class="px-4 py-4 text-[#6B6A61]">{{ $stock->sector ?? '-' }}</td>
                                    <td class="px-4 py-4 text-right font-mono font-medium text-ink">{{ number_format($stock->reference_price, 0, ',', '.') }}</td>
                                    <td class="py-4 pl-4 text-right">
                                        <a href="{{ route('stocks.edit', $stock) }}" class="text-sm font-medium text-[#476B4E] hover:text-ink">Edit</a>
                                        <form action="{{ route('stocks.destroy', $stock) }}" method="POST" class="ml-4 inline" onsubmit="return confirm('Yakin hapus saham ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-[#9A5A46] hover:text-ink">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-sm text-[#6B6A61]">Belum ada data saham.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $stocks->links() }}
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
