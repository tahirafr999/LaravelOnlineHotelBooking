<?php include "../admin/include/admin_db_connection.php"; ?>
<?php include "../include/header.php"; ?>

<?php 



// checks that when you clicked on the link in the email the this code wil be Generate
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $verify_query = "SELECT verify_token,verify_status FROM  register_users WHERE verify_token ='$token' LIMIT 1";
    $verify_query_run = mysqli_query($conn, $verify_query);

    if(mysqli_num_rows($verify_query_run) > 0){
        $row = mysqli_fetch_array($verify_query_run);
        if ($row['verify_status'] == "0")
        {
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE register_users SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);

            if($update_query_run){
              $GLOBALS["verified_account"]="Your Account is Verified Successfully Try To Login Thank you !!!";

            }else{
                $GLOBALS["Verification_failed"]="Your Account verification is failed!!!";
            }
        }
        else{
          
            $GLOBALS["account_already_verified"]="Email Already verified Please Login !!!";        
        }


    }else{
      $GLOBALS["email_not_exits"]="This email Don't Exists !!!";   


    }

}
// else{
//   $GLOBALS["not_allows"]="You are nit allowed !!!";   
// }

?>


<!--Login session-->

<?php 
if(isset($_POST['submit'])){

 $email = $_POST['email'];
 $password =	$_POST['password'];



$email = mysqli_real_escape_string($conn,$email);
$password =  mysqli_real_escape_string($conn,$password);

$query = "SELECT * FROM register_users WHERE email = '$email' AND password = '$password' ";

$select_user_query = mysqli_query($conn, $query);

if(!$select_user_query){

	die("QUARY FAILED" .mysqli_error($conn));

}
$db_email = "";
$db_password  = "";
$db_user_role = "";
// $db_id  = "";
while($row = mysqli_fetch_array($select_user_query)){
 $db_id = $row['id'];
 $db_email = $row['email'];
 $db_password = $row['password'];
 $db_user = $row['name_of_user'];
 $db_user_role = $row['user_role'];

}
 if($email ==$db_email || $password == $db_password){
  $_SESSION['id'] = $db_id;
  $_SESSION['username'] = $db_user;
  $_SESSION['role'] = $db_user_role;
 	header("Location: ../index.php");
   


 }else{
  $GLOBALS["msg"]="Invalid Username or Password";
 }
	

}
?>

<section>

  <h2 style="text-align:center;">
          <?php if(isset($GLOBALS["verified_account"])){
           echo $GLOBALS["verified_account"] ; }?>
          
        </h2> 

        <h2 style="text-align:center;">
          <?php if(isset($GLOBALS[" Verification_failed"])){
           echo $GLOBALS[" Verification_failed"] ; }?>
          
        </h2> 

        <h2 style="text-align:center;">
          <?php if(isset($GLOBALS["account_already_verified"])){
           echo $GLOBALS["account_already_verified"] ; }?>
          
        </h2> 

        <h2 style="text-align:center;">
          <?php if(isset($GLOBALS["email_not_exits"])){
           echo $GLOBALS["email_not_exits"] ; }?>
          
        </h2> 

        <h2 style="text-align:center;">
          <?php if(isset($GLOBALS["not_allows"])){
           echo $GLOBALS["not_allows"] ; }?>
          
        </h2>
    <div class="container text-center mb-5 mt-5">
    <a href="../index.php">
    <img src="../images/tahir-logo.png" alt="" height="150" width="250">
  </a>
      <h2>
          <?php if(isset($GLOBALS["msg"])){ ?>
            <div class="alert alert-warning text-center my-4">
           <?php  echo $GLOBALS["msg"]; }?>
           </div>
        </h2>        
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-6">
        <form action="" method="post">
          <div class="row">
            <div class="col text-center">
              <h1>Login</h1>
              <p class="text-h3">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia. </p>
            </div>
          </div>
          <div class=" align-items-center mt-4">
              <input type="email" class="form-control"  name="email" placeholder="Email" required>
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
</body>
</html>


<!-- for removing scroller at bottom -->
<style>
  html, body {
    max-width: 100%;
    overflow: hidden;
}

</style>








