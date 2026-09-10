<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Catatan pribadi</p>
                <h2 class="font-display text-3xl font-medium text-ink">
                    Transaksi Saya
                </h2>
            </div>
            <a href="{{ route('transactions.create') }}" class="inline-flex w-fit items-center rounded bg-gold px-4 py-2 text-sm font-semibold text-ink transition hover:bg-[#B8923D]">
                Transaksi baru
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

            <section class="border-b border-[#DAD6C9] pb-6">
                <form method="GET" class="grid gap-3 sm:grid-cols-[minmax(0,420px)_auto]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama saham..." class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink placeholder:text-[#9A9485] focus:border-ink focus:ring-ink">
                    <button type="submit" class="rounded bg-ink px-4 py-2 text-sm font-semibold text-paper transition hover:bg-[#143125]">Cari</button>
                </form>
            </section>

            <section class="mt-8">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[860px] text-left text-sm">
                        <thead>
                            <tr class="border-b border-[#DAD6C9]">
                                <th class="py-3 pr-4 text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Tanggal</th>
                                <th class="px-4 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Saham</th>
                                <th class="px-4 py-3 text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Tipe</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Lot</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Harga</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Total</th>
                                <th class="py-3 pl-4 text-right text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#E4DFD2]">
                            @forelse ($transactions as $trx)
                                <tr>
                                    <td class="py-4 pr-4 text-[#3D3C36]">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="h-8 w-[3px] rounded-full {{ $trx->type == 'buy' ? 'bg-[#476B4E]' : 'bg-[#9A5A46]' }}"></span>
                                            <span class="font-mono font-semibold text-ink">{{ $trx->stock->code }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="text-sm font-medium {{ $trx->type == 'buy' ? 'text-[#476B4E]' : 'text-[#9A5A46]' }}">
                                            {{ $trx->type == 'buy' ? 'Beli' : 'Jual' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-right font-mono text-[#3D3C36]">{{ $trx->lot }}</td>
                                    <td class="px-4 py-4 text-right font-mono text-[#3D3C36]">{{ number_format($trx->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-4 text-right font-mono font-semibold text-ink">{{ number_format($trx->price * $trx->lot * 100, 0, ',', '.') }}</td>
                                    <td class="py-4 pl-4 text-right">
                                        <a href="{{ route('transactions.edit', $trx) }}" class="text-sm font-medium text-[#476B4E] hover:text-ink">Edit</a>
                                        <form action="{{ route('transactions.destroy', $trx) }}" method="POST" class="ml-4 inline" onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-medium text-[#9A5A46] hover:text-ink">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-10 text-center text-sm text-[#6B6A61]">Belum ada transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $transactions->links() }}
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
