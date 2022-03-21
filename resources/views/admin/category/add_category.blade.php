@extends('admin.layouts.master')
@section('content_for_working')
<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Category</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
            <div class="col-md-12">
                @if($message = Session::get('Success'))
                <div class="alert alert-success"  id="alertMessage">
                <p>{{$message}}</p>
                </div>
                @endif
               <form id="myForm">
               @csrf
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Category Name</label>
                  <input class="form-control" type="text" name="cat_name"  value="{{old('cat_name')}}" id="">
                   <span class="text-danger">@error('cat_name') {{$message}} @enderror</span>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            




              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
             <div class="card-footer">
           <button id="submit" class="btn btn-primary btn-block">Add Category</button>
          </div>
          
          </div>
          <!-- /.card-body -->
         
                       
          </form>
                <!-- form -->
        </div>
        <!-- /.card -->



        <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                            <table class="table table-hover table-condensed" id="CategoryTable">
                            <thead>
                            <th>Category Name</th>
                            <th>Action</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- Modal -->
<div class="modal fade editCountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="updatecategoryform" >
        @csrf
        <input type="hidden" name="cid" id="cid">
    <div class="form-group">
      <label>Category Name</label>
      <input class="form-control" type="text" name="cat_name">
        <span class="text-danger">@error('cat_name') {{$message}} @enderror</span>
    </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="update-data">Submit</button>
      </div>
    </div>
  </div>
</div>











      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- add product form end here -->



    <!-- edit model -->










    
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

  $(document).ready(function () {
$('#submit').click(function(e) {
  e.preventDefault();

  $.ajax({
    url: "{{ url('category_added') }}",
    type: "POST",
    datatype: "json",
    data: $('#myForm').serialize(),
    success: function(response){
      $('#myForm')[0].reset();
      console.log(response);
      table.ajax.reload();
      toastr.success(response.msg);

    }
  });

}); //insert data here

  //GET ALL COUNTRIES
  $('#CategoryTable').DataTable({
                     processing:true,
                     info:true,
                     ajax:"{{ url('/category_display') }}",
                     columns:[
                         {data:'cat_name', name:'cat_name'},
                         {data:'actions', name:'actions'}

                     ]
                        //GET ALL COUNTRIES
                });


                $(document).on('click','#editCountryBtn', function(){
                    var category_id = $(this).data('id');
                    $('.editCountry').find('form')[0].reset();
                    $.post('<?= url("get_category_details") ?>',{category_id:category_id}, function(data){
                      $('.editCountry').find('input[name="cid"]').val(data.details.id);
                        $('.editCountry').find('input[name="cat_name"]').val(data.details.cat_name);
                        $('.editCountry').modal('show');
                    },'json');
                });


                  //UPDATE COUNTRY DETAILS
                  $('#update-data').on('click', function(e){
                    e.preventDefault();
                    var id = $('#cid').val()
                    let EditFormData = new FormData($('#updatecategoryform')[0]);

                    $.ajax({
                      type: "POST",
                      url: "/updateCategoryDetails/"+id,
                      data: EditFormData,
                        processData:false,
                        contentType:false,
                        dataType:"json",
                        success: function(response){
        //     // console.log(response);
            if(response.status != 200){
            $('#update_errorList').html("");
            $('#update_errorList').removeClass('d-none');
            $.each(response.errors, function(key, err_value){
            $('#update_errorList').append('<li>'+err_value+'</li>');
            });
            }
            else{
              $('#update_errorList').html("");
              $('#success_message').addClass('d-none');
              $('.editCountry').modal('hide');
              $('#CategoryTable').DataTable().ajax.reload(null, false);
              toastr.success(response.message);
            }
          }
                    });
                });






     $.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});
   
});// document ready
</script>