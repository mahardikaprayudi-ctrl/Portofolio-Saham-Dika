<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Ledger transaksi</p>
            <h2 class="font-display text-3xl font-medium text-ink">
                Edit Transaksi
            </h2>
        </div>
    </x-slot>

    <div class="bg-paper py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-6 border-l-4 border-[#9A5A46] bg-[#F4E8E1] px-4 py-3 text-sm text-[#7F4A39]">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('transactions.update', $transaction) }}" class="space-y-6 border-t border-[#DAD6C9] pt-8">
                @csrf
                @method('PUT')

                <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                    <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Saham</label>
                    <select name="stock_id" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink focus:border-ink focus:ring-ink">
                        @foreach ($stocks as $stock)
                            <option value="{{ $stock->id }}" {{ old('stock_id', $transaction->stock_id) == $stock->id ? 'selected' : '' }}>
                                {{ $stock->code }} - {{ $stock->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                    <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Tipe transaksi</label>
                    <select name="type" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink focus:border-ink focus:ring-ink">
                        <option value="buy" {{ old('type', $transaction->type) == 'buy' ? 'selected' : '' }}>Beli</option>
                        <option value="sell" {{ old('type', $transaction->type) == 'sell' ? 'selected' : '' }}>Jual</option>
                    </select>
                </div>

                <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                    <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Jumlah lot</label>
                    <input type="number" name="lot" value="{{ old('lot', $transaction->lot) }}" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 font-mono text-sm text-ink focus:border-ink focus:ring-ink">
                </div>

                <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                    <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Harga per lembar</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $transaction->price) }}" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 font-mono text-sm text-ink focus:border-ink focus:ring-ink">
                </div>

                <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                    <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Tanggal transaksi</label>
                    <input type="date" name="transaction_date" value="{{ old('transaction_date', \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d')) }}" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 font-mono text-sm text-ink focus:border-ink focus:ring-ink">
                </div>

                <div class="flex flex-col gap-3 border-t border-[#DAD6C9] pt-6 sm:flex-row sm:justify-end">
                    <a href="{{ route('transactions.index') }}" class="rounded border border-[#CFC8B8] px-4 py-2 text-center text-sm font-semibold text-[#3D3C36] transition hover:border-ink hover:text-ink">Batal</a>
                    <button type="submit" class="rounded bg-ink px-4 py-2 text-sm font-semibold text-paper transition hover:bg-[#143125]">Update transaksi</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
