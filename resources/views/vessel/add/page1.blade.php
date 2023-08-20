<div class="card-body">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
<label for="country_name">Vessel ID</label>
<input type="text" class="form-control" name="ID_Vessel_Code" value="{{ session('vesselId') }}" >
</div>
   <div class="form-group">
    <label for="country_name">Vessel Name</label>
    <input type="text" class="form-control" name="Vessel_Name" value="{{ isset($vessel) ? $vessel->vessel_name : '' }}">
</div>
<div class="form-group">
    <label>E-mail</label>
    <input type="text" name="Vessel_Email" class="form-control" placeholder="name@youremail.com" value="{{ isset($vessel) ? $vessel->email : '' }}">
</div>
<div class="form-group">
    <label>Vessel Type</label>
    <select class="form-control" name="Vessel_Type" id="vessel_type" required>
        <option value="">Vessel Type</option>
        <option value="AHTS" {{ isset($vessel) && $vessel->vessel_type === 'AHTS' ? 'selected' : '' }}>AHTS</option>
        <option value="AHT" {{ isset($vessel) && $vessel->vessel_type === 'AHT' ? 'selected' : '' }}>AHT</option>
        <option value="AWB" {{ isset($vessel) && $vessel->vessel_type === 'AWB' ? 'selected' : '' }}>AWB</option>
        <option value="Tug Boat" {{ isset($vessel) && $vessel->vessel_type === 'Tug Boat' ? 'selected' : '' }}>Tug Boat</option>
    </select>
</div>
<div class="form-group">
    <label>Builder</label>
    <input type="text" class="form-control" name="Builder" value="{{ isset($vessel) ? $vessel->builder : '' }}">
</div>
<div class="form-group">
    <label>Class</label>
    <select class="form-control" name="Class_Cert">
        <option selected>Biro Klasifikasi Indonesia</option>
    </select>
</div>
<div class="form-group">
    <label>Call Sign</label>
    <input type="text" class="form-control" name="Call_Sign" value="{{ isset($vessel) ? $vessel->call_sign : '' }}">
</div>
<div class="form-group">
    <label>Length Perpendicular</label>
    <input type="text" class="form-control" name="Length_Perpendicular" value="{{ isset($vessel) ? $vessel->length_perpendicular : '' }}">
</div>
<div class="form-group">
    <label>Depth Moulded</label>
    <input type="text" class="form-control" name="Depth_Moulded" value="{{ isset($vessel) ? $vessel->depth_moulded : '' }}">
</div>
<div class="form-group">
    <label>Gross Tonage</label>
    <input type="text" class="form-control" name="Gross_Tonage" value="{{ isset($vessel) ? $vessel->gross_tonage : '' }}">
</div>
<div class="form-group">
    <label>Cost Center</label>
    <input type="text" class="form-control" name="Cost_Center" value="{{ isset($vessel) ? $vessel->cost_center : '' }}">
</div>
<div class="form-group">
    <label>Work Place</label>
    <input type="text" class="form-control" name="Work_Place" value="{{ isset($vessel) ? $vessel->work_place : '' }}">
</div>
</div>
<div class="col-sm">
<div class="form-group">
    <label>Clear Deck Area</label>
    <input type="text" class="form-control" name="Clear_Deck_Area" value="{{ isset($vessel) ? $vessel->clear_deck_area : '' }}">
</div>
<div class="form-group">
    <label>Other Spesification</label>
    <input type="text" class="form-control" name="Other_Spec" value="{{ isset($vessel) ? $vessel->other_spesification : '' }}">
</div>
<div class="form-group">
    <label>Avaliable</label>
    <select class="form-control" name="Fg_Available">
        <option {{ isset($vessel) && $vessel->avaliable === 'Y' ? 'selected' : '' }}>Y</option>
        <option {{ isset($vessel) && $vessel->avaliable === 'N' ? 'selected' : '' }}>N</option>
    </select>
</div>
<div class="form-group">
    <label>Vessel Alias</label>
    <input type="text" class="form-control" name="Vessel_Alias" value="{{ isset($vessel) ? $vessel->vessel_alias : '' }}">
</div>
<div class="form-group">
    <label>Country Flag</label>
    <input type="text" class="form-control" name="Country_Flag" value="{{ isset($vessel) ? $vessel->country_flag : '' }}">
</div>
<div class="form-group">
    <label>Year Built</label>
    <input type="text" class="form-control" name="Year_Built" value="{{ isset($vessel) ? $vessel->year_built : '' }}">
</div>
<div class="form-group">
    <label>Official Number</label>
    <input type="text" class="form-control" name="Official_No" value="{{ isset($vessel) ? $vessel->official_number : '' }}">
</div>
<div class="form-group">
    <label>Length Over All</label>
    <input type="text" class="form-control" name="Length_Over_All" value="{{ isset($vessel) ? $vessel->lenght_overall : '' }}">
</div>
<div class="form-group">
    <label>Breadth Mouled</label>
    <input type="text" class="form-control" name="Breadth_Moulded" value="{{ isset($vessel) ? $vessel->breadth_mouled: '' }}">
</div>
<div class="form-group">
    <label>Draft Final</label>
    <input type="text" class="form-control" name="Draft_Final" value="{{ isset($vessel) ? $vessel->draft_final : '' }}">
</div>
<div class="form-group">
    <label>Netto Tonnage</label>
    <input type="text" class="form-control" name="Netto_Tonage" value="{{ isset($vessel) ? $vessel->netto_tonnage : '' }}">
</div>
<div class="form-group">
    <label>Owner</label>
    <select class="form-control" name="Owner">
        <option selected>{{ isset($vessel) ? $vessel->owner : 'Logindo' }}</option>
        <option>Other</option>
    </select>
</div>
</div>
</div>
</div>
