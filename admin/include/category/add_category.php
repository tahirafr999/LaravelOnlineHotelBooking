  <?php include "./include/admin_db_connection.php";
  
  
if(isset($_POST['submit'])){
    $cat_name = $_POST['cat_name'];
    $check_category_query = "SELECT cat_name FROM category WHERE cat_name ='$cat_name' LIMIT 1";
    $check_catgory_query_run = mysqli_query($conn, $check_category_query);

    if(mysqli_num_rows($check_catgory_query_run) > 0 ){
      $GLOBALS["category_exixts"]="Category Already Exists" ;
       
    }else {
    $query = "INSERT INTO category(cat_name) VALUES('$cat_name')";
    
    $insert_form_data = mysqli_query($conn,$query);
    if(!$insert_form_data){
      die("QUERY FAILED" .mysqli_error($conn));    
    }
    $GLOBALS["successful_message"]="Category Created Successfully" ;
 } }
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
          <a href="./category.php?source=list_category.php" class="btn btn-success">List Categories </a>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
            
          </div>
          <!-- /.card-header -->
          <div class="card-body">

      <?php if(isset($GLOBALS["successful_message"])){?>
      <div class="alert alert-success alert-dismissable" id="alertMessage">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <h4 class="color:white;"><i class="icon fa fa-check"></i> <?php  echo $GLOBALS["successful_message"]; ?> </h4>  
   <?php  } ?>
   <?php if(isset($GLOBALS["category_exixts"])){?>
      <div class="alert alert-danger alert-dismissable" id="alertMessage">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <h4 class="color:white;"><i class="icon fa fa-check"></i> <?php  echo $GLOBALS["category_exixts"]; ?> </h4>  
   <?php  } ?>
    </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                       <!-- form start -->
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputTitle">Category Name</label>
                    <input type="text" class="form-control"  name="cat_name" placeholder="Enter Category Name" required>
             
                  
                  </div>
             

                  <div class="form-group">
                  <button type="submit" name="submit" class="btn btn-primary" onclick="return validation() ">Submit</button>
                  </div>
             
                 
                </div>  
                <!-- /.card-body -->
                </div>
          
            
              </div>
              <!-- /.col -->
            
            </div>
            <!-- /.row -->

          
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

$('#alertMessage').hide();

},1200);

setTimeout(function() {

// Do something after 3 seconds
// This can be direct code, or call to some other function

$('#deletepost').hide();

},1200);

</script>