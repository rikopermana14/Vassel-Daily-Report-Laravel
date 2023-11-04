
<div class="card-body">
      <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Date</label>
          <div class="input-group date" id="joined_date" data-target-input="nearest">
            <input name="joined_date" id="joined_date_input" type="text" class="form-control datetimepicker-input" data-target="#joined_date"/>
            <div class="input-group-append" data-target="#joined_date" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
          </div>
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Distance Run</label>
          <input type="text" name="distance_run" class="form-control">
        </div>
        </div>
      </div>
      <input type="hidden" name="user_input" id="user_input" value="{{auth()->user()->id}}">
           <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Vessel Name</label>
          <input type="text" name="vessel_name" id="vessel_name" class="form-control" value="{{ Auth::user()->name }}"  readonly>
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Total Distance Run</label>
          <input type="text" name="total_distance" class="form-control">
        </div>
        </div>
      </div>


           <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Vessel Group</label>
          @foreach ($vessel as $item)
          <input type="text" name="vessel_group" id="vessel_group" class="form-control" value="{{ $item->vessel_type }}"  readonly>
          @endforeach
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Time Run</label>
          <input type="time" name="time_run" class="form-control">
        </div>
        </div>
      </div>


       <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>General Position</label>
        <input type="text" name="general_position" class="form-control">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Total Time Run</label>
          <input type="time" name="total_time" class="form-control">
        </div>
        </div>
      </div>


       <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Master's Name</label>
        <input type="text" name="master_name" class="form-control">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Average Speed</label>
          <input type="text" name="avarage_speed" class="form-control">
        </div>
        </div>
      </div>


       <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Time Zone</label>
        <input type="text" name="time_zone" class="form-control">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>General Average Speed</label>
          <input type="text" name="general_avarage" class="form-control">
        </div>
        </div>
      </div>


       <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Latitude</label>
        <input type="text" name="latitude" class="form-control">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Visibility Scale</label>
          <input type="text" name="visibility" class="form-control">
        </div>
        </div>
      </div>

        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Longitude</label>
        <input type="text" name="longtuide" class="form-control">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Scale of Wind Force</label>
          <input type="text" name="scale_wind" class="form-control">
        </div>
        </div>
      </div>

        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Scale of Sea Swell</label>
        <input type="text" name="scale_sea" class="form-control">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Barometer</label>
          <input type="text" name="barometer" class="form-control">
        </div>
        </div>
      </div>

        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Wind Direction</label>
        <input type="text" name="wind_direction" class="form-control">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Vessel Course (T)</label>
          <input type="text" name="vessel_course" class="form-control">
        </div>
        </div>
      </div>

        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Weather</label>
        <input type="text" name="weather" class="form-control">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Distance To Go</label>
          <input type="text" name="distance" class="form-control">
        </div>
        </div>
      </div>

        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Temperature</label>
          <input type="text" name="temperature" class="form-control" id="temperature">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Towage Operation</label>
          <input type="text" name="towage" class="form-control">
        </div>
        </div>
      </div>

        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>Destination</label>
        <input type="text" name="destination" class="form-control">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Name / Size (GRT)</label>
          <input type="text" name="size" class="form-control">
        </div>
        </div>
      </div>

        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
          <label>ETA</label>
        <input type="text" name="eta" class="form-control">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
          <label>Vessel Status</label>
          <select class="form-control"name="vessel_status">
          <option>ON HIRE</option>
          <option>OFF HIRE</option>
        </select>
        </div>
        </div>
      </div>

      </div>
      <script>
        // Mendapatkan elemen input
        var temperatureInput = document.getElementById("temperature");
    
        // Menambahkan event listener untuk perubahan input
    temperatureInput.addEventListener("input", function () {
        // Mengambil nilai yang dimasukkan oleh pengguna
        var enteredValue = temperatureInput.value;

        // Menghilangkan "°C" jika ada
        enteredValue = enteredValue.replace("°C", "");

        // Menambahkan "°C" kembali
        temperatureInput.value = enteredValue + "°C";
    });
</script>
