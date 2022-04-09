@extends('final_year_project.layouts.master')
@section('content')
<div class="container-fluid">
<!--section start -->
<section >
    <div class="row">
        <div class="col-md-7 col-sm-6 col-xs-12">
            <h1 class="mt-5 ml-5 font-weight-light">My Lists</h1>
              <h2 class="ml-5 mt-4 font-weight-light">Cart (2 items)</h2> 
              @foreach($product as $cart) 
             <div class="card mt-5 mb-5 ml-5" id="test_card">
                <div class="card-body"> 
                    <!-- card inner row -->
                    <div class="row">
                        <!-- card inner col -->
                        <div class="col-md-3 col-xs-6"> 
                        <img src="{{ asset('images/'.$cart->product_image) }}" alt="" style="width:50px; height:50px;">
                        </div> 
                        <!-- card inner col -->
                         <!-- card inner col -->
                         <div class="col-md-5 col-xs-6" style="margin-left:101px;">
                          <p style="font-size:20px;">{{$cart->product_name}}</p>
                          <p class="text-muted" style="font-size:20px;">{{$cart->product_author}}</p>
                          <p class="text-muted" style="font-size:20px;">{{$cart->product_category}}</p>
                          <input type="text" class="text-muted" style="font-size:20px;"  value="{{$cart->product_price}}"> <span></span></p>
                          <input class="iprice" type="hidden" value="{{$cart->product_price}}" data-id="{{$cart->product_id}}">
                          <p class="mr-4"><a href='cart_details.php?cart_product_id=$id'><i class='fa fa-trash-o fa-2x mt-4'></i><a href='cart_details.php?cart_product_id=$id'><span style='text-decoration:none;margin-left:15px;'>Remove Item</span></a></p>
                        </div> 
                        <!-- card inner col -->
                         <!-- card inner col -->
                        <div class="col-md-2 col-xs-6 ">
                            <?php $quantity = 1; ?>
                            {{$id = $cart->product_id }}
                            <input type="text" name="" value="<?php echo $quantity ?>" id="quantityvalue" />
                        <!-- <div class="btn-group float-left" role="group" aria-label="Basic example" style="border:1px solid black; border-radius:5px;width:200px; padding:5px;"> -->
                        <!-- <button type="button" class="btn btn-default"  onclick="minusbot(<?php // echo $id;?>)"><i class="fa fa-minus" aria-hidden="true"></i></button> -->
                        <!-- <input type="text" name="kgcount" value="1" id = "kilohere_<?php //echo $id; ?>" style="width:110px;height:25px;margin-top:8px; text-align:center;"> -->
                        <input class="iquantity text-center" id="iquantity" type="number" value="1" data-id="{{$cart->product_id}}"  min="1" max="10" />
                        <!-- <div class="cart-info quantity d-flex">
                        <div class="btn-increment-decrement btn-default" style="width:50px;" onClick="decrement_quantity({{$cart->product_id}})" >-</div>
                        <input class="input-quantity" type="number" onClick="increment_quantity()" value="<?php echo $quantity; ?>" data-id="{{$cart->product_id}}"  style="width:50px;">
                        <div class="btn-increment-decrement btn-default" style="width:50px;"
                        onClick="increment_quantity({{$cart->product_id}})" data-id="{{$cart->product_id}}">+</div>
                        </div> -->
                        <!-- <button type="button" class="btn btn-default mb-1" onclick="plusbot('<?php // echo $id ?>','<?php //echo $product_price ?>','<?php //echo $total ?>','<?php //echo $quantity ?>')"><i class="fa fa-plus" aria-hidden="true"></i></button> -->
                        <!-- </div> -->
                        <p class="total_cart font-weight-bold">RS:<span class="total_cart itotal ml-3"></span></p>
                        <!-- <P  class="total_cart" id="tell_<?php //echo $id;?>"><?php //echo $product_price; ?></P> -->
                        <!-- <p><?php //echo $phpvar = "<script>document.writeln(adding_product_price)</script>";?> </p> -->
                        </div> 
                        <!-- card inner col -->
                    </div>
                     <!-- card inner row -->                 
                </div>  <!-- card body-->
            </div>  <!-- card -->    
            @endforeach  
        </div>   <!-- col -->
        
        <!-- col 2 -->
        <div class="col-md-5 col-sm-6 col-xs-12">
            <h1 class="ml-5 font-weight-light" style="margin-top:113px;">Total Amount of</h1>
             <div class="card mt-5 mb-5 ml-5"  style="margin-top:100px;">
                <div class="card-body"> 
                    <!-- card inner row -->
                    <div class="row">
                        <!-- card inner col -->
                        <div class="col-md-12 col-xs-6">
                           <form action="checkout_details.php" method="POST">
                           <h2>Grand Amount :<span class="mt-5 ml-5"  id="gtotal"></span></h2>
                           <input type="hidden" name="tglobal" id="tglobal" >
                           <button type="submit" name="add_to_checkout" class="btn btn-primary btn-block mt-5 p-3">Go to Checkout</button>
                           <!-- <a href="online_payment.php" type="submit" name="add_to_checkout" class="btn btn-success btn-block p-3">Online Payment</a> -->

                        </form>
                        </div> 
                        <!-- card inner col -->

                    </div>
                     <!-- card inner row -->
                    
                </div>  <!-- card body-->
            </div>  <!-- card -->
        </div>   <!-- col -->

        <!-- col 2 -->

    </div>   <!-- row -->
