@extends('final_year_project.layouts.master')
@section('content')
<section class="mb-5">
    <div class="container text-center mb-5 mt-3">
    <a href="/">
    <img src="../images/tahir-logo.png" alt="" height="150" width="250">
  </a>
     

      
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-6"> 
          @if($message = Session::get('success'))
          <div class="alert alert-success">
          <p>{{$message}}</p>
          </div>
          @endif
        <form action="register.post" method="post">
        {{ csrf_field() }}
          <div class="row">
            <div class="col text-center">
              <h1>Register</h1>
              <p class="text-h3">Thank You for being apart of us </p>
            </div>
          </div>
          
          <div class="row align-items-center">
            <div class="col mt-4">
              <input type="text" class="form-control"  name="company_name" placeholder="Company Name"  required>
            </div>
          </div>
          <div class="row align-items-center mt-4">
            <div class="col">
              <input type="email" class="form-control"  name="email" placeholder="Email" required>
            </div>
          </div>


          <div class="row align-items-center mt-4">
            <div class="col">
              <input type="text" class="form-control"  name="username" placeholder="username" required>
            </div>
          </div>
         <!-- <select name="role"  class="form-control">
         <option value="">Select Status</option>
          <option value="User">User</option>
         </select> -->

        <div class="form-group mt-4">
        <label  class="form-control-file" style="text-align:left !important;">Profile Imaget</label>
        <input type="file" name="user_file" class="form-control-file" >
        </div>

         <!-- <div class="form-group mt-4" stytle="margin-top: 1.5rem!important;    margin-bottom: 1rem;">
          <label for="image" style="display: inline-block; margin-bottom: .5rem;">Profile Image</label><br>
          <input type="file" name="user_file">
          </div> -->



          <div class="row align-items-center mt-5">
            <div class="col">
              <input type="password" class="form-control" onChange="onChange()" placeholder="Password" name="password" >
            </div>

            <div class="col">
              <input type="password" class="form-control" onChange="onChange()" placeholder="Confirm Password" name="upassword" >
            </div>
          </div>
          <div class="row justify-content-start mt-4">
            <div class="col" style="text-align:left !important;">
              <div class="form-check">
                <label >
                  Already have Account <a href="login.php"> Login</a>
                </label>
              </div>

              <button type="submit"  class="btn btn-primary mt-4" name="submit">Register</button>
            </div>
          </div>
        </div>
          </form>
      </div>
    </div>
  </section>

  @endsection