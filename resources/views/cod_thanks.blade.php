@extends('final_year_project.layouts.master')
@section('content')
        <div class="cart-box-main">
        <div class="container">
            <h1 align="center">Thanks For Purchasing With Us!</h1> <br><br>
            <div class="row">
                <div class="col-lg-12">
                    <div align="center">
                        <h2>YOUR COD ORDER HAS BEEN PLACED</h2>
                        <p>Your Order Number is {{Session::get('order_id')}} and total payable about is PKR {{Session::get('grand_total')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

<?php

Session::forget('order_id');
Session::forget('grand_total');

?>