<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tulis Jurnal Baru
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

                @if ($transactions->isEmpty())
                    <p class="text-gray-500">
                        Semua transaksi kamu sudah punya jurnal, atau kamu belum punya transaksi sama sekali.
                        <a href="{{ route('transactions.create') }}" class="text-blue-600">Catat transaksi baru dulu.</a>
                    </p>
                @else
                    <form method="POST" action="{{ route('journals.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Pilih Transaksi</label>
                            <select name="transaction_id" class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Transaksi --</option>
                                @foreach ($transactions as $trx)
                                    <option value="{{ $trx->id }}" {{ old('transaction_id') == $trx->id ? 'selected' : '' }}>
                                        {{ $trx->stock->code }} - {{ $trx->type == 'buy' ? 'Beli' : 'Jual' }} - {{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Catatan Analisis</label>
                            <textarea name="notes" rows="5" class="w-full border rounded px-3 py-2" placeholder="Kenapa kamu ambil keputusan ini?">{{ old('notes') }}</textarea>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                            <a href="{{ route('journals.index') }}" class="bg-gray-200 px-4 py-2 rounded">Batal</a>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>