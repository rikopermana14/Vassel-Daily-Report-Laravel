<div class="card-body">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label>Main Engine Fuel Oil Consumption</label>
          <input type="text" class="form-control" name="Consump_ME" value="{{ isset($vessel) ? $vessel->main_engine_fuel_oil_consumption : '' }}">
      </div>
      <div class="form-group">
          <label>Auxilary Engine Fuel Oil Consumption</label>
          <input type="text" class="form-control" name="Consump_AE" value="{{ isset($vessel) ? $vessel->auxilary_engine_fuel_oil_consumption : '' }}">
      </div>
      <div class="form-group">
          <label>Fuel Oil Consumption Maximum</label>
          <input type="text" class="form-control" name="Consump_Max" value="{{ isset($vessel) ? $vessel->fuel_oil_consumption_maximum : '' }}">
      </div>
      <div class="form-group">
          <label>Fuel Oil Consumption Economic</label>
          <input type="text" class="form-control" name="Consump_Eco" value="{{ isset($vessel) ? $vessel->fuel_oil_consumption_economic : '' }}">
      </div>
      <div class="form-group">
          <label>Type of Fuel</label>
          <input type="text" class="form-control" name="Type_Fuel" value="{{ isset($vessel) ? $vessel->type_of_fuel : '' }}">
      </div>

  </div>
</div>
</div>