<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{
    use HasFactory;
    protected $table = 'general_info';
    protected $primaryKey = "id";
    protected $fillable = [
        'date',
        'vessel_name',
        'vessel_group',
        'general_position',
        'master_name',
        'time_zone',
        'latitude',
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
    ];
}
