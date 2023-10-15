@extends('layout.index')
@section('content')


@if($errors->has('Product_Image'))
    <div class="alert alert-danger">
        {{ $errors->first('Product_Image') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Inventory </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-product">Home/</li>
              <li class="breadcrumb-product active">Add Inventory </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
<div class="col-lg-12">

  <div class="card">
              <div class="card-header">
              
              </div>
               <!-- /.card-header -->
              <div class="card-body">
                

           <div class="row">
            <div class="col-sm">
                <div class="form-group">
                     <form action="{{ isset($product) ? route('product.update',Crypt::encrypt ($product->id)): route('store-product') }}" method="post" enctype="multipart/form-data">
                      @csrf
              <label>Product Code</label>
              <input type="text" class="form-control" name="ID_Product_Code" placeholder="Product Code" value="{{ isset($product) ? $product->product_id : '' }}">
              <p></p>
            <label>Spesification</label>
            <input type="text" class="form-control" name="Product_Spec"value="{{ isset($product) ? $product->spec : '' }}">
          </div>
        </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>Product Name</label>
              <input type="text" class="form-control" name="Product_Name" placeholder="Product Name"value="{{ isset($product) ? $product->name : '' }}">
              <p></p>
              <label>Product Type</label>
          <select class="form-control select2bs4" name="ID_Product_Type" value="{{ isset($product) ? $product->type : '' }}">
                     		<option value="AHU">Heating Ventilation Air Conditioning</option>
                   		<option value="BMT">Building Material</option>
                   		<option value="DEQ">Deck Equipment</option>
                   		<option value=""></option>
                     </select>
            </div>
            </div>
            <div class="col-sm">
                <label>Select Image Product</label>
         <input id="file1" type="file" class="form-control" name="Product_Image" accept="image/*" name="foto" onchange="readURL(this);">
<br/>
          <img id="preview_img" src="https://www.w3adda.com/wp-content/uploads/2019/09/No_Image-128.png"
                        alt="preview image" style="max-height: 250px;">


 
            </div>
           </div>
        

            <div class="row">
                <div class="col-sm">
                <div class="form-group">
                <label>Product Alias</label>
                <input type="text" class="form-control" name="Product_Alias"value="{{ isset($product) ? $product->alias : '' }}">
                </div>
                </div>
            <div class="col-sm">
            <div class="form-group">
            <label>Unit</label>  
            <select class="form-control" name="Product_Unit"value="{{ isset($product) ? $product->unit : '' }}">
              <option>Liter</option>
              <option>Tons</option>
              <option>Bottle</option>
              <option>Sachet</option>
              <option>Unit</option>
            </select>
            </div>
            </div>
            <div class="col-sm">
              <div class="form-group">
              <label>Stock</label>
              <input type="number" class="form-control" name="stock"value="{{ isset($product) ? $product->stock : '' }}">
              </div>
              </div>

            </div>

            <div class="row">
            <div class="col-sm">
            <div class="form-group">
            <label>Min Order</label>  
            <input type="text" class="form-control" name="Min_Order"value="{{ isset($product) ? $product->min : '' }}">
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
              <label>Lead Time</label>
              <input type="text" class="form-control" name="Lead_Time"value="{{ isset($product) ? $product->lead : '' }}">
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
              <label>Delivery Time</label>
              <input type="text" class="form-control" name="Delivery_Time"value="{{ isset($product) ? $product->delivery : '' }}">
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
              <label>Idle Time</label>
              <input type="text" class="form-control" name="Idle_Time"value="{{ isset($product) ? $product->idle : '' }}">
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
              <label>Volume (mm3)</label>
              <input type="text" class="form-control" name="Volume"value="{{ isset($product) ? $product->volume : '' }}">
            </div>
            </div>
            <div class="form-group">
              <label for="vessel">vessel:</label>
              <select name="vessel" id="vessel" class="form-control">
                  @foreach($users as $vessel)
                  <option  value="{{ isset($vessel) ? $vessel->id : '' }}">{{ isset($vessel) ? $vessel->name : '' }}</option>
  @endforeach
</select>
            </div>
            </div>
            </div>

            <div class="row">
            
            
            </div>

  </div>

   <div class="card-footer">
       <a href="/product"> <button type="button" class="btn btn-warning" data-dismiss="modal">Back</button></a>
            <button class="btn btn-info" type="submit">Save</button>
            </form>
</div>

</div>
</div>
</div>
</div>

<script type="text/javascript">
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview_img')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(document).on('change', 'select.selectgroup', function() {
      var r = $('select.selectgroup option[value="'+$(this).val()+'"]').attr("data-group")
      $("#group").val(r)
    });
    </script>
     <script>
    $(document).on('change', 'select.selectmaterial', function() {
      var r = $('select.selectmaterial option[value="'+$(this).val()+'"]').attr("data-material")
      $("#material").val(r)
    });
    </script>

@endsection