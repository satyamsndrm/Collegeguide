<?php
include 'top.php';


$fac="";
$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):$_SESSION['h_id'];
$id=intval($id);
$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page==0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

$sql='SElECT SQL_CALC_FOUND_ROWS 
	g.g_name,
	ci.clg_joined,ci.type,ci.stream,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u_pic,
	a.member,y.faculty 
	FROM 
	grp g JOIN clg_info ci ON g.g_id=ci.h_id 
	JOIN user_profiles u on ci.u_id=u.u_id 
	JOIN ( SELECT h_id,count(id) as member FROM clg_info
				WHERE type="student" GROUP BY h_id ) a ON g.g_id=a.h_id 
	JOIN ( SELECT h_id,count(id) as faculty FROM clg_info
				WHERE type="faculty" GROUP BY h_id ) y ON g.g_id=y.h_id 
	WHERE 
	ci.type IN ("student","faculty") AND ci.h_id='.$id.' 
	GROUP BY g.g_id,ci.type,u.u_id,u_pic,ci.clg_joined,ci.type,ci.stream 
	ORDER BY ci.type';
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
$row=mysqli_fetch_array($res);
//if(mysqli_num_rows($res)>0){
/*
while($row=mysqli_fetch_assoc($res)){
	print_r($row);
	echo '<br>';
}
*/

$a=$row['member'];
$b=$row['faculty'];
?>
<div role="tabpanel" style="margin-left:3px;">
	<h2>Hostelmates</h2>
	<ul class="nav nav-tabs members-nav" role="tablist">
		<li role="presentation" class="active"><a href="#student" aria-controls="student" role="tab" data-toggle="tab">Students <span class="badge"><?php echo $row['member'];?></span></a></li>
		<li role="presentation"><a href="#faculty" aria-controls="faculty" role="tab" data-toggle="tab">Faculty <span class="badge"><?php echo $row['faculty'];?></span></a></li>
	</ul>
	
	<div class="tab-content">
		<div role="tabpanel" id="student" class="tab-pane fade in active">
<?php
		mysqli_data_seek($res,0);
$cnt1=0;
		while($row=mysqli_fetch_array($res)){
			if($row['type']=="student"){
				show_branchmates($row);
			}elseif($row['type']=="faculty"){
				if($cnt1==0){
					echo '</div><div role="tabpanel" id="faculty" class="tab-pane fade">';
					$cnt1++;
				}
				show_branchmates($row);
				$fac="yes";
			}
		}
		
		if(empty($fac)){
			echo '</div><div role="tabpanel" id="faculty" class="tab-pane fade">';
		}
?>	
	</div></div></div>
<?php
paginate("hostelmates.php?id=$id");
	include 'footer.php';
?>
