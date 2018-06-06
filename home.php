<?php
include 'top.php';

$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page==0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

$sql='SELECT SQL_CALC_FOUND_ROWS
	p.p_id,p.n_id,p.u_id,p.p_from,p.p_text,p.p_pic,p.d_upl,
	g.g_name,g.g_pic,g.g_type,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,
	lg.l_id,
	x.likes,y.comments
	FROM 
	posts p LEFT JOIN grp g ON p.n_id=g.g_id
	LEFT JOIN user_profiles u ON p.u_id=u.u_id 
	LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
				WHERE l_for="post" GROUP BY p_id) x ON p.p_id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="post" 
				GROUP BY p_id ) y ON p.p_id=y.p_id  
	LEFT JOIN ( SELECT l_id,p_id from likes WHERE l_for="post" AND u_id=1 ) AS lg ON p.p_id=lg.p_id 
	WHERE 
	g.g_type="society"   
	GROUP BY p.p_id,lg.l_id  
	ORDER BY d_upl 
	LIMIT '.$start.', '.$limit;
$res=mysqli_query($db,$sql) or die(mysqli_error($db));

echo '<div class="page-ttl">';
echo 'Feeds from societies';
echo '</div>';

if(mysqli_num_rows($res)>0){
while($row=mysqli_fetch_assoc($res)){
	show_posts($row);
}
}else{
	echo '<h1>No posts</h1>';
}
paginate("home.php",0);



include 'footer.php';
?>