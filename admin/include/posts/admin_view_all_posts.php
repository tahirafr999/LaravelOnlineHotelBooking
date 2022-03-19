<?php include "./include/admin_db_connection.php"; ?>
<?php  if(isset($_POST['delete_all_products'])) {
foreach($_POST['checkBoxArray'] as $postValueId ){   
$query = "DELETE FROM post WHERE id = {$postValueId}";        
$update_to_delete_status = mysqli_query($conn,$query);}
} ?>              

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Products</h1>
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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <a href="post.php?source=add_post" class="btn btn-success">Add Posts </a>
              <?php if (isset($_SESSION['delete_successfully'])){
                if ($_SESSION["delete_successfully"] == TRUE){?>
         <div class="alert alert-danger alert-dismissable mt-5" id="deletepost">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <h4 class="color:white;"><i class="icon fa fa-check"></i> <?php  echo "Your Data Is Deleted Successfully";   $_SESSION['delete_successfully'] = FALSE; ?> </h4>  
      
      <?php  } } ?> 

              </div>
              <!-- /.card-header -->
              <div class="card-body">              
       <form action="" method='post'>
       <table id="example1" class="table table-bordered table-striped">
       
                  <thead>
                  <tr>
                    <th class="text-center">ID </th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Photo</th>
                    <th class="text-center">Category</th>
                    <!-- <th class="text-center">Post Description</th> -->
                    <!-- <th class="text-center">Tags</th> -->
                    <th class="text-center">Action</th> 
                    <!-- this Th have delete and checkbox-->
                    <th  class="ml-5"><input id="selectAllBoxes" type="checkbox" name="my_checkbox"> 
                    <span class="float-lg-right"><form action=""  method='post'>
                    <button class="btn btn-success float-lg-right span_delete"   type="submit" name="delete_all_products" onclick="return confirm('Are you Sure You want To Delete All Products ?')">
                    Delete</button></form></span></th>  
                  </tr>
                </form>
                  </thead>
                  <tbody>
                  <?php 
                  $query = "SELECT  *  FROM post";
                  $select_post = mysqli_query($conn,$query);
                  while($row = mysqli_fetch_assoc($select_post)){ 
                    $id = $row['id'];
                    $title = $row['title'];
                    $author = $row['author'];
                    $image = $row['photo'];
                    $category = $row['category'];
                    $post_description = $row['post_description'];
                    // $tags = $row['tags']; ?>
                    <tr>
                    <td  class='text-center'><?php  echo  $id ?> </td>
                    <td  class='text-center'><?php   echo $title ?></td>
                    <td  class='text-center'><?php   echo $author ?></td>
                    <?php echo "<td class='text-center'><img style='border-radius:5px; width:120px; height:50px;' src='./posts_images/$image' alt='images'></td> "; ?>
                    <td  class='text-center'><?php   echo $category ?></td>
                    <!-- <td  class='text-center'><?php   echo $post_description ?></td> -->
                    <!-- <td  class='text-center'><?php  // echo $tags ?></td> -->
              
                   
                    <!-- edit and delete icons-->
                    <?php echo "<td  class='text-center'><a href='./post.php?source=edit_post&p_id=$id'><i class='fas fa-edit fa-2x text-warning'> </i></a>
                   <span class='ml-3'> <a href='./include/delete.php?p_id=$id'onclick='return confirm('Are you sure you want to search Google?')'>
                   <i class='fas fa-trash-alt fa-2x text-danger'></i></a> </span> </td> " ?> 
                    <td class="mr-5"><input class='checkBoxes' type='checkbox' id="selectAllBoxes" name='checkBoxArray[]' value='<?php echo $id; ?>'></td>

                    
                   <?php } ?>
                  </tbody>
                  <tfoot>
                    
                  <tr>
                    <th class="text-center">ID </th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Photo</th>
                    <th class="text-center">Category</th>
                    <!-- <th class="text-center">Post Description</th> -->
                    <!-- <th class="text-center">Tags</th> -->
                    <th class="text-center">Action</th>
                    <th class="text-center">Delete</th>   
                  </tr>
                  </tfoot>
                </table>
              <!-- </form> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<script>
setTimeout(function() {

// Do something after 3 seconds
// This can be direct code, or call to some other function

$('#deletepost').hide();

},1200);


$(function()
{
$('[name="my_checkbox"]').change(function()
{
if ($(this).is(':checked')) {
$('.checkBoxes').each(function(){
this.checked = true;
});
} else {
$('.checkBoxes').each(function(){
this.checked = false;
});
   };
      });
    });

</script>


