<?php
function dateshow($d){
	$pdte=strtotime($d);
	$pdt=date("j M G:i",$pdte);
	return $pdt;
}

function dayshow($d){
	$pdte=strtotime($d);
	$pdt=date("j M",$pdte);
	return $pdt;
}

function trim_post($text, $max_len=500,$tail='...'){
	$tail_len=strlen($tail);
	if(strlen($text)>$max_len){
		$temp_text=substr($text,0,$max_len-$tail_len);
		if(substr($temp_text,$max_len-$tail_len,0)=="")
			$text=$temp_text;
		else{
			$pos=strrpos($temp_text," ");
			$text=substr($temp_text,0,$pos);
		}
		$text=$text.$tail;
	}
	return $text;
}

function show_posts($row,$view=""){
	switch($row['p_from']){
		case "grp":
			$head=$row['g_name'];
			$pic=$row['g_pic'];
			$frm="grp";
			switch($row['g_type']){
				case "society":
					$gurl="society.php?id=";
					break;
					
				case "branch":
					$gurl="branch.php?id=";
					break;
					
				case "fest":
					$gurl="fests.php?id=";
					break;
					
				case "hostel":
					$gurl="hostel.php?id=";
					break;
			}
			break;
		
		case "page":
			$head=$row['pg_name'];
			$pic=$row['pg_pic'];
			$gurl="pages.php?id=";
			$frm="page";
			break;
			
//		default :
//			die();
//			break;
		
	}
	extract($row);
	echo '<div class="well well-lg">';
	echo '<div class="media">';
	echo '<div class="media-left">';
	echo "<a href='photo.php?for=$frm&id=$n_id'>";
	echo '<img class="media-object" src="'.$pic.'" alt="pic">';
	echo '</a>';
	echo '</div>';
	echo '<div class="media-body">';
	echo '<h4 class="media-heading"><a href="'.$gurl.$n_id.'">'.htmlspecialchars($head).'</a></h4>';
	if($frm!="page"){
		echo '<small>By:- <a href="profile.php?id='.$u_id.'"> '.htmlspecialchars($fullname).'</a></small></br>';
	}
	echo '<small>Date:- '.dateshow($d_upl).'</small>';
	echo '</div>';
	echo '</div>';
	echo '<p style="margin-top:3px; padding-top:3px;">';
	if(!empty($p_text)){
		echo '<p>';
		if(empty($view)){
			echo nl2br(htmlspecialchars(trim_post($p_text)));
			if(strlen($p_text)>500){
				echo '<a href="posts.php?id='.$p_id.'"> See more</a>';
			}
		}else{
			echo nl2br(htmlspecialchars($p_text));
		}
	echo '</p>';
	}
	if(!empty($p_pic)){
		echo "<a href='photo.php?for=post&id=$p_id'>";
		echo '<img class="post-img" src="'.$p_pic.'" alt="post_pic">';
		echo '</a>';
	}
	
	//displaying foot of the posts
	$c=$comments;
	$l=$likes;
	$val=(empty($l_id))?'Likes':'Liked';
	echo '<div id="lk_cm">';
	echo '<button class="btn btn-info likepost" id="post_'.$p_id.'">'.$val.' <span class="badge">'.$l.'</span></button>';
	echo '<a class="btn btn-info" href="posts.php?id='.$p_id.'&&from='.$frm.'">Comments <span class="badge">'.$c.'</span></a>';	
	echo '</div>';
	if(empty($view)){
		echo '</div>';
	}
}

function input_form($p_from,$id){
	echo '<div id="forms" class="well well-sm hidden-xs">';
	echo '<div class="form-heading"><div>Post Here</div></div>';
	echo '<form method="post" action="transactions.php" enctype="multipart/form-data">';
	echo '<textarea class="form-control" name="p_text" rows="4" placeholder="Write here to reachout folk"></textarea>';
	echo '(optional)';
	echo '<input type="file" class="form-control" name="file" value="" placeholder="optional"/>';
	echo '<input type="hidden" name="g_id" value="'.$id.'"/>';
	echo '<input type="hidden" name="p_from" value="'.$p_from.'"/>';
	echo '<input type="submit" class="btn btn-md btn-primary form_btn" name="action" value="Add Post"/>';
	echo '</form></div>';
	
	echo '<div id="form-mobile" class="well well-sm visible-xs">';
	echo '<div class="form-heading"><div>Post Here</div></div>';
	echo '<form method="post" action="transactions.php" enctype="multipart/form-data">';
	echo '<textarea class="form-control" name="p_text" rows="4" placeholder="Write here to reachout folk"></textarea>';
	echo '(optional)';
	echo '<input type="file" class="form-control" name="file" value="" placeholder="optional"/>';
	echo '<input type="hidden" name="g_id" value="'.$id.'"/>';
	echo '<input type="hidden" name="p_from" value="'.$p_from.'"/>';
	echo '<input type="submit" class="btn btn-md btn-primary form_btn" name="action" value="Add Post"/>';
	echo '</form></div>';
}

