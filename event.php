<?php
include 'top.php';

$cmntd="";

$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):"";
$id=intval($id);
$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page==0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

show_notices();

$sql='SELECT SQL_CALC_FOUND_ROWS 
	e.ev_id,e.ev_name,e.ev_on,e.ev_pic,e.ev_desc,e.d_upl,
	g.g_name,g.g_id,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,
	cm.cm_id,cm.cm_text,cm.cm_date,
	up.u_id AS cmid,up.u_pic AS cmpic,CONCAT_WS(" ",up.f_name,up.l_name) AS cmname,
	lg.l_id,
	x.likes,y.comments
	FROM 
	events e LEFT JOIN ( SELECT g_id,g_name FROM grp
					WHERE g_type="society" ) g ON e.n_id=g.g_id 
	LEFT JOIN user_profiles u ON e.u_id=u.u_id 
	LEFT JOIN (SELECT * FROM comments WHERE cm_for="event" ) cm ON e.ev_id=cm.p_id 
	LEFT JOIN user_profiles up ON cm.u_id=up.u_id 
	LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
				WHERE l_for="event" GROUP BY p_id) x ON e.ev_id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="event" 
				GROUP BY p_id ) y ON e.ev_id=y.p_id 
	LEFT JOIN ( SELECT l_id,p_id from likes WHERE l_for="post" AND u_id=1 ) AS lg ON e.ev_id=lg.p_id 
	WHERE 
	e.ev_id='.$id.' 
	ORDER BY cm.cm_date DESC 
	LIMIT '.$start.', '.$limit;
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
$row=mysqli_fetch_assoc($res);
$i=1;

show_events($row,"full_view");

form_for_comments($id,"event");

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
echo '</div>';
paginate("event.php?id=$id");
include 'footer.php';
?>