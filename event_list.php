<?php
include 'top.php';
$write="";
$sql='SELECT SQL_CALC_FOUND_ROWS 
	e.ev_id,e.ev_name,e.ev_on,
	g.g_name,g.g_id
	FROM 
	events e LEFT JOIN ( SELECT g_id,g_name FROM grp
					WHERE g_type="society" ) g ON e.n_id=g.g_id 
	WHERE 
	e.ev_type="society" AND UNIX_TIMESTAMP(e.ev_on) >=(UNIX_TIMESTAMP()-86400) 
	ORDER BY e.ev_on ASC';
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
echo '<div class="panel-heading list-hd text-center">List Of Events</div>';
echo '<table class="table table-bordered lists">';
echo '<tr><th>S.No.</th><th>Event Name</th><th class="hidden-xs">Group Name</th><th>Event On</th></tr>';
while($row=mysqli_fetch_assoc($res)){
	echo '<tr><td>'.$i++.'</td><td><a href="event.php?id='.$row['ev_id'].'">'.htmlspecialchars($row['ev_name']).'</a></td>';
	echo '<td class="hidden-xs"><a href="society.php?id='.$row['g_id'].'">'.htmlspecialchars($row['g_name']).'</a></td>';
	echo '<td>'.dayshow($row['ev_on']).'</td></tr>';
	$write="yes";
}
echo '</table>';
if(empty($write)){
	echo '<div class="alert alert-danger">No Events to show</div>';
}
echo '</div>';
//*/

paginate("event_list.php?",0);
include 'footer.php';
?>