function form_for_comments($id,$for,$post_type=""){
	echo '<div id="cmbox" class="well">';
	echo '<h3 style="color:blue;"><b>Comment Box</b></h3>';
	echo '<form method="post" action="transactions.php">';
	echo '<textarea class="form-control" name="cm_text" rows="3" placeholder="Comment Here"></textarea>';
	echo '<input type="hidden" name="p_id" value="'.$id.'"/>';
	echo '<input type="hidden" name="for" value="'.$for.'"/>';
	echo '<input type="hidden" name="post_type" value="'.$post_type.'"/>';
	echo '<input type="submit" class="btn btn-primary form_btn" name="action" value="Add Comment"/>';
	echo '</form>';
	echo '</div>';
//	echo '<div class="well">';
	echo '<h3 style="color:blue;"><b>Comments</b></h3>';
}

function input_for_ev($type,$id){
	echo '<div id="forms" class="well well-sm hidden-xs">';
	echo '<div class="form-heading"><div>Post Here</div></div>';
	echo '<form method="post" action="transactions.php" enctype="multipart/form-data">';
	echo '<div class="form-group">';
	echo '<label for="ev_name">Event-Name</label>';
	echo '<input type="text" class="form-control" id="ev_name" name="ev_name" value="" placeholder="Event-Name"/>';
	echo '</div>';
	echo '<textarea class="form-control" name="ev_desc" rows="3" placeholder="Event descreption here">';
	echo '</textarea>';
	echo '<div class="input-group form_btn"><div class="input-group-addon">Event On*</div>';
	echo '<input type="date" class="form-control" name="ev_on" value=""/>';
	echo '</div>';
	echo '(optional)';
	echo '<input type="file" class="form-control " name="file" value=""/>';
	echo '<input type="hidden" name="n_id" value="'.$id.'"/>';
	echo '<input type="hidden" name="ev_type" value="'.$type.'"/>';
	echo '<input type="submit" class="btn btn-md btn-primary form_btn" name="action" value="Create Event"/>';
	echo '</form></div>';
	
	echo '<div id="form-mobile" class="well well-sm visible-xs">';
	echo '<div class="form-heading"><div>Post Here</div></div>';
	echo '<form method="post" action="transactions.php" enctype="multipart/form-data">';
	echo '<div class="form-group">';
	echo '<label for="ev_name">Event-Name</label>';
	echo '<input type="text" class="form-control" id="ev_name" name="ev_name" value="" placeholder="Event-Name"/>';
	echo '</div>';
	echo '<textarea class="form-control" name="ev_desc" rows="3" placeholder="Event descreption here">';
	echo '</textarea>';
	echo '<div class="input-group form_btn"><div class="input-group-addon">Event On*</div>';
	echo '<input type="date" class="form-control" name="ev_on" value=""/>';
	echo '</div>';
	echo '(optional)';
	echo '<input type="file" class="form-control " name="file" value=""/>';
	echo '<input type="hidden" name="n_id" value="'.$id.'"/>';
	echo '<input type="hidden" name="ev_type" value="'.$type.'"/>';
	echo '<input type="submit" class="btn btn-md btn-primary form_btn" name="action" value="Create Event"/>';
	echo '</form></div>';
}

function paginate($url,$id=1,$limit=15){
	global $page;
	global $db;
	$rem=($id==1)?'&page=':'?page';
	$sql='SELECT FOUND_ROWS();';
	$res=mysqli_query($db,$sql) or die(mysqli_error($db));
	$row=mysqli_fetch_assoc($res);
	
	if(($row['FOUND_ROWS()']-$limit*$page)>0){
		echo '<div class="text-center" >';
		echo '<a href="'.$url.$rem.++$page.'"><b style="font-size:25px;">See More</b></a>';
		echo '</div>';
	}
	mysqli_free_result($res);
}

