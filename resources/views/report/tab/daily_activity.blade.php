<div class="card-body">
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Description</th>  
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Date</th>
                <th>Time From</th>
                <th>Time To</th>
                <th>Description</th> 
            </tr>
        </tfoot>
        <tbody> 
            @foreach ($getbooking as $booking)
            <tr>      
                <td>{{ $booking->date }}</td>
                <td>{{ $booking->time_from }}</td>
                <td>{{ $booking->time_to }}</td>
                <td>{{ $booking->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->
