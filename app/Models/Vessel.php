<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    use HasFactory;
    protected $table = 'vessels';
    protected $primaryKey = "id";
    protected $fillable = [
        'vessel_id',
        'vessel_name',
        'email',
        'vessel_type',
        'builder',
        'class',
        'call_sign',
        'length_perpendicular',
        'depth_moulded',
        'gross_tonage',
        'cost_center',
        'work_place',
        'clear_deck_area',
        'other_spesification',
        'avaliable',
        'vessel_alias',
        'country_flag',
        'year_built',
        'official_number',
        'lenght_overall',
        'breadth_mouled',
        'draft_final',
        'netto_tonnage',
        'owner',
        'main_engine_fuel_oil_consumption',
        'auxilary_engine_fuel_oil_consumption',
        'fuel_oil_consumption_maximum',
        'fuel_oil_consumption_economic',
        'type_of_fuel',
        'maximum_speed',
        'economic_speed',
        'minimum_speed',
        'horse_power',
    ];

    // protected static function booted()
    // {
    //     static::creating(function ($vessel) {
    //         $vessel->id = 'VSL' . static::generateId();
    //     });
    // }

    // private static function generateId()
    // {
    //     // Mendapatkan ID terakhir yang disimpan dalam database
    //     $lastId = static::latest('id')->value('id');

    //     // Jika tidak ada data sebelumnya atau format ID tidak sesuai, mulai dari 1
    //     if (!$lastId || !preg_match('/^VSL(\d+)$/', $lastId, $matches)) {
    //         return 1;
    //     }

    //     // Dapatkan angka dari ID terakhir dan tambahkan 1
    //     $number = (int)$matches[1] + 1;

    //     // Format ulang ID dengan awalan "VSL" dan tambahkan angka nol di depan jika kurang dari 4 digit
    //     return 'VSL' . str_pad($number, 4, '0', STR_PAD_LEFT);
    // }
}
