<?php session_start(); ?>
<?php
require 'ajaxfiles/dbconnect.php';
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
echo "<script>window.location='index.php';</script>";
if (!$flag) 
{
echo "<script>window.location='index.php';</script>";
}
if ($_SESSION["USER"]=="") 
{
echo "<script>window.location='index.php';</script>";
}
error_reporting(0);
$curr_user= $_SESSION["USER"];
mysqli_real_escape_string($conn,$curr_user);
?>
<!DOCTYPE html>
<html>
<head>
	<title>WriteYourStory-feeds</title>
	<meta charset="UTF-8">
  <meta name="description" content="share life stories">
  <meta name="keywords" content="HTML,CSS,JavaScript">
  <meta name="author" content="stories and experiences">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="PROFILE123.css">
  <link rel="stylesheet" type="text/css" href="cssfol/css1.css">
  <link rel="icon" type="png/ic'logout.php'o" href="iconfol/icon.png">
  <script type="text/javascript" src="script1.js"></script>
</head>
<body>
	<div id="maincont">
		<div id="coverphoto"><button id="coverup" >upload</button><?php 
		$sql="SELECT image FROM profilepic WHERE username='$curr_user'";
		$result=mysqli_fetch_row(mysqli_query($conn,$sql)); 
		if($result!="")
			{
			echo "<img src='ajaxfiles/".$result[0]."' id='cover123'>";
			}
			else
			echo "<img src='#' id='cover123'>";  ?>
			<div id="profilepic"><?php 
		$sql="SELECT image FROM profilepic WHERE username='$curr_user'";
		$result=mysqli_fetch_row(mysqli_query($conn,$sql)); 
		if($result!="")
			{
			echo "<img src='ajaxfiles/".$result[0]."' id='pro123'>";
			}
			else
			echo "<img src='#' id='pro123'>";  ?>
	</div></div>
		
		<div id="buttoncontainer"><button onclick="window.location='index.php';">HOME</button><button onclick="openpanel(1)">Timeline</button><button onclick="openpanel(2)">ABOUT</button><button onclick="openpanel(3)">settings</button><button onclick="openpanel(4)">Activity Log</button>
	<div id="posts">
	<?php 
	$sql="SELECT * FROM feeds WHERE username='$curr_user' ORDER BY feedno desc ";
	$res=mysqli_query($conn,$sql);
	while ($r=mysqli_fetch_row($res)) 
	{
		$x=$r[0];
		mysqli_real_escape_string($post,$x);
		$r[7]=date_create($r[7]);
		$crrdt=getdate(date("U"));
		$s="SELECT name FROM users WHERE username='$r[1]'";
		$rs=mysqli_query($conn,$s);
		$name=mysqli_fetch_row($rs);
		mysqli_real_escape_string($conn,$r[0]);
		echo "<div class='feedbox'>
		<div class='box1'>";
		$jpl="SELECT image FROM profilepic WHERE username='$r[1]'";
		$dpres=mysqli_query($conn,$jpl);
		$dp=mysqli_fetch_row($dpres);
		if ($r[5]=="true") {
			echo "<span class='name'><img src='ajaxfiles/".$dp[0]."' class='dplogo'>".$name[0]."</span>";
		}
		else{
			echo "<span class='name'><img src='ajaxfiles/".$dp[0]."' class='dplogo'>".$name[0]."(Anonymous)</span>";
		}
		$jkl="SELECT * FROM comments WHERE feedno='$x'";
		$rlg=mysqli_query($post,$jkl);
		$count=0;
		while($lg=mysqli_fetch_row($rlg))
		{
			$count++;
		}
		echo "<span class='uploadtime'>".date_format($r[7],'d M Y h:i a')."</span>
		<span class='textfeed'>".$r[3]."</span>
<span class='likes'><img src='iconfol/like.png' class='iconglo'>&nbsp <span id='likes".$r[0]."'>".$r[6]."</span> likes &nbsp<span class='comments001'><img src='iconfol/com.png' class='iconglo'>".$count." comments</span>&nbsp <img src='iconfol/share.png' class='iconglo'>&nbsp".$r[7]."</span></div>";

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
echo "<div class='box2'><button id='likebtn' style='background:#4169e1' onclick='likeplus($r[0],this)'>like</button><button onclick='commentpanel($r[0],true)'>comment</button><button>share</button></div></div>";
}
else{
echo "<div class='box2'><button id='likebtn' style='background:#fff' onclick='likeplus($r[0],this)'>like</button><button onclick='commentpanel($r[0],true)'>comment</button><button>share</button></div></div>";
}
}
else
	echo "<div class='box2'><button id='likebtn' style='background:#fff' onclick='likeplus($r[0],this)'>like</button><button
onclick='commentpanel($r[0],true)'>comment</button><button>share</button></div></div>";

}
	?>
</div>	
	<footer>
		<span onclick="document.documentElement.scrollTop = 0">Backtotop</span>
	</footer>
</div>

</body>
</html>