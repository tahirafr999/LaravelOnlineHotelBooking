@extends('final_year_project.layouts.master')
@section('content')
<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_amount = 0; ?>
                            @foreach($checkoutDetailPage as $cart)
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="#">
                                <img class="img-fluid" src="{{asset('images/'.$cart->product_image)}}" alt="" style="width:50px;height:50px;" />
                            </a>
                                </td>
                                <td class="name-pr">
                                        
									{{$cart->product_name}}
                                    <p>{{$cart->product_price}} | {{$cart->product_category}}</p>
                                    </td>
                                    <td class="price-pr">
                                        <p>PKR {{$cart->product_price}}</p>
                                    </td>
                                <td class="quantity-box">
                                    {{$cart->quantity}}
                                </td>
                                <td class="total-pr">
                                    <p>PKR {{$cart->product_price*$cart->quantity}}</p>
                                    </td>
                                
                            </tr>
                            <?php $total_amount = $total_amount + ($cart->product_price*$cart->quantity); ?>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="order-box">
                    <h3>Your Total</h3>
                    <div class="d-flex">
                        <h4>Cart Sub Total</h4>
                        <div class="ml-auto font-weight-bold"> PKR  {{$total_amount}} </div>
                    </div>
                    <div class="d-flex">
                        <h4>Shipping Cost (+)</h4>
                        <div class="ml-auto font-weight-bold"> PkR 0 </div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex">
                        <h4>Coupon Discount (-)</h4>
                        <div class="ml-auto font-weight-bold"> 
                            @if(!empty(Session::get('CouponAmount')))
                            PKR {{Session::get('CouponAmount')}}
                            @else
                            PKR 0
                            @endif
                        </div>
                    </div>
                    
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5"> PKR {{$grand_total = $total_amount - Session::get('CouponAmount')}} </div>
                    </div>
                    <hr> </div> 
            </div>
            
        </div>

        <form name="paymentForm" id="paymentForm" action="{{url('/place-order')}}" method="post"> {{csrf_field()}}
           <input type="hidden" value="{{$grand_total}}" name="grand_total">
            <hr class="mb-4">
            <div class="title-left">
                <h3>Payments</h3>
            </div>
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="payment_method" value="cod"  type="radio" class="custom-control-input cod">
                    <label class="custom-control-label" for="credit">Cash On Delivery</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="payment_method" value="paypal" type="radio" class="custom-control-input stripe" >
                    <label class="custom-control-label" for="debit">Stripe</label>
                </div>
                <div class="col-12 d-flex shopping-box">
                    <button  type="submit" class="ml-auto btn hvr-hover btn-info" onclick="return selectPaymentMethod();" style="color:white;">Place Order</button> 
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Cart -->
@endsection