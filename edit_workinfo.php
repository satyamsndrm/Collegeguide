<?php
include 'top.php';

$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):"";
$id=intval($id);

if(isset($_POST['action'])){
	$w_id=(isset($_POST['w_id']))?mysqli_real_escape_string($db,trim($_POST['w_id'])):"";
	$c_name=(isset($_POST['c_name']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['c_name']))):"";
	$w_type=(isset($_POST['w_type']))?mysqli_real_escape_string($db,trim($_POST['w_type'])):"";
	$comments=(isset($_POST['comments']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['comments']))):"";
	$y_join=(isset($_POST['y_join']))?mysqli_real_escape_string($db,trim($_POST['y_join'])):"";
	$y_left=(isset($_POST['y_left']))?mysqli_real_escape_string($db,trim($_POST['y_left'])):NULL;
			
	
	if(!empty($c_name)){
		$sql='UPDATE workinfo 
			SET 				
			c_name="'.$c_name.'", 
			w_type="'.$w_type.'",
			comments="'.$comments.'",
			joined="'.$y_join.'",
			left="'.$y_left.'" 
			WHERE w_id='.$w_id;
		mysqli_query($db,$sql) or die(mysqli_error($db));
	}else{
		die('Company-Name cannot be left blank');
	}
}
echo '<p>Hello <strong>'.$_SESSION['f_name'].'</strong> ,';
echo ' Edit your workinfo through following forms.</p>';


$sql='SELECT * FROM workinfo WHERE w_id='.$id.' AND u_id='.$_SESSION['u_id'];
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
if(mysqli_num_rows($res)>0){
	$row=mysqli_fetch_assoc($res);
	extract($row);
}else{
	die();
}
?>

<div class="well">
<h4 class="desc-head">Edit your work details</h4>
<form method="post" action="">
	<div class="form-group">
		<label for="c_name">Company-Name</label>
		<input type="text" class="form-control" id="c_name" name="c_name" value="<?php echo $c_name;?>"/>
	</div>
		<textarea name="comments" class="form-control" rows="3" placeholder="Enter about your work experience"><?php echo $comments;?></textarea>
	
	</br>
	<div class="row">
	<div class="col-sm-2 col-xs-3">
		<b>Status:</b>
	</div>
	<div class="col-sm-10 col-xs-9">
		<label class="radio-inline"><input type="radio" name="w_type" value="INTERN"/>INTERN</label>
		<label class="radio-inline"><input type="radio" name="w_type" value="PLACED"/>PLACED</label>
		<label class="radio-inline"><input type="radio" name="w_type" value="WORKED"/>WORKED</label>
		<label class="radio-inline"><input type="radio" name="w_type" value="WORKING"/>WORKING</label>
	</div>
	</div>
	</br>
	<div class="form-group">
		<label>Year Joined</label>
		<select class="form-control yearselect" name="y_join">
			<option value="">Select Year</option>
		</select>
	</div>
	<div class="form-group">
		<label>Year Left(not neccesary)</label>
		<select class="form-control yearselect" name="y_left">
			<option value="">Select Year</option>
		</select>
	</div>
	<input type="hidden" name="w_id" value="<?php echo $id;?>"/>
	<input type="submit" class="btn btn-primary" name="action" value="Add Workinfo"/>
</form>
</div>

<?php

include 'footer.php';

?>