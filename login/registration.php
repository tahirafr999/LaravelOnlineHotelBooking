<?php include "../admin/include/admin_db_connection.php"; ?>
<?php include "../include/header.php"; ?>


<?php



//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

function sendemail_verify($name,$email,$verify_token){


  $mail = new PHPMailer(); // create a new object
  $mail->IsSMTP(); // enable SMTP
  // $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
  $mail->SMTPAuth = true; // authentication enabled
  $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465; // or 587
  $mail->IsHTML(true);
  $mail->Username = "tahirafridi0900@gmail.com";
  $mail->Password = "tahir43210432100";
  $mail->SetFrom("tahirafridi0900@gmail.com",$name);
  $mail->AddAddress($email);
  $mail->Subject = "Email Verification from TA-19 Mall";
  $email_template = " <h2> You have registered with TA-19 Mall </h2>
<h5> verify your email address to login with the below link </h5>
<br></br>
<strong> <a href='http://localhost/finalYearProject/login/login.php?token=$verify_token'> Click Here To Register Yourself with  TA-19 Mall</a></strong>";
  $mail->Body =  $email_template;
  if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
  $GLOBALS["successful_message"]="Registration Successfully Done! Check Your Email ";

 }


}

// code of insert a new user 
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    // $image = $_POST['image'];
    $email = $_POST['email'];
     $username = $_POST['username'];
    //  $role = $_POST['role'];
    $password = $_POST['psw'];
    $cpassword = $_POST['cpsw'];
    $user_role = "user";
    $user_image = $_FILES['user_file']['name'];
    $user_image_temp = $_FILES['user_file']['tmp_name'];
    $verify_token = md5(rand());
    move_uploaded_file($user_image_temp, "../admin/user_images/$user_image");
 //Email Exists or Not
    $check_email_query = "SELECT email FROM register_users WHERE email ='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($conn, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0 ){
       echo "Email Already Exists";
       
    }
    
    else{
    $query = " INSERT INTO register_users(name_of_user,email,username,user_role,password,cpassword,user_image,verify_token) VALUES('$name','$email','$username','$user_role','$password',' $cpassword','$user_image','$verify_token')";

    $query_run = mysqli_query($conn, $query);
 
    if ($query_run) {
        sendemail_verify("$name","$email","$verify_token");
    
   }else{
     echo "Registration Failed";
 
   }
 }
}
  ?>

<section class="mb-5">
    <div class="container text-center mb-5 mt-3">
    <a href="../index.php">
    <img src="../images/tahir-logo.png" alt="" height="150" width="250">
  </a>
     
      <h2>
          <?php if(isset($GLOBALS["successful_message"])){ ?>
            <div class="alert alert-warning text-center my-4">
           <?php  echo $GLOBALS["successful_message"]; }?>
           </div>
        </h2>  
      
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-6"> 
        <form action="" action="" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col text-center">
              <h1>Register</h1>
              <p class="text-h3">Thank You for being apart of us </p>
            </div>
          </div>
          
          <div class="row align-items-center">
            <div class="col mt-4">
              <input type="text" class="form-control"  name="name" placeholder="Company Name"  required>
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
              <input type="password" class="form-control" onChange="onChange()" placeholder="Password" name="psw" >
            </div>

            <div class="col">
              <input type="password" class="form-control" onChange="onChange()" placeholder="Confirm Password" name="cpsw" >
            </div>
          </div>
          <div class="row justify-content-start mt-4">
            <div class="col" style="text-align:left !important;">
              <div class="form-check">
                <label >
                  Already have Account <a href="login.php"> Login</a>
                </label>
              </div>

              <button class="btn btn-primary mt-4" name="submit">Register</button>
            </div>
          </div>
        </div>
          </form>
      </div>
    </div>
  </section>


  <!-- <div class="registration_form"> -->





    <!-- <form action="" method="post" id="sign_up_form"> 
      
       
        
   
        <label for="uname" ">Email</label><br>
        <input type="email" placeholder="Enter Username" name="email"  required><br>

        <br>

        <div class="container" >
        <label for="name" >username</label><br>
        <input type="text" placeholder="Enter Username" name="username"  required><br>

        <br>

        <label for="role" >Role</label><br>
        <select name="role" id="" style="width:250px; padding:5px">
        <option value="User">Select Status</option>
          <option value="User">Admin</option>
          <option value="Admin">User</option>
        </select>
        
        
        <br>

        <label for="psw" style="margin-right:345px; font-size: 20px; margin-top:20px;">Password</label><br>
        <input type="password" placeholder="Enter Password" name="psw"  required><br>

        <br>
        
        <label for="psw" style="margin-right:345px; font-size: 20px; margin-top:20px;">cPassword</label><br>
        <input type="password" placeholder="Enter Password" name="cpsw"  required><br>
          
          
        <br>

        <div class="login_btn_label">
          <button type="submit" name="submit" class="login_btn" >Submit</button>
            <span class="or_label"> OR </span>
          
          <a href="../registration.php" style="text-decoration:none; margin-left:20px; "><label >
            Registration
          </label></a>
          </div>
      
          </div>  -->
    


    </form>
  </div>

          </body>
          </html>



<!-- for removing scroller at bottom -->
<style>
  html, body {
    max-width: 100%;
    overflow-x: hidden;
}

.text-center{text-align:right;}

</style>

<script>
  function onChange() {
  const password = document.querySelector('input[name=psw]');
  const confirm = document.querySelector('input[name=cpsw]');
  if (confirm.value === password.value) {
    confirm.setCustomValidity('');
  } else {
    confirm.setCustomValidity('Passwords do not match');
  }
}
</script>