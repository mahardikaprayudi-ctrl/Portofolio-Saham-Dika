<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Saham
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

                <form method="POST" action="{{ route('stocks.update', $stock) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Kode Saham</label>
                        <input type="text" name="code" value="{{ old('code', $stock->code) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Nama Emiten</label>
                        <input type="text" name="name" value="{{ old('name', $stock->name) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Sektor</label>
                        <input type="text" name="sector" value="{{ old('sector', $stock->sector) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Harga Acuan</label>
                        <input type="number" step="0.01" name="reference_price" value="{{ old('reference_price', $stock->reference_price) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
                        <a href="{{ route('stocks.index') }}" class="bg-gray-200 px-4 py-2 rounded">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>