<?php session_start();
?>
<?php
$x=$_REQUEST["x"];
$x=trim($x);
if ($_SESSION["otp"]==$x) 
{
	echo true;
}
else
echo false;
?>