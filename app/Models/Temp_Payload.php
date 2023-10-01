<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_Payload extends Model
{
    use HasFactory;
    protected $table = 'temp_payload';
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
