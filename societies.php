<?php
include 'top.php';

$sql='SELECT 
	DISTINCT g.g_id,g.g_name,g.g_pic,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname
	FROM 
	grp g LEFT JOIN ( SELECT s_id,u_id FROM club_members
					WHERE type="admin" ) x ON g.g_id=x.s_id 
	LEFT JOIN user_profiles u ON x.u_id=u.u_id
	WHERE 
	g.g_type="society"
	ORDER BY g.g_name ASC ,g.g_id';
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
echo '<div class="panel-heading list-hd text-center">List Of Societies</div>';
echo '<table class="table table-bordered lists">';
echo '<tr><th>S.No.</th><th>Group Pic</th><th>Group Name</th><th class="hidden-xs">Admin Name</th></tr>';
while($row=mysqli_fetch_assoc($res)){
	echo '<tr><td>'.$i++.'</td><td><img class="list-pics" src="'.$row['g_pic'].'"/></td>';
	echo '<td><a href="society.php?id='.$row['g_id'].'">'.htmlspecialchars($row['g_name']).'</a></td>';
	echo '<td class="hidden-xs"><a href="profile.php?id='.htmlspecialchars($row['u_id']).'">'.$row['fullname'].'</a></td></tr>';
}
echo '</table>';
echo '</div>';
//*/

include 'footer.php';
?>