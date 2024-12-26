<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
       include("functions.php");
?>
<?php include("header.php"); 
//if($postm!='admin'){header("location:index");exit();}
?>

<style type="text/css">
table td:nth-child(1) {
width: 30%;
}
table td:nth-child(2) {
width: 30%;
}
table td:nth-child(3) {
width: 30%;
}
table td:nth-child(4) {
width: 30%;
}
.fixed-right {
  position: fixed;
  right: 20px;
  bottom: 20px;
}             

table tr td, table tr th {
  padding: 10px; /* Add 10px padding to all sides */
  color:#000;
}

@media print {
    .nav_menu {
      display: none;
    }
    #printbtn
    {
       display: none;
    }
    #backbtn
    {
      display: none;
    }
  }





</style>
                <?php include("sidebar.php"); 
                switch($postm) 
{
  case 'admin':
  ?> 
  <div class="right_col" role="main">
          <div class="">
          

            <div class="clearfix"></div>

        

             <div class="row">
              <!-- form input mask -->
       

              <div class="col-md-12 col-sm-12"> 
                
                <div class="x_panel">
                  <div class="x_title">
                   
                   
                   
                  <div class="x_content">
<?php if(isset($_GET['detect'])) 
{
  $detect=$_GET['detect'];
}
else 
{
  $detect='default'; 
}
switch ($detect) {

  case 'attendance':
  ?> 
 <?php 
                        
                        if(isset($_POST['subpost'])){
                          $cent_id=trim($_POST['cent_id']); 
                              $gid=trim($_POST['gid']); 
                                  $month=trim($_POST['month']); 
                                  $year = trim($_POST['year']);                      
         if(!isset($error)){ 
$sql="SELECT * 
from presence
INNER JOIN schedual ON presence.sid=schedual.sid
INNER JOIN groups ON schedual.gid=groups.gid
INNER JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
WHERE centres.cent_id='$cent_id' AND groups.gid='$gid' AND MONTH(presence.prdate)='$month' AND YEAR(presence.prdate)='$year'
";
$count=$getCredit->count_by_query($sql);
if($count>0)
{
  $rows=$getCredit->get_by_query($sql);
  $hide =1; 
}
else 
{
 $error[]='No record found..';
}
                 }
                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?>

<?php if(!isset($hide)){?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Student Attendance </h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-12">
                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" id="cent_id" class="form-control" required>
         <option value="">Selectionner Centre </option> 
<?php 
$rows = $getCredit->fetch_all('centres', 'centre_name', 'ASC'); 
foreach($rows as $row) {
    echo '<option value="'.$row['cent_id'].'">'.$row['centre_name'].'</option>'; 
}
?>
                  
        </select>
  </div>

</div>
<div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Group</label>         
     <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 

//              $sql="
// SELECT DISTINCT r.gname, r.gid
// FROM inscription i
// LEFT JOIN groups r ON i.gid = r.gid
// ORDER BY r.gname ASC; 
// ";        
// $rg=$getCredit->get_by_query($sql);

//               foreach($rg as $arr)
//               {
//               echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
//               }
//               ?>
     </select>

  </div>

</div>
<div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Month</label>
   <select name="month" class="form-control" required>
         <option value="">Selectionner Month </option> 
<?php 
$months = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12'
);

 foreach ($months as $month => $value) { ?>
        <option value="<?php echo $value; ?>"><?php echo $month; ?></option>
    <?php } ?>


?>
                  
        </select>
  </div>

</div>
<div class="col-sm-3">
  <div class="form-group">
    <label for="exampleInputEmail1">Year</label>
    <select name="year" class="form-control" required>
      <?php
      $currentYear = date('Y');
      for ($year = 2024; $year <= $currentYear; $year++) {
        $selected = ($year == $currentYear) ? 'selected' : '';
        echo "<option value='$year' $selected>$year</option>";
      }
      ?>
    </select>
  </div>
</div>



                  
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Download Report</button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
  </form>
         </div>
                </div>
<?php } else { ?> 

              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"></div>
               </div>
             <div class="row">
    <div class="col-sm-12" style="text-align:center;">
  <div class="page-title">
<h1 style="color: #000;font-weight: 700;">Student Attendence Report</h1>
<div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Centre :</span> <?php echo $rowk['centre_name'];?></h4></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Group :</span> <?php echo $rowk['gname'];?></h4></td>
                  <td style="width:10%;"></td>
                </tr>
              </table>
<table style="width: 100%;">
 <tr class="card-header">
    <th>#</th>
    <th>Full Name</th>
     <th>Date Attend</th>
      <th>Attendence</th>
      <th></th>

  </tr>
  <?php $i=0;  $ip=0; foreach($rows as $row){
    if($row['pre']==1)
    {
      $ip++;
    }
echo '<tr>
         <td>#'.$row['prid'].'</td>
        <td>'.$row['name'].'</td>
        <td>'.$getDatabase->easy_date2($row['prdate']).'</td>
        <td>'.$getDatabase->ap($row['pre']).'</td>
        <td></td>
      </tr>';
      $i++; } 
     ?>
      <tr><td colspan="1"></td>
    <td><h4><span style="font-weight: 900;color: #000;">Presence Total : <?php echo $ip.'/'.$i?></span></h4></td>
    <td><h4><span style="font-weight: 900;color: #000;">Presence % : <?php echo $ip/$i*100;?> %</span></h4></td>
  </tr>

</table> <center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>
            </div>
<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>
</div>

<?php } ?>
              
             

<script type="text/javascript">
  $(document).on('change', '#cent_id', function(){
  var fid= $('#cent_id').val();
  if(fid.trim() == '' ) {          
   alert('Please select a centere name'); 
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=gnamebycentre",      
data: {fid: fid },
        beforeSend: function() {
           $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");
           },
        success: function(data){ 
            //alert(data);
            $("#gid").html(data);
    }});
}
 });

