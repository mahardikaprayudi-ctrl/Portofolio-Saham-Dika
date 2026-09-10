<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Catatan keputusan</p>
                <h2 class="font-display text-3xl font-medium text-ink">
                    Jurnal Investasi
                </h2>
            </div>
            <a href="{{ route('journals.create') }}" class="inline-flex w-fit items-center rounded bg-gold px-4 py-2 text-sm font-semibold text-ink transition hover:bg-[#B8923D]">
                Tulis jurnal
            </a>
        </div>
    </x-slot>

    <div class="bg-paper py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 border-l-4 border-[#476B4E] bg-[#EEF2E7] px-4 py-3 text-sm text-[#3F5F45]">
                    {{ session('success') }}
                </div>
            @endif

            <section class="border-t border-[#DAD6C9]">
                @forelse ($journals as $journal)
                    <article class="grid gap-4 border-b border-[#E4DFD2] py-6 md:grid-cols-[180px_1fr_auto]">
                        <div>
                            <p class="font-mono text-base font-semibold text-ink">{{ $journal->transaction->stock->code }}</p>
                            <p class="mt-1 text-sm text-[#6B6A61]">{{ \Carbon\Carbon::parse($journal->transaction->transaction_date)->format('d M Y') }}</p>
                            <p class="mt-2 text-sm font-medium {{ $journal->transaction->type == 'buy' ? 'text-[#476B4E]' : 'text-[#9A5A46]' }}">
                                {{ $journal->transaction->type == 'buy' ? 'Beli' : 'Jual' }}
                            </p>
                        </div>

                        <p class="max-w-2xl text-[15px] leading-7 text-[#3D3C36]" style="font-family: Georgia, serif;">
                            {{ $journal->notes }}
                        </p>

                        <div class="flex gap-4 md:justify-end">
                            <a href="{{ route('journals.edit', $journal) }}" class="text-sm font-medium text-[#476B4E] hover:text-ink">Edit</a>
                            <form action="{{ route('journals.destroy', $journal) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus jurnal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-medium text-[#9A5A46] hover:text-ink">Hapus</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <p class="border-b border-[#E4DFD2] py-10 text-center text-sm text-[#6B6A61]">Belum ada jurnal. Mulai catat analisis investasi kamu.</p>
                @endforelse
            </section>

            <div class="mt-6">
                {{ $journals->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
