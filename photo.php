<?php
include 'top.php';

$id=(isset($_GET['id']))?trim($_GET['id']):"";
$for=(isset($_GET['for']))?trim($_GET['for']):"";
if(empty($id)){
	die('Invalid photo id');
}if(empty($for)){
	die('Unknown photo');
}
switch($for){
	case "grp":
		$sql='SELECT g_pic FROM grp WHERE g_id='.$id;
		$res=mysqli_query($db,$sql) or die(mysqli_error($db));
		$row=mysqli_fetch_assoc($res);
		$showPic=$row['g_pic'];
		break;
		
	case "page":
		$sql='SELECT pg_pic FROM pages WHERE pg_id='.$id;
		$res=mysqli_query($db,$sql) or die(mysqli_error($db));
		$row=mysqli_fetch_assoc($res);
		$showPic=$row['pg_pic'];
		break;
		
	case "event":
		$sql='SELECT ev_pic FROM events WHERE ev_id='.$id;
		$res=mysqli_query($db,$sql) or die(mysqli_error($db));
		$row=mysqli_fetch_assoc($res);
		$showPic=$row['ev_pic'];
		break;
		
	case "post":
		$sql='SELECT p_pic FROM posts WHERE p_id='.$id;
		$res=mysqli_query($db,$sql) or die(mysqli_error($db));
		$row=mysqli_fetch_assoc($res);
		$showPic=$row['p_pic'];
		break;
		
	case "profile":
		$sql='SELECT u_pic FROM user_profiles WHERE u_id='.$id;
		$res=mysqli_query($db,$sql) or die(mysqli_error($db));
		$row=mysqli_fetch_assoc($res);
		$showPic=$row['u_pic'];
		break;
		
	case "item":
		$sql='SELECT pic FROM sharing WHERE sh_id='.$id;
		$res=mysqli_query($db,$sql) or die(mysqli_error($db));
		$row=mysqli_fetch_assoc($res);
		$showPic=$row['pic'];
		break;
		
	case "notes":
		$sql='SELECT pic FROM notes WHERE id='.$id;
		$res=mysqli_query($db,$sql) or die(mysqli_error($db));
		$row=mysqli_fetch_assoc($res);
		$showPic=$row['pic'];
		break;
		
	default :
		$showPic="";
}
if(!empty($showPic)){
	echo '<img class="img-responsive full-photo" src="'.$showPic.'" alt="photo"/>';
}else{
	echo '<div class="alert alert-danger">No Photo To Show</div>';
}
include 'footer.php';
?>