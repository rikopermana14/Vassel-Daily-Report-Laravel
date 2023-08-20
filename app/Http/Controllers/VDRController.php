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
use App\Models\Temp_Daily;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

public function deleteDaily($id)
    {
        try {
            // Cari aktivitas harian berdasarkan ID
            $dailyActivity = Temp_Daily::findOrFail($id);

            dd($dailyActivity);
            // Hapus aktivitas harian
            $dailyActivity->delete();

            // Berikan respons berhasil
            return response()->json(['success' => true, 'message' => 'Daily activity deleted successfully']);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['success' => false, 'message' => 'Failed to delete daily activity', 'error' => $e->getMessage()], 500);
        }
    }

public function moveDataToDaily(Request $request) {
    try {
        // Pindahkan data dari tabel sementara ke tabel daily activity
        DB::table('daily_activitiy')->insert(
            DB::table('temp_daily')->get()->toArray()
        );

        // Kembalikan respons sukses
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Tangani kesalahan dan kembalikan respons gagal
        return response()->json(['success' => false]);
    }
}

public function clearTempTable(Request $request) {
    try {
        // Hapus data dari tabel sementara
        DB::table('temp_daily')->truncate();

        // Kembalikan respons sukses
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Tangani kesalahan dan kembalikan respons gagal
        return response()->json(['success' => false]);
    }
}

public function ajaxdaily(Request $request)
{
    $user = Auth::User()->id;
  $data = Temp_Daily::where('user_input',$user)->orderby('id','desc')->get();

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
        $adddaily = Temp_Daily::create([
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


public function ajaxrunning(Request $request)
{
    $user = Auth::User()->id;
    $data = Running_hours::where('user_input',$user)->orderby('id','desc')->get();

  $response = [
    'success' => true,
    'details' => $data,

  ];

return response()->json($response, 200);
}

public function addrunning(Request $request)
{
    $request->validate([
        'date' => 'required',
            'machine' => 'required',
            'towing' => 'required',
            'manouver' => 'required',
            'slow' => 'required',
            'economi' => 'required',
            'full_speed' => 'required',
            'standby' => 'required',
    ]);

    $userid = $request->input('user_input');

    DB::beginTransaction();
    try {
        $addrunning = Running_hours::create([
            'date'=> $request->input('date'),
            'machine' => $request->input('machine'),
            'towing' => $request->input('towing'),
            'manouver' => $request->input('manouver'),
            'slow' => $request->input('slow'),
            'economi'=> $request->input('economi'),
            'full_speed'=> $request->input('full_speed'),
            'standby'=> $request->input('standby'),
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

public function ajaxconsumption(Request $request)
{
    $user = Auth::User()->id;
    $data = consumption::where('user_input',$user)->orderby('id','desc')->get();

  $response = [
    'success' => true,
    'details' => $data,

  ];

return response()->json($response, 200);
}

public function addconsumption(Request $request)
{
    $request->validate([
            'date' => 'required',
            'machine' => 'required',
            'code_product' => 'required',
            'name_product' => 'required',
            'description' => 'required',
            'used' => 'required',
    ]);

    $userid = $request->input('user_input');

    DB::beginTransaction();
    try {
        $addconsumption = consumption::create([
            'date'=> $request->input('date'),
            'machine' => $request->input('machine'),
            'code_product' => $request->input('code_product'),
            'name_product' => $request->input('name_product'),
            'description' => $request->input('description'),
            'used'=> $request->input('used'), 
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


public function ajaxmuatan(Request $request)
{
    $user = Auth::User()->id;
    $data = muatan::where('user_input',$user)->orderby('id','desc')->get();

  $response = [
    'success' => true,
    'details' => $data,

  ];

return response()->json($response, 200);
}

public function addmuatans(Request $request)
{
   // dd($request->all());
    $request->validate([
        'date' => 'required',
        'product_name' => 'required',
        'previous' => 'required',
        'receive' => 'required',
        'transfer' => 'required',
        'remain' => 'required',
    ]);

    $userid = $request->input('user_input');

    DB::beginTransaction();
    try {
        $addconsumption = muatan::create([
            'date'=> $request->input('date'),
            'product_name' => $request->input('product_name'),
            'previous' => $request->input('previous'),
            'receive' => $request->input('receive'),
            'transfer' => $request->input('transfer'),
            'remain'=> $request->input('remain'), 
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
            'date' => $request->input('joined_date'),
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
            'date' => $request->input('daily_date'),
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
            'date'=> $request->input('running_hours_date'),
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
            'date'=> $request->input('comsumption_date'),
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
            'date'=> $request->input('muatan_date'),
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
            'date'=> $request->input('stock_date'),
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
