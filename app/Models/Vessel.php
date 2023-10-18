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
        'id_user',
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

    public function products()
{
    return $this->hasMany(Product::class, 'id_user', 'id_user');
}
}
