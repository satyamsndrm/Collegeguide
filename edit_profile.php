<?php
ob_start(); 
include 'top.php';
include 'upload_image.php';

$action=(isset($_POST['action']))?$_POST['action']:"";
if(isset($_POST['action'])){
switch($_POST['action']){
	case "Change Profile Picture":
		if($_FILES['file']['error']==UPLOAD_ERR_OK){
			$p_pic=mysqli_real_escape_string($db,upl_img("profile/"));
		}else{
			$p_pic="";
		}
		
		if(!empty($p_pic)){
			$sql='UPDATE user_profiles 
				SET 				
				u_pic="'.$p_pic.'" 
				WHERE u_id='.$_SESSION['u_id'];
			mysqli_query($db,$sql) or die(mysqli_error($db));
			$_SESSION['notice']='Your photo has been changed successfully';
		}else{
			show_error_msgs('Nothing to insert.<b>Please attach a photo.</b>');
		}
//		header('Location:profile.php?id='.$id);
		break;
		
	case "Submit":
		$abm=(isset($_POST['abm']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['abm']))):"";
	
		if(!empty($abm)){
			$sql='UPDATE user_profiles 
				SET 				
				abt_me="'.$abm.'" 
				WHERE u_id='.$_SESSION['u_id'];
			mysqli_query($db,$sql) or die(mysqli_error($db));
			$_SESSION['notice']='Your deatils has been changed successfully';
		}else{
			show_error_msgs('Nothing to insert.<b>About field cannot be left empty.</b>');
		}
		header('Location:profile.php');
		break;
	
	
	case "Add Workinfo":
		$c_name=(isset($_POST['c_name']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['c_name']))):"";
		$w_type=(isset($_POST['w_type']))?mysqli_real_escape_string($db,trim($_POST['w_type'])):"";
		$comments=(isset($_POST['comments']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['comments']))):"";
		$y_join=(isset($_POST['y_join']))?mysqli_real_escape_string($db,trim($_POST['y_join'])):"";
		$y_left=(isset($_POST['y_left']))?mysqli_real_escape_string($db,trim($_POST['y_left'])):"";
		
		if(!empty($c_name) AND !empty($w_type)){
			$sql='INSERT INTO workinfo
				( w_id,u_id,c_name,w_type,joined,left,comments)
				VALUES
				(NULL,'.$_SESSION['u_id'].',"'.$c_name.'","'.$w_type.'","'.
				$y_join.'","'.$y_left.'","'.$comments.'")';
			mysqli_query($db,$sql) or die(mysqli_error($db));
			$_SESSION['notice']='Your workdetails has been added successfully';
		}else{
			show_error_msgs('Nothing to insert.<b>Company name AND status field must be filled.</b>');
		}
			
		header('Location:profile.php');
		break;
				
}
}
echo '<p>Hello <strong>'.$_SESSION['f_name'].'</strong> ,';
echo ' Edit your profile through following forms.</p>';

show_notices();

?>
<div class="well edit-well">
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<label class="desc-head" for="file">Upload Your Picture</label>
		<input type="file" class="form-control" id="file" name="file" value="" />
	</div>
	<input type="submit" class="btn btn-primary" name="action" value="Change Profile Picture"/>
</form>
</div>

<div class="well edit-well">
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<label class="desc-head" for="abm">Write about yourself</label>
		<input type="text" class="form-control" id="abm" name="abm" value="" placeholder="Not more than 255 words"/>
	</div>
	<input type="submit" class="btn btn-primary" name="action" value="Submit"/>
</form>
</div>

<div class="row">
<div class="col-xs-12">
<div class="well edit-well">
<h4 class="desc-head">Add workinfo</h4>
<form method="post" action="">
	<div class="form-group">
		<label for="c_name">Company-Name*</label>
		<input type="text" class="form-control" id="c_name" name="c_name" value=""/>
	</div>
		<textarea name="comments" class="form-control" rows="3" placeholder="Enter about your work experience"></textarea>
	
	</br>
	<div class="row">
	<div class="col-sm-2 col-xs-3">
		<b>Status*:</b>
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
			<label>Year-Joined*</label>
			<select class="form-control yearselect" name="y_join">
				<option value="">Select Year</option>
			</select>
		</div>
		<div class="form-group">
			<label>Year-Left(optional)</label>
			<select class="form-control yearselect" name="y_left" >
				<option value="">Select Year</option>
			</select>
		</div>
		<input type="submit" class="btn btn-primary" name="action" value="Add Workinfo"/>
</form>
</div>
</div>	
</div>
<?php
include 'footer.php';
ob_end_flush();
?>