function page_heads($row,$from=""){
	$var=(empty($from))?$row['g_type']:$from;
	$frm="grp";
	switch($var){
		case "society":
			$id=$row['g_id'];
			$name=$row['g_name'];
			$pic=$row['g_pic'];
			$desc=$row['g_desc'];
			$furl="society.php?id=";
			$url="teammates.php?id=";
			$eurl="edit_grp.php?id=$id";
			break;
		
		case "branch":
			$id=$row['g_id'];
			$name=$row['g_name'];
			$pic=$row['g_pic'];
			$desc=$row['g_desc'];
			$furl="branch.php?id=";
			$url="members.php?id=";
			break;
			
		case "page":
			$id=$row['pg_id'];
			$name=$row['pg_name'];
			$pic=$row['pg_pic'];
			$desc=$row['pg_desc'];
			$furl="pages.php?id=";
			$frm="page";
			break;
			
		case "hostel":
			$id=$row['g_id'];
			$name=$row['g_name'];
			$pic=$row['g_pic'];
			$desc=$row['g_desc'];
			$furl="hostel.php?id=";
			$url="hostelmates.php?id=";
			break;
			
		case "fest":
			$id=$row['g_id'];
			$name=$row['g_name'];
			$pic=$row['g_pic'];
			$desc=$row['g_desc'];
			$furl="fest.php?id=";
			$url="festmates.php?id=";
			$eurl="edit_grp.php?id=$id";
			break;
			
		default :
//			die();
			break;
		
	}
	echo '<div id="pg-heads" class="hidden-xs">';
	echo '<div class="media hidden-xs">';
	echo '<div class="media-left">';
	echo "<a href='photo.php?for=$frm&id=$id'>";
	echo '<img class="media-object img-thumbnail" style="width:120px; height:100px;" src="'.$pic.'" alt="pic">';
	echo '</a>';
	echo '</div>';
	echo '<div class="media-body">';
	echo '<h2 class="media-heading"><a href="'.$furl.$id.'">'.htmlspecialchars($name).'</a></h2>';
	echo '<small class="hidden-xs" style="font-weight:700; color:black;">';
	echo ucfirst(htmlspecialchars(trim_post($desc,250)));
	echo '</small>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	
	echo '<div id="mobile-pg-heads" class="media visible-xs">';
	echo '<div class="media-left">';
	echo "<a href='photo.php?for=$frm&id=$id'>";
	echo '<img class="media-object img-thumbnail" style="width:80px; height:80px;" src="'.$pic.'" alt="pic">';
	echo '</a>';
	echo '</div>';
	echo '<div class="media-body">';
	echo '<h4 class="media-heading"><a href="'.$furl.$id.'" style="font-size:16px; font-weight:600;">'.htmlspecialchars($name).'</a></h4>';
	echo '</div>';
	echo '</div>';
	
	//using $row['likes'] as it contains the members in first row
	echo '<div class="grp_links">';
	if(!empty($from)){
		if($from!="page"){
			echo '<a class="btn btn-link" href="about.php?id='.$id.'">About</a>';
			echo '<a class="btn btn-link" href="'.$url.$id.'">Members <span class="badge">'.$row['comments'].'</span></a>';
			if(( $var=="society" OR $var=="fest" ) AND $row['type']=="admin"){
				echo '<a class="btn btn-link" href="'.$eurl.'">Edit '.$var.'</a>';
			}
		}
	}
	if(empty($from)){
		echo '<a class="btn btn-link" href="'.$furl.$id.'">Feed Page</a>';
	}
	echo '</div>';
}

function show_comments($row){
	echo '<div id="comments" class="well">';
	echo '<div class="media">';
	echo '<div class="media-left">';
	echo '<a href="photo.php?for=profile&id='.$row['cmid'].'">';
	echo '<img class="media-object" src="'.$row['cmpic'].'" alt="pic">';
	echo '</a>';
	echo '</div>';
	echo '<div class="media-body">';
	echo '<h4 class="media-heading"><a href="profile.php?id='.$row['cmid'].'">'.htmlspecialchars($row['cmname']).'</a></h4>';
	echo '<small>Commented on:- '.dateshow($row['cm_date']).'</small>';
	echo '</div></div>';
	echo '<p>'.htmlspecialchars($row['cm_text']).'</p>';
	echo '</div>';
}

