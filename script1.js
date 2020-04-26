var phboolval=false;
function changecolor(mno){
	if (mno) {
document.getElementById("postfeed").style.background="#333";
document.getElementById("postfeed").style.color="#fff";	
}
else
{
	document.getElementById("postfeed").style.background="#fff";
document.getElementById("postfeed").style.color="#333";
}
}

var displayusername=true;
function showdrop(v)
 {
 	if (v)
document.getElementById("dropdown").style.display="block";
else
document.getElementById("dropdown").style.display="none";
}
function validateupload()
{
	var k=document.getElementById("postfeed").value;
	if (k=="") 
	{
		document.getElementById("uperror").innerHTML="empty feild";
	}
	else
			{
		xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function()
{
if (this.readyState==1) 
{
	document.getElementById("uperror").innerHTML="<img id='load1' src='iconfol/loading.gif'>";
}
if (this.readyState==4 && this.status==200) 
{
if (this.responseText) 
{
	displayusername=true;
	document.getElementById("uperror").innerHTML="uploaded!";
	window.location="feeds.php";
}
else if (this.responseText==false){
document.getElementById("uperror").innerHTML="unable to upload!";
displayusername=true;
}
}
};
xhttp.open("GET","ajaxfiles/feedupload.php?x="+k+"&y="+displayusername, true);
xhttp.send();
	}

}
var otp=false;
var usr=false;
var pass=false;
function sendmail(val)
{
		document.getElementById("err1").innerHTML="";
		document.getElementById("err2").innerHTML="";
		document.getElementById("err3").innerHTML="";
	if (document.getElementById("name").value=="" && document.getElementById("dob").value=="") 
	{
		document.getElementById("err1").innerHTML="*required";
		document.getElementById("err2").innerHTML="*required";
	}
	else
	{
	val=val.trim();
	var xhttp=new XMLHttpRequest();
xhttp.onreadystatechange=function(){
if (this.readyState==1) 
{
	document.getElementById("err3").innerHTML="<img id='load1' src='iconfol/loading.gif'>";
}
if (this.readyState==4 && this.status==200) 
{
if (this.responseText) 
{
	document.getElementById("err3").innerHTML="mail sent!";
	document.getElementById("otpfield").style.display="block";

}
else
document.getElementById("err3").innerHTML="mail sending failed!";
}
};
xhttp.open("GET","ajaxfiles/sentotp.php?x="+val, true);
xhttp.send();
}
}
function validateform()
{
	var x="";
	patt=/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
	x=document.getElementById("name").value;
	if (patt.test(x)) 
	{
		document.getElementById("err1").innerHTML="Cannot contain specialchar!!";
		test1=false;
	}
	else
		test1=true;
	if(test1 && otp && usr && pass && phboolval)
return true;
else
return false;
}

function validateotp(val)
{
	var xhttp=new XMLHttpRequest();
xhttp.onreadystatechange=function(){
if (this.readyState==1) 
{
	document.getElementById("err4").innerHTML="<img id='load1' src='iconfol/loading.gif'>";
}
if (this.readyState==4 && this.status==200) 
{
if (this.responseText) 
{
	document.getElementById("err4").innerHTML="otp verified!";
	otp=true;

}
else{
document.getElementById("err4").innerHTML="wrong otp!";
otp=false;
}
}
};
xhttp.open("GET","ajaxfiles/verifyotp.php?x="+val, true);
xhttp.send();
}
function validateusername(val)
{
		var xhttp=new XMLHttpRequest();
xhttp.onreadystatechange=function(){
if (this.readyState==1) 
{
	document.getElementById("errusr").innerHTML="<img id='load1' src='iconfol/loading.gif'>";
}
if (this.readyState==4 && this.status==200) 
{
if (this.responseText) 
{
	document.getElementById("errusr").innerHTML="done!!";
	usr=true;
}
else{
document.getElementById("errusr").innerHTML="usernamealrady present!";
usr=false;
}
}
};
xhttp.open("GET","ajaxfiles/username.php?x="+val, true);
xhttp.send();
}
function passmatch()
{
	var p1=document.getElementById("psw1").value;
	var p2=document.getElementById("psw2").value;
	if (p1!=p2) 
	{
		document.getElementById("errpass").innerHTML="pasword do not match!";
		pass=false;
	}
	else{
		document.getElementById("errpass").innerHTML="pasword match!";
		pass=true;
	}
}
function validatelogin()
{
	document.getElementById("errorlog").innerHTML="";
	var x=document.getElementById("user").value;
	var y=document.getElementById("psw").value;
	if (x=="" || y=="") {
		document.getElementById("errorlog").innerHTML="field empty!"
	}
	else
	{
		xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function()
{
if (this.readyState==1) 
{
	document.getElementById("errorlog").innerHTML="<img id='load1' src='iconfol/loading.gif'>";
}
if (this.readyState==4 && this.status==200) 
{
if (this.responseText) 
{
	document.getElementById("errorlog").innerHTML="loged in!";
	window.location="feeds.php";
}
else{
document.getElementById("errorlog").innerHTML="login failed!";
}
}
};
xhttp.open("GET","ajaxfiles/loginauth.php?x="+x+"&y="+y, true);
xhttp.send();
	}

}
var v=true;
function uploadpanel()
{
	if (v) {document.getElementById("dpupload").style.display="block";
v=false;}
	else{
		document.getElementById("dpupload").style.display="none";
		v=true;
	}
}

