<?php session_start(); ?>
<?php
$x=$_REQUEST["u"];
require 'dbconnect.php';
#$x=feedno

$n=0;
mysqli_real_escape_string($conn,$_SESSION['USER']);
mysqli_real_escape_string($conn,$x);
mysqli_real_escape_string($conn,$n);
$like="select * from feedno".$x;
if (!mysqli_query($conn,$like)) 
{
	$ct="CREATE TABLE feedno".$x."(slno int not null AUTO_INCREMENT,username varchar(50) not null unique,primary key(slno))";
mysqli_query($post,$ct);
}
$sql="SELECT username FROM feedno".$x;
if ($res=mysqli_query($post,$sql)) 
{
	while ($r=mysqli_fetch_row($res)) 
	{
	if ($r[0]==$_SESSION["USER"]) 
	{

		$sql="DELETE FROM feedno".$x." WHERE username='".$_SESSION['USER']."'";
if(mysqli_query($post,$sql))
{
	$incl="SELECT likes FROM feeds WHERE feedno='$x'";
	$res=mysqli_query($conn,$incl);
	$r=mysqli_fetch_row($res);
	$r[0]=$r[0]-1;
	mysqli_real_escape_string($post,$r[0]);
	$sql="UPDATE feeds SET likes='$r[0]' WHERE feedno='$x'";
	if(mysqli_query($conn,$sql))
	{
		$n++;
	echo $r[0]."/0";
}
}
	}

	}
}
if ($n==0)
 {
	mysqli_real_escape_string($post,$_SESSION["USER"]);
	$up="INSERT INTO feedno".$x."(username) VALUES('".$_SESSION["USER"]."')";
	if(mysqli_query($post,$up))
	{
	$incl="SELECT likes FROM feeds WHERE feedno='$x'";
	$res=mysqli_query($conn,$incl);
	$r=mysqli_fetch_row($res);
	$r[0]=$r[0]+1;
	mysqli_real_escape_string($post,$r[0]);
	$sql="UPDATE feeds SET likes='$r[0]' WHERE feedno='$x'";
	if(mysqli_query($conn,$sql))
	echo $r[0]."/1";
}
}
mysqli_close($conn);
mysqli_close($post);
?>