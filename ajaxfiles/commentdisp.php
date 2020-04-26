<?php session_start();?>
<?php
require 'dbconnect.php';
$c=$_SESSION["COMNO"];
	$usr=$_SESSION["USER"];
		mysqli_real_escape_string($conn,$usr);
		$flag=false;
$sql="SELECT username FROM users WHERE username='$usr'";
if($res=mysqli_query($conn,$sql))
{
while($r=mysqli_fetch_row($res))
{
	if ($r[0]!="") 
	{
		$flag=true;
	}
}
}
else
echo "<script>window.location='../index.php';</script>";
if (!$flag) 
{
echo "<script>window.location='../index.php';</script>";
}
if ($_SESSION["USER"]=="") 
{
echo "<script>window.location='index.php';</script>";
}
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
	<title>comments</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="png/ico" href="../iconfol/icon.png">
  <link rel="stylesheet" type="text/css" href="../cssfol/comcss.css">
  <script type="text/javascript" src="../script1.js"></script>
</head>
<body>
	<img src='../iconfol/cross.png' id='close_btn' onclick='closecomm()'>
	<section>
		<div id='contentbox'>
	<?php
	$sql="SELECT * FROM feeds WHERE feedno='$c'";
if ($res=mysqli_query($conn,$sql)) 
{
	$r=mysqli_fetch_row($res);

	mysqli_real_escape_string($conn,$r[1]);
	$s="SELECT name FROM users WHERE username='$r[1]'";
		$rs=mysqli_query($conn,$s);
		$name=mysqli_fetch_row($rs);
		mysqli_real_escape_string($conn,$r[0]);
		if ($r[5]=="true") {
			echo "<span class='name0001'>".$name[0]."</span>";
		}
		else{
			echo "<span class='name0001'>"."Anonoumous"."</span>";
		}
		$r[8]=date_create($r[8]);
		echo "<span class='uploadtime001'>".date_format($r[8],'d M Y h:i a')."</span>
		<span class='textfeed001'>".$r[3]."</span>
<span class='likes'><img src='../iconfol/like.png' class='iconglo'>&nbsp <span id='likes0'>".$r[6]."</span>likes &nbsp&nbsp <img src='../iconfol/share.png' class='iconglo'>&nbsp".$r[7]."share</span>";

$x=$r[0];
mysqli_real_escape_string($post,$x);
$flag=false;
$sql="SELECT username FROM feedno".$x;
if ($s=mysqli_query($post,$sql)) 
{
while($m=mysqli_fetch_row($s))
{
if (strtolower($m[0])==strtolower($_SESSION["USER"])) 
{
	$flag=true;
}
}
if ($flag) {
echo "<div class='box02'><button id='likebtn' style='background:#4169e1' onclick='likeplusc($x,this)'>like</button><button>share</button></div>";
}
else{
echo "<div class='box02'><button id='likebtn' style='background:#fff' onclick='likeplusc($x,this)'>like</button><button>share</button></div>";
}
}
else
echo "<div class='box02'><button id='likebtn' style='background:#fff' onclick='likeplusc($x,this)'>like</button><button>share</button></div>";	
}
?>
</div>
<div id="commcontainer">
	<?php 
	mysqli_real_escape_string($post,$c);
	mysqli_real_escape_string($conn,$c);
	$sql="SELECT * FROM comments WHERE feedno='$c'";
	if (!mysqli_query($post,$sql)) 
	{
		$sql="CREATE TABLE comments(feedno varchar(250),username varchar(50),comment varchar(250),likes int,uptime TIMESTAMP)";
		mysqli_query($post,$sql);
	}
	$sql="SELECT * FROM comments WHERE feedno='$c'";
	if($res=mysqli_query($post,$sql))
	{
		while ($s=mysqli_fetch_row($res)) 
		{
			echo "<div class='commentframe'>";
			mysqli_real_escape_string($conn,$s[0]);
			$sq="SELECT name FROM users WHERE username='$s[1]'";
				$q=mysqli_query($conn,$sq);
				$name=mysqli_fetch_row($q);
				echo "<span class='name007'>".strtoupper($name[0])."</span>";
			$s[4]=date_create($s[4]);
			echo "<span class='comment007'>".$s[2]."</span>";
			
			echo "<span class='date007'>".date_format($s[4],'d M Y h:i a')."</span>";
			echo "</div>";
		}
		mysqli_real_escape_string($conn,$c);
		echo "<span><span id='errorcom' style='display: block;'></span><textarea class='commentupload' id='commentupload' rows='10' cols='2'></textarea><button class='postbtn' onclick='postcomment($c)'>POST</button></span>";
	}
	?>

</div>
</section>

</body> 
</html>