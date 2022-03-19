
<?php include "include/connection.php"; ?>
<?php include "include/header.php"; ?>
<?php include "include/navbar.php"; ?>



<?php 
if(isset($_GET['product_id'],$_GET['product_title'],$_GET['product_author'],$_GET['product_image'],$_GET['product_category'],$_GET['post_description'],$_GET['product_price'],$_GET['online_user_id'])){
  $product_id = $_GET['product_id'];
  $product_title = $_GET['product_title'];
  $product_author = $_GET['product_author'];
  $product_image = $_GET['product_image'];
  $product_category = $_GET['product_category'];
  $post_description = $_GET['post_description'];
  $product_price = $_GET['product_price'];
  $user_click_product = 1;
  $online_user_id_in_product_page = $_GET['online_user_id'];

  
$query = "SELECT * FROM product_clicks WHERE product_id = '$product_id' AND online_user_id = '$online_user_id_in_product_page' ";
$select_user_query = mysqli_query($conn, $query);
if(!$select_user_query){
  $click_update_query = "UPDATE product_clicks SET user_click_product = user_click_product + 1 WHERE product_id = $product_id ";
  $select_post = mysqli_query($conn,$click_update_query);
}else{

$check_email_query = "SELECT product_id AND online_user_id FROM product_clicks WHERE product_id ='$product_id' AND online_user_id ='$online_user_id_in_product_page' LIMIT 1";
$check_product_id_not_Double = mysqli_query($conn, $check_email_query);
if(mysqli_num_rows($check_product_id_not_Double)>0){
  $online_test =  $_SESSION['id'];
  if($online_test){
 $click_other_query = "UPDATE product_clicks SET user_click_product = user_click_product + 1 WHERE product_id = $product_id AND online_user_id = $online_user_id";
  $other_post = mysqli_query($conn,$click_other_query);
  }
 
}else{
  $clicks_products = "INSERT INTO product_clicks(product_id,product_title,product_author,product_image,product_category,post_description,product_price,user_click_product,online_user_id)VALUES('$product_id','$product_title','$product_author','$product_image','$product_category','$post_description','$product_price','$user_click_product','$online_user_id_in_product_page' )";
  $clicks_products_query = mysqli_query($conn,$clicks_products);
}
 


 
}

}




// }elseif($_SESSION['id']){
  
// $clicks_products = "INSERT INTO product_clicks(product_id,product_title,product_author,product_image,product_category,post_description,product_price,user_click_product,online_user_id)VALUES('$product_id','$product_title','$product_author','$product_image','$product_category','$post_description','$product_price','$user_click_product','$online_user_id_in_product_page' )";
// $clicks_products_query = mysqli_query($conn,$clicks_products);

//  }  
   //true check bricket

 ?>




<!-- // if($clicks_products_query){
// $view_query = "UPDATE product_clicks SET user_click_product = user_click_product + 1 WHERE product_id = $product_id ";
// $select_post = mysqli_query($conn,$view_query);
//   if(!$select_post){
//     die();
//   }
// } -->

<?php 
$view_query = "UPDATE post SET product_view_count = product_view_count + 1 WHERE id = '$product_id' ";
$select_post = mysqli_query($conn,$view_query);

$query = "SELECT  *  FROM post WHERE id = $product_id";
$select_post = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($select_post)){ 
$id =  $row['id'];
$title = $row['title'];
$author = $row['author'];
$image = $row['photo'];
$category = $row['category'];
$post_description = $row['post_description'];
// $tags = $row['tags']; 
} ?>


<!-- Products Details Page -->
	<div class="container">
    <div class="row">
    <div class="col-md-6">

    <div class="card mt-5 mb-5" style="height:200px;">
    <?php echo  "<img src='admin/posts_images/$image'> " ;?>
    </div>
      </div>

      <div class="col-md-6  mt-5">
      <h3><?php echo $title ?></h3>
      <p class="mt-5"><?php echo $post_description ?></p>
      <p class="mt-5">Posted By: <span class="font-weight-bold"><?php echo $author ?></span>  <span class="ml-5 ">  Date: <span class="font-weight-bold">09/05/2021</span> </span>   <span class="ml-5">Category: <span class="font-weight-bold"><?php echo $category ?></span></span> </p>
      <p class="mt-5">Price : <span class="font-weight-bold">$80</span></p>
      <button class="btn btn-block btn-success mt-5">Add To Cart</button>
    </div>

    </div>

    <div class="container mt-5">
    <h2 style="margin-top:120px;">Related Products</h2>
  <div class="row"> 

    <?php 
    if(isset($_GET['cat_id'])){
      $cat_id = $_GET['cat_id'];
    }

// $query2 = "SELECT p.title as title FROM post as p INNER JOIN category as c ON p.post_category_id = c.id ";
// $sql2 = "SELECT post.category AS pcategory FROM post INNER JOIN category ON post.category=category.cat_name WHERE post.category = $cat_name";
$query = "SELECT  *  FROM post WHERE post_category_id = $cat_id";
$select_cat = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($select_cat)){ 
$image = $row['photo']; ?>
<div class="col-*-* mr-5"><?php echo "<img src='admin/posts_images/$image' alt='' style='width:100px;'>" ?> </div>
  <?php }  ?>
</div>
</div>
<!-- Products Details Page -->  
<?php include "include/footer.php"; ?>



