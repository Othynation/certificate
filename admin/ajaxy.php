<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
$user_id=$_SESSION['user_id'];
$rom=$getCredit->get_by_id('ts_gtw_users','id',$user_id); 
foreach($rom as $rm)
{
   $postm=$rm['post']; $usernamem=$rm['username'];
}

if($postm!='employee'){header("location:index");exit();}
$detect=$_GET['detect'];
$rows=$getCredit->fetch_all('general','id','ASC'); 
foreach($rows as $row) 
{
  $web_path=$row['web_path']; 
}
switch($detect)
{

  case 'registrations':
   $column = array("reg_id","cin","dob","centre_name","name",'username');
$table='registrations';$id='reg_id';$orderby='DESC';$type='reg_id';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT * 
FROM registrations 
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN ts_gtw_users ON registrations.uid=ts_gtw_users.id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND
";
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type,$query);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
    $sub_array[] = '#'.$row["reg_id"];
        $sub_array[] =$getCer->user_image($row["image"]);
     $sub_array[] = $row["honorific"].' '.$row["name"];
  $sub_array[] = $row["cin"];
   $sub_array[] = $getDatabase->easy_date2($row["dob"]);
    $sub_array[] = $row["fid"];
     $sub_array[] = $row["centre_name"];
         $sub_array[] = $row["username"];
 $sub_array[] = $getDatabase->easy_date($row["reg_date"]);
  $sub_array[] ='<a  href=\'?detect=edit&id='.$row['reg_id'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['reg_id'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';
  

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
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN formation ON groups.fid=formation.fid 
LEFT JOIN ts_gtw_users ON groups.uid=ts_gtw_users.id 
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
case 'seance':
   $column = array("samount");
$table='schedual';$id='sid';$orderby='DESC';$type='sid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$gid=$_POST['gid'];
$query="SELECT * 
FROM schedual
LEFT JOIN groups ON schedual.gid=groups.fid
LEFT JOIN ts_gtw_users ON schedual.pid=ts_gtw_users.id
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE schedual.gid='$gid' AND
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

   case 'profs':
   $column = array("id","username","email","post","ustatus","samount");
$table='ts_gtw_users';$id='id';$orderby='DESC';$type='id';
$post="prof";
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT * 
FROM ts_gtw_users
 WHERE post='$post' AND ts_gtw_users.uid=$user_id AND
";
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type,$query);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
       $sub_array[] = '#'.$row["id"];
    $sub_array[] = $row["fname"].' '.$row["lname"];
     $sub_array[] = $row["uphone"];
       $sub_array[] = $getCredit->status($row["ustatus"]);
         $sub_array[] = $getDatabase->getSalaryType($row["salary_type"]);
          $sub_array[] =$row["samount"].' '.$getCredit->get_option_value('currency');
           $sub_array[] ='<a  class="btn btn-success" href=\'?detect=salary&id='.$row['id'].'\'"><i class="fa fa-money"></i> Salary</a>';
                 $sub_array[] = $getDatabase->easy_date($row["date"]);
 $sub_array[] ='<a  href=\'?detect=edit&id='.$row['id'].'\'"><div class="icon-pencil"></div></a>';
    

 $data[] = $sub_array;
}
  break;
  case 'inscription':
$column = array("instatus","inservicefees","infees","indate","intime","inreceived");
$table='inscription';$id='inid';$orderby='DESC';$type='inid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT * 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON inscription.uid=ts_gtw_users.id
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
        $sub_array[] = $row["inid"];
     $sub_array[] =  $row["name"];
         $sub_array[] = $row["gname"];
                   $sub_array[] = $row["inservicefees"].' '.$getCredit->get_option_value('currency');
         $sub_array[] = $row["infees"].' '.$getCredit->get_option_value('currency');

           $sub_array[] = $getDatabase->easy_date2($row["indate"]);
                $sub_array[] =$row["username"];
$sub_array[] = $getCredit->status2($row["instatus"]);
$sub_array[] ='<a  href=\'?detect=view&id='.$row['inid'].'\'"><img src="assets/icon/avatar.png" height="30"></a>';
 $data[] = $sub_array;
}
  break;
   case 'module':
   $column = array('formation_name','modname');
$table='modules';$id='modules.mid';$orderby='DESC';$type='mid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT distinct modules.*,ts_gtw_users.username,formation.formation_name
FROM modules 
LEFT JOIN exams ON modules.mid=exams.mid
LEFT JOIN schedual ON exams.sid=schedual.sid
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN formation ON modules.fid=formation.fid
LEFT JOIN ts_gtw_users ON modules.uid=ts_gtw_users.id
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
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
    $sub_array[] = '#'.$row["mid"];
    $sub_array[] = $row["formation_name"];
     $sub_array[] = $row["modname"];
      $sub_array[] = $row["username"];
 $sub_array[] = $getDatabase->easy_date($row["modcreated"]);

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
 WHERE schedual.gid='$gid' AND
";
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type,$query);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
        $sub_array[] = $row["sid"];
           $sub_array[] =  $getCredit->jump_to("prof?detect=edit&id=".$row['id']."",$row["fname"].' '.$row["lname"]);
             $sub_array[] = $getDatabase->easy_date2($row["sdate"]);
              $sub_array[] ='<a class="btn btn-primary"  href=\'?detect=presence&id='.$row['sid'].'\'"><i class="fa fa-user"></i> Liste Presence</a>';
                $sub_array[] ='<a class="btn btn-warning"  href=\'?detect=exams&id='.$row['sid'].'\'"><i class="fa fa-book"></i> Exams</a>';
  $sub_array[] ='<a  href=\'?detect=edit&id='.$row['sid'].'\'"><div class="icon-pencil"></div></a>';

 $data[] = $sub_array;
}
  break;

  case 'group':
   $column = array("gname","classno");
