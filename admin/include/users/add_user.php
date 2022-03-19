<?php 
include "./include/admin_db_connection.php"; 

if(isset($_POST['submit'])){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $user_email = $_POST['user_email']; 
  $user_image = $_FILES['user_file']['name'];
  $user_image_temp = $_FILES['user_file']['tmp_name'];
  $user_password = $_POST['password']; 
  move_uploaded_file($user_image_temp, "./user_images/$user_image");
  $query = "INSERT INTO users(first_name,last_name,username,user_email,user_image,user_password) VALUES('$fname','$lname','$username','$user_email','$user_image','$user_password')";
  $insert_form_data = mysqli_query($conn,$query);
  if(!$insert_form_data){
    die("QUERY FAILED" .mysqli_error($conn)); 
  }
  $GLOBALS["successful_message"]="user Created Successfully" ;
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <!-- Content Header (Page header) -->
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
          <a href="users.php" class="btn btn-success">View All Users </a>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
            
          </div>
          <!-- /.card-header -->
          <div class="card-body">

          <?php if(isset($GLOBALS["successful_message"])){?>
         

      <div class="alert alert-success alert-dismissable" id="addpost">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <h4 class="color:white;"><i class="icon fa fa-check"></i> <?php  echo $GLOBALS["successful_message"]; ?> </h4>  
   
   <?php  } ?>
    </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                       <!-- form start -->
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label >First Name</label>
                    <input type="text" class="form-control"  name="fname" placeholder="Enter Your First Name" id="user_fname">
                    <small id="usererror"></small>
                  
                  </div>
                  <div class="form-group">
                    <label >Last Name</label>
                    <input type="text" class="form-control"  name="lname" placeholder="Enter Your Last Name">
                  </div>

                  <div class="form-group">
                    <label >Username</label>
                    <input type="text" class="form-control"  name="username" placeholder="Enter Your Username">
                  </div>

                  <div class="form-group">
                    <label >User Email</label>
                    <input type="text" class="form-control"  name="user_email" placeholder="Enter Your Email">
                  </div>           
                </div>  
                <!-- /.card-body -->
                </div>
          
            
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
              <!-- <label for="category">User Roll</label><br>
              <select name="category" id="mul-select">
                  <option value="Select" >Select User Roll</option>
                  <option value="admin" >Admin</option>
                  <option value="subscriber" >Subscraiber</option> -->
                  <?php
                        //   $query = "SELECT * FROM category";
                        //   $select_category = mysqli_query($conn,$query);      
                        //   while($row = mysqli_fetch_assoc($select_category)) {
                        //   $user_id = $row['cat_id'];
                        //   $cat_name = $row['cat_name'];          
                        //       echo "<option value='{$cat_name}' style='font-size:20px; font-weight:bolder;'>{$cat_name}</option>";            
                        //   }
                    ?>
              <!-- </select> -->


              <div class="form-group mt-5">
                  <label for="image">Profile Image</label><br>
                  <input type="file" name="user_file">
                  </div>

                  <div class="form-group">
                    <label >User Password</label>
                    <input type="password" class="form-control"  name="password" placeholder="Enter Your Password">
                  </div>
             
                </div>
               
        </div>
    </div>
              
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary" onclick="return validation() ">Submit</button>
                </div>
          
          </div>
          <!-- /.card-body -->
          
          

</form>

         
        </div>
        <!-- /.card -->


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


</div>
<!-- ./wrapper -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>



<script>
   function validation(){
        //  var post_title = document.getElementById('post_title').value;
         var location = document.getElementById('mul-select');
         var invalid = location.value == "Select";
        //  var password = document.getElementById('password').value;
        //  var cpassword = document.getElementById('cpassword').value;
        //  var male = document.getElementById('male');
        //  var female = document.getElementById('female');
        //  var other = document.getElementById('other');
        
        //  email = document.getElementById('email').value;
        //  var mobilenumber = document.getElementById('mobilenumber').value;

         var usercheck =/^[A-Za-z.]{3,30}$/ ;
        //  var lastnamecheck = /^[A-Za-z.]{3,30}$/ ;
        //  var passwordcheck = /^(?=.*[0-9])(?=.*[!@#%/^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;

        //  const emailcheck = /^[A-Za-z_]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/;

        //  var mobilecheck = /^[789][0-9]{9}$/; 
      

        // if(usercheck.test(post_title)){
        //     document.getElementById('usererror').innerHTML = " ";
        // }else{
        //     document.getElementById('usererror').innerHTML = " ** Post title Should Not Be Empty";
        //     document.getElementById('usererror').style.color = "red";
        //     return false;
        // }

    return !invalid;

      //   if(passwordcheck.test(password)){
      //       document.getElementById('passworderror').innerHTML = " ";
      //   }else{
      //       document.getElementById('passworderror').innerHTML = " ** password is invalid ";
      //       return false;
      //   }

      //   if(cpassword.match(password)){
      //       document.getElementById('cpassworderror').innerHTML = " ";
        

      //   }else{
      //       document.getElementById('cpassworderror').innerHTML = " **Passwrod is not matching";
      //       return false;
      //   }
        

      //   if(emailcheck.test(email)){
      //       document.getElementById('emailerror').innerHTML = " ";
      //   }else{
      //       document.getElementById('emailerror').innerHTML = " **Email is not Valid";
      //       return false;
      //   }

      //   if(mobilecheck.test(mobilenumber)){
      //       document.getElementById('mobileerror').innerHTML = " ";
      //   }else{
      //       document.getElementById('mobileerror').innerHTML = " **Number is not Valid";
      //       return false;
      //   }

      //  if (male.checked || female.checked || other.checked) {
      //   document.getElementById('mobileerror').innerHTML = " ";
      //  } else {
      //   document.getElementById('mobileerror').innerHTML = " Select gender";
      //       return false;
      //  }

}


setTimeout(function() {

// Do something after 3 seconds
// This can be direct code, or call to some other function

$('#addpost').hide();

},1200);
 </script>