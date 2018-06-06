<?php
include 'top.php';


$id=(isset($_GET['id']))?mysqli_real_escape_string($db,$_GET['id']):5;
$sql='SELECT * FROM grp WHERE g_id='.$id;
$res=mysqli_query($db,$sql) or die(mysqli_error($db));
$row=mysqli_fetch_array($res);

//echo mysqli_num_rows($res);
//group header

page_heads($row);
echo '<div class="panel panel-primary">';
echo '<div class="grp-heading panel-heading">About '.ucfirst(htmlspecialchars($row['g_name'])).':-</div>';
echo '<div class="panel-body" style="font-size:18px;">'.nl2br(htmlspecialchars($row['g_desc'])).'</div>';
echo '</div>';

include 'footer.php';
?>