</script>


  <?php
  break;
   case 'salary':
  ?> 
 
                        <?php 
                        
                        if(isset($_POST['subpost'])){
                          $id=trim($_POST['id']); 
                              $gid=trim($_POST['gid']); 
                                  $month=trim($_POST['month']); 
                                 $year = trim($_POST['year']);
                         
         if(!isset($error)){ 
$sql="SELECT DISTINCT sh.* ,ts_gtw_users.fname,ts_gtw_users.lname,groups.gname 
from sh
INNER JOIN ts_gtw_users ON sh.pid=ts_gtw_users.id
INNER JOIN schedual ON ts_gtw_users.id=schedual.pid
INNER JOIN groups ON schedual.gid=groups.gid
WHERE ts_gtw_users.id='$id' AND groups.gid='$gid' AND MONTH(sh.shdate)='$month' AND YEAR(sh.shdate)='$year'
";
$count=$getCredit->count_by_query($sql);
if($count>0)
{
  $rows=$getCredit->get_by_query($sql);
  $hide =1; 
}
else 
{
 $error[]='No record found..';
}
                 }
                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?>

<?php if(!isset($hide)){?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Teacher Salary</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-12">
                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Teacher </label>
   <select name="id" class="form-control" required>
         <option value="">Selectionner Teacher </option> 
<?php 
$rows = $getCredit->get_by_string('ts_gtw_users', 'post', 'prof'); 
foreach($rows as $row) {
    echo '<option value="'.$row['id'].'">'.$row['fname'].' '.$row['lname'].'</option>'; 
}
?>
                  
        </select>
  </div>

</div>
<div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Group</label>         
     <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 

             $sql="
SELECT DISTINCT r.gname, r.gid
FROM inscription i
LEFT JOIN groups r ON i.gid = r.gid
ORDER BY r.gname ASC; 
";        
$rg=$getCredit->get_by_query($sql);

              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
              }
              ?>
     </select>

  </div>

</div>
<div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Month</label>
   <select name="month" class="form-control" required>
         <option value="">Selectionner Month </option> 
<?php 
$months = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12'
);

 foreach ($months as $month => $value) { ?>
        <option value="<?php echo $value; ?>"><?php echo $month; ?></option>
    <?php } ?>


?>
                  
        </select>
  </div>

</div>
<div class="col-sm-3">
  <div class="form-group">
    <label for="exampleInputEmail1">Year</label>
    <select name="year" class="form-control" required>
      <?php
      $currentYear = date('Y');
      for ($year = 2024; $year <= $currentYear; $year++) {
        $selected = ($year == $currentYear) ? 'selected' : '';
        echo "<option value='$year' $selected>$year</option>";
      }
      ?>
    </select>
  </div>
</div>


                  
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Download Report</button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
  </form>
         </div>
                </div>
<?php } else { ?> 

              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"></div>
               </div>
             <div class="row">
    <div class="col-sm-12" style="text-align:center;">
  <div class="page-title">
<h1 style="color: #000;font-weight: 700;">Teacher Salary Report</h1>
<div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Teacher :</span> <?php echo $rowk['fname'].' '.$rowk['lname'];?></h4></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Group :</span> <?php echo $rowk['gname'];?></h4></td>
                  <td style="width:10%;"></td>
                </tr>
              </table>
<table style="width: 100%;">
 <tr class="card-header">
    <th>#</th>
    <th>Full Name</th>
     <th>Date</th>
      <th>Salary Amount</th>
      <th></th>

  </tr>
  <?php $st=0; foreach($rows as $row){
 $st+=$row['shamount'];
echo '<tr>
         <td>#'.$row['shid'].'</td>
        <td>'.$row['fname'].' '.$row['lname'].'</td>
        <td>'.$getDatabase->easy_date2($row['shdate']).'</td>
        <td>'.$row['shamount'].' '.$getCredit->get_option_value('currency').'</td>
        <td></td>
      </tr>';

       } 
     ?>
      <tr><td colspan="2"></td>
    <td><h4><span style="font-weight: 900;color: #000;float: right;">Salary Total : <?php echo $st.' '.$getCredit->get_option_value('currency');?></span></h4></td>
  
  </tr>

</table> <center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>

            </div>



<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>

</div>


<?php } ?>
              
             


  <?php
  break;
    case 'payment':
  ?> 
 
                        <?php 
                        
                        if(isset($_POST['subpost'])){
                          $cent_id=trim($_POST['cent_id']); 
                                  $month=trim($_POST['month']); 
                                 $year = trim($_POST['year']);

                         
         if(!isset($error)){ 
// $sql="SELECT * 
// from payments
// INNER JOIN groups ON payments.gid=groups.gid
// INNER JOIN inscription ON groups.gid=inscription.gid
// LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
// LEFT JOIN centres ON registrations.cent_id=centres.cent_id
// WHERE centres.cent_id='$cent_id' AND MONTH(payments.paydate)='$month' AND YEAR(payments.paydate)='$year'
// ";

          $sql = "SELECT DISTINCT 
          p.pay_id, 
          p.reg_id, 
          p.gid, 
          p.deposit, 
          r.name, 
          p.paydate, 
          c.centre_name, 
          r.cent_id,
          g.gname
        FROM 
          payments p
     LEFT JOIN 
          groups g ON p.gid = g.gid
        LEFT JOIN 
          registrations r ON p.reg_id = r.reg_id

        LEFT JOIN 
          centres c ON r.cent_id = c.cent_id
        WHERE 
          r.cent_id = '$cent_id'
          AND MONTH(p.paydate)='$month'
          AND YEAR(p.paydate)='$year'
        ORDER BY 
          p.paydate ASC";



$count=$getCredit->count_by_query($sql);
if($count>0)
{
  $rows=$getCredit->get_by_query($sql);
  $hide =1; 
}
else 
{
 $error[]='No record found..';
}
                 }
                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?>

<?php if(!isset($hide)){?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Payment Inscription</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-9">
                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" required>
         <option value="">Selectionner Centre </option> 
<?php 
$rows = $getCredit->fetch_all('centres', 'centre_name', 'ASC'); 
foreach($rows as $row) {
    echo '<option value="'.$row['cent_id'].'">'.$row['centre_name'].'</option>'; 
}
?>
                  
        </select>
  </div>

</div>

<div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Month</label>
   <select name="month" class="form-control" required>
         <option value="">Selectionner Month </option> 
<?php 
$months = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12'
);

 foreach ($months as $month => $value) { ?>
        <option value="<?php echo $value; ?>"><?php echo $month; ?></option>
    <?php } ?>


?>
                  
        </select>
  </div>

</div>
<div class="col-sm-4">
  <div class="form-group">
    <label for="exampleInputEmail1">Year</label>
    <select name="year" class="form-control" required>
      <?php
      $currentYear = date('Y');
      for ($year = 2024; $year <= $currentYear; $year++) {
        $selected = ($year == $currentYear) ? 'selected' : '';
        echo "<option value='$year' $selected>$year</option>";
      }
      ?>
    </select>
  </div>
</div>


                  
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Download Report</button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
  </form>
         </div>
                </div>
<?php } else { ?> 

              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"></div>
               </div>
             <div class="row">
    <div class="col-sm-12" style="text-align:center;">
  <div class="page-title">
<h1 style="color: #000;font-weight: 700;">Payment Inscriptions Report</h1>
<div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Centre :</span> <?php echo $rowk['centre_name'];?></h4></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Month :</span> <?php echo $getDatabase->easy_date3($rowk['paydate']);?></h4></td>
                  <td style="width:10%;"></td>
                </tr>
              </table>
<table style="width: 100%;">
 <tr class="card-header">
    <th>#</th>
    <th>Full Name</th>
     <th>Group Name</th>
      <th>Payment Date</th>
      <th>Deposit</th>
      <th></th>

  </tr>
  <?php $st=0; foreach($rows as $row){
 $st+=$row['deposit'];
echo '<tr>
         <td>#'.$row['pay_id'].'</td>
        <td>'.$row['name'].'</td>
         <td>'.$row['gname'].'</td>
        <td>'.$getDatabase->easy_date2($row['paydate']).'</td>
        <td>'.$row['deposit'].' '.$getCredit->get_option_value('currency').'</td>
        <td></td>
      </tr>';

       } 
     ?>
      <tr><td colspan="2"></td>
    <td><h4><span style="font-weight: 900;color: #000;float: right;"> Total Deposits : </span></h4></td>
    <td><h4><span style="font-weight: 900;color: #000;float: right;"><?php echo $st.' '.$getCredit->get_option_value('currency');?></span></h4></td>
  
  </tr>

</table> <center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>

            </div>



<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>

</div>


<?php } ?>
              
             


  <?php
  break;
    case 'expense':
  ?> 
 
                        <?php 
                        
                        if(isset($_POST['subpost'])){
                          $cent_id=trim($_POST['cent_id']); 
                                  $month=trim($_POST['month']); 
                                 $year = trim($_POST['year']);

                         
         if(!isset($error)){ 
$sql="SELECT * 
from expenses
LEFT JOIN centres ON expenses.cent_id=centres.cent_id
WHERE centres.cent_id='$cent_id' AND MONTH(expenses.edate)='$month' AND YEAR(expenses.edate)='$year'
";

$count=$getCredit->count_by_query($sql);
if($count>0)
{
  $rows=$getCredit->get_by_query($sql);
  $hide =1; 
}
else 
{
 $error[]='No record found..';
}
                 }
                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?>

<?php if(!isset($hide)){?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Expenses</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-9">
                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" required>
         <option value="">Selectionner Centre </option> 
<?php 
$rows = $getCredit->fetch_all('centres', 'centre_name', 'ASC'); 
foreach($rows as $row) {
    echo '<option value="'.$row['cent_id'].'">'.$row['centre_name'].'</option>'; 
}
?>
                  
        </select>
  </div>

</div>

<div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Month</label>
   <select name="month" class="form-control" required>
         <option value="">Selectionner Month </option> 
<?php 
$months = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12'
);

 foreach ($months as $month => $value) { ?>
        <option value="<?php echo $value; ?>"><?php echo $month; ?></option>
    <?php } ?>


?>
                  
        </select>
  </div>

</div>
<div class="col-sm-4">
  <div class="form-group">
    <label for="exampleInputEmail1">Year</label>
    <select name="year" class="form-control" required>
      <?php
      $currentYear = date('Y');
      for ($year = 2024; $year <= $currentYear; $year++) {
        $selected = ($year == $currentYear) ? 'selected' : '';
        echo "<option value='$year' $selected>$year</option>";
      }
      ?>
    </select>
  </div>
</div>


                  
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Download Report</button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
  </form>
         </div>
                </div>
<?php } else { ?> 

              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"></div>
               </div>
             <div class="row">
    <div class="col-sm-12" style="text-align:center;">
  <div class="page-title">
<h1 style="color: #000;font-weight: 700;">Expenses Report</h1>
<div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Centre :</span> <?php echo $rowk['centre_name'];?></h4></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Month :</span> <?php echo $getDatabase->easy_date3($rowk['edate']);?></h4></td>
                  <td style="width:10%;"></td>
                </tr>
              </table>
<table style="width: 100%;">
 <tr class="card-header">
    <th>#</th>
    <th>Charge Type</th>
     <th>Note</th>
      <th>Payment Date</th>
      <th>Deposit</th>
      <th></th>

  </tr>
  <?php $st=0; foreach($rows as $row){
 $st+=$row['eamount'];
echo '<tr>
         <td>#'.$row['exid'].'</td>
        <td>'.$row['etype'].'</td>
         <td>'.$row['enote'].'</td>
        <td>'.$getDatabase->easy_date2($row['edate']).'</td>
        <td>'.$row['eamount'].' '.$getCredit->get_option_value('currency').'</td>
        <td></td>
      </tr>';

       } 
     ?>
      <tr><td colspan="2"></td>
    <td><h4><span style="font-weight: 900;color: #000;float: right;"> Total Charges : </span></h4></td>
    <td><h4><span style="font-weight: 900;color: #000;float: right;"><?php echo $st.' '.$getCredit->get_option_value('currency');?></span></h4></td>
  
  </tr>

</table> <center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>

            </div>



<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>

</div>


<?php } ?>
              
             


  <?php
  break;
   case 'cash':
  ?> 
 <?php 
