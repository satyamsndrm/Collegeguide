<?php
if(isset($_GET['download']) AND !empty($_GET['download'])){
/*
if( headers_sent() )
	die('Headers Sent');
if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');
*/
	
	$pdffile=(isset($_GET['download']))?$_GET['download']:"";
	$fsize = filesize('pdfs/'.$pdffile);
    header("Pragma: public"); 
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); 
	header('Content-type: application/pdf');
	header('Content-Disposition: attachment ; filename="'.$pdffile.'" ');
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$fsize);
	ob_clean();
    flush();
	readfile('pdfs/'.$pdffile);
	echo 'File Downloaded';
}else{
	echo 'Not allowed';
}

?>