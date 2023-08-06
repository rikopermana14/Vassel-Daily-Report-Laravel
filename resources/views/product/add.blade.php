@extends('layout.index')
@section('content')

<div class="wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Product </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Product </li>
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
                     <form action="#" method="post" enctype="multipart/form-data">
              <label>Product Code</label>
              <input type="text" class="form-control" name="ID_Product_Code" placeholder="Product Code">
              <p></p>
            <label>Spesification</label>
            <input type="text" class="form-control" name="Product_Spec">
          </div>
        </div>
            <div class="col-sm">
                <div class="form-group">
                    <label>Product Name</label>
              <input type="text" class="form-control" name="Product_Name" placeholder="Product Name">
              <p></p>
              <label>Product Type</label>
          <select class="form-control select2bs4" name="ID_Product_Type">
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
                <input type="text" class="form-control" name="Product_Alias">
                </div>
                </div>
            <div class="col-sm">
            <div class="form-group">
            <label>Unit</label>  
            <select class="form-control" name="Product_Unit">
              <option>Bottle</option>
              <option>Sachet</option>
              <option>Unit</option>
            </select>
            </div>
            </div>

            </div>

            <div class="row">
            <div class="col-sm">
            <div class="form-group">
            <label>Min Order</label>  
            <input type="text" class="form-control" name="Min_Order">
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
              <label>Lead Time</label>
              <input type="text" class="form-control" name="Lead_Time">
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
              <label>Delivery Time</label>
              <input type="text" class="form-control" name="Delivery_Time">
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
              <label>Idle Time</label>
              <input type="text" class="form-control" name="Idle_Time">
            </div>
            </div>
            <div class="col-sm">
            <div class="form-group">
              <label>Volume (mm3)</label>
              <input type="text" class="form-control" name="Volume">
            </div>
            </div>
            </div>

            <div class="row">
            
            
            </div>

  </div>

   <div class="card-footer">
       <a href="#"> <button type="button" class="btn btn-warning" data-dismiss="modal">Back</button></a>
            <button class="btn btn-info" type="submit">Save</button>
            </form>
</div>

</div>
</div>
</div>
</div>
</body>
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