if(isset($_POST['subrevenue'])){
                          $cent_id=trim($_POST['cent_id']); 
                                  $from=trim($_POST['from']); 
                                 $to= trim($_POST['to']);

if(!isset($error)){ 
// $sql = "SELECT DISTINCT 
//           p.pay_id, 
//           p.reg_id, 
//           p.gid, 
//           p.deposit, 
//           r.name, 
//           p.paydate, 
//           c.centre_name, 
//           e.total_expense,
//           r.cent_id,
//           (SELECT SUM(p2.deposit) FROM payments p2 
//            LEFT JOIN registrations r2 ON p2.reg_id = r2.reg_id 
//            WHERE r2.cent_id = '$cent_id' 
//            AND p2.paydate BETWEEN '$from' AND '$to') AS total_deposit
//         FROM 
//           payments p
//         LEFT JOIN 
//           registrations r ON p.reg_id = r.reg_id
//         LEFT JOIN 
//           centres c ON r.cent_id = c.cent_id
//         LEFT JOIN 
//           groups g ON p.gid = g.gid
//         LEFT JOIN 
//           inscription i ON g.gid = i.gid
//         LEFT JOIN 
//           (SELECT 
//              cent_id,
//              SUM(eamount) AS total_expense
//            FROM 
//              expenses
//            WHERE 
//              cent_id = '$cent_id'
//              AND edate BETWEEN '$from' AND '$to'
//            GROUP BY 
//              cent_id) e ON c.cent_id = e.cent_id
//         WHERE 
//           r.cent_id = '$cent_id'
//           AND p.paydate BETWEEN '$from' AND '$to'
//         ORDER BY 
//           p.paydate ASC";


  $sql = "SELECT DISTINCT 
                   p.pay_id, 
                   p.reg_id, 
                   p.gid, 
                   p.deposit, 
                   r.name, 
                   p.paydate, 
                   c.centre_name, 
                   r.cent_id,
                   (SELECT SUM(p2.deposit) FROM payments p2 
                    LEFT JOIN registrations r2 ON p2.reg_id = r2.reg_id 
                    WHERE r2.cent_id = '$cent_id' 
                    AND p2.paydate BETWEEN '$from' AND '$to') AS total_deposit
                FROM 
                   payments p
                LEFT JOIN 
                   registrations r ON p.reg_id = r.reg_id
                LEFT JOIN 
                   centres c ON r.cent_id = c.cent_id
                WHERE 
                   r.cent_id = '$cent_id'
                   AND p.paydate BETWEEN '$from' AND '$to'
                ORDER BY 
                   p.paydate ASC";


$sql_expenses = "SELECT 
                   exid, 
                   etype, 
                   eamount, 
                   enote, 
                   edate, 
                   SUM(eamount) OVER () AS total_expense
                 FROM 
                   expenses
                 WHERE 
                   cent_id = '$cent_id'
                   AND edate BETWEEN '$from' AND '$to'
                 ORDER BY 
                   edate ASC";


$count=$getCredit->count_by_query($sql);
if($count>0)
{
  $rows=$getCredit->get_by_query($sql);
   $rowse=$getCredit->get_by_query($sql_expenses);
  $hide =1; 
  $type=1;

}
else 
{
 $error[]='No record found..';
}
                 }
                           } 


                           if(isset($_POST['subexpenses'])){
                          $cent_id=trim($_POST['cent_id']); 
                                  $from=trim($_POST['from']); 
                                 $to= trim($_POST['to']);

if(!isset($error)){ 
  
$sql_expenses = "SELECT 
                   expenses.exid, 
                   expenses.etype, 
                   expenses.eamount, 
                   expenses.enote, 
                   expenses.edate, 
                   centres.centre_name,
                   SUM(eamount) OVER () AS total_expense
                 FROM 
                   expenses
                   LEFT JOIN centres ON expenses.cent_id=centres.cent_id
                 WHERE 
                   expenses.cent_id = '$cent_id'
                   AND expenses.edate BETWEEN '$from' AND '$to'
                 ORDER BY 
                   edate ASC";


$count=$getCredit->count_by_query($sql_expenses);
if($count>0)
{
   $rowse=$getCredit->get_by_query($sql_expenses);
    $rows=$getCredit->get_by_query($sql_expenses);
  $hide =1; 
  $type=2;

}
else 
{
 $error[]='No record found..';
}
                 }
                           }

                            if(isset($_POST['subbalance'])){
                            $cent_id=trim($_POST['cent_id']); 
                                  $from=trim($_POST['from']); 
                                 $to= trim($_POST['to']);

if(!isset($error)){ 
// $sql = "SELECT DISTINCT 
//           p.pay_id, 
//           p.reg_id, 
//           p.gid, 
//           p.deposit, 
//           r.name, 
//           p.paydate, 
//           c.centre_name, 
//           e.total_expense,
//           r.cent_id,
//           (SELECT SUM(p2.deposit) FROM payments p2 
//            LEFT JOIN registrations r2 ON p2.reg_id = r2.reg_id 
//            WHERE r2.cent_id = '$cent_id' 
//            AND p2.paydate BETWEEN '$from' AND '$to') AS total_deposit
//         FROM 
//           payments p
//         LEFT JOIN 
//           registrations r ON p.reg_id = r.reg_id
//         LEFT JOIN 
//           centres c ON r.cent_id = c.cent_id
//         LEFT JOIN 
//           groups g ON p.gid = g.gid
//         LEFT JOIN 
//           inscription i ON g.gid = i.gid
//         LEFT JOIN 
//           (SELECT 
//              cent_id,
//              SUM(eamount) AS total_expense
//            FROM 
//              expenses
//            WHERE 
//              cent_id = '$cent_id'
//              AND edate BETWEEN '$from' AND '$to'
//            GROUP BY 
//              cent_id) e ON c.cent_id = e.cent_id
//         WHERE 
//           r.cent_id = '$cent_id'
//           AND p.paydate BETWEEN '$from' AND '$to'
//         ORDER BY 
//           p.paydate ASC";


  $sql = "SELECT DISTINCT 
                   p.pay_id, 
                   p.reg_id, 
                   p.gid, 
                   p.deposit, 
                   r.name, 
                   p.paydate, 
                   c.centre_name, 
                   r.cent_id,
                   (SELECT SUM(p2.deposit) FROM payments p2 
                    LEFT JOIN registrations r2 ON p2.reg_id = r2.reg_id 
                    WHERE r2.cent_id = '$cent_id' 
                    AND p2.paydate BETWEEN '$from' AND '$to') AS total_deposit
                FROM 
                   payments p
                LEFT JOIN 
                   registrations r ON p.reg_id = r.reg_id
                LEFT JOIN 
                   centres c ON r.cent_id = c.cent_id
                WHERE 
                   r.cent_id = '$cent_id'
                   AND p.paydate BETWEEN '$from' AND '$to'
                ORDER BY 
                   p.paydate ASC";

$sql_expenses = "SELECT 
                   exid, 
                   etype, 
                   eamount, 
                   enote, 
                   edate, 
                   SUM(eamount) OVER () AS total_expense
                 FROM 
                   expenses
                 WHERE 
                   cent_id = '$cent_id'
                   AND edate BETWEEN '$from' AND '$to'
                 ORDER BY 
                   edate ASC";


$count=$getCredit->count_by_query($sql);
if($count>0)
{
  $rows=$getCredit->get_by_query($sql);
   $rowse=$getCredit->get_by_query($sql_expenses);
  $hide =1; 
  $type=3;

}
else 
{
 $error[]='No record found..';
}
                 }
                          
                           }



                           ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?>