function show_branchmates($row){
	echo '<div class="media">';
	echo '<div class="media-left">';
	echo '<a href="photo.php?for=profile&id='.$row['u_id'].'">';
	echo '<img class="media-object" " src="'.$row['u_pic'].'"/>';
	echo '</a>';
	echo '</div>';
	echo '<div class="media-body">';
	echo '<h4 class="media-heading" id="member-heading"><a href="profile.php?id='.$row['u_id'].'"><b>'.htmlspecialchars($row['fullname']).'</b></a></h4>';
	echo '<small class="member-small">'.ucfirst($row['stream']).' '.$row['clg_joined'].' joined</small>';;
	echo '</div></div>';
}

function show_item($row,$view=""){
	echo '<div class="well">';
	echo '<div class="media">';
	echo '<div class="media-left">';
	echo '<a href="photo.php?for=item&id='.$row['sh_id'].'">';
	echo '<img class="media-object" style="width:65px; height:65px;" src="'.$row['pic'].'"/>';
	echo '</div>';
	echo '<div class="media-body">';
	echo '<h4 class="media-heading"><a href="item.php?id='.$row['sh_id'].'"><b>'.ucfirst(htmlspecialchars($row['name'])).'</b></a></h3>';
	echo '<small>By:- <a href="profile.php?id='.$row['u_id'].'">'.htmlspecialchars($row['fullname']).'</a></small></br>';
	echo '<small>Date:- :'.dateshow($row['d_upl']).'</small>';
	echo '</div></div>';
	if(!empty($row['s_desc'])){
		echo '<p>';
		if(empty($view)){
			echo nl2br(htmlspecialchars(trim_post($row['s_desc'])));
		}else{
			echo nl2br(htmlspecialchars($row['s_desc']));
		}
		if(strlen($row['s_desc'])>500){
			echo '<a href="item.php?id='.$row['sh_id'].'"> See more</a>';
		}
		echo '</p>';
	}
	if(!empty($row['pic'])){
		echo '<a href="photo.php?for=item&id='.$row['pic'].'">';
		echo '<img class="post-img" src="'.$row['pic'].'" alt="post_pic">';
		echo '</div>';
	}
	
	$val=(empty($row['l_id']))?'Likes':'Liked';
	echo '<div id="lk_cm">';
	echo '<button class="btn btn-info likepost" id="item_'.$row['sh_id'].'">'.$val.' <span class="badge">'.$row['likes'].'</span></button>';
	echo '<a class="btn btn-info" href="item.php?id='.$row['sh_id'].'">Comments <span class="badge">'.$row['comments'].'</span></a>';	
	echo '</div>';
	if(empty($view)){
		echo '</div>';
	}
}

function show_notes($row,$view=""){
	echo '<div class="well">';
	echo '<div class="media">';
	echo '<div class="media-left">';
	echo '<a href="photo.php?for=notes&id='.$row['nid'].'">';
	echo '<img class="media-object" style="width:65px; height:65px;" src="'.$row['pic'].'"/>';
	echo '</a>';
	echo '</div>';
	echo '<div class="media-body">';
	echo '<h4 class="media-heading"><a href="view_notes.php?id='.$row['nid'].'"><b>'.htmlspecialchars($row['title']).'</b></a></h3>';
	echo '<small style="color:blue;">By:- <a href="profile.php?id='.$row['u_id'].'">'.htmlspecialchars($row['fullname']).'</a></small></br>';;
	echo '<small style="color:blue;">Date:- '.dateshow($row['d_upl']).'</small>';;
	echo '</div></div>';
	if(!empty($row['n_desc'])){
		echo '<p>'.htmlspecialchars(trim_post($row['n_desc']));
	if(strlen($row['n_desc'])>500){
		echo '<a href="view_notes.php?id='.$row['nid'].'"> See more</a>';
	}
		echo '</p>';
	}
	
	if(!empty($row['files'])){
		echo '<p style="margin-bottom:0px;">Click below to download the attached file.</p>';
		echo '<a class="btn btn-default" style="margin-bottom:5px;" href="download.php?download='.$row['files'].'">Download File <span class="glyphicon glyphicon-download"></span></a>';
	}
	
	if(!empty($row['pic'])){
		echo '<a href="photo.php?for=notes&id='.$row['nid'].'">';
		echo '<img class="post-img" src="'.$row['pic'].'" alt="post_pic">';
		echo '</a>';
	}
	
	$val=(empty($row['l_id']))?'Likes':'Liked';
	echo '<div id="lk_cm">';
	echo '<button class="btn btn-info likepost" id="notes_'.$row['nid'].'">'.$val.' <span class="badge">'.$row['likes'].'</span></button>';
	echo '<a class="btn btn-info" href="view_notes.php?id='.$row['nid'].'">Comments <span class="badge">'.$row['comments'].'</span></a>';	
	echo '</div>';
	if(empty($view)){
		echo '</div>';
	}
}

