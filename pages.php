<?php
include 'top.php';
$id=1;
$preview=0;

$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):"";
$id=intval($id);
$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page==0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

$sql='( SELECT SQL_CALC_FOUND_ROWS 
	pg.pg_id,pg.pg_name,pg.pg_pic,pg.pg_desc,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,
	p.p_id,p.n_id,p.p_from,p_text,p.p_pic,p.d_upl,
	lg.l_id,
	x.likes,y.comments
	FROM 
	pages pg LEFT JOIN posts p ON pg.pg_id=p.n_id
	LEFT JOIN user_profiles u ON p.u_id=u.u_id 
	LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
				WHERE l_for="post" GROUP BY p_id) x ON p.p_id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="post" 
				GROUP BY p_id ) y ON p.p_id=y.p_id  
	LEFT JOIN ( SELECT l_id,p_id from likes WHERE l_for="post" AND u_id=1 ) AS lg ON p.p_id=lg.p_id 
	WHERE 
	p_from="page" AND p.n_id='.$id.' AND p.p_from="page"  
	GROUP BY p.p_id,lg.l_id
	ORDER BY d_upl DESC 
	LIMIT '.$start.', '.$limit.' )
	UNION
	( SELECT 
	pg.pg_id,pg.pg_name,pg.pg_pic,pg.pg_desc,
	NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL
	FROM 
	pages pg 
	WHERE pg.pg_id='.$id.' )';
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
mysqli_data_seek($res,mysqli_num_rows($res)-1);
$row=mysqli_fetch_assoc($res);
if(empty($row['pg_id'])){
	echo '<div class="">Page Not Exits.Invalid page</div>';
	die();
}
//displaying branch-head
page_heads($row,"page");

//display input field
input_form("page",1);
echo '<div class="page-ttl">';
echo 'Page Stories';
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
paginate("pages.php?id=$id");

include 'footer.php';
?>
