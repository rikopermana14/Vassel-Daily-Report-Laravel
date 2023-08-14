<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VDR extends Model
{
    use HasFactory;
    protected $table = 'vdr';
    protected $primaryKey = "id";
    protected $fillable = [
            'id_general_info',
            'id_daily_activities',
            'id_running_hours',
            'id_consumption',
            'id_muaatan',
    ];
}
