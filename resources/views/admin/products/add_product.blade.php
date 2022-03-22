@extends('admin.layouts.master')

@section('content_for_working')
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Product</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
            </div>
          </div>
          <!-- <ul class="alert alert-warning d-none" id="save_errorList"></ul> -->
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
               <form action="" method="POST" id="data-form">
                <div class="form-group">
                  <label>Product Title</label>
                  <input type="text" class="form-control" name="product_title" id="product_title"  placeholder="Enter Product title">
                 <div class="error_all">
                 <small class="form-text text-muted error-text product_title_error" id="product_title_error"></small>
                 
                 </div>
                  
                </div>
                <!-- /.form-group -->
                  <div class="form-group">
                  <label>Product Author</label>
                  <input type="text" class="form-control" name="product_author" id="product_author" placeholder="Enter Product Author">
                  <small class="form-text text-muted error-text hotel_title_error" id="product_author_error"></small>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Product Image</label>
                  <input type="file" class="form-control" id="product_image" name="product_image">
                  <small id="product_image" class="form-text text-muted"></small>
                  </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                  <label>Product Price</label>
                  <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter Product Price">
                  <small class="form-text text-muted error-text hotel_title_error"></small>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Product Category</label>
                  <input type="text" class="form-control" name="product_category" id="product_category" placeholder="Enter Product Category">
                  <small class="form-text text-muted error-text hotel_title_error"></small>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Product Description</label>
                 <textarea name="product_description" class="form-control" id="" cols="10" rows="1"></textarea>
                 <small class="form-text text-muted error-text hotel_title_error" id="product_description_error"></small>

                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->


          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button type="submit" id="data_form" class="btn btn-primary btn-block">Submit</button>
          </div>
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- add product form end here -->
@endsection
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>

<script>
   $(document).ready(function(){
     $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
         });
 
    $(document).on('click', '#data_form', function(e){
      e.preventDefault();
      let formData = new FormData($('#data-form')[0]);
      $.ajax({
        type:"POST",
        url:"/add-Ecommerce-product",
        data:formData,
        contentType:false,
        processData:false,
        success: function(response){
          if(response.status == 400){
            $.each(response.message, function(key, val) {
            $("#" + key + "_error").text(val[0]);
            });
          }else if(response.status == 200){
            $("#data-form")[0].reset();
            $('.error-text').hide();
            toastr.success(response.message);
          }

        }
      });
    });
  });
  // $(function() {
  //   $('#submit_button').on('click', function(e){
  //     e.preventDefault();
  //    var form = this;
  //    $.ajax({
  //      url: $(form).attr('action'),
  //      method:$(form).attr('method'),
  //      data:new FormData(form),
  //      processData:false,
  //      dataType:'json',
  //      contentType:false,
  //      beforeSend function(){
  //       $(form).find('small.error-text').text('');
  //      },
  //      success function(data){
  //       if(data.code == 0){
  //         $.each(data.error, function(prefix,val){
  //           $(form).find('small.'+prefix+'_error').text(val[0]);
  //         });
  //       }else{
  //         $(from)[0].reset();
  //         alert('submiot');
  //       }
  //      }
  //    });

  //   });

    
  // })
</script>