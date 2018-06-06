<?php

function upl_img($for){
	global $db;
	if($image=imagecreatefromjpeg($_FILES['file']['tmp_name'])){
		$dir='images/'.$for;
		$s=substr(md5(time()),rand(5,25),6);
		$imgurl=$dir.$s.basename($_FILES['file']['name']);
		
		$fsize=$_FILES['file']['size'];
		
		if($fsize<512*1024){
			$val=90;
		}elseif($fsize>512*1024 AND $fsize<1024*1024){
			$val=60;
		}elseif($fsize>1024*1024 AND $fsize<2*1024*1024){
			$val=25;
		}elseif($fsize>2*1024*1024 AND $fsize<2*1024*1024){
			$val=10;
		}
		
		if(imagejpeg($image,$imgurl,$val)){
			return $imgurl;
		}else{
			return "";
		}
	}else{
		$_SESSION['pic_error']='<b> Please upload image with jpeg format.</b>';
		return "";
	}
}

function upl_file(){
	global $db;
	
	$dir='pdfs/';
	$s=substr(md5(time()),rand(5,25),6);
	$rturl=$s.basename($_FILES['pdffile']['name']);
	$furl=$rturl;
	if($_FILES['pdffile']['size']<1024*1024*50){
		if(move_uploaded_file($_FILES['pdffile']['tmp_name'],$dir.$furl)){
			return $furl;
		}else{
			echo '<div class="err_msg">File Too Big To Upload</div>';
			die();
		}
	}else{
		echo '<div class="err_msg">File Too Big To Upload</div>';
		die();
	}
}	


?>	