function show_notes_table($row){
	global $i;
	echo '<tr><td>'.$i++.'</td><td><a href="view_notes.php?id='.$row['nid'].'"><b>'.htmlspecialchars($row['title']).'</b></a></td>';
	echo '<td class="hidden-xs">';
	$write=(!empty($row['fr_branch']))?ucfirst($row['fr_branch']):"";
	$write.=" ";
	$write.=(!empty($row['fr_year']))?$row['fr_year']:"";
	echo $write;
	echo '</td>';
	if(empty($row['files'])){
		$pdfwrite="<p> No files</p>";
	}else{
		$pdfwrite='<form method="post" action="download.php">
						<input type="hidden" name="pdffile" value="'.$row['files'].'">
						<input type="submit" name="download" Value="Download File">
					</form>';
		$pdfwrite='<a class="btn btn-default" href="download.php?download='.$row['files'].'">Download File</a>';
	}
	echo '<td>';
	echo $pdfwrite;
	echo '</td></tr>';
}

function form_for_notes(){
include 'upload_image.php';
global $db;
	
if(isset($_POST['action']) AND $_POST['action']=="Add Notes"){
$title=(isset($_POST['title']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['title']))):"";
$n_desc=(isset($_POST['n_desc']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['n_desc']))):"";
$fr_year=(isset($_POST['fr_year']))?mysqli_real_escape_string($db,trim($_POST['fr_year'])):"";
$fr_branch=(isset($_POST['fr_branch']))?mysqli_real_escape_string($db,trim($_POST['fr_branch'])):"";

if($_FILES['pdffile']['error']==UPLOAD_ERR_OK){
	$pdffile=mysqli_real_escape_string($db,upl_file());
}else{
	$pdffile="";
}

if(!empty($pdffile) || !empty($n_desc)){
	$sql='INSERT INTO notes
		(id,u_id,fr_year,fr_branch,title,n_desc,files,d_upl)
		VALUES
		(NULL,'.$_SESSION['u_id'].',"'.$fr_year.'","'.$fr_branch.'","'.$title.'","'.$n_desc.'","'.
		$pdffile.'","'.date('Y-m-d H:i:s').'")';
	mysqli_query($db,$sql) or die(mysqli_error($db));	
}else{
	show_error_msgs('Nothing to insert.<b>Pdffile should be less than 50mb.</b>');
}
}
echo '<button class="btn-primary btn-lg" data-toggle="collapse" data-target="#notes-frm">Click to Upload Notes</button>';
echo '<div id="notes-frm" class="collapse">';
echo '<div id="forms" class="well well-sm hidden-xs notes">';
echo '<div class="form-heading"><div>Post Here</div></div>';
echo '<form method="post" action="" enctype="multipart/form-data">';
echo '<div class="form-group">';
echo '<label for="title" class="form-title">Notes title</label>';
echo '<input type="text" class="form-control" id="title" name="title" value="" placeholder="Notes Ttle"/>';
echo '</div>';
echo '<div class="form-group" style="margin-bottom:4px;">
		<b style="padding-right:10px;">For Year*</b>
		<label class="radio-inline"><input type="radio" name="fr_year" value="1st">1st</label>
		<label class="radio-inline"><input type="radio" name="fr_year" value="2nd">2nd</label>
		<label class="radio-inline"><input type="radio" name="fr_year" value="3rd">3rd</label>
		<label class="radio-inline"><input type="radio" name="fr_year" value="4th">4th</label>
	</div>';
echo '<div class="form-group">';
echo '<div class="det frm-font frm-pad"><b>Select Branch(optional)</b></div>
		<select class="form-control" id="stream" name="fr_branch" style="margin-bottom:5px;">
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
		</select>';
echo '</div>';
echo '<textarea class="form-control" name="n_desc" rows="4" placeholder="Write about the notes"></textarea>';
echo '<div class="input-group" style="margin-bottom:5px; margin-top:5px;"><div class="input-group-addon">Upload pdf file</div>';
echo '<input type="file" class="form-control" name="pdffile" value=""/>';
echo '</div>';
echo '<input type="submit" class="btn btn-md btn-primary form_btn" name="action" value="Add Notes"/>';
echo '</form></div>';


