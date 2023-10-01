<?php

namespace App\Http\Controllers;

use App\Models\consumption;
use App\Models\Daily_Activity;
use Illuminate\Http\Request;
use App\Models\VDR;
use App\Models\Payload;
use App\Models\Product;
use App\Models\Running_hours;
use App\Models\Stock_Status;
use App\Models\Temp_Daily;
use App\Models\Temp_consumption;
use App\Models\Temp_Payload;
use App\Models\Temp_Running;
use App\Models\Temp_Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
        public function report()
    {   
        $getbooking = vdr::join('daily_activitiy', 'vdr.id_daily', '=', 'daily_activitiy.id_vdr')
        ->join('consumption', 'vdr.id_consumption', '=', 'consumption.id_vdr')
        ->join('payload', 'vdr.id_payload', '=', 'payload.id_vdr')
        ->join('stock_status', 'vdr.id_stock_status', '=', 'stock_status.id_vdr')
        ->join('running_hours', 'vdr.id_running_hours', '=', 'running_hours.id_vdr')
        ->select('vdr.*', 'daily_activitiy.date as date','daily_activitiy.time_from as time_from', 'daily_activitiy.time_to as time_to','daily_activitiy.description as description',
        'consumption.date as datecon','consumption.machine as machine','consumption.code_product as con_code','consumption.name_product as con_name','consumption.description as con_desc','consumption.used as con_used',
        'payload.date as date_pay','payload.product_name as name','payload.previous as previous','payload.receive as receive','payload.transfer as transfer','payload.remain as remain',
        'stock_status.code_product as stock_code','stock_status.name_product as stock_name','stock_status.spec as spec','stock_status.previous as previous','stock_status.received as received','stock_status.used as use','stock_status.transfered as transfered','stock_status.sounding as sounding','stock_status.remain as remain',
        'running_hours.machine as mac','running_hours.towing as towing','running_hours.manouver as manouver','running_hours.slow as slow','running_hours.economi as economi','running_hours.full_speed as full_speed','running_hours.standby as standby',
        )
        ->latest('vdr.id')
        ->get();
        return view('report.report', compact('getbooking'));
    }

}