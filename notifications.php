<?php
include 'top.php';

$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page<=0)?1:$page;
$limit=20;
$start=($page-1)*$limit;

/*
$sql='SELECT 
	DISTINCT p.p_id,DISTINCT e.ev_id,DISTINCT v.v_id,DISTINCT s.sh_id,DISTINCT n.n_id,c.cm_for,c.d_upl  
	FROM comments c LEFT JOIN posts p ON c.p_id=p.p_id 
	LEFT JOIN events e ON c.p_id=e.ev_id 
	LEFT JOIN videos v ON c.p_id=v.v_id 
	LEFT JOIN sharing s ON c.p_id=s.sh_id 
	LEFT JOIN notes n ON c.p_id=n.n_id 
	WHERE 
	p.p_id IN ( SELECT p_id FROM posts WHERE u_id='.$_SESSION['u_id'].' ) 
	OR 
	e.ev_id IN (SELECT ev_id FROM events WHERE u_id='.$_SESSION['u_id'].' ) 
	OR 
	v.v_id IN (SELECT v_id FROM videos WHERE u_id='.$_SESSION['u_id'].' ) 
	OR 
	s.sh_id IN (SELECT sh_id FROM sharing WHERE u_id='.$_SESSION['u_id'].' ) 
	OR 
	n.n_id IN (SELECT n_id FROM notes WHERE u_id='.$_SESSION['u_id'].' ) ';
$res=mysqli_query($db,$sql) or mysqli_error($db);
echo mysqli_num_rows($res);
while($row=mysqli_fetch_assoc($res)){
	print_r($row);
	echo '</br>';
}
*/	
	
$sql='( SELECT 
	p.p_id as id,p.p_from,c.cm_text,c.cm_for,c.cm_date 
	FROM
	posts p LEFT JOIN comments c ON p.p_id=c.p_id 
	WHERE p.p_id IN (SELECT p_id FROM posts WHERE u_id='.$_SESSION['u_id'].' ) AND c.cm_for="post" )
	UNION
	(SELECT 
	v.v_id as id,NULL,c.cm_text,c.cm_for,c.cm_date 
	FROM
	videos v LEFT JOIN comments c ON v.v_id=c.p_id 
	WHERE v.v_id IN (SELECT v_id FROM videos WHERE u_id='.$_SESSION['u_id'].' ) AND c.cm_for="video" )
	UNION
	(SELECT 
	e.ev_id as id,NULL,c.cm_text,c.cm_for,c.cm_date 
	FROM
	events e LEFT JOIN comments c ON e.ev_id=c.p_id 
	WHERE e.ev_id IN (SELECT ev_id FROM events WHERE u_id='.$_SESSION['u_id'].' ) AND c.cm_for="event" )
	UNION
	(SELECT 
	s.sh_id as id,NULL,c.cm_text,c.cm_for,c.cm_date 
	FROM
	sharing s LEFT JOIN comments c ON s.sh_id=c.p_id 
	WHERE s.sh_id IN (SELECT sh_id FROM sharing WHERE u_id='.$_SESSION['u_id'].' ) AND c.cm_for="sharing" )
	UNION
	(SELECT 
	n.id as id,NULL,c.cm_text,c.cm_for,c.cm_date 
	FROM
	notes n LEFT JOIN comments c ON n.id=c.p_id 
	WHERE n.id IN (SELECT id FROM notes WHERE u_id='.$_SESSION['u_id'].' ) AND c.cm_for="notes" )
	ORDER BY cm_date DESC 
	LIMIT '.$start.', '.$limit;
	
$check_array=array();

$res=mysqli_query($db,$sql) or mysqli_error($db);
//echo mysqli_num_rows($res);
$i=1;
echo '<div class="panel panel-primary">';
echo '<div class="panel-heading">Notifications</div>';

while($row=mysqli_fetch_assoc($res)){
	$tocheck=$row['id'].$row['cm_for'];
	if(!in_array($tocheck,$check_array)){
		$check_array[]=$tocheck;
		switch($row['cm_for']){
			case 'post':
				$url='posts.php?id='.$row['id'];
				break;
				
			case 'video':
				$url='view_videos.php?id='.$row['id'];
				break;
				
			case 'events':
				$url='event.php?id='.$row['id'];
				break;
				
			case 'sharing':
				$url='items.php?id='.$row['id'];
				break;
				
			case 'notes':
				$url='view_notes.php?id='.$row['id'];
				break;
				
		}
		echo '<div class="panel-body well" id="notification">';
		echo '<a href="'.$url.'" style="font-size:17px;">';
		echo '<div class="sno">'.$i++.':-</div>';
		echo 'Someone commented on your '.$row['cm_for'].' on '.dateshow($row['cm_date']).'</a>';
		echo '</div>';
	}
}
echo '</div>';


include 'footer.php';

?>
