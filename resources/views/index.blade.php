@extends('final_year_project.layouts.master')
@section('content')

<div class="jumbotron">
  <h2 class="text-center">Hotel Booking</h2>
<div class="row">
@foreach($frond_data as $data)
<div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <div class="row">
      <div class="col-md-6">
          <img class="hotel-img" src="{{ asset('images/' .$data->hotel_image) }}">
      </div>
        <div class="col-md-6">
         
        <h4 class="text-bold">{{$data->hotel_title}}</h4>
        <p style="font-size:13px;">{{$data->hotel_description}}</p>
        @if (Route::has('login'))
        @auth
        <a href="want-to-book" class="btn btn-primary">Want to Book</a>
        <!-- <a href="want-to-book" class="btn btn-primary">Add to Card</a> -->
        
        @else
        <!-- <a href="want-to-book" class="btn btn-primary">Want to Book</a> -->
        @endauth
        @endif
        </div><!-- inner col -->
        </div><!-- inner row -->
      </div><!-- card body -->
    </div><!-- card -->
  </div><!-- col -->
  @endforeach

</div><!-- row -->
</div><!-- jumbotron -->


<!-- other jumbotron -->
<div class="jumbotron" style="margin-top:-34px;">
<h2 class="text-center">Online Shopping Mall</h2>
  <div class="row">
    @foreach($ecommerceProduct as $Ecommerce)
  <div class="col-md-3 col-sm-3 d-flex align-self-stretch">
   <!--card  -->
  <div class="card shadow-sm mb-4" style="padding:18px;">
        <img src="{{ asset('images/'.$Ecommerce->photo) }}" class='card-img-top' style='height:250px;width:250px;'>
        <div class="card-body d-flex flex-column">
          <!-- <input type="hidden" name="" id="" value="{{$Ecommerce->id}}"> -->
            <h5 class="card-title text-uppercase">{{$Ecommerce->title}}</h5>
            <a href="" style='text-decoration:none; color:black'><p class='mt-3 font-weight-bold'>Category : <span>{{$Ecommerce->category}}</span></p>
            <a href="" style='text-decoration:none; color:black'><p class='mt-3 font-weight-bold'>Producr Price : <span>{{$Ecommerce->product_price}}</span></p>
            <div class="mt-auto text-center"> 
            @if (Route::has('login'))
            @auth
            <div class="d-flex">
            <a href="detailPageProduct/{{$Ecommerce->id}}" class='btn btn-success'>View Details </a>
            <button type='submit' data-id="{{$Ecommerce->id}}" class='btn btn-danger cartItemAdded'>Add to Cart</button>
            </div>
            @else
            <div class="d-flex">
            <a href="" class='btn btn-success'>View Details</a>
            <button type='submit'  data-id="{{$Ecommerce->id}}" class='btn btn-danger cartItemAdded'>Add to Cart</button>
            </div>
            @endauth
            @endif
          </div>
        </div>
    </div>
    <!-- card -->
</div>
  <!-- col-md -->
  @endforeach

  

  </div>
  <!-- row -->
</div>
<!-- other jumbotron -->


@endsection


<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>


<script>
  $(document).ready(function(){
  $(document).on('click','.cartItemAdded', function(e){
    var ecommerce_id = $(this).data('id');
    var a = JSON.stringify(["{{$ecommerceProduct}}"]);
    $.ajax({
      type: 'POST',
            url: '/countCart/'+ecommerce_id,
            data: {option: a,"_token": "{{ csrf_token() }}",},
            dataType: 'json',
           success:function(response){
            if(response.status == 200){
              toastr.success(response.message);
              // mydiv is on another page . Header page
              $("#mydiv").load(location.href + " #mydiv");
            

            }
           }
        });
  });

});
</script>