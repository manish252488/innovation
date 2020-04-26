<?php session_start(); ?>
<?php
$x=$_REQUEST["x"];
$y=$_REQUEST["y"];
$u=$_SESSION["USER"];
$image=$_REQUEST["image"];
require 'dbconnect.php';
$sql="SELECT * FROM feeds";
if (!mysqli_query($conn,$sql)) {
	$sql="CREATE TABLE feeds(feedno int NOT NULL AUTO_INCREMENT,username varchar(50),image LONGBLOB,feed1 varchar(250),feed2 varchar(250),display varchar(10),likes int,shares int,upload TIMESTAMP,PRIMARY KEY(feedno))";
	mysqli_query($conn,$sql);
}
mysqli_real_escape_string($conn,$x);
mysqli_real_escape_string($conn,$u);
mysqli_real_escape_string($conn,$y);
$sql="INSERT INTO feeds(username,feed1,display,likes,shares) VALUES('$u','$x','$y',0,0)";
if(mysqli_query($conn,$sql))
	echo true;
else
	echo false;
?>