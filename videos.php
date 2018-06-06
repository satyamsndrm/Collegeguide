<?php
include 'top.php';

$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$limit=15;
$start=($page-1)*$limit;

form_for_video();

$sql='SELECT 
	v.v_id,v.frm,v.n_id,v.u_id,v.v_link,v.v_txt,v.d_upl,
	x.likes,y.comments,
	z.l_id,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u.u_pic
	FROM 
	videos v LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
					WHERE l_for="video" GROUP BY p_id) x ON v.v_id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="video" 
				GROUP BY p_id ) y ON v.v_id=y.p_id 
	LEFT JOIN (SELECT l_id,p_id FROM likes WHERE l_for="video" AND u_id=1 ) z ON v.v_id=z.p_id 
	LEFT JOIN user_profiles u ON v.u_id=u.u_id 
	GROUP BY v.v_id,x.p_id,z.l_id 
	ORDER BY v.d_upl DESC';
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
//$row=mysqli_fetch_array($res);
//if(mysqli_num_rows($res)>0){
	/*
while($row=mysqli_fetch_assoc($res)){
	print_r($row);
	echo '</br>';
}
*/

while($row=mysqli_fetch_assoc($res)){
	video_show($row);
}
paginate("videos.php",0);
include 'footer.php';
?>