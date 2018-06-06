<?php
require 'db_access.php';
require 'class.mail.php';
session_start();

$mail_sent="";
$email=(isset($_POST['email']))?strtolower(trim($_POST['email'])):"";
$pass=(isset($_POST['pass']))?trim($_POST['pass']):"";

if(isset($_SESSION['logged']) AND $_SESSION['logged']==1){
	header('Location:home.php');
}elseif((isset($_COOKIE['logged']))){
	$var=$_COOKIE['id'].$_COOKIE['f_name'].$_COOKIE['type'].'nitj';
	if(sha1($var)==$_COOKIE['key']){	
		header('Location:home.php');
	}
}
	if(isset($_POST['action']) AND $_POST['action']=='Login'){
		$sql='SELECT 
			u.u_id,u.acc_level,u.f_name,
			ci.stream,ci.b_id,ci.h_id,ci.type
			FROM
			user_profiles u LEFT JOIN clg_info ci ON u.u_id=ci.u_id
			WHERE u.username="'.$email.'" AND u.password="'.$pass.'"';
			$res=mysqli_query($db,$sql) or die(mysqli_error($db));
			$row=mysqli_fetch_array($res);
			if(mysqli_num_rows($res)>0){
				extract($row);
				mysqli_free_result($res);
				$_SESSION['u_id']=$u_id;
				$_SESSION['acc_level']=$acc_level;
				$_SESSION['f_name']=$f_name;
				$_SESSION['stream']=stream;
				if(!empty($b_id)){
					$_SESSION['b_id']=$b_id;
				}
				if(!empty($h_id)){
					$_SESSION['h_id']=$h_id;
				}
				$_SESSION['type']=$type;
				$_SESSION['logged']=1;
				$key=$_SESSION['id'].$_SESSION['f_name'].$_SESSION['type'].'nitj';
				$key=sha1($key);
				setcookie('u_id',$u_id,time()+(60*60*24*30));
				setcookie('acc_level',$acc_level,time()+(60*60*24*30));
				setcookie('f_name',$f_name,time()+(60*60*24*30));
				setcookie('stream',$stream,time()+(60*60*24*30));
				if(!empty($b_id)){
					setcookie('b_id',$b_id,time()+(60*60*24*30));
				}
				if(!empty($h_id)){
					setcookie('h_id',$h_id,time()+(60*60*24*30));
				}
				setcookie('type',$type,time()+(60*60*24*30));
				setcookie('logged',1,time()+(60*60*24*30));
				setcookie('key',$key,time()+(60*60*24*30));
		
/*		$sql='UPDATE user_profiles 
			SET last_acces="'.date("Y-m-d H:i:s").
			'" WHERE pf_id='.$_SESSION['user_id'];
		$res=mysqli_query($db,$sql) or die(mysqli_error($db));
		mysqli_free_result($res);
*/		
		
				header('Location:home.php');
				die('You are currently logged in.');
			}else{
				$_SESSION['u_id']='';
				
				$error='<p>*Invalid email or password.</p>';
			}
	}


	
if(isset($_POST['action']) && $_POST['action']=='Register'){
	$pass=(isset($_POST['pass']))?mysqli_real_escape_string($db,trim($_POST['pass'])):"";
	$email=(isset($_POST['email']))?mysqli_real_escape_string($db,trim($_POST['email'])):"";
	
	$token=md5(time());
	$cod=substr($token,rand(2,6),rand(5,8));
	//check for uniqueness
	$sql='SELECT u_id FROM user_profiles 
	WHERE username="'.$email.'"';
	$res=mysqli_query($db,$sql) or die(mysqli_error($db));
	$row=mysqli_fetch_assoc($res);
	if(mysqli_num_rows($res)>0){
		$error= '<h3 style="bg-color:red;font-weight:800;">Already registered.<h1><p style="font-size:22px;">You are already a member of collegeguide.</p>';
		mysqli_free_result($res);
//		die();
	}else{
		mysqli_free_result($res);
		if(!empty($email) AND !empty($pass)){
			$sql='INSERT INTO acc_cnfm
				(id,token,code,email,pass,rqst_date)
				VALUES
				(NULL,"'.$token.'","'.$cod.'","'.$email.'","'.$pass.'","'.date("Y-m-d H:i:s").'")';
				
			mysqli_query($db,$sql) or die(mysqli_error($db));
			$ids=mysqli_insert_id($db);
			//mail confirmation copy the class main form open source
			
			$msg=new SimpleMail();
			$msg->setToAddress($email);
			$msg->setSubject("Account Confirmation For Collegeguide");
			$hb='<html>
					<div style="font-weight:700;"> 
						Hello User,go through the following link provided to verify your email.
					</div>
					<p><a href="create_profile.php?id='.$ids.'&&token='.$token.'"><b style="color:blue;">Click here to confirm</b></a></p>
					<div style="text-align:center; font-size:25px;font-weight:700; color:darkgreen;">OR</div>
					<p style="font-weight:700;">Copy and paste the below url in your browser:-</p>
					<p style="color:blue; font-size:20px;">
						http://www.collegeguide.co.in/create_profile.php?id='.$ids.'&&token='.$token.'
					</p>
					<div style="text-align:center; font-size:25px;font-weight:700;  color:darkgreen;">OR</div>
					<p style="font-weight:700;">
						Go to <a href="http://www.collegeguide.co.in/create_profile.php">http://www.collegeguide.co.in/create_profile.php</a> And Enter the code given below:- 
					</p>
					<p style="font-size:22px; font-weight:700;">'.$cod.' </p>
				</html>';
			$msg->setHTMLBody($hb);
			if($msg->send()){
				$mail_sent=true;
			}else{
				$error="Failed to mail the confirmation link.Make sure you used a valid email.If the problem persist,feel free to contact admin.we will be happy to help you";
			}
		}else{
			$error="Email And Password Field must be filled.";
		}
	}
}

