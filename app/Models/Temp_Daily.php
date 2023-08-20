<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_Daily extends Model
{
    use HasFactory;
    protected $table = 'temp_daily';
    protected $primaryKey = "id";
    protected $fillable = [
        'date',
        'time_from',
        'time_to',
        'description',
        'user_input',
        'id_vdr',
    ];
}