<?php if(!isset($hide)){?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Payment Inscription</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-9">
                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" required>
         <option value="">Selectionner Centre </option> 
<?php 
$rows = $getCredit->fetch_all('centres', 'centre_name', 'ASC'); 
foreach($rows as $row) {
    echo '<option value="'.$row['cent_id'].'">'.$row['centre_name'].'</option>'; 
}
?>
                  
        </select>
  </div>

</div>

<div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">From</label>
  <input type="date" name="from" class="form-control" required>
  </div>

</div>

<div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">To</label>
  <input type="date" name="to" class="form-control" required>
  </div>

</div>                
<div class="col-sm-4">
<center> <button type="submit" name="subrevenue" class="btn btn-success">Revenue Report</button></center>
      
</div>
<div class="col-sm-4 form-group">
  <center> <button type="submit" name="subexpenses" class="btn btn-success">Expenses Report</button></center>
    
</div>
<div class="col-sm-4">
  <center> <button type="submit" name="subbalance" class="btn btn-success">Balance Report</button></center>
 
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
  </form>
         </div>
                </div>
<?php } else { ?> 

              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"></div>
               </div>
            
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Centre :</span> <?php echo $rowk['centre_name'];?></h4></td>
           
                  <td style="width:10%;"></td>
                </tr>
              </table>
              <?php if($type!=2){?>

               <table style="width:80%">
                <tr>  
                  <td style="text-align:left;"><h4><span style="font-weight: 900;color: #000;text-decoration: underline;">Balance:</span></h4></td>
                </tr>
              </table>
                   <table style="width:60%;">
                <tr class="card-header">  
                  <th>Date</th><td  style="width:300px;background: #f9f9f9;"><?php echo $getDatabase->easy_date2($from);?> > <?php echo $getDatabase->easy_date2($to);?> </td>
                </tr>
                  <tr class="card-header">  
                  <th>Inscription Total</th><td  style="width:300px;background: #f9f9f9;"><?php echo $rowk['total_deposit'];?> <?php echo $getCredit->get_option_value('currency');?></td>
                </tr>
                   <tr class="card-header">  
                    <?php foreach($rowse as $rowe){}?>
                  <th>Expenses Total</th><td  style="width:300px;background: #f9f9f9;"><?php echo $rowe['total_expense'];?> <?php echo $getCredit->get_option_value('currency');?></td>
                </tr>
                  <tr class="card-header">  
                  <th>Balance</th><td  style="width:300px;background: #f9f9f9;"><?php echo $rowk['total_deposit']-$rowe['total_expense'];?> <?php echo $getCredit->get_option_value('currency');?></td>
                </tr>


              </table>
              <?php if($type!=3){?>
              <hr>
                 <table style="width:40%">
                <tr>  
                  <td style="text-align:left;"><h4><span style="font-weight: 900;color: #000;text-decoration: underline;">Revenue:</span></h4></td>
                </tr>
              </table>




<table style="width: 100%;">
 <tr class="card-header">
    <th>Description</th>
    <th>Date</th>
     <th>Amount</th>
  </tr>
  <?php 


  $st=0; foreach($rows as $row){
 $st+=$row['deposit'];
echo '<tr>
        <td>'.$row['name'].'</td>
        <td>'.$getDatabase->easy_date2($row['paydate']).'</td>
        <td>'.$row['deposit'].' '.$getCredit->get_option_value('currency').'</td>

      </tr>';

       } 
     ?>
      <tr>
        <td></td>
    <td><h4><span style="font-weight: 900;color: #000;text-align: center;">TOTAL : </span></h4></td>

    <td><h4><span style="font-weight: 900;color: #000;text-align: center;"><?php echo $st.' '.$getCredit->get_option_value('currency');?></span></h4></td>

  </tr>

</table> 
<?php } } ?>

 <?php if($type!=3){?>
        <table style="width:100%">
                <tr>  
                  <td style="text-align:left;"><h4><span style="font-weight: 900;color: #000;text-decoration: underline;">Expenses: <?php if($type==2) {?></th><td  style="width:300px;"> Date:- <?php echo $getDatabase->easy_date2($from);?> > <?php echo $getDatabase->easy_date2($to);?> <?php } ?></span></h4></td>
                </tr>
              </table>




<table style="width: 100%;">
 <tr class="card-header">
    <th>Description</th>
    <th>Date</th>
     <th>Amount</th>
  </tr>
  <?php 


  $ste=0; 

  foreach($rowse as $row){
 $ste+=$row['eamount'];
echo '<tr>
        <td>'.$row['enote'].'</td>
        <td>'.$getDatabase->easy_date2($row['edate']).'</td>
        <td>'.$row['eamount'].' '.$getCredit->get_option_value('currency').'</td>
       
      </tr>';

       } 
     ?>
      <tr>
        <td></td>
    <td><h4><span style="font-weight: 900;color: #000;text-align: center;">TOTAL : </span></h4></td>

    <td><h4><span style="font-weight: 900;color: #000;text-align: center;"><?php echo $ste.' '.$getCredit->get_option_value('currency');?></span></h4></td>

  </tr>

</table> 
<?php } ?>



<center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>

            </div>



<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>

</div>


<?php } ?>
              
             


  <?php
  break;

                case 'default':
                ?>
                <style type="text/css">
  .title
  {
    color:#687be5 !important;
    padding: 20px;
  }
  .title a{
     color:#687be5 !important;
  }
  .btn
  {
    width: 70px !important;
  }
