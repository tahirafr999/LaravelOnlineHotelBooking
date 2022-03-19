<?php include "include/header.php"; ?>

<?php include "include/navbar.php"; ?>
<?php 
require('config_stripe.php');

// \Stripe\Stripe::setVerifySslCerts(false);
$token = $_POST['stripeToken'];
$amount = $_POST['total_amount'];

$data =\Stripe\Charge::create(array(
    "amount"=>$amount,
    "currency"=>"usd",
    "description"=>"Programming with Vishal Desc",
    "source"=>$token,
));


?>

<div class="container-fluid">
    <div class="jumbotron">
        <h3 class="text-center">Thank You For buying in Our Store</h3>
    </div>
</div>

<?php include "include/footer.php"; ?>