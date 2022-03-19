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
    
      case 'add_category';
    
     include "include/category/add_category.php";
    
    break; 

    case 'list_category';
    
    include "include/category/list_category.php";
   
   break;
    
    default:
    include "include/category/list_category.php";
    
    break;  
}

?>

<?php include "include/admin_footer.php"; ?>
