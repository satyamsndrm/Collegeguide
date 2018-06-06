<?php
//include files here
require 'db_access.php';

$id=(isset($_GET['id']))?trim($_GET['id']):"";
$token=(isset($_GET['token']))?trim($_GET['token']):"";
$type=(isset($_GET['type']))?trim($_GET['type']):"";
$email="";
$pass="";
$error="";

if(empty($token) OR empty($id)){
	$form='<div class="well" style="background-color:#673ab7; border:0px;">
				<h3 class="det text-center"><b>Verification Code</b></h3>
				<ul id="info" style="list-style-type:none; padding-left:0px;">
					<li><b>--> Enter the code below sent to your email address for verification purpose. </b></li>
					<li><b>--> You can also verify via link sent to your email address.</b></li>
					<li><b>--> After verification you can create your profile on CollegeGuide.</b></li>
				</ul>
				<form method="post" action="?">
				<div class="form-group">
					<label class="frm-font det" for="code">Enter the code*</label>
					<input type="text" class="form-control" id="code" name="code" value="" placeholder="xxxx"/>
				</div>
					<input type="submit" class="btn btn-primary" name="action" value="Submit Code"/>
			   </form>
		   </div>';
}else{
	$sql="SELECT email,pass 
		FROM 
		acc_cnfm 
		WHERE 
		token='$token' AND id=$id";
	$res=mysqli_query($db,$sql) or die(mysqli_error($db));
	if(mysqli_num_rows($res)==0){
		echo 'Unauthorized access';
		die();
	}else{
		$row=mysqli_fetch_assoc($res);
		$email=$row['email'];
		$pass=$row['pass'];
	}
}

if(isset($_POST['action'])&&$_POST['action']=='Submit Code'){
	$code=(isset($_POST['code']))?trim($_POST['code']):"";
	$sql="SELECT email,pass 
		FROM
		acc_cnfm 
		WHERE 
		code='$code'";
	$res=mysqli_query($db,$sql) or die(mysqli_error($db));
	if(mysqli_num_rows($res)==0){
		echo 'Unauthorized access';
		die();
	}else{
		$row=mysqli_fetch_assoc($res);
		$email=$row['email'];
		$pass=$row['pass'];
		$form="";
	}
}

	
if(isset($_POST['action'])&&$_POST['action']=='Register'){
	
	//for users
	$email=(isset($_POST['email']))?mysqli_real_escape_string($db,strtolower(trim($_POST['email']))):"";
	$pass=(isset($_POST['pass']))?mysqli_real_escape_string($db,trim($_POST['pass'])):"";
	
	//for users profiles
	$f_name=(isset($_POST['f_name']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['f_name']))):"";
	$l_name=(isset($_POST['l_name']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['l_name']))):"";
	$gen=(isset($_POST['gen']))?mysqli_real_escape_string($db,trim($_POST['gen'])):"";
	
	//for clg_info
	$status=(isset($_POST['status']))?mysqli_real_escape_string($db,trim($_POST['status'])):"";
	$stream=(isset($_POST['stream']))?mysqli_real_escape_string($db,trim($_POST['stream'])):"";
	$b_id=(isset($_POST['branch']))?mysqli_real_escape_string($db,trim($_POST['branch'])):"";
	$h_id=(isset($_POST['hostel']))?mysqli_real_escape_string($db,trim($_POST['hostel'])):"";
	$y_joined=(isset($_POST['y_joined']))?mysqli_real_escape_string($db,trim($_POST['y_joined'])):"";
	$y_left=(isset($_POST['y_left']))?mysqli_real_escape_string($db,trim($_POST['y_left'])):"";
	
	
//	echo $f_name.$l_name.$gen.$status.$stream.$b_id.$h_id.$y_joined;
	
	$_pic=($gen=="M")?"images/muser.jpg":"images/fuser.png";
	$a_lev=1;
	$b_id=($stream=="B.tech")?$b_id:"";
	$h_id=($status=="Student")?$h_id:"";
	
	if(empty($f_name) or empty($l_name) or empty($gen) or empty($stream) or empty($status) or (empty($y_joined))){
		$error="All fields marked with * are must";
	}else{
		
		//inserting in user_profiles
		if(!empty($f_name)&&!empty($l_name)&&!empty($gen)&&!empty($idd)){
			$sql='INSERT INTO user_profiles
				(u_id,,username,password,acc_level,f_name,l_name,u_pic,sex)
				VALUES
				(NULL,"'.$email.'","'.sha1($pass).'",'.$a_lev.',"'.$f_name.'","'.$l_name.'","'.$u_pic.'","'.$gen.'")';
			mysqli_query($db,$sql) or die(mysqli_error($db));
		}
			$idd=mysqli_insert_id($db);
		
		//inserting in clg_info
		if(!empty($b_id)&&!empty($y_joined)){
			$sql='INSERT INTO clg_info
				(id,u_id,type,stream,h_id,b_id,clg_joined,clg_left)
				VALUES
				(NULL,'.$idd.',"'.$status.'","'.$stream.'",'.
				$h_id.','.$b_id.',"'.$y_joined.'","'.$y_left.'")';
			mysqli_query($db,$sql) or die(mysqli_error($db));
		}
		header('Location:login.php');
		$f=fopen('files/user_file.txt','r');
		$cnt=intval(fread($f,filesize('files/user_file.txt')));
		fclose($f);
	
		$fw=fopen('files/user_file.txt','w');
		$cnt++;
		fwrite($fw,$cnt);
		fclose($fw);
	}

}

