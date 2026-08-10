<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Jurnal
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

                <div class="mb-4 p-3 bg-gray-100 rounded text-sm text-gray-600">
                    <strong>{{ $journal->transaction->stock->code }}</strong>
                    · {{ $journal->transaction->type == 'buy' ? 'Beli' : 'Jual' }}
                    · {{ \Carbon\Carbon::parse($journal->transaction->transaction_date)->format('d M Y') }}
                </div>

                <form method="POST" action="{{ route('journals.update', $journal) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Catatan Analisis</label>
                        <textarea name="notes" rows="5" class="w-full border rounded px-3 py-2">{{ old('notes', $journal->notes) }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                        <a href="{{ route('journals.index') }}" class="bg-gray-200 px-4 py-2 rounded">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>