<?php session_start(); ?>
<?php
require 'dbconnect.php';
function correctImageOrientation($filename) {
  if (function_exists('exif_read_data')) {
    $exif = exif_read_data($filename);
    if($exif && isset($exif['Orientation'])) {
      $orientation = $exif['Orientation'];
      if($orientation != 1){
        $img = imagecreatefromjpeg($filename);
        if (!$img) {
          $img=imagecreatefromstring(file_get_contents($filename));
        }
        $deg = 0;
        switch ($orientation) {
          case 3:
            $deg = 180;
            break;
          case 6:
            $deg = 270;
            break;
          case 8:
            $deg = 90;
            break;
        }
        if ($deg) {
          $img = imagerotate($img, $deg, 0);        
        }
        // then rewrite the rotated image back to the disk as $filename 
        imagejpeg($img, $filename, 95);
      } // if there is some rotation necessary
    } // if have the exif orientation info
  } // if function exists      
}
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
  $sql="SELECT * FROM profilepic";
if(!mysqli_query($conn,$sql))
  { 
    $sql="CREATE TABLE profilepic(slno int not null AUTO_INCREMENT,username varchar(50) not null,image LONGBLOB,uploadtime TIMESTAMP,primary key(slno))";
mysqli_query($conn,$sql);
}
	$t="profile/";
	$tg=$t.basename($_FILES["dp"]["tmp_name"]);
	if (!file_exists($t)) 
	{
		mkdir($t);
	}
	else {
		$uploadok=1;
if ($_FILES["dp"]["size"]>5000000) //5mb
{
	$uploadok=0;
	echo "<script>alert('FILE SIZE TOO BIG');window.location='../index.php';</script>";
}
if ($uploadok==0) 
{
	echo "file not uploaded";
}
else
if (move_uploaded_file($_FILES["dp"]["tmp_name"],$tg)) 
{
correctImageOrientation($tg);
	$k=$_SESSION["USER"];
	rename($tg,$t.$k.".jpg");
	$newname=$t.$k.".jpg";
	mysqli_real_escape_string($conn,$newname);
  mysqli_real_escape_string($conn,$k);
  $SQL="SELECT username FROM profilepic WHERE username='$k'";
  if($r=mysqli_fetch_row(mysqli_query($conn,$SQL))==null)
	$sql="INSERT INTO profilepic(username,image) VALUES('$k','$newname')";
  else
    $sql="UPDATE profilepic SET image='$newname' WHERE username='$k'";
	mysqli_query($conn,$sql);
	echo "<script>window.location='../feeds.php'</script>";
}
else
echo "<script>alert('unknown errror');window.location='../feeds.php';</script>";
}
}
mysqli_close($conn);
?>