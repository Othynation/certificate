<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
$user_id=$_SESSION['user_id'];
$rom=$getCredit->get_by_id('ts_gtw_users','id',$user_id); 
foreach($rom as $rm)
{
   $postm=$rm['post']; $usernamem=$rm['username'];
}
$detect=$_GET['detect'];
switch($detect)
{
   case 'formation':
   if(isset($_POST['reg_id']))
   {
      $id=$_POST['reg_id']; 
      $sql="
SELECT formation.fid,formation.formation_name 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id 
LEFT JOIN groups ON inscription.gid=groups.gid 
LEFT JOIN formation ON groups.fid=formation.fid 
WHERE inscription.reg_id=:id
";         
$rows=$getCredit->get_by_id_query($sql,$id);
$count=count($rows); 
echo '<option value="">Select</option>';
if($count>0)
{
 foreach($rows as $rowm)
 {
  echo '<option value="'.$rowm['fid'].'">'.$rowm['formation_name'].'</option>'; 
 } 
}
else 
{
   echo ''; 
}
   }
   break;
   case 'gsalary':
    if(isset($_POST['gid']))
   {
      $id=$_POST['gid']; 
$count=$getCredit->count_by_id('schedual','gid',$id);
if($count>0)
{
  $rows=$getCredit->get_by_string_limit('schedual','gid',$id,'sid','ASC',1);
 foreach($rows as $rowm)
 {
  $sdate=trim($rowm['sdate']);
  echo $sdate;
 } 
}
else 
{
  echo '';
}

   }
   break; 
     case 'fetch_record':
   if(isset($_POST['from']) && isset($_POST['to']))
   {
$from = trim($_POST['from']);
$to = trim($_POST['to']);
$sql = "SELECT COUNT(*) as count 
        FROM certificates 
        WHERE DATE(ccreated) BETWEEN :from AND :to";
$stmt = $db->prepare($sql);
$stmt->bindParam(':from', $from);
$stmt->bindParam(':to', $to);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$certificates = $result['count'];

$sqlr = "SELECT COUNT(*) as count 
        FROM registrations 
        WHERE DATE(reg_date) BETWEEN :from AND :to";
$stmt = $db->prepare($sqlr);
$stmt->bindParam(':from', $from);
$stmt->bindParam(':to', $to);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$registrations = $result['count'];

$sqli = "SELECT COUNT(*) as count 
        FROM inscription 
        WHERE DATE(icreated) BETWEEN :from AND :to";
$stmt = $db->prepare($sqli);
$stmt->bindParam(':from', $from);
$stmt->bindParam(':to', $to);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$inscription=$result['count'];

$data = array('certificates' => $certificates,'registrations'=>$registrations,'inscription'=>$inscription);
echo json_encode($data);


   }
   break;

   case 'gname':
   if(isset($_POST['fid']))
   {
    $fid=$_POST['fid']; 
      $abbreviation='';
$rows=$getCredit->get_by_id('formation','fid',$fid);
foreach($rows as $row)
{
$abbreviation=$row['abbreviation'];
}
$count=$getCredit->count_by_id('groups','fid',$fid);
if($count==0)
{
  $count=1;
}
else 
{
  $count=$count+1;
}
echo $gname=$abbreviation.sprintf('%03d', $count);
   }
   break;
    case 'gnamebycentre':
   if(isset($_POST['fid']))
   {
    $cent_id=$_POST['fid']; 
//       $sql="
// SELECT DISTINCT r.gname, r.gid
// FROM inscription i
// LEFT JOIN groups r ON i.gid = r.gid
// ORDER BY r.gname ASC; 
// ";    
echo '  <option value="">Select Group</option>';
$sql = "
SELECT DISTINCT c.cent_id,r.gname, r.gid 
FROM inscription i 
INNER JOIN registrations rg ON i.reg_id = rg.reg_id 
INNER JOIN centres c ON rg.cent_id = c.cent_id 
INNER JOIN groups r ON i.gid = r.gid 
WHERE c.cent_id='$cent_id'";
$rg=$getCredit->get_by_query($sql);

              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
              }

   }
   break;
    case 'groupbyreg':
   if(isset($_POST['reg_id']))
   {
    $reg_id=$_POST['reg_id']; 
//       $sql="
// SELECT DISTINCT r.gname, r.gid
// FROM inscription i
// LEFT JOIN groups r ON i.gid = r.gid
// ORDER BY r.gname ASC; 
// ";    
echo '<option value="">Select Group</option>';
$sql = "
SELECT DISTINCT r.gname, r.gid 
FROM groups r
INNER JOIN inscription i ON r.gid=i.gid 
INNER JOIN registrations rg ON i.reg_id = rg.reg_id 
WHERE i.reg_id='$reg_id'";
$rg=$getCredit->get_by_query($sql);
              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
              }
   }
   break;
    case 'gnamebycentre2':
   if(isset($_POST['fid']))
   {
    $cent_id=$_POST['fid']; 
//       $sql="
// SELECT DISTINCT r.gname, r.gid
// FROM inscription i
// LEFT JOIN groups r ON i.gid = r.gid
// ORDER BY r.gname ASC; 
// ";    
echo '  <option value="">Select Group</option>';
$sql = "
SELECT DISTINCT c.cent_id,r.gname, r.gid 
FROM inscription i  
INNER JOIN groups r ON i.gid = r.gid 
INNER JOIN centres c ON r.cnt_id = c.cent_id 
INNER JOIN links l ON c.cent_id=l.cent_id
WHERE c.cent_id='$cent_id' AND l.id='$user_id'";
$rg=$getCredit->get_by_query($sql);
              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
              }

   }
   break;



   case 'payment': 
   if(isset($_POST['gid']) AND isset($_POST['reg_id']))
   {
    $gid=$_POST['gid'];  $reg_id=$_POST['reg_id'];
    $count=$getCredit->count_by_string_two_col('inscription','gid',$gid,'reg_id',$reg_id);
    if($count==0)
    {
   'No record found'; 
    }
    else 
    {
       $rows=$getCredit->get_by_string_two_col('inscription','gid',$gid,'reg_id',$reg_id);
       foreach($rows as $row)
       {
         $servicefees=$row['inservicefees'];  $infees=$row['infees'];
         $total=$servicefees+$infees;
       }
         $total_deposit=$getCredit->getsumdeposite($gid,$reg_id);

         $payamount=$total-$total_deposit;
         ?>
         <div class="row">
           <div class="col-sm-2"></div>
          <div class="col-sm-8" style="background:#ffffb6;border-radius: 10px;border-left: 2px solid #008000;color: #000;">
                        <div class="form-group">          
    <h3>Total Deposits: <strong><?php echo $total_deposit; ?> <?php echo $getCredit->get_option_value('currency');?></strong></h3>
     <h3>Service Fees + Inscription Fees: <strong><?php echo $total; ?> <?php echo $getCredit->get_option_value('currency');?></strong></h3>
     <h3>Left to pay: <strong><?php echo $payamount; ?> <?php echo $getCredit->get_option_value('currency');?></strong></h3>
   
  </div>
                      </div>
                       <div class="col-sm-2"></div>
                    </div>
                      
                  



         <?php 
    }
 

   }
   break;
   case 'print': 
   if(isset($_POST['gid']) AND isset($_POST['inid']))
   {
    $gid=$_POST['gid'];
    $id=$_POST['inid'];
               $sql="
SELECT 
  marks.*,
  registrations.name AS name,
  registrations.reg_id,
  groups.gname,
  formation.formation_name,
  modules.modname
FROM 
  registrations 
  INNER JOIN inscription ON registrations.reg_id = inscription.reg_id 
  INNER JOIN groups ON inscription.gid = groups.gid 
  INNER JOIN formation ON groups.fid = formation.fid 
  INNER JOIN schedual ON schedual.gid = groups.gid 
  INNER JOIN exams ON schedual.sid = exams.sid 
  INNER JOIN marks ON exams.eid = marks.eid AND registrations.reg_id = marks.reg_id 
  LEFT JOIN modules ON exams.mid = modules.mid 
WHERE 
  inscription.inid = :id 
  AND groups.gid = :id2



";        
$rows=$getCredit->get_by_id_query_two_col($sql,$id,$gid);
$count=count($rows); 
if($count>0)
{
// foreach($rows as $row)
?>
<table style="width:100%;">
  <tr>
    <th>Full Name</th>
     <th>Group Name</th>
      <th>Formation</th>
       <th>Module</th>
        <th>Score</th>
  </tr>
  <?php 
  $i=0;
  $total=0;
  foreach($rows as $row)
  {
   echo '<tr>
        <td>'.$row["name"].'</td>
        <td>'.$row["gname"].'</td>
        <td>'.$row["formation_name"].'</td>
        <td>'.$row["modname"].'</td>
        <td>'.$row["marks"].'</td>
      </tr>';
   $total+=$row['marks'];
  $i++;}
  ?>
  <tr>
    <td colspan="6"><div style="border-bottom: 1px solid #ccc; width: 100%; margin: 20px 0;"></div></td>
  </tr>
  <tr><td colspan="3"></td>
    <td><h2>Total</h2></td>
    <td><h2><?php echo round($total/$i,1);?></h2></td>
  </tr>
</table>
<center><a   id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>

<?php
}
else 
{
 echo 'No record found';
}

   }
   break;
   case 'salary':
  if(isset($_POST['gid']) AND isset($_POST['from']) AND isset($_POST['to']) AND isset($_POST['prof_id']))
  {
   $gid=$_POST['gid']; 
   $from=$_POST['from']; 
   $to=$_POST['to']; 
    $prof_id=$_POST['prof_id']; 
    $salary_type=0;
   $samount=0;
    $rowsp=$getCredit->get_by_id('ts_gtw_users','id',$prof_id); 
  foreach($rowsp as $rp)
  {
    $fname=$rp['fname'];
     $lname=$rp['lname'];
  }
   $rows=$getCredit->get_by_string_two_col('schedual','gid',$gid,'pid',$prof_id); 
   //echo var_dump($rows);
   foreach($rows as $row)
   {
  $salary_type=$row['salary_type']; 
    $samount=$row['samount'];  
   }
   $monthcount=$getDatabase->monthDiff($from, $to); 
   $countsessions=$getCredit->count_schedules($gid, $prof_id, $from, $to);
   $countin=$getCredit->count_students_present_in_multiple_schedules($gid,$from,$to,$prof_id); 
   $total_hours=$getCredit->calculate_total_hours($gid, $from, $to, $prof_id); 

    $total=0;

   if($salary_type==1)
   {
     $total=($monthcount*$countin)*$samount;
   }
   else if($salary_type==2)
   {
 $total=$total_hours*$samount;
   }
   else if($salary_type==3)
   {
 //$total=$monthcount*$samount;
    $total=($samount*$countin)*$monthcount;
   }
 $shnote='Salary from '. $getDatabase->easy_date2($from).' to '.$getDatabase->easy_date2($to).', months= ' .$monthcount.', Seances= '.$countsessions.', Total Hours= '. $total_hours.' , Active inscription= '.$countin.', Prof Salary='. $samount.' '.$getCredit->get_option_value('currency').' '. $getDatabase->getSalaryType($salary_type); 
   ?>

<div class="col-sm-4">
  <h4>Nbr Months: <strong><?php  echo $monthcount;?></strong></h4><br>
  <h4>Nbr Seances: <strong><?php echo $countsessions;?></strong></h4><br>
  <h4>Nbr inscription active: <strong><?php echo $countin;?></strong></h4>
</div>
<div class="col-sm-4">
  <h4>Nbr Hours: <strong><?php echo  $total_hours;?> Hours</strong></h4><br>
  <h4>Salary Type: <strong><?php echo $getDatabase->getSalaryType($salary_type); ?></strong></h4><br>
  <h4>Salary: <strong><?php echo  $samount.' '.$getCredit->get_option_value('currency');?> </strong></h4>
</div>
        <div class="col-sm-4">
 <h4>&nbsp;</h4><br>
  <h3 style="">Total </h3>
<input type="text" id="salary" value="<?php echo  $total;?> <?php echo $getCredit->get_option_value('currency');?>" style="width: fit-content;" class="form-control" disabled>

        </div>
<?php 
if($total>0 AND $monthcount)
{
?>
        <div class="col-md-4"></div>
       <div class="col-md-4"> 
       <br><br> 
  <a target="_blank" href="sh?detect=add&pid=<?php echo $prof_id;?>&fname=<?php echo $fname;?>&lname=<?php echo $lname;?>&shamount=<?php echo $total;?>&shnote=<?php echo $shnote;?>" class="btn btn-success btn-lg btn-block">Pay (Add New Salary)</a>
</div>
 <div class="col-md-4">
</div>
        <?php 
      }
  }
  break;
  case 'calender':
