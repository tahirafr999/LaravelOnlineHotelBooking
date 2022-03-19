<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php include "include/header.php"; ?>
<?php include "include/connection.php"; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a href="./index.php"><img class="navbar-brand ml-5 tahir-logo" src="images/tahir-logo.png" width="150"></a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <form class="form-inline my-2 my-lg-0 m-auto">
      <input class="mr-sm-2 input-size" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <div class="links ">
    <ul class="navbar-nav  mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
      <a href="">
<?php 
if(isset($_SESSION['username'])){ ?>

 <a href='' class='nav-link' id='sign_up_btn'><?php echo $_SESSION['username'];?></a> 
 <?php echo "<li  class='nav-item'><a href='admin/index.php' class='nav-link' >Admin</a></li> "; 
 echo "<a href='./login/logout.php' class='nav-link'>Logout</a> ";
 echo "<a href='checkout_details.php' class='nav-link'><i class='fa fa-shopping-cart fa-2x' aria-hidden='true'></i> </a> "; 
 echo "<span class='counter counter-lg'><span style='color:white;font-size:20px;background-color:red;border-radius:100%;padding:5px;'> 0 </span></span>" ;
}else{ ?>

<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          User Login
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./login/login.php">Login</a>
          <a class="dropdown-item" href="./login/registration.php">Registration</a>   
        </div>

<?php  } ?> </a>
    
      </li>
   
    </ul>
   </div>
  </div>
</nav>


<?php
$online_user_id = $_SESSION['id'];
if(isset($_POST['add_to_checkout'])) {
$buyer_id = $_SESSION['id']; 
$buyer_name = $_SESSION['username'];  
$product_gtotal = $_POST['tglobal'];
$user_address = "peshawar pakistan";
$query = "INSERT INTO checkout_details(buyer_name,buyer_id,product_gtotal,user_address) VALUES('$buyer_name','$buyer_id','$product_gtotal','$user_address')";
$insert_form_data = mysqli_query($conn,$query);
if($insert_form_data){
  $checkout_delete_query = "DELETE FROM cart WHERE add_to_cart_user_id = {$online_user_id} ";
  $checkout_delete_query_check = mysqli_query($conn,$checkout_delete_query);
      if(!$checkout_delete_query_check) {
          die("QUERY FAILED ." . mysqli_error($conn));

      }
    }
  }
?>
</div>  <!-- model ended -->
<div class="container-fluid p-0 bg-defult">

    <ul class="navbar-nav all-brands">
      <li>laptop</li>
      <li>laptop</li>
      <li>laptop</li>
      <li>laptop</li>
      <li>laptop</li>
    </ul>

<?php 
    if(isset($_POST['add_to_checkout'])){ ?>
      <div class="alert alert-success" role="alert" id="alertcart">
      Thanks For Buying Products From Our Store!!
     </div>
   <?php } ?>

</div> 
<div class="row">
  <div class="col-md-12 mt-5">
  <h2 class="text-center">All Your Products</h2>
  <table class="table" style='width:90%; align-content:center;margin:auto' id="StudentInfoListTable">
  <thead>
    <tr>
      <th scope="col">Order</th>
      <th scope="col">Buyer </th>
      <th scope="col">Product </th>
      <th scope="col">Address</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $online_user_id = $_SESSION['id']; 
$query = "SELECT * FROM checkout_details WHERE buyer_id = {$online_user_id}";
$select_post = mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($select_post)){ 
$id = $row['order_id'];
$title = $row['buyer_name'];
$author = $row['product_gtotal'];
$image = $row['user_address'];
//= $tags = $row['tags']; ?>
<tr>
      <th scope="row"><?php echo $id; ?> </th>
      <td><?php echo $title; ?> </td>
      <td><?php echo $author; ?> </td>
      <td><?php echo $image; ?> </td>
    

    </tr>

    <?php } ?>

  </tbody>

</table>
<div id="editor"></div>
<p class="text-center"> <Button type="button" class="text-center btn btn-success " id="cmd" >Generate PDF</button></p>
<p class="text-center"> <a href="online_payment.php" type="button" class="text-center btn btn-primary " id="cmd" >Want To Pay online</a></p>
  </div>
</div>

<!-- Banner end here -->


<!-- for generating pdf file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<?php include "include/footer.php"; ?>

<script>
    $(function(){
         var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

   $('#cmd').click(function () {

        var table = tableToJson($('#StudentInfoListTable').get(0))
        var doc = new jsPDF('p','pt', 'a4', true);
        doc.cellInitialize();
        $.each(table, function (i, row){
            console.debug(row);
            $.each(row, function (j, cell){
                doc.cell(5, 10,140, 30, cell, i);  // 2nd parameter=top margin,1st=left margin 3rd=row cell width 4th=Row height
            })
        })


        doc.save('sample-file.pdf');
    });
    function tableToJson(table) {
    var data = [];

    // first row needs to be headers
    var headers = [];
    for (var i=0; i<table.rows[0].cells.length; i++) {
        headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi,'');
    }


    // go through cells
    for (var i=0; i<table.rows.length; i++) {

        var tableRow = table.rows[i];
        var rowData = {};

        for (var j=0; j<tableRow.cells.length; j++) {

            rowData[ headers[j] ] = tableRow.cells[j].innerHTML;

        }

        data.push(rowData);
    }       

    return data;
}
});
</script>

<script>
setTimeout(function() {
$('#alertcart').hide();
},3000);
</script>
