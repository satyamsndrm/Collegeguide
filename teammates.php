<?php
include 'top.php';

$almaw="";
$fac="";
$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):"";
$id=intval($id);
$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page==0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

$sql='( SElECT  
	g.g_name,
	cm.frm,ci.type,ci.stream,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u.u_pic,
	ci.clg_joined,
	a.member,b.faculty,c.allumni 
	FROM 
	grp g LEFT JOIN club_members cm ON g.g_id=cm.s_id 
	LEFT JOIN user_profiles u on cm.u_id=u.u_id 
	LEFT JOIN clg_info ci ON cm.u_id=ci.u_id 
	LEFT JOIN ( SELECT s_id,count(cm.id) as member  
				FROM club_members cm LEFT JOIN clg_info ci ON cm.u_id=ci.u_id
				WHERE cm.type IN ("member","admin") AND ci.type="student" GROUP BY s_id ) a ON g.g_id=a.s_id 
	LEFT JOIN ( SELECT s_id,count(id) as faculty FROM club_members
				WHERE type="faculty" GROUP BY s_id ) b ON g.g_id=b.s_id 
	LEFT JOIN ( SELECT s_id,count(cm.id) as allumni 
				FROM club_members cm LEFT JOIN clg_info ci ON cm.u_id=ci.u_id
				WHERE cm.type="member" AND ci.type="allumni" GROUP BY s_id ) c ON g.g_id=c.s_id 
	WHERE 
	g.g_id='.$id.' AND ci.type="student"  AND cm.type IN ("member","admin") 
	ORDER BY fullname )
	UNION
	( SElECT  
	g.g_name,
	cm.frm,ci.type,ci.stream,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u.u_pic,
	ci.clg_joined,
	NULL,NULL,NULL
	FROM 
	grp g LEFT JOIN club_members cm ON g.g_id=cm.s_id 
	LEFT JOIN user_profiles u on cm.u_id=u.u_id 
	LEFT JOIN clg_info ci ON cm.u_id=ci.u_id 
	WHERE 
	g.g_id='.$id.' AND ci.type="allumni" AND cm.type="member"
	ORDER BY fullname ) 
	UNION 
	( SElECT  
	g.g_name,
	cm.frm,cm.type,ci.stream,
	u.u_id,CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u.u_pic,
	ci.clg_joined,
	NULL,NULL,NULL
	FROM 
	grp g LEFT JOIN club_members cm ON g.g_id=cm.s_id 
	LEFT JOIN user_profiles u on cm.u_id=u.u_id 
	LEFT JOIN clg_info ci ON cm.u_id=ci.u_id 
	WHERE 
	g.g_id='.$id.' AND ci.type="faculty" 
	ORDER BY fullname ) 
	';
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
//echo mysqli_num_rows($res);
$row=mysqli_fetch_array($res);
//if(mysqli_num_rows($res)>0){
/*
while($row=mysqli_fetch_assoc($res)){
	print_r($row);
	echo '<br>';
}
*/	
$a=$row['member'];
$b=$row['allumni'];
?>
<div role="tabpanel" style="margin-left:3px;">
	<h2>Teammates</h2>
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
paginate("teammates.php?id=$id");
	include 'footer.php';
?>

