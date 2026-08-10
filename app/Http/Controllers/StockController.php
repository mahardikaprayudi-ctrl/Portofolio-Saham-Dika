<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $query = Stock::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sector')) {
            $query->where('sector', $request->sector);
        }

        $stocks = $query->latest()->paginate(10);

        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        return view('stocks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:stocks,code',
            'name' => 'required|string|max:255',
            'sector' => 'nullable|string|max:255',
            'reference_price' => 'required|numeric|min:0',
        ]);

        Stock::create($validated);

        return redirect()->route('stocks.index')->with('success', 'Saham berhasil ditambahkan.');
    }

    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:stocks,code,' . $stock->id,
            'name' => 'required|string|max:255',
            'sector' => 'nullable|string|max:255',
            'reference_price' => 'required|numeric|min:0',
        ]);

        $stock->update($validated);

        return redirect()->route('stocks.index')->with('success', 'Saham berhasil diperbarui.');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()->route('stocks.index')->with('success', 'Saham berhasil dihapus.');
    }

    public function updatePrices()
    {
        $stocks = Stock::all();
        $updated = 0;
        $failed = [];

        foreach ($stocks as $stock) {
            try {
                $response = \Illuminate\Support\Facades\Http::timeout(5)
                    ->get("https://query1.finance.yahoo.com/v8/finance/chart/{$stock->code}.JK");

                $price = $response->json('chart.result.0.meta.regularMarketPrice');

                if ($price) {
                    $stock->update(['reference_price' => $price]);
                    $updated++;
                } else {
                    $failed[] = $stock->code;
                }
            } catch (\Exception $e) {
                $failed[] = $stock->code;
            }
        }

        $message = "{$updated} saham berhasil diupdate.";
        if (count($failed) > 0) {
            $message .= ' Gagal: ' . implode(', ', $failed);
        }

        return redirect()->route('stocks.index')->with('success', $message);
    }
}