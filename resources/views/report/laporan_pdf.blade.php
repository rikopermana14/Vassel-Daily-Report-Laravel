<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vessel Daily Report</title>
    <style>
        /* CSS styling untuk tampilan PDF laporan pemesanan */
        /* Contoh: */
        body {
            font-family: 'Times New Roman', Times, serif;
        }
        h1 {
            color: #333;
        }
        h5 {
            color: #333;
            font-size: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Vessel Daily Report</h1>
    <h5>General Info</h5>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
        <th>Vessel Name</th>
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

            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($getbooking as $booking)
                <tr>      
                    <td>{{$no++}}</td>
                    <td>{{ $booking->date }}</td>
            <td>{{ $booking->vessel_name }}</td>
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
                </tr>
                @endforeach
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
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
        <tbody>
            @foreach ($getbooking as $booking)
                <tr>      
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
    <br>
    <h5>Daily Activitiy</h5>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Description</th> 
                <th>Vessel</th> 
            </tr>
        </thead>
        <tbody> 
            <?php $no1 = 1; ?>
            @foreach ($daily_activitiy as $booking)
            <tr> 
                <td>{{$no1++}}</td>     
                <td>{{ $booking->date }}</td>
                <td>{{ $booking->time_from }}</td>
                <td>{{ $booking->time_to }}</td>
                <td>{{ $booking->description }}</td>
                <td>{{ $booking->userd }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <h5>Running Hours Machine</h5>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Machine</th>
                <th>Run Hours Towing</th> 
                <th>Run Hours Manouver</th>
                <th>Run Hours Slow</th>
                <th>Run Hours Economi</th>
                <th>Run Hours Full Speed</th>
                <th>Run Hours Stand By</th>
                <th>Vessel</th> 
            </tr>
        </thead>
        <tbody> 
            <?php $no2 = 1; ?>
            @foreach ($running_hours as $booking)
            <tr>  
                <td>{{$no2++}}</td>       
                <td>{{ $booking->date }}</td>
        <td>{{ $booking->machine }}</td>
        <td>{{ $booking->towing }}</td>
        <td>{{ $booking->manouver }}</td>
        <td>{{ $booking->slow }}</td>
        <td>{{ $booking->economi }}</td>
        <td>{{ $booking->full_speed }}</td>
        <td>{{ $booking->standby }}</td>
        <td>{{ $booking->userr }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

        <br>
        <h5>Cunsumption</h5>
        <table >
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Machine</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Description</th>  
                    <th>used</th>  
                    <th>Vessel</th> 
                </tr>
            </thead>
            <tbody> 
                <?php $no3 = 1; ?>
                @foreach ($consumption as $booking)
                <tr>      
                    <td>{{$no3++}}</td> 
                    <td>{{ $booking->date }}</td>
            <td>{{ $booking->machine }}</td>
            <td>{{ $booking->code_product }}</td>
            <td>{{ $booking->name_product }}</td>
            <td>{{ $booking->description }}</td>
            <td>{{ $booking->used }}</td>
            <td>{{ $booking->userc }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <h5>Stock Status</h5>
        <table >
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Product Code</th> 
                    <th>Product Name</th>
                    <th>Spec</th>
                    <th>Previous</th>
                    <th>Received</th> 
                    <th>Used</th>
                    <th>Transfered</th>
                    <th>Sounding</th> 
                    <th>Remain</th>  
                    <th>Vessel</th> 
                </tr>
            </thead>
            <tbody> 
                <?php $no4 = 1; ?>
                @foreach ($stock_status as $booking)
                <tr>      
                    <td>{{$no4++}}</td> 
                    <td>{{ $booking->date }}</td>
            <td>{{ $booking->code_product }}</td>
            <td>{{ $booking->name_product }}</td>
            <td>{{ $booking->spec }}</td>
            <td>{{ $booking->previous }}</td>
            <td>{{ $booking->received }}</td>
            <td>{{ $booking->used }}</td>
            <td>{{ $booking->transfered }}</td>
            <td>{{ $booking->sounding }}</td>
            <td>{{ $booking->remain }}</td>
            <td>{{ $booking->users }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    <br>
    <h5>Payload</h5>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Product Name</th>
                    <th>Previous</th> 
                    <th>Received</th>
                    <th>Transfered</th>
                    <th>Remain</th>  
                    <th>Vessel</th> 
                </tr>
            </thead>
            <tbody> 
                <?php $no5 = 1; ?>
                @foreach ($payload as $booking)
                <tr>   
                    <td>{{$no5++}}</td>    
                    <td>{{ $booking->date }}</td>
            <td>{{ $booking->product_name }}</td>
            <td>{{ $booking->previous }}</td>
            <td>{{ $booking->receive }}</td>
            <td>{{ $booking->transfer }}</td>
            <td>{{ $booking->remain }}</td>
            <td>{{ $booking->userp }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="container" style="text-align: right;">
            <h3>Jakarta, <?php echo date('d F Y'); ?></h3>
            <br>
            <br>
            <br>
            <h3>(__________________)</h3>
        </div>
        
</body>
</html>
