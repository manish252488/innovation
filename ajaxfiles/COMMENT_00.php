<?php session_start();
?>
<?php
$x=$_REQUEST["x"];
	$_SESSION["COMNO"]=$x;
	echo true;
?>