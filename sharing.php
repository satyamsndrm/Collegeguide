<?php
include 'top.php';

$share="";
$page=(isset($_GET['page']))?mysqli_real_escape_string($db,$_GET['page']):1;
$page=intval($page);
$page=($page==0)?1:$page;
$limit=15;
$start=($page-1)*$limit;

form_for_share();

$sql='SELECT SQL_CALC_FOUND_ROWS 
	s.sh_id,s.u_id,s.fr,s.item_type,s.name,s.s_desc,s.pic,s.d_upl,s.d_mod,
	CONCAT_WS(" ",u.f_name,u.l_name) AS fullname,u.u_pic,
	x.likes,y.comments,
	lg.l_id 
	FROM
	sharing s LEFT JOIN user_profiles u ON s.u_id=u.u_id 
	LEFT JOIN (SELECT count(l_id) as likes,p_id FROM likes 
				WHERE l_for="item" GROUP BY p_id) x ON s.sh_id=x.p_id 
	LEFT JOIN (SELECT count(cm_id) AS comments,p_id FROM comments WHERE cm_for="item" 
				GROUP BY p_id ) y ON s.sh_id=y.p_id 
	LEFT JOIN ( SELECT l_id,p_id from likes WHERE l_for="item" AND u_id='.$_SESSION['u_id'].' ) AS lg ON s.sh_id=lg.p_id  				
	GROUP BY s.fr,s.item_type,s.u_id,s.sh_id,s.name,s.s_desc,s.pic,s.d_upl,s.d_mod,u.u_pic,lg.l_id 
	ORDER BY s.fr,s.d_upl DESC ';
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));



//displaying for for sharing
?>
<div role="tabpanel" class="sharing-nav">
	<h3 style="font-weight:600;">Books For Sale & Share</h3>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#sale" aria-controls="sale" role="tab" data-toggle="tab">Sale</a></li>
		<li role="presentation"><a href="#share" aria-controls="share" role="tab" data-toggle="tab">Share</a></li>
	</ul>
	
	<div class="tab-content">
		<div role="tabpanel" id="sale" class="tab-pane fade in active">
<?php
//		mysqli_data_seek($res,0);
$cnt1=0;
		while($row=mysqli_fetch_array($res)){
			if($row['fr']=="sale"){
				show_item($row);
			}elseif($row['fr']=="share"){
				if($cnt1==0){
					echo '</div><div role="tabpanel" id="share" class="tab-pane fade">';
					$cnt1++;
				}
				show_item($row);
				$share="yes";
			}
		}
		if(empty($share)){
			echo '</div><div role="tabpanel" id="allumni" class="tab-pane fade">';
		}
?>
	</div></div></div>
<?php
paginate("sharing.php",0);
	include 'footer.php';
?>
	