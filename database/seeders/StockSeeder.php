<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $stocks = [
            ['code' => 'BBCA', 'name' => 'Bank Central Asia', 'sector' => 'Perbankan', 'reference_price' => 9800],
            ['code' => 'TLKM', 'name' => 'Telkom Indonesia', 'sector' => 'Telekomunikasi', 'reference_price' => 3150],
            ['code' => 'ASII', 'name' => 'Astra International', 'sector' => 'Otomotif', 'reference_price' => 5200],
            ['code' => 'UNVR', 'name' => 'Unilever Indonesia', 'sector' => 'Consumer Goods', 'reference_price' => 2800],
            ['code' => 'BMRI', 'name' => 'Bank Mandiri', 'sector' => 'Perbankan', 'reference_price' => 6100],
        ];

        foreach ($stocks as $stock) {
            Stock::updateOrCreate(['code' => $stock['code']], $stock);
        }
    }
}