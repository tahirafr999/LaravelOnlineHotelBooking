<?php include "./include/admin_db_connection.php"; ?>
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
             <a href="./category.php?source=add_category" class="btn btn-success">Add Category</a>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
              <?php if (isset($_SESSION['delete_successfully'])){
                if ($_SESSION["delete_successfully"] == TRUE){?>
         <div class="alert alert-danger alert-dismissable mt-5" id="deletepost">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <h4 class="color:white;"><i class="icon fa fa-check"></i> <?php  echo "Your Data Is Deleted Successfully";   $_SESSION['delete_successfully'] = FALSE; ?> </h4>  
      
      <?php  } } ?>   
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- <div class="form-group"> -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">ID </th>
                      <th class="text-center">Category Name</th>
                      <th class="text-center">Categoy Related Posts</th>
                      <th class="text-center">Delete</th>
                 
                           
                    </tr>
                    </thead>
  
                    <tbody>
                    <?php 
                    $query = "SELECT  *  FROM category";
                    $select_post = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_assoc($select_post)){ 
                      $id = $row['cat_id'];
                      $cat_name = $row['cat_name'];
                 
                   ?>
  
                      <tr>
                      <td  class='text-center'><?php  echo  $id ?> </td>
                      <td  class='text-center'><?php   echo $cat_name ?></td>
                     <?php echo "<td  class='text-center'> <a href='../category_related_posts.php?id=$id&cat_name=$cat_name'><i class='fas fa-eye'></a></i></td>" ?>
                      <td  class='text-center'><a href='./include/delete.php?cat_id=<?php echo $id ?>' onclick="return confirm('Are you sure you want to search Google?')"><i class='fas fa-trash-alt fa-2x text-danger'></i></a></td>
                      
                     <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th class="text-center">ID </th>
                      <th class="text-center">Category Name</th>
                      <th class="text-center">Categoy Related Posts</th>
                      <th class="text-center">Delete</th>
                     
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->

                    </div>
                    <!-- col-md-12 -->
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
  
  $('#deletepost').hide();
  
  },1200);
  
  </script>