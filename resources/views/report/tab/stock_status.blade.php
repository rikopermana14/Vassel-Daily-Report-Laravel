<div class="card-body">
    <table id="examples" class="table table-bordered table-striped">
        <thead>
            <tr>
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
            </tr>
        </thead>
        <tfoot>
            <tr>
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
            </tr>
        </tfoot>
        <tbody> 
            @foreach ($stock_status as $booking)
            <tr>      
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
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->