</style>
                <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
<h3>Atlantique Formation Report</h3>
<div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
   
   
<div class="row"> 
             <div class="col-md-12 col-sm-12">
              <?php 
               if(isset($error)){
        foreach($error as $error){
            echo '<p class="errormsg">'.$error.'</p>';
        }
    }?>

  
   
      <div class="row"> 
      <div class="col-md-12" style="background: #eaf3ff;">  
      <h3> Reports </h3> 

      </div>
<div class="col-sm-6">
  <div class="row">
    <a href="report?detect=attendance">
      <h4 class="title">
        <button class="btn btn-primary btn-lg"><i class="fa fa-graduation-cap"></i></button>
        Student Attendance
        <i class="fa fa-arrow-right"></i>
      </h4>
    </a>
  </div>
</div>

<div class="col-sm-6">
  <div class="row">
    <a href="report?detect=salary">
      <h4 class="title">
        <button class="btn btn-warning btn-lg"><i class="fa fa-credit-card"></i></button>
        Teacher Salary Report
        <i class="fa fa-arrow-right"></i>
      </h4>
    </a>
  </div>
</div>

<div class="col-sm-6">
  <div class="row">
    <a href="report?detect=payment">
      <h4 class="title">
        <button class="btn btn-success btn-lg" style="background:#669955;border: 1px solid #669955;"><i class="fa fa-money"></i></button>
        Payment Inscription report
        <i class="fa fa-arrow-right"></i>
      </h4>
    </a>
  </div>
</div>

<div class="col-sm-6">
  <div class="row">
    <a href="report?detect=expense">
      <h4 class="title">
        <button class="btn btn-danger btn-lg" style="background:#5c79a5;border: 1px solid #5c79a5;"
><i class="fa fa-book"></i></button>
        Expense Report
        <i class="fa fa-arrow-right"></i>
      </h4>
    </a>
  </div>
</div>
<div class="col-sm-6">
  <div class="row">
    <a href="report?detect=cash">
      <h4 class="title">
        <button class="btn btn-danger btn-lg" style="background:#5c79a5;border: 1px solid #5c79a5;"
><i class="fa fa-dollar"></i></button>
        Cash Register Report
        <i class="fa fa-arrow-right"></i>
      </h4>
    </a>
  </div>
</div>


        

               </div>
               <div class="col-sm-3">
                 
        <div class="col-md-12 col-sm-12 ">
          <br>
       
      </div>
  

               </div>
</div>
                <?php
                break; 

}
  ?>

                   </div>
  <?php
  break; 

  case 'user': 
    ?> 
<div class="right_col" role="main">
          <div class="">
          

            <div class="clearfix"></div>

        

             <div class="row">
              <!-- form input mask -->
       

              <div class="col-md-12 col-sm-12"> 
                
                <div class="x_panel">
                  <div class="x_title">
                   
                   
                   
                  <div class="x_content">
