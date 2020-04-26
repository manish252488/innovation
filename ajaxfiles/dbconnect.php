<?php
$ser="localhost";
$us="manish25";
$ps="immanish1997@";
$db="databaseusers";
try
{
	$conn=mysqli_connect($ser,$us,$ps,$db);
}
catch(exception $e)
{
	echo "error:cannot connect to databse";
}
$db2="databaseposts";
try
{
	$post=mysqli_connect($ser,$us,$ps,$db2);
}
catch(exception $e)
{
	echo "error:cannot connect to databse post";
}
error_reporting(0);



?>