<?php 
require('stripe-php-master/init.php');

$Publishable =	"pk_test_51IUyrOF9adkmVg5fmm2OkMvbI34LKMDwJWvpHMrmlxWDsTQurwA3IzaCiFoyn1ewkUTpToEzWRfry1aQ8ZpRJHFN00xa0k1BO2";
$Secret =	"	sk_test_51IUyrOF9adkmVg5fOqQPCud0OPxc779lTJdhWMgI8CONVYdBrZk3IdunSKniMSNpF3GIRdqSAUhLtAc8oBNExyUw00eTWexYlN";

\Stripe\Stripe::setApiKey($Secret);

?>