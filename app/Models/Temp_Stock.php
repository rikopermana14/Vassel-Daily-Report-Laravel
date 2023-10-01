<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_Stock extends Model
{
    use HasFactory;
    protected $table = 'temp_stock';
    protected $primaryKey = "id";
    protected $fillable = [
        'date',
        'code_product',
        'name_product',
        'spec'  ,
        'previous',  
        'received'  ,
        'used'  ,
        'transfered'  ,
        'sounding'  ,
        'remain'  ,
        'user_input',
    ];
}
