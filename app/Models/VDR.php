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
            'tanggal',
            'vessel_group',
            'general_position',
            'master_name',
            'time_zone',
            'longtuide',
            'scale_sea',
            'wind',
            'weather',
            'tempratur',
            'destination',
            'eta',
            'distance_run',
            'total_distance',
            'time_run',
            'total_time',
            'avarage_speed',
            'general_avarage_speed',
            'visibility_scale',
            'scale_of_wind_force',
            'barometer',
            'vessel_course',
            'distance_to_go',
            'towage_operation',
            'size_grt',
            'vessel_status',
            'id_daily_activities',
            'id_running_hours',
            'id_consumption',
            'id_muaatan',
    ];
}
