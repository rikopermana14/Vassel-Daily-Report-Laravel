<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_Status extends Model
{
    use HasFactory;
    protected $table = 'stock_status';
    protected $primaryKey = "id";
    protected $fillable = [
        'tanggal',
        'product_id',
        'name',
        'spec',
        'previous',
        'receive',
        'use',
        'transfer',
        'soud',
        'remain',
    ];
}