<?php if(isset($_GET['detect'])) 
{
  $detect=$_GET['detect'];
}
else 
{
  $detect='default'; 
}
switch ($detect) {

  case 'attendance':
  ?> 
 
                        <?php 
                        
                        if(isset($_POST['subpost'])){
                          $cent_id=trim($_POST['cent_id']); 
                              $gid=trim($_POST['gid']); 
                                  $month=trim($_POST['month']); 
                                  $year = trim($_POST['year']);

                         
         if(!isset($error)){ 
$sql="SELECT * 
from presence
INNER JOIN schedual ON presence.sid=schedual.sid
INNER JOIN groups ON schedual.gid=groups.gid
INNER JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id='$user_id' AND centres.cent_id='$cent_id' AND groups.gid='$gid' AND MONTH(presence.prdate)='$month' AND YEAR(presence.prdate)='$year'
";
$count=$getCredit->count_by_query($sql);
if($count>0)
{
  $rows=$getCredit->get_by_query($sql);
  $hide =1; 
}
else 
{
 $error[]='No record found..';
}
                 }
                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?>

<?php if(!isset($hide)){?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Student Attendance </h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-12">
                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" id="cent_id" class="form-control" required>
         <option value="">Selectionner Centre </option> 
                          <?php 
                          $sql="SELECT * 
FROM centres 
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rows=$getCredit->get_by_id_query($sql,$user_id);
                      
 foreach($rows as $row)
 {
  echo '<option value="'.$row['cent_id'].'">'.$row['centre_name'].'</option>'; 
 }
        ?> 
                  
        </select>
  </div>

</div>
<div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Group</label>         
     <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 

//             $sql = "SELECT DISTINCT r.gname, r.gid 
//         FROM inscription i 
//         LEFT JOIN groups r ON i.gid = r.gid 
//         WHERE i.uid = :id";
// $rg=$getCredit->get_by_id_query($sql,$user_id);

//               foreach($rg as $arr)
//               {
//               echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
//               }
              ?>
     </select>

  </div>

</div>
<div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Month</label>
   <select name="month" class="form-control" required>
         <option value="">Selectionner Month </option> 
<?php 
$months = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12'
);

 foreach ($months as $month => $value) { ?>
        <option value="<?php echo $value; ?>"><?php echo $month; ?></option>
    <?php } ?>


?>
                  
        </select>
  </div>

</div>
<div class="col-sm-3">
  <div class="form-group">
    <label for="exampleInputEmail1">Year</label>
    <select name="year" class="form-control" required>
      <?php
      $currentYear = date('Y');
      for ($year = 2024; $year <= $currentYear; $year++) {
        $selected = ($year == $currentYear) ? 'selected' : '';
        echo "<option value='$year' $selected>$year</option>";
      }
      ?>
    </select>
  </div>
</div>



                  
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Download Report</button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
  </form>
         </div>
                </div>
                <script type="text/javascript">
  $(document).on('change', '#cent_id', function(){
  var fid= $('#cent_id').val();
  if(fid.trim() == '' ) {          
   alert('Please select a centere name'); 
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=gnamebycentre2",      
data: {fid: fid },
        beforeSend: function() {
           $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");
           },
        success: function(data){ 
            //alert(data);
            $("#gid").html(data);
    }});
}
 });

</script>

