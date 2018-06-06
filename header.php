<!DOCTYPE html>
<html>
<head>
	<title>CollegeGuide</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="CollegeGuide is an online community for the students and allumni of nitj to bring them together on a common platform.">
	<meta name="keywords" content="collegeguide,college,nitj,community">
	<link rel="icon" type="image/jpg" href="images/logo2crop.jpg">	
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href='https://fonts.googleapis.com/css?family=Monoton' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Faster One' rel='stylesheet'>

	<style type="text/css">
		.foot-table-head{
			Font-weight:800;
			color:darkblue; 
			width:50px; 
			height:50px;
		}
		.foot-table-info{
			color:darkblue;
			font-weight:700;
		}
		.filter-add{
			border:3px solid steelblue;
			margin-top:3px;
			margin-bottom:3px;
		}
		.filter-heading{
			font-size:20px;
		
		}
		button.btn-primary{
			margin-bottom:3px;
		}
		.media-heading a{
			color:blue;
			font-weight:300;
		}
		.media-heading a:hover{
			color:blue;
			text-decoration:none;
		}
		.media-body > small , .media-body > small >a , .media-body > small >a:hover{
			color:blue;
		}
		#pg-heads{
			background-color:#c0c0ff;
			margin-bottom:10px;
			height:150px;
		}
		#pg-heads{
			padding:23px 0px 17px 0px;
		}
		#mobile-pg-heads{
			padding:2px 0px 2px 7px;
		}
		.grp_links a{
			font-size:18px;
			color:blue;
		}
		.grp_links{
			background-color:;
			margin:5px 0px 10px 0px;
			
		}
		#forms{
			padding:0px 0px 7px 4px;
			margin-top:4px;
			background-color:darkgray;
			border:17px solid #696969;
		}
		#form-mobile{
			padding:0px 0px 7px 4px;
			margin-top:4px;
			background-color:darkgray;
			border:0px;
		}
		.form-heading{
			background-color:;
			height:50px;
			padding-top:8px;
			margin-bottom:3px;
		}
		.form-heading div{
			font-size:26px;
			font-weight:600;
			color:black;
			padding-left:7px;
		}
		.form-title{
			font-size:16px;
			color:black;
		}
		.lists tr td{
			font-size:17px;
			font-weight:700;
		}
		.well{
			padding:19px 5px 19px 5px;
		}
		.foot-panel{
			background-color:inherit;
			border:0px;
		}
		.col-sm-4{
			padding-left:0px;
			height:100%;
		}
		.list-pics{
			width:50px;
			height:50px;
		}
		#info-footer{
			color:darkblue;
			font-size:15px;
		}
		.full-photo{
			max-width:100%;
			max-height:100%;
		}
		.about_user{
			margin-top:10px;
			
		}
		.lnk-div{
			margin-top:7px;
			margin-left:30%;
			
		}
		.lnk-div a{
			font-size:17px;
			font-weight:900;
		}
		.lnk small{
			font-size:15px;
			font-weight:900;
			padding-top:55px;
		}
		.grp-heading{
			font-size:23px;
			font-weight:600;
		}
		.pf-heading{
			font-size:23px;
			font-weight:600;
			text-align:center;
		}
		.pf-table{
			
		}
		.table-bordered{
			border:2px solid green;
			border-top-color:red;
			border-top-style:solid;
		}
		.list-hd{
			font-size:23px;
			font-weight:600;
			color:white;
		}
		body{
			background-color:#e9ebee;
/*			background-image:url(images/bg.jpg);
*/			background-attachment:fixed;
			width:100%;
			height:100%;
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
		.nitjlogo{
			width:8%;
			height:100px;
			margin-left:2%;
		}
		.brandpic{
			height:20px;
			width:20%;
			display:inline;
		}
		#cmbox{
			background-color:#f5f5f5;
			border-top:8px solid green;
			border-left:2px solid green;
			border-right:8px solid green;
			border-bottom:2px solid green;
			padding-top:5px;
			margin-top:20px;
		}
		#cmbox h3{
			margin-top:0px;
		}
		#comments{
			background-color:white;
			border-top:2px solid #aeeaff;
			border-left:2px solid #aeeaff;
			border-right:0px solid steelblue;
			border-bottom:0px solid steelblue;
		}
		.well{
			background-color:white;
			border-top:7px solid steelblue;
			border-left:7px solid steelblue;
			border-right:7px solid steelblue;
		}
		.well p{
			font-size:16px;
		}
		.media h4{
			font-size:20px;
			font-weight:600;
		}
		.navbar{
			margin-bottom:0px;
		}
		.navlisthead{
			background-color:#003264;
		}
		
		.left-bar{
			background-color:#c8d0d7;
		}
		.right-bar{
			background-color:#c8d0d7;
		}
		.left-bar,.right-bar{
			height:100%;
		}
		.navbar li a{
			font-weight:700;
			color:white;
		}
		.media-object{
			width:65px;
			height:65px;
		}
		.small-media-object{
			width:30px;
			height:30px;
		}
		.page-titles{
			font-weight:700;
		}
		.page-titles a{
			color:blue;
		}
		.nav > li > a:hover{
			background-color:;
		}
		.post-img{
			max-width:100%;
			margin-bottom:8px;
			max-height:300px;
		}
		.form_btn{
			margin-top:5px;
		}
		.page-ttl{
			margin:0 0 2px 0;
			max-width:100%;
			height:40px;
			font-size:25px;
			font-weight:600;
			color:black;
			background-color:;
		}
		.main-body{
			margin-top:10px;
		}
		a{
			color:blue;
		}
		.nav-lnks{
		}
		.members-nav{
			margin-bottom:3px;
		}
		.members-nav li a{
			margin:0px 0px 0px 0px;
			padding:7px 3px 7px 3px;
			font-size:15px;
			color:darkblue;
			font-weight:700;
		}
		.sharing-nav{
			margin-bottom:3px;
		}
		.sharing-nav li a{
			font-size:15px;
			color:darkblue;
			font-weight:700;
		}
		#member-heading a{
			color:blue;
		}
		#member-heading{
			margin-bottom:0px;
		}
		.member-small{
			color:green;
		}
		.grp-abt{
			background-color:lightblue;
		}
		.desc-head{
			color:green;
			font-size:25px;
			font-weight:600;
		}
		.grp-content{
			font-size:25px;
		}
		.dropdown-menu{
			background-color:#003264;
		}
		.dropdown-menu > li >a:hover{
			background-color:initial;
		}
		.navbar-default .navbar-brand {
			color:white;
		}
		.navbar-brand {
			font-size:14px;
			line-height:20px;
		}
		.navbar-default .navbar-brand:hover,
		.navbar-default .navbar-brand:focus {
			color:black;
			background-color: white;
		}
		.navbar-default .navbar-nav > li > a {
			color:white;
		}
		.navbar-default .navbar-nav > li > a:hover,
		.navbar-default .navbar-nav > li > a:focus {
			color:black;
			background-color:white;
		}
