<?php include "include/header.php"; ?>

<?php include "include/navbar.php"; ?>

<div class="container-fluid">
<!--section start -->
<section >
    <div class="row">
        <div class="col-md-7 col-sm-6 col-xs-12">
            <h1 class="mt-5 ml-5 font-weight-light">My Lists</h1>
              <h2 class="ml-5 mt-4 font-weight-light">Cart (2 items)</h2>  
                <?php if(isset($_SESSION["cart_delete_product"])){
                if ($_SESSION["cart_delete_product"] == TRUE){?>
                <div class="alert alert-success alert-dismissable" id="alertcart">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4 class="color:white;"><i class="icon fa fa-check"></i>  <?php  echo "Product Delete Successfully";   $_SESSION['cart_delete_product'] = FALSE; ?></h4>  
                </div>
                <?php } } ?>            
              <?php
                // $query = "SELECT  *  FROM cart ";
                $online_user_id = $_SESSION['id'];
                $query = "SELECT cart.id,cart.product_name,cart.product_author,category.cat_name,cart.product_image,cart.product_price
                FROM cart
                INNER JOIN category ON category.cat_id = cart.product_category
                WHERE add_to_cart_user_id = $online_user_id";
                $select_post = mysqli_query($conn,$query);
                $total= 0;
                while($row = mysqli_fetch_assoc($select_post)){ 
                $id = $row['id'];
                $title = $row['product_name'];
                $author = $row['product_author'];
                $category = $row['cat_name'];
                $quantity = 1 ;
                $image = $row['product_image'];
                $product_price = $row['product_price'];
                // $total = $total + ($row["product_price"] * $quantity);
                 ?>
             <div class="card mt-5 mb-5 ml-5" id="test_card">
                <div class="card-body"> 
                    <!-- card inner row -->
                    <div class="row">
                        <!-- card inner col -->
                        <div class="col-md-3 col-xs-6">
                           <!-- <img src="admin/posts_images/<?php //echo  $image; ?>" class="cart-image"> -->
                           <?php echo  "<img src='admin/posts_images/$image'  class='cart-image'> " ;?>
                        </div> 
                        <!-- card inner col -->
                         <!-- card inner col -->
                         <div class="col-md-5 col-xs-6">
                          <p style="font-size:20px;"><?php echo  $title; ?></p>
                          <p class="text-muted" style="font-size:20px;"><?php echo  $author; ?></p>
                          <p class="text-muted" style="font-size:20px;"><?php echo  $category; ?></p>
                          <p class="text-muted" style="font-size:20px;">Price of Product Rs:  <span><?php echo  $product_price;?></span></p>
                          <input class="iprice" type="hidden" value="<?php echo $product_price ;?> ">
                          <p class="mr-4"><?php echo "<a href='cart_details.php?cart_product_id=$id'><i class='fa fa-trash-o fa-2x mt-4'></i><a href='cart_details.php?cart_product_id=$id'><span style='text-decoration:none;margin-left:15px;'>Remove Item</span></a>"; ?></p>
                        </div> 
                        <!-- card inner col -->

                         <!-- card inner col -->
                        <div class="col-md-2 col-xs-6 ">
                        <!-- <div class="btn-group float-left" role="group" aria-label="Basic example" style="border:1px solid black; border-radius:5px;width:200px; padding:5px;"> -->
                        <!-- <button type="button" class="btn btn-default"  onclick="minusbot(<?php // echo $id;?>)"><i class="fa fa-minus" aria-hidden="true"></i></button> -->
                        <!-- <input type="text" name="kgcount" value="1" id = "kilohere_<?php //echo $id; ?>" style="width:110px;height:25px;margin-top:8px; text-align:center;"> -->
                        <input class="iquantity text-center" type="number"  onchange='subTotal()' value='<?php echo $quantity; ?>' min='1' max='10'>
                        <!-- <button type="button" class="btn btn-default mb-1" onclick="plusbot('<?php // echo $id ?>','<?php //echo $product_price ?>','<?php //echo $total ?>','<?php //echo $quantity ?>')"><i class="fa fa-plus" aria-hidden="true"></i></button> -->
                        <!-- </div> -->
                        <p class="total_cart font-weight-bold">RS:<span class="total_cart itotal ml-3"></span></p>
                        <!-- <P  class="total_cart" id="tell_<?php //echo $id;?>"><?php //echo $product_price; ?></P> -->
                        <!-- <p><?php //echo $phpvar = "<script>document.writeln(adding_product_price)</script>";?> </p> -->
                        </div> 
                        <!-- card inner col -->
                    </div>
                     <!-- card inner row -->                 
                </div>  <!-- card body-->
            </div>  <!-- card -->
            <?php } ?>       
        </div>   <!-- col -->
        
        
        
        <!-- col 2 -->
        <div class="col-md-5 col-sm-6 col-xs-12">
            <h1 class="ml-5 font-weight-light" style="margin-top:113px;">Total Amount of</h1>
             <div class="card mt-5 mb-5 ml-5"  style="margin-top:100px;">
                <div class="card-body"> 
                    <!-- card inner row -->
                    <div class="row">
                        <!-- card inner col -->
                        <div class="col-md-12 col-xs-6">
                           <form action="checkout_details.php" method="POST">
                            <h2>Grand Amount :<span class="mt-5 ml-5"  id="gtotal" ></span></h2>
                           <input type="hidden" name="tglobal" id="tglobal" >
                           <button type="submit" name="add_to_checkout" class="btn btn-primary btn-block mt-5 p-3">Go to Checkouta</button>
                           <!-- <a href="online_payment.php" type="submit" name="add_to_checkout" class="btn btn-success btn-block p-3">Online Payment</a> -->

                        </form>
                        </div> 
                        <!-- card inner col -->

                    </div>
                     <!-- card inner row -->
                    
                </div>  <!-- card body-->
            </div>  <!-- card -->
        </div>   <!-- col -->

        <!-- col 2 -->

        



    </div>   <!-- row -->
