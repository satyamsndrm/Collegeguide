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
switch($p_from){
	case "grp":
		$col="g.g_name,g.g_type,g.g_pic,";
		$tbl="grp g ON p.n_id=g.g_id";
		break;
		
	case "page":
		$col="pg.pg_name,pg.pg_pic,";
		$tbl="pages pg ON p.n_id=pg.pg_id";
		break;
	
	default :
		die();
		break;
}

show_notices();

$sql='SELECT SQL_CALC_FOUND_ROWS
	p.p_id,p.n_id,p.u_id,p.p_from,p.p_text,p.p_pic,p.d_upl,'.
	$col.'
	CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,
	cm.cm_id,cm.cm_text,cm.cm_date,
	up.u_id AS cmid,up.u_pic AS cmpic,CONCAT_WS(" ",up.f_name,up.l_name) AS cmname,
	x.likes,y.comments,
	lg.l_id 
	FROM 
	posts p LEFT JOIN '.$tbl.' 
	LEFT JOIN user_profiles u ON p.u_id=u.u_id 
	LEFT JOIN (SELECT * FROM comments WHERE cm_for="post" ) cm ON p.p_id=cm.p_id 
	LEFT JOIN user_profiles up ON cm.u_id=up.u_id 
	LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
				WHERE l_for="post" GROUP BY p_id) x ON p.p_id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="post" 
				GROUP BY p_id ) y ON p.p_id=y.p_id  
	LEFT JOIN ( SELECT l_id,p_id from likes WHERE l_for="post" AND u_id='.$_SESSION['u_id'].' ) AS lg ON p.p_id=lg.p_id 
	WHERE 
	p.p_id='.$id.'  
	GROUP BY p.p_id,lg.l_id,cm.cm_id 
	ORDER BY cm.cm_date DESC 
	LIMIT '.$start.', '.$limit;

$res=mysqli_query($db,$sql) or die(mysqli_error($db));
//echo mysqli_num_rows($res);
$row=mysqli_fetch_array($res);
if(mysqli_num_rows($res)==0){
	show_error_msgs('Page Not Exists');
}

show_posts($row,"full_view");

form_for_comments($id,"post",$p_from);

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
paginate("posts.php?id=$id&p_from=$p_from");

echo '</div>';

include 'footer.php';
?>