<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_consumption extends Model
{
    use HasFactory;
    protected $table = 'temp_consumptions';
    protected $primaryKey = "id";
    protected $fillable = [
        'date',
        'machine',
        'code_product',
        'name_product',
        'description',
        'used',
        'user_input',
    ];
}
