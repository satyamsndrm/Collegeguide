<?php
include 'top.php';

$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):$_SESSION['u_id'];
$id=intval($id);
$id=($id==0)?$_SESSION['u_id']:$id;
$workid="";
$membr="";
$wrk="";

$sql="SELECT SQL_CALC_FOUND_ROWS 
	u.u_id,CONCAT_WS(' ',u.f_name,u.l_name) AS fullname,u.age,u.sex,u.abt_me,u.u_pic,
	a.address,a.state,a.country,a.pin,
	ci.type,ci.stream,ci.clg_joined,
	cp.clg_name,g1.g_name as b_name,g2.g_name as h_name
	FROM 
	user_profiles u LEFT JOIN address a ON u.add_id=a.id 
	LEFT JOIN clg_info ci ON u.u_id=ci.u_id 
	LEFT JOIN clg_profile cp ON ci.clg_id=cp.clg_id 
	LEFT JOIN grp g1 ON ci.b_id=g1.g_id 
	LEFT JOIN grp g2 ON ci.h_id=g2.g_id 
	LEFT JOIN ( SELECT u_id,count(sh_id) as shared FROM sharing WHERE u_id=$id 
				GROUP BY u_id ) x ON u.u_id=x.u_id 
	WHERE u.u_id=$id ";

	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
$row=mysqli_fetch_array($res);
if(empty($row['u_id'])){
	show_error_msgs('No Such Profile Exists.');
}
//if(mysqli_num_rows($res)>0){
	/*
while($row=mysqli_fetch_assoc($res)){
	print_r($row);
	echo '</br>';
}
*/
//	echo '<div class="container-fluid">';
echo '<div class="row">';
echo '<div class="col-sm-4 col-xs-12">';
echo '<div class="row" style="margin-left:2%">';
if(!empty($row['u_pic'])){
	echo "<a href='photo.php?for=profile&id=$id'>";
	echo '<img class="img-responsive hidden-xs" style="width:100%; height:214px; margin:auto; display:block; border:7px solid #337ab7;" src="'.$row['u_pic'].'" alt="pro pic">';
	echo '<img class="img-responsive visible-xs" style="width:70%; height:214px; margin:auto; display:block; border:7px solid #337ab7;" src="'.$row['u_pic'].'" alt="pro pic">';
	echo '</a>';
}else{
	echo '<span class="glyphicon glyphicon-user" style="font-size:130px; margin:auto; display:block; width:80%;"></span>';
}
echo '</div>';
if($id==$_SESSION['u_id']){
	echo '<div class="row lnk-div">';
	echo '<a class="lnk" href="edit_profile.php?">[<small>Edit Profile</small>]</a>';
	echo '</div>';
}


echo '</div>';
echo '<div class="col-sm-8 col-xs-12">';
echo '<div class="panel panel-primary">';
echo '<div class="pf-heading panel-heading">General Info</div>';
echo '<table class="table">';
echo '<tr><td class="det"><b>Name:</b></td>';
echo '<td><a class="det" href="profile.php?id='.$id.'"><b>'.htmlspecialchars($row['fullname']).'</b></a></td></tr>';
echo '<tr><td class="det"><b>User Id:</b></td>';
echo '<td class="det" style="font-weight:800; font-size:19px; color:green;">'.$id.'</td></tr>';
echo '<tr><td class="det"><b>Status:</b></td>';
echo '<td class="det">'.ucfirst($row['type']).'</td></tr>';
if(!empty($row['stream'])){
	echo '<tr><td class="det"><b>Stream:</b></td>';
	echo '<td class="det">'.ucfirst($row['stream']).' ('.$row['clg_joined'].' joined )</td></tr>';
}
if(!empty($row['b_name'])){
	echo '<tr><td class="det"><b>Branch:</b></td>';
	echo '<td class="det">'.$row['b_name'].'</td></tr>';
}
if(!empty($row['h_name'])){
	echo '<tr><td class="det"><b>Hostel:</b></td>';
	echo '<td class="det">'.$row['h_name'].'</td></tr>';
}
echo '<tr><td class="det"><b>Gender:</b></td>';
echo '<td class="det">'.$row['sex'].'</td></tr>';
echo '</table>';
echo '</div>';
echo '</div>';
echo '</div>';
//echo '</div>';

