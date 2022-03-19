<?php include "include/admin_header.php"; ?>

<?php include "include/admin_navbar.php"; ?>

<?php include "include/admin_aside.php"; ?>

          <?php

if(isset($_GET['source'])){

$source = $_GET['source'];

} else {

$source = '';

}

switch($source) {
    
      case 'add_user';
    
     include "include/users/add_user.php";
    
    break; 
    
    case 'edit_users';
    include "include/users/edit_user.php";

    break;
    
    default:
    include "include/users/manage_users.php";
    
    break;   
}

?>

<?php include "include/admin_footer.php"; ?>