<?php } else { ?> 

              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"></div>
               </div>
             <div class="row">
    <div class="col-sm-12" style="text-align:center;">
  <div class="page-title">
<h1 style="color: #000;font-weight: 700;">Student Attendence Report</h1>
<div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Centre :</span> <?php echo $rowk['centre_name'];?></h4></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Group :</span> <?php echo $rowk['gname'];?></h4></td>
                  <td style="width:10%;"></td>
                </tr>
              </table>
<table style="width: 100%;">
 <tr class="card-header">
    <th>#</th>
    <th>Full Name</th>
     <th>Date Attend</th>
      <th>Attendence</th>
      <th></th>

  </tr>
  <?php $i=0;  $ip=0; foreach($rows as $row){
    if($row['pre']==1)
    {
      $ip++;
    }
echo '<tr>
         <td>#'.$row['prid'].'</td>
        <td>'.$row['name'].'</td>
        <td>'.$getDatabase->easy_date2($row['prdate']).'</td>
        <td>'.$getDatabase->ap($row['pre']).'</td>
        <td></td>
      </tr>';
      $i++; } 
     ?>
      <tr><td colspan="1"></td>
    <td><h4><span style="font-weight: 900;color: #000;">Presence Total : <?php echo $ip.'/'.$i?></span></h4></td>
    <td><h4><span style="font-weight: 900;color: #000;">Presence % : <?php echo $ip/$i*100;?> %</span></h4></td>
  </tr>

</table> <center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>
            </div>



<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>

</div>


<?php } ?>
              
             



  <?php
  break;
   case 'salary':
  ?> 
 
                        <?php 
                        
                        if(isset($_POST['subpost'])){
                          $id=trim($_POST['id']); 
                              $gid=trim($_POST['gid']); 
                                  $month=trim($_POST['month']); 
                                 $year = trim($_POST['year']);

                         
         if(!isset($error)){ 
$sql="SELECT DISTINCT sh.* ,ts_gtw_users.fname,ts_gtw_users.lname,groups.gname
from sh 
INNER JOIN ts_gtw_users ON sh.pid=ts_gtw_users.id
INNER JOIN schedual ON ts_gtw_users.id=schedual.pid
INNER JOIN groups ON schedual.gid=groups.gid
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE ts_gtw_users.id='$id' AND groups.gid='$gid' AND links.id='$user_id' AND MONTH(sh.shdate)='$month' AND YEAR(sh.shdate)='$year'
";
$count=$getCredit->count_by_query($sql);
if($count>0)
{
  $rows=$getCredit->get_by_query($sql);
  $hide =1; 
}
else 
{
 $error[]='No record found..';
}
                 }
                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?>

<?php if(!isset($hide)){?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Teacher Salary</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-12">
                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Teacher </label>
   <select name="id" class="form-control" required>
         <option value="">Selectionner Teacher </option> 
<?php $sql="SELECT ts_gtw_users.fname,ts_gtw_users.lname,ts_gtw_users.id 
FROM ts_gtw_users
LEFT JOIN centres ON ts_gtw_users.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rowsr=$getCredit->get_by_id_query($sql,$user_id); foreach($rowsr as $rowr){ echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';} ?>
                  
        </select>
  </div>

</div>
<div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Group</label>         
      <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 
             $sql="
SELECT DISTINCT r.gname, r.gid
FROM inscription i
LEFT JOIN groups r ON i.gid = r.gid
INNER JOIN centres c ON r.cnt_id=c.cent_id
INNER JOIN links l ON c.cent_id=l.cent_id
 WHERE l.id='$user_id'; 
";        
$rg=$getCredit->get_by_query($sql);

              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
              }
              ?>
     </select>

  </div>

</div>
<div class="col-sm-3"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Month</label>
   <select name="month" class="form-control" required>
         <option value="">Selectionner Month </option> 
<?php 
$months = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12'
);

 foreach ($months as $month => $value) { ?>
        <option value="<?php echo $value; ?>"><?php echo $month; ?></option>
    <?php } ?>


?>
                  
        </select>
  </div>

</div>
<div class="col-sm-3">
  <div class="form-group">
    <label for="exampleInputEmail1">Year</label>
    <select name="year" class="form-control" required>
      <?php
      $currentYear = date('Y');
      for ($year = 2024; $year <= $currentYear; $year++) {
        $selected = ($year == $currentYear) ? 'selected' : '';
        echo "<option value='$year' $selected>$year</option>";
      }
      ?>
    </select>
  </div>
</div>


                  
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Download Report</button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
  </form>
         </div>
                </div>
<?php } else { ?> 

              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"></div>
               </div>
             <div class="row">
    <div class="col-sm-12" style="text-align:center;">
  <div class="page-title">
<h1 style="color: #000;font-weight: 700;">Teacher Salary Report</h1>
<div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Teacher :</span> <?php echo $rowk['fname'].' '.$rowk['lname'];?></h4></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Group :</span> <?php echo $rowk['gname'];?></h4></td>
                  <td style="width:10%;"></td>
                </tr>
              </table>
<table style="width: 100%;">
 <tr class="card-header">
    <th>#</th>
    <th>Full Name</th>
     <th>Date</th>
      <th>Salary Amount</th>
      <th></th>

  </tr>
  <?php $st=0; foreach($rows as $row){
 $st+=$row['shamount'];
echo '<tr>
         <td>#'.$row['shid'].'</td>
        <td>'.$row['fname'].' '.$row['lname'].'</td>
        <td>'.$getDatabase->easy_date2($row['shdate']).'</td>
        <td>'.$row['shamount'].' '.$getCredit->get_option_value('currency').'</td>
        <td></td>
      </tr>';

       } 
     ?>
      <tr><td colspan="2"></td>
    <td><h4><span style="font-weight: 900;color: #000;float: right;">Salary Total : <?php echo $st.' '.$getCredit->get_option_value('currency');?></span></h4></td>
  
  </tr>

</table> <center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>

            </div>



<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>

</div>


<?php } ?>
              
             


  <?php
  break;
    case 'payment':
  ?> 
 
                        <?php 
                        
                        if(isset($_POST['subpost'])){
                          $cent_id=trim($_POST['cent_id']); 
                                  $month=trim($_POST['month']); 
                                 $year = trim($_POST['year']);

                         
         if(!isset($error)){ 
// $sql="SELECT * 
// from payments
// INNER JOIN groups ON payments.gid=groups.gid
// INNER JOIN inscription ON groups.gid=inscription.gid
// LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
// LEFT JOIN centres ON registrations.cent_id=centres.cent_id
// WHERE payments.uid='$user_id' AND centres.cent_id='$cent_id' AND MONTH(payments.paydate)='$month' AND YEAR(payments.paydate)='$year'
// ";

  $sql = "SELECT DISTINCT 
          p.pay_id, 
          p.reg_id, 
          p.gid, 
          p.deposit, 
          r.name, 
          p.paydate, 
          c.centre_name, 
          r.cent_id,
          g.gname
        FROM 
          payments p
     LEFT JOIN 
          groups g ON p.gid = g.gid
        LEFT JOIN 
          registrations r ON p.reg_id = r.reg_id

        LEFT JOIN 
          centres c ON r.cent_id = c.cent_id
          INNER JOIN links l ON c.cent_id=l.cent_id

        WHERE 
          r.cent_id = '$cent_id' AND  l.id='$user_id'
          AND MONTH(p.paydate)='$month'
          AND YEAR(p.paydate)='$year'
        ORDER BY 
          p.paydate ASC";
$count=$getCredit->count_by_query($sql);
if($count>0)
{
  $rows=$getCredit->get_by_query($sql);
  $hide =1; 
}
else 
{
 $error[]='No record found..';
}
                 }
                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?>

<?php if(!isset($hide)){?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Payment Inscription</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-9">
                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" required>
         <option value="">Selectionner Centre </option> 
                          <?php 
                          $sql="SELECT * 
FROM centres 
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rows=$getCredit->get_by_id_query($sql,$user_id);
                      
 foreach($rows as $row)
 {
  echo '<option value="'.$row['cent_id'].'">'.$row['centre_name'].'</option>'; 
 }
        ?> 
                  
        </select>
  </div>

</div>

<div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Month</label>
   <select name="month" class="form-control" required>
         <option value="">Selectionner Month </option> 
<?php 
$months = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12'
);

 foreach ($months as $month => $value) { ?>
        <option value="<?php echo $value; ?>"><?php echo $month; ?></option>
    <?php } ?>


?>
                  
        </select>
  </div>

</div>
<div class="col-sm-4">
  <div class="form-group">
    <label for="exampleInputEmail1">Year</label>
    <select name="year" class="form-control" required>
      <?php
      $currentYear = date('Y');
      for ($year = 2024; $year <= $currentYear; $year++) {
        $selected = ($year == $currentYear) ? 'selected' : '';
        echo "<option value='$year' $selected>$year</option>";
      }
      ?>
    </select>
  </div>
</div>


                  
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Download Report</button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
  </form>
         </div>
                </div>
<?php } else { ?> 

              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"></div>
               </div>
             <div class="row">
    <div class="col-sm-12" style="text-align:center;">
  <div class="page-title">
<h1 style="color: #000;font-weight: 700;">Payment Inscriptions Report</h1>
<div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Centre :</span> <?php echo $rowk['centre_name'];?></h4></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Month :</span> <?php echo $getDatabase->easy_date3($rowk['paydate']);?></h4></td>
                  <td style="width:10%;"></td>
                </tr>
              </table>
<table style="width: 100%;">
 <tr class="card-header">
    <th>#</th>
    <th>Full Name</th>
     <th>Group Name</th>
      <th>Payment Date</th>
      <th>Deposit</th>
      <th></th>

  </tr>
  <?php $st=0; foreach($rows as $row){
 $st+=$row['deposit'];
echo '<tr>
         <td>#'.$row['pay_id'].'</td>
        <td>'.$row['name'].'</td>
         <td>'.$row['gname'].'</td>
        <td>'.$getDatabase->easy_date2($row['paydate']).'</td>
        <td>'.$row['deposit'].' '.$getCredit->get_option_value('currency').'</td>
        <td></td>
      </tr>';

       } 
     ?>
      <tr><td colspan="2"></td>
    <td><h4><span style="font-weight: 900;color: #000;float: right;"> Total Deposits : </span></h4></td>
    <td><h4><span style="font-weight: 900;color: #000;float: right;"><?php echo $st.' '.$getCredit->get_option_value('currency');?></span></h4></td>
  
  </tr>

</table> <center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>

            </div>



<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>

</div>


<?php } ?>
              
             


  <?php
  break;
    case 'expense':
  ?> 
 
                        <?php 
                        
                        if(isset($_POST['subpost'])){
                          $cent_id=trim($_POST['cent_id']); 
                                  $month=trim($_POST['month']); 
                                 $year = trim($_POST['year']);

                         
         if(!isset($error)){ 
$sql="SELECT * 
from expenses
LEFT JOIN centres ON expenses.cent_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id='$user_id' AND centres.cent_id='$cent_id' AND MONTH(expenses.edate)='$month' AND YEAR(expenses.edate)='$year'
";

$count=$getCredit->count_by_query($sql);
if($count>0)
{
  $rows=$getCredit->get_by_query($sql);
  $hide =1; 
}
else 
{
 $error[]='No record found..';
}
                 }
                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?>

<?php if(!isset($hide)){?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Expenses</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-9">
                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
  <select name="cent_id" class="form-control" required>
         <option value="">Selectionner Centre </option> 
                          <?php 
                          $sql="SELECT * 
FROM centres 
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rows=$getCredit->get_by_id_query($sql,$user_id);
                      
 foreach($rows as $row)
 {
  echo '<option value="'.$row['cent_id'].'">'.$row['centre_name'].'</option>'; 
 }
        ?> 
                  
        </select>
  </div>

</div>

<div class="col-sm-4"> 
                        <div class="form-group">
    <label for="exampleInputEmail1">Month</label>
   <select name="month" class="form-control" required>
         <option value="">Selectionner Month </option> 
<?php 
$months = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12'
);

 foreach ($months as $month => $value) { ?>
        <option value="<?php echo $value; ?>"><?php echo $month; ?></option>
    <?php } ?>


?>
                  
        </select>
  </div>

</div>
<div class="col-sm-4">
  <div class="form-group">
    <label for="exampleInputEmail1">Year</label>
    <select name="year" class="form-control" required>
      <?php
      $currentYear = date('Y');
      for ($year = 2024; $year <= $currentYear; $year++) {
        $selected = ($year == $currentYear) ? 'selected' : '';
        echo "<option value='$year' $selected>$year</option>";
      }
      ?>
    </select>
  </div>
</div>


                  
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Download Report</button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
  </form>
         </div>
                </div>
<?php } else { ?> 

              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"></div>
               </div>
             <div class="row">
    <div class="col-sm-12" style="text-align:center;">
  <div class="page-title">
<h1 style="color: #000;font-weight: 700;">Expenses Report</h1>
<div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Centre :</span> <?php echo $rowk['centre_name'];?></h4></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">Month :</span> <?php echo $getDatabase->easy_date3($rowk['edate']);?></h4></td>
                  <td style="width:10%;"></td>
                </tr>
              </table>
<table style="width: 100%;">
 <tr class="card-header">
    <th>#</th>
    <th>Charge Type</th>
     <th>Note</th>
      <th>Payment Date</th>
      <th>Deposit</th>
      <th></th>

  </tr>
  <?php $st=0; foreach($rows as $row){
 $st+=$row['eamount'];
echo '<tr>
         <td>#'.$row['exid'].'</td>
        <td>'.$row['etype'].'</td>
         <td>'.$row['enote'].'</td>
        <td>'.$getDatabase->easy_date2($row['edate']).'</td>
        <td>'.$row['eamount'].' '.$getCredit->get_option_value('currency').'</td>
        <td></td>
      </tr>';

       } 
     ?>
      <tr><td colspan="2"></td>
    <td><h4><span style="font-weight: 900;color: #000;float: right;"> Total Charges : </span></h4></td>
    <td><h4><span style="font-weight: 900;color: #000;float: right;"><?php echo $st.' '.$getCredit->get_option_value('currency');?></span></h4></td>
  
  </tr>

</table> <center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>

            </div>



<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>

</div>


<?php } ?>
              
             


  <?php
  break;

                case 'default':
                ?>
                <style type="text/css">
  .title
  {
    color:#687be5 !important;
    padding: 20px;
  }
  .title a{
     color:#687be5 !important;
  }
  .btn
  {
    width: 70px !important;
  }
