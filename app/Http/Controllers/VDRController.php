<?php

namespace App\Http\Controllers;

use App\Models\consumption;
use App\Models\Daily_Activity;
use Illuminate\Http\Request;
use App\Models\GeneralInfo;
use App\Models\muatan;
use App\Models\Product;
use App\Models\Running_hours;
use App\Models\Stock_Status;
use DB;

class VDRController extends Controller
{
    public function vdr()
    {
        $stock=Stock_Status::all();
        $data=Product::all();
        return view('vdr.index', compact('data','stock'));
    }
    public function getProduct($codeproduct)
{
    $product = Product::where('product_id', $codeproduct)->first();
    return response()->json($product);
}

public function ajaxdaily(Request $request)
{
  $data = Daily_Activity::orderBy('id','desc')->get();

  $response = [
    'success' => true,
    'details' => $data,

  ];

return response()->json($response, 200);
}

public function adddaily(Request $request)
{
    $request->validate([
        'date' => 'required',
        'time_from' => 'required',
        'time_to' => 'required',
    ]);

    $userid = $request->input('user_input');

    DB::beginTransaction();
    try {
        $adddaily = Daily_Activity::create([
            'date' => $request->input('date'),
            'time_from' => $request->input('time_from'),
            'time_to' => $request->input('time_to'), // Fixed: 'time_to' value should come from 'time_to' input
            'description' => $request->input('description'),
            'user_input' => $userid,
        ]);

        DB::commit();

        $notification = [
            'message' => 'Success add Baggage Identification',
            'alert-type' => 'success'
        ];

        return response()->json($notification);
    } catch (\Throwable $e) {
        DB::rollback();
        return response()->json("GAGAL");
    }
}

    public function storegeneralinfo(Request $request)
    {
        $request->validate([
            'joined_date' => 'required',
            'distance_run' => 'required',
            'vessel_name' => 'required',
            'total_distance' => 'required',
            'vessel_group' => 'required',
            'time_run' => 'required',
            'general_position' => 'required',
            'total_time' => 'required',
            'master_name' => 'required',
            'avarage_speed' => 'required',
            'time_zone' => 'required',
            'general_avarage' => 'required',
            'latitude' => 'required',
            'visibility' => 'required',
            'longtuide' => 'required',
            'scale_wind' => 'required',
            'scale_sea' => 'required',
            'barometer' => 'required',
            'wind_direction' => 'required',
            'vessel_course' => 'required',
            'weather' => 'required',
            'distance' => 'required',
            'temperature' => 'required',
            'towage' => 'required',
            'destination' => 'required',
            'size' => 'required',
            'eta' => 'required',
            'vessel_status' => 'required',
        ]);
    
        GeneralInfo::create([
            'tanggal' => $request->input('joined_date'),
            'distance_run' => $request->input('distance_run'),
            'vessel_name' => $request->input('vessel_name'),
            'total_distance' => $request->input('total_distance'),
            'vessel_group' => $request->input('vessel_group'),
            'time_run' => $request->input('time_run'),
            'general_position' => $request->input('general_position'),
            'total_time' => $request->input('total_time'),
            'master_name' => $request->input('master_name'),
            'avarage_speed' => $request->input('avarage_speed'),
            'time_zone' => $request->input('time_zone'),
            'general_avarage_speed' => $request->input('general_avarage'),
            'latitude' => $request->input('latitude'),
            'visibility_scale' => $request->input('visibility'),
            'longtuide' => $request->input('longtuide'),
            'scale_of_wind_force' => $request->input('scale_wind'),
            'scale_sea' => $request->input('scale_sea'),
            'barometer' => $request->input('barometer'),
            'wind' => $request->input('wind_direction'),
            'vessel_course' => $request->input('vessel_course'),
            'weather' => $request->input('weather'),
            'distance_to_go' => $request->input('distance'),
            'tempratur' => $request->input('temperature'),
            'towage_operation' => $request->input('towage'),
            'destination' => $request->input('destination'),
            'size_grt' => $request->input('size'),
            'eta' => $request->input('eta'),
            'vessel_status' => $request->input('vessel_status'),
        ]);
        

        return redirect()->route('vdr');with('success', 'Add Data Success');
    }

