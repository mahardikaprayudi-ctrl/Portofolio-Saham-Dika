<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Ringkasan kerja</p>
            <h2 class="font-display text-3xl font-medium text-ink">
                Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="bg-paper py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if (auth()->user()->role === 'admin')
                <section class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
                    <div class="border-b border-[#DAD6C9] pb-8 lg:border-b-0 lg:border-r lg:pr-10">
                        <p class="text-sm font-medium text-[#6B6A61]">Total data transaksi seluruh user</p>
                        <p class="mt-3 font-mono text-5xl font-semibold text-ink sm:text-6xl">{{ $totalTransactions }}</p>
                        <div class="mt-8 grid grid-cols-2 gap-x-8 gap-y-5">
                            <div>
                                <p class="text-xs uppercase tracking-[0.16em] text-[#807B6D]">User aktif</p>
                                <p class="mt-2 font-mono text-2xl font-medium text-ink">{{ $totalUsers }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase tracking-[0.16em] text-[#807B6D]">Master saham</p>
                                <p class="mt-2 font-mono text-2xl font-medium text-ink">{{ $totalStocks }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="lg:pl-2">
                        <p class="font-display text-xl font-medium text-ink">Kondisi data</p>
                        <p class="mt-3 max-w-sm text-sm leading-6 text-[#6B6A61]">
                            Panel admin dibuat untuk memeriksa kelengkapan master saham dan aktivitas pencatatan, bukan untuk membuka aksi yang sudah tersedia di halaman master.
                        </p>
                    </div>
                </section>

                <section class="mt-12 grid gap-10 lg:grid-cols-[0.9fr_1.1fr]">
                    <div>
                        <div class="flex items-end justify-between border-b border-[#DAD6C9] pb-3">
                            <h3 class="font-display text-xl font-medium text-ink">Saham Baru Diupdate</h3>
                            <span class="text-xs uppercase tracking-[0.16em] text-[#807B6D]">Master</span>
                        </div>

                        <div class="divide-y divide-[#E4DFD2]">
                            @forelse ($recentStocks as $stock)
                                <div class="grid grid-cols-[1fr_auto] gap-4 py-4">
                                    <div>
                                        <p class="font-mono text-sm font-semibold text-ink">{{ $stock->code }}</p>
                                        <p class="mt-1 text-sm text-[#6B6A61]">{{ $stock->name }}</p>
                                    </div>
                                    <p class="self-center font-mono text-sm font-medium text-ink">Rp {{ number_format($stock->reference_price, 0, ',', '.') }}</p>
                                </div>
                            @empty
                                <p class="py-6 text-sm text-[#6B6A61]">Belum ada data saham.</p>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <div class="flex items-end justify-between border-b border-[#DAD6C9] pb-3">
                            <h3 class="font-display text-xl font-medium text-ink">Aktivitas Transaksi Terbaru</h3>
                            <span class="text-xs uppercase tracking-[0.16em] text-[#807B6D]">Semua user</span>
                        </div>

                        <div class="divide-y divide-[#E4DFD2]">
                            @forelse ($recentTransactions as $trx)
                                <div class="grid grid-cols-[1fr_auto] gap-4 py-4">
                                    <div>
                                        <p class="font-mono text-sm font-semibold text-ink">{{ $trx->stock->code }}</p>
                                        <p class="mt-1 text-sm text-[#6B6A61]">{{ $trx->user->name }} · {{ $trx->type == 'buy' ? 'Beli' : 'Jual' }}</p>
                                    </div>
                                    <p class="self-center text-sm text-[#6B6A61]">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}</p>
                                </div>
                            @empty
                                <p class="py-6 text-sm text-[#6B6A61]">Belum ada transaksi.</p>
                            @endforelse
                        </div>
                    </div>
                </section>
            @else
                <section class="grid gap-8 lg:grid-cols-[1.3fr_0.7fr]">
                    <div class="border-b border-[#DAD6C9] pb-8 lg:border-b-0 lg:border-r lg:pr-10">
                        <p class="text-sm font-medium text-[#6B6A61]">Total nilai portofolio</p>
                        <p class="mt-3 font-mono text-4xl font-semibold text-ink sm:text-6xl">Rp {{ number_format($totalValue, 0, ',', '.') }}</p>
                        <p class="mt-5 max-w-2xl text-sm leading-6 text-[#6B6A61]">
                            Nilai utama diberi ruang besar agar fokus tetap pada posisi keseluruhan, sementara detail lain dibaca sebagai catatan pendukung.
                        </p>
                    </div>

                    <div class="grid content-start gap-6">
                        <div>
                            <p class="text-xs uppercase tracking-[0.16em] text-[#807B6D]">Profit / loss</p>
                            <p class="mt-2 font-mono text-3xl font-semibold {{ $totalProfitLoss >= 0 ? 'text-[#476B4E]' : 'text-[#9A5A46]' }}">
                                {{ $totalProfitLoss >= 0 ? '+' : '' }}Rp {{ number_format($totalProfitLoss, 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.16em] text-[#807B6D]">Saham dimiliki</p>
                            <p class="mt-2 font-mono text-3xl font-semibold text-ink">{{ $totalStocksOwned }}</p>
                        </div>
                    </div>
                </section>

                <section class="mt-12">
                    <div class="flex items-end justify-between border-b border-[#DAD6C9] pb-3">
                        <h3 class="font-display text-2xl font-medium text-ink">Kepemilikan Saham</h3>
                        <span class="text-xs uppercase tracking-[0.16em] text-[#807B6D]">Ledger posisi</span>
                    </div>

                    @if (count($portfolio) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-[760px] text-left text-sm">
                                <thead>
                                    <tr class="border-b border-[#DAD6C9]">
                                        <th class="py-3 pr-4 text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Saham</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Lot</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Avg. harga</th>
                                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Harga sekarang</th>
                                        <th class="py-3 pl-4 text-right text-xs font-semibold uppercase tracking-[0.12em] text-[#807B6D]">Profit/loss</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#E4DFD2]">
                                    @foreach ($portfolio as $code => $item)
                                        <tr>
                                            <td class="py-4 pr-4">
                                                <div class="flex items-center gap-3">
                                                    <span class="h-8 w-[3px] rounded-full {{ $item['profit_loss'] >= 0 ? 'bg-[#476B4E]' : 'bg-[#9A5A46]' }}"></span>
                                                    <span>
                                                        <span class="block font-mono font-semibold text-ink">{{ $code }}</span>
                                                        <span class="block text-xs text-[#6B6A61]">{{ $item['name'] }}</span>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-right font-mono text-[#3D3C36]">{{ $item['lot'] }}</td>
                                            <td class="px-4 py-4 text-right font-mono text-[#3D3C36]">{{ number_format($item['avg_price'], 0, ',', '.') }}</td>
                                            <td class="px-4 py-4 text-right font-mono text-[#3D3C36]">{{ number_format($item['current_price'], 0, ',', '.') }}</td>
                                            <td class="py-4 pl-4 text-right font-mono font-semibold {{ $item['profit_loss'] >= 0 ? 'text-[#476B4E]' : 'text-[#9A5A46]' }}">
                                                {{ $item['profit_loss'] >= 0 ? '+' : '' }}{{ number_format($item['profit_loss_percent'], 1) }}%
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="py-8 text-sm text-[#6B6A61]">Kamu belum punya saham. Mulai dari halaman transaksi untuk mencatat posisi pertama.</p>
                    @endif
                </section>
            @endif
        </div>
    </div>
</x-app-layout>
