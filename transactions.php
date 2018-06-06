<?php
//include all files
ob_start(); 
include 'top.php';
include 'upload_image.php';
if(isset($_REQUEST['action'])){
  switch($_REQUEST['action']){
		
		//post from groups
	case "Add Post":
		$n_id=(isset($_POST['g_id']))?mysqli_real_escape_string($db,trim($_POST['g_id'])):"";
		$p_from=(isset($_POST['p_from']))?mysqli_real_escape_string($db,trim($_POST['p_from'])):"";
		$p_text=(isset($_POST['p_text']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['p_text']))):"";
		
		if($_FILES['file']['error']==UPLOAD_ERR_OK){
			$p_pic=mysqli_real_escape_string($db,upl_img("posts/"));
		}else{
			$p_pic="";
		}
		if(!empty($p_pic) || !empty($p_text)){
			$sql='INSERT INTO posts
				(p_id,p_from,n_id,u_id,p_text,p_pic,d_upl)
				VALUES
				(NULL,"'.$p_from.'",'.$n_id.','.$_SESSION['u_id'].',"'.
				$p_text.'","'.$p_pic.'","'.date('Y-m-d H:i:s').'")';
			mysqli_query($db,$sql) or die(mysqli_error($db));
			$_SESSION['notice']='Your post has been added successfully';
		}else{
			$_SESSION['error']='Nothing To Insert.Please write something.';
		}
		$id=mysqli_insert_id($db);
		header('Location:posts.php?id='.$id.'&&from='.$p_from);
		break;
		
	case "Add Comment":
		$p_id=(isset($_POST['p_id']))?trim($_POST['p_id']):"";
		$cm_text=(isset($_POST['cm_text']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['cm_text']))):"";
		$for=(isset($_POST['for']))?mysqli_real_escape_string($db,trim($_POST['for'])):"";
		$post_type=(isset($_POST['post_type']))?mysqli_real_escape_string($db,trim($_POST['post_type'])):"";
		
//		$url='post_view.php?id=';
		switch($for){
				case "post":
					if($post_type=="grp"){
						$url='posts.php?id='.$p_id.'&&from=grp';
					}else{
						$url='posts.php?id='.$p_id.'&&from=page';
					}
					break;
				
				case "video":
					$url='view_videos.php?id='.$p_id;
					break;
				
				case "notes":
					$url='view_notes.php?id='.$p_id;
					break;
				
				case "item":
					$url='item.php?id='.$p_id;
					break;
				
				case "event":
					$url='event.php?id='.$p_id;
					break;
		}

		if(!empty($cm_text)){
			$sql='INSERT INTO comments
				(cm_id,cm_for,p_id,u_id,cm_text,cm_date)
				VALUES
				(NULL,"'.$for.'",'.$p_id.','.$_SESSION['u_id'].',"'.
				$cm_text.'","'.
				date('Y-m-d H:i:s').'")';
			mysqli_query($db,$sql) or die(mysqli_error($db));
			$_SESSION['notice']='Your comment has been added successfully';
			}else{
				$_SESSION['error']='Nothing To Insert.Please write something.';
			}
			header('Location:'.$url);
			break;
	
	case "Create Event":
		$n_id=(isset($_POST['n_id']))?mysqli_real_escape_string($db,trim($_POST['n_id'])):"";
		$ev_type=(isset($_POST['ev_type']))?mysqli_real_escape_string($db,trim($_POST['ev_type'])):"society";
		$ev_name=(isset($_POST['ev_name']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['ev_name']))):"";
		$ev_desc=(isset($_POST['ev_desc']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['ev_desc']))):"";
		$ev_on=(isset($_POST['ev_on']))?mysqli_real_escape_string($db,trim($_POST['ev_on'])):"";
		
		if($_FILES['file']['error']==UPLOAD_ERR_OK){
			$ev_pic=mysqli_real_escape_string($db,upl_img("events/"));
		}else{
			$ev_pic="";
		}
		
		if(!empty($n_id)&&!empty($ev_name)&&!empty($ev_desc)&&!empty($ev_on)){
			$sql='INSERT INTO events
				(ev_id,ev_type,n_id,u_id,ev_name,ev_desc,ev_on,ev_pic,d_upl)
				VALUES
				(NULL,"'.$ev_type.'",'.$n_id.','.$_SESSION['u_id'].',"'.$ev_name.'","'.
				$ev_desc.'","'.$ev_on.'","'.$ev_pic.'","'.date('Y-m-d H:i:s').'")';
			mysqli_query($db,$sql) or die(mysqli_error($db));
			$_SESSION['notice']='Your event has been created successfully';
		}else{
			$_SESSION['error']='Nothing To Insert.Please write something.';
		}
		$url='Location:event.php?id='.$id;
		header($url);
		break;
	
	case "Edit Post":
		$p_id=(isset($_POST['p_id']))?mysqli_real_escape_string($db,trim($_POST['p_id'])):"";
		$p_text=(isset($_POST['p_text']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['p_text']))):"";
		
		if($_FILES['file']['error']==UPLOAD_ERR_OK){
			$p_pic=mysqli_real_escape_string($db,upl_img("posts/"));
		}else{
			$p_pic="";
		}
		if(!empty($p_pic) || !empty($p_text)){
			$sql='UPDATE posts 
				SET 
				p_text="'.$p_text.'", 
				p_pic="'.$p_pic.'", 
				d_mod="'.date('Y-m-d H:i:s').'" 
				WHERE p_id='.$p_id;
			mysqli_query($db,$sql) or die(mysqli_error($db));
		}else{
			die('Fields must be filled');
		}
		header('Location:posts.php?id='.$id);
		break;
		
	case "Add Member":
		$g_id=(isset($_POST['g_id']))?mysqli_real_escape_string($db,trim($_POST['g_id'])):"";
		$u_id=(isset($_POST['u_id']))?mysqli_real_escape_string($db,trim($_POST['u_id'])):"";
		$frm=(isset($_POST['frm']))?mysqli_real_escape_string($db,trim($_POST['frm'])):"";
		$upto=(isset($_POST['upto']))?mysqli_real_escape_string($db,trim($_POST['upto'])):"";
		$comments=(isset($_POST['comments']))?mysqli_real_escape_string($db,trim($_POST['comments'])):"";
		$from=(isset($_POST['from']))?mysqli_real_escape_string($db,trim($_POST['from'])):"";
		echo 'In Add member';
		echo $g_id.'</br>';
		echo $u_id;
		if(!empty($u_id) AND !empty($frm)){
			switch($from){
				
				case "society":
					if((!empty($u_id))&&!empty($g_id)){
						$sql='INSERT IGNORE INTO club_members
							(u_id,s_id,type,frm,upto,comments)
							VALUES
							('.$u_id.','.$g_id.',"member","'.
							$frm.'","'.$upto.'","'.$comments.'")';
						mysqli_query($db,$sql) or die(mysqli_error($db));
						$_SESSION['notice']="Member Add Successful";
					}else{
						$_SESSION['error']="Member Add Failed";
					}
					break;
					
				case "fest":
					if((!empty($u_id))&&!empty($g_id)){
						$sql='INSERT IGNORE INTO fest_organisers
							(u_id,f_id,type,for_year,comments)
							VALUES
							('.$u_id.','.$g_id.',"member","'.
							$frm.'-'.$upto.'","'.$comments.'")';
						mysqli_query($db,$sql) or die(mysqli_error($db));
						$_SESSION['notice']="Member Add Successful";
					}else{
						$_SESSION['error']="Member Add Failed";
					}
					$_SESSION['notice']="Member Add Successful";
					break;
				}
		}else{
			$_SESSION['error']="<b> Failed !.</b>You Must include <b>User name</b> and <b>Year Joined .</b>";
		}		
		header('Location:edit_grp.php?id='.$g_id);
		break;
			
	case "Remove Member":
		$g_id=(isset($_POST['g_id']))?mysqli_real_escape_string($db,intval(trim($_POST['g_id']))):"";
		$u_id=(isset($_POST['u_id']))?mysqli_real_escape_string($db,trim($_POST['u_id'])):"";
		$from=(isset($_POST['from']))?mysqli_real_escape_string($db,trim($_POST['from'])):"";
		
		switch($from){
			case "society":
				$sql='DELETE FROM club_members
					WHERE
					u_id='.$u_id.' AND s_id='.$g_id;
				if(mysqli_query($db,$sql)){
					$_SESSION['notice']="Removal Successful.";
				}else{
					$_SESSION['error']="Removal failed.";
				}
				break;
				
			case "fest":
				$sql='DELETE FROM fest_organisers
					WHERE
					u_id='.$u_id.' AND f_id='.$g_id;
				if(mysqli_query($db,$sql)){
					$_SESSION['notice']="Removal Successful.";
				}else{
					$_SESSION['error']="Removal failed.";
				}
				break;
		}
		header('Location:edit_grp.php?id='.$g_id);
		break;
	
	case "Change Picture":
		$g_id=(isset($_POST['g_id']))?mysqli_real_escape_string($db,trim($_POST['g_id'])):"";
		if($_FILES['file']['error']==UPLOAD_ERR_OK){
			$p_pic=mysqli_real_escape_string($db,upl_img("group/"));
		}else{
			$p_pic="";
		}
		
		if(!empty($p_pic)){
			$sql='UPDATE grp 
				SET 				
				g_pic="'.$p_pic.'" 
				WHERE g_id='.$g_id;
			mysqli_query($db,$sql) or die(mysqli_error($db));
			$_SESSION['notice']='Group picture has been changed successfully';
		}else{
			$_SESSION['error']="Unable to upload photo. <b>Please Upload photo with in jpg format.</b>";
		}
		header('Location:edit_grp.php?id='.$g_id);
		break;
	
	case "Edit":
		$g_id=(isset($_POST['g_id']))?mysqli_real_escape_string($db,trim($_POST['g_id'])):"";
		$g_name=(isset($_POST['g_name']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['g_name']))):"";
		$g_desc=(isset($_POST['g_desc']))?mysqli_real_escape_string($db,ucfirst(trim($_POST['g_desc']))):"";
		
		
		if(!empty($g_name)){
			$sql='UPDATE grp 
				SET 				
				g_name="'.$g_name.'", 
				g_desc="'.$g_desc.'"  
				WHERE g_id='.$g_id;
			mysqli_query($db,$sql) or die(mysqli_error($db));
			$_SESSION['notice']='Group details has been changed successfully';
		}else{
			$_SESSION['error']='Group Name cannot be left blank';
		}
		header('Location:edit_grp.php?id='.$g_id);
		break;
	

	
	default :
		echo "rama rama";
		break;
			
		}
}
ob_end_flush();
?>