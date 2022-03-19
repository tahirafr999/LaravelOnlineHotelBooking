<?php include "connection.php";?>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a href="./index.php"><img class="navbar-brand ml-5 tahir-logo" src="images/tahir-logo.png" width="150"></a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <form action="search.php" method="POST" class="form-inline my-2 my-lg-0 m-auto">
      <input class="mr-sm-2 input-size" type="text" name="search" placeholder="Search" aria-label="Search">
      <button name="submit" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div class="links">
    <ul class="navbar-nav  mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
      <a href=""><?php 
     
if(isset($_SESSION['username'])){ ?>

 <a href='' class='nav-link' id='sign_up_btn'><?php echo $_SESSION['username'];?></a> 
 <?php echo "<li  class='nav-item'><a href='admin/index.php' class='nav-link' >Admin</a></li> "; 
 echo "<a href='./login/logout.php' class='nav-link'>Logout</a> ";
 echo "<a href='cart_details.php' class='nav-link'><i class='fa fa-shopping-cart fa-2x' aria-hidden='true'></i> </a> "; 
 $online_user_id = $_SESSION['id'];
 $query = "SELECT * FROM cart where add_to_cart_user_id = $online_user_id";
 $cart_query = mysqli_query($conn,$query);
 $cart_count = mysqli_num_rows($cart_query);


echo "<span class='counter counter-lg'><span style='color:white;font-size:20px;background-color:red;border-radius:100%;padding:5px;'> $cart_count</span></span>" ;
}else{ ?>

<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          User Login
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./login/login.php">Login</a>
          <a class="dropdown-item" href="./login/registration.php">Registration</a>   
        </div>

<?php  } ?> </a>
    
      </li>
   
    </ul>
   </div>
  </div>
</nav>


<!-- model started -->
<!-- large modal -->
<!-- <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Login </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <form>
        <div class="modal-body">
          <div class="form-group">
            <label for="email1">Email address</label>
            <input type="email" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">Your information is safe with us.</small>
          </div>
          <div class="form-group">
            <label for="password1">Password</label>
            <input type="password" class="form-control" id="password1" placeholder="Password">
          </div>
           -->
        <!-- </div> --> <!-- model body ended -->
        <!-- <div class="modal-footer border-top-0 d-flex">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>  
      </form>
      </div>  <!-- model content ended -->
  </div> <!-- model dialog ended -->
</div>  <!-- model ended -->



<div class="container-fluid p-0 bg-defult">

    <ul class="navbar-nav all-brands">
      <?php 
      $query = "SELECT * FROM category";
      $cart_query = mysqli_query($conn,$query);
      while($row = mysqli_fetch_assoc($cart_query)){
        $category_id = $row['cat_id'];
        $category_name = $row['cat_name'];

        echo "<li>$category_name</li>";
      }
      ?>
      <li>laptop</li>

    </ul>

</div> 

<!-- Banner end here -->
