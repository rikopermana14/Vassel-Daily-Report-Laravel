<div class="card-body">
    <table id="examplec" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Machine</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Description</th>  
                <th>used</th>  
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Date</th>
                <th>Machine</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Description</th>  
                <th>used</th> 
            </tr>
        </tfoot>
        <tbody> 
            @foreach ($getbooking as $booking)
            <tr>      
                <td>{{ $booking->datecon }}</td>
        <td>{{ $booking->machine }}</td>
        <td>{{ $booking->con_code }}</td>
        <td>{{ $booking->con_name }}</td>
        <td>{{ $booking->con_desc }}</td>
        <td>{{ $booking->con_used }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->
