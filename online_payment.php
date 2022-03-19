<?php include "include/header.php"; ?>

<?php include "include/navbar.php"; ?>

<?php require "config_stripe.php"; ?>

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
$buyer_name = $row['buyer_name'];
$price = $row['product_gtotal'];
payableAmount($price);
$address = $row['user_address'];
//= $tags = $row['tags']; ?>
<tr>
      <th scope="row"><?php echo $id; ?> </th>
      <td><?php echo $buyer_name; ?> </td>
      <td><?php echo $price; ?> </td>
      <td><?php echo $address; ?> </td>
    </tr>

    <?php } ?>
  </tbody>
  <?php
function payableAmount($totalPrice){    
   // calculate total price here
   global $total;
    $total += $totalPrice; 
}
?>
</table>


<h4 class="ml-5 mt-5">Total Amount <span>RS:<?php echo $total; ?> </span> </h4>
<!-- <div id="editor"></div>
<p class="text-center"> <Button type="button" class="text-center btn btn-success " id="cmd" >Generate PDF</button></p>

  </div> -->
</div>

<form action="submit.php" method="post" style="margin-left:700px;"> 
<input type="hidden" name="total_amount" value="<?php echo $total; ?>">
<script

src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="<?php echo $Publishable?>"
data-amount=<?php echo $total ?>
data-name="TA MALL"
data-description="TA-19 MALL"
data-image="images/tahir-logo.png"
data-currency="usd"


>

</script>


</form>





<?php include "include/footer.php"; ?> 