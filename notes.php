<?php
//ob_start();
include 'top.php';
$val='';

if(isset($_POST['action']) && $_POST['action']=="Filter"){
	$brnch=(isset($_POST['fr_branch']))?mysqli_real_escape_string($db,$_POST['fr_branch']):"";
	$yr=(isset($_POST['yr']))?mysqli_real_escape_string($db,$_POST['yr']):"";
	$val="yes";
}

$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page<=0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

$id=1;
//displaying form for input
form_for_notes();

if(empty($val)){
$sql='SELECT SQL_CALC_FOUND_ROWS 
	n.id AS nid,n.u_id,n.fr_year,n.fr_branch,n.fr,n.title,n.files,n.pic,n.n_desc,n.d_upl,
	CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u.u_pic,
	x.likes,y.comments,
	lg.l_id 
	FROM
	notes n LEFT JOIN user_profiles u ON n.u_id=u.u_id 
	LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
				WHERE l_for="notes" GROUP BY p_id) x ON n.id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="notes" 
				GROUP BY p_id ) y ON n.id=y.p_id 
	LEFT JOIN ( SELECT l_id,p_id from likes WHERE l_for="notes" AND u_id=1 ) AS lg ON n.id=lg.p_id 
	ORDER BY n.d_upl DESC';
}else{
	$col='n.fr_year="'.$yr.'" AND n.fr_branch="'.$brnch.'"';
	if(empty($yr)){
		$col='n.fr_branch="'.$brnch.'"';
	}
	if(empty($brnch)){
		$col='n.fr_year="'.$yr.'"';
	}
$sql='SELECT SQL_CALC_FOUND_ROWS 
	n.id AS nid,n.u_id,n.fr_year,n.fr_branch,n.fr,n.title,n.files,n.pic,n.n_desc,n.d_upl,
	CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u.u_pic,
	x.likes,y.comments,
	lg.l_id 
	FROM
	notes n LEFT JOIN user_profiles u ON n.u_id=u.u_id 
	LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
				WHERE l_for="notes" GROUP BY p_id) x ON n.id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="notes" 
				GROUP BY p_id ) y ON n.id=y.p_id 
	LEFT JOIN ( SELECT l_id,p_id from likes WHERE l_for="notes" AND u_id=1 ) AS lg ON n.id=lg.p_id 
	WHERE '.
	$col.' 
	ORDER BY n.fr_year,n.d_upl DESC';
}

$res=mysqli_query($db,$sql) or die(mysqli_error($db));

$i=1;
/*echo '<div class="filter-add">
	<div class="filter-heading">
	Add Filter
	</div>
*/
echo '<div class="panel panel-primary">
	<div class="panel-heading list-hd " style="height:40px; padding-top:1%;">Add filter</div>
	<div class="panel-body">
	<form method="post" action="">
	<div class="row">
	<div class="col-sm-4 col-xs-12">
	<select class="form-control" id="year" name="yr" style="margin-bottom:5px;">
		<option value="">Select Year</option>
		<option value="1st">1st</option>
		<option value="2nd">2nd</option>
		<option value="3rd">3rd</option>
		<option value="4th">4th</option>
	</select>
	</div>
	<div class="col-sm-4 col-xs-12">
	<select class="form-control" id="fr_branch" name="fr_branch" style="margin-bottom:5px;">
			<option value="">Select Branch</option>
			<option value="bt">Biotech</option>
			<option value="che">Chemical</option>
			<option value="civil">Civil</option>
			<option value="cse">Computer Science</option>
			<option value="ee">Electrical</option>
			<option value="ece">Electronics and communication</option>
			<option value="it">IT</option>
			<option value="ice">ICE</option>
			<option value="ipe">IPE</option>
			<option value="me">Mechanical</option>
		</select>
	</div>
	<div class="col-sm-4 col-xs-12">
	<input class="btn btn-info" type="submit" name="action" value="Filter">
	</div>
	</div>
	</div>
	</div>

	';


echo '<div class="panel panel-primary">';
echo '<div class="panel-heading list-hd text-center">List Of Notes</div>';
echo '<table class="table table-bordered lists">';
echo '<tr><th>S.No.</th><th>Notes Name</th><th class="hidden-xs">For</th><th>Pdf File</th></tr>';
while($row=mysqli_fetch_assoc($res)){
	show_notes_table($row);
}
echo '</table>';
echo '</div>';

paginate("notes.php",0);
include 'footer.php';
//ob_end_flush();

?>