</section>
<!-- section end -->
</div>
<?php include "include/footer.php"; ?>

<?php 

if(isset($_GET['cart_product_id'])){
    $cart_product_id = $_GET['cart_product_id'];
    $cart_query = "DELETE FROM cart WHERE id = $cart_product_id ";
    $cart_query_complete = mysqli_query($conn,$cart_query);
    $_SESSION['cart_delete_product'] = " ";
    echo "<script type='text/javascript'> document.location = 'cart_details.php'; </script>";
}

?>
<script>
  setTimeout(function() {

// Do something after 3 seconds
// This can be direct code, or call to some other function

$('#alertcart').hide();

},2000);
</script>
<!-- <script>
    function minusbot(id,product_price)
    {   var id = id;
        var  price = product_price;
        // alert(price);
        var quentity = document.getElementById('kilohere_'+id).value = parseInt(document.getElementById('kilohere_'+id).value) - 1;

        var check = 'tell_<?php //echo $id;?>';
        // alert(check);   

        // var minus = document.querySelector(".total_cart");
        // alert(minus);
  
        // var minus = document.getElementById("total-cart").value;
        // alert(minus);
        // return false;

        var checknumifzero = parseInt(document.getElementById('kilohere_'+id).value);

        if(checknumifzero < 1) //preventing to get negative value
        {
            document.getElementById('kilohere_'+id).value = 1;
        }
    }  

    function plusbot(id,product_price,total,quantity)
    {
        var id = id; 
        var  price = product_price;
         var quentity = document.getElementById('kilohere_'+id).value = parseInt(document.getElementById('kilohere_'+id).value) + 1;
         var adding_product_price = price * quentity;
         document.getElementById('tell_'+id).innerHTML=adding_product_price;


    }
</script> -->

<script>
    var gt = 0;
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
    var itotal = document.getElementsByClassName('itotal');
    var gtotal = document.getElementById('gtotal');
    // console.log(gtotal);
   



    function subTotal(){
        gt=0; 
        for(i=0;i<iprice.length; i++){

            itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);
            gt = gt+(iprice[i].value)*(iquantity[i].value);
        }
        gtotal.innerText=gt;
        var tglobaltest = document.getElementById('tglobal').value = gt;
      console.log(tglobaltest);
    }
    subTotal();

</script>