echo '<div id="form-mobile" class="well well-sm visible-xs">';
echo '<div class="form-heading"><div>Post Here</div></div>';
echo '<form method="post" action="" enctype="multipart/form-data">';
echo '<div class="form-group">';
echo '<label for="title" class="form-title">Notes title</label>';
echo '<input type="text" class="form-control" id="title" name="title" value="" placeholder="Notes Ttle"/>';
echo '</div>';
echo '<div class="form-group" style="margin-bottom:4px;">
		<b style="padding-right:10px;">For Year*</b>
		<label class="radio-inline"><input type="radio" name="fr_year" value="1st">1st</label>
		<label class="radio-inline"><input type="radio" name="fr_year" value="2nd">2nd</label>
		<label class="radio-inline"><input type="radio" name="fr_year" value="3rd">3rd</label>
		<label class="radio-inline"><input type="radio" name="fr_year" value="4th">4th</label>
	</div>';
echo '<div class="form-group">';
echo '<div class="det frm-font frm-pad"><b>Select Branch(optional)</b></div>
		<select class="form-control" id="stream" name="fr_branch" style="margin-bottom:5px;">
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
		</select>';
echo '</div>';
echo '<textarea class="form-control" name="n_desc" rows="4" placeholder="Write about the notes"></textarea>';
echo '<div class="input-group" style="margin-bottom:5px; margin-top:5px;"><div class="input-group-addon">Upload pdf file</div>';
echo '<input type="file" class="form-control" name="pdffile" value=""/>';
echo '</div>';
echo '<input type="submit" class="btn btn-md btn-primary form_btn" name="action" value="Add Notes"/>';
echo '</form></div>';

echo '</div>';
}

function form_for_share(){
include 'upload_image.php';
global $db;

if(isset($_POST['action'])){
	$for=(isset($_POST['for']))?mysqli_real_escape_string($db,trim($_POST['for'])):"";
	$item_type=(isset($_POST['item_type']))?mysqli_real_escape_string($db,trim($_POST['item_type'])):"";
	$name=(isset($_POST['name']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['name']))):"";
	$s_desc=(isset($_POST['s_desc']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['s_desc']))):"";

	if($_FILES['file']['error']==UPLOAD_ERR_OK){
		$pic=mysqli_real_escape_string($db,upl_img("notes/"));
	}else{
		$pic="";
	}
	if(!empty($pic) || !empty($name) || !empty($s_desc)){
		$sql='INSERT INTO sharing
			(sh_id,u_id,fr,item_type,name,s_desc,pic,d_upl)
			VALUES
			(NULL,'.$_SESSION['u_id'].',"'.$for.'","book","'.
			$name.'","'.$s_desc.'","'.$pic.'","'.
			date('Y-m-d H:i:s').'")';
		mysqli_query($db,$sql) or die(mysqli_error($db));	
	}else{
		show_error_msgs('Nothing to insert.<b>Book name cannot be left empty.</b>');
	}
}
echo '<button class="btn-primary btn-lg" data-toggle="collapse" data-target="#share-frm">Click to Upload Book</button>';
echo '<div id="share-frm" class="collapse">';
echo '<div id="forms" class="well well-sm hidden-xs">';
echo '<div class="form-heading"><div>Post Here</div></div>';
echo '<form method="post" action="" enctype="multipart/form-data">';
echo '<div class="form-group">';
echo '<label for="name" class="form-title">Book Name</label>';
echo '<input type="text" class="form-control" id="name" name="name" value=""/>';
echo '</div>';
echo '<div class="form-group" >
	<b class="form-title frm-font" style="padding-right:10px;">for*</b>
	<label class="radio-inline form-title"><input type="radio" name="for" value="sale">Sale</label>
	<label class="radio-inline form-title"><input type="radio" name="for" value="share">Share</label>
	</div>';
//echo '<div class="frm-pad" >
//	<b class="det frm-font" style="padding-right:10px;">Item type*</b>
//	<label class="radio-inline"><input type="radio" name="item_type" value="book">Book</label>
//	<label class="radio-inline"><input type="radio" name="item_type" value="other">Other</label>
//	</div>';
echo '<div class="form-group">';
echo '<textarea class="form-control" name="s_desc" rows="4" placeholder="Write about the ite you are sharing"></textarea>';
echo '</div>';
echo '<input type="file" class="form-control form_btn" name="file" value="" placeholder="optional"/>';
echo '<input type="submit" class="btn btn-md btn-primary form_btn" name="action" value="Add Post"/>';
echo '</form></div>';


