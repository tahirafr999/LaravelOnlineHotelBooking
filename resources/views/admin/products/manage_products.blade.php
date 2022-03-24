@extends('admin.layouts.master')
@section('content')
<div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table  class="table table-hover table-condensed" id="ProductTable">
                  <thead>
                  <tr>
                    <th>Product Title</th>
                    <th>Product Author</th>
                    <th>Product Phote</th>
                    <th>Product Category</th>
                    <th>Product Price</th>
                    <th>Product Description</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody</tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

     <div class="modal editProductModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <form method="post" id="update-product-form">
                    @csrf
                     <input type="hidden" name="pid" id="pid">
                     <div class="form-group">
                         <label for="">Product Title</label>
                         <input type="text" class="form-control" name="product_title" id="edit_product_title" >
                         <span class="text-danger error-text country_name_error"></span>
                     </div>
                     <div class="form-group">
                         <label for="">Product Author</label>
                         <input type="text" class="form-control" name="product_author" id="edit_product_author" >
                         <span class="text-danger error-text capital_city_error"></span>
                     </div>
                     <div class="form-group">
                         <label for="">Product Image</label><br>
                         <input type="file" name="product_image" id="edit_product_image">
                         <span class="text-danger error-text capital_city_error"></span>
                     </div>
                     <div class="form-group">
                         <label for="">Product Category</label>
                         <input type="text" class="form-control" name="product_category" id="edit_product_category" >
                         <span class="text-danger error-text capital_city_error"></span>
                     </div>
                     <div class="form-group">
                         <label for="">Product Description</label>
                         <input type="text" class="form-control" name="product_description" id="edit_product_description" >
                         <span class="text-danger error-text capital_city_error"></span>
                     </div>
                     <div class="form-group">
                         <label for="">Product Price</label>
                         <input type="text" class="form-control" name="product_price" id="edit_product_price" >
                         <span class="text-danger error-text capital_city_error"></span>
                     </div>
                     <div class="form-group">
                         <button type="submit" class="btn btn-block btn-success saveChanges">Save Changes</button>
                     </div>
                 </form>
                

            </div>
        </div>
    </div>
</div>

@endsection
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script>

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});

    $(document).ready(function () {
    //GET ALL COUNTRIES
    $('#ProductTable').DataTable({
                     processing:true,
                     info:true,
                     ajax:"{{ url('/product-display') }}",
                     columns:[
                         {data:'title', name:'product_title'},
                         {data:'author', name:'product_author'},
                  
                         {data: 'photo', name: 'product_image',
            render: function( data, type, full, meta ) {
                return "<img src=/images/" + data + " style='width:50px;height:50px;' />";
            }
            },
                         {data:'category', name:'product_category'},
                         {data:'product_price', name:'product_category'},
                         {data:'product_description', name:'product_description'},
                         {data:'actions', name:'actions'}

                     ]
                        //GET ALL COUNTRIES
                });

        $(document).on('click','#editProductBtn', function(e){
        e.preventDefault();
        pro_id = $(this).attr('data-id');          
        $('.editProductModel').modal('show');
        // alert(hot_id);

             
      $.ajax({
        type:"GET",
        url:"get_product_details/"+pro_id,
        success: function(response){
            if(response.status == 404){
                // alert(response.message);
                $('.editProductModel').modal('hide');
            }else{
                $('#edit_product_title').val(response.details.title);
                $('#edit_product_author').val(response.details.author);
                // $("#edit_product_image").attr('src', response.details.photo);
                $('#edit_product_category').val(response.details.category);
                $('#edit_product_description').val(response.details.product_description);
                $('#edit_product_price').val(response.details.product_price);
                $('#pid').val(pro_id);
            }
        }
      });


    });


    $(document).on('click', '.saveChanges', function(e){
      e.preventDefault();
      var id = $('#pid').val()
      let EditFormData = new FormData($('#update-product-form')[0]);
        $.ajax({
          type: "POST",
          url: "/update-product/"+id,
          data: EditFormData,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(response){
        //     // console.log(response);
            if(response.status == 200){
              $('#ProductTable').DataTable().ajax.reload(null, false);
              $('.editProductModel').modal('hide');
              $('.editProductModel').find('form')[0].reset();
              toastr.success(response.message);
            }
          }
        });

      });


 });
</script>