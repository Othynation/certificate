<?php require_once("../autoload.php");
$detect=$_GET['detect'];
$rows=$getCredit->fetch_all('pgeneral','id','ASC'); 
foreach($rows as $row) 
{
  $web_path=$row['web_path']; 
}
switch($detect)
{
	case 'dep':
	 $column = array("dep_id","dep_title");
$table='dep';$id='dep_id';$orderby='DESC';$type='dep_id';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$rows=$getOption->ajax($column,$table,$id,$search,$length,$start,$orderby,$type);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
    $sub_array[] = $row["dep_title"];
 $sub_array[] ='<a target="_blank" href=\'?detect=edit&id='.$row['dep_id'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['dep_id'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';
 $data[] = $sub_array;
}
	break; 
   case 'franchise':
   $column = array("name","institute_name","email","mobile","address","city","state","district","pincode");
$table='pfranchise';$id='fid';$orderby='DESC';$type='fid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$rows=$getOption->ajax($column,$table,$id,$search,$length,$start,$orderby,$type);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
       $sub_array[] ='<img src="uploads/'.$row["photo"].'" height="100">';
            $sub_array[] = $row["name"];
    $sub_array[] =$row["institute_name"];
        $sub_array[] =$row["email"];
     $sub_array[] = $row["mobile"];
    $sub_array[] = $row["city"];
 $sub_array[] = $row["state"];
     $sub_array[] =$row["district"];
      $sub_array[] = $getDatabase->easy_date($row["created_date"]);
  $sub_array[] ='<a target="_blank" href=\'?detect=view&id='.$row['fid'].'\'"><div class="icon-eye"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['fid'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';

 $data[] = $sub_array;
}
  break;
  
  case 'option':
   $column = array("option_id","option_name","option_value","type","option_note");
$table='poptions';$id='option_id';$orderby='ASC';$type='type';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$rows=$getOption->ajax($column,$table,$id,$search,$length,$start,$orderby,$type);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
    $sub_array[] = $row["option_name"];
  $sub_array[] = $row["type"];

 $sub_array[] = $row["option_note"];
 $sub_array[] = '<a target="_blank" href=\'?detect=edit&id='.$row['option_id'].'\'"><div class="icon-pencil"></div></a>';
 $data[] = $sub_array;
}
  break; 
  case 'registrations':
   $column = array("reg_id","reg_no","namef","namel","fname","mname","image","reg_date");
$table='pregistrations';$id='reg_id';$orderby='DESC';$type='course';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$rows=$getOption->ajax($column,$table,$id,$search,$length,$start,$orderby,$type);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
$i=1; 
foreach($rows as $row)
{
 $sub_array = array();
   $sub_array[] = '<input type="checkbox"  class="checkBoxClass" id="Checkbox'.$id.'" name="rid[]" value="'.$row["reg_id"].'">';
    $sub_array[] =$getCer->checkImage($row["image"],$row["reg_id"],'reg');
     $sub_array[] = $row["reg_no"];
  $sub_array[] = $row["namef"].' '.$row['namel'];
   $sub_array[] = $row["fname"];
    $sub_array[] = $row["mname"];
    $sub_array[] = $row['course'].'<br> <strong>'.$row['duration'].'</strong>';
 $sub_array[] = $getDatabase->easy_date($row["reg_date"]);
    $sub_array[] = $getCredit->status($row['status']);
  $sub_array[] ='<a target="_blank" href=\'?detect=edit&id='.$row['reg_id'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['reg_id'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';


 $data[] = $sub_array;
 $i++;
}
  break;
  case 'certificates':
   $column = array("reg_no","namef","namel","fname","mname","image","session","created","etxnid","exam_fee","exam_status","institute_code");
$table='pexam';$id='eid';$orderby='DESC';$type='eid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
       $sub_array[] =$getCer->checkImage($row["image"],$row["reg_id"],'reg');
            $sub_array[] = $row["reg_no"];
    $sub_array[] = $row["namef"].' '.$row['namel'];
        $sub_array[] = $row["fname"];
     $sub_array[] = $row["course"];
    $sub_array[] =  $row['session'].'<br> <strong>'.$row['exam_fee'].'<strong>';
 $sub_array[] = $getDatabase->easy_date($row["created"]);
     $sub_array[] = $getCredit->status($row['exam_status']);
  $sub_array[] ='<a target="_blank" href=\'?detect=edit&id='.$row['eid'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['eid'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';

 $data[] = $sub_array;
}
  break;
   case 'state':
   $column = array("sname","sid");
$table='pstate';$id='sid';$orderby='DESC';$type='sid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$rows=$getOption->ajax($column,$table,$id,$search,$length,$start,$orderby,$type);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
 $sub_array[] = $row["sname"];
  $sub_array[] ='<a target="_blank" href=\'?detect=edit&id='.$row['sid'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['sid'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';
 $data[] = $sub_array;
}
  break;

  case 'district':
   $column = array("dname","did");
$table='pdistrict';$id='did';$orderby='DESC';$type='did';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$rows=$getOption->ajax($column,$table,$id,$search,$length,$start,$orderby,$type);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
 $sub_array[] = $row["dname"];
  $sub_array[] = $getCredit->get_sname($row["sid"]);
  $sub_array[] ='<a target="_blank" href=\'?detect=edit&id='.$row['did'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['did'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';
 $data[] = $sub_array;
}
  break;

  case 'taluka':
   $column = array("tname","tid");
$table='ptaluka';$id='tid';$orderby='DESC';$type='tid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$rows=$getOption->ajax($column,$table,$id,$search,$length,$start,$orderby,$type);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
 $sub_array[] = $row["tname"];
  $sub_array[] = $getCredit->get_dname($row["did"]);
  $sub_array[] ='<a target="_blank" href=\'?detect=edit&id='.$row['tid'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['tid'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';
 $data[] = $sub_array;
}
  break;
    case 'institutes':
   $column = array("iname","ireg_no","iaddress","imobile","idate");
$table='pinstitute';$id='iid';$orderby='DESC';$type='iid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$rows=$getOption->ajax($column,$table,$id,$search,$length,$start,$orderby,$type);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
 $sub_array[] = $row["iname"];
  $sub_array[] = $row["ireg_no"];
    $sub_array[] = $row["imobile"];
  $sub_array[] = $getCredit->get_sname($row["sid"]);
    $sub_array[] = $getCredit->get_dname($row["did"]);
        $sub_array[] = $getCredit->get_tname($row["tid"]);
            $sub_array[] = $getDatabase->easy_date2($row["idate"]);
  $sub_array[] ='<a target="_blank" href=\'?detect=edit&id='.$row['iid'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['iid'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';
 $data[] = $sub_array;
}
  break;


}


$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $getOption->get_all_data($table),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
