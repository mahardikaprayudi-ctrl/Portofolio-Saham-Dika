<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'notes',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}