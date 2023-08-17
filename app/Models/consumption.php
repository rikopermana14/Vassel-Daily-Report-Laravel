<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consumption extends Model
{
    use HasFactory;
    protected $table = 'consumption';
    protected $primaryKey = "id";
    protected $fillable = [
        'date',
        'machine',
        'code_product',
        'name_product',
        'description',
        'used',
    ];
}