    public function storedaily(Request $request)
    {
        $request->validate([
            'daily_date' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'description' => 'required',
        ]);
    
        Daily_Activity::create([
            'tanggal' => $request->input('daily_date'),
            'time_from' => $request->input('time_from'),
            'time_to' => $request->input('time_to'),
            'description' => $request->input('description'),
           
        ]);
        

        return redirect()->route('vdr');with('success', 'Add Data Success');
    }
    public function storerunning(Request $request)
    {
        $request->validate([
            'running_hours_date' => 'required',
            'machine' => 'required',
            'towing' => 'required',
            'manouver' => 'required',
            'slow' => 'required',
            'economi' => 'required',
            'full_speed' => 'required',
            'standby' => 'required',
        ]);
    
        Running_hours::create([
            'tanggal'=> $request->input('running_hours_date'),
            'machine' => $request->input('machine'),
            'towing' => $request->input('towing'),
            'manouver' => $request->input('manouver'),
            'slow' => $request->input('slow'),
            'economi'=> $request->input('economi'),
            'full_speed'=> $request->input('full_speed'),
            'standby'=> $request->input('standby'),
           
        ]);
        

        return redirect()->route('vdr');with('success', 'Add Data Success');
    }

    public function storeconsumption(Request $request)
    {
        $request->validate([
            'comsumption_date' => 'required',
            'machine' => 'required',
            'product_code' => 'required',
            'product_name' => 'required',
            'description' => 'required',
            'used' => 'required',
        ]);
    
        consumption::create([
            'tanggal'=> $request->input('comsumption_date'),
            'machine' => $request->input('machine'),
            'code_product' => $request->input('product_code'),
            'name_product' => $request->input('product_name'),
            'description' => $request->input('description'),
            'used'=> $request->input('used'), 
        ]);
        

        return redirect()->route('vdr');with('success', 'Add Data Success');
    }

    public function storemuatan(Request $request)
    {
        $request->validate([
            'muatan_date' => 'required',
            'product' => 'required',
            'previous' => 'required',
            'received' => 'required',
            'transfered' => 'required',
            'remain' => 'required',
        ]);
    
        muatan::create([
            'tanggal'=> $request->input('muatan_date'),
            'product_name' => $request->input('product'),
            'previous' => $request->input('previous'),
            'receive' => $request->input('received'),
            'transfer' => $request->input('transfered'),
            'remain'=> $request->input('remain'), 
        ]);
        

        return redirect()->route('vdr');with('success', 'Add Data Success');
    }
    public function storestock(Request $request)
    {
        $request->validate([
            'stock_date' => 'required',
            'product_code' => 'required',
            'product_name' => 'required',
            'spec' => 'required',
            'previous' => 'required',
            'received' => 'required',
            'used'=> 'required',
            'transfer'=> 'required',
            'sound'=> 'required',
            'remain'=> 'required',
        ]);
    
        Stock_Status::create([
            'tanggal'=> $request->input('stock_date'),
            'product_id'=> $request->input('product_code'),
            'name' => $request->input('product_name'),
            'spec' => $request->input('spec'),
            'previous' => $request->input('previous'),
            'receive' => $request->input('received'),
            'use'=> $request->input('used'), 
            'transfer'=> $request->input('transfer'), 
            'soud'=> $request->input('sound'), 
            'remain'=> $request->input('remain'), 
        ]);
        

        return redirect()->route('vdr');with('success', 'Add Data Success');
    }

    public function storevdr(Request $request)
    {
        
        

        return redirect()->route('vdr');with('success', 'Add Data Success');
    }
}
