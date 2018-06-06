<?php
session_start();

include 'auth.inc.php';
include 'db_access.php';
include 'output_fun.php';

$f=fopen('files/user_file.txt','r');
$users=intval(fread($f,filesize('files/user_file.txt')));
fclose($f);

include 'header.php';



?>