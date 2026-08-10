<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Jurnal Investasi
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

                <div class="flex justify-end mb-4">
                    <a href="{{ route('journals.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">
                        + Tulis Jurnal
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse ($journals as $journal)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <span class="font-semibold">{{ $journal->transaction->stock->code }}</span>
                                    <span class="text-gray-500 text-sm">
                                        · {{ \Carbon\Carbon::parse($journal->transaction->transaction_date)->format('d M Y') }}
                                        · {{ $journal->transaction->type == 'buy' ? 'Beli' : 'Jual' }}
                                    </span>
                                </div>
                                <div>
                                    <a href="{{ route('journals.edit', $journal) }}" class="text-blue-600 text-sm mr-2">Edit</a>
                                    <form action="{{ route('journals.destroy', $journal) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus jurnal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 text-sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-gray-700 text-sm">{{ $journal->notes }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">Belum ada jurnal. Yuk mulai catat analisis investasi kamu!</p>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $journals->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>