$sql="SELECT 
	cm.type,cm.comments,cm.frm,cm.upto,
	g.g_name,g.g_id
	FROM 
	club_members cm LEFT JOIN grp g ON cm.s_id=g.g_id 
	WHERE cm.u_id=$id ";
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));

echo '<div class="container-fluid">';
echo '<div class="row">';
$i=1;
echo '<div class="panel panel-primary">';
echo '<div class="panel-heading pf-heading">Membership Info</div>';
echo '<table class="table table-bordered pf-table">';
echo '<thead><td class="det"><b>S.NO:</b></td><td class="det"><b>Society Name</b></td><td class="det"><b>Type</b></td><td class="det hidden-xs"><b>Year Joined</b></td></thead>';
while($row=mysqli_fetch_array($res)){
	extract($row);
	echo '<tr>';
	echo '<td class="det">'.$i++.'</td>';
	echo '<td class="det"><a href="society.php?id='.$row['g_id'].'"><b>'.htmlspecialchars($row['g_name']).'</b></a></td>';
	echo '<td class="det">'.ucfirst($row['type']).'</td>';
	echo '<td class="det hidden-xs">'.$row['frm'];
	if(!empty($row['upto'])){
		echo '<b> - </b>'.$row['upto'];
	}
	echo '</td></tr>';
	$membr="yes";
}
echo '</table>';
if(empty($membr)){
	echo '<div class="alert alert-danger">This <b>User</b> is not a member of any society.</div>';
}
echo '</div>';
echo '</div>';

$sql="SELECT 
	w.w_id,w.w_type,w.c_name,w.c_type,w.joined,w.left,w.comments AS w_comm
	FROM 
	workinfo w 
	WHERE w.u_id=$id ";

$res=mysqli_query($db,$sql) or die(mysqli_error($db));
//$row=mysqli_fetch_array($res);

$i=1;


//mysqli_data_seek($res,0);

echo '<div class="row">';
echo '<div class="panel panel-primary">';
echo '<div class="panel-heading pf-heading">Workinfo</div>';
while($row=mysqli_fetch_assoc($res)){
	$workid=$row['w_id'];
	if($id=$_SESSION['u_id']){
		$workedit="<a href='edit_workinfo.php?id=$workid'>[<small style='font-size:12px;'>Edit</small>]</a>";
	}else{
		$workedit="";
	}
	echo '<div class="panel-body" style="background-color:; min-height:10px;"></div>';
	echo '<table class="table table-condensed">';
	echo '<colgroup>
			<col class="col-md-5">
			<col class="col-md-7">
		</colgroup>';
		echo '<tr><td style="color:green; font-size:20px;"><b>'.strtoupper($row['w_type']).' at:</b></td>';
		echo '<td style="font-size:20px;font-weight:700;">'.ucfirst(htmlspecialchars($row['c_name'])).' '.$workedit.'</td></tr>';
		echo '<tr><td class="det"><b>Year Joined:</b></td>';
		echo '<td style="font-size:17px;">'.$row['joined'].'</td></tr>';
		if(!empty($row['left'])){
			echo '<tr><td class="det"><b>Year Left:</b></td>';
			echo '<td style="font-size:17px;">'.$row['left'].'</td></tr>';
		}
		echo '<tr><td class="det"><b>Work experience:</b></td>';
		echo '<td style="font-size:17px;">'.ucfirst(htmlspecialchars($row['w_comm'])).'</td></tr>';
	$wrk="yes";
	echo '</table>';
}

if(empty($wrk)){
	echo '<div class="alert alert-danger">No Details about work-info</div>';
}
echo '</div>';
echo '</div>';
echo '</div>';

include 'footer.php';
?>