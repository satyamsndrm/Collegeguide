<?php
include 'auth.inc.php';
include 'db_access.php';

$id=(isset($_POST['ids']))?mysqli_real_escape_string($db,$_POST['ids']):"";
$for=(isset($_POST['l_for']))?mysqli_real_escape_string($db,$_POST['l_for']):"";

$sql='SELECT l_id FROM likes WHERE l_for="'.$for.'" AND p_id='.$id.' AND u_id='.$_SESSION['u_id'];
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
$row=mysqli_fetch_array($res);
if(mysqli_num_rows($res)<1){
	$sql='INSERT INTO likes
		(p_id,l_for,u_id,d_upl)
		VALUES
		('.$id.',"'.$for.'",'.$_SESSION['u_id'].',"'.date('Y-m-d H:i:s').'")';
	mysqli_query($db,$sql) or die(mysqli_error($db));
	$lk="Liked";
}else{
	$sql='DELETE FROM likes WHERE l_for="'.$for.'" AND p_id='.$id.' AND u_id='.$_SESSION['u_id'];
	mysqli_query($db,$sql) or die(mysqli_error($db));
	$lk="Likes";
}


?>