var user="";
function likeplus(user,v)
{
	var char='';
	var likes="";
	var value="";
	var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200) 
		{
			var z=this.responseText;
			var len=z.length;
			for (var i = 0 ; i <= len ; i++) 
			{
				char=z.charAt(i);
				if (char=='/') 
				{
					value=z.substring(i+1,len);
					break;
				}
				else
				{
					likes=likes+char;
				}
			}


			if (value=="1")
			{
			v.style.background="#4169e1";
			document.getElementById("likes"+user).innerHTML=likes;
		}
		else
		{
			v.style.background="#fff";
			document.getElementById("likes"+user).innerHTML=likes;
		}
}
	};
	xhttp.open("GET","ajaxfiles/like.php?u="+user,true);
	xhttp.send();
}
var userc="";
function likeplusc(userc,v)
{
	var char='';
	var likes="";
	var value="";
	var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function()
	{
		if (this.readyState==4 && this.status==200) 
		{
			var z=this.responseText;
			var len=z.length;
			for (var i = 0 ; i <= len ; i++) 
			{
				char=z.charAt(i);
				if (char=='/') 
				{
					value=z.substring(i+1,len);
					break;
				}
				else
				{
					likes=likes+char;
				}
			}

			if (value=="1")
			{
			v.style.background="#4169e1";
			document.getElementById("likes0").innerHTML=likes;
		}
		else
		{
			v.style.background="#fff";
			document.getElementById("likes0").innerHTML=likes;
		}
}
	};
	xhttp.open("GET","like.php?u="+userc,true);
	xhttp.send();
}
var im="image";
var n=1;
function displayimage(x)
{
	if (!x && n>0 && n<5){
		n++;
		$k="images/"+im+n+".jpeg";

	document.getElementById("slides").src=$k;
	document.getElementById("imagecounter").innerHTML=n+"/4";
}
else
	if (x && n>1)
{
	n--;
	$k="images/"+im+n+".jpeg";
	document.getElementById("slides").src="images/"+im+n+".jpeg";
		document.getElementById("imagecounter").innerHTML=n+"/4";
}
if (n>4 || n<1) 
{
	n=1;
	document.getElementById("slides").src="images/"+im+n+".jpeg";
		document.getElementById("imagecounter").innerHTML=n+"/4";
}
}
function displaysharebtns(val)
{
	if (val) 
	{
		document.getElementsByClassName('sharebox').style.display='block';
	}
}

function displayname(value123)
{
displayusername=value123;
}
function commentpane(value566)
{
	window.location='ajaxfiles/commentdisp.php?x='+value566;
}
function closecomm()
{
		
window.location='../feeds.php';
}
function commentpanel(value566)
{
	//initialize the value of feed on php page.
	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function()
	{
	if (this.readyState==4 && this.status==200) 
	{
		if(this.responseText){
			window.location='ajaxfiles/commentdisp.php';
		}
	}
	};
	xhttp.open("GET","ajaxfiles/COMMENT_00.php?x="+value566,true);
	xhttp.send();
}
function postcomment(feedno)
{
	document.getElementById("errorcom").innerHTML="";
	var comment=document.getElementById("commentupload").value;
	if (comment=="") 
	{
		document.getElementById("errorcom").innerHTML="empty feild!";
	}
	else
	{
		xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function()
		{
			if (this.readyState==3)
				document.getElementById("errorcom").innerHTML="wait...";
			if (this.readyState==4 && this.status==200) 
			{
				if (this.responseText) {
					document.getElementById("errorcom").style.background="#94d207";
					document.getElementById("errorcom").innerHTML="uploaded!";
				}
				else
					document.getElementById("errorcom").innerHTML="Not uploaded!";
			}
		};
		xhttp.open("GET","uploadcomment.php?x="+feedno+"&y="+comment,true);
		xhttp.send();
	}
}
function openpanel(v)
{
	if (v == 1) 
		{
			document.getElementById("posts").style.display="block";	
			document.getElementById("about").style.display="none";	
			document.getElementById("settings").style.display="none";	
			document.getElementById("actlog").style.display="none";
		}
		else
		if (v == 2) 
			{
				document.getElementById("posts").style.display="none";	
			document.getElementById("about").style.display="block";	
			document.getElementById("settings").style.display="none";	
			document.getElementById("actlog").style.display="none";
			}
			else
				if (v == 3) 
				{
document.getElementById("posts").style.display="none";	
			document.getElementById("about").style.display="none";	
			document.getElementById("settings").style.display="block";	
			document.getElementById("actlog").style.display="none";
				}
			else
				if (v == 4) 
				{
						document.getElementById("posts").style.display="none";	
			document.getElementById("about").style.display="none";	
			document.getElementById("settings").style.display="none";	
			document.getElementById("actlog").style.display="block";
				}
					
}
function uploadfile()
{
	document.getElementById("btn202").style.display="none";
	document.getElementById("postimage").style.display="inline-block";
}
function initializeimage()
{
	  var blobFile = $('#postimage').files[0];
    var formData = new FormData();
    formData.append("fileToUpload", blobFile);

    $.ajax({
       url: "upload.php",
       type: "POST",
       data: formData,
       processData: false,
       contentType: false,
       success: function(response) {
           // .. do something
       },
       error: function(jqXHR, textStatus, errorMessage) {
           console.log(errorMessage); // Optional
       }
    })
}
function verifyphno(phno)
{
	console.log(phno);

	xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function()
	{
		if (this.readyState==1) 
{
	document.getElementById("errph").innerHTML="<img id='load1' src='iconfol/loading.gif'>";
}
	if (this.readyState==4 && this.status==200) 
	{
		if(this.responseText){
			phboolval=true;
			document.getElementById("errph").innerHTML="phone verified!!";
		}
		else{
			phboolval=false;	
		
		document.getElementById("errph").innerHTML="wrong phone no";
	}
	}
	};
	xhttp.open("GET","ajaxfiles/verifyphone.php?x="+phno,true);
	xhttp.send();
}

function loginpan(val){
	if(val)
	$("#logform").show();
	else
		$("#logform").hide();
}