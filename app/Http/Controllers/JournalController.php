<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Transaction;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::whereHas('transaction', function ($q) {
            $q->where('user_id', auth()->id());
        })->with('transaction.stock')->latest()->paginate(10);

        return view('journals.index', compact('journals'));
    }

    public function create(Request $request)
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->whereDoesntHave('journal')
            ->with('stock')
            ->latest('transaction_date')
            ->get();

        return view('journals.create', compact('transactions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'notes' => 'required|string',
        ]);

        $transaction = Transaction::findOrFail($validated['transaction_id']);
        abort_if($transaction->user_id !== auth()->id(), 403);

        Journal::create($validated);

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil dicatat.');
    }

    public function edit(Journal $journal)
    {
        abort_if($journal->transaction->user_id !== auth()->id(), 403);

        return view('journals.edit', compact('journal'));
    }

    public function update(Request $request, Journal $journal)
    {
        abort_if($journal->transaction->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'notes' => 'required|string',
        ]);

        $journal->update($validated);
    
        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil diperbarui.');
    }

    public function destroy(Journal $journal)
    {
        abort_if($journal->transaction->user_id !== auth()->id(), 403);

        $journal->delete();

        return redirect()->route('journals.index')->with('success', 'Jurnal berhasil dihapus.');
    }
}