<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Transaksi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('transactions.update', $transaction) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Saham</label>
                        <select name="stock_id" class="w-full border rounded px-3 py-2">
                            @foreach ($stocks as $stock)
                                <option value="{{ $stock->id }}" {{ old('stock_id', $transaction->stock_id) == $stock->id ? 'selected' : '' }}>
                                    {{ $stock->code }} - {{ $stock->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Tipe Transaksi</label>
                        <select name="type" class="w-full border rounded px-3 py-2">
                            <option value="buy" {{ old('type', $transaction->type) == 'buy' ? 'selected' : '' }}>Beli</option>
                            <option value="sell" {{ old('type', $transaction->type) == 'sell' ? 'selected' : '' }}>Jual</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Jumlah Lot</label>
                        <input type="number" name="lot" value="{{ old('lot', $transaction->lot) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Harga per Lembar</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $transaction->price) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Tanggal Transaksi</label>
                        <input type="date" name="transaction_date" value="{{ old('transaction_date', \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                        <a href="{{ route('transactions.index') }}" class="bg-gray-200 px-4 py-2 rounded">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>