$f=fopen('files/user_file.txt','r');
$users=intval(fread($f,filesize('files/user_file.txt')));
fclose($f);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>LOGIN PAGE</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="CollegeGuide is an online community for the students and allumni of nitj to bring them together on a common platform.">
		<meta name="keywords" content="collegeguide,college,nitj,community">
		<link rel="icon" type="image/jpg" href="images/logo2crop.jpg">	
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link href='https://fonts.googleapis.com/css?family=Monoton' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Faster One' rel='stylesheet'>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
		<style type="text/css">
			.r-desc{
				margin-top:9px;
				font-size:18px;
			}
			.email_lnk{
				color:#46287d;
				text-decoration:underline;
			}
			.email_lnk:hover{
				color:darkgreen;
			}
				#ttle{
				font-size:20px;
				color:blue;
				font-weight:800;
			}
			body{
				background-color:#e9ebee;
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
			#info li{
				color:blue;
				font-size:18px;
			}
			label b {
				color:black;
			}
			.err-show{
				background-color:red;
				color:white;
				font-size:22px;
			}
			.navhead{
				font-size:20px;
				font-weight:700;
				color:black;
			}
			a.navhead:hover{
				background-color:white;
			}
			.nav > li > a:hover,
			.nav > li > a:focus {
				text-decoration: none;
				background-color:white;
			}
			.carousel1{
				margin-top:4px;
				margin-bottom:4px;
			}
			.carousel2{
				margin-top:22px;
				margin-bottom:4px;
			}
			.carousel2-title{
				color:black;
				background-color:steelblue;
				font-size:45px;
				font-weight:700;
				text-align:center
			}
			.carousel-caption{
				color:darkgreen;
				font-size:20px;
			}
			.carousel-caption>h3{
				font-size:28px;
			}
		</style>
	</head>
	<body>

		<div class="head_pic hidden-xs">
			<div class="pic" style="display:inline;font-family:monoton;font-size:60px;color:#df5f30;text-shadow:2px 1px blue;">CoLLeGe GuIde</div>
			<div class="infotop" style="display:inline;">
				<div class="infotop-heading" style="display:inline;font-family:Faster One;text-shadow:1px 1px blue;">Users Registered:-</div>
				<div class="infotop-ans" style="display:inline;"><?php echo $users; ?>+</div>
			</div>
		</div>
		<div class="head-mob visible-xs">
			<div class="pic1" style="display:inline;font-family:monoton;width:100%;font-size:35px;color:#df5f30;text-shadow:1px 1px blue;">CoLLeGeGuIde</div>
			
		</div>
	
	<div class="container-fluid" style="align:center;">
	<?php
	if(isset($error)){
		echo '<div class="err-show">'.$error.'</div>';
	}
	
	if(empty($mail_sent)){
		
	?>
	<div class="row">
	<div class="col-sm-4 col-xs-12">
		<div role="tabpanel" style="margin-left:3px;">
			<ul class="nav nav-tabs members-nav" role="tablist">
				<li role="presentation" class="active"><a class="navhead" href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
				<li role="presentation"><a href="#reg" class="navhead" aria-controls="reg" role="tab" data-toggle="tab">Register </a></li>
			</ul>
	
			<div class="tab-content">
				<div role="tabpanel" id="login" class="tab-pane fade in active">
					<div class="well">
						<div id="ttle">Login Here</div>
						<form method="post" action="">
							<div class="form-group">
								<label for="email"><b>Email_id</b></label>
								<input type="text" class="form-control" id="email" name="email" value=""/>
							</div>
							<div class="form-group">
								<label for="pass"><b>Password</b></label>
								<input type="password" class="form-control" id="pass" name="pass" value=""/>
							</div>
							<div class="input-group">
								<input type="submit" class="btn btn-primary" name="action" value="Login"/>
							</div>
						</form>
						<div class="r-desc">
							<p>Not a member yet?<a href="#reg" aria-controls="reg" role="tab" data-toggle="tab"> Register here</a></p>
<!--							<p>Forgot password?<a href="forgot_password.php"> Click here</a></p>
-->						</div>
					</div>
				</div>
				<div role="tabpanel" id="reg" class="tab-pane fade in">
					<div class="well reg-box">
						<div id="ttle">Register Here</div>
							<form method="post" action="">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="text" class="form-control" id="email" name="email" value="<?php echo $email;?>"/>
								</div>
								<div class="form-group">
									<label for="pass">Password</label>
									<input type="text" class="form-control" id="pass" name="pass"
									value="<?php echo $pass;?>"/>
								</div>
									<input type="submit" class="btn btn-primary" name="action" value="Register"/>
							</form>
							<div class="r-desc">
								<p>Already a member?<a href="#login" aria-controls="login" role="tab" data-toggle="tab"> Log in here</a></p>
<!--							<p>Forgot password?<a href="forgot_password.php"> Click here</a></p>
-->						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

		<div id="bg" class="col-sm-8 hidden-xs " >
			<h2><b style="color:#46287d;">Welcome to CollegeGuide</b></h2>
			<p style="font-size:20px; font-weight:700; color:black;">CollegeGuide is an online community for the students and allumni of nitj designed to bring them closer together on a common platform. </p>
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

<?php
	}else{
		// div closed for container-fluid
		echo '</div>
			<div class="row">
				<div class="col-sm-offset-3 col-sm-6 col-xs-12">
					<div class="panel panel-primary" style="border:2px solid darkblue;">
					<div class="panel panel-heading" style="background-color:#46287d;text-align:center;border:1px solid #46287d;"><b>Registeration Successful.</b></div>
					<ul id="info" style="list-style-type:none; padding-left:0px;">
						<li><b>--> A confirmation link has been sent to your email('.$email.').</b></li>
						<li><b>--> You can either <a class="email_lnk" href="create_profile.php" >Click Here </a> and submit the code sent to your email.</b></li>
						<li style="padding-left:45%; color:green; font-size:24px;"><b>OR</b></li>
						<li><b>--> You can visit the URL link sent to your email to confirm your email. </b></li>
					</ul>
			</div>
			</div>';
	}
