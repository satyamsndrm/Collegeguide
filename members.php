<?php
include 'top.php';

$almaw="";
$fac="";
$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):$_SESSION['b_id'];
$id=intval($id);
$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page==0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

$sql='SElECT SQL_CALC_FOUND_ROWS 
	g.g_name,
	ci.clg_joined,ci.type,ci.stream,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u.u_pic,
	a.member,y.faculty,c.allumni 
	FROM 
	grp g JOIN clg_info ci ON g.g_id=ci.b_id 
	JOIN user_profiles u on ci.u_id=u.u_id 
	JOIN ( SELECT b_id,count(id) as member FROM clg_info
				WHERE type="student" GROUP BY b_id ) a ON g.g_id=a.b_id 
	JOIN ( SELECT b_id,count(id) as faculty FROM clg_info
				WHERE type="faculty" GROUP BY b_id ) y ON g.g_id=y.b_id 
	JOIN ( SELECT b_id,count(id) as allumni FROM clg_info 
				WHERE type="allumni" GROUP BY b_id ) c ON g.g_id=c.b_id 
	WHERE 
	ci.b_id='.$id.' 
	GROUP BY g.g_id,u.u_id,ci.clg_joined,ci.type,ci.stream 
	ORDER BY ci.type';
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
$row=mysqli_fetch_array($res);
//if(mysqli_num_rows($res)>0){
//while($row=mysqli_fetch_assoc($res)){
//	print_r($row);
//	echo '<br>';
//}
/* */
$a=$row['member'];
$b=$row['allumni'];
?>
<div role="tabpanel" style="margin-left:3px;">
	<h2>Branchmates</h2>
	<ul class="nav nav-tabs members-nav" role="tablist">
		<li role="presentation" class="active"><a href="#student" aria-controls="student" role="tab" data-toggle="tab">Students <span class="badge"><?php echo $row['member'];?></span></a></li>
		<li role="presentation"><a href="#allumni" aria-controls="allumni" role="tab" data-toggle="tab">Allumni <span class="badge"><?php echo $row['allumni'];?></span></a></li>
		<li role="presentation"><a href="#faculty" aria-controls="faculty" role="tab" data-toggle="tab">Faculty <span class="badge"><?php echo $row['faculty'];?></span></a></li>
	</ul>
	
	<div class="tab-content">
		<div role="tabpanel" id="student" class="tab-pane fade in active">
<?php
		mysqli_data_seek($res,0);
$cnt1=0;
$cnt2=0;		
		while($row=mysqli_fetch_array($res)){
			if($row['type']=="student"){
				show_branchmates($row);
			}elseif($row['type']=="allumni"){
				if($cnt1==0){
					echo '</div><div role="tabpanel" id="allumni" class="tab-pane fade">';
					$cnt1++;
				}
				show_branchmates($row);
				$almaw="yes";
			}elseif($row['type']=="faculty"){
				if($cnt2==0){
					echo '</div><div role="tabpanel" id="faculty" class="tab-pane fade">';
					$cnt2++;
				}
				show_branchmates($row);
				$fac="yes";
			}
		}
		if(empty($almaw)){
			echo '</div><div role="tabpanel" id="allumni" class="tab-pane fade">';
		}
		if(empty($fac)){
			echo '</div><div role="tabpanel" id="faculty" class="tab-pane fade">';
		}
?>
	</div></div></div>
<?php
paginate("members.php?id=$id");
	include 'footer.php';
?>
	