<?php include "./include/admin_db_connection.php"; ?>


<?php
// $_SESSION['post_of_id'] = "";
// $join_query = "SELECT b.id, c.post_id FROM post b
// INNER JOIN post_tags c ON b.id = c.post_id
// ";
// $join_search = mysqli_query($conn,$join_query);
// while($row = mysqli_fetch_assoc($join_search)){
//   $_SESSION['post_of_id'] = $row['id'];
//    $post_id = $row['post_id'];
  
// }
// $specific_post_id = "";
// $specific_post_id = $_SESSION['post_of_id'];
$online_user_id = $_SESSION['id'];
if(isset($_POST['submit'])){
  // $id = $_POST['post_id'];
  $title = $_POST['title'];
  $author =  $_SESSION['username'];
  $product_posted_by_id = $online_user_id;
  $post_image = $_FILES['file']['name'];
  $post_image_temp = $_FILES['file']['tmp_name'];
  $category = $_POST['category'];
  // $product_category_id = $_POST['post_category_id'];
  $product_category_id = $category ;
  $post_description = $_POST['description'];
  $product_price = $_POST['product_price'];

  move_uploaded_file($post_image_temp, "./posts_images/$post_image");


  $query = "INSERT INTO post(title,author,product_posted_by_id,photo,category,post_category_id,post_description,product_price) VALUES('$title','$author','$product_posted_by_id','$post_image','$category','$product_category_id','$post_description','$product_price')";
  $insert_form_data = mysqli_query($conn,$query);
  if($insert_form_data){
    $my_id = mysqli_insert_id($conn);
    $tags = $_POST['tags'];
    foreach($tags as $item){  
      $tag_query = "INSERT INTO post_tags(tag_name,users_id,post_id) VALUES('$item','$online_user_id','$my_id')";
      $insert_tag_data = mysqli_query($conn,$tag_query);
    }
  }
  if(!$insert_form_data){
    die("QUERY FAILED" .mysqli_error($conn)); 
  }
  $GLOBALS["successful_message"]="Post Created Successfully" ;
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
            <h1>Add Product</h1>
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
         

      <div class="alert alert-success alert-dismissable" id="addpost">
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

                    <!-- <input type="hidden" class="form-control"  name="post_id" id="post_id"> -->
                    <!-- <small id="usererror"></small> -->

                  <div class="form-group">
                    <label for="exampleInputTitle">Product Title</label>
                    <input type="text" class="form-control"  name="title" placeholder="Enter Post Title" id="post_title">
                    <small id="usererror"></small>
                  
                  </div>
 
                  <div class="form-group">
                    <label for="exampleInputAuthor">Product Posted By</label>
                    <input type="text" class="form-control"  name="author" value="<?php echo $_SESSION['username'];?>" disabled>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPrice">Product Price</label>
                    <input type="text" class="form-control" id="exampleInputPrice" name="product_price" placeholder="Enter product Price">
                  </div>


                  <div class="form-group">
                  <label for="image">Product Image</label><br>
                  <input type="file" name="file">
                  </div>
                 
                </div> 
                
               
                <!-- /.card-body -->
                </div>
          
            
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
              <label for="category">Category</label><br>
              <select name="category" id="mul-select">
                  <option value="Select" >Select Category</option>
                  <?php
                          $query = "SELECT * FROM category";
                          $select_category = mysqli_query($conn,$query);      
                          while($row = mysqli_fetch_assoc($select_category)) {
                          $cat_id = $row['cat_id'];
                          $cat_name = $row['cat_name'];          
                              echo "<option value='{$cat_id}' style='font-size:20px; font-weight:bolder;'>{$cat_name} </option>";            
                          }
                    ?>
              </select>
                </div>

                

                  <div class="form-group">
                    <label for="exampleInputDescription">Product Description</label>
                      <textarea id="editor" class="form-control" style="width:530px;height:100px; resize:none;" name="description"></textarea> </div>
                  <!-- <div class="form-group">
                    <label for="exampleInputTag">Post Tags</label>
                    <input type="text" class="form-control jsexampleplaceholdermultiple" id="jsexampleplaceholdermultiple" placeholder="Enter Post Tag" name="tags">
                  </div> -->
                <!-- /.form-group -->
        <div class="col-md-12">
                <div class="form-group">
                  <label>Tags</label>
                  <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;"  name="tags[]" required>
                    <?php
                          $query = "SELECT * FROM category";
                          $select_category = mysqli_query($conn,$query);      
                          while($row = mysqli_fetch_assoc($select_category)) {
                          $user_id = $row['cat_id'];
                          $cat_name = $row['cat_name'];          
                              echo "<option value='{$cat_name}'>{$cat_name}</option>";            
                          }
                    ?>
                  </select>
                </div>
        </div>
    </div>
              
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          
          </div>
          <!-- /.card-body -->
          
          <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary" onclick="return validation() ">Submit</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>



<script>
   function validation(){
        //  var post_title = document.getElementById('post_title').value;
         var location = document.getElementById('mul-select');
         var invalid = location.value == "Select";
        //  var password = document.getElementById('password').value;
        //  var cpassword = document.getElementById('cpassword').value;
        //  var male = document.getElementById('male');
        //  var female = document.getElementById('female');
        //  var other = document.getElementById('other');
        
        //  email = document.getElementById('email').value;
        //  var mobilenumber = document.getElementById('mobilenumber').value;

         var usercheck =/^[A-Za-z.]{3,30}$/ ;
        //  var lastnamecheck = /^[A-Za-z.]{3,30}$/ ;
        //  var passwordcheck = /^(?=.*[0-9])(?=.*[!@#%/^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;

        //  const emailcheck = /^[A-Za-z_]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/;

        //  var mobilecheck = /^[789][0-9]{9}$/; 
      

        // if(usercheck.test(post_title)){
        //     document.getElementById('usererror').innerHTML = " ";
        // }else{
        //     document.getElementById('usererror').innerHTML = " ** Post title Should Not Be Empty";
        //     document.getElementById('usererror').style.color = "red";
        //     return false;
        // }

        if (invalid) {
        alert('Select Category');
        location.className = 'error';
    }
    else {
        location.className = '';
    }
    
    return !invalid;

      //   if(passwordcheck.test(password)){
      //       document.getElementById('passworderror').innerHTML = " ";
      //   }else{
      //       document.getElementById('passworderror').innerHTML = " ** password is invalid ";
      //       return false;
      //   }

      //   if(cpassword.match(password)){
      //       document.getElementById('cpassworderror').innerHTML = " ";
        

      //   }else{
      //       document.getElementById('cpassworderror').innerHTML = " **Passwrod is not matching";
      //       return false;
      //   }
        

      //   if(emailcheck.test(email)){
      //       document.getElementById('emailerror').innerHTML = " ";
      //   }else{
      //       document.getElementById('emailerror').innerHTML = " **Email is not Valid";
      //       return false;
      //   }

      //   if(mobilecheck.test(mobilenumber)){
      //       document.getElementById('mobileerror').innerHTML = " ";
      //   }else{
      //       document.getElementById('mobileerror').innerHTML = " **Number is not Valid";
      //       return false;
      //   }

      //  if (male.checked || female.checked || other.checked) {
      //   document.getElementById('mobileerror').innerHTML = " ";
      //  } else {
      //   document.getElementById('mobileerror').innerHTML = " Select gender";
      //       return false;
      //  }

}


setTimeout(function() {

// Do something after 3 seconds
// This can be direct code, or call to some other function

$('#addpost').hide();

},1200);




   ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        });



    </script>

<style>
  #mul-select{display: block;width: 100%;height: calc(2.25rem + 2px);padding: .375rem .75rem;font-size: 1rem;font-weight: 400;line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;border-radius: .25rem;box-shadow: inset 0 0 0 transparent;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
</style>