/*
		.left-navs > li >a{
			padding-top:6px;
			padding-bottom:6px;
		}
*/
		.nav-pills > li > a{
			color:darkblue;
			background-color:;
		}
		.nav-pills > li > a:hover,
		.nav-pills > li > a:focus {
			color:black;
			background-color:white;
		}
		#divResult,#divResult1{
			position:relative;
			width:100%;
			display:none;
			margin-top:-1px;
			border:solid 1px #dedede;
			border-top:0px;
			overflow:hidden;
			border-bottom-right-radius: 6px;
			border-bottom-left-radius: 6px;
			-moz-border-bottom-right-radius: 6px;
			-moz-border-bottom-left-radius: 6px;
			box-shadow: 0px 0px 5px #999;
			border-width: 3px 1px 1px;
			border-style: solid;
			border-color: #333 #DEDEDE #DEDEDE;
			background-color: white;
		}
		.display_box{
			padding:4px; border-top:solid 1px #dedede; 
			font-size:12px; height:50px;
        }
        .display_box:hover{
			background:#3bb998;
			color:#FFFFFF;
			cursor:pointer;
        }
		.affix{
			top:0;
			width:100%;
			z-index: 9999 !important;
		}
		.affix-top{
			top:152px;
			width:100%;
			float:left;
			z-index: 9999 !important;
		}
		.affix-bottom{
			top:152px;
			width:100%;
			float:left;
			z-index: 9999 !important;
		}
		#notification{
			border-top:0px solid #aeeaff;
			border-left:0px solid #aeeaff;
			border-right:0px solid steelblue;
			border-bottom:0px solid steelblue;
			padding-bottom:3px;
		}
		.sno{
			display:inline;
			margin-right:3px;
			color:green;
			font-weight:700;
		}
	</style>
<script>
$(function(){
	
	for(i=2021;i>1987;i--){
		$('.yearselect').append($('<option/>').val(i).html(i));
	}
	

	$('#lk_cm .likepost').on("click",function(){
		var id=this.id;
		
		var split_id=id.split("_");
		var fr=split_id[0];
		var p_id=split_id[1];
		
		var txt=$("#"+id).text();
		var t_split=txt.split(" ");
		var cnt=(t_split[1]=="")?0:t_split[1];
		
		if(t_split[0]=="Likes"){
			var ttl=parseInt(cnt)+1;
			var topost='Liked <span class="badge">' +ttl+'</span>'
		}else{
			var ttl=parseInt(cnt)-1;
			var topost='Likes <span class="badge">' +ttl+'</span>'
		}
		$.ajax({
		  type: "POST",
		  url: "likes.php",
		  data: { l_for: fr , ids:p_id},
		  cache: false,
		  success: function(html){
			$("#"+id).html(topost);
		  }
		});	
	});
	
	$(".search").keyup(function(){
		var inputSearch =$(this).val();
		var id=this.id;
		var dataString ='searchword='+inputSearch;
//		$("#divesult").html(inputSearch).show();
		if(inputSearch!=''){
		  $.ajax({
			type: "POST",
			url: "addremove.php",
			data: dataString,
			cache: false,
			success: function(html){
				if(id=="add_name"){
					$("#divResult").html(html).show();
				}else{
					$("#divResult1").html(html).show();
				}
			}
		  });
		}else{
			$("#divResult").hide();
			$("#divResult1").hide();
		}
	});
	$("#ss").click(function(e){
		alert(e.target.id);
	//	alert(this.id);
	});
	
	$("#divResult").on("click",function(e){ 
		var id=e.target.id;
		var name=$("#"+id+" span").text();
		$("#add_name").val(name);
		$("#add_id").val(id);
		$("#divResult").fadeOut();
	});
	
	$("#divResult1").on("click",function(e){ 
		var id=e.target.id;
		var name=$("#"+id+" span").text();
		$("#rem_name").val(name);
		$("#rem_id").val(id);
		$("#divResult1").fadeOut();
	});
	
});
</script>	
</head>

