<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Master Saham
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
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama..." class="border rounded px-3 py-2 text-sm">
                        <select name="sector" class="border rounded px-3 py-2 text-sm">
                            <option value="">Semua Sektor</option>
                            @foreach ($stocks->pluck('sector')->unique()->filter() as $sector)
                                <option value="{{ $sector }}" {{ request('sector') == $sector ? 'selected' : '' }}>{{ $sector }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded text-sm">Filter</button>
                    </form>

                    <a href="{{ route('stocks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                        + Tambah Saham
                    </a>
                </div>

                <table class="w-full text-sm text-left border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">Kode</th>
                            <th class="p-3">Nama Emiten</th>
                            <th class="p-3">Sektor</th>
                            <th class="p-3">Harga Acuan</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stocks as $stock)
                            <tr class="border-t">
                                <td class="p-3 font-semibold">{{ $stock->code }}</td>
                                <td class="p-3">{{ $stock->name }}</td>
                                <td class="p-3">{{ $stock->sector ?? '-' }}</td>
                                <td class="p-3">Rp {{ number_format($stock->reference_price, 0, ',', '.') }}</td>
                                <td class="p-3">
                                    <a href="{{ route('stocks.edit', $stock) }}" class="text-blue-600 mr-2">Edit</a>
                                    <form action="{{ route('stocks.destroy', $stock) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus saham ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-3 text-center text-gray-500">Belum ada data saham.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $stocks->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>