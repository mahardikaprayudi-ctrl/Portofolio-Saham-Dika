<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaksi Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <form method="GET" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode/nama saham..." class="border rounded px-3 py-2 text-sm">
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded text-sm">Cari</button>
                    </form>

                    <a href="{{ route('transactions.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                        + Transaksi Baru
                    </a>
                </div>

                <table class="w-full text-sm text-left border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Saham</th>
                            <th class="p-3">Tipe</th>
                            <th class="p-3">Lot</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3">Total</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $trx)
                            <tr class="border-t">
                                <td class="p-3">{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}</td>
                                <td class="p-3 font-semibold">{{ $trx->stock->code }}</td>
                                <td class="p-3">
                                    @if ($trx->type == 'buy')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Beli</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Jual</span>
                                    @endif
                                </td>
                                <td class="p-3">{{ $trx->lot }}</td>
                                <td class="p-3">Rp {{ number_format($trx->price, 0, ',', '.') }}</td>
                                <td class="p-3">Rp {{ number_format($trx->price * $trx->lot * 100, 0, ',', '.') }}</td>
                                <td class="p-3">
                                    <a href="{{ route('transactions.edit', $trx) }}" class="text-blue-600 mr-2">Edit</a>
                                    <form action="{{ route('transactions.destroy', $trx) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-3 text-center text-gray-500">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>