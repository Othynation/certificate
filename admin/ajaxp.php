<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
$user_id=$_SESSION['user_id'];
$rom=$getCredit->get_by_id('ts_gtw_users','id',$user_id); 
foreach($rom as $rm)
{
   $postm=$rm['post']; $usernamem=$rm['username'];
}

if($postm!='prof'){header("location:index");exit();}
$detect=$_GET['detect'];
$rows=$getCredit->fetch_all('general','id','ASC'); 
foreach($rows as $row) 
{
  $web_path=$row['web_path']; 
}
switch($detect)
{
  case 'exams':
   $column = array("ename",'ecreated');
$table='exams';$id='eid';$orderby='DESC';$type='eid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$gid=$_POST['gid'];
$query="SELECT * 
FROM exams
LEFT JOIN schedual ON exams.sid=schedual.sid
LEFT JOIN ts_gtw_users ON exams.uid=ts_gtw_users.id
 WHERE exams.sid='$gid' AND
";
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type,$query);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
        $sub_array[] = $row["eid"];
          $sub_array[] = $row["ename"];
           $sub_array[] = $getDatabase->easy_date2($row["ecreated"]);
           $sub_array[] = $row["username"];
   $sub_array[] ='<a  href=\'?detect=editexam&id='.$row['eid'].'&sid='.$row['sid'].'\'"><div class="icon-pencil"></div></a>';
 $data[] = $sub_array;
}
  break;

   case 'group':
   $column = array("gname","classno");
$table='groups';$id='groups.gid';$orderby='DESC';$type='gid';
$search=$_POST["search"]["value"];$length=$_POST["length"];
$start=$_POST['start'];
  $query="SELECT distinct groups.*, formation.formation_name 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid 
LEFT JOIN schedual ON groups.gid=schedual.gid 
LEFT JOIN ts_gtw_users ON schedual.pid=ts_gtw_users.id 
 WHERE schedual.pid='$user_id' AND
";
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type,$query);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
        $sub_array[] = $row["gid"];
          $sub_array[] = $row["gname"];
           $sub_array[] = $row["formation_name"];
            $sub_array[] = $getCredit->get_sch($row["gid"]);
   
         $sub_array[] = $getCredit->status2($row["gstatus"]);
    $sub_array[] ='<a class="btn btn-success"  href=\'?detect=seances&id='.$row['gid'].'\'">Seances</a>';
     $sub_array[] =  $getCredit->get_prof2($row['uid']);
           $sub_array[] = $getDatabase->easy_date($row["gdate"]);

 $data[] = $sub_array;
}
  break;



  case 'exams':
   $column = array("ename",'ecreated');
$table='exams';$id='eid';$orderby='DESC';$type='eid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$gid=$_POST['gid'];
$query="SELECT * 
FROM exams
LEFT JOIN schedual ON exams.sid=schedual.sid
LEFT JOIN ts_gtw_users ON exams.uid=ts_gtw_users.id
 WHERE exams.sid='$gid' AND exams.uid='$user_id' AND
";
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type,$query);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
        $sub_array[] = $row["eid"];
          $sub_array[] = $row["ename"];
           $sub_array[] = $getDatabase->easy_date2($row["ecreated"]);
        
   $sub_array[] ='<a  href=\'?detect=editexam&id='.$row['eid'].'&sid='.$row['sid'].'\'"><div class="icon-pencil"></div></a>';

 $data[] = $sub_array;
}
  break;

 
 
case 'presense':
   $column = array("cin","dob","name",'formation_name','gname');
$table='inscription';$id='inid';$orderby='DESC';$type='inid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT * 
FROM inscription 
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN formation ON registrations.fid=formation.fid
LEFT JOIN groups ON inscription.gid=groups.gid
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND
";
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type,$query);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
     $sub_array[] = $row["honorific"].' '.$row["name"];
  $sub_array[] = $row["gname"];
    $sub_array[] = $row["formation_name"];
      $sub_array[] = $getCredit->easy_date2($row["indate"]);
 $sub_array[] = $getCredit->get_presense($row["reg_id"]);
  

 $data[] = $sub_array;
}
  break;
case 'seance':
   $column = array("samount");
$table='schedual';$id='sid';$orderby='DESC';$type='sid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$gid=$_POST['gid'];
$query="SELECT * 
FROM schedual
LEFT JOIN groups ON schedual.gid=groups.fid
LEFT JOIN ts_gtw_users ON schedual.pid=ts_gtw_users.id
 WHERE schedual.gid='$gid' AND schedual.pid='$user_id' AND
";
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type,$query);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
        $sub_array[] = $row["sid"];
           $sub_array[] = $row["username"];
             $sub_array[] = $getDatabase->easy_date2($row["sdate"]);
              $sub_array[] ='<a class="btn btn-primary"  href=\'?detect=presence&id='.$row['sid'].'\'"><i class="fa fa-user"></i> Liste Presence</a>';
                $sub_array[] ='<a class="btn btn-warning"  href=\'?detect=exams&id='.$row['sid'].'\'"><i class="fa fa-book"></i> Exams</a>';
  $sub_array[] ='<a  href=\'?detect=edit&id='.$row['sid'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['gid'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';

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
