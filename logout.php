<?php
session_start();
setcookie('u_id','',time()+(60*60*24*30));
setcookie('key','',time()+(60*60*24*30));
setcookie('acc_level','',time()+(60*60*24*30));
setcookie('f_name','',time()+(60*60*24*30));
setcookie('stream','',time()+(60*60*24*30));
setcookie('b_id','',time()+(60*60*24*30));
setcookie('h_id','',time()+(60*60*24*30));
setcookie('type','',time()+(60*60*24*30));
setcookie('logged','',time()+(60*60*24*30));
session_unset();
session_destroy();
header('Location:login.php');
die();
?>