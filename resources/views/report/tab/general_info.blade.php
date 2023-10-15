<div class="card-body">
    <div class="table-responsive">
    <table id="exampleg" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date</th>
        <th>Vessel Name</th>
        <th>Distance Run</th>
        <th>Total Distance Run</th>
        <th>Vessel Group</th>
        <th>Time Run</th>
        <th>General Position</th>
        <th>Total Time Run</th>
        <th>Master's Name</th>
        <th>Average Speed</th>
        <th>Time Zone</th>
        <th>General Average Speed</th>
        <th>Latitude</th>
        <th>Visibility Scale</th>
        <th>Longitude</th>
        <th>Scale of Wind Force</th>
        <th>Scale of Sea Swell</th>
        <th>Barometer</th>
        <th>Wind Direction</th>
        <th>Vessel Course (T)</th>
        <th>Weather</th>
        <th>Distance To Go</th>
        <th>Temperature</th>
        <th>Towage Operation</th>
        <th>Destination</th>
        <th>Name / Size (GRT)</th>
        <th>ETA</th>
        <th>Vessel Status</th>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Date</th>
        <th>Vessel Name</th>
        <th>Distance Run</th>
        <th>Total Distance Run</th>
        <th>Vessel Group</th>
        <th>Time Run</th>
        <th>General Position</th>
        <th>Total Time Run</th>
        <th>Master's Name</th>
        <th>Average Speed</th>
        <th>Time Zone</th>
        <th>General Average Speed</th>
        <th>Latitude</th>
        <th>Visibility Scale</th>
        <th>Longitude</th>
        <th>Scale of Wind Force</th>
        <th>Scale of Sea Swell</th>
        <th>Barometer</th>
        <th>Wind Direction</th>
        <th>Vessel Course (T)</th>
        <th>Weather</th>
        <th>Distance To Go</th>
        <th>Temperature</th>
        <th>Towage Operation</th>
        <th>Destination</th>
        <th>Name / Size (GRT)</th>
        <th>ETA</th>
        <th>Vessel Status</th>
            </tr>
        </tfoot>
        <tbody> 
            @foreach ($getbooking as $booking)
            <tr>      
                <td>{{ $booking->date }}</td>
        <td>{{ $booking->vessel_name }}</td>
        <td>{{ $booking->distance_run }}</td>
        <td>{{ $booking->total_distance }}</td>
        <td>{{ $booking->vessel_group }}</td>
        <td>{{ $booking->time_run }}</td>
        <td>{{ $booking->general_position }}</td>
        <td>{{ $booking->total_time }}</td>
        <td>{{ $booking->master_name }}</td>
        <td>{{ $booking->avarage_speed }}</td>
        <td>{{ $booking->time_zone }}</td>
        <td>{{ $booking->general_avarage_speed }}</td>
        <td>{{ $booking->latitude }}</td>
        <td>{{ $booking->visibility_scale }}</td>
        <td>{{ $booking->longtuide }}</td>
        <td>{{ $booking->scale_of_wind_force }}</td>
        <td>{{ $booking->scale_sea }}</td>
        <td>{{ $booking->barometer }}</td>
        <td>{{ $booking->wind }}</td>
        <td>{{ $booking->vessel_course }}</td>
        <td>{{ $booking->weather }}</td>
        <td>{{ $booking->distance_to_go }}</td>
        <td>{{ $booking->tempratur }}</td>
        <td>{{ $booking->towage_operation }}</td>
        <td>{{ $booking->destination }}</td>
        <td>{{ $booking->size_grt }}</td>
        <td>{{ $booking->eta }}</td>
        <td>{{ $booking->vessel_status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
<!-- /.card-body -->