<body>

<!--	-->
<div data-spy="affix" data-offset-top="10">	
	<div class="head_pic hidden-xs">
		<div class="pic" style="display:inline;font-family:monoton;font-size:60px;color:#df5f30;text-shadow:2px 1px blue;">CoLLeGe GuIde</div>
		<div class="infotop" style="display:inline;">
			<div class="infotop-heading" style="display:inline;font-family:Faster One;color:#003264;text-shadow:2px 1px blue;">Users Registered:-</div>
			<div class="infotop-ans" style="display:inline;"><?php echo $users; ?>+</div>
		</div>
	</div>
	<div class="head-mob visible-xs">
		<div class="pic1" style="display:inline;font-family:monoton;width:100%;font-size:35px;color:#df5f30;text-shadow:1px 1px blue;">CoLLeGeGuIde</div>
		
	</div>

<nav class="navbar navbar-default navlisthead">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bars" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="visible-xs navbar-brand" href="home.php">Home</a>
			<a class="visible-xs navbar-brand" href="profile.php?id=<?php echo $_SESSION['u_id'];?>">Profile</a>
			<a class="visible-xs navbar-brand" href="event_list.php">Events</a>
		</div>
		
		<div class="collapse navbar-collapse" id="bars">
			<ul class="nav navbar-nav">
				<li> <a href="home.php">Home</a> </li>
				<li> <a href="profile.php?id=<?php echo $_SESSION['u_id'];?>">Profile</a></li>
<!--				<li><a href="notifications.php">Notifications</a></li>		-->
				<li> <a href="societies.php">Societies</a> </li>
				<li> <a href="fests.php">Fests</a> </li>
				<li> <a href="event_list.php">Events</a> </li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="#">Confessions <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="pages.php?id=1" style="color:white;">Confessions</a></li>
						<li><a href="pages.php?id=2" style="color:white;">Trolls</a></li>
					</ul>
				</li>
<?php
if(isset($_SESSION['h_id'])){
	echo '<li> <a href="hostel.php">Hostel</a> </li>';
}
if(isset($_SESSION['b_id'])){
	echo '<li> <a href="branch.php">Your Branch</a> </li>';
}
?>
				<li><a href="sharing.php">Books for sale/share</a></li>
				<li><a href="notes.php">Notes & Papers</a></li>
				<li><a href="videos.php">Videos</a></li>
				<li> <a href="logout.php">Logout</a> </li>
			</ul>
		</div>
	</div>
</nav>
</div>
<!--</div>
</div>

<div class="fixed-clearfix" style="position:absolute; top:150px;">
	<div data-spy="affix" data-offset-top="" data-offset-bottom="" style="background-color:#c8d0d7;width:inherit;top:150px;padding-left:0px;">

<div class="container-fluid">				-->
	<div class="row">
		<div class="col-sm-2 hidden-xs left-bar" >
			<div data-spy="affix" style="background-color:#c8d0d7;width:initial;top:132px;"> 
			<ul class="nav nav-pills nav-stacked navbar left-navs">
				<li><a href="home.php">Home</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="notifications.php">Notifications</a></li>
<!--			<li><a href="">Messages</a></li>
-->				<li><a href="pages.php?id=1">Pages</a></li>
				<li><a href="societies.php">Societies</a></li>
				<li><a href="event_list.php">Events</a></li>
				<li><a href="fests.php">Fests</a></li>
<?php
if(isset($_SESSION['h_id'])){
	echo '<li> <a href="hostel.php">Hostel</a> </li>';
}
if(isset($_SESSION['b_id'])){
	echo '<li> <a href="branch.php">Your Branch</a> </li>';
}
?>
				<li><a href="sharing.php">Books for sale/share</a></li>
				<li><a href="notes.php">Notes & Research Papers</a></li>
				<li><a href="videos.php">Videos You May Like</a></li>
			</ul>
		</div>
		</div>
		<div class="col-sm-6 col-xs-12 main-body">
		