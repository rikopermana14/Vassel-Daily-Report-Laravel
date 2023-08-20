<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_Muatan extends Model
{
    use HasFactory;
    protected $table = 'temp_muatan';
    protected $primaryKey = "id";
    protected $fillable = [
        'date',
        'product_name',
        'previous',
        'receive',
        'transfer',
        'remain',
        'user_input',
    ];
}
