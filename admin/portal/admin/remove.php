<?php require_once("../autoload.php");
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login");}
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