if($postm=='admin')
{
 $sql="SELECT * 
from schedual
LEFT JOIN classroom ON schedual.classroom=classroom.clsid
LEFT JOIN ts_gtw_users ON schedual.pid=ts_gtw_users.id
WHERE ts_gtw_users.post='prof'
"; 
$scheduleData=$getCredit->get_by_query($sql);
// Generate calendar data
$calendarData = array();
foreach ($scheduleData as $schedule) {
    $startDate = $schedule['sdate'];
    $startTime = $schedule['sfrom'];
    $endTime = $schedule['sto'];
    $title = $schedule['classname'];
    $name =$schedule['fname'].' '.$schedule['lname'];
    $calendarData[$startDate][] = array(
        'title' => $startTime.' - '.$endTime.'<br>'.$name."<br>".$title,
        'start' => $startDate . 'T' . $startTime,
        'end' => $startDate . 'T' . $endTime,
        'available' => false
    );
}

// Output calendar data in JSON format
echo json_encode($calendarData); 
}

  break;
  case 'calenderuser':
if($postm=='user')
{
 $sql="SELECT * 
from schedual
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN classroom ON schedual.classroom=classroom.clsid
LEFT JOIN ts_gtw_users ON schedual.pid=ts_gtw_users.id
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id'
"; 

$scheduleData=$getCredit->get_by_query($sql);
// Generate calendar data
$calendarData = array();
foreach ($scheduleData as $schedule) {
    $startDate = $schedule['sdate'];
    $startTime = $schedule['sfrom'];
    $endTime = $schedule['sto'];
    $title = $schedule['classname'];
    $name =$schedule['fname'].' '.$schedule['lname'];
    $calendarData[$startDate][] = array(
        'title' => $startTime.' - '.$endTime.'<br>'.$name."<br>".$title,
        'start' => $startDate . 'T' . $startTime,
        'end' => $startDate . 'T' . $endTime,
        'available' => false
    );
}

// Output calendar data in JSON format
echo json_encode($calendarData); 
}
break;
case 'slotvalidate':
$roomId = (int)$_POST['roomId'];
$fromTime = $_POST['fromTime'];
$toTime = $_POST['toTime'];
$sql = "SELECT COUNT(*) AS total 
        FROM schedual 
        WHERE classroom = '$roomId' 
        AND sfrom < '$toTime' 
        AND sto > '$fromTime'";

$count =$getCredit->count_by_query2($sql);
//echo 'Room ID='.$roomId.'From Time='.$fromTime.'To Time'.$toTime.'Count='.$count;
if ($count > 0) {
  echo 'busy';
} 
// else {
//   echo 'available';
// } 

break;
}

?>