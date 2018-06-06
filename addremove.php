<?php
include 'auth.inc.php';
include 'db_access.php';

$keywd=(isset($_POST['searchword']))?mysqli_real_escape_string($db,$_POST['searchword']):"";


$sql=" SELECT u_id,CONCAT_WS(' ',f_name,l_name) AS fullname,u_pic
	FROM
	user_profiles 
	WHERE
	CONCAT_WS(' ',f_name,l_name) LIKE '%$keywd%' 
	ORDER BY fullname 
	LIMIT 0,6";
	
$res=mysqli_query($db,$sql) or die(mysqli_error($db));

while($row=mysqli_fetch_assoc($res)){

?>
	<div class="display_box" align="left" id="<?php echo $row['u_id'];?>" >
		<img src="<?php echo $row['u_pic']; ?>" style="width:50px; height:40px; float:left; margin-right:6px;"  id="<?php echo $row['u_id']?>" />&nbsp;
		<span class="nme"  id="<?php echo $row['u_id']?>" ><?php echo $row['fullname']; ?></span>&nbsp;<br/>
	</div>
<?php

}



?>
