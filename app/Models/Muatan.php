<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class muatan extends Model
{
    use HasFactory;
    protected $table = 'muatan';
    protected $primaryKey = "id";
    protected $fillable = [
        'tanggal',
        'product_name',
        'previous',
        'receive',
        'transfer',
        'remain',
    ];
}
