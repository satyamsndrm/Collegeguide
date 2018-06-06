<?php
include 'top.php';

$cmntd="";
$share="";
$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):"";
$id=intval($id);
$p_from=(isset($_GET['from']))?mysqli_real_escape_string($db,$_GET['from']):"";
$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page==0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

show_notices();

$sql='SELECT SQL_CALC_FOUND_ROWS 
	s.sh_id,s.u_id,s.fr,s.item_type,s.name,s.s_desc,s.pic,s.d_upl,s.d_mod,
	CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u.u_pic,
	cm.cm_id,cm.cm_text,cm.cm_date,
	up.u_id AS cmid,up.u_pic AS cmpic,CONCAT_WS(" ",up.f_name,up.l_name) AS cmname,
	x.likes,y.comments,
	lg.l_id
	FROM
	sharing s LEFT JOIN user_profiles u ON s.u_id=u.u_id
	LEFT JOIN (SELECT * FROM comments WHERE cm_for="item" ) cm ON s.sh_id=cm.p_id 
	LEFT JOIN user_profiles up ON cm.u_id=up.u_id   
	LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
				WHERE l_for="item" GROUP BY p_id) x ON s.sh_id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="item" 
				GROUP BY p_id ) y ON s.sh_id=y.p_id
	LEFT JOIN ( SELECT l_id,p_id from likes WHERE l_for="item" AND u_id=1 ) AS lg ON s.sh_id=lg.p_id  
	WHERE sh_id='.$id.' 
	ORDER BY cm.cm_date DESC 
	LIMIT '.$start.', '.$limit;
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
$row=mysqli_fetch_array($res);
//echo mysqli_num_rows($res);
//if(mysqli_num_rows($res)>0){
/*
while($row=mysqli_fetch_assoc($res)){
	print_r($row);
	echo '</br>';
}
*/
show_item($row,"full_view");

form_for_comments($id,"item");

mysqli_data_seek($res,0);
while($row=mysqli_fetch_array($res)){
	if(!empty($row['cm_id'])){
		show_comments($row);
		$cmntd="yes";
	}
}
if(empty($cmntd)){
	echo '<div class="alert alert-danger">No Comments to show</div>';
}
//paginate("posts.php?id=$id&&p_from=$p_from");

echo '</div>';

paginate("item.php?id=$id");
include 'footer.php';

?>	