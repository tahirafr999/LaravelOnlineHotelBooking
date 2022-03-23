@extends('admin.layouts.master')
@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table  class="table table-hover table-condensed" id="ProductTable">
                  <thead>
                  <tr>
                    <th>Product Title</th>
                    <th>Product Author</th>
                    <th>Product Phote</th>
                    <th>Product Category</th>
                    <th>Product Price</th>
                    <th>Product Description</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody</tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


@endsection
<script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script>

    $(document).ready(function () {
    //GET ALL COUNTRIES
    $('#ProductTable').DataTable({
                     processing:true,
                     info:true,
                     ajax:"{{ url('/product-display') }}",
                     columns:[
                         {data:'title', name:'product_title'},
                         {data:'author', name:'product_author'},
                  
                         {data: 'photo', name: 'product_image',
            render: function( data, type, full, meta ) {
                return "<img src=/images/" + data + " style='width:50px;height:50px;' />";
            }
            },
                         {data:'category', name:'product_category'},
                         {data:'product_description', name:'product_description'},
                         {data:'product_price', name:'product_category'},
                         {data:'actions', name:'actions'}

                     ]
                        //GET ALL COUNTRIES
                });

              });
</script>