$table='groups';$id='gid';$orderby='DESC';$type='gid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT * 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
LEFT JOIN ts_gtw_users ON groups.uid=ts_gtw_users.id
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
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
        $sub_array[] = $row["gid"];
          $sub_array[] = $row["gname"];
           $sub_array[] = $row["formation_name"];
            $sub_array[] = $getCredit->get_sch($row["gid"]);
   
         $sub_array[] = $getCredit->status2($row["gstatus"]);
    $sub_array[] ='<a class="btn btn-success"  href=\'?detect=seances&id='.$row['gid'].'\'">Seances</a>';
     $sub_array[] =  $row["username"];
           $sub_array[] = $getDatabase->easy_date($row["gdate"]);

 $data[] = $sub_array;
}
  break;

  
  case 'classroom':
   $column = array("clsid","classname");
$table='classroom';$id='clsid';$orderby='DESC';$type='clsid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT distinct classroom.* , ts_gtw_users.username
FROM classroom
LEFT JOIN ts_gtw_users ON classroom.uid=ts_gtw_users.id
LEFT JOIN schedual ON classroom.clsid=schedual.classroom
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
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
  $sub_array[] = '#'.$row["clsid"];
    $sub_array[] = $row["classname"];
    $sub_array[] = $row["username"];
 $data[] = $sub_array;
}
  break; 

 case 'expenses':
  $column = array('etype', 'eamount', 'enote', 'edate');
$table='expenses';$id='exid';$orderby='DESC';$type='exid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT * 
FROM expenses 
LEFT JOIN centres ON expenses.cent_id=centres.cent_id
LEFT JOIN ts_gtw_users ON expenses.uid=ts_gtw_users.id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND
";
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type,$query);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
  $sub_array[] = '#'.$row["exid"];
    $sub_array[] = $row["etype"];
    $sub_array[] = $row["eamount"].' '.$getCredit->get_option_value('currency');
        $sub_array[] = $row["enote"];
           $sub_array[] = $row["edate"];
                    $sub_array[] = $row["username"];
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
   $sub_array[] ='<a  href=\'?detect=editexam&id='.$row['eid'].'&sid='.$row['sid'].'\'"><div class="icon-eye"></div></a>';
 $data[] = $sub_array;
}
  break;

  case 'payments':
$column = array("name","paydate","gname","username");
$table='payments';$id='pay_id';$orderby='DESC';$type='pay_id';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT * 
FROM payments
LEFT JOIN registrations ON payments.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON payments.uid=ts_gtw_users.id
LEFT JOIN groups ON payments.gid=groups.gid
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
        $sub_array[] = $row["pay_id"];
     $sub_array[] =  $row["name"];
       $sub_array[] = $row["gname"];
        $sub_array[] = $row["deposit"].' '.$getCredit->get_option_value('currency');
       $sub_array[] = $getCredit->easy_date2($row["paydate"]);
     $sub_array[] =$row["username"];
 $sub_array[] ='<a  href=\'?detect=edit&id='.$row['pay_id'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['pay_id'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';
 $data[] = $sub_array;
}
  break;

 case 'sh':
  $column = array('shamount', 'shdate','shnote','username','centre_name');
$table='sh';$id='shid';$orderby='DESC';$type='shid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT * 
FROM sh 
LEFT JOIN centres ON sh.cent_id=centres.cent_id
LEFT JOIN ts_gtw_users ON sh.uid=ts_gtw_users.id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND
";
$rows=$getOption->ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type,$query);
$number_filter_row= $rows[0]; $rows=$rows[1];
$data = array();
foreach($rows as $row)
{
 $sub_array = array();
  $sub_array[] = '#'.$row["shid"];
   $sub_array[] = $row["shamount"].' '.$getCredit->get_option_value('currency');
    $sub_array[] = $getCredit->get_prof2($row['pid']);
        $sub_array[] = $row["shnote"];
           $sub_array[] = $getDatabase->easy_date2($row["shdate"]);
                $sub_array[] = $row["username"];
              $sub_array[] = $row["centre_name"];   
 $sub_array[] ='<a  href=\'?detect=edit&id='.$row['shid'].'\'"><div class="icon-pencil"></div></a>';
   $sub_array[] = '<a href=\'?detect=del&id='.$row['shid'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><div class="icon-bin" style="color:red;"></div></a>';
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

  case 'certificates':
   $column = array("cid","name","cin","name","cno");
$table='certificates';$id='cid';$orderby='DESC';$type='cid';
$search=$_POST["search"]["value"];$length=$_POST["length"];$start=$_POST['start'];
$query="SELECT * 
FROM certificates 
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id
LEFT JOIN formation ON certificates.fid=formation.fid
LEFT JOIN ts_gtw_users ON certificates.uid=ts_gtw_users.id
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
        $sub_array[] = $row["cno"];
     $sub_array[] =  $row["name"];
         $sub_array[] = $row["cin"];
           $sub_array[] = $getDatabase->easy_date2($row["cdate"]);
                 $sub_array[] = $row["formation_name"];
            $sub_array[] = $row["cyear"];
                $sub_array[] = $row["username"];
 $sub_array[] = $getDatabase->easy_date($row["ccreated"]);
   $sub_array[] ='<a  href=\'certificate?id='.$row['cid'].'\'"><div class="icon-eye" style="text-align:center;"></div></a> ';
   $sub_array[] ='<a  href=\'certificate?download=1&id='.$row['cid'].'\'"><center><div class="fa fa-download"></div></center></a>';

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