$f=fopen('files/user_file.txt','r');
$users=intval(fread($f,filesize('files/user_file.txt')));
fclose($f);

			$form="";
?>
<!DOCTYPE html>
<html>
<head>
<title>CREATE YOUR PROFILE</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="CollegeGuide is an online community for the students and allumni of nitj to bring them together on a common platform.">
<meta name="keywords" content="collegeguide,college,nitj,community">
<link rel="icon" type="image/jpg" href="images/logo2crop.jpg">	
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link href='https://fonts.googleapis.com/css?family=Monoton' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Faster One' rel='stylesheet'>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<style>
	.det{
		color:white;
	}
	#reg-form{
		background-color:#;
	}
	body{
		background-color:#673ab7;
	}
	.frm-font{
		font-size:18px;
	}
	.frm-pad{
		padding-top:8px;
		padding-bottom:8px;
	}
	.head_pic{
		height:80px;
		background-color:white;
	}
	.pic{
		margin-left:2%;
		margin-right:5%;
		margin-top:15px;
		height:70px;
		width:45%;
	}
	.infotop{
		width:45%;						
		margin-top:15px;
	}
	.infotop-heading{
		font-size:45px;
		font-weight:700;
		color:#df5f30;
	}
	.infotop-ans{
		font-size:50px;
		font-weight:700;
		margin-left:8px;
		color:green;
	}
	.head-mob{
		height:55px;
		background-color:white;
	}
	.pic1{
		width:100%;
		height:70px;
	}
	.affix{
		top:0;
		width:100%;
		z-index: 9999 !important;
	}
	ul>li>b{
		color:lightgreen;
	}
	.err-show{
		background-color:red;
		color:white;
		font-size:22px;
	}
</style>
<script>
$(function(){
	for(i=2021;i>1987;i--){
		$('.yearselect').append($('<option/>').val(i).html(i));
	}
	
});
</script>
</head>
<body>


<div data-spy="affix" data-offset-top="10">	
<div class="head_pic hidden-xs" style="background-color:#cccccc; padding:0; margin:0;">
		<div class="pic" style="display:inline;font-family:monoton;font-size:60px;color:#df5f30;text-shadow:2px 1px blue;">CoLLeGe GuIde</div>
		<div class="infotop" style="display:inline;">
			<div class="infotop-heading" style="display:inline;font-family:Faster One;color:#003264;text-shadow:2px 1px blue;">Users Registered:-</div>
			<div class="infotop-ans" style="display:inline;"><?php echo $users; ?>+</div>
		</div>
	</div>
	<div class="head-mob visible-xs" style="background-color:#cccccc;">
		<div class="pic1" style="display:inline;font-family:monoton;width:100%;font-size:35px;color:#df5f30;text-shadow:1px 1px blue;">CoLLeGeGuIde</div>
		
	</div>
</div>

<div class="">

<div class="row">

<div class="col-sm-7 col-xs-12" id="reg-form" style="background-color:#673ab7;">
<?php

if(!empty($error)){
	echo "<div class='err-show'>$error</div>";
}

