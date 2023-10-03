<div class="card-body">
    <div class="table-responsive">
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
            @foreach ($payload as $booking)
            <tr>      
                <td>{{ $booking->date }}</td>
        <td>{{ $booking->product_name }}</td>
        <td>{{ $booking->previous }}</td>
        <td>{{ $booking->receive }}</td>
        <td>{{ $booking->transfer }}</td>
        <td>{{ $booking->remain }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div></div>
<!-- /.card-body -->
