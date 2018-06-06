<?php
include 'top.php';

$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):"";
$id=intval($id);
$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page==0)?1:$page;
$limit=15;
$start=($page-1)*$limit;
 
$sql='( SELECT SQL_CALC_FOUND_ROWS 
	g.g_id,g.g_name,g.g_pic,g.g_desc,g.g_type,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,
	p.p_id,p.n_id,p.p_from,p_text,p.p_pic,p.d_upl,
	lg.l_id,
	x.likes,y.comments,z.type 
	FROM 
	grp g LEFT JOIN posts p ON g.g_id=p.n_id
	LEFT JOIN user_profiles u ON p.u_id=u.u_id 
	LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
				WHERE l_for="post" GROUP BY p_id) x ON p.p_id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="post" 
				GROUP BY p_id ) y ON p.p_id=y.p_id   
	LEFT JOIN ( SELECT l_id,p_id from likes WHERE l_for="post" AND u_id=1 ) AS lg ON p.p_id=lg.p_id 
	LEFT JOIN ( SELECT f_id,type FROM fest_organisers WHERE u_id='.$_SESSION['u_id'].' ) AS z ON g.g_id=z.f_id 
	WHERE 
	g_type="fest" AND g.g_id='.$id.' AND p.p_from="grp" 
	GROUP BY p.p_id,lg.l_id,z.type
	ORDER BY d_upl DESC 
	LIMIT '.$start.', '.$limit.' ) 
	UNION
	( SELECT 
	g.g_id,g.g_name,g.g_pic,g.g_desc,g.g_type,
	NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,count(fo.id) as members,z.type 
	FROM 
	grp g LEFT JOIN fest_organisers fo ON g.g_id=fo.f_id 
	LEFT JOIN ( SELECT f_id,type FROM fest_organisers WHERE u_id='.$_SESSION['u_id'].' ) AS z ON g.g_id=z.f_id 
	WHERE g.g_id='.$id.' 
	GROUP BY fo.f_id,z.type )';
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
mysqli_data_seek($res,mysqli_num_rows($res)-1);
$row=mysqli_fetch_assoc($res);
if(empty($row['g_id']) OR $row['g_type']!="fest"){
	echo '<div class="">Page Not Exits.Invalid page</div>';
	die();
}
//displaying branch-head
page_heads($row,"fest");

//display input field
input_form("grp",$id);
echo '<div class="page-ttl">';
echo 'Fest Stories';
echo '</div>';	
//displayin feeds
$pstd="";
mysqli_data_seek($res,0);
while($row=mysqli_fetch_assoc($res)){
	if(!empty($row['p_id'])){
		show_posts($row);
		$pstd="yes";
	}
}
if(empty($pstd)){
	echo '<div class="alert alert-danger">No Posts To Show</div>';
}
paginate("fest.php?id=$id");
include 'footer.php';
?>
