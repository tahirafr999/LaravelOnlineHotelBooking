@extends('final_year_project.layouts.master')
@section('content')
<section>
    <div class="container text-center mb-5 mt-5">
    <a href="/">
    <img src="../images/tahir-logo.png" alt="" height="150" width="250">
  </a>
      
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-6">
        <form action="login_account" method="post">
          <div class="row">
            <div class="col text-center">
              <h1>Login</h1>
              <p class="text-h3">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia. </p>
            </div>
          </div>
          <div class=" align-items-center mt-4">
              <input type="text" class="form-control"  name="username" placeholder="Email" required>
            </div>
            <div class=" align-items-center mt-4">
              <input type="password" class="form-control"  name="password" placeholder="password" required>
            </div>
          


          <div class="row justify-content-start mt-4">
            <div class="col">
              <div class="form-check-label">   
                Create New Account   <a href="registration.php">   Register</a>
              </div>

              <button type="submit" class="btn btn-primary mt-4" name="submit">Login</button>
            </div>
          </div>
        </div>
      </form>

 




   </section>
@endsection