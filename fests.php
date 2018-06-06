<?php
include 'top.php';

$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page<=0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

$sql='SELECT SQL_CALC_FOUND_ROWS 
	DISTINCT g.g_id,g.g_name,g.g_pic,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname
	FROM 
	grp g LEFT JOIN ( SELECT f_id,u_id FROM fest_organisers
					WHERE type="admin" ) x ON g.g_id=x.f_id 
	LEFT JOIN user_profiles u ON x.u_id=u.u_id
	WHERE 
	g.g_type="fest"
	ORDER BY g_id';
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
$i=1;

/*
while($row=mysqli_fetch_assoc($res)){
	print_r($row);
	echo '</br>';
}
*/

///*
echo '<div class="panel panel-primary">';
echo '<div class="panel-heading list-hd text-center">List Of Fests</div>';
echo '<table class="table table-bordered lists">';
echo '<tr><th>S.No.</th><th>Fest Pic</th><th>Fest Name</th><th class="hidden-xs">Admin Name</th></tr>';
while($row=mysqli_fetch_assoc($res)){
	echo '<tr><td>'.$i++.'</td><td><img class="list-pics" src="'.$row['g_pic'].'"/></td>';
	echo '<td><a href="fest.php?id='.$row['g_id'].'">'.htmlspecialchars($row['g_name']).'</a></td>';
	echo '<td class="hidden-xs"><a href="profile.php?id='.$row['u_id'].'">'.htmlspecialchars($row['fullname']).'</a></td></tr>';
}
echo '</table>';
echo '</div>';
//*/
paginate("fests.php",0);
include 'footer.php';
?>