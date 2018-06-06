<?php
if(!isset($_COOKIE['logged'])){
	if(!(isset($_SESSION['logged']))){
	$f=fopen('files/user_file.txt','r');
	$users=intval(fread($f,filesize('files/user_file.txt')));
	fclose($f);
	echo '<!DOCTYPE html>
			<html>
				<head>
					<title>CoLLeGeGuIde</title>
					<meta charset="UTF-8" />
					<meta name="viewport" content="width=device-width, initial-scale=1">
					<meta name="description" content="CollegeGuide is an online community for the students and allumni of nitj to bring them together on a common platform.">
					<meta name="keywords" content="collegeguide,college,nitj,community">
					<link rel="icon" type="image/jpg" href="images/logo2crop.jpg">
					<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
					<link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">
					<link href="https://fonts.googleapis.com/css?family=Faster One" rel="stylesheet">
					<style type="text/css">
						body{
							background-color:#673ab7;
						}.head_pic{
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
						.err-show{
							background-color:;
							color:red;
							font-size:22px;
							padding-left:4px;
						}
						a,a:hover{
							color:blue;
							text-decoration:none;
						}
					</style>
				</head>
<body>
	<div class="head_pic hidden-xs">
		<div class="pic" style="display:inline;font-family:monoton;font-size:60px;color:#df5f30;text-shadow:2px 1px blue;">CoLLeGe GuIde</div>
		<div class="infotop" style="display:inline;">
			<div class="infotop-heading" style="display:inline;font-family:Faster One;text-shadow:1px 1px blue;">Users Registered:-</div>
			<div class="infotop-ans" style="display:inline;">'.$users.'+</div>
		</div>
	</div>
	<div class="head-mob visible-xs">
		<div class="pic1" style="display:inline;font-family:monoton;width:100%;font-size:35px;color:#df5f30;text-shadow:1px 1px blue;">CoLLeGeGuIde</div>
	</div>
	<div class="row" style="margin-top:3%;">
		<div class="col-sm-offset-2 col-sm-8 col-xs-12">
			<div class="panel panel-danger" >
				<div class="panel-heading err-show">You are not logged in currently.</div>
				<div class="panel-body" style="font-size:20px;"> Inorder to access this page,please login.
					</br><a href="login.php">Click here to <b>Login / register</b>.</a>
					<div class="err-show">You are not authorised to view this page.</div>
				</div>
			</div>
		</div>
	</div>';
		
		

	die();
	}
}
include 'cookies.php';

?>