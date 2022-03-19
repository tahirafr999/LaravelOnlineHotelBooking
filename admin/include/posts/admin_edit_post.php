<?php

include "./include/admin_db_connection.php"; 
if(isset($_GET['p_id'])){

$the_post_id = $_GET['p_id'];

}


$query = "SELECT * FROM post WHERE id = $the_post_id  ";
$edit_post = mysqli_query($conn, $query);  

while($row = mysqli_fetch_assoc($edit_post)){
    $id = $row['id'];
    $title = $row['title'];
    $author = $row['author'];
    $database_image = $row['photo'];
    $category = $row['category'];
    $post_description = $row['post_description'];
    $product_price = $row['product_price'];
    // $tags = $row['tags'];

    
     }

     if(isset($_POST['update_post'])){

        $title = $_POST['title'];
        $author = $_POST['author'];
        $post_description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        // $tags = $_POST['tags'];
        $category = $_POST['category'];
        $product_price = $_POST['product_price'];
       

       
        move_uploaded_file($image_temp, "./posts_images/$image");
       
       if(empty($image)) {
       
       $image_query = "SELECT * FROM post WHERE id = $the_post_id ";
       
       $select_image = mysqli_query($conn,$image_query);
       
       while($row = mysqli_fetch_array($select_image)){
       
       $image = $row['photo'];
       }
       
    }

    $query = "UPDATE post SET ";

    $query.="title = '$title',";
   
    $query.="author = '$author',";
   
    $query.="post_description = '$post_description',";
   
    $query.="photo = '$image',";

    $query.="category = '$category',";

    $query.="product_price = '$product_price'";
   
    // $query.="tags = '$tags'";
   
   $query.="WHERE id = $the_post_id";

   
$update_post = mysqli_query($conn,$query);

if(!$update_post){

    die("QUERY FAILED" .mysqli_error($conn));
  
  }
  $GLOBALS["successful_message"]="Post Updated Successfully" ;

      
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
          <a href="post.php" class="btn btn-success">Manage All Products </a>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
            
          </div>
          <!-- /.card-header -->
          <div class="card-body">

          <?php if(isset($GLOBALS["successful_message"])){?>
         

      <div class="alert alert-success alert-dismissable" id="edit_post">
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
                    <label for="exampleInputTitle">Post Title</label>
                    <input type="text" class="form-control"  name="title" placeholder="Enter Post Title" value="<?php echo $title; ?>">
                    <small id="usererror"></small>
                  
                  </div>
                  <div class="form-group">
                    <label for="exampleInputAuthor">Post Author</label>
                    <input type="text" class="form-control" id="exampleInputAuthor" name="author" placeholder="Enter Post Author" value="<?php echo $author; ?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPrice">Product Price</label>
                    <input type="text" class="form-control" id="exampleInputPrice" name="product_price" value="<?php echo $product_price; ?>">
                  </div>
             

                  <div class="form-group">
                  <label for="image">Post Image</label><br>
                  <img width="100" src="./posts_images/<?php echo $database_image; ?>" alt=""><br>
                  <input  type="file" name="image">
                  </div>
                 
                </div>  
                <!-- /.card-body -->
                </div>
          
            
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                    <label for="exampleInputcategory">Post Category</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Post Category" name="category" value="<?php echo $category; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputDescription">Post Description</label>
                    <textarea id="" class="form-control" style="width:530px;height:100px; resize:none;" name="description"><?php echo $post_description; ?></textarea> </div>
                  <!-- <div class="form-group">
                    <label for="exampleInputTag">Post Tags</label>
                    <input type="text" class="form-control" id="exampleInputTag" placeholder="Enter Post Tag" name="tags" value="<?php //echo $tags; ?>">
                  </div> -->
                <!-- /.form-group -->
              
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          
          </div>
          <!-- /.card-body -->
          
          <div class="card-footer" style="margin-top: -14px;">
                  <button type="submit" name="update_post" class="btn btn-primary" onclick="return validation() ">Update </button>
                </div>

</form>

         
        </div>
        <!-- /.card -->


      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


</div>
<!-- ./wrapper -->

<script>
setTimeout(function() {

// Do something after 3 seconds
// This can be direct code, or call to some other function

$('#edit_post').hide();

},1200);
</script>