</section>
<!-- section end -->
</div>

@endsection
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>



<script>
 
// function increment_quantity() {
//     let  cart_id_second = $(this).data('id');
//     alert(cart_id_second);return;
//     var inputQuantityElement = $("#input-quantity-"+cart_id);
   
//     var newQuantity = parseInt($(inputQuantityElement).val())+1;
//     save_to_db(cart_id, newQuantity);
// }

// function decrement_quantity(cart_id) {
//     var inputQuantityElement = $("#input-quantity-"+cart_id);
//     if($(inputQuantityElement).val() > 1) 
//     {
//     var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
//     save_to_db(cart_id, newQuantity);
//     }
// }

// function save_to_db(cart_id, new_quantity) {
// 	var inputQuantityElement = $("#input-quantity-"+cart_id);
//     $.ajax({
// 		url : "update_cart_quantity.php",
// 		data : "cart_id="+cart_id+"&new_quantity="+new_quantity,
// 		type : 'post',
// 		success : function(response) {
// 			$(inputQuantityElement).val(new_quantity);
// 		}
// 	});
// }



   
   $(document).ready(function(){
  $(document).on('click','.iquantity', function(e){
    var value = parseInt(document.getElementById('quantityvalue').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  var see =  document.getElementById('quantityvalue').value = value;
  alert(see); return;
  price = '$'+`<span>${p * value}</span>`;
  document.getElementById('product-price').innerHTML=price;

  //   let cart_id = $(this).data('id');
  //     addvalue = document.getElementById("quantityvalue_"+<?php echo $id; ?>).value;
  //     var x=parseInt(addvalue)+1;
  //     // var s= document.getElementById("quantityvalue");
  //      s.value = x;
  //   // var newQuantity = cart_id+1;
  //   alert(x);  return;
  //   // var data = document.getElementById("iquantity").value ;
  //   var data2 = document.getElementById("quantityHidden").value=data ;
  //   var a = JSON.stringify(["{{$cart}}"]);
  //   $.ajax({
  //     type: 'POST',
  //           url: "/CartGrandPrice/"+cart_id+"/"+data2,
  //           data: {option: a,"_token": "{{ csrf_token() }}",},
  //           dataType: 'json',
  //           success:function(response){
  //           if(response.status == 200){
  //             toastr.success(response.message);
  //             $("#mydiv").load(location.href + " #mydiv");

  //           }
  //          }

  //   });

  });
});


</script>