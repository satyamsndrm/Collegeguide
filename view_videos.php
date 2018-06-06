<?php
include 'top.php';

$cmntd="";
$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):"";
$id=intval($id);
$p_from=(isset($_GET['from']))?mysqli_real_escape_string($db,$_GET['from']):"";
$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page==0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

show_notices();

$sql='SELECT 
	v.v_id,v.frm,v.n_id,v.u_id,v.v_link,v.v_txt,v.d_upl,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u.u_pic,
	cm.cm_id,cm.cm_text,cm.cm_date,
	up.u_id AS cmid,up.u_pic AS cmpic,CONCAT_WS(" ",up.f_name,up.l_name) AS cmname,
	x.likes,y.comments,
	z.l_id
	FROM 
	videos v LEFT JOIN user_profiles u ON v.u_id=u.u_id 
	LEFT JOIN (SELECT * FROM comments WHERE cm_for="video" ) cm ON v.v_id=cm.p_id
	LEFT JOIN user_profiles up ON cm.u_id=up.u_id 
	LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
					WHERE l_for="video" GROUP BY p_id) x ON v.v_id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="video" 
				GROUP BY p_id ) y ON v.v_id=y.p_id 
	LEFT JOIN (SELECT l_id,p_id FROM likes WHERE l_for="video" AND u_id=1 ) z ON v.v_id=z.p_id 
	WHERE v.v_id='.$id.' 
	GROUP BY v.v_id,cm.cm_id,cm.cm_text,cm.cm_date,z.l_id 
	ORDER BY cm_date DESC';
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
$row=mysqli_fetch_array($res);
//if(mysqli_num_rows($res)>0){
	/*
while($row=mysqli_fetch_assoc($res)){
	print_r($row);
	echo '</br>';
}
*/

video_show($row,"full_view");

form_for_comments($id,"video");

mysqli_data_seek($res,0);
while($row=mysqli_fetch_array($res)){
	if(!empty($row['cm_id'])){
		show_comments($row);
		$cmntd="yes";
	}
}
if(empty($cmntd)){
	echo '<div class="">No Comments to show</div>';
}

paginate("view_videos,php?id=$id");
echo '</div>';


include 'footer.php';

?>