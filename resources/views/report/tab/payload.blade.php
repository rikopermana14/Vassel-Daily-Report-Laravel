<div class="card-body">
    <table id="examplep" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Product Name</th>
                <th>Previous</th> 
                <th>Received</th>
                <th>Transfered</th>
                <th>Remain</th>  
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Date</th>
                <th>Product Name</th>
                <th>Previous</th> 
                <th>Received</th>
                <th>Transfered</th>
                <th>Remain</th>  
            </tr>
        </tfoot>
        <tbody> 
            @foreach ($getbooking as $booking)
            <tr>      
                <td>{{ $booking->date_pay }}</td>
        <td>{{ $booking->name }}</td>
        <td>{{ $booking->previous }}</td>
        <td>{{ $booking->receive }}</td>
        <td>{{ $booking->transfer }}</td>
        <td>{{ $booking->remain }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->
