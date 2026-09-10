<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            return $this->adminDashboard();
        }

        return $this->userDashboard();
    }

        private function adminDashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalStocks = Stock::count();
        $totalTransactions = Transaction::count();

        $recentStocks = Stock::latest('updated_at')->take(5)->get();

        $recentTransactions = Transaction::with(['stock', 'user'])
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('dashboard', compact('totalUsers', 'totalStocks', 'totalTransactions', 'recentStocks', 'recentTransactions'));
    }

    private function userDashboard()
    {
        $transactions = Transaction::where('user_id', auth()->id())->with('stock')->get();

        $portfolio = [];

        foreach ($transactions as $trx) {
            $code = $trx->stock->code;

            if (!isset($portfolio[$code])) {
                $portfolio[$code] = [
                    'name' => $trx->stock->name,
                    'lot' => 0,
                    'total_cost' => 0,
                ];
            }

            if ($trx->type === 'buy') {
                $portfolio[$code]['lot'] += $trx->lot;
                $portfolio[$code]['total_cost'] += $trx->lot * $trx->price * 100;
            } else {
                $portfolio[$code]['lot'] -= $trx->lot;
                $portfolio[$code]['total_cost'] -= $trx->lot * $trx->price * 100;
            }
        }

        $portfolio = array_filter($portfolio, fn ($item) => $item['lot'] > 0);

        foreach ($portfolio as $code => &$item) {
            $item['avg_price'] = $item['lot'] > 0 ? $item['total_cost'] / ($item['lot'] * 100) : 0;
            $stock = Stock::where('code', $code)->first();
            $item['current_price'] = $stock->reference_price ?? 0;
            $item['current_value'] = $item['lot'] * 100 * $item['current_price'];
            $item['profit_loss'] = $item['current_value'] - $item['total_cost'];
            $item['profit_loss_percent'] = $item['total_cost'] > 0 ? ($item['profit_loss'] / $item['total_cost']) * 100 : 0;
        }

        $totalValue = array_sum(array_column($portfolio, 'current_value'));
        $totalProfitLoss = array_sum(array_column($portfolio, 'profit_loss'));
        $totalStocksOwned = count($portfolio);

        return view('dashboard', compact('portfolio', 'totalValue', 'totalProfitLoss', 'totalStocksOwned'));
    }
}