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
    
      case 'add_post';
    
     include "include/posts/admin_add_posts.php";
    
    break; 
    
    
    case 'edit_post';
    
    include "include/posts/admin_edit_post.php";

    break;
    
    case 'view_post';
    include "include/posts/admin_view_all_posts.php";

    break;
    
    default:
    include "include/posts/admin_view_all_posts.php";
    
    break;
    
}

?>

<?php include "include/admin_footer.php"; ?>

