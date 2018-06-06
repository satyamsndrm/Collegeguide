<?php
if(isset($_COOKIE['logged']) AND $_COOKIE['logged']==1){
	$_SESSION['logged']=$_COOKIE['logged'];
	$_SESSION['acc_level']=$_COOKIE['acc_level'];
	$_SESSION['u_id']=$_COOKIE['u_id'];
	$_SESSION['f_name']=$_COOKIE['f_name'];
	$_SESSION['b_id']=$_COOKIE['b_id'];
	$_SESSION['h_id']=$_COOKIE['h_id'];
	$_SESSION['type']=$_COOKIE['type'];
	$_SESSION['stream']=$_COOKIE['stream'];
}
?>