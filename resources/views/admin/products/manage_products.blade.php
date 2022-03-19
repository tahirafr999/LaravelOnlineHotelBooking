@extends('admin.layouts.master')
@section('content')

<div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
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
                  <tbody>
                  <tr>
                    <td>Trident</td>
                    <td>Internet
                      Explorer 4.0
                    </td>
                    <td>Trident</td>
                    <td>Trident</td>
                    <td>Trident</td>
                    <td>Trident</td>
                    <td><i class="fas fa-eye"></i></td>
                
                  </tr>
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


@endsection