@extends('final_year_project.layouts.master')
@section('content')
  <!-- Start Cart  -->
  <div class="cart-box-main">
      <a href="{{URL('EcommerceProductController@getAllProducts')}}"></a>
            @if(Session::has('flash_message_error'))
            <div class="alert alert-sm alert-danger alert-block" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
               </button>
               <strong>{!! session('flash_message_error') !!}</strong>
            </div>
            @endif
            
            @if(Session::has('flash_message_success'))
            <div class="alert alert-sm alert-success alert-block" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
               </button>
               <strong>{!! session('flash_message_success') !!}</strong>
            </div>
            @endif
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <p id="msg"></p>
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_amount = 0; ?>
                                @foreach($product as $cart)
                                <tr>
                                    
                                    <td class="thumbnail-img">
                                        <a href="#">
									<img class="img-fluid" src="{{ asset('images/'.$cart->product_image) }}"  alt="" style="width:50px;height:50px;" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        
								                  	{{$cart->product_name}}
                                    <!-- <p>{{$cart->product_code}} | {{$cart->size}}</p> -->
                                    </td>
                                    <td class="price-pr">
                                        <p>PKR {{$cart->product_price}}</p>
                                    </td>
                                <td class="quantity-box">
                                   
                                <a href="#"  class="increment" data-id="{{$cart->product_id}}" style="font-size:25px;">+</a>
                            
                                    <input type="text" size="4"  value="{{$cart->quantity}}" min="0" step="1" class="c-input-text qty text">
                                 
                                    @if($cart->quantity>1)
                                    <a href="{{url('/cart/update-quantity/'.$cart->id.'/-1')}}"  style="font-size:25px;">-</a>
                                   @endif
                                </td>
                                    <td class="total-pr">
                                    <p>PKR {{$cart->product_price*$cart->quantity}}</p>
                                    </td>
                                    <td class="remove-pr">
                                    <a href="{{url('/cart/delete-product/'.$cart->id)}}">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                <?php $total_amount = $total_amount + ($cart->product_price*$cart->quantity); ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-6">
                    <div class="coupon-box">
                        <form action="{{url('/cart/apply-coupon')}}" method="post"> {{csrf_field()}}
                        <div class="input-group input-group-sm w-75">
                            <input class="form-control" placeholder="Enter your coupon code" name="coupon_code" aria-label="Coupon code" type="text">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">Apply Coupon</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        @if(!empty(Session::get('CouponAmount')))
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> PKR <?php echo $total_amount; ?> </div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Coupon Discount</h4>
                            <div class="ml-auto font-weight-bold"> PKR <?php echo Session::get('CouponAmount'); ?> </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> PKR  <?php echo $total_amount - Session::get('CouponAmount'); ?> </div>
                        </div>
                        <hr>
                        @else
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> PKR  <?php echo $total_amount; ?> </div>
                            <input type="hidden" id="total_amount" value="<?php echo $total_amount; ?>">
                        </div>
                        @endif
                      
                    </div>
                    <div class="col-12 shopping-box btn btn-info checkout_amount"><a href="checkout" class="text-white text-center">Checkout</a>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>

<script>
    // function increment_quantity(product_id) {
    //         let id = product_id;
    //         document.getElementById('setValue').value = id;
    //     }
</script>
<script>
 $(document).ready(function(){
    $(document).on('click','.increment', function(e){
        e.preventDefault() ;
    var cart_id = $(this).data('id');
    $.ajax({
        url: "/cart/update-quantity/1/"+cart_id,
        
        success:function(response){
            // document.getElementById('#qty_text').value+1;
            // $("#msg").html(data);
            //     $("#msg").fadeOut(2000);
           
           
            toastr.success(response.message);
             window.location.reload();

            // $("#msg").append("success"+message);
            

            },
      });
    });

    // $(document).on('click','.checkout_amount', function(e){
    //     e.preventDefault() ;
    //     var totalAmount = $('#total_amount').val(); 
    //     // alert(totalAmount);
    //     $.ajax({
    //     url: "/checkout/"+totalAmount
        
    //     });
    // });

    });
</script>

<!-- var str,
            element = document.getElementById('qty_text');
            if (element != null) {
            str = element.value + 1;
            alert(str);
            }
            else {
            str = null;
            } -->



