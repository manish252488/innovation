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
mysqli_real_escape_string($conn,$usr);
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
  <link rel="stylesheet" type="text/css" href="cssfol/css1.css">
  <link rel="icon" type="png/ic'logout.php'o" href="iconfol/icon.png">
  <script type="text/javascript" src="script1.js"></script>
</head>
<body>
	<header id="header">
		<div id="left"  onclick="window.location='index.php'"><img src="iconfol/icon.png" class="mainico"><span id="title">WriteYourStory</span></div>
		<div id="right">
			<button class="btn-lg btj" onclick="window.location='logout.php'">LOGOUT</button></div>
	</header>
	<nav>
		<button class="btn btn-lg trans" onclick="window.location='feeds.php'">Home</button><?php echo "<img src='ajaxfiles/profile/".$_SESSION['USER'].".jpg' class='iconglo' style='position:relative;left:2vw;top:0;z-index:1;'>"; ?>
			<button class="btn btn-lg trans" onclick="window.location='profile.php'">Profile</button>
		<button class="btn btn-lg trans" onclick="topstoriespanel()">Top stories</button>
		<img src="iconfol/drop.png" id="btn001" onmouseover ="showdrop(true)" onclick="showdrop(true)">
		<div id="dropdown" onmouseleave ="showdrop(false)">
		<button class="btn btn-lg trans" onclick="window.location='ajaxfiles/settings.php'">Settings</button>
		<button class="btn btn-lg trans" onclick="window.location='ajaxfiles/activitylog.php'">Activity Log</button>
		<button class="btn btn-lg trans" onclick="window.location='logout.php'">Logout</button>
		<button class="btn btn-lg trans" onclick="window.location='ajaxfiles/faq.php'">Faq</button>
		<button class="btn btn-lg trans" onclick="window.location='ajaxfiles/about.php'">About</button>
		</div>
	</nav>

<section>
	<div id="container1">
		<span id="boxdes">MONTH'S TOP STORIES BY:</span>
		<?php
		$sql="SELECT username,name FROM users WHERE username!='$usr'";
		if($res=mysqli_query($conn,$sql))
		{
		while($r=mysqli_fetch_row($res))
		{
				$proico="SELECT image FROM profilepic WHERE username='$usr'";
				$lq=mysqli_query($conn,$proico);
				$picloc=mysqli_fetch_row($lq);
			echo "<a href=''><img src='ajaxfiles/".$picloc[0]."' class='dpico' alt='image'> ".$r[1]."</a>";
	
		}
	}
		?>
	</div>	
	<div id="container2">
	
	<?php
	echo "<input type='radio' name='dis' onclick='displayname(true)' class='radioI' checked><label>Include username(".$_SESSION["USER"].")</label>
	<input type='radio' name='dis' onclick='displayname(false)' class='radioI'><label>Anonoumous</label>";
	?>
		<textarea name="postfeed" id="postfeed" onfocus="changecolor(true)" onfocusout="changecolor(false)" rows="10" cols="30"></textarea><span class="error" id="uperror"></span>
		<input type="file" name="postimage" id="postimage" oninput="initializeimage()">
		<button onclick="uploadfile()" id="btn202">add file</button>
		<button id="uploadbtn" class="btn-lg" onclick="validateupload()">Upload</button>
		<div id="image00"><img src="#" id="previewimage"></div>
	</div>
	
	<div id="profile">
		<?php
		echo "<img src='ajaxfiles/profile/".$_SESSION['USER'].".jpg' id='profileDP'>";
		$usr=$_SESSION["USER"];
		$sql="SELECT name,email,dob FROM users WHERE username='$usr'";
		$res=mysqli_query($conn,$sql);
		$r=mysqli_fetch_row($res);
		echo "<span>".strtoupper($r[0])."</span>";
		echo "<span class='det'>MAIL</span>";
		echo "<span>".$r[1]."</span>";
		echo "<span class='det'>BIRTHDAY</span>";
			echo "<span>".strtoupper($r[2])."</span>";
		?>
		<img src="iconfol/add.png" class="iconglo uploadbtn" onclick="uploadpanel()">
			<form id="dpupload" action="ajaxfiles/uploadpic.php" method="post" enctype="multipart/form-data">
				<input type="file" name="dp" class="btn" required>
				<input type="submit" value="upload" class="btj btn-lg">
			</form>
	</div>
</section>
<div id="maincontainer">
	<div class="followbox">
		follow us:
		<a href="#"><img src="iconfol/insta.png"></a>
		<a href="#"><img src="iconfol/fb.png"></a>
		<a href="#"><img src="iconfol/gp.png"></a>
	</div>
<div id='feedcontainer'>
	<?php 
	$sql="SELECT * FROM feeds ORDER BY feedno desc";
	$res=mysqli_query($conn,$sql);
	while ($r=mysqli_fetch_row($res)) 
	{
		$x=$r[0];
		mysqli_real_escape_string($post,$x);
		$r[8]=date_create($r[8]);
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
			echo "<span class='name'>"."Anonoumous"."</span>";
		}
		$jkl="SELECT * FROM comments WHERE feedno='$x'";
		$rlg=mysqli_query($post,$jkl);
		$count=0;
		while($lg=mysqli_fetch_row($rlg))
		{
			$count++;
		}
		echo "<span class='uploadtime'>".date_format($r[8],'d M Y h:i a')."</span>
		<span class='textfeed'>".$r[3]."</span>
<span class='likes'><img src='iconfol/like.png' class='iconglo'>&nbsp <span id='likes".$r[0]."'>".$r[6]."</span> likes &nbsp<span class='comments001'><img src='iconfol/com.png' class='iconglo'>".$count." comments</span class='share001'>&nbsp <img src='iconfol/share.png' class='iconglo'>&nbsp".$r[7]."</span></div>";

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
</div>
<footer>
		<span onclick="document.documentElement.scrollTop = 0">Backtotop</span>
	</footer>
</body>
</html>