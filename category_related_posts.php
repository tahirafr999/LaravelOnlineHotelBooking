
<?php include "include/connection.php"; ?>

<?php include "include/header.php"; ?>

<?php include "include/navbar.php"; ?>

<section class="news pt-0">
  <div class="container-fluid">
  <?php
if(isset($_GET['id'],$_GET['cat_name'])){
  // $the_category_id = "";
  $the_category_id = $_GET['id'];
  $the_category_name= $_GET['cat_name'];

} ?>
    
    <h2 class="mx-4 my-0 text-center mt-5" id="demo"><?php echo $the_category_name;  ?></h2>
    <ul class="row d-lg-flex list-unstyled image-block justify-content-center px-lg-0 mx-lg-0">




<?php
 $query = "SELECT  *  FROM post where category = '$the_category_id' "; // the_post_id its in double '' quote because its a string not int
 $select_post = mysqli_query($conn,$query);
 while($row = mysqli_fetch_assoc($select_post)){ 
   $id = $row['id'];
   $title = $row['title'];
   $author = $row['author'];
   $image = $row['photo'];
   $category = $row['category'];
  $_SESSION['category_show'] = $category;
   $post_category_id = $row['post_category_id'];
   $post_description = $row['post_description'];
  //  $tags = $row['tags']; 
    ?>


      <li class="col-lg-3 col-md-3 image-block full-width p-3">
        <div class="image-block-inner">
          <a class="mh-100" href="#">
          <img class="img-responsive" src="admin/posts_images/<?php echo $image;?>" alt="" class="img-responsive" style="width:360px;">
          <span class="hp-posts-cat"><?php echo $title ?></span>
          <h4 class="mt-3"><a href="#"><?php echo $post_description ?></a></h4>
          <!--  <p></p> -->
          <a href="#" class="read-more">Read more ></a>
        </div><!-- .image-block-inner -->
      </li> 
 <?php } ?>

 </ul>
 
  </div>
</section>


<?php include "include/footer.php"; ?>


<style>
  .container {
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
  }
  
  .image-block {
    margin-top: 24px;
    display: flex;
    flex-wrap: wrap;
  }
  
  .image-block-inner {
    -webkit-box-shadow: 0px 3px 10px 1px rgba(204, 204, 204 0, 1);
    -moz-box-shadow: 0px 3px 10px 1px rgba(204, 204, 204 0, 1);
    box-shadow: 0px 3px 10px 1px rgba(204, 204, 204, 1);
  }
  
  .image-block li>.image-block-inner {
    padding-bottom: 30px;
    background-color: #fff;
    height: 100%;
  }
  
  a {
    color: #111;
    text-decoration: none;
  }
  
  h2,
  h4 a {
    text-transform: uppercase;
  }
  
  a:hover {
    text-decoration: none;
  }
  
  .image-block li>.image-block-inner>a {
    display: block;
    overflow: hidden;
  }
  
  .image-block li>.image-block-inner>a img {
    border: 1px solid #e1e1df;
  }
  
  .image-block li>.image-block-inner:hover {
    background-color: #eee;
  }
  
  .hp-posts-cat {
    margin-bottom: 13px;
    margin-top: 35px;
    text-transform: uppercase;
    font-weight: 600;
    font-size: 1rem;
    letter-spacing: 0.1rem;
    display: inline-block;
  }
  
  .news {
    font-family: 'Oswald', sans-serif;
  }
  
  .news .image-block li>.image-block-inner h4,
  .hp-posts-cat,
  .news .image-block li>.image-block-inner p,
  .read-more {
    padding: 0 28px;
  }
  
  .read-more {
    display: block;
    text-decoration: underline;
    margin-top: 30px;
    font-weight: 600;
  }
  
  /* Media Queries */
  
  @media (min-width: 992px) {
    .col-md-5 {
      width: 41.66667%;
    }
  }
  
  @media (min-width: 768px) {
    .image-block li.image-block1 {
      padding-left: 26px;
      padding-right: 14.5px;
    }
  }
  
  @media (min-width: 1200px) {
    .image-block li>.image-block-inner>a {
      max-height: 245px;
    }
  }
  
  @media (min-width: 992px) {
  
    .pl-lg-0,
    .px-lg-0 {
      padding-left: 0;
      padding-right: 0;
    }
  
    .ml-lg-0,
    .mx-lg-0 {
      margin-left: 0;
      margin-right: 0;
    }
  }
</style>
