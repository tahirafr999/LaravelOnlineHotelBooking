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
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <form action="" method="POST" id="data-form">
         
                  <ul class="alert alert-warning d-none" id="save_errorList"></ul>
                  <div class="form-group">
                  <label>Product Name</label>
                  <input type="text" class="form-control" name="hotel_title" id="hotel_title" placeholder="Enter Product Name">
                  <small class="form-text text-muted error-text hotel_title_error">We'll never share your email with anyone else.</small>
                  </div>

                  <div class="form-group">
                  <label>Product Author</label>
                  <input type="text" class="form-control" name="product_author" id="product_author" placeholder="Enter Product Author Name">
                  <small class="form-text text-muted error-text hotel_title_error">We'll never share your email with anyone else.</small>
                  </div>

                  <div class="form-group">
                  <label>Product Image</label>
                  <input type="file" class="form-control" id="hotel_image" name="hotel_image">
                  <small id="hotel_title" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  </div>

              </div>
              <!-- /.col -->
              <div class="col-md-6">
                  <div class="form-group">
                  <label>Product Category</label>
                  <div class="select2-purple">
                    <select class="select2" multiple="multiple"  name="product_category" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                      <option>Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
                  </div>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label>Product Description</label>
                  <textarea  class="form-control" id="hotel_description" name="hotel_description"></textarea>
                  <small id="hotel_title" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  </div>

                  <div class="form-group">
                  <label>Tags</label>
                  <div class="select2-purple">
                    <select class="select2" multiple="multiple" name="tags" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                      <option>Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
                  </div>
                </div>
                <!-- /.form-group -->

              </div>
              <!-- /.col -->
            <!-- </div> -->
            <!-- /.row -->
          
          </div>
          <!-- /.card-body -->
          <div class="card-footer"> 
           <button type="submit" class="btn btn-primary btn-block">Submit</button>
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


    $(document).on('submit', '#data-form', function(e){
      e.preventDefault();
      let formData = new FormData($('#data-form')[0]);

      $.ajax({
        type:"POST",
        url:"/employee",
        data:formData,
        contentType:false,
        processData:false,
        success: function(response){
          if(response.status == 400){
            $('#save_errorList').html("");
            $('#save_errorList').removeClass('d-none');
            $.each(response.errors, function(key, err_value){
              $('#save_errorList').append('<li>'+err_value+'</li>');
            });
          }else if(response.status == 200){
            $('#save_errorList').html("");
            $('#save_errorList').addClass('d-none');
            $("#data-form")[0].reset();
            // alert(response.message);
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