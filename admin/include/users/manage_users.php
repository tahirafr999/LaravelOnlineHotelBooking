<?php include "./include/admin_db_connection.php"; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <a href="users.php?source=add_user" class="btn btn-success">Add User </a>
            <?php if (isset($_SESSION['delete_successfully'])){
              if ($_SESSION["delete_successfully"] == TRUE){?>
       <div class="alert alert-danger alert-dismissable mt-5" id="deleteuser">
       <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
       <h4 class="color:white;"><i class="icon fa fa-check"></i> <?php  echo "Your Data Is Deleted Successfully";   $_SESSION['delete_successfully'] = FALSE; ?> </h4>  
    
    <?php  } } ?> 

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">ID </th>
                  <th class="text-center">Profile Name</th>
                  <th class="text-center">Email</th>
                  <th class="text-center">Username</th>
                  <th class="text-center">User Role</th>
                  <th class="text-center">User Status</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>             
                </tr>
                </thead>

                <tbody>
                <?php 
                $query = "SELECT  *  FROM register_users";
                $select_post = mysqli_query($conn,$query);
                while($row = mysqli_fetch_assoc($select_post)){ 
                  $id = $row['id'];
                  $name_of_user = $row['name_of_user'];
                  $email = $row['email'];
                  $username = $row['username'];
                  $user_role = $row['user_role'];
                  $user_image = $row['user_image'];
                  $verify_status = $row['verify_status'];
                  ?>

                  <tr>
                  <td  class='text-center'><?php   echo  $id ?> </td>
                  <td  class='text-center'><?php   echo $name_of_user ?></td>
                  <td  class='text-center'><?php   echo $email ?></td>
                  <td  class='text-center'><?php   echo $username ?></td>
                  <td  class='text-center'><?php   echo $user_role ?></td>
                  <?php echo "<td class='text-center'><img style='border-radius:5px; width:120px; height:50px;' src='./user_images/$user_image' alt='images'></td> "; ?>
                  <?php echo "<td  class='text-center'><a href='./users.php?source=edit_users&u_id=$id'><i class='fas fa-edit fa-2x text-warning'> </i></a></td> " ?>
                  <td  class='text-center'><a href='./include/delete.php?u_id=<?php echo $id; ?>' onclick="return confirm('Are you sure you want to search Google?')"><i class='fas fa-trash-alt fa-2x text-danger'></i></a></td>
                  
                 <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                <th class="text-center">ID </th>
                  <th class="text-center">User First Name</th>
                  <th class="text-center">User Last Name</th>
                  <th class="text-center">Username</th>
                  <th class="text-center">User Email</th>
                  <th class="text-center">User Image</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>   
                </tr>
                </tfoot>
              </table>
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


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      ...
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary">Save changes</button>
    </div>
  </div>
</div>
</div>


<script>
setTimeout(function() {

// Do something after 3 seconds
// This can be direct code, or call to some other function

$('#deleteuser').hide();

},1200);
</script>


