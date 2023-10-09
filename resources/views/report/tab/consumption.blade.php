<div class="card-body">
    <div class="table-responsive">
    <table id="examplec" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Machine</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Description</th>  
                <th>used</th>  
                <th>vessel</th>
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
                <th>vessel</th>
            </tr>
        </tfoot>
        <tbody> 
            @foreach ($consumption as $booking)
            <tr>      
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
</div></div>
<!-- /.card-body -->
