@extends('admin.layouts.master')
@section('content_for_working')

<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Manage Hotel Details</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">


           <!-- edit model -->
      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Hotel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="updateForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="hot_id" id="hot_id">
      <ul class="alert alert-warning d-none" id="update_errorList"></ul>
      <div class="form-group">
    <label>Hotel Name</label>
    <input type="text" class="form-control" name="hotel_title" id="edit_hotel_title" >
    <small class="form-text text-muted">We'll never sh are your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Hotel Image</label>
    <input type="file" class="form-control" name="hotel_image">
  </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_hotel">Update</button>
      </div>
</form>
    </div>
  </div>
</div>


       
<div id="success_message"></div>
<table class="table" id="hotel_details_table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Hotel Name</th>
      <th scope="col">Hotel Image</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>

    </tr>
  </thead>
  <tbody>
   
  @foreach ($hoteltable as $hotel)
    <tr>
      <td>{{$hotel->id}}</td>
      <td>{{$hotel->hotel_title}}</td>
      <td>
        <img src="{{asset('images/'.$hotel->hotel_image)}}" width="70px" height="70px">
      </td>
      <td>
        <a href="" data-id="{{$hotel->id}}}" class="btn btn-info btn-sm hotel_id" name="hotel_id">Edit</a>
      </td>

      <td>
        <!-- <form action="" method="POST"> -->
          <!-- @csrf -->
          <!-- @method('DELETE') -->
          <button data-id="{{$hotel->id}}}" class="btn btn-danger btn-sm deleteCountryBtn">Delete</button>

        <!-- </form> -->
      
      </td>



    </tr>
    @endforeach
  </tbody>
</table>
          </div>
          <!-- /.card-body -->
    
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->

     



    </section>
    <!-- /.content -->
    <!-- manage product end here -->

@endsection
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>

<script>

        //DELETE COUNTRY RECORD
        $(document).on('click','.deleteCountryBtn', function(){          
                    var country_id = $(this).data('id');
                     var url = "delete-hotel/"+country_id;
                    swal.fire({
                         title:'Are you sure?',
                         html:'You want to <b>delete</b> this country',
                         showCancelButton:true,
                         showCloseButton:true,
                         cancelButtonText:'Cancel',
                         confirmButtonText:'Yes, Delete',
                         cancelButtonColor:'#d33',
                         confirmButtonColor:'#556ee6',
                         width:300,
                         allowOutsideClick:false
                    }).then(function(result){
                          if(result.value){
                              $.get(url,{country_id:country_id}, function(data){
                                $("#hotel_details_table").load(window.location + " #hotel_details_table");
                                toastr.error(data.msg);
                              },'json');
                          }
                    });

                });



    $(document).on('click','.hotel_id', function(e){
        e.preventDefault();
        hot_id = $(this).attr('data-id');
    
        $('#editModal').modal('show');
        // alert(hot_id);

             
      $.ajax({
        type:"GET",
        url:"edit-hotel/"+hot_id,
        success: function(response){
            if(response.status == 404){
                alert(response.message);
                $('#editModal').modal('hide');
            }else{
                $('#edit_hotel_title').val(response.hotel.hotel_title);
                $('#hot_id').val(hot_id);
            }
        }
      });

      $(document).on('click', '.update_hotel', function(e){
      e.preventDefault();
      var id = $('#hot_id').val()
      let EditFormData = new FormData($('#updateForm')[0]);
      

        $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
         });


        $.ajax({
          type: "POST",
          url: "/update-employee/"+id,
          data: EditFormData,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(response){
        //     // console.log(response);
            if(response.status == 400){
            $('#update_errorList').html("");
            $('#update_errorList').removeClass('d-none');
            $.each(response.errors, function(key, err_value){
            $('#update_errorList').append('<li>'+err_value+'</li>');
            });
            }
            else{
              $('#update_errorList').html("");
              $('#success_message').addClass('d-none');
              $('#editModal').modal('hide');
              $("#hotel_details_table").load(window.location + " #hotel_details_table");
              toastr.success(response.message);
            }
          }
        });

      });


    });
    
</script>