if(empty($form)){
	
?>
<div class="well" style="background-color:#673ab7; border:0px;">
	<h3 class="det text-center"><b>Registration Form</b></h3>
	<form method="post" action="">
		<div class="form-group">
			<label class="frm-font det" for="f_nm">First name*</label>
			<input type="text" class="form-control" id="f_nm" name="f_name" value=""/>
		</div>
		<div class="form-group">
			<label class="frm-font det" for="l_nm">Last name*</label>
			<input type="text" class="form-control" id="l_nm" name="l_name" value=""/>
		</div>
		
		<div class="frm-pad" >
			<b class="det frm-font" style="padding-right:10px;">Gender*</b>
			<label class="radio-inline det"><input type="radio" name="gen" value="M">Male</label>
			<label class="radio-inline det"><input type="radio" name="gen" value="F">Female</label>
		</div>
		
		<div class="frm-font frm-pad">
			<b class="det" style="padding-right:10px;">Status*</b>
			<label class="radio-inline det"><input type="radio" name="status" value="Student">Student</label>
			<label class="radio-inline det"><input type="radio" name="status" value="Allumni">Allumni</label>
			<label class="radio-inline det"><input type="radio" name="status" value="Faculty">Faculty</label>
		</div>
		
		<div class="det frm-font frm-pad"><b>Select Your Stream*</b></div>
		<select class="form-control" id="stream" name="stream">
			<option value="">Select Your Stream</option>
			<option value="B.tech">B.tech</option>
			<option value="M.tech">M.tech</option>
			<option value="MSC">Msc</option>
			<option value="MBA">MBA</option>
			<option value="PHD">Phd</option>
		</select>
		
		<div class="det frm-font frm-pad"><b>Select Your Branch</b></div>
		<b>(Only for B.techians)</b>
		<?php
			$sql='SELECT * from grp WHERE g_type="branch" ORDER BY g_id';
				$res=mysqli_query($db,$sql) or die(mysqli_error($db));
				echo '<select class="form-control" name="branch">';
				echo '<option value="">Select Your Branch</option>';
				while($row=mysqli_fetch_array($res)){
					extract($row);
					echo '<option value="'.$g_id.'">'.$g_name.'</option>';
				}
				echo '</select>';
				mysqli_free_result($res);
		?>
		<div class="det frm-font frm-pad"><b>Select Your Hostel</b></div>
		<b>(Only for B.techians)</b>
		<?php
			$sql='SELECT * from grp WHERE g_type="hostel" ORDER BY g_id';
				$res=mysqli_query($db,$sql) or die(mysqli_error($db));
				echo '<select class="form-control" name="hostel">';
				echo '<option value="">Select Your Hostel</option>';
				while($row=mysqli_fetch_array($res)){
					extract($row);
					echo '<option value="'.$g_id.'">'.$g_name.'</option>';
				}
				echo '</select>';
				mysqli_free_result($res);
		?>
		<div class="form-group">
			<label class="det frm-font">Year Joined*</label>
			<select class="form-control yearselect" name="y_joined">
			<option value="">Select Your Joining Year</option>
			</select>
		</div>
		<div class="form-group">
			<label class="det frm-font">Year Left(optional)</label>
			<select class="form-control yearselect" name="y_left">
			<option value="">Select Year</option>
			</select>
		</div>
		
		<input type="hidden" name="email" value="
			<?php echo $email?>"/>
		<input type="hidden" name="pass" value="
			<?php echo $pass?>"/>
		<input type="submit" class="btn btn-lg btn-primary" name="action" value="Register"/>
	</form>
</div>
	<div style="margin-top:15px;"></div>
<?php

}elseif(!empty($form)){
	echo $form;
}

?>
</div>

	<div class="col-sm-5 hidden-xs" style="background-color:; border:0px;">
		<div class="panel panel-primary foot-panel hidden-xs" style="background-color:inherit;width:initial;border:2px solid #46287d;">
			<div class="panel panel-heading foot-hding" style="background-color:#46287d; border:1px solid #46287d;"><b>Important Guidelines For Users</b></div>
			<ul id="info" style="list-style-type:none; padding-left:0px;">
				<li><b>--> If You are <small style="font-size:18px;color:red;"> Allumni </small> there is no need to fill hostel column.</b></li>
				<li><b>--> If You are <small style="font-size:18px;color:red;"> Faculty </small> there is no need to fill hostel and branch column.</b></li>
			</ul>
			<h2><b style="color:WHITE;">Welcome to CollegeGuide</b></h2>
			<p style="font-size:20px; font-weight:700; color:black;">CollegeGuide is an online community for the students and allumni of nitj to bring them closer together on a common platform. </p>
			<ul id="info" style="list-style-type:none; padding-left:0px;">
				<li><b>--> The site is designed to increase the social connectivity among students of the college</b></li>
				<li><b>--> The site will be helpful to decrease the gap between societies and the students.</b></li>
				<li><b>--> You can interact easily with your allumni.</b></li>
				<li><b>--> You can directly communicate with any society of our college registered on collegeguide.</b></li>
				<li><b>--> You can check out the very details about the societies of our college , can check out THe present and past members of that society.</b></li>
				<li><b>--> You can check out details about present students anD allumni.</b></li>
				<li><b>--> For fun part we have added confession and troll page where any one can post anonymously i.e, your identity will not be revealed.</b></li>
			</ul>
		</div>
	</div>
</div>

</div>
</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>	
		
		
		
		