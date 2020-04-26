<?php session_start(); 
error_reporting(0);
require 'ajaxfiles/dbconnect.php';
if($_SESSION["USER"] != "")
{
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
if($flag)
{
	echo "<script>window.location='feeds.php';</script>";
}
}?>

<!DOCTYPE html>
<html>
<head>
	<title>WriteYourStory-feeds</title>
	<meta charset="UTF-8">
  <meta name="description" content="share life stories">
  <meta name="keywords" content="HTML,CSS,JavaScript">
  <meta name="author" content="stories and experiences">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="cssfol/css2.css">
  <link rel="stylesheet" type="text/css" href="cssfol/css2-devices.css">
  <link rel="icon" type="png/ico" href="iconfol/icon.png">
 
  <script type="text/javascript" src="jquery.js"></script>
   <script type="text/javascript" src="script1.js"></script>
</head>
<body>
		<header id="header">
		<div><img src="iconfol/icon.png" class="mainico"><span id="title">WriteYourStory</span></div>
			<div id="logform">
				<label class="error" id="errorlog"></label>
			<label class="lab">username or email</label>
			<input type="text" name="user" id="user" required>
			<label class="lab">PASSWORD</label>
			<input type="password" name="psw" id="psw" required>
			<input type="submit" value="Log In" class="btn" onclick="validatelogin()">
		</div>
	</header>
	<div class="maincontainer">
		<fieldset id="box1">
			<legend>register</legend>
			<form action="ajaxfiles/register.php" id="registerform" method="post" onsubmit="return validateform()">
			<label class="lab">NAME</label><label class="error" id="err1"></label>
			<input type="text" name="name" id="name" onfocusout="validateform()">
			<label class="lab">USERNAME</label><label class="error" id="errusr"></label>
			<input type="text" name="uname" id="uname" onfocusout="validateusername(this.value)">
			<label class="lab">D.O.B</label><label class="error" id="err2"></label>
			<input type="date" name="dob" id="dob">
			<label class="lab">Mobile no.</label><label class="error" id="errph"></label>
			<input type="text" name="phno" onfocusout="verifyphno(this.value)" maxlength="10" minlength="10">
			<label class="lab">Email</label><label class="error" id="err3"></label>
			<input type="email" name="mail" onfocusout="sendmail(this.value)">
			<span id="otpfield"><label>OTP</label><label class="error" id="err4"></label>
			<input type="text" name="otpval" id="otpval" onkeyup="validateotp(this.value)" required></span>
			<label class="lab">PASSWORD</label><label class="error" id="errpass"></label>
			<input type="password" name="psw1" id="psw1" placeholder="type password.." onfocusout="passmatch()" minlength="8" required>
			<input type="password" name="psw1" id="psw2" placeholder="re-type password" onfocusout="passmatch()" minlength="8" required>
			<input type="submit" value="Sign Up" class="uploadbtn">
				<div id="alter">
				<button class="btn btn-lg bt"><img src='iconfol/fb.png' class="iconglo">facebook</button>
			</div>
			</form>
		
		</fieldset>
		<div id="box2">
			<div class="frame">
				<div class="slides">
					<span id="imagecounter">1/4</span>
					<div class="arbtn" id="iconglo" onclick="displayimage(false)"></div>
					<div class="arbtn" id="rightbtn" onclick="displayimage(false)"></div><img src="images/image1.jpeg" id="slides"></div>
			</div>
			<div id="displaytext">hey, im a text here!</div>
		</div>
	</div>
	<footer>
		<span onclick="document.documentElement.scrollTop = 0">Backtotop</span>
	</footer>
	</body>
	</html>