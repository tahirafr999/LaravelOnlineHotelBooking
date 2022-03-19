  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle "
           style="opacity: .8 ">
           <span class="brand-text font-weight-light">TA-19  <span style="color:green;color: springgreen;margin-left: 10px;"> Mall </span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Tahir Afridi</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
          <nav class="mt-2">

          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="./index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
       
          </li>
        
          <li class="nav-header">WORKING AREA</li>

          <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'user' ){ ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="post.php?source=add_post" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="post.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Products</p> 
                

                  
          </a>
              </li>
            </ul>
          </li>
          <?php } else { ?>

            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
               Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="post.php?source=add_post" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="post.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Products</p>   
          </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="category.php?source=add_category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add category</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="category.php?source=list_category" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Categories</p>
                </a>
              </li>
             
             
            </ul>

          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="users.php?source=add_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="users.php?source=manage_users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Users</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-header">WEBSITE MAINTENCE</li>
          <li class="nav-item">
          <a href="pages/examples/register.html" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Charts</p>
            </a>
          </li>
        <?php } ?>
        
       
        
        </ul>
        
         
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>