<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Catatan keputusan</p>
            <h2 class="font-display text-3xl font-medium text-ink">
                Tulis Jurnal Baru
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

            @if ($transactions->isEmpty())
                <div class="border-t border-[#DAD6C9] pt-8">
                    <p class="max-w-xl text-sm leading-6 text-[#6B6A61]">
                        Semua transaksi kamu sudah punya jurnal, atau kamu belum punya transaksi sama sekali.
                        <a href="{{ route('transactions.create') }}" class="font-semibold text-[#476B4E] hover:text-ink">Catat transaksi baru dulu.</a>
                    </p>
                </div>
            @else
                <form method="POST" action="{{ route('journals.store') }}" class="space-y-6 border-t border-[#DAD6C9] pt-8">
                    @csrf

                    <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                        <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Pilih transaksi</label>
                        <select name="transaction_id" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink focus:border-ink focus:ring-ink">
                            <option value="">Pilih transaksi</option>
                            @foreach ($transactions as $trx)
                                <option value="{{ $trx->id }}" {{ old('transaction_id') == $trx->id ? 'selected' : '' }}>
                                    {{ $trx->stock->code }} - {{ $trx->type == 'buy' ? 'Beli' : 'Jual' }} - {{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                        <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Catatan analisis</label>
                        <textarea name="notes" rows="8" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-[15px] leading-7 text-ink placeholder:text-[#9A9485] focus:border-ink focus:ring-ink" style="font-family: Georgia, serif;" placeholder="Kenapa kamu ambil keputusan ini?">{{ old('notes') }}</textarea>
                    </div>

                    <div class="flex flex-col gap-3 border-t border-[#DAD6C9] pt-6 sm:flex-row sm:justify-end">
                        <a href="{{ route('journals.index') }}" class="rounded border border-[#CFC8B8] px-4 py-2 text-center text-sm font-semibold text-[#3D3C36] transition hover:border-ink hover:text-ink">Batal</a>
                        <button type="submit" class="rounded bg-ink px-4 py-2 text-sm font-semibold text-paper transition hover:bg-[#143125]">Simpan jurnal</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
