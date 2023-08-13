<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryProduct extends Model
{
    protected $table = 'temporary_products'; // Menentukan nama tabel yang sesuai
    protected $fillable = [
        'product_id',
        'name',
        'spec',
        'stock',
        'image',
        'type',
        'alias',
        'unit',
        'min',
        'lead',
        'delivery',
        'idle',
        'volume',
    ];
}