echo '<div id="form-mobile" class="well well-sm visible-xs">';
echo '<div class="form-heading"><div>Post Here</div></div>';
echo '<form method="post" action="" enctype="multipart/form-data">';
echo '<div class="form-group">';
echo '<label for="name" class="form-title">Book Name</label>';
echo '<input type="text" class="form-control" id="name" name="name" value=""/>';
echo '</div>';
echo '<div class="form-group" >
	<b class="form-title frm-font" style="padding-right:10px;">for*</b>
	<label class="radio-inline form-title"><input type="radio" name="for" value="sale">Sale</label>
	<label class="radio-inline form-title"><input type="radio" name="for" value="share">Share</label>
	</div>';
//echo '<div class="frm-pad" >
//	<b class="det frm-font" style="padding-right:10px;">Item type*</b>
//	<label class="radio-inline"><input type="radio" name="item_type" value="book">Book</label>
//	<label class="radio-inline"><input type="radio" name="item_type" value="other">Other</label>
//	</div>';
echo '<div class="form-group">';
echo '<textarea class="form-control" name="s_desc" rows="4" placeholder="Write about the ite you are sharing"></textarea>';
echo '</div>';
echo '<input type="file" class="form-control form_btn" name="file" value="" placeholder="optional"/>';
echo '<input type="submit" class="btn btn-md btn-primary form_btn" name="action" value="Add Post"/>';
echo '</form></div>';
echo '</div>';
}

function form_for_video(){
global $db;
if(isset($_POST['action'])){
	$v_link=(isset($_POST['v_link']))?mysqli_real_escape_string($db,trim($_POST['v_link'])):"";
	$v_txt=(isset($_POST['v_txt']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['v_txt']))):"";
	
	if(strpos($v_link,"youtube.com/watch")){
		$v_link=str_replace("watch?v=","embed/",$v_link);
	}
	
	if(!empty($v_link)){
		$sql='INSERT INTO videos
			(v_id,frm,u_id,v_link,v_txt,d_upl)
			VALUES
			(NULL,"user",'.$_SESSION['u_id'].',"'.$v_link.'","'.
			$v_txt.'","'.date('Y-m-d H:i:s').'")';
		mysqli_query($db,$sql) or die(mysqli_error($db));	
	}else{
		show_error_msgs('Nothing to insert.<b>Video link field must be filled.</b>');
	}
}	
 echo '<button class="btn-primary btn-lg" data-toggle="collapse" data-target="#video-frm">Click to Upload Video</button>';
 echo '<div id="video-frm" class="collapse">';
	echo '<div id="forms" class="well well-sm hidden-xs">';
	echo '<div class="form-heading"><div>Post Here</div></div>';
	echo '<form method="post" action="" enctype="multipart/form-data">';
	echo '<div class="form-group">';
	echo '<label for="v_link" class="form-title">Video Link</label>';
	echo '<input type="text" class="form-control" id="v_link" name="v_link" value="" placeholder="Paste Youtube OR Instagram video link."/>';
	echo '</div>';
	echo '<textarea class="form-control" name="v_txt" rows="4" placeholder="Say something about video"></textarea>';
//echo '<input type="hidden" name="n_id" value="'.$id.'"/>';
//	echo '<input type="hidden" name="p_from" value="'.$p_from.'"/>';
	echo '<input type="submit" class="btn btn-md btn-primary form_btn" name="action" value="Add Video"/>';
	echo '</form></div>';
	
	echo '<div id="form-mobile" class="well well-sm visible-xs">';
	echo '<div class="form-heading"><div>Post Here</div></div>';
	echo '<form method="post" action="" enctype="multipart/form-data">';
	echo '<div class="form-group">';
	echo '<label for="v_link" class="form-title">Video Link</label>';
	echo '<input type="text" class="form-control" id="v_link" name="v_link" value="" placeholder="Paste Youtube OR Instagram video link."/>';
	echo '</div>';
	echo '<textarea class="form-control" name="v_txt" rows="4" placeholder="Say something about video"></textarea>';
//echo '<input type="hidden" name="n_id" value="'.$id.'"/>';
//	echo '<input type="hidden" name="p_from" value="'.$p_from.'"/>';
	echo '<input type="submit" class="btn btn-md btn-primary form_btn" name="action" value="Add Video"/>';
	echo '</form></div>';
	echo '</div>';
}

