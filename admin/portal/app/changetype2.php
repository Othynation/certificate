<?php require_once("../autoload.php");
$sid=$_POST['sid'];
if(isset($sid) && $_POST['type'])
{
	 $type=$_POST['type'];
	   if($type==1)
	   {
 echo '<option value="">Select District</option>';
    $sid=$_POST['sid'];
    $rows=$getCredit->get_by_id('pdistrict','sid',$sid);
 foreach($rows as $row)
	{
echo '<option value="'.$row['did'].'">'.$row['dname'].'</option>';	
	}		
	   }
	   else if($type==2)
	   {
echo '<option value="">Select Taluka</option>';
    $sid=$_POST['sid'];
    $rows=$getCredit->get_by_id('ptaluka','did',$sid);
 foreach($rows as $row)
	{
echo '<option value="'.$row['tid'].'">'.$row['tname'].'</option>';	
	}		

	   }
}
?>