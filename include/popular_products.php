<?php include "connection.php";?>
<br><br>
<div class="container-fluid mb-5">
<?php if(isset($_SESSION["add_to_cart"])){
  if ($_SESSION["add_to_cart"] == TRUE){?>
<div class="alert alert-success alert-dismissable" id="alertcart">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <h4 class="color:white;"><i class="icon fa fa-check"></i>  <?php  echo "Product Added to Cart Successfully";   $_SESSION['add_to_cart'] = FALSE; ?></h4>  
      </div>
      <?php } } ?>

  <h2 class="text-center text-muted mt-5 mb-5">Popular Products</h2>

<!-- row -->
<div class="row">
  
<?php 
//  $query =   "SELECT * FROM post ORDER BY product_view_count DESC " ;
  $query = "SELECT post.id, post.title,post.author,post.photo,post.category,post.post_category_id,post.post_description,category.cat_name,post.product_price
   FROM post
   INNER JOIN category ON post.post_category_id = category.cat_id ORDER BY product_view_count DESC limit 8";
  $select_post = mysqli_query($conn,$query);
  while($row = mysqli_fetch_assoc($select_post)){ 
    $id = $row['id'];
    $_SESSION['id_for_card'] =  $id;
    $title = $row['title'];
    $author = $row['author'];
    $image = $row['photo'];
    $category = $row['category'];
    $post_category_id = $row['post_category_id'];
    $post_description  = $row['post_description'];
    $cat_name  = $row['cat_name']; 
    $product_price  = $row['product_price']; 
    ?>

<?php

            if(isset($_POST['add_to_cart'])) {
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_author = $_POST['product_author'];
            $add_to_cart_user_id = $_SESSION['id'];
            $product_category = $_POST['product_category'];
            $product_image =$_POST['product_image'];
            $product_price = $_POST['product_price'];
            // $post_image_temp = $_FILES['product_image']['tmp_name'];
            // $product_category_id = $_POST['post_category_id'];
            if(isset($_SESSION['username']) && $_SESSION['username']==true){
           if($_SESSION['id_for_card'] == $product_id){ 
            $query = "INSERT INTO cart(product_id,product_name,product_author,add_to_cart_user_id,product_category,product_image,product_price) VALUES('$product_id','$product_name','$product_author','$add_to_cart_user_id','$product_category','$product_image','$product_price')";
            $insert_form_data = mysqli_query($conn,$query);         
            echo "<script type='text/javascript'> document.location = './index.php'; </script>";
                  $_SESSION['add_to_cart'] = " ";
            
              }else{
                $_SESSION['Not_add_to_cart'] = " ";
              }
            }else{
              echo "<script type='text/javascript'> document.location = './login/login.php'; </script>";
            }
          }
        
            ?> 
  <!-- col-md -->
  <div class="col-md-3 d-flex align-self-stretch">
   <!--card  -->
  <div class="card shadow-sm mb-4" style="padding:18px;">
        <?php echo "<img src='admin/posts_images/$image' class='card-img-top' style='height:250px;width:100%;'> ;" ?>
        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-uppercase"><?php echo $title ?></h5>
            <?php $post_description = '<span style="color:black; font-size:15px; cursor:pointer;">' . substr($post_description, 0, 30) . '....Read More</span>'?>
            <?php echo "<a href='./product_details.php?product_id=$id&cat_id=$post_category_id' style='text-decoration:none; color:black'><p class='mt-3 font-weight-bold'>Category : <span>  $cat_name</span></p> "; ?>
            <?php echo "<a href='./product_details.php?product_id=$id&cat_id=$post_category_id' style='text-decoration:none; color:black'><p class='mt-3 font-weight-bold'>Producr Price : <span>  $product_price</span></p> "; ?>
            <div class="mt-auto text-center"> 
            <form action="" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $row["id"]; ?>" />
            <input type="hidden" name="product_name" value="<?php echo $row["title"]; ?>" />
            <input type="hidden" name="product_author" value="<?php echo $row["author"]; ?>" />
            <input type="hidden" name="product_category" value="<?php echo $row["category"]; ?>" />
            <input type="hidden" name="product_image" value="<?php echo $row["photo"]; ?>" />
            <input type="hidden" name="product_price" value="<?php echo $row["product_price"]; ?>" />
            <?php if(isset($_SESSION['id'])){
              $online_user_id = $_SESSION['id'];
              echo " <a href='./product_details.php?product_id=$id&cat_id=$post_category_id&product_title=$title&product_author=$author&product_image=$image&product_category=$category&post_description=$post_description&product_price=$product_price&online_user_id=$online_user_id' class='btn btn-success btn-lg'>View Details</a> " ;
              echo "<input type='submit' name='add_to_cart'  class='btn btn-danger btn-lg' value='Add to Cart' /> ";

            }else{ ?>
             <?php echo " <a href='./product_details_offline.php?product_id=$id&cat_id=$post_category_id' class='btn btn-success btn-lg'>View Details</a> " ;?>
               <input type="submit" name="add_to_cart"  class="btn btn-danger btn-lg" value="Add to Cart" />
           <?php } ?>
  
             <?php //echo " <a href='./product_details.php?product_id=$id&cat_id=$post_category_id&product_title=$title&product_author=$author&product_image=$image&product_category=$category&post_description=$post_description&product_price=$product_price&online_user_id=$add_to_cart_user_id' class='btn btn-success btn-lg'>View Details</a> " ;?>
             <!-- <input type="submit" name="add_to_cart"  class="btn btn-danger btn-lg" value="Add to Cart" /> -->
            
     
  </form>
            </div>
        </div>
    </div>
    <!-- card -->
</div>
  <!-- col-md -->

  <?php } ?>

</div>
<!-- row -->

</div><!-- container -->

<div class="container-fluid" style="width:86% !important;">
<img src="images/banner-hd.jpg"  alt="" class="banner_img">
</div>


<!-- popular products -->


<style>
a .readMore {
    display: none;
}

a .readLess {
    display: inline;
}

a.collapsed .readMore {
    display: inline;
}

a.collapsed .readLess {
    display: none;
}

.descriptionText:not(.in) {
    min-height: 4.25em;
    height: 4.25em;
    display: block;
    overflow: hidden;
}
</style>

<script>
  setTimeout(function() {

// Do something after 3 seconds
// This can be direct code, or call to some other function

$('#alertcart').hide();

},1600);
</script>