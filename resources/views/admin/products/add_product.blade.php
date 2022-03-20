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
                <form action="">
                <div class="form-group">
                  <label>Product Title</label>
                  <input type="text" class="form-control" name="product_title" id="product_title" placeholder="Enter Product title">
                  <small class="form-text text-muted error-text hotel_title_error"></small>
                </div>
                <!-- /.form-group -->
                  <div class="form-group">
                  <label>Product Author</label>
                  <input type="text" class="form-control" name="product_author" id="product_author" placeholder="Enter Product Author">
                  <small class="form-text text-muted error-text hotel_title_error"></small>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Product Image</label>
                  <input type="file" class="form-control" id="product_image" name="product_image">
                  <small id="product_image" class="form-text text-muted"></small>
                  </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                  <label>Product Price</label>
                  <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter Product Price">
                  <small class="form-text text-muted error-text hotel_title_error"></small>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Product Category</label>
                  <input type="text" class="form-control" name="product_category" id="product_category" placeholder="Enter Product Category">
                  <small class="form-text text-muted error-text hotel_title_error"></small>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Product Description</label>
                 <textarea name="product_description" class="form-control" id="" cols="10" rows="1"></textarea>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->


          </div>
          <!-- /.card-body -->
          <div class="card-footer">
           <button class="btn btn-primary btn-block">Submit</button>
          </div>
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- add product form end here -->
@endsection
