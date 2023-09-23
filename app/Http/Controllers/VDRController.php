<?php

namespace App\Http\Controllers;

use App\Models\consumption;
use App\Models\Daily_Activity;
use Illuminate\Http\Request;
use App\Models\GeneralInfo;
use App\Models\Payload;
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
        $data1=Product::all();
        return view('vdr.index', compact('data1','stock'));
    }
    public function getProduct($codeproduct)
{
    $product = Product::where('product_id', $codeproduct)->first();
    return response()->json($product);
}

public function deleteDaily(Request $request)
    {
        $id = $request->id;
        $dailyActivity = Temp_Daily::find($id);

        if (!$dailyActivity) {
            return response()->json(['error' => 'Daily activity not found'], 404);
        }

        $dailyActivity->delete();

        return response()->json(['message' => 'Daily activity deleted successfully']);
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

public function getDailyActivity($id)
    {
        $editdaily = Temp_Daily::find($id);
        
        if (!$editdaily) {
            return response()->json(['error' => 'Daily Activity not found'], 404);
        }

        return response()->json($editdaily);
    }

    public function editDailyActivity(Request $request, $id)
    {
        // Ambil data dari request
        $data = [
            'date' => $request->input('date'),
            'time_from' => $request->input('time_from'),
            'time_to' => $request->input('time_to'),
            'description' => $request->input('description'),
            // ... sesuaikan dengan field lainnya ...
        ];
        
        // Lakukan update data di database berdasarkan ID
        Temp_Daily::where('id', $id)->update($data);
        
        return response()->json(['message' => 'Activity updated successfully']);
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

public function deleterunning(Request $request)
    {
        $id = $request->id;
        $running = Running_hours::find($id);

        if (!$running) {
            return response()->json(['error' => 'Consumption not found'], 404);
        }

        $running->delete();

        return response()->json(['message' => 'Consumption deleted successfully']);
    }

    public function getrunning($id)
    {
        $editrunning = Running_hours::find($id);
        
        if (!$editrunning) {
            return response()->json(['error' => 'Daily Activity not found'], 404);
        }

        return response()->json($editrunning);
    }

    public function editrunning(Request $request, $id)
    {
        // Ambil data dari request
        $data = [
            'date'=> $request->input('date'),
            'machine' => $request->input('machine'),
            'towing' => $request->input('towing'),
            'manouver' => $request->input('manouver'),
            'slow' => $request->input('slow'),
            'economi'=> $request->input('economi'),
            'full_speed'=> $request->input('full_speed'),
            'standby'=> $request->input('standby'),
            // ... sesuaikan dengan field lainnya ...
        ];
        
        // Lakukan update data di database berdasarkan ID
        Running_hours::where('id', $id)->update($data);
        
        return response()->json(['message' => 'Activity updated successfully']);
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

public function deleteconsumption(Request $request)
    {
        $id = $request->id;
        $consumption = consumption::find($id);

        if (!$consumption) {
            return response()->json(['error' => 'Consumption not found'], 404);
        }

        $consumption->delete();

        return response()->json(['message' => 'Consumption deleted successfully']);
    }

    public function getconsumption($id)
    {
        $editrunning = consumption::find($id);
        
        if (!$editrunning) {
            return response()->json(['error' => 'Daily Activity not found'], 404);
        }

        return response()->json($editrunning);
    }

    public function editconsumption(Request $request, $id)
    {
        // Ambil data dari request
        $data = [
            'date'=> $request->input('date'),
            'machine' => $request->input('machine'),
            'code_product' => $request->input('code_product'),
            'name_product' => $request->input('name_product'),
            'description' => $request->input('description'),
            'used'=> $request->input('used'),
            // ... sesuaikan dengan field lainnya ...
        ];
        
        // Lakukan update data di database berdasarkan ID
        consumption::where('id', $id)->update($data);
        
        return response()->json(['message' => 'Activity updated successfully']);
    }


public function ajaxpayload(Request $request)
{
    $user = Auth::User()->id;
    $data = payload::where('user_input',$user)->orderby('id','desc')->get();

  $response = [
    'success' => true,
    'details' => $data,

  ];

return response()->json($response, 200);
}

public function addpayloads(Request $request)
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
        $addconsumption = payload::create([
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

public function deletepayload(Request $request)
    {
        $id = $request->id;
        $payload = payload::find($id);

        if (!$payload) {
            return response()->json(['error' => 'Consumption not found'], 404);
        }

        $payload->delete();

        return response()->json(['message' => 'Consumption deleted successfully']);
    }

    public function getpayload($id)
    {
        $payload = Payload::find($id);
        
        if (!$payload) {
            return response()->json(['error' => 'Daily Activity not found'], 404);
        }

        return response()->json($payload);
    }

    public function editpayload(Request $request, $id)
    {
        // Ambil data dari request
        $data = [
            'date'=> $request->input('date'),
            'product_name' => $request->input('product_name'),
            'previous' => $request->input('previous'),
            'receive' => $request->input('receive'),
            'transfer' => $request->input('transfer'),
            'remain'=> $request->input('remain'),
            // ... sesuaikan dengan field lainnya ...
        ];
        
        // Lakukan update data di database berdasarkan ID
        payload::where('id', $id)->update($data);
        
        return response()->json(['message' => 'Activity updated successfully']);
    }

    public function ajaxstock(Request $request)
{
    $user = Auth::User()->id;
    $data = Stock_Status::where('user_input',$user)->orderby('id','desc')->get();

  $response = [
    'success' => true,
    'details' => $data,

  ];

return response()->json($response, 200);
}

public function addstock(Request $request)
{
   // dd($request->all());
    $request->validate([
            'date' => 'required',
            'code_product' => 'required',
            'name_product' => 'required',
            'spec' => 'required',
            'previous' => 'required',
            'received' => 'required',
            'used'=> 'required',
            'transfered'=> 'required',
            'sounding'=> 'required',
            'remain'=> 'required',
        ]);

    $userid = $request->input('user_input');

    DB::beginTransaction();
    try {
        $addstock = Stock_Status::create([
            'date'=> $request->input('date'),
            'code_product'=> $request->input('code_product'),
            'name_product' => $request->input('name_product'),
            'spec' => $request->input('spec'),
            'previous' => $request->input('previous'),
            'received' => $request->input('received'),
            'used'=> $request->input('used'), 
            'transfered'=> $request->input('transfered'), 
            'sounding'=> $request->input('sounding'), 
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

public function deletestock(Request $request)
    {
        $id = $request->id;
        $payload = Stock_Status::find($id);

        if (!$payload) {
            return response()->json(['error' => 'Consumption not found'], 404);
        }

        $payload->delete();

        return response()->json(['message' => 'Consumption deleted successfully']);
    }

    public function getstock($id)
    {
        $payload = Stock_Status::find($id);
        
        if (!$payload) {
            return response()->json(['error' => 'Daily Activity not found'], 404);
        }

        return response()->json($payload);
    }

    public function editstock(Request $request, $id)
    {
        // Ambil data dari request
        $data = [
            'date'=> $request->input('date'),
            'code_product'=> $request->input('code_product'),
            'name_product' => $request->input('name_product'),
            'spec' => $request->input('spec'),
            'previous' => $request->input('previous'),
            'received' => $request->input('received'),
            'used'=> $request->input('used'), 
            'transfered'=> $request->input('transfered'), 
            'sounding'=> $request->input('sounding'), 
            'remain'=> $request->input('remain'), 
            // ... sesuaikan dengan field lainnya ...
        ];
        
        // Lakukan update data di database berdasarkan ID
        payload::where('id', $id)->update($data);
        
        return response()->json(['message' => 'Activity updated successfully']);
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
        $userid = Auth::User()->id;
    
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
            'user_input' => $userid,
        ]);
        

        return redirect()->route('vdr');with('success', 'Add Data Success');
    }

    public function storevdr(Request $request)
    {
        
        

        return redirect()->route('vdr');with('success', 'Add Data Success');
    }
}
