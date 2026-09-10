<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Catatan keputusan</p>
            <h2 class="font-display text-3xl font-medium text-ink">
                Edit Jurnal
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

            <div class="grid gap-2 border-t border-[#DAD6C9] pt-8 sm:grid-cols-[180px_1fr]">
                <p class="text-sm font-semibold text-[#3D3C36]">Transaksi</p>
                <p class="text-sm text-[#6B6A61]">
                    <span class="font-mono font-semibold text-ink">{{ $journal->transaction->stock->code }}</span>
                    · <span class="{{ $journal->transaction->type == 'buy' ? 'text-[#476B4E]' : 'text-[#9A5A46]' }}">{{ $journal->transaction->type == 'buy' ? 'Beli' : 'Jual' }}</span>
                    · {{ \Carbon\Carbon::parse($journal->transaction->transaction_date)->format('d M Y') }}
                </p>
            </div>

            <form method="POST" action="{{ route('journals.update', $journal) }}" class="mt-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                    <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Catatan analisis</label>
                    <textarea name="notes" rows="8" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-[15px] leading-7 text-ink focus:border-ink focus:ring-ink" style="font-family: Georgia, serif;">{{ old('notes', $journal->notes) }}</textarea>
                </div>

                <div class="flex flex-col gap-3 border-t border-[#DAD6C9] pt-6 sm:flex-row sm:justify-end">
                    <a href="{{ route('journals.index') }}" class="rounded border border-[#CFC8B8] px-4 py-2 text-center text-sm font-semibold text-[#3D3C36] transition hover:border-ink hover:text-ink">Batal</a>
                    <button type="submit" class="rounded bg-ink px-4 py-2 text-sm font-semibold text-paper transition hover:bg-[#143125]">Update jurnal</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
