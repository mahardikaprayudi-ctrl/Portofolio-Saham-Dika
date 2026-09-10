<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-[#807B6D]">Master saham</p>
            <h2 class="font-display text-3xl font-medium text-ink">
                Edit {{ $stock->code }}
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

            <form method="POST" action="{{ route('stocks.update', $stock) }}" class="space-y-6 border-t border-[#DAD6C9] pt-8">
                @csrf
                @method('PUT')

                <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                    <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Kode saham</label>
                    <input type="text" name="code" value="{{ old('code', $stock->code) }}" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 font-mono text-sm uppercase text-ink focus:border-ink focus:ring-ink">
                </div>

                <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                    <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Nama emiten</label>
                    <input type="text" name="name" value="{{ old('name', $stock->name) }}" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink focus:border-ink focus:ring-ink">
                </div>

                <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                    <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Sektor</label>
                    <input type="text" name="sector" value="{{ old('sector', $stock->sector) }}" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 text-sm text-ink focus:border-ink focus:ring-ink">
                </div>

                <div class="grid gap-2 sm:grid-cols-[180px_1fr] sm:items-start">
                    <label class="pt-2 text-sm font-semibold text-[#3D3C36]">Harga acuan</label>
                    <input type="number" step="0.01" name="reference_price" value="{{ old('reference_price', $stock->reference_price) }}" class="rounded border-[#CFC8B8] bg-[#FBFAF6] px-3 py-2 font-mono text-sm text-ink focus:border-ink focus:ring-ink">
                </div>

                <div class="flex flex-col gap-3 border-t border-[#DAD6C9] pt-6 sm:flex-row sm:justify-end">
                    <a href="{{ route('stocks.index') }}" class="rounded border border-[#CFC8B8] px-4 py-2 text-center text-sm font-semibold text-[#3D3C36] transition hover:border-ink hover:text-ink">Batal</a>
                    <button type="submit" class="rounded bg-ink px-4 py-2 text-sm font-semibold text-paper transition hover:bg-[#143125]">Update saham</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
