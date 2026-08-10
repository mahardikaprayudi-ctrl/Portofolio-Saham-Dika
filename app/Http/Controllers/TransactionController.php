<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Stock;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::where('user_id', auth()->id())->with('stock');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('stock', function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        $transactions = $query->latest('transaction_date')->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $stocks = Stock::orderBy('code')->get();
        return view('transactions.create', compact('stocks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'type' => 'required|in:buy,sell',
            'lot' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        $validated['user_id'] = auth()->id();

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dicatat.');
    }

    public function edit(Transaction $transaction)
    {
        abort_if($transaction->user_id !== auth()->id(), 403);

        $stocks = Stock::orderBy('code')->get();
        return view('transactions.edit', compact('transaction', 'stocks'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'type' => 'required|in:buy,sell',
            'lot' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        abort_if($transaction->user_id !== auth()->id(), 403);

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}