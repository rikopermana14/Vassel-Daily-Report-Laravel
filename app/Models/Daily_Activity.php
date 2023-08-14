<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily_Activity extends Model
{
    use HasFactory;
    protected $table = 'daily_activitiy';
    protected $primaryKey = "id";
    protected $fillable = [
        'tanggal',
        'time_from',
        'time_to',
        'description',
    ];
}
