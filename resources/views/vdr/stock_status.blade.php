<div class="card-body">
  <ul class="nav nav-pills ml-auto p-2">
    <li class="nav-item">
      <a id="addTabLink" class="nav-link" href="#tab_7" data-toggle="tab">ADD</a>
    </li>
  </ul>
  <table id="example" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Specifications</th>
            <th>Previous</th>
            <th>Recived</th>
            <th>Used</th>
            <th>Transfer</th>
            <th>Sound</th>
            <th>Remain</th>
        </tr>
    </thead>
    <tbody>
        <tr> @foreach ($stock as $item)
          <td>{{ $item->tanggal }}</td>
          <td>{{ $item->product_id }}</td>
          <td>{{ $item->name }}</td>
          <td>{{ $item->spec }}</td>
          <td>{{ $item->previous }}</td>
          <td>{{ $item->receive }}</td>
          <td>{{ $item->use }}</td>
          <td>{{ $item->transfer }}</td>
          <td>{{ $item->soud }}</td>
          <td>{{ $item->remain }}</td>
          @endforeach
        </tr>
    </tbody>
</table>

<div class="tab-content">
<div class="tab-pane" id="tab_7">
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Date</label>
        <div class="input-group date" id="stock_date" data-target-input="nearest">
          <input name="stock_date" type="text" class="form-control datetimepicker-input" data-target="#stock_date"/>
          <div class="input-group-append" data-target="#stock_date" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Product Code</label>
        <input type="text" name="product_code" class="form-control" id="productkode" readonly>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Product Name</label>
        <select class="form-control" name="product_name" id="productnama">
          <option value="">-Pilih Product-</option>
          @foreach ($data as $item)
            <option value="{{ $item->name }}">{{ $item->name }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
    
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Spec</label>
        <textarea class="form-control" name="spec" rows="5"></textarea>
      </div>
    </div>
  </div>
  
  <!-- Add the remaining input fields with proper name attributes -->
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Previous</label>
        <input type="text" name="previous" class="form-control">
      </div>
    </div>
  </div>
  
   <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>Received</label>
    <input type="text" name="received" class="form-control">
    </div>
    </div>
  </div>
  
   <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>Used</label>
    <input type="text" name="used" class="form-control">
    </div>
    </div>
  </div>
  
   <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>Transfered</label>
    <input type="text" name="transfer" class="form-control">
    </div>
    </div>
  </div>
  
   <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>Sounding</label>
    <input type="text" name="sound" class="form-control">
    </div>
    </div>
  </div>
  
   <div class="row">
    <div class="col-sm-6">
    <div class="form-group">
      <label>Remain</label>
    <input type="text" name="remain" class="form-control">
    </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const produkkode = document.getElementById("productkode");
      const produknama = document.getElementById("productnama");
      const dataproduk = {!! json_encode($data) !!}; // Memasukkan data produk dari PHP ke JavaScript
  
      produknama.addEventListener("change", function () {
        const selekproduknama = produknama.value;
        const selekproduk = dataproduk.find(product => product.name === selekproduknama);
  
        if (selekproduk) {
          produkkode.value = selekproduk.product_id;
        } else {
          produkkode.value = "";
        }
      });
    });
  </script>
  
  
</div>
</div>
</div>



