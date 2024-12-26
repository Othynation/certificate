<?php require_once("../autoload.php");
$one=$getCredit->get_option_value('course_durations'); 
$two=$getCredit->get_option_value('paracourse_durations'); 
if(isset($_POST['type']))
{
	 $type=$_POST['type']; 
	 echo '<option value="">Select duration</option>';
	 if($type==1)
	 {
	$arrs=explode(',',$two); 
	foreach($arrs as $arr)
	{
echo '<option value="'.$arr.'">'.$arr.'</option>';	
	}						
	 }
	 else 
	 {
	$arrs=explode(',',$one); 
	foreach($arrs as $arr)
	{
echo '<option value="'.$arr.'">'.$arr.'</option>';	
	}

	 }
}
?>