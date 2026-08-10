<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (auth()->user()->role === 'admin')
                {{-- Dashboard Admin --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-500">Total User</p>
                        <p class="text-2xl font-semibold">{{ $totalUsers }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-500">Total Saham Master</p>
                        <p class="text-2xl font-semibold">{{ $totalStocks }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-500">Total Transaksi (Semua User)</p>
                        <p class="text-2xl font-semibold">{{ $totalTransactions }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <p class="text-gray-700">Selamat datang, Admin! Kelola data master saham lewat menu <strong>Master Saham</strong> di atas.</p>
                </div>

            @else
                {{-- Dashboard User --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-500">Total Nilai Portofolio</p>
                        <p class="text-2xl font-semibold">Rp {{ number_format($totalValue, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-500">Profit / Loss</p>
                        <p class="text-2xl font-semibold {{ $totalProfitLoss >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $totalProfitLoss >= 0 ? '+' : '' }}Rp {{ number_format($totalProfitLoss, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <p class="text-sm text-gray-500">Saham Dimiliki</p>
                        <p class="text-2xl font-semibold">{{ $totalStocksOwned }}</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <p class="font-semibold mb-4">Kepemilikan Saham</p>

                    @if (count($portfolio) > 0)
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-3">Saham</th>
                                    <th class="p-3">Lot</th>
                                    <th class="p-3">Avg. Harga</th>
                                    <th class="p-3">Harga Sekarang</th>
                                    <th class="p-3">Profit/Loss</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($portfolio as $code => $item)
                                    <tr class="border-t">
                                        <td class="p-3">
                                            <span class="font-semibold">{{ $code }}</span>
                                            <span class="text-gray-500 text-xs block">{{ $item['name'] }}</span>
                                        </td>
                                        <td class="p-3">{{ $item['lot'] }}</td>
                                        <td class="p-3">Rp {{ number_format($item['avg_price'], 0, ',', '.') }}</td>
                                        <td class="p-3">Rp {{ number_format($item['current_price'], 0, ',', '.') }}</td>
                                        <td class="p-3">
                                            <span class="{{ $item['profit_loss'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $item['profit_loss'] >= 0 ? '+' : '' }}{{ number_format($item['profit_loss_percent'], 1) }}%
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">Kamu belum punya saham. Yuk mulai <a href="{{ route('transactions.create') }}" class="text-blue-600">catat transaksi</a> pertama!</p>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>