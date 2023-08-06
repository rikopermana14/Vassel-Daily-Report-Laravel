<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Running_hours extends Model
{
    use HasFactory;
    protected $table = 'running_hours';
    protected $primaryKey = "id";
    protected $fillable = [
        'tanggal',
        'machine',
        'towing',
        'manouver',
        'slow',
        'economi',
        'full_speed',
        'standby',
    ];
}
