<?php
include 'top.php';

$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):"";
$id=intval($id);
$id1=$_SESSION['u_id'];
$sql="SELECT g.g_id,g.g_name,g.g_desc,g.g_type,cm.type AS club,fo.type AS fest 
	FROM 
	grp g LEFT JOIN club_members cm ON g.g_id=cm.s_id 
	LEFT JOIN fest_organisers fo ON g.g_id=fo.f_id 
	WHERE g.g_id=$id AND ( cm.u_id=$id1 OR fo.u_id=$id1 )";
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
$row=mysqli_fetch_assoc($res);
//print_r($row);
if(mysqli_num_rows($res)>0){
	extract($row);
	if($club=="admin" OR $fest=="admin"){
	}else{
		$allow="no";
	}
}else{
	$allow="no";
}
if(!empty($allow)){
	show_error_msgs('You are not the admin of this group.</br><b>Unauthorised Access.</b>');
}

show_notices();

//Add Member
?>
<h3 class="head"><b>Edit <?php echo ucfirst(htmlspecialchars($g_name));?></b></h3>
	<div class="well">
	<h4 class="head"><b>Add Member</b></h4>
	<form method="post" action="transactions.php">
		<div class="form-group">
			<label for="add_name" id="ss">User Name</label>
			<input class="form-control search" type="text" id="add_name" name="u_name" value=""/>
			<div id="divResult"></div>
			<input type="hidden" name="u_id" id="add_id" value=""/>
		</div>
		<div class="form-group">
			<label>Year Joined</label>
			<select class="form-control yearselect" name="frm">
				<option value="">Select Year</option>
			</select>
		</div>
		<div class="form-group">
			<label>Year Left(not neccesary)</label>
			<select class="form-control yearselect" name="y_left">
				<option value="">Select Year</option>
			</select>
		</div>
<!--
		<div class="form-group">
			<label for="file">Comment(not more than 255 words)</label>
			<input class="form-control" type="text" name="comments" value=""/>
		</div>
-->
			<input type="hidden" name="g_id" value="<?php echo $id;?>"/>
			<input type="hidden" name="from" value="<?php echo $g_type;?>"/>
			<input type="submit" class="btn btn-primary" name="action" value="Add Member"/>
	</form>
	</div>

	<div class="well">
	<h4 class="head"><b>Remove Member</b></h4>
	<form method="post" action="transactions.php">
		<div class="form-group">
			<label for="file">User Name</label>
			<input class="form-control search" type="text" id="rem_name" name="u_name" value=""/>
			<div id="divResult1"></div>
			<input type="hidden" name="u_id" id="rem_id" value=""/>
		</div>
		<input type="hidden" name="g_id" value="<?php echo $id;?>"/>
			<input type="hidden" name="from" value="<?php echo $g_type;?>"/>
		<input type="submit" class="btn btn-primary" name="action" value="Remove Member"/>
	</form>
	</div>
	
	<div class="well">
	<h4 class="head"><b>Upload Group Picture</b></h4>
		<form method="post" action="transactions.php" enctype="multipart/form-data">
				<input class="form-control" type="file" class="form-control" id="file" name="file" value=""/>
				<input type="hidden" name="g_id" value="<?php echo $id;?>"/>
				<input type="submit" class="btn btn-primary" name="action" value="Change Picture"/>
		</form>
	</div>
	
	
	<div class="well">
	<h4 class="head"><b>Edit <?php echo ucfirst(htmlspecialchars($g_type));?> Details</b></h4>
	<form method="post" action="transactions.php">
		<div class="form-group">
			<label for="name">Name</label>
			<input class="form-control" id="name" type="text" name="g_name" value="<?php echo $g_name;?>"/>
		</div>
		<textarea class="form-control" name="g_desc" rows="3"><?php echo $g_desc;?></textarea>
			<input type="hidden" name="g_id" value="<?php echo $id;?>"/>
			<input type="submit" class="btn btn-primary form_btn" name="action" value="Edit"/>
	</form>
	</div>
<?php
include 'footer.php';
?>