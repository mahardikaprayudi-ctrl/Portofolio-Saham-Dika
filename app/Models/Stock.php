<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'sector',
        'reference_price',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}