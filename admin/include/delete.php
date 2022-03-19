<?php
session_start() ;
 include "admin_db_connection.php"; 
    $the_post_id = $_GET['p_id'];
    if(!empty($the_post_id)){
    $post_query = "DELETE FROM post WHERE id = $the_post_id ";
    $post_delete_query = mysqli_query($conn, $post_query);
    $_SESSION['delete_successfully']=TRUE;
    $_SESSION['delete_successfully_check'] = "Your Data Is Deleted Successfully";
    header("Location: ../post.php");
    
     
    }
    

?>

<?php 

$the_cat_id = $_GET['cat_id'];
if(!empty($the_cat_id)){   
$delerte_query = "DELETE FROM category WHERE cat_id = $the_cat_id ";
$delete_query_check = mysqli_query($conn, $delerte_query);
$_SESSION['delete_successfully']=TRUE;
$_SESSION['delete_successfully_check'] = "Your Data Is Deleted Successfully";
header("Location: .././category.php?source=list_category");

}

?>


<?php
$the_user_id = $_GET['u_id'];
    if(!empty($the_user_id)){
    $user_query = "DELETE FROM users WHERE id = $the_user_id ";
    $user_delete_query = mysqli_query($conn, $user_query);
    $_SESSION['delete_successfully']=TRUE;
    $_SESSION['delete_successfully_check'] = "Your Data Is Deleted Successfully";
    header("Location: ../users.php");
    
     
    }
    

?>

