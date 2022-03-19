 <?php include "admin_db_connection.php"; ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Welcome To Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Online User Checkout</span>
                <?php
                  $online_user_id = $_SESSION['id'];
                  $query = "SELECT * FROM checkout_details WHERE buyer_id = $online_user_id";
                  $select_all_users = mysqli_query($conn,$query);
                  $checkout_count = mysqli_num_rows($select_all_users);
                  // echo  "<div class='huge'>{$post_count}</div>"
                  echo "<span class='info-box-number'>{$checkout_count}</span> " ;?>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Categories</span>
                <?php
                  $query = "SELECT * FROM category";
                  $select_all_users = mysqli_query($conn,$query);
                  $category_count = mysqli_num_rows($select_all_users);
                  // echo  "<div class='huge'>{$post_count}</div>"
                  echo "<span class='info-box-number'>{$category_count}</span> " ;?>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Products</span>
                  <?php
                  $query = "SELECT * FROM post";
                  $select_all_post = mysqli_query($conn,$query);
                  $product_count = mysqli_num_rows($select_all_post);
                  // echo  "<div class='huge'>{$post_count}</div>"
                  echo "<span class='info-box-number'>{$product_count}</span> " ;?>
            
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <?php

                // code for cart 
                $query = "SELECT * FROM cart ";
                $select_cart_data = mysqli_query($conn,$query);
                $cart_count = mysqli_num_rows($select_cart_data);
                
                  $query = "SELECT * FROM register_users";
                  $select_all_users = mysqli_query($conn,$query);
                  $user_count = mysqli_num_rows($select_all_users);
                  // echo  "<div class='huge'>{$post_count}</div>"
                  echo "<span class='info-box-number'>{$user_count}</span> " ;?>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          </div>
        <!-- /.row -->  


      <!-- chart -->
      
  <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
          <?php
          $element_text = ['All Products','Online User Checkout Remaining','All Categories', 'Registered Users','Products in Cart'];       
          $element_count = [$product_count,$checkout_count, $category_count, $user_count,$cart_count];
          for($i =0;$i < 5; $i++) {
          echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
          }                                           
          ?>
                                       
         
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
      <!-- chart end -->



      <div class="col-md-12 col-xs-12 col-sm-12" >
    <div id="columnchart_material"></div>
        </div>
    
        
  


 
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <style>
    #columnchart_material{
      height:400px !important;
    }

    @media only screen and (max-width: 600px) {
      #columnchart_material{
    background-color: lightblue;
    height:500px !important;
  }
}
  </style>

  


   
 