<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
       $rom=$getCredit->get_by_id('ts_gtw_users','id',$user_id); 
foreach($rom as $rm)
{
   $postm=$rm['post']; $usernamem=$rm['username'];
}

if($postm!='admin'){header("location:index");exit();}

$image=$_GET['image']; 
if($image!='')
{       $table=$_GET['table'];
	$col=$_GET['col'];
	$id=$_GET['id'];
	$colid=$_GET['colid'];
	$res=$getCer->update_remove($table,$col,$colid,$id);
	$folder=$_GET['folder']; 
	$to=$_GET['to']; 

	if($res)
	{
		unlink($folder.$image);

  header("location:".$to."?removed=1");
	}
	else 
	{
		echo 'Something went wrong';
	}

}
else 
{
	echo 'Image not found'; 
}
?> 