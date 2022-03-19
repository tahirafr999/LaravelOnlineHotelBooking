<?php

include "./include/admin_db_connection.php"; 
if(isset($_GET['u_id'])){

$the_user_id = $_GET['u_id'];

}


$query = "SELECT * FROM users WHERE id = $the_user_id  ";
$edit_post = mysqli_query($conn, $query);  

while($row = mysqli_fetch_assoc($edit_post)){
    $id = $row['id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $username = $row['username'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];

    
     }

     if(isset($_POST['update_user'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
      
        $user_email = $_POST['user_email']; 
        $user_image = $_FILES['user_file']['name'];
        $user_image_temp = $_FILES['user_file']['tmp_name'];

        $username = $_POST['username'];
  
        move_uploaded_file($user_image_temp, "./user_images/$user_image");

       
       if(empty($user_image)) {
       
       $image_query = "SELECT * FROM users WHERE id = $the_user_id ";
       
       $select_image = mysqli_query($conn,$image_query);
       
       while($row = mysqli_fetch_array($select_image)){
       
       $user_image = $row['user_image'];
       }
       
    }

    $query = "UPDATE users SET ";

    $query.="first_name = '$first_name',";
   
    $query.="last_name = '$last_name',";

    $query.="user_email = '$user_email',";

    $query.="user_image = '$user_image',";
   
    $query.="username = '$username'";

    
   
   
   $query.="WHERE id = $the_user_id";

   
$update_user = mysqli_query($conn,$query);

if(!$update_user){

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
          <a href="users.php" class="btn btn-success">View All Users </a>
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
                    <label >First Name</label>
                    <input type="text" class="form-control"  name="first_name" placeholder="Enter Your First Name" id="user_fname" value="<?php echo $first_name; ?>">
                    <small id="usererror"></small>
                  
                  </div>
                  <div class="form-group">
                    <label >Last Name</label>
                    <input type="text" class="form-control"  name="last_name" placeholder="Enter Your Last Name" value="<?php echo $last_name; ?>">
                  </div>

                  <div class="form-group">
                    <label >Username</label>
                    <input type="text" class="form-control"  name="username" placeholder="Enter Your Username" value="<?php echo $username; ?>">
                  </div>

                  <div class="form-group">
                    <label >User Email</label>
                    <input type="text" class="form-control"  name="user_email" placeholder="Enter Your Email" value="<?php echo $user_email; ?>">
                  </div>           
                </div>  
                <!-- /.card-body -->
                </div>
          
            
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
              <!-- <label for="category">User Roll</label><br>
              <select name="category" id="mul-select">
                  <option value="Select" >Select User Roll</option>
                  <option value="admin" >Admin</option>
                  <option value="subscriber" >Subscraiber</option> -->
                  <?php
                        //   $query = "SELECT * FROM category";
                        //   $select_category = mysqli_query($conn,$query);      
                        //   while($row = mysqli_fetch_assoc($select_category)) {
                        //   $user_id = $row['cat_id'];
                        //   $cat_name = $row['cat_name'];          
                        //       echo "<option value='{$cat_name}' style='font-size:20px; font-weight:bolder;'>{$cat_name}</option>";            
                        //   }
                    ?>
              <!-- </select> -->


              <div class="form-group mt-5">
              <img width="100" src="./user_images/<?php echo $user_image; ?>" alt=""><br>
                  <input type="file" name="user_file">
                  </div>


                </div>
               
        </div>
    </div>
              
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="card-footer">
                  <button type="submit" name="update_user" class="btn btn-primary"  ">Update User</button>
                </div>
          
          </div>
          <!-- /.card-body -->
          
          

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
