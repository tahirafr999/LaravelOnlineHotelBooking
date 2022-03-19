<!doctype html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <title>Want to Boo</title>
  </head>
  <body>

<div class="jumbotron d-flex">
<div class="col-md-6">
<form  action="" id="data_form">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Name</label>
      <input type="text" class="form-control" name="name" placeholder="Enter Name">
    </div>
    <div class="form-group col-md-6">
      <label>Surname</label>
      <input type="text" class="form-control" name="surename" placeholder="Enter Surname">
    </div>
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" name="email" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label>Phone Number</label>
    <input type="text" class="form-control" name="phone" placeholder="Phone Number">
  </div>
  <br>
  <label>Arrived Date</label>
  <div class="form-row">
    <div class="form-group col-md-4">
     <input class="form-control" type="date" name="arrived_date" id="">
     </div>
    <div class="form-group col-md-4">
      
    </div>
    <div class="form-group col-md-4">
     
     </div>


  <div class="form-group col-md-6">
    <label >Number of Nights</label>
    <select class="form-control number_of_nights">
        <option  selected>Select Number of Night</option>
        <option data-id="1">1 day</option>
        <option data-id="2">2 day</option>
      </select>
  </div>
  <div class="form-group col-md-6">
    <label >Number of Guests</label>
    <select class="form-control number_of_guests">
        <option selected>Select Number of Guests</option>
        <option data-id="1">1 person</option>
        <option data-id="2">2 person</option>

      </select>
  </div>
  <div class="form-group">
    <label>Total Price</label>
    <input type="text" class="form-control" id="total_price" name="total_price" value="" />
  </div>
</div>

<div class="form-group">
    <label>Notes</label>
    <textarea class="form-control" rows="1" name="notes"></textarea>
  </div>
  <button type="submit" class="btn btn-primary" id="submit-form">Sign in</button>
</form>



</div><!-- div col 6 -->

<table class="table ml-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
    </tr>
  </tbody>
</table>

</div><!-- jumbotron -->

  
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
  </body>
</html>

<script>
  $(document).ready(function(){

$.ajaxSetup({
         headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
         }
     });


//ADD NEW COUNTRY
$(document).on('submit', '#data_form', function(e){
  e.preventDefault();
  let formData = new FormData($('#data_form')[0]);

  $.ajax({
    type:"POST",
    url:"/hotel_data",
    data:formData,
    contentType:false,
    processData:false,
    success: function(response){
        $("#data_form")[0].reset();
        
      }
  });
});
});



$('.number_of_nights').change(function(){
  data =  ($(this).children('option:selected').data('id'));
  result = data * 5000;
});
$('.number_of_guests').change(function(){
  guest_data =  ($(this).children('option:selected').data('id'));
  guest_result = guest_data * result;
  document.getElementById("total_price").value= guest_result;

});
</script>