?>
	</div>
	<div class="container-fluid">
<div class="carousel1">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
			<li data-target="#myCarousel" data-slide-to="4"></li>
			<li data-target="#myCarousel" data-slide-to="5"></li>
			<li data-target="#myCarousel" data-slide-to="6"></li>
			<li data-target="#myCarousel" data-slide-to="7"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="images/logo2.jpg"  style="max-height:800px; width:100%;" alt="Los Angeles">
				<div class="carousel-caption">
					<h3>CollegeGuide</h3>
					<p>Connecting is fun</p>
				</div>
			</div>
			<div class="item">
			  <img src="images/group/cricket.jpg" style="max-height:700px; width:100%;" alt="New York">
				<div class="carousel-caption">
					<h3>Cricket Club.</h3>
					<p></p>
				</div>
			</div>
			<div class="item">
			  <img src="images/group/volleyball.jpg" style="max-height:800px; width:100%;" alt="Chicago">
				<div class="carousel-caption">
					<h3>Team Volleyball</h3>
					<p></p>
				</div>
			</div>
			<div class="item">
			  <img src="images/group/avishkar.jpg" style="max-height:700px; width:100%;" alt="New York">
				<div class="carousel-caption">
					<h3>Team Avishkar</h3>
					<p></p>
				</div>
			</div>

			<div class="item">
			  <img src="images/group/bawre.jpg" style="max-height:800px; width:100%;" alt="New York">
				<div class="carousel-caption">
					<h3>Team Bawre</h3>
					<p></p>
				</div>
			</div>
			
			<div class="item">
			  <img src="images/group/nitj_athletics.jpg" style="max-height:800px; width:100%;" alt="New York">
				<div class="carousel-caption">
					<h3>Team Athletics</h3>
					<p>Athletes Of Nitj.</p>
				</div>
			</div>
			<div class="item">
			  <img src="images/group/basketball.jpg" style="max-height:700px; width:100%;" alt="New York">
				<div class="carousel-caption">
					<h3>Team Basketball</h3>
					<p></p>
				</div>
			</div>
			<div class="item">
			  <img src="images/group/movie.jpg" style="max-height:700px; width:100%;" alt="New York">
				<div class="carousel-caption">
					<h3>Movie Club</h3>
					<p></p>
				</div>
			</div>
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>		
</div>		
</div>		

	

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>