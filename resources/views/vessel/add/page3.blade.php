<!-- /.tab-pane -->
<div class="card-body">
   <div class="row">
       <div class="col-sm-6">
           <div class="form-group">
               <label>Maximum Speed</label>
               <input type="text" class="form-control" name="Speed_Max" value="{{ isset($vessel) ? $vessel->maximum_speed : '' }}">
           </div>
           <div class="form-group">
               <label>Economic Speed</label>
               <input type="text" class="form-control" name="Speed_Eco" value="{{ isset($vessel) ? $vessel->economic_speed : '' }}">
           </div>
           <div class="form-group">
               <label>Minimum Speed</label>
               <input type="text" class="form-control" name="Speed_Min" value="{{ isset($vessel) ? $vessel->minimum_speed : '' }}">
           </div>
           <div class="form-group">
               <label>Horse Power</label>
               <input type="text" class="form-control" name="Horse_Power" value="{{ isset($vessel) ? $vessel->horse_power : '' }}">
           </div>
       </div>
   </div>
</div>
<!-- /.tab-pane -->
