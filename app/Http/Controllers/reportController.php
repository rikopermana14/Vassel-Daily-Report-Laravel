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
use App\Models\User;
use Dompdf\Dompdf;
use App\Models\Temp_Daily;
use App\Models\Temp_consumption;
use App\Models\Temp_Payload;
use App\Models\Temp_Running;
use App\Models\Temp_Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
        public function report(Request $request)
    {   
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $bioskopId = $request->input('vessel');
        $sqlQuery = vdr::join('daily_activitiy', 'vdr.id_daily', '=', 'daily_activitiy.id_vdr')
        ->join('consumption', 'vdr.id_consumption', '=', 'consumption.id_vdr')
        ->join('payload', 'vdr.id_payload', '=', 'payload.id_vdr')
        ->join('stock_status', 'vdr.id_stock_status', '=', 'stock_status.id_vdr')
        ->join('running_hours', 'vdr.id_running_hours', '=', 'running_hours.id_vdr')
        ->join('users', 'vdr.user_input', '=', 'users.id')
        ->select('vdr.*','users.name as name_input',
        )
        ->when($bioskopId, function ($query) use ($bioskopId) {
                return $query->where('vdr.user_input', $bioskopId);
            })
        ->latest('vdr.id');
        // dd($sqlQuery->toSql());
    
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'vessel');
        })->get();
        

    // Jalankan query dan kembalikan hasilnya
    $getbooking = vdr::join('users', 'vdr.user_input', '=', 'users.id')
    ->select('vdr.*','users.name as userg',)
    ->when($bioskopId, function ($getbooking) use ($bioskopId) {
        return $getbooking->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('vdr.date', [$startDate, $endDate]);
    })
    ->get();

    // Query untuk mengambil data dari tabel daily_activity berdasarkan tanggal dan vdr.user_input
    $daily_activitiy = Daily_Activity::join('users', 'daily_activitiy.user_input', '=', 'users.id')
    ->select('daily_activitiy.*','users.name as userd',)
    ->when($bioskopId, function ($daily_activitiy) use ($bioskopId) {
        return $daily_activitiy->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('daily_activitiy.date', [$startDate, $endDate]);
    })
    ->get();
//     $daily_activitiy = Daily_Activity::all();
//     $consumption = consumption::all();
        // $payload = payload::all();
        // $stock_status = stock_status::all();
        // $running_hours = running_hours::all();
    $consumption = consumption::join('users', 'consumption.user_input', '=', 'users.id')
    ->select('consumption.*','users.name as userc',)
    ->when($bioskopId, function ($consumption) use ($bioskopId) {
        return $consumption->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('consumption.date', [$startDate, $endDate]);
    })
    ->get();

    $payload = payload::join('users', 'payload.user_input', '=', 'users.id')
    ->select('payload.*','users.name as userp',)
    ->when($bioskopId, function ($payload) use ($bioskopId) {
        return $payload->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('payload.date', [$startDate, $endDate]);
    })
    ->get();

    $stock_status = stock_status::join('users', 'stock_status.user_input', '=', 'users.id')
    ->select('stock_status.*','users.name as users',)
    ->when($bioskopId, function ($stock_status) use ($bioskopId) {
        return $stock_status->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('stock_status.date', [$startDate, $endDate]);
    })
    ->get();

    $running_hours = running_hours::join('users', 'running_hours.user_input', '=', 'users.id')
    ->select('running_hours.*','users.name as userr',)
    ->when($bioskopId, function ($running_hours) use ($bioskopId) {
        return $running_hours->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('running_hours.date', [$startDate, $endDate]);
    })
    ->get();
    
    
    return view('report.report', compact('getbooking','bioskopId','daily_activitiy','consumption','payload','stock_status','running_hours','users','startDate','endDate'));
    }

    public function generateReport(Request $request)
{
    $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $bioskopId = $request->input('vessel');
        $sqlQuery = vdr::join('daily_activitiy', 'vdr.id_daily', '=', 'daily_activitiy.id_vdr')
        ->join('consumption', 'vdr.id_consumption', '=', 'consumption.id_vdr')
        ->join('payload', 'vdr.id_payload', '=', 'payload.id_vdr')
        ->join('stock_status', 'vdr.id_stock_status', '=', 'stock_status.id_vdr')
        ->join('running_hours', 'vdr.id_running_hours', '=', 'running_hours.id_vdr')
        ->join('users', 'vdr.user_input', '=', 'users.id')
        ->select('vdr.*','users.name as name_input',
        )
        ->when($bioskopId, function ($query) use ($bioskopId) {
                return $query->where('vdr.user_input', $bioskopId);
            })
        ->latest('vdr.id');
        // dd($sqlQuery->toSql());
    
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'vessel');
        })->get();
        

    // Jalankan query dan kembalikan hasilnya
    $getbooking = vdr::join('users', 'vdr.user_input', '=', 'users.id')
    ->select('vdr.*','users.name as userg',)
    ->when($bioskopId, function ($getbooking) use ($bioskopId) {
        return $getbooking->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('vdr.date', [$startDate, $endDate]);
    })
    ->get();

    // Query untuk mengambil data dari tabel daily_activity berdasarkan tanggal dan vdr.user_input
    $daily_activitiy = Daily_Activity::join('users', 'daily_activitiy.user_input', '=', 'users.id')
    ->select('daily_activitiy.*','users.name as userd',)
    ->when($bioskopId, function ($daily_activitiy) use ($bioskopId) {
        return $daily_activitiy->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('daily_activitiy.date', [$startDate, $endDate]);
    })
    ->get();
//     $daily_activitiy = Daily_Activity::all();
//     $consumption = consumption::all();
        // $payload = payload::all();
        // $stock_status = stock_status::all();
        // $running_hours = running_hours::all();
    $consumption = consumption::join('users', 'consumption.user_input', '=', 'users.id')
    ->select('consumption.*','users.name as userc',)
    ->when($bioskopId, function ($consumption) use ($bioskopId) {
        return $consumption->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('consumption.date', [$startDate, $endDate]);
    })
    ->get();

    $payload = payload::join('users', 'payload.user_input', '=', 'users.id')
    ->select('payload.*','users.name as userp',)
    ->when($bioskopId, function ($payload) use ($bioskopId) {
        return $payload->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('payload.date', [$startDate, $endDate]);
    })
    ->get();

    $stock_status = stock_status::join('users', 'stock_status.user_input', '=', 'users.id')
    ->select('stock_status.*','users.name as users',)
    ->when($bioskopId, function ($stock_status) use ($bioskopId) {
        return $stock_status->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('stock_status.date', [$startDate, $endDate]);
    })
    ->get();

    $running_hours = running_hours::join('users', 'running_hours.user_input', '=', 'users.id')
    ->select('running_hours.*','users.name as userr',)
    ->when($bioskopId, function ($running_hours) use ($bioskopId) {
        return $running_hours->where('user_input', $bioskopId);
    })
    ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
        return $query->whereBetween('running_hours.date', [$startDate, $endDate]);
    })
    ->get();

    // Generate PDF using the retrieved data
    $html = view('report.laporan_pdf', compact('getbooking','daily_activitiy','consumption','payload','stock_status','running_hours','users','startDate','endDate'))->render();

    $dompdf = new Dompdf();

    // Load HTML into the PDF
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Set the PDF download filename
    $filename = 'Vessel Daily Report-' . date('Y-m-d-His') . '.pdf';

    // Download the PDF file
    $dompdf->stream($filename);
}

}