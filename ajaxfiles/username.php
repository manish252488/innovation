<?php session_start();
?>
<?php
$x=$_REQUEST["x"];
require 'dbconnect.php';
mysqli_real_escape_string($conn,$x);
$sql="SELECT username FROM users";
if ($res=mysqli_query($conn,$sql)) 
{
	while ($r=mysqli_fetch_row($res)) 
	{
		if (strtolower($r[0])==strtolower($x)) 
		{
			$err++;
		}
	}
	if ($err>0) {
	echo false;

	}
	else
		echo true;
}
else
echo "true";

mysqli_close($conn);
?>