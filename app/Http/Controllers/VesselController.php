<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class VesselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function vessel()
    {
        $data = Vessel::all();
        return view('vessel.index', compact('data'));
    }

    public function add()
{
    $users = User::whereHas('roles', function($query) {
        $query->where('name', 'vessel');
    })->get();
    $latestVessel = Vessel::latest('vessel_id')->first(); // Mendapatkan data Vessel terakhir berdasarkan ID

    $vesselPrefix = 'VSL';
    $defaultNumber = 1;

    if ($latestVessel) {
        $lastVesselId = $latestVessel->vessel_id;
        $lastNumber = intval(substr($lastVesselId, strlen($vesselPrefix))); // Mengambil angka dari ID terakhir
        $nextNumber = $lastNumber + 1; // Menghitung angka berikutnya
    } else {
        $nextNumber = $defaultNumber; // Default jika belum ada data
    }

    $formattedNumber = str_pad($nextNumber, 2, '0', STR_PAD_LEFT); // Format angka dengan 2 digit (01, 02, dst)
    $vesselId = $vesselPrefix . $formattedNumber; // Menggabungkan dengan prefix

    session(['vesselId' => $vesselId]);

    return view('vessel.add.add', compact('users'));
}


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storevessel(Request $request)
    {
        $request->validate([
            'Vessel_Name' => 'required',
            'Vessel_Email' => 'required',
            'Vessel_Type' => 'required',
            'Builder' => 'required',
            'Class_Cert' => 'required',
            'Call_Sign' => 'required',
            'Length_Perpendicular' => 'required',
            'Depth_Moulded' => 'required',
            'Gross_Tonage' => 'required',
            'Cost_Center' => 'required',
            'Work_Place' => 'required',
            'Clear_Deck_Area' => 'required',
            'Other_Spec' => 'required',
            'Fg_Available' => 'required',
            'Vessel_Alias' => 'required',
            'Country_Flag' => 'required',
            'Year_Built' => 'required',
            'Official_No' => 'required',
            'Length_Over_All' => 'required',
            'Breadth_Moulded' => 'required',
            'Draft_Final' => 'required',
            'Netto_Tonage' => 'required',
            'Owner' => 'required',
            'Consump_ME' => 'required',
            'Consump_AE' => 'required',
            'Consump_Max' => 'required',
            'Consump_Eco' => 'required',
            'Type_Fuel' => 'required',
            'Speed_Max' => 'required',
            'Speed_Eco' => 'required',
            'Speed_Min' => 'required',
            'Horse_Power' => 'required',
            'vessel' => 'required',

        ], [
            'required' => 'The field cannot be empty.',
        ]);

         // Menghasilkan Vessel ID
         $latestVessel = Vessel::latest('vessel_id')->first(); // Mendapatkan data Vessel terakhir berdasarkan ID

         $vesselPrefix = 'VSL';
         $defaultNumber = 1;
     
         if ($latestVessel) {
             $lastVesselId = $latestVessel->vessel_id;
             $lastNumber = intval(substr($lastVesselId, strlen($vesselPrefix))); // Mengambil angka dari ID terakhir
             $nextNumber = $lastNumber + 1; // Menghitung angka berikutnya
         } else {
             $nextNumber = $defaultNumber; // Default jika belum ada data
         }
     
         $formattedNumber = str_pad($nextNumber, 2, '0', STR_PAD_LEFT); // Format angka dengan 2 digit (01, 02, dst)
         $vesselId = $vesselPrefix . $formattedNumber;
    
        Vessel::create([
            'vessel_id' => $vesselId,
            'id_user'=> $request->input('vessel'),
            'vessel_name' => $request->input('Vessel_Name'),
    'email' => $request->input('Vessel_Email'),
    'vessel_type' => $request->input('Vessel_Type'),
    'builder' => $request->input('Builder'),
    'class' => $request->input('Class_Cert'),
    'call_sign' => $request->input('Call_Sign'),
    'length_perpendicular' => $request->input('Length_Perpendicular'),
    'depth_moulded' => $request->input('Depth_Moulded'),
    'gross_tonage' => $request->input('Gross_Tonage'),
    'cost_center' => $request->input('Cost_Center'),
    'work_place' => $request->input('Work_Place'),
    'clear_deck_area' => $request->input('Clear_Deck_Area'),
    'other_spesification' => $request->input('Other_Spec'),
    'avaliable' => $request->input('Fg_Available'),
    'vessel_alias' => $request->input('Vessel_Alias'),
    'country_flag' => $request->input('Country_Flag'),
    'year_built' => $request->input('Year_Built'),
    'official_number' => $request->input('Official_No'),
    'lenght_overall' => $request->input('Length_Over_All'),
    'breadth_mouled' => $request->input('Breadth_Moulded'),
    'draft_final' => $request->input('Draft_Final'),
    'netto_tonnage' => $request->input('Netto_Tonage'),
    'owner' => $request->input('Owner'),
    'main_engine_fuel_oil_consumption' => $request->input('Consump_ME'),
    'auxilary_engine_fuel_oil_consumption' => $request->input('Consump_AE'),
    'fuel_oil_consumption_maximum' => $request->input('Consump_Max'),
    'fuel_oil_consumption_economic' => $request->input('Consump_Eco'),
    'type_of_fuel' => $request->input('Type_Fuel'),
    'maximum_speed' => $request->input('Speed_Max'),
    'economic_speed' => $request->input('Speed_Eco'),
    'minimum_speed' => $request->input('Speed_Min'),
    'horse_power' => $request->input('Horse_Power'),
        ]);

        return redirect()->route('vessel')->with('success', 'ADD Vessel Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function show(Vessel $vessel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function editvessel($id)
    {
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'vessel');
        })->get();
        $vessel = Vessel::find(Crypt::decrypt($id));
        return view('vessel.add.add', ['vessel' => $vessel],compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function updatevessel(Request $request, Vessel $vessel,$encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $request->validate([
            'Vessel_Name' => 'required',
            'Vessel_Email' => 'required',
            'Vessel_Type' => 'required',
            'Builder' => 'required',
            'Class_Cert' => 'required',
            'Call_Sign' => 'required',
            'Length_Perpendicular' => 'required',
            'Depth_Moulded' => 'required',
            'Gross_Tonage' => 'required',
            'Cost_Center' => 'required',
            'Work_Place' => 'required',
            'Clear_Deck_Area' => 'required',
            'Other_Spec' => 'required',
            'Fg_Available' => 'required',
            'Vessel_Alias' => 'required',
            'Country_Flag' => 'required',
            'Year_Built' => 'required',
            'Official_No' => 'required',
            'Length_Over_All' => 'required',
            'Breadth_Moulded' => 'required',
            'Draft_Final' => 'required',
            'Netto_Tonage' => 'required',
            'Owner' => 'required',
            'Consump_ME' => 'required',
            'Consump_AE' => 'required',
            'Consump_Max' => 'required',
            'Consump_Eco' => 'required',
            'Type_Fuel' => 'required',
            'Speed_Max' => 'required',
            'Speed_Eco' => 'required',
            'Speed_Min' => 'required',
            'Horse_Power' => 'required',
            'vessel' => 'required',
        ], [
            'required' => 'The field cannot be empty.',
        ]);
        $vessel = Vessel::find($id);

        $data = [
            'id_user'=> $request->vessel,
            'product_id' => $request->ID_Product_Code,
            'vessel_name' => $request->Vessel_Name,
    'email' => $request->Vessel_Email,
    'vessel_type' => $request->Vessel_Type,
    'builder' => $request->Builder,
    'class' => $request->Class_Cert,
    'call_sign' => $request->Call_Sign,
    'length_perpendicular' => $request->Length_Perpendicular,
    'depth_moulded' => $request->Depth_Moulded,
    'gross_tonage' => $request->Gross_Tonage,
    'cost_center' => $request->Cost_Center,
    'work_place' => $request->Work_Place,
    'clear_deck_area' => $request->Clear_Deck_Area,
    'other_spesification' => $request->Other_Spec,
    'avaliable' => $request->Fg_Available,
    'vessel_alias' => $request->Vessel_Alias,
    'country_flag' => $request->Country_Flag,
    'year_built' => $request->Year_Built,
    'official_number' => $request->Official_No,
    'lenght_overall' => $request->Length_Over_All,
    'breadth_mouled' => $request->Breadth_Moulded,
    'draft_final' => $request->Draft_Final,
    'netto_tonnage' => $request->Netto_Tonage,
    'owner' => $request->Owner,
    'main_engine_fuel_oil_consumption' => $request->Consump_ME,
    'auxilary_engine_fuel_oil_consumption' => $request->Consump_AE,
    'fuel_oil_consumption_maximum' => $request->Consump_Max,
    'fuel_oil_consumption_economic' => $request->Consump_Eco,
    'type_of_fuel' => $request->Type_Fuel,
    'maximum_speed' => $request->Speed_Max,
    'economic_speed' => $request->Speed_Eco,
    'minimum_speed' => $request->Speed_Min,
    'horse_power' => $request->Horse_Power,
        ];
        
    
        $vessel->update($data);
    
        return redirect()->route('vessel')->with('success', 'Edit Vessel successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function delete($encryptedId)
    {   $id = Crypt::decrypt($encryptedId);
        $Vessel = Vessel::find($id);
        // Hapus data film
        $Vessel->delete();
    
        return redirect()->route('vessel')->with('success', 'Delete successfully.');
}
}