function video_show($row,$view=""){
	echo '<div class="well">';
	echo '<div class="media">';
	echo '<div class="media-left">';
	echo '<a href="photo.php?for=profile&id='.$row['u_id'].'">';
	echo '<img class="media-object" src="'.$row['u_pic'].'" alt="pic">';
	echo '</a>';
	echo '</div>';
	echo '<div class="media-body">';
	echo '<h4 class="media-heading"><a href="profile.php?id='.$row['u_id'].'">'.htmlspecialchars($row['fullname']).'</a></h4>';
	echo '<small>Date:- '.dateshow($row['d_upl']).'</small>';
	echo '</div></div>';
	echo '<p>';
	if(!empty($row['v_txt'])){
		if(empty($view)){
			echo nl2br(htmlspecialchars(trim_post($row['v_txt'])));
			if(strlen($row['v_txt'])>500){
				echo '<a href="view_videos.php?id='.$row['v_id'].'"> See more</a>';
			}
		}else{
			echo nl2br(htmlspecialchars($row['v_txt']));
		}
	}
	echo '</p>';
	if(strpos($row['v_link'],"youtube.com/")){
		echo '<center>';
		echo '<iframe height="300px" width="100%" frameborder="2px" allowfullscreen="true" src="'.$row['v_link'].'" >';
		echo '</iframe>';
		echo '</center>';
	}else{
		echo $row['v_link'];
	}
	
	$val=(empty($row['l_id']))?'Likes':'Liked';
	echo '<div id="lk_cm">';
	echo '<button class="btn btn-info likepost" id="video_'.$row['v_id'].'">'.$val.' <span class="badge">'.$row['likes'].'</span></button>';
	echo '<a class="btn btn-info" href="view_videos.php?id='.$row['v_id'].'">Comments <span class="badge">'.$row['comments'].'</span></a>';	
	echo '</div>';
	if(empty($view)){
		echo '</div>';
	}
}

function show_events($row,$view=""){
	echo '<div class="well">';
	echo '<div class="media">';
	echo '<div class="media-left">';
	echo '<a href="photo.php?for=event&id='.$row['ev_id'].'">';
	echo '<img class="media-object" style="width:65px; height:65px;" src="'.$row['ev_pic'].'"/>';
	echo '</a>';
	echo '</div>';
	echo '<div class="media-body">';
	echo '<h4 class="media-heading"><a href="event.php?id='.$row['ev_id'].'"><b>'.htmlspecialchars($row['ev_name']).'</b></a></h3>';
	echo '<small>By:- <a href="profile.php?id='.$row['u_id'].'">'.htmlspecialchars($row['fullname']).'</a></small></br>';;
	echo '<small>Date:- '.dateshow($row['d_upl']).'</small>';;
	echo '</div></div>';
	echo '<p><strong>Event On: </strong> '.dayshow($row['ev_on']).'</p>';
	if(!empty($row['ev_desc'])){
		echo '<p>'.htmlspecialchars($row['ev_desc']);
		echo '</p>';
	}
	if(!empty($row['ev_pic'])){
		echo '<a href="photo.php?for=event&id='.$row['ev_pic'].'">';
		echo '<img class="post-img" src="'.$row['ev_pic'].'" alt="post_pic">';
		echo '</a>';
	}
	
	$val=(empty($row['l_id']))?'Likes':'Liked';
	echo '<div id="lk_cm">';
	echo '<button class="btn btn-info likepost" id="event_'.$row['ev_id'].'">'.$val.' <span class="badge">'.$row['likes'].'</span></button>';
	echo '<a class="btn btn-info" href="event.php?id='.$row['ev_id'].'">Comments <span class="badge">'.$row['comments'].'</span></a>';	
	echo '</div>';
	if(empty($view)){
		echo '</div>';
	}
}

function show_notices(){
	if(isset($_SESSION['notice'])){
		echo '<div class="alert alert-success">'.$_SESSION['notice'].'</div>';
		unset($_SESSION['notice']);
	}
	
	if(isset($_SESSION['error'])){
		echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
		unset($_SESSION['error']);
	}
	
	if(isset($_SESSION['pic_error'])){
		echo '<div class="alert alert-danger">'.$_SESSION['pic_error'].'</div>';
		unset($_SESSION['pic_error']);
	}
}

function show_error_msgs($msg){
	echo '<div class="alert alert-danger">'.$msg.'</div>';
	include 'footer.php';
	die();
	
}

?>





















