</style>
                <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
<h3>Atlantique Formation Report</h3>
<div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
   
   
<div class="row"> 
             <div class="col-md-12 col-sm-12">
              <?php 
               if(isset($error)){
        foreach($error as $error){
            echo '<p class="errormsg">'.$error.'</p>';
        }
    }?>

  
   
      <div class="row"> 
      <div class="col-md-12" style="background: #eaf3ff;">  
      <h3> Reports </h3> 

      </div>
<div class="col-sm-6">
  <div class="row">
    <a href="report?detect=attendance">
      <h4 class="title">
        <button class="btn btn-primary btn-lg"><i class="fa fa-graduation-cap"></i></button>
        Student Attendance
        <i class="fa fa-arrow-right"></i>
      </h4>
    </a>
  </div>
</div>

<div class="col-sm-6">
  <div class="row">
    <a href="report?detect=salary">
      <h4 class="title">
        <button class="btn btn-warning btn-lg"><i class="fa fa-credit-card"></i></button>
        Teacher Salary Report
        <i class="fa fa-arrow-right"></i>
      </h4>
    </a>
  </div>
</div>

<div class="col-sm-6">
  <div class="row">
    <a href="report?detect=payment">
      <h4 class="title">
        <button class="btn btn-success btn-lg" style="background:#669955;border: 1px solid #669955;"><i class="fa fa-money"></i></button>
        Payment Inscription report
        <i class="fa fa-arrow-right"></i>
      </h4>
    </a>
  </div>
</div>
<div class="col-sm-6">
  <div class="row">
    <a href="report?detect=expense">
      <h4 class="title">
        <button class="btn btn-danger btn-lg" style="background:#5c79a5;border: 1px solid #5c79a5;"
><i class="fa fa-book"></i></button>
        Expense Report
        <i class="fa fa-arrow-right"></i>
      </h4>
    </a>
  </div>
</div>
     </div>
               <div class="col-sm-3">
                 
        <div class="col-md-12 col-sm-12 ">
          <br>
       
      </div>
  

               </div>
</div>
                <?php
                break; 

}
  ?>

                   </div>
  <?php
  break;  
  default :
  header("location:index");
  break; 
  
}
                ?>


          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    <!-- Select Input Search -->
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

  <!-- Include Select2 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function() {
      $('select[name="reg_id"]').select2();
    });
  </script>
  
  <style>
      .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ced4da !important;
            font-size: 1rem;
            font-weight: 400;
            color: #495057;
            border-radius: 4px;
            border-radius: 25px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 6px !important;
        }
  </style>
    <!-- /Select Input Search -->
    
   <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
  </body>
</html>