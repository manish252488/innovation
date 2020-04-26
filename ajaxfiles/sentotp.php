<?php session_start();
?>
<?php
$x=$_REQUEST["x"];
$rand=random_int(10000, 99999);
$_SESSION["otp"]=$rand;
$msg="your otp is ".$rand;
if(mail($x,"@write your story-otp verification", $msg))
	echo true;
else
echo false;
?>