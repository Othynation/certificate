<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
       include("functions.php");
?>
<?php include("header.php"); 
// if($postm!='admin'){header("location:index");exit();}
?>
<style type="text/css">
  .sch
  {
     background: #b4daff;
    padding: 10px;
    border-radius: 10px;
    color: #000;
    line-height: 40px;
   }
     .dot {
     height: 7px;
    width: 7px;
    background-color: #0165c3;
     border-radius: 50%;
    display: inline-block;

}

  .table td, .table th {
    padding: .30rem !important;
    border-top: 1px solid #dee2e6;
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
  case 'add':
  ?> 
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Ajouter une Group</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <div class="row">
                    
                    <div class="col-md-10">
                        <?php 

                        if(isset($_POST['subpost'])){

                          $gname = $_POST['gname'];
                          $count=$getCredit->count_by_string('groups','gname',$gname);
                          if($count>0)
                          {
                            $error[]='This group name is already created';
                          }

$fid = $_POST['fid'];
$classno = $_POST['classno'];
$nomformation = $_POST['nomformation'];
$gstatus = $_POST['gstatus'];
$from=$_POST['from'];
$to=$_POST['to']; 
$pid=$_POST['pid'];  
$classroom=$_POST['classroom']; 
$sdate=$_POST['sdate'];
$salary_type=$_POST['salary_type'];
$samount=$_POST['samount'];
$cent_id=$_POST['cent_id'];
         if(!isset($error)){ 
 $lastid = $getCer->insert_group($gname, $fid, $classno, $nomformation, $gstatus,$user_id,$cent_id);
           if($lastid>0)
    {
for ($i=0; $i < count($sdate); $i++) { 
$from1 = $from[$i];
$to1 = $to[$i];
$pid1 = $pid[$i];
$classroom1 = $classroom[$i];
 $sdate1=$sdate[$i];
 $st=$salary_type[$i];
 $sm=$samount[$i];
$day1=$getDatabase->getDayNumber($getDatabase->easy_dayname($sdate1));
$countp=$getCredit->count_by_string_two_col('schedual','pid',$pid1,'gid',$lastid);
if($countp>0){
 $rows=$getCredit->get_by_string_two_col('schedual','pid',$pid1,'gid',$lastid);
 foreach($rows as $row)
 {
$st=$row['salary_type'];
$sm=$row['samount'];
 } 
}

 $result=$getCer->insert_schedule($day1,$from1,$to1,$pid1,$classroom1,$lastid,$sdate1,$st,$sm);
}
  
if($result)
{
 header("Location:group?action=Added");  
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
  }
    else{
      $error[] ='Failed : Something went wrong';
    }
 }
 } 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
} 

 ?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Formation</label>
   <select name="fid" id="fid" class="form-control" required>
         <option value="">Selectionner Formation </option> 
<?php 
$rows = $getCredit->fetch_all('formation', 'formation_name', 'ASC'); // Fetch data ordered by formation_name ascending
foreach($rows as $row) {
    echo '<option value="'.$row['fid'].'">'.$row['formation_name'].'</option>'; 
}
?>

                  
        </select>
  </div>
                       </div>

                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Group Name</label>
     <input type="text" name="gname" id="gid" class="form-control" required>

  </div>


                      </div>
                      


                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. classes per week</label>
     <select name="classno" id="classno" class="form-control" required>
        <option value="">Select</option>
        <?php for ($i=1; $i <=7; $i++) { 
  echo '<option value="'.$i.'">'.$i.'</option>'; 
 }
        ?> 
     </select>
  </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. of month formation </label>
     <select name="nomformation" class="form-control" required>
        <option value="">Select</option>
        <?php for ($i=1; $i <=12; $i++) { 
  echo '<option value="'.$i.'">'.$i.'</option>'; 
 }
        ?> 
     </select>
  </div>

                      </div>
                        </div>
                         <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" required>
         <option value="">Selectionner Centre </option> 
<?php 
$rows = $getCredit->fetch_all('centres', 'centre_name', 'ASC'); // Fetch data ordered by formation_name ascending
foreach($rows as $row) {
    echo '<option value="'.$row['cent_id'].'">'.$row['centre_name'].'</option>'; 
}
?>
                  
        </select>
  </div>
                       </div>

     <div class="col-sm-12">
                       <div id="aparea"> </div>
                     </div>
 
  <div class="col-sm-6">
    <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
     <select name="gstatus" class="form-control" required>
      <option value="">Select Status</option>
       <option value="1">Active</option>
        <option value="2">Inactive</option>
         <option value="0">Termine</option>
         
     </select>
  </div>
</div>

                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Group</button>
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
                  $(document).on('change', '#classno', function(){
  var classno= $('#classno').val();
  
       $('#aparea').empty();
for (var i = 1; i <= classno; i++) {
     $('#aparea').append('<div class="row sch" style="margin-bottom: 5px;">'+
'<div class="col-md-2.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1"><span class="dot"></span> Schedule Day '+ i +': Begin Date</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<input type="date" id="sdate" name="sdate[]" class="form-control" required>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">From:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="from[]" id="from" class="from-select form-control" required>'+
'<option value="">Select</option>'+
'<?php for ($i = 6; $i <= 22; $i++) { ?>'+
'<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>'+
'<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>'+
'<?php } ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">To:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="to[]" id="to"  class="to-select form-control" required>'+
'<option value="">Select</option>'+
'<?php for ($i = 6; $i <= 22; $i++) { ?>'+
'<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>'+
'<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>'+
'<?php } ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1">'+
'<div class="form-group">'+
'<label>Prof:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="pid[]" class="form-control" required>'+
'<option value="">Select</option>'+
'<?php $rowsr=$getCredit->get_by_string('ts_gtw_users','post','prof'); foreach($rowsr as $rowr){ echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';} ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">Classroom</label>'+
'</div>'+
'</div>'+
'<div class="col-md-3">'+
'<div class="form-group">'+
'<select name="classroom[]" class="room-select form-control" required>'+
'<option value="">Select</option>'+
'<?php $rowsrp=$getCredit->fetch_all('classroom','clsid','ASC'); foreach($rowsrp as $rowrp){ echo '<option value="'.$rowrp['clsid'].'">'.$rowrp['classname'].'</option>';} ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5"><div class="form-group"><label for="exampleInputEmail1">Salary Type</label></div></div> <div class="col-md-3"><div class="form-group"><select name="salary_type[]" id="salary_type" class="form-control" required><option value="" disabled selected>Salary Type</option><option value="1">Per Month</option><option value="2">Per Hour</option><option value="3">Per Student </option></select></div></div> <div class="col-md-2"><div class="form-group"><input type="number" name="samount[]" id="smount" class="form-control" required placeholder="Salary Amount"></div> </div> </div>');


}

 });
                 



$('#aparea').on('change', '.from-select', function() {
  var fromTime = $(this).val();
  var toDropdown = $(this).closest('.row.sch').find('.to-select');
  toDropdown.val(''); // Clear the selected value
  // Disable options in the "To" dropdown
  toDropdown.find('option').each(function() {
    var toTime = $(this).val();
    if (toTime <= fromTime) {
      $(this).prop('disabled', true).css({
        'background-color': '#ccc', // disabled color
        'color': '#666' // disabled text color
      });
    } else {
      $(this).prop('disabled', false).css({
        'background-color': '', // reset background color
        'color': 'black' // reset text color to black
      });
    }
  });
});
 $(document).on('change', '#fid', function(){
  var fid= $('#fid').val();
  if(fid.trim() == '' ) {          
   alert('Please select a formation'); 

            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=gname",      
data: {fid: fid },
        beforeSend: function() {
           $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");
           },
        success: function(data){ 
            //alert(data);
            $("#gid").val(data);
    }});
}
 });

var selectedSchedules = [];

$(document).on('change', '.from-select, .to-select', function() {
    var roomSelect = $(this).closest('.row').find('.room-select');
    roomSelect.val(''); // or roomSelect.prop('selectedIndex', 0);
});
$(document).on('change', '.room-select', function() {
  var roomId = $(this).closest('.row').find('.room-select').val();
  var fromTime = $(this).closest('.row').find('.from-select').val();
  var toTime = $(this).closest('.row').find('.to-select').val();
  var scheduleIndex = $(this).closest('.row').index();

  // //Check if selected combination already exists in the array
  // var existingSchedule = selectedSchedules.find((schedule, index) => schedule.roomId === roomId && schedule.fromTime === fromTime && schedule.toTime === toTime && schedule.index === scheduleIndex);

  // if (existingSchedule) {
  //   alert('Room already busy during this time slot.');
  //   return;
  // }

  // Send AJAX request to server-side validation
  $.ajax({
    type: 'POST',
    url: 'action?detect=slotvalidate',
    data: {
      roomId: roomId,
      fromTime: fromTime,
      toTime: toTime
    },
    success: function(response) {
      //alert(response);
      var res = response.trim();
      if (res =='busy') {
        alert('Room already busy during this time slot.');
        // Reset select options
        $(this).closest('.row').find('.room-select').val('');
        $(this).closest('.row').find('.from-select').val('');
        $(this).closest('.row').find('.to-select').val('');
      } else {
        selectedSchedules.push({
          roomId: roomId,
          fromTime: fromTime,
          toTime: toTime,
          index: scheduleIndex
        });
      }
    }
  });
});


</script>
  <?php 
  break; 
  case 'edit':
  $id=$_GET['id'];
  ?> 
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Modifier Group</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
                          $sql="SELECT * 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
 WHERE groups.gid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $rm)
{
  $dbgname=$rm['gname'];
}
                        if(isset($_POST['subpost'])){
                          $gname=$_POST['gname'];
                          if($gname!=$dbgname)
                          {
                            $count=$getCredit->count_by_string('groups','gname',$gname);
                          if($count>0)
                          {
                            $error[]='This group name is already created';
                          }
                          }
$fid = $_POST['fid'];
$classno = $_POST['classno'];
$nomformation = $_POST['nomformation'];
$gstatus = $_POST['gstatus'];
$from=$_POST['from'];
$to=$_POST['to']; 
$pid=$_POST['pid'];  
$sdate=$_POST['sdate'];
$sid=$_POST['sid'];
if(isset($_POST['sparent_id']))
{
 $sparent_id=$_POST['sparent_id'];  
}

$classroom=$_POST['classroom'];
$salary_type=$_POST['salary_type'];
$samount=$_POST['samount'];
$cent_id=$_POST['cent_id'];
         if(!isset($error)){ 
$result=$lastid = $getCer->update_group($gname, $fid, $classno, $nomformation, $gstatus,$cent_id,$id);
           if($result)
    {
$rm=$getCredit->delete_by_id('schedual','gid',$id);
if($rm)
{
  $ss=count($sdate); 
  for ($i=0; $i < count($sdate); $i++) { 
$from1 = $from[$i];
$to1 = $to[$i];
$pid1 = $pid[$i];
$classroom1 = $classroom[$i];
 $sdate1=$sdate[$i];
 $si1 = $sid[$i];
 if(isset($_POST['sparent_id'])){
  $sparent = $sparent_id[$i];
  if($sparent=='')
  {
    $sparent=NULL; 
  }
}
  $st=$salary_type[$i];
 $sm=$samount[$i];
$day1=$getDatabase->getDayNumber($getDatabase->easy_dayname($sdate1)); 
$countp=$getCredit->count_by_string_two_col('schedual','pid',$pid1,'gid',$id);
if($countp>0){
 $rows=$getCredit->get_by_string_two_col('schedual','pid',$pid1,'gid',$id);
 foreach($rows as $row)
 {
$st=$row['salary_type'];
$sm=$row['samount'];
 } 
}

if($si1>0)
{
 $res=$getCer->insert_schedule4($day1,$from1,$to1,$pid1,$classroom1,$id,$sdate1,$si1,$st,$sm,$sparent);
}
else 
{
  $res=$getCer->insert_schedule($day1,$from1,$to1,$pid1,$classroom1,$id,$sdate1,$st,$sm); 
}


}
 $getCer->update_group2($ss,$id);
}
if($res)
{
 echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
  }
    else{
      $error[] ='Failed : Something went wrong';
    }
 
 }
                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
   $sql="SELECT * 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
LEFT JOIN centres ON groups.cnt_id=centres.cent_id
 WHERE groups.gid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
  $gid=$row['gid'];
?>
                    <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Group Name</label>
     <input type="text" name="gname" value="<?php echo $row['gname'];?>" class="form-control" required>

  </div>


                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Formation</label>
   <select name="fid" class="form-control" required>
      <option value="<?php echo $row['fid'];?>" style="background: #CBCDD1;"><?php echo $row['formation_name'];?></option>
<?php 
$rows = $getCredit->fetch_all('formation', 'formation_name', 'ASC'); // Fetch data ordered by formation_name ascending
foreach($rows as $rowi) {
    echo '<option value="'.$rowi['fid'].'">'.$rowi['formation_name'].'</option>'; 
}
?>

                  
        </select>
  </div>
                       </div>


                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. classes per week</label>
     <select name="classno" id="classno" class="form-control" required>
       <option value="<?php echo $row['classno'];?>" style="background: #CBCDD1;"><?php echo $row['classno'];?></option>
        <?php for ($i=1; $i <=7; $i++) { 
  echo '<option value="'.$i.'">'.$i.'</option>'; 
 }
        ?> 
     </select>
  </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. of month formation </label>
     <select name="nomformation" class="form-control" required>
   <option value="<?php echo $row['nomformation'];?>" style="background: #CBCDD1;"><?php echo $row['nomformation'];?></option>
        <?php for ($i=1; $i <=12; $i++) { 
  echo '<option value="'.$i.'">'.$i.'</option>'; 
 }
        ?> 
     </select>
  </div>

                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" >
       <option value="<?php echo $row['cent_id'];?>" style="background: #CBCDD1;"><?php echo $row['centre_name'];?></option>
 <?php $rows=$getCredit->fetch_all('centres','cent_id','DESC'); 
 foreach($rows as $rowc)
 {
  echo '<option value="'.$rowc['cent_id'].'">'.$rowc['centre_name'].'</option>'; 
 }
        ?> 
                  
        </select>
  </div>
                       </div>



                     
                        </div>
                       <?php 
$sql = "SELECT schedual.samount, schedual.sdate, schedual.sto, schedual.sfrom, ts_gtw_users.fname, ts_gtw_users.lname, ts_gtw_users.id, schedual.salary_type, classroom.classname, classroom.clsid, schedual.gid, schedual.sid, schedual.sparent_id
FROM schedual 
LEFT JOIN ts_gtw_users ON schedual.pid = ts_gtw_users.id
LEFT JOIN classroom ON schedual.classroom = classroom.clsid
WHERE schedual.gid = :id";
$rows = $getCredit->get_by_id_query($sql, $gid);
$nm = 1;

foreach ($rows as $r) {
    if ($r['sparent_id'] == NULL) { 
        ?>
        <div class="row sch" style="margin-bottom: 5px;" id="sch_<?php echo $nm; ?>">
            <div class="col-md-2.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">
                        <span class="dot"></span>
                        Schedule Day <?php echo $nm; ?> : Begin Date
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="date" value="<?php echo $r['sdate']; ?>" min="<?php echo $r['sdate']; ?>" name="sdate[]" class="form-control" required>
                    <input type="hidden" name="sid[]" value="<?php echo $r['sid']; ?>">
                    <input type="hidden" name="sparent_id[]" value="<?php echo $r['sparent_id']; ?>">
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">From:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="from[]" class="from-select form-control" required>
                        <option value="<?php echo $r['sfrom']; ?>" style="background: #CBCDD1;"><?php echo $r['sfrom']; ?></option>
                        <?php for ($i = 6; $i <= 22; $i++) { ?>
                        <option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>
                        <option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">To:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="to[]" class="to-select form-control" required>
                        <option value="<?php echo $r['sto']; ?>" style="background: #CBCDD1;"><?php echo $r['sto']; ?></option>
                        <?php
                        $fromTime = $r['sfrom'];
                        for ($i = 6; $i <= 22; $i++) {
                            $optionValue = sprintf("%02d:00", $i);
                            $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
                            echo "<option value='$optionValue' $disabled>$optionValue</option>";

                            $optionValue = sprintf("%02d:30", $i);
                            $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
                            echo "<option value='$optionValue' $disabled>$optionValue</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Prof:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="pid[]" class="form-control" required>
                        <option value="<?php echo $r['id']; ?>" style="background: #CBCDD1;"><?php echo $r['fname'] . ' ' . $r['lname']; ?></option>
                        <?php
                        $rowsr = $getCredit->get_by_string('ts_gtw_users', 'post', 'prof');
                        foreach ($rowsr as $rowr) {
                            echo '<option value="' . $rowr['id'] . '">' . $rowr['fname'] . ' ' . $rowr['lname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="exampleInputEmail1">Classroom</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="classroom[]" class="form-control" required>
                        <option value="<?php echo $r['clsid']; ?>" style="background: #CBCDD1;"><?php echo $r['classname']; ?></option>
                        <?php
                        $rowsrp = $getCredit->fetch_all('classroom', 'clsid', 'ASC');
                        foreach ($rowsrp as $rowrp) {
                            echo '<option value="' . $rowrp['clsid'] . '">' . $rowrp['classname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Salary Type</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="salary_type[]" id="salary_type" class="form-control" required>
                        <option value="<?php echo $r['salary_type']; ?>" style="background: #1bade8;"><?php echo $getDatabase->getSalaryType($r['salary_type']); ?></option>
                        <option value="1">Per Month</option>
                        <option value="2">Per Hour</option>
                        <option value="3">Per Student</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="number" value="<?php echo $r['samount']; ?>" name="samount[]" id="smount" class="form-control" required placeholder="Salary Amount">
                </div>
            </div>
            <div class="col-sm-1">
                <button type="button" name="remove" id="<?php echo $nm; ?>" class="btn btn-danger btn_remove">X</button>
            </div>
        </div>
        <?php
        foreach ($rows as $child) {
            if ($child['sparent_id'] == $r['sid']) { 
                ?>
                <div class="row sch" style="margin-bottom: 5px; margin-left: 30px;background: #9d99d9;" id="sch_<?php echo $nm; ?>_child" data-parent="<?php echo $nm; ?>">
                    <!-- Repeat the same fields for child here -->
                    <div class="col-md-2.5">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                <span class="dot"></span>
                                Child Schedule : Begin Date
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" value="<?php echo $child['sdate']; ?>" min="<?php echo $child['sdate']; ?>" name="sdate[]" class="form-control" required>
                            <input type="hidden" name="sid[]" value="<?php echo $child['sid']; ?>">
                            <input type="hidden" name="sparent_id[]" value="<?php echo $child['sparent_id']; ?>">
                        </div>
                    </div>
                     <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">From:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="from[]" class="from-select form-control" required>
                        <option value="<?php echo $r['sfrom']; ?>" style="background: #CBCDD1;"><?php echo $r['sfrom']; ?></option>
                        <?php for ($i = 6; $i <= 22; $i++) { ?>
                        <option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>
                        <option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">To:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="to[]" class="to-select form-control" required>
                        <option value="<?php echo $r['sto']; ?>" style="background: #CBCDD1;"><?php echo $r['sto']; ?></option>
                        <?php
                        $fromTime = $r['sfrom'];
                        for ($i = 6; $i <= 22; $i++) {
                            $optionValue = sprintf("%02d:00", $i);
                            $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
                            echo "<option value='$optionValue' $disabled>$optionValue</option>";

                            $optionValue = sprintf("%02d:30", $i);
                            $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
                            echo "<option value='$optionValue' $disabled>$optionValue</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Prof:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="pid[]" class="form-control" required>
                        <option value="<?php echo $r['id']; ?>" style="background: #CBCDD1;"><?php echo $r['fname'] . ' ' . $r['lname']; ?></option>
                        <?php
                        $rowsr = $getCredit->get_by_string('ts_gtw_users', 'post', 'prof');
                        foreach ($rowsr as $rowr) {
                            echo '<option value="' . $rowr['id'] . '">' . $rowr['fname'] . ' ' . $rowr['lname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="exampleInputEmail1">Classroom</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="classroom[]" class="form-control" required>
                        <option value="<?php echo $r['clsid']; ?>" style="background: #CBCDD1;"><?php echo $r['classname']; ?></option>
                        <?php
                        $rowsrp = $getCredit->fetch_all('classroom', 'clsid', 'ASC');
                        foreach ($rowsrp as $rowrp) {
                            echo '<option value="' . $rowrp['clsid'] . '">' . $rowrp['classname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Salary Type</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="salary_type[]" id="salary_type" class="form-control" required>
                        <option value="<?php echo $r['salary_type']; ?>" style="background: #1bade8;"><?php echo $getDatabase->getSalaryType($r['salary_type']); ?></option>
                        <option value="1">Per Month</option>
                        <option value="2">Per Hour</option>
                        <option value="3">Per Student</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="number" value="<?php echo $r['samount']; ?>" name="samount[]" id="smount" class="form-control" required placeholder="Salary Amount">
                </div>
            </div>
            <div class="col-sm-1">
                <button type="button" name="remove" id="<?php echo $nm; ?>" class="btn btn-danger btn_remove">X</button>
            </div>
                </div>
                <?php
            }
        }
        $nm++;
    }
}
?>


<!--dd-->
                       <div id="aparea"> </div>
<div class="row">
  <div class="col-sm-12">
         <center><div id="addRowBtn" class="btn btn-warning" style="cursor: pointer;">+ Add More Schedule</div></center>
  </div>
</div>
                  

  <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
      <select name="gstatus" class="form-control">
 <option value="<?php echo $row['gstatus'];?>" style="background: #CBCDD1;"><?php echo $getCredit->status_hr2($row['gstatus']);?></option>
       <option value="1">Active</option>
        <option value="2">Inactive</option>
         <option value="0">Termine</option>
         
     </select>

  </div></div>

                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Group</button>
                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 
  
 

  </form>

<?php } ?>
              
                    </div>
                </div>
                <script type="text/javascript">
                  $('.from-select').on('change', function() {
  var fromTime = $(this).val();
  var toDropdown = $(this).closest('.row.sch').find('.to-select');
  toDropdown.val(''); // Clear the selected value
  toDropdown.find('option').each(function() {
    var toTime = $(this).val();
    if (toTime <= fromTime) {
      $(this).prop('disabled', true).css({
        'background-color': '#ccc', // disabled color
        'color': '#666' // disabled text color
      });
    } else {
      $(this).prop('disabled', false).css({
        'background-color': '', // reset background color
        'color': 'black' // reset text color to black
      });
    }
  });
});


$(document).ready(function() {
    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        var parent_id = $(this).closest('.sch').attr('data-parent');

        // Remove current schedule
        $(this).closest('.sch').css('background', 'red').fadeOut('slow', function() {
            $(this).remove();
        });

        // If removing a parent schedule, remove all child schedules
        if (parent_id == undefined) {
            $('[data-parent="' + button_id + '"]').css('background', 'red').fadeOut('slow', function() {
                $(this).remove();
            });
        }
    });
});



        $(document).ready(function() {
var rowNum = <?php echo $nm;?>;
$("#addRowBtn").click(function() {
  $('#aparea').append('<div class="row sch" style="margin-bottom: 5px;" id="sch_'+ rowNum +'">'+
'<div class="col-md-2.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1"><span class="dot"></span> Schedule Day '+ rowNum +' Begin Date </label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<input type="date" name="sdate[]" class="form-control" required>'+
'<input type="hidden" name="sid[]" value="0" class="form-control" required>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">From:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="from[]" class="from-select form-control" required>'+
'<option value="">Select</option>'+
'<?php for ($i = 6; $i <= 22; $i++) { ?>'+
'<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>'+
'<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>'+
'<?php } ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">To:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="to[]" class="to-select form-control" required>'+
'<option value="">Select</option>'+
'<?php for ($i = 6; $i <= 22; $i++) { ?>'+
'<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>'+
'<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>'+
'<?php } ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">Prof:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="pid[]" class="form-control" required>'+
'<option value="">Select</option>'+
'<?php $rowsr=$getCredit->get_by_string('ts_gtw_users','post','prof'); foreach($rowsr as $rowr){ echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';} ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">Classroom</label>'+
'</div>'+
'</div>'+
'<div class="col-md-3">'+
'<div class="form-group">'+
'<select name="classroom[]" class="form-control" required>'+
'<?php $rowsrp=$getCredit->fetch_all('classroom','clsid','ASC'); foreach($rowsrp as $rowrp){ echo '<option value="'.$rowrp['clsid'].'">'.$rowrp['classname'].'</option>';} ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5"><div class="form-group"><label for="exampleInputEmail1">Salary Type</label></div></div> <div class="col-md-3"><div class="form-group"><select name="salary_type[]" id="salary_type" class="form-control" required><option value="" disabled selected>Salary Type</option><option value="1">Per Month</option><option value="2">Per Hour</option><option value="3">Per Student </option></select></div></div> <div class="col-md-3"><div class="form-group"><input type="number" name="samount[]" id="smount" class="form-control" required placeholder="Salary Amount"></div> </div> '+
'<div class="col-sm-1">'+
'<button type="button" name="remove" id="'+ rowNum +'" class="btn btn-danger btn_remove">X</button>'+
'</div>'+
'</div>');


rowNum++;
})
});

$('#aparea').on('change', '.from-select', function() {
  var fromTime = $(this).val();
  var toDropdown = $(this).closest('.row.sch').find('.to-select');
  toDropdown.val(''); // Clear the selected value
  // Disable options in the "To" dropdown
  toDropdown.find('option').each(function() {
    var toTime = $(this).val();
    if (toTime <= fromTime) {
      $(this).prop('disabled', true).css({
        'background-color': '#ccc', // disabled color
        'color': '#666' // disabled text color
      });
    } else {
      $(this).prop('disabled', false).css({
        'background-color': '', // reset background color
        'color': 'black' // reset text color to black
      });
    }
  });
});
    </script>

  <?php 
  break;
  case 'editSchedule':
  $id=$_GET['id'];
  ?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Modifier Schedule</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <div class="row">
                    
                    <div class="col-md-9">

  <?php
    if(isset($_POST['subpost'])){
$is_postpone = $_POST['is_postpone'];
         if(!isset($error)){ 
$result=$lastid = $getCer->update_schedule($is_postpone,$id);
           if($result)
    {
if($result)
{
 echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
  }
    else{
      $error[] ='Failed : Something went wrong';
    }
 
 }
                           } 

   $sql="SELECT * 
FROM schedual
LEFT JOIN groups ON schedual.gid=groups.gid 
LEFT JOIN formation ON groups.fid=formation.fid
 WHERE schedual.sid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
 $gid=$row['gid'];

  ?>
   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Group Name</label>
     <input type="text" name="gname" value="<?php echo $row['gname'];?>" class="form-control" required disabled>
  </div>
</div>
<div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Formation</label>
   <select name="fid" class="form-control" required disabled>
      <option value="<?php echo $row['fid'];?>" style="background: #CBCDD1;"><?php echo $row['formation_name'];?></option>
<?php 
// $rows = $getCredit->fetch_all('formation', 'formation_name', 'ASC'); // Fetch data ordered by formation_name ascending
// foreach($rows as $rowi) {
//     echo '<option value="'.$rowi['fid'].'">'.$rowi['formation_name'].'</option>'; 
// }
?>        
        </select>
  </div>
                       </div>
<div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. classes per week</label>
     <select name="classno" id="classno" class="form-control" required disabled>
       <option value="<?php echo $row['classno'];?>" style="background: #CBCDD1;"><?php echo $row['classno'];?></option>
        <?php 
 //        for ($i=1; $i <=7; $i++) { 
 //  echo '<option value="'.$i.'">'.$i.'</option>'; 
 // }
        ?> 
     </select>
  </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. of month formation </label>
     <select name="nomformation" class="form-control" required disabled>
   <option value="<?php echo $row['nomformation'];?>" style="background: #CBCDD1;"><?php echo $row['nomformation'];?></option>
        <?php 
 //        for ($i=1; $i <=12; $i++) { 
 //  echo '<option value="'.$i.'">'.$i.'</option>'; 
 // }
        ?> 
     </select>
  </div>

                      </div>

                     
                        </div>
                        <?php 
                     
                        $sql="SELECT schedual.is_postpone,schedual.samount,schedual.sdate,schedual.sto,schedual.sfrom,ts_gtw_users.fname,ts_gtw_users.lname,ts_gtw_users.id,schedual.salary_type,classroom.classname,classroom.clsid,schedual.gid, schedual.sid
FROM schedual 
LEFT JOIN ts_gtw_users ON schedual.pid=ts_gtw_users.id
LEFT JOIN classroom ON schedual.classroom=classroom.clsid
 WHERE schedual.sid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);

                        $nm=1;
                       foreach($rows as $r)
                       { 


                        ?>

                        <!--dd-->
                        <div class="row sch" style="margin-bottom: 5px;" id="sch_<?php echo $nm;?>">
<div class="col-md-2.5">
<div class="form-group">
<label for="exampleInputEmail1">
<span class="dot"></span>
 Begin Date
</label>
</div>
</div>
<div class="col-md-2"><div class="form-group"><input type="date"  value="<?php echo $r['sdate'];?>" min="<?php echo $r['sdate'];?>" name="sdate[]"  class="form-control" required disabled>
    <input type="hidden" name="sid[]" value="<?php echo $r['sid'];?>">

</div></div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">From:</label>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<select name="from[]" class="form-control" required disabled>
      <option value="<?php echo $r['sfrom'];?>" style="background: #CBCDD1;"><?php echo $r['sfrom'];?></option>
<?php
for ($i = 6; $i <= 22; $i++) {
?>
<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>
<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">To:</label>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<select name="to[]" class="form-control" required disabled>
  <option value="<?php echo $r['sto'];?>" style="background: #CBCDD1;"><?php echo $r['sto'];?></option>
<?php
$fromTime = $r['sfrom']; // Retrieve "From" time from database
for ($i = 6; $i <= 22; $i++) {
  $optionValue = sprintf("%02d:00", $i);
  $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
  echo "<option value='$optionValue' $disabled>$optionValue</option>";
  
  $optionValue = sprintf("%02d:30", $i);
  $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
  echo "<option value='$optionValue' $disabled>$optionValue</option>";
}
?>

</select>
</div>
</div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">Prof:</label>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<select name="pid[]" class="form-control" required disabled>
  <option value="<?php echo $r['id'];?>" style="background: #CBCDD1;"><?php echo $r['fname'].' '.$r['lname'];?></option>
<?php
$rowsr=$getCredit->get_by_string('ts_gtw_users','post','prof');
foreach($rowsr as $rowr){
echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';
}
?>
</select>
</div>
</div>
<div class="col-md-1">
<div class="form-group">
<label for="exampleInputEmail1">Classroom</label>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<select name="classroom[]" class="form-control" required disabled>
   <option value="<?php echo $r['clsid'];?>" style="background: #CBCDD1;"><?php echo $r['classname'];?></option>
<?php
$rowsrp=$getCredit->fetch_all('classroom','clsid','ASC');
foreach($rowsrp as $rowrp){
echo '<option value="'.$rowrp['clsid'].'">'.$rowrp['classname'].'</option>';
}
?>
</select>
</div>
</div>

<div class="col-md-1.5"><div class="form-group"><label for="exampleInputEmail1">Salary Type</label></div></div>
 <div class="col-md-3"><div class="form-group"><select name="salary_type[]" id="salary_type" class="form-control" required="" disabled><option value="<?php echo $r['salary_type'];?>" style="background: #1bade8;"><?php echo $getDatabase->getSalaryType($r['salary_type']);?></option><option value="1">Per Month</option><option value="2">Per Hour</option><option value="3">Per Student </option></select></div></div>
  <div class="col-md-2"><div class="form-group"><input type="number" value="<?php echo $r['samount'];?>" name="samount[]" id="smount" class="form-control" required="" placeholder="Salary Amount" disabled></div> </div>

<div class="col-sm-1">
    
</div>
</div>
<?php } ?>

<!--dd-->
                     
    

  <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Is Postponed?</label>
      <select name="is_postpone" class="form-control">
 <option value="<?php echo $r['is_postpone'];?>" style="background: #CBCDD1;"><?php echo $getCredit->status6($row['is_postpone']);?></option>
       <option value="0">Scheduled</option>
        <option value="1">Postpone</option>
     </select>

  </div></div>

                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Schedule</button>
                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 


  </form>
</div>
</div>
</div>
<?php  if(isset($_POST['subpost2'])){
  $rfs=$getCredit->get_by_id('schedual','sid',$id);
  foreach($rfs as $rf)
  {
   $pid=$rf['pid']; 
   $salary_type=$rf['salary_type'];
   $samount=$rf['samount'];
  }
$from=$_POST['pfrom'];
$to=$_POST['pto'];  
$sdate=$_POST['psdate'];
$classroom=$_POST['pclassroom'];
$day1=$getDatabase->getDayNumber($getDatabase->easy_dayname($sdate)); 
$count=$getCredit->count_by_id('schedual','postpone_psid',$id);
                          if($count>0)
                          {
                            $errort[]='Re-schedule is already done...';
                          }
if(!isset($errort)){ 
$res=$getCer->insert_schedule_psid($day1,$from,$to,$pid,$classroom,$gid,$sdate,$salary_type,$samount,$id);
if($res)
{
 echo header("location:group?detect=seances&id=".$gid);
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}

}

}


  ?>
  <hr> 
  <?php if($r['is_postpone']==1){
if(isset($errort)){ 
foreach($errort as $errort){ 
  echo '<p class="errormsg">'.$errort.'</p>'; 
}
} 

    ?>
  <h2 style="color: red;"> If schedule is postponed or you want to re-schedule... </h2> 

<div id="aparea">
 <div class="row">
  <div class="col-sm-9">
<form action="" method="POST">
   <div class="row sch" style="margin-bottom: 5px;" id="sch_<?php echo $nm;?>">
<div class="col-md-2.5">
<div class="form-group">
<label for="exampleInputEmail1">
<span class="dot"></span>
 Next Date
</label>
</div>
</div>
<div class="col-md-2.5"><div class="form-group"><input type="date"  value="" min="<?php echo $r['sdate'];?>" name="psdate"  class="form-control" required>
    <input type="hidden" name="sid[]" value="<?php echo $r['sid'];?>">

</div></div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">From:</label>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<select name="pfrom" class="from-select form-control" required>
      <option value="">Select</option>
<?php
for ($i = 6; $i <= 22; $i++) {
?>
<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>
<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">To:</label>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<select name="pto" id="pto" class="to-select form-control" required>
  <option value="">Select</option>
<?php
$fromTime = $r['sfrom']; // Retrieve "From" time from database
for ($i = 6; $i <= 22; $i++) {
  $optionValue = sprintf("%02d:00", $i);
  $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
  echo "<option value='$optionValue' $disabled>$optionValue</option>";
  
  $optionValue = sprintf("%02d:30", $i);
  $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
  echo "<option value='$optionValue' $disabled>$optionValue</option>";
}
?>

</select>
</div>
</div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">Prof:</label>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<select name="pid[]" class="form-control" required disabled>
  <option value="<?php echo $r['id'];?>" style="background: #CBCDD1;"><?php echo $r['fname'].' '.$r['lname'];?></option>
<?php
$rowsr=$getCredit->get_by_string('ts_gtw_users','post','prof');
foreach($rowsr as $rowr){
echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';
}
?>
</select>
</div>
</div>
<div class="col-md-1">
<div class="form-group">
<label for="exampleInputEmail1">Classroom</label>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<select name="pclassroom" class="room-select form-control" required>
   <option value="">Select</option>
<?php
$rowsrp=$getCredit->fetch_all('classroom','clsid','ASC');
foreach($rowsrp as $rowrp){
echo '<option value="'.$rowrp['clsid'].'">'.$rowrp['classname'].'</option>';
}
?>
</select>
</div>
</div>

<div class="col-md-1.5"><div class="form-group"><label for="exampleInputEmail1">Salary Type</label></div></div>
 <div class="col-md-3"><div class="form-group"><select name="salary_type[]" id="salary_type" class="form-control" required="" disabled><option value="<?php echo $r['salary_type'];?>" style="background: #1bade8;"><?php echo $getDatabase->getSalaryType($r['salary_type']);?></option><option value="1">Per Month</option><option value="2">Per Hour</option><option value="3">Per Student </option></select></div></div>
  <div class="col-md-2"><div class="form-group"><input type="number" value="<?php echo $r['samount'];?>" name="samount[]" id="smount" class="form-control" required="" placeholder="Salary Amount" disabled></div> </div>
</div>
 <center><button type="submit" name="subpost2" class="btn btn-info btn-lg">Re-Schedule <i class="fa fa-calendar"></i></button></center>

</form>
</div>
<script type="text/javascript">
  $('#aparea').on('change', '.from-select', function() {
  var fromTime = $(this).val();
  var toDropdown = $(this).closest('.row.sch').find('.to-select');
  toDropdown.val(''); // Clear the selected value
  // Disable options in the "To" dropdown
  toDropdown.find('option').each(function() {
    var toTime = $(this).val();
    if (toTime <= fromTime) {
      $(this).prop('disabled', true).css({
        'background-color': '#ccc', // disabled color
        'color': '#666' // disabled text color
      });
    } else {
      $(this).prop('disabled', false).css({
        'background-color': '', // reset background color
        'color': 'black' // reset text color to black
      });
    }
  });
});

  var selectedSchedules = [];

$(document).on('change', '.from-select, .to-select', function() {
    var roomSelect = $(this).closest('.row').find('.room-select');
    roomSelect.val(''); // or roomSelect.prop('selectedIndex', 0);
 
});

$(document).on('change', '.room-select', function() {
  var roomId = $(this).closest('.row').find('.room-select').val();
  var fromTime = $(this).closest('.row').find('.from-select').val();
  var toTime = $(this).closest('.row').find('.to-select').val();
  var scheduleIndex = $(this).closest('.row').index();

  // //Check if selected combination already exists in the array
  // var existingSchedule = selectedSchedules.find((schedule, index) => schedule.roomId === roomId && schedule.fromTime === fromTime && schedule.toTime === toTime && schedule.index === scheduleIndex);

  // if (existingSchedule) {
  //   alert('Room already busy during this time slot.');
  //   return;
  // }

  // Send AJAX request to server-side validation
  $.ajax({
    type: 'POST',
    url: 'action?detect=slotvalidate',
    data: {
      roomId: roomId,
      fromTime: fromTime,
      toTime: toTime
    },
    success: function(response) {
      //alert(response);
      var res = response.trim();
      if (res =='busy') {
        alert('Room already busy during this time slot.');
        // Reset select options
        $(this).closest('.row').find('.room-select').val('');
        $(this).closest('.row').find('.from-select').val('');
        $(this).closest('.row').find('.to-select').val('');
      } else {
        selectedSchedules.push({
          roomId: roomId,
          fromTime: fromTime,
          toTime: toTime,
          index: scheduleIndex
        });
      }
    }
  });
});



</script>
   </div>
 </div>

 <?php } ?>

<?php } ?>


  <?php
  break;
   case 'genseances':
  $id=$_GET['id'];
  echo $getCer->createAllWeeksSchedules($id); 

  break;

  case 'seances':
  $id=$_GET['id'];
  ?>

<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
   $sql="SELECT * 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
 WHERE groups.gid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
  $gid=$row['gid'];
?>
  
                    <div class="row">
                      <div class="col-sm-4"> </div>
                       <div class="col-sm-4" > <h2 style=" color: #000;
    padding: 10px;
    background: #dcfff3;
    border: 1px solid green; border-radius:5px;">Seances of Groupe <strong><?php echo $row['gname'];?></strong></h2></div>
                   <div class="col-sm-4"> </div>
                        </div>
           <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Prof</th>
<th>Date Seance</th>
<th></th>
<th></th>
<th></th>
<th></th>

      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajax.php?detect=seance",
    type:"POST",
    data:{is_type:is_type,gid:<?php echo $gid;?>}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>



<?php } ?>
  <?php 
     break; 
     case 'presence':
       $id=$_GET['id'];
             $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
WHERE 
 schedual.sid=:id
";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row){}

       $count=$getCredit->count_by_id('presence','sid',$id); 
       if($count==0)
       {
        

        if(count($rows)>0)
        {
 
echo '
<h1 style="color:#0d67a5;"> List Presence of <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                        if(isset($_POST['subpost'])){
                          $pre=$_POST['pre'];
                           $reg_id=$_POST['reg_id'];
                           $pnote=$_POST['pnote'];
                                    if(!isset($error)){ 
                                      $i=0;
          foreach ($_POST['pre'] as $reg_id => $status) {
        $pnote1=$pnote[$i];
$res=$getCer->insert_presence($id,$reg_id,$status,$user_id,$pnote1);
$i++;
}
if($res)
{
  header("location:?detect=presence&id=".$id."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 
 }
                           }
                         

echo '
<form action="" method="POST">
<div class="row">
<div class="col-sm-10">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
             <th><input type="checkbox" name="checkall" id="checkall" class="form-control" style="height: calc(.65em + .65rem + 2px);"></th>
           <th>Presence</th>
            </tr>
           ';
foreach($rows as $rm)
{
  ?>
 
   
    <tr>
     
         <td style="width: 260px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
       <td> 
        <input type="hidden" name="pre[<?php echo $rm['reg_id'];?>]" value="0">
 <input type="checkbox" name="pre[<?php echo $rm['reg_id'];?>]" value="1" class="form-control check" style="height: calc(.65em + .65rem + 2px);">
</td>
   
      <td style="width: 400px;"><input type="text" name="pnote[]" placeholder="Presence note here" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Save</button></center>
</div>
</div>

</form>
';
}
else 
{
 echo 'No Record found'; 
}

}

else 
{ // edit 
  ?>
  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}


echo '
<h1 style="color:#0d67a5;"> List Presence of <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                        if(isset($_POST['subpost'])){
                          $pre=$_POST['pre'];
                           $reg_id=$_POST['reg_id'];
                           $pnote=$_POST['pnote'];
                           $prid=$_POST['prid'];
                                    if(!isset($error)){ 
                                      $i=0;
          foreach ($_POST['pre'] as $reg_id => $status) {
        $pnote1=$pnote[$i];
         $prid1=$prid[$i];
$res=$getCer->update_presence($reg_id, $status,$pnote1,$prid1);
if($prid1=='')
{
  $res=$getCer->insert_presence($id,$reg_id,$status,$user_id,$pnote1);
}
$i++;
}
if($res)
{
   header("location:?detect=presence&id=".$id."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 
 }
                           }
                         

echo '
<form action="" method="POST">
<div class="row">
<div class="col-sm-10">
<table class="table">
    <tr>
    
           <th>ID</th>
          <th>Group</th>
           <th>Full Name</th>
             <th><input type="checkbox" name="checkall" id="checkall" class="form-control" style="height: calc(.65em + .65rem + 2px);">
</th>
           <th>Presence</th>
            </tr>
           ';


$sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id, 
  presence.prid, 
  presence.pnote, 
  presence.pre
FROM 
  registrations 
  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
  LEFT JOIN presence ON schedual.sid=presence.sid AND registrations.reg_id=presence.reg_id
WHERE 
  schedual.sid=:id
";
$rowss=$getCredit->get_by_id_query($sql,$id);
foreach($rowss as $rm)
{
 
  ?>
 
   
    <tr>
         <td><input type="hidden" name="prid[]" value="<?php echo $rm['prid'];?>"> <?php echo $rm['prid'];?></td>
         <td style="width: 260px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
       <td> 


<input type="hidden" name="pre[<?php echo $rm['reg_id'];?>]" value="0">
<input type="checkbox" name="pre[<?php echo $rm['reg_id'];?>]" value="1" class="form-control check" style="height: calc(.65em + .65rem + 2px);" <?php if($rm['pre'] == 1) echo 'checked'; ?>>

</td>
   
      <td style="width: 400px;"><input type="text" name="pnote[]" value="<?php echo $rm['pnote'];?>" placeholder="Presence note here" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Save</button></center>
</div>
</div>

</form>
';


}
?>

<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'exams':
      $id=$_GET['id'];

     ?>
     
<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
 $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
WHERE 
 schedual.sid=:id
";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row){}
  if(isset($row['sdate']))
  {
?>
  
                    <div class="row">
                      <div class="col-sm-12">
                        <?php echo '<h1 style="color:#0d67a5;"> Exam <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                      ?>
                       </div>
                      
               
                        </div>
                      <?php } ?>
                         <a href="?detect=addexam&id=<?php echo $id;?>"><button class="btn btn-success" >Add New </button></a>
           <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Exam</th>
<th>Date</th>
<th>Added By</th>
<th></th>
<th></th>

      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajax.php?detect=exams",
    type:"POST",
    data:{is_type:is_type,gid:<?php echo $id;?>}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>



     <?php 

       break;
       case 'addexam':
       $id=$_GET['id'];
             $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
WHERE 
 schedual.sid=:id
";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row){}

        if(count($rows)>0)
        {
echo '
<h1 style="color:#0d67a5;">Add Exam for <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong>
</h1>


';
                        if(isset($_POST['subpost'])){
                          $ename=$_POST['ename'];
                           $mid=$_POST['mid'];
                           $edes=$_POST['edes'];
                           $reg_id=$_POST['reg_id'];
                            $marks=$_POST['marks'];
                           $countm=$getCredit->count_by_string_two_col('exams','ename',$ename,'sid',$id);

                         if($countm>0)
                         {
                          $error[]='This exam name is already used for this schedual..'; 
                         }
             $folder ="uploads/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'document_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 if($file!='')
 {
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
 $error[] = 'Sorry, only JPG, JPEG, PNG, PDF files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your file is too large. Upload less than 1 MB in size.';
}
 }

 if($file=='')
{
    $new_image_name=Null;
}
if(!isset($error)){
              $lastid=$getCer->insert_exam($ename,$mid,$edes,$new_image_name,$user_id,$id);  
              if($lastid>0) 
              {
                 if($file!=''){
             move_uploaded_file($file, 'uploads/' . $new_image_name); 
           }
             for ($i = 0; $i < count($reg_id); $i++)
{
        $reg_ids=$reg_id[$i];
        $mark=$marks[$i];
$res=$getCer->insert_marks($id,$reg_ids,$mark,$user_id,$lastid,$id);
}

            }
            else 
            {
                $error[] ='Failed : Something went wrong'; 
            }                            

if($res)
{
  header("location:?detect=exams&id=".$id."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 }
                           }
                            if(isset($error)){
        foreach($error as $error){
            echo '<div class="errormsg">'.$error.'</div><br />';
        }
    }
                         
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="row">
   <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Name</label>
     <input type="text" name="ename" value="<?php if(isset($error)){ echo $ename;} ?>" class="form-control" required>
  </div>
  </div>
  <div class="col-sm-4">
      <div class="form-group">
    <label for="exampleInputEmail1">Module</label>
   <select name="mid" class="form-control" required>
    <option value=""> Select</option>
<?php 
$rowsm = $getCredit->fetch_all('modules', 'modname', 'ASC'); 
foreach($rowsm as $rowi) {
    echo '<option value="'.$rowi['mid'].'">'.$rowi['modname'].'</option>'; 
}
?>

                  
        </select>
  </div>
  </div>
  <div class="col-sm-4">
      
  </div>

  <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Description</label>
     <textarea name="edes" rows="5" class="form-control" required><?php if(isset($error)){ echo $edes;} ?></textarea>
  </div>
  </div>
  <div class="col-md-4">
       <div class="form-group">
        <br>
         <label class="lable">Attach Document</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
    <small>(JPG,PNG,JPEG,PDF)</small>
    <div id="error_image"></div>

  
  </div>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
       <div class="form-group">
<strong>Exam Score</strong>
  </div>
</div>



</div>
<?php echo '
<div class="row" style="width: 80%;background: #f2f2f2; border-radius: 10px; padding: 20px 0px;">
<div class="col-sm-12">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
            
           <th>Exam Score</th>
            </tr>
           ';

foreach($rows as $rm)
{
  ?>
    <tr> 
         <td style="width: 270px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
      
   
      <td style="width: 200px;"><input type="number" name="marks[]" placeholder="" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Add Exam</button></center>
</div>
</div>


';
}
else 
{
 echo 'No Record found'; 
}
?>
</form>

<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'editexam':
       $id=$_GET['id'];
         $sid=$_GET['sid'];
             

// $sql = "SELECT * 
//         FROM exams 
//         LEFT JOIN schedual ON exams.sid = schedual.sid 
//         LEFT JOIN ts_gtw_users ON exams.uid = ts_gtw_users.id
//         LEFT JOIN groups ON schedual.gid = groups.gid 
//         LEFT JOIN marks ON exams.eid = marks.eid 
//         LEFT JOIN registrations ON marks.reg_id = registrations.reg_id 
//         LEFT JOIN modules ON exams.mid = modules.mid 
//         WHERE exams.sid = :id AND exams.eid = :id2";

        $sql = "SELECT DISTINCT * 
        FROM exams 
        LEFT JOIN schedual ON exams.sid = schedual.sid 
        LEFT JOIN ts_gtw_users ON exams.uid = ts_gtw_users.id
        LEFT JOIN groups ON schedual.gid = groups.gid 
        LEFT JOIN marks ON exams.eid = marks.eid 
        LEFT JOIN registrations ON marks.reg_id = registrations.reg_id 
        LEFT JOIN modules ON exams.mid = modules.mid 
        WHERE exams.sid = :id AND marks.eid = :id2";



$rows=$getCredit->get_by_id_query_two_col($sql,$sid,$id);
foreach($rows as $row){}

        if(count($rows)>0)
        {
echo '
<h1 style="color:#0d67a5;">Edit Exam for <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong>
</h1>

';
                        if(isset($_POST['subpost'])){
                          $ename=$_POST['ename'];
                           $mid=$_POST['mid'];
                           $edes=$_POST['edes'];
                           $maid=$_POST['maid'];
                            $marks=$_POST['marks'];
             $folder ="uploads/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'document_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 $rows=$getCredit->get_by_id('exams','eid',$id); 
  foreach($rows as $row)
  {
      $uesource=$row['esource'];
      $oldename=$row['ename'];
  }
  if($oldename!=$ename)
  {
    $countm=$getCredit->count_by_string_two_col('exams','ename',$ename,'sid',$sid);

                         if($countm>0)
                         {
                          $error[]='This exam name is already used for this schedual..'; 
                         }

  }

 if($file!='')
 {
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
 $error[] = 'Sorry, only JPG, JPEG, PNG, PDF files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your file is too large. Upload less than 1 MB in size.';
}

 }

 if($file=='')
{
    $new_image_name=$uesource;
}
if(!isset($error)){
              $lastid=$getCer->update_exam($ename,$mid,$edes,$new_image_name,$id);  
              if($lastid)  
              {
 if($file!=''){
             unlink('uploads/'.$uesource);
             move_uploaded_file($file, 'uploads/' . $new_image_name); 
           }

                for ($i = 0; $i < count($maid); $i++)
{
        $maids=$maid[$i];
        $mark=$marks[$i];
$res=$getCer->update_marks($maids,$mark);
}

              }  
              else 
{
  $error[] ='Failed : Something went wrong'; 
}                          

if($res)
{
  header("location:?detect=editexam&&id=".$id."&sid=".$sid."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 }

                           }

                         
?>
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>

<form action="" method="post" enctype="multipart/form-data">
  <?php foreach($rows as $rmk)
  {}
  ?>
<div class="row">
   <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Name</label>
     <input type="text" name="ename" value="<?php echo $rmk['ename'];?>" class="form-control" required>
  </div>
  </div>
  <div class="col-sm-4">
      <div class="form-group">
    <label for="exampleInputEmail1">Module</label>
   <select name="mid" class="form-control" required>
    <option value="<?php echo $rmk['mid'];?>" style="background:#d7d1d0;"><?php echo $rmk['modname'];?></option>
<?php 
$rowsm = $getCredit->fetch_all('modules', 'modname', 'ASC'); 
foreach($rowsm as $rowi) {
    echo '<option value="'.$rowi['mid'].'">'.$rowi['modname'].'</option>'; 
}
?>

                  
        </select>
  </div>
  </div>
  <div class="col-sm-4">
      
  </div>

  <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Description</label>
     <textarea name="edes" rows="5" class="form-control" required><?php echo $rmk['edes'];?></textarea>
  </div>
  </div>
  <div class="col-md-4">
       <div class="form-group">
        <br>
         <label class="lable">Attach Document</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
    <small>(JPG,PNG,JPEG,PDF)</small>
 <?php 
    if($rmk['esource']!='')
    {
        echo '<br>'.$rmk['esource'].' &nbsp; <a target="_blank" class="btn btn-success" href="uploads/'.$rmk['esource'].'">View</a>';
    }
    else 
    {
          echo 'N/A';
    }
    ?>

  
  </div>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
       <div class="form-group">
<strong>Exam Score</strong>
  </div>
</div>



</div>
<?php echo '
<div class="row" style="width: 80%;background: #f2f2f2; border-radius: 10px; padding: 20px 0px;">
<div class="col-sm-12">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
            
           <th>Exam Score</th>
            </tr>
           ';

foreach($rows as $rm)
{
  ?>
    <tr> 
         <td style="width: 270px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="maid[]" value="<?php echo $rm['maid'];?>"><?php echo $rm['name'];?></td>
      
   
      <td style="width: 200px;"><input type="number" value="<?php echo $rm['marks'];?>" name="marks[]" placeholder="" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Save</button></center>
</div>
</div>


';
}
else 
{
 echo 'No Record found'; 
}
?>
</form>

<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'delexam': 
  $id=$_GET['id'];
  $sid=$_GET['sid'];
  $getCredit->delete_by_id('marks','eid',$id);
  $res=$getCredit->delete_by_id('exams','eid',$id);
     if($res)
     {
      header("Location:group?detect=exams&id=".$sid."&action=Deleted");
     }
     else 
     {
      echo 'Something went wrong.....';
     }
  break;

  case 'del': 
  $id=$_GET['id'];
  $rows=$getCredit->get_by_id('schedual','gid',$id);
  foreach($rows as $row)
  {
    $sid=$row['sid'];
     $getCredit->delete_by_id('presence','sid',$sid);
     $getCredit->delete_by_id('exams','sid',$sid);
  }
  $getCredit->delete_by_id('schedual','gid',$id);
  $res=$getCredit->delete_by_id('groups','gid',$id);
     if($res)
     {
      header("Location:group?action=Deleted");
     }
     else 
     {
      echo 'Something went wrong.....';
     }

  break;
  default:

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Group</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

                    
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Group </button></a>
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
  <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Group Name</th>
<th>Formation</th>
<th>Schedule</th>
<th>Status</th>
<th>Seances</th>
<th>Added  By</th>
<th>Created</th>
<th>Weeks Seances</th>
<th>Edit</th>
<th>Delete</th>

      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajax.php?detect=group",
    type:"POST",
    data:{is_type:is_type}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>
<?php } ?>

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
  case 'add':
  ?> 
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Ajouter une Group</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <div class="row">
                    
                    <div class="col-md-10">
                        <?php 

                        if(isset($_POST['subpost'])){

                          $gname = $_POST['gname'];
                         $count=$getCredit->count_by_string_two_col('groups','gname',$gname,'uid',$user_id);
                          if($count>0)
                          {
                            $error[]='This group name is already created';
                          }

$fid = $_POST['fid'];
$classno = $_POST['classno'];
$nomformation = $_POST['nomformation'];
$gstatus = $_POST['gstatus'];
$from=$_POST['from'];
$to=$_POST['to']; 
$pid=$_POST['pid'];  
$classroom=$_POST['classroom']; 
$sdate=$_POST['sdate'];
$salary_type=$_POST['salary_type'];
$samount=$_POST['samount'];
$cent_id=$_POST['cent_id']; 

         if(!isset($error)){ 
 $lastid = $getCer->insert_group($gname, $fid, $classno, $nomformation, $gstatus,$user_id,$cent_id);
           if($lastid>0)
    {
for ($i=0; $i < count($sdate); $i++) { 
$from1 = $from[$i];
$to1 = $to[$i];
$pid1 = $pid[$i];
$classroom1 = $classroom[$i];
 $sdate1=$sdate[$i];
  $st=$salary_type[$i];
 $sm=$samount[$i];
$day1=$getDatabase->getDayNumber($getDatabase->easy_dayname($sdate1));
$countp=$getCredit->count_by_string_two_col('schedual','pid',$pid1,'gid',$lastid);
if($countp>0){
 $rows=$getCredit->get_by_string_two_col('schedual','pid',$pid1,'gid',$lastid);
 foreach($rows as $row)
 {
$st=$row['salary_type'];
$sm=$row['samount'];
 } 
}

 $result=$getCer->insert_schedule($day1,$from1,$to1,$pid1,$classroom1,$lastid,$sdate1,$st,$sm);
}
  
if($result)
{
 header("Location:group?action=Added");  
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
  }
    else{
      $error[] ='Failed : Something went wrong';
    }
 }
 } 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
} 

 ?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                       <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Formation</label>
   <select name="fid" id="fid" class="form-control" required>
         <option value="">Selectionner Formation </option> 
<?php 
$rows = $getCredit->fetch_all('formation', 'formation_name', 'ASC'); // Fetch data ordered by formation_name ascending
foreach($rows as $row) {
    echo '<option value="'.$row['fid'].'">'.$row['formation_name'].'</option>'; 
}
?>

                  
        </select>
  </div>
                       </div>

                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Group Name</label>
     <input type="text" name="gname" id="gid" class="form-control" required>

  </div>


                      </div>
                     


                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. classes per week</label>
     <select name="classno" id="classno" class="form-control" required>
        <option value="">Select</option>
        <?php for ($i=1; $i <=7; $i++) { 
  echo '<option value="'.$i.'">'.$i.'</option>'; 
 }
        ?> 
     </select>
  </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. of month formation </label>
     <select name="nomformation" class="form-control" required>
        <option value="">Select</option>
        <?php for ($i=1; $i <=12; $i++) { 
  echo '<option value="'.$i.'">'.$i.'</option>'; 
 }
        ?> 
     </select>
  </div>

                      </div>
                       <div class="col-sm-6">

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


                     
                        </div>
                       <div id="aparea"> </div>
 
  <div class="col-sm-6">
    <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
     <select name="gstatus" class="form-control" required>
      <option value="">Select Status</option>
       <option value="1">Active</option>
        <option value="2">Inactive</option>
         <option value="0">Termine</option>
         
     </select>
  </div>
</div>

                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Group</button>
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
                  $(document).on('change', '#classno', function(){
  var classno= $('#classno').val();
  
       $('#aparea').empty();
for (var i = 1; i <= classno; i++) {
     $('#aparea').append('<div class="row sch" style="margin-bottom: 5px;">'+
'<div class="col-md-2.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1"><span class="dot"></span> Schedule Day '+ i +': Begin Date</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<input type="date" name="sdate[]" class="form-control" required>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">From:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="from[]" id="from" class="from-select form-control" required>'+
'<option value="">Select</option>'+
'<?php for ($i = 6; $i <= 22; $i++) { ?>'+
'<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>'+
'<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>'+
'<?php } ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">To:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="to[]" id="to"  class="to-select form-control" required>'+
'<option value="">Select</option>'+
'<?php for ($i = 6; $i <= 22; $i++) { ?>'+
'<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>'+
'<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>'+
'<?php } ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1">'+
'<div class="form-group">'+
'<label>Prof:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="pid[]" class="form-control" required>'+
'<option value="">Select</option>'+
'<?php $sql="SELECT ts_gtw_users.fname,ts_gtw_users.lname,ts_gtw_users.id 
FROM ts_gtw_users
LEFT JOIN centres ON ts_gtw_users.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rowsr=$getCredit->get_by_id_query($sql,$user_id); foreach($rowsr as $rowr){ echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';} ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">Classroom</label>'+
'</div>'+
'</div>'+
'<div class="col-md-3">'+
'<div class="form-group">'+
'<select name="classroom[]" class="room-select form-control" required>'+
'<option value="">Select</option>'+
'<?php $rowsrp=$getCredit->get_by_id('classroom','uid',$user_id); foreach($rowsrp as $rowrp){ echo '<option value="'.$rowrp['clsid'].'">'.$rowrp['classname'].'</option>';} ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5"><div class="form-group"><label for="exampleInputEmail1">Salary Type</label></div></div> <div class="col-md-3"><div class="form-group"><select name="salary_type[]" id="salary_type" class="form-control" required><option value="" disabled selected>Salary Type</option><option value="1">Per Month</option><option value="2">Per Hour</option><option value="3">Per Student </option></select></div></div> <div class="col-md-2"><div class="form-group"><input type="number" name="samount[]" id="smount" class="form-control" required placeholder="Salary Amount"></div> </div></div>');


}

 });

$('#aparea').on('change', '.from-select', function() {
  var fromTime = $(this).val();
  var toDropdown = $(this).closest('.row.sch').find('.to-select');
  toDropdown.val(''); // Clear the selected value
  // Disable options in the "To" dropdown
  toDropdown.find('option').each(function() {
    var toTime = $(this).val();
    if (toTime <= fromTime) {
      $(this).prop('disabled', true).css({
        'background-color': '#ccc', // disabled color
        'color': '#666' // disabled text color
      });
    } else {
      $(this).prop('disabled', false).css({
        'background-color': '', // reset background color
        'color': 'black' // reset text color to black
      });
    }
  });
});

$(document).on('change', '#fid', function(){
  var fid= $('#fid').val();
  if(fid.trim() == '' ) {          
   alert('Please select a formation'); 

            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=gname",      
data: {fid: fid },
        beforeSend: function() {
           $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");
           },
        success: function(data){ 
            //alert(data);
            $("#gid").val(data);
    }});
}
 });
var selectedSchedules = [];
$(document).on('change', '.from-select, .to-select', function() {
    var roomSelect = $(this).closest('.row').find('.room-select');
    roomSelect.val(''); // or roomSelect.prop('selectedIndex', 0);
});
$(document).on('change', '.room-select', function() {
  //alert('nice');
  var roomId = $(this).closest('.row').find('.room-select').val();
  var fromTime = $(this).closest('.row').find('.from-select').val();
  var toTime = $(this).closest('.row').find('.to-select').val();
  var scheduleIndex = $(this).closest('.row').index();

  // //Check if selected combination already exists in the array
  // var existingSchedule = selectedSchedules.find((schedule, index) => schedule.roomId === roomId && schedule.fromTime === fromTime && schedule.toTime === toTime && schedule.index === scheduleIndex);

  // if (existingSchedule) {
  //   alert('Room already busy during this time slot.');
  //   return;
  // }

  // Send AJAX request to server-side validation
  $.ajax({
    type: 'POST',
    url: 'action?detect=slotvalidate',
    data: {
      roomId: roomId,
      fromTime: fromTime,
      toTime: toTime
    },
    success: function(response) {
      //alert(response);
      var res = response.trim();
      if (res =='busy') {
        alert('Room already busy during this time slot.');
        // Reset select options
        $(this).closest('.row').find('.room-select').val('');
        $(this).closest('.row').find('.from-select').val('');
        $(this).closest('.row').find('.to-select').val('');
      } else {
        selectedSchedules.push({
          roomId: roomId,
          fromTime: fromTime,
          toTime: toTime,
          index: scheduleIndex
        });
      }
    }
  });
});


</script>
  <?php 
  break; 
  case 'edit':
  $id=$_GET['id'];

  $sql="SELECT count(*) as total
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
LEFT JOIN ts_gtw_users ON groups.uid=ts_gtw_users.id
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND groups.gid='$id';
";
    $count=$getCredit->count_by_query2($sql);
  // $count=$getCredit->count_by_string_two_col('groups','gid',$id,'uid',$user_id);
  if($count==0)
  {
    header("location:index");
    exit();
  }
  ?> 
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Modifier Group</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
                          $sql="SELECT * 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
 WHERE groups.gid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $rm)
{
  $dbgname=$rm['gname'];
}

 if(isset($_POST['subpost'])){
                          $gname=$_POST['gname'];
                          if($gname!=$dbgname)
                          {
                            $count=$getCredit->count_by_string_two_col('groups','gname',$gname,'uid',$user_id);
                          if($count>0)
                          {
                            $error[]='This group name is already created';
                          }
                          }
$fid = $_POST['fid'];
$classno = $_POST['classno'];
$nomformation = $_POST['nomformation'];
$gstatus = $_POST['gstatus'];
$from=$_POST['from'];
$to=$_POST['to']; 
$pid=$_POST['pid'];  
$sdate=$_POST['sdate'];
$sid=$_POST['sid'];
if(isset($_POST['sparent_id']))
{
 $sparent_id=$_POST['sparent_id'];  
}

$classroom=$_POST['classroom'];
$salary_type=$_POST['salary_type'];
$samount=$_POST['samount'];
$cent_id=$_POST['cent_id'];
         if(!isset($error)){ 
$result=$lastid = $getCer->update_group($gname, $fid, $classno, $nomformation, $gstatus,$cent_id,$id);
           if($result)
    {
$rm=$getCredit->delete_by_id('schedual','gid',$id);
if($rm)
{
  $ss=count($sdate); 
  for ($i=0; $i < count($sdate); $i++) { 
$from1 = $from[$i];
$to1 = $to[$i];
$pid1 = $pid[$i];
$classroom1 = $classroom[$i];
 $sdate1=$sdate[$i];
 $si1 = $sid[$i];
 if(isset($_POST['sparent_id'])){
  $sparent = $sparent_id[$i];
  if($sparent=='')
  {
    $sparent=NULL; 
  }
}
  $st=$salary_type[$i];
 $sm=$samount[$i];
$day1=$getDatabase->getDayNumber($getDatabase->easy_dayname($sdate1)); 
$countp=$getCredit->count_by_string_two_col('schedual','pid',$pid1,'gid',$id);
if($countp>0){
 $rows=$getCredit->get_by_string_two_col('schedual','pid',$pid1,'gid',$id);
 foreach($rows as $row)
 {
$st=$row['salary_type'];
$sm=$row['samount'];
 } 
}

if($si1>0)
{
 $res=$getCer->insert_schedule4($day1,$from1,$to1,$pid1,$classroom1,$id,$sdate1,$si1,$st,$sm,$sparent);
}
else 
{
  $res=$getCer->insert_schedule($day1,$from1,$to1,$pid1,$classroom1,$id,$sdate1,$st,$sm); 
}


}
 $getCer->update_group2($ss,$id);
}
if($res)
{
 echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
  }
    else{
      $error[] ='Failed : Something went wrong';
    }
 
 }
                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
   $sql="SELECT * 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
LEFT JOIN centres ON groups.cnt_id=centres.cent_id
 WHERE groups.gid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
  $gid=$row['gid'];
?>
                    <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Group Name</label>
     <input type="text" name="gname" value="<?php echo $row['gname'];?>" class="form-control" required>

  </div>


                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Formation</label>
   <select name="fid" class="form-control" required>
      <option value="<?php echo $row['fid'];?>" style="background: #CBCDD1;"><?php echo $row['formation_name'];?></option>
<?php 
$rows = $getCredit->fetch_all('formation', 'formation_name', 'ASC'); // Fetch data ordered by formation_name ascending
foreach($rows as $rowi) {
    echo '<option value="'.$rowi['fid'].'">'.$rowi['formation_name'].'</option>'; 
}
?>

                  
        </select>
  </div>
                       </div>


                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. classes per week</label>
     <select name="classno" id="classno" class="form-control" required>
       <option value="<?php echo $row['classno'];?>" style="background: #CBCDD1;"><?php echo $row['classno'];?></option>
        <?php for ($i=1; $i <=7; $i++) { 
  echo '<option value="'.$i.'">'.$i.'</option>'; 
 }
        ?> 
     </select>
  </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. of month formation </label>
     <select name="nomformation" class="form-control" required>
   <option value="<?php echo $row['nomformation'];?>" style="background: #CBCDD1;"><?php echo $row['nomformation'];?></option>
        <?php for ($i=1; $i <=12; $i++) { 
  echo '<option value="'.$i.'">'.$i.'</option>'; 
 }
        ?> 
     </select>
  </div>

                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" >
       <option value="<?php echo $row['cent_id'];?>" style="background: #CBCDD1;"><?php echo $row['centre_name'];?></option>
 <?php

 $sql="SELECT * 
FROM centres 
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rows=$getCredit->get_by_id_query($sql,$user_id);
                      
 foreach($rows as $rowc)
 {
  echo '<option value="'.$rowc['cent_id'].'">'.$rowc['centre_name'].'</option>'; 
 }
        ?> 
                  
        </select>
  </div>
                       </div>



                     
                        </div>
                       <?php 
$sql = "SELECT schedual.samount, schedual.sdate, schedual.sto, schedual.sfrom, ts_gtw_users.fname, ts_gtw_users.lname, ts_gtw_users.id, schedual.salary_type, classroom.classname, classroom.clsid, schedual.gid, schedual.sid, schedual.sparent_id
FROM schedual 
LEFT JOIN ts_gtw_users ON schedual.pid = ts_gtw_users.id
LEFT JOIN classroom ON schedual.classroom = classroom.clsid
WHERE schedual.gid = :id";
$rows = $getCredit->get_by_id_query($sql, $gid);
$nm = 1;

foreach ($rows as $r) {
    if ($r['sparent_id'] == NULL) { 
        ?>
        <div class="row sch" style="margin-bottom: 5px;" id="sch_<?php echo $nm; ?>">
            <div class="col-md-2.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">
                        <span class="dot"></span>
                        Schedule Day <?php echo $nm; ?> : Begin Date
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="date" value="<?php echo $r['sdate']; ?>" min="<?php echo $r['sdate']; ?>" name="sdate[]" class="form-control" required>
                    <input type="hidden" name="sid[]" value="<?php echo $r['sid']; ?>">
                    <input type="hidden" name="sparent_id[]" value="<?php echo $r['sparent_id']; ?>">
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">From:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="from[]" class="from-select form-control" required>
                        <option value="<?php echo $r['sfrom']; ?>" style="background: #CBCDD1;"><?php echo $r['sfrom']; ?></option>
                        <?php for ($i = 6; $i <= 22; $i++) { ?>
                        <option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>
                        <option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">To:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="to[]" class="to-select form-control" required>
                        <option value="<?php echo $r['sto']; ?>" style="background: #CBCDD1;"><?php echo $r['sto']; ?></option>
                        <?php
                        $fromTime = $r['sfrom'];
                        for ($i = 6; $i <= 22; $i++) {
                            $optionValue = sprintf("%02d:00", $i);
                            $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
                            echo "<option value='$optionValue' $disabled>$optionValue</option>";

                            $optionValue = sprintf("%02d:30", $i);
                            $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
                            echo "<option value='$optionValue' $disabled>$optionValue</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Prof:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="pid[]" class="form-control" required>
                        <option value="<?php echo $r['id']; ?>" style="background: #CBCDD1;"><?php echo $r['fname'] . ' ' . $r['lname']; ?></option>
                        <?php
                        $rowsr = $sql="SELECT ts_gtw_users.fname,ts_gtw_users.lname,ts_gtw_users.id 
FROM ts_gtw_users
LEFT JOIN centres ON ts_gtw_users.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rowsr=$getCredit->get_by_id_query($sql,$user_id);
                        foreach ($rowsr as $rowr) {
                            echo '<option value="' . $rowr['id'] . '">' . $rowr['fname'] . ' ' . $rowr['lname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="exampleInputEmail1">Classroom</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="classroom[]" class="form-control" required>
                        <option value="<?php echo $r['clsid']; ?>" style="background: #CBCDD1;"><?php echo $r['classname']; ?></option>
                        <?php
                        $rowsrp = $getCredit->fetch_all('classroom', 'clsid', 'ASC');
                        foreach ($rowsrp as $rowrp) {
                            echo '<option value="' . $rowrp['clsid'] . '">' . $rowrp['classname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Salary Type</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="salary_type[]" id="salary_type" class="form-control" required>
                        <option value="<?php echo $r['salary_type']; ?>" style="background: #1bade8;"><?php echo $getDatabase->getSalaryType($r['salary_type']); ?></option>
                        <option value="1">Per Month</option>
                        <option value="2">Per Hour</option>
                        <option value="3">Per Student</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="number" value="<?php echo $r['samount']; ?>" name="samount[]" id="smount" class="form-control" required placeholder="Salary Amount">
                </div>
            </div>
            <div class="col-sm-1">
                <button type="button" name="remove" id="<?php echo $nm; ?>" class="btn btn-danger btn_remove">X</button>
            </div>
        </div>
        <?php
        foreach ($rows as $child) {
            if ($child['sparent_id'] == $r['sid']) { 
                ?>
                <div class="row sch" style="margin-bottom: 5px; margin-left: 30px;background: #9d99d9;" id="sch_<?php echo $nm; ?>_child" data-parent="<?php echo $nm; ?>">
                    <!-- Repeat the same fields for child here -->
                    <div class="col-md-2.5">
                        <div class="form-group">
                            <label for="exampleInputEmail1">
                                <span class="dot"></span>
                                Child Schedule : Begin Date
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" value="<?php echo $child['sdate']; ?>" min="<?php echo $child['sdate']; ?>" name="sdate[]" class="form-control" required>
                            <input type="hidden" name="sid[]" value="<?php echo $child['sid']; ?>">
                            <input type="hidden" name="sparent_id[]" value="<?php echo $child['sparent_id']; ?>">
                        </div>
                    </div>
                     <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">From:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="from[]" class="from-select form-control" required>
                        <option value="<?php echo $r['sfrom']; ?>" style="background: #CBCDD1;"><?php echo $r['sfrom']; ?></option>
                        <?php for ($i = 6; $i <= 22; $i++) { ?>
                        <option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>
                        <option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">To:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="to[]" class="to-select form-control" required>
                        <option value="<?php echo $r['sto']; ?>" style="background: #CBCDD1;"><?php echo $r['sto']; ?></option>
                        <?php
                        $fromTime = $r['sfrom'];
                        for ($i = 6; $i <= 22; $i++) {
                            $optionValue = sprintf("%02d:00", $i);
                            $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
                            echo "<option value='$optionValue' $disabled>$optionValue</option>";

                            $optionValue = sprintf("%02d:30", $i);
                            $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
                            echo "<option value='$optionValue' $disabled>$optionValue</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Prof:</label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="pid[]" class="form-control" required>
                        <option value="<?php echo $r['id']; ?>" style="background: #CBCDD1;"><?php echo $r['fname'] . ' ' . $r['lname']; ?></option>
                        <?php
                        $sql="SELECT ts_gtw_users.fname,ts_gtw_users.lname,ts_gtw_users.id 
FROM ts_gtw_users
LEFT JOIN centres ON ts_gtw_users.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rowsr=$getCredit->get_by_id_query($sql,$user_id);
                        foreach ($rowsr as $rowr) {
                            echo '<option value="' . $rowr['id'] . '">' . $rowr['fname'] . ' ' . $rowr['lname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="exampleInputEmail1">Classroom</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="classroom[]" class="form-control" required>
                        <option value="<?php echo $r['clsid']; ?>" style="background: #CBCDD1;"><?php echo $r['classname']; ?></option>
                        <?php
                        $rowsrp = $getCredit->fetch_all('classroom', 'clsid', 'ASC');
                        foreach ($rowsrp as $rowrp) {
                            echo '<option value="' . $rowrp['clsid'] . '">' . $rowrp['classname'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-1.5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Salary Type</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <select name="salary_type[]" id="salary_type" class="form-control" required>
                        <option value="<?php echo $r['salary_type']; ?>" style="background: #1bade8;"><?php echo $getDatabase->getSalaryType($r['salary_type']); ?></option>
                        <option value="1">Per Month</option>
                        <option value="2">Per Hour</option>
                        <option value="3">Per Student</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input type="number" value="<?php echo $r['samount']; ?>" name="samount[]" id="smount" class="form-control" required placeholder="Salary Amount">
                </div>
            </div>
            <div class="col-sm-1">
                <button type="button" name="remove" id="<?php echo $nm; ?>" class="btn btn-danger btn_remove">X</button>
            </div>
                </div>
                <?php
            }
        }
        $nm++;
    }
}
?>


<!--dd-->
                       <div id="aparea"> </div>
<div class="row">
  <div class="col-sm-12">
         <center><div id="addRowBtn" class="btn btn-warning" style="cursor: pointer;">+ Add More Schedule</div></center>
  </div>
</div>
                  

  <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
      <select name="gstatus" class="form-control">
 <option value="<?php echo $row['gstatus'];?>" style="background: #CBCDD1;"><?php echo $getCredit->status_hr2($row['gstatus']);?></option>
       <option value="1">Active</option>
        <option value="2">Inactive</option>
         <option value="0">Termine</option>
         
     </select>

  </div></div>

                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Group</button>
                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 
  
 

  </form>

<?php } ?>
              
                    </div>
                </div>
                <script type="text/javascript">
                  $('.from-select').on('change', function() {
  var fromTime = $(this).val();
  var toDropdown = $(this).closest('.row.sch').find('.to-select');
  toDropdown.val(''); // Clear the selected value
  toDropdown.find('option').each(function() {
    var toTime = $(this).val();
    if (toTime <= fromTime) {
      $(this).prop('disabled', true).css({
        'background-color': '#ccc', // disabled color
        'color': '#666' // disabled text color
      });
    } else {
      $(this).prop('disabled', false).css({
        'background-color': '', // reset background color
        'color': 'black' // reset text color to black
      });
    }
  });
});


        $(document).ready(function(){ 
$(document).on('click', '.btn_remove', function(){
var button_id = $(this).attr("id"); 
$('#sch_'+button_id+'').css('background','red').fadeOut('slow', this.remove);

    });
});
        $(document).ready(function() {
var rowNum = <?php echo $nm;?>;
$("#addRowBtn").click(function() {
  $('#aparea').append('<div class="row sch" style="margin-bottom: 5px;" id="sch_'+ rowNum +'">'+
'<div class="col-md-2.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1"><span class="dot"></span> Schedule Day '+ rowNum +' Begin Date </label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<input type="date" name="sdate[]" class="form-control" required>'+
'<input type="hidden" name="sid[]" value="0" class="form-control" required>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">From:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="from[]" class="from-select form-control" required>'+
'<option value="">Select</option>'+
'<?php for ($i = 6; $i <= 22; $i++) { ?>'+
'<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>'+
'<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>'+
'<?php } ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">To:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="to[]" class="to-select form-control" required>'+
'<option value="">Select</option>'+
'<?php for ($i = 6; $i <= 22; $i++) { ?>'+
'<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>'+
'<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>'+
'<?php } ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">Prof:</label>'+
'</div>'+
'</div>'+
'<div class="col-md-2">'+
'<div class="form-group">'+
'<select name="pid[]" class="form-control" required>'+
'<option value="">Select</option>'+
'<?php $rowsr=$getCredit->get_by_string_two_col('ts_gtw_users','post','prof','uid',$user_id); foreach($rowsr as $rowr){ echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';} ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1">'+
'<div class="form-group">'+
'<label for="exampleInputEmail1">Classroom</label>'+
'</div>'+
'</div>'+
'<div class="col-md-3">'+
'<div class="form-group">'+
'<select name="classroom[]" class="form-control" required>'+
'<?php $rowsrp=$getCredit->get_by_id('classroom','uid',$user_id); foreach($rowsrp as $rowrp){ echo '<option value="'.$rowrp['clsid'].'">'.$rowrp['classname'].'</option>';} ?>'+
'</select>'+
'</div>'+
'</div>'+
'<div class="col-md-1.5"><div class="form-group"><label for="exampleInputEmail1">Salary Type</label></div></div> <div class="col-md-3"><div class="form-group"><select name="salary_type[]" id="salary_type" class="form-control" required><option value="" disabled selected>Salary Type</option><option value="1">Per Month</option><option value="2">Per Hour</option><option value="3">Per Student </option></select></div></div> <div class="col-md-3"><div class="form-group"><input type="number" name="samount[]" id="smount" class="form-control" required placeholder="Salary Amount"></div> </div> '+
'<div class="col-sm-1">'+
'<button type="button" name="remove" id="'+ rowNum +'" class="btn btn-danger btn_remove">X</button>'+
'</div>'+
'</div>');


rowNum++;
})
});

$('#aparea').on('change', '.from-select', function() {
  var fromTime = $(this).val();
  var toDropdown = $(this).closest('.row.sch').find('.to-select');
  toDropdown.val(''); // Clear the selected value
  // Disable options in the "To" dropdown
  toDropdown.find('option').each(function() {
    var toTime = $(this).val();
    if (toTime <= fromTime) {
      $(this).prop('disabled', true).css({
        'background-color': '#ccc', // disabled color
        'color': '#666' // disabled text color
      });
    } else {
      $(this).prop('disabled', false).css({
        'background-color': '', // reset background color
        'color': 'black' // reset text color to black
      });
    }
  });
});
    </script>

  <?php 

  break;
  case 'editSchedule':
  $id=$_GET['id'];

  ?>
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Modifier Schedule</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <div class="row">
                    
                    <div class="col-md-9">

  <?php
    if(isset($_POST['subpost'])){
$is_postpone = $_POST['is_postpone'];
         if(!isset($error)){ 
$result=$lastid = $getCer->update_schedule($is_postpone,$id);
           if($result)
    {
if($result)
{
 echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
  }
    else{
      $error[] ='Failed : Something went wrong';
    }
 
 }
                           } 

   $sql="SELECT * 
FROM schedual
LEFT JOIN groups ON schedual.gid=groups.gid 
LEFT JOIN formation ON groups.fid=formation.fid
 WHERE schedual.sid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
 $gid=$row['gid'];
 $count=$getCredit->count_by_string_two_col('groups','gid',$gid,'uid',$user_id);
  if($count==0)
  {
    //header("location:index");
    //exit();
  }

  ?>
   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Group Name</label>
     <input type="text" name="gname" value="<?php echo $row['gname'];?>" class="form-control" required disabled>
  </div>
</div>
<div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Formation</label>
   <select name="fid" class="form-control" required disabled>
      <option value="<?php echo $row['fid'];?>" style="background: #CBCDD1;"><?php echo $row['formation_name'];?></option>
<?php 
// $rows = $getCredit->fetch_all('formation', 'formation_name', 'ASC'); // Fetch data ordered by formation_name ascending
// foreach($rows as $rowi) {
//     echo '<option value="'.$rowi['fid'].'">'.$rowi['formation_name'].'</option>'; 
// }
?>        
        </select>
  </div>
                       </div>
<div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. classes per week</label>
     <select name="classno" id="classno" class="form-control" required disabled>
       <option value="<?php echo $row['classno'];?>" style="background: #CBCDD1;"><?php echo $row['classno'];?></option>
        <?php 
 //        for ($i=1; $i <=7; $i++) { 
 //  echo '<option value="'.$i.'">'.$i.'</option>'; 
 // }
        ?> 
     </select>
  </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">No. of month formation </label>
     <select name="nomformation" class="form-control" required disabled>
   <option value="<?php echo $row['nomformation'];?>" style="background: #CBCDD1;"><?php echo $row['nomformation'];?></option>
        <?php 
 //        for ($i=1; $i <=12; $i++) { 
 //  echo '<option value="'.$i.'">'.$i.'</option>'; 
 // }
        ?> 
     </select>
  </div>

                      </div>

                     
                        </div>
                        <?php 
                     
                        $sql="SELECT schedual.is_postpone,schedual.samount,schedual.sdate,schedual.sto,schedual.sfrom,ts_gtw_users.fname,ts_gtw_users.lname,ts_gtw_users.id,schedual.salary_type,classroom.classname,classroom.clsid,schedual.gid, schedual.sid
FROM schedual 
LEFT JOIN ts_gtw_users ON schedual.pid=ts_gtw_users.id
LEFT JOIN classroom ON schedual.classroom=classroom.clsid
 WHERE schedual.sid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);

                        $nm=1;
                       foreach($rows as $r)
                       { 


                        ?>

                        <!--dd-->
                        <div class="row sch" style="margin-bottom: 5px;" id="sch_<?php echo $nm;?>">
<div class="col-md-2.5">
<div class="form-group">
<label for="exampleInputEmail1">
<span class="dot"></span>
 Begin Date
</label>
</div>
</div>
<div class="col-md-2"><div class="form-group"><input type="date"  value="<?php echo $r['sdate'];?>" min="<?php echo $r['sdate'];?>" name="sdate[]"  class="form-control" required disabled>
    <input type="hidden" name="sid[]" value="<?php echo $r['sid'];?>">

</div></div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">From:</label>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<select name="from[]" class="form-control" required disabled>
      <option value="<?php echo $r['sfrom'];?>" style="background: #CBCDD1;"><?php echo $r['sfrom'];?></option>
<?php
for ($i = 6; $i <= 22; $i++) {
?>
<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>
<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">To:</label>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<select name="to[]" class="form-control" required disabled>
  <option value="<?php echo $r['sto'];?>" style="background: #CBCDD1;"><?php echo $r['sto'];?></option>
<?php
$fromTime = $r['sfrom']; // Retrieve "From" time from database
for ($i = 6; $i <= 22; $i++) {
  $optionValue = sprintf("%02d:00", $i);
  $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
  echo "<option value='$optionValue' $disabled>$optionValue</option>";
  
  $optionValue = sprintf("%02d:30", $i);
  $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
  echo "<option value='$optionValue' $disabled>$optionValue</option>";
}
?>

</select>
</div>
</div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">Prof:</label>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<select name="pid[]" class="form-control" required disabled>
  <option value="<?php echo $r['id'];?>" style="background: #CBCDD1;"><?php echo $r['fname'].' '.$r['lname'];?></option>
<?php
$rowsr=$getCredit->get_by_string('ts_gtw_users','post','prof');
foreach($rowsr as $rowr){
echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';
}
?>
</select>
</div>
</div>
<div class="col-md-1">
<div class="form-group">
<label for="exampleInputEmail1">Classroom</label>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<select name="classroom[]" class="form-control" required disabled>
   <option value="<?php echo $r['clsid'];?>" style="background: #CBCDD1;"><?php echo $r['classname'];?></option>
<?php
$rowsrp=$getCredit->get_by_id('classroom','uid',$user_id);
foreach($rowsrp as $rowrp){
echo '<option value="'.$rowrp['clsid'].'">'.$rowrp['classname'].'</option>';
}
?>
</select>
</div>
</div>

<div class="col-md-1.5"><div class="form-group"><label for="exampleInputEmail1">Salary Type</label></div></div>
 <div class="col-md-3"><div class="form-group"><select name="salary_type[]" id="salary_type" class="form-control" required="" disabled><option value="<?php echo $r['salary_type'];?>" style="background: #1bade8;"><?php echo $getDatabase->getSalaryType($r['salary_type']);?></option><option value="1">Per Month</option><option value="2">Per Hour</option><option value="3">Per Student </option></select></div></div>
  <div class="col-md-2"><div class="form-group"><input type="number" value="<?php echo $r['samount'];?>" name="samount[]" id="smount" class="form-control" required="" placeholder="Salary Amount" disabled></div> </div>

<div class="col-sm-1">
    
</div>
</div>
<?php } ?>

<!--dd-->
                     
    

  <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Is Postponed?</label>
      <select name="is_postpone" class="form-control">
 <option value="<?php echo $r['is_postpone'];?>" style="background: #CBCDD1;"><?php echo $getCredit->status6($row['is_postpone']);?></option>
       <option value="0">Scheduled</option>
        <option value="1">Postpone</option>
     </select>

  </div></div>

                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Schedule</button>
                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 


  </form>
</div>
</div>
</div>
<?php  if(isset($_POST['subpost2'])){
  $rfs=$getCredit->get_by_id('schedual','sid',$id);
  foreach($rfs as $rf)
  {
   $pid=$rf['pid']; 
   $salary_type=$rf['salary_type'];
   $samount=$rf['samount'];
  }
$from=$_POST['pfrom'];
$to=$_POST['pto'];  
$sdate=$_POST['psdate'];
$classroom=$_POST['pclassroom'];
$day1=$getDatabase->getDayNumber($getDatabase->easy_dayname($sdate)); 
$count=$getCredit->count_by_id('schedual','postpone_psid',$id);
                          if($count>0)
                          {
                            $errort[]='Re-schedule is already done...';
                          }
if(!isset($errort)){ 
$res=$getCer->insert_schedule_psid($day1,$from,$to,$pid,$classroom,$gid,$sdate,$salary_type,$samount,$id);
if($res)
{
 echo header("location:group?detect=seances&id=".$gid);
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}

}

}


  ?>
  <hr> 
  <?php if($r['is_postpone']==1){
if(isset($errort)){ 
foreach($errort as $errort){ 
  echo '<p class="errormsg">'.$errort.'</p>'; 
}
} 

    ?>
  <h2 style="color: red;"> If schedule is postponed or you want to re-schedule... </h2> 

<div id="aparea">
 <div class="row">
  <div class="col-sm-9">
<form action="" method="POST">
   <div class="row sch" style="margin-bottom: 5px;" id="sch_<?php echo $nm;?>">
<div class="col-md-2.5">
<div class="form-group">
<label for="exampleInputEmail1">
<span class="dot"></span>
 Next Date
</label>
</div>
</div>
<div class="col-md-2.5"><div class="form-group"><input type="date"  value="" min="<?php echo $r['sdate'];?>" name="psdate"  class="form-control" required>
    <input type="hidden" name="sid[]" value="<?php echo $r['sid'];?>">

</div></div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">From:</label>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<select name="pfrom" class="from-select form-control" required>
      <option value="">Select</option>
<?php
for ($i = 6; $i <= 22; $i++) {
?>
<option value="<?php echo sprintf("%02d:00", $i); ?>"><?php echo sprintf("%02d:00", $i); ?></option>
<option value="<?php echo sprintf("%02d:30", $i); ?>"><?php echo sprintf("%02d:30", $i); ?></option>
<?php
}
?>
</select>
</div>
</div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">To:</label>
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<select name="pto" id="pto" class="to-select form-control" required>
  <option value="">Select</option>
<?php
$fromTime = $r['sfrom']; // Retrieve "From" time from database
for ($i = 6; $i <= 22; $i++) {
  $optionValue = sprintf("%02d:00", $i);
  $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
  echo "<option value='$optionValue' $disabled>$optionValue</option>";
  
  $optionValue = sprintf("%02d:30", $i);
  $disabled = ($optionValue <= $fromTime) ? 'disabled="disabled" style="background-color: #ccc; color: #666;"' : '';
  echo "<option value='$optionValue' $disabled>$optionValue</option>";
}
?>

</select>
</div>
</div>
<div class="col-md-1.5">
<div class="form-group">
<label for="exampleInputEmail1">Prof:</label>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<select name="pid[]" class="form-control" required disabled>
  <option value="<?php echo $r['id'];?>" style="background: #CBCDD1;"><?php echo $r['fname'].' '.$r['lname'];?></option>
<?php
$rowsr=$getCredit->get_by_string('ts_gtw_users','post','prof');
foreach($rowsr as $rowr){
echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';
}
?>
</select>
</div>
</div>
<div class="col-md-1">
<div class="form-group">
<label for="exampleInputEmail1">Classroom</label>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<select name="pclassroom" class="room-select form-control" required>
   <option value="">Select</option>
<?php
$rowsrp=$getCredit->get_by_id('classroom','uid',$user_id);
foreach($rowsrp as $rowrp){
echo '<option value="'.$rowrp['clsid'].'">'.$rowrp['classname'].'</option>';
}
?>
</select>
</div>
</div>

<div class="col-md-1.5"><div class="form-group"><label for="exampleInputEmail1">Salary Type</label></div></div>
 <div class="col-md-3"><div class="form-group"><select name="salary_type[]" id="salary_type" class="form-control" required="" disabled><option value="<?php echo $r['salary_type'];?>" style="background: #1bade8;"><?php echo $getDatabase->getSalaryType($r['salary_type']);?></option><option value="1">Per Month</option><option value="2">Per Hour</option><option value="3">Per Student </option></select></div></div>
  <div class="col-md-2"><div class="form-group"><input type="number" value="<?php echo $r['samount'];?>" name="samount[]" id="smount" class="form-control" required="" placeholder="Salary Amount" disabled></div> </div>
</div>
 <center><button type="submit" name="subpost2" class="btn btn-info btn-lg">Re-Schedule <i class="fa fa-calendar"></i></button></center>

</form>
</div>
<script type="text/javascript">
  $('#aparea').on('change', '.from-select', function() {
  var fromTime = $(this).val();
  var toDropdown = $(this).closest('.row.sch').find('.to-select');
  toDropdown.val(''); // Clear the selected value
  // Disable options in the "To" dropdown
  toDropdown.find('option').each(function() {
    var toTime = $(this).val();
    if (toTime <= fromTime) {
      $(this).prop('disabled', true).css({
        'background-color': '#ccc', // disabled color
        'color': '#666' // disabled text color
      });
    } else {
      $(this).prop('disabled', false).css({
        'background-color': '', // reset background color
        'color': 'black' // reset text color to black
      });
    }
  });
});

  var selectedSchedules = [];

$(document).on('change', '.from-select, .to-select', function() {
    var roomSelect = $(this).closest('.row').find('.room-select');
    roomSelect.val(''); // or roomSelect.prop('selectedIndex', 0);
 
});

$(document).on('change', '.room-select', function() {
  var roomId = $(this).closest('.row').find('.room-select').val();
  var fromTime = $(this).closest('.row').find('.from-select').val();
  var toTime = $(this).closest('.row').find('.to-select').val();
  var scheduleIndex = $(this).closest('.row').index();

  // //Check if selected combination already exists in the array
  // var existingSchedule = selectedSchedules.find((schedule, index) => schedule.roomId === roomId && schedule.fromTime === fromTime && schedule.toTime === toTime && schedule.index === scheduleIndex);

  // if (existingSchedule) {
  //   alert('Room already busy during this time slot.');
  //   return;
  // }

  // Send AJAX request to server-side validation
  $.ajax({
    type: 'POST',
    url: 'action?detect=slotvalidate',
    data: {
      roomId: roomId,
      fromTime: fromTime,
      toTime: toTime
    },
    success: function(response) {
      //alert(response);
      var res = response.trim();
      if (res =='busy') {
        alert('Room already busy during this time slot.');
        // Reset select options
        $(this).closest('.row').find('.room-select').val('');
        $(this).closest('.row').find('.from-select').val('');
        $(this).closest('.row').find('.to-select').val('');
      } else {
        selectedSchedules.push({
          roomId: roomId,
          fromTime: fromTime,
          toTime: toTime,
          index: scheduleIndex
        });
      }
    }
  });
});



</script>
   </div>
 </div>

 <?php } ?>

<?php } ?>


  <?php
  break;
  case 'seances':
  $id=$_GET['id'];
  $sql="SELECT count(*) as total 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
LEFT JOIN ts_gtw_users ON groups.uid=ts_gtw_users.id
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id='$user_id' AND groups.gid='$id'"; 
$count=$getCredit->count_by_query2($sql); 
  // exit();
  // $count=$getCredit->count_by_string_two_col('groups','gid',$id,'uid',$user_id);
  if($count==0)
  {
    header("location:index");
    exit();
  }
  ?>
<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
   $sql="SELECT * 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
 WHERE groups.gid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
  $gid=$row['gid'];
?>
  
                    <div class="row">
                      <div class="col-sm-4"> </div>
                       <div class="col-sm-4" > <h2 style=" color: #000;
    padding: 10px;
    background: #dcfff3;
    border: 1px solid green; border-radius:5px;">Seances of Groupe <strong><?php echo $row['gname'];?></strong></h2></div>
                   <div class="col-sm-4"> </div>
                        </div>
           <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Prof</th>
<th>Date Seance</th>
<th></th>
<th></th>
<th></th>
<th></th>


      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajaxm.php?detect=seance",
    type:"POST",
    data:{is_type:is_type,gid:<?php echo $gid;?>}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>



<?php } ?>
  <?php 
     break; 
     case 'presence':
       $id=$_GET['id'];
        $sql2 = "SELECT count(*)
        FROM registrations 
        INNER JOIN inscription ON registrations.reg_id = inscription.reg_id 
        INNER JOIN groups ON inscription.gid = groups.gid 
        INNER JOIN schedual ON groups.gid = schedual.gid 
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE schedual.sid = :id AND links.id='$user_id'";
 $cc=$getCredit->count_by_id_query($sql2,$id);
 if($cc==0)
 {
  echo 'No Record found'; 
  exit();
 }


             $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
  INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id

WHERE 
 schedual.sid=:id AND  links.id='$user_id'
";


$rows=$getCredit->get_by_id_query($sql,$id);


foreach($rows as $row){}

       $count=$getCredit->count_by_id('presence','sid',$id); 
       if($count==0)
       {
        

        if(count($rows)>0)
        {
 
echo '
<h1 style="color:#0d67a5;"> List Presence of <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                        if(isset($_POST['subpost'])){
                          $pre=$_POST['pre'];
                           $reg_id=$_POST['reg_id'];
                           $pnote=$_POST['pnote'];
                                    if(!isset($error)){ 
                                      $i=0;
          foreach ($_POST['pre'] as $reg_id => $status) {
        $pnote1=$pnote[$i];
$res=$getCer->insert_presence($id,$reg_id,$status,$user_id,$pnote1);
$i++;
}
if($res)
{
  header("location:?detect=presence&id=".$id."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 
 }
                           }
                         

echo '
<form action="" method="POST">
<div class="row">
<div class="col-sm-10">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
             <th><input type="checkbox" name="checkall" id="checkall" class="form-control" style="height: calc(.65em + .65rem + 2px);"></th>
           <th>Presence</th>
            </tr>
           ';
foreach($rows as $rm)
{
  ?>
 
   
    <tr>
     
         <td style="width: 260px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
       <td> 
        <input type="hidden" name="pre[<?php echo $rm['reg_id'];?>]" value="0">
 <input type="checkbox" name="pre[<?php echo $rm['reg_id'];?>]" value="1" class="form-control check" style="height: calc(.65em + .65rem + 2px);">
</td>
   
      <td style="width: 400px;"><input type="text" name="pnote[]" placeholder="Presence note here" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Save</button></center>
</div>
</div>

</form>
';
}
else 
{
 echo 'No Record found'; 
}

}

else 
{ // edit 
  ?>
  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}


echo '
<h1 style="color:#0d67a5;"> List Presence of <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                        if(isset($_POST['subpost'])){
                          $pre=$_POST['pre'];
                           $reg_id=$_POST['reg_id'];
                           $pnote=$_POST['pnote'];
                           $prid=$_POST['prid'];
                                    if(!isset($error)){ 
                                      $i=0;
          foreach ($_POST['pre'] as $reg_id => $status) {
        $pnote1=$pnote[$i];
         $prid1=$prid[$i];
$res=$getCer->update_presence($reg_id, $status,$pnote1,$prid1);
if($prid1=='')
{
  $res=$getCer->insert_presence($id,$reg_id,$status,$user_id,$pnote1);
}
$i++;
}
if($res)
{
   header("location:?detect=presence&id=".$id."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 
 }
                           }
                         

echo '
<form action="" method="POST">
<div class="row">
<div class="col-sm-10">
<table class="table">
    <tr>
    
           <th>ID</th>
          <th>Group</th>
           <th>Full Name</th>
             <th><input type="checkbox" name="checkall" id="checkall" class="form-control" style="height: calc(.65em + .65rem + 2px);">
</th>
           <th>Presence</th>
            </tr>
           ';


$sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id, 
  presence.prid, 
  presence.pnote, 
  presence.pre
FROM 
  registrations 
  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
  LEFT JOIN presence ON schedual.sid=presence.sid AND registrations.reg_id=presence.reg_id
WHERE 
  schedual.sid=:id
";
$rowss=$getCredit->get_by_id_query($sql,$id);
foreach($rowss as $rm)
{
 
  ?>
 
   
    <tr>
         <td><input type="hidden" name="prid[]" value="<?php echo $rm['prid'];?>"> <?php echo $rm['prid'];?></td>
         <td style="width: 260px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
       <td> 


<input type="hidden" name="pre[<?php echo $rm['reg_id'];?>]" value="0">
<input type="checkbox" name="pre[<?php echo $rm['reg_id'];?>]" value="1" class="form-control check" style="height: calc(.65em + .65rem + 2px);" <?php if($rm['pre'] == 1) echo 'checked'; ?>>

</td>
   
      <td style="width: 400px;"><input type="text" name="pnote[]" value="<?php echo $rm['pnote'];?>" placeholder="Presence note here" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Save</button></center>
</div>
</div>

</form>
';


}
?>

<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'exams':
      $id=$_GET['id'];
$sql2 = "SELECT count(*)
        FROM registrations 
        INNER JOIN inscription ON registrations.reg_id = inscription.reg_id 
        INNER JOIN groups ON inscription.gid = groups.gid AND groups.uid = '$user_id' 
        INNER JOIN schedual ON groups.gid = schedual.gid 
        WHERE schedual.sid = :id";
 $cc=$getCredit->count_by_id_query($sql2,$id);
 if($cc==0)
 {
  echo 'No Record found'; 
  exit();
 }

     ?>
     
<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
 $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
WHERE 
 schedual.sid=:id
";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row){}

?>
  
                    <div class="row">
                      <div class="col-sm-12">
                        <?php echo '<h1 style="color:#0d67a5;"> Exam <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                      ?>
                       </div>
                      
               
                        </div>
                         <a href="?detect=addexam&id=<?php echo $id;?>"><button class="btn btn-success" >Add New </button></a>
           <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Exam</th>
<th>Date</th>
<th></th>


      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajaxm.php?detect=exams",
    type:"POST",
    data:{is_type:is_type,gid:<?php echo $id;?>}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>



     <?php 

       break;
       case 'addexam':
       $id=$_GET['id'];
       $sql2 = "SELECT count(*)
        FROM registrations 
        INNER JOIN inscription ON registrations.reg_id = inscription.reg_id 
        INNER JOIN groups ON inscription.gid = groups.gid AND groups.uid = '$user_id' 
        INNER JOIN schedual ON groups.gid = schedual.gid 
        WHERE schedual.sid = :id";
 $cc=$getCredit->count_by_id_query($sql2,$id);
 if($cc==0)
 {
  echo 'No Record found'; 
  exit();
 }

             $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
WHERE 
 schedual.sid=:id
";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row){}

        if(count($rows)>0)
        {
echo '
<h1 style="color:#0d67a5;">Add Exam for <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong>
</h1>


';
                        if(isset($_POST['subpost'])){
                          $ename=$_POST['ename'];
                           $mid=$_POST['mid'];
                           $edes=$_POST['edes'];
                           $reg_id=$_POST['reg_id'];
                            $marks=$_POST['marks'];
                           $countm=$getCredit->count_by_string_two_col('exams','ename',$ename,'sid',$id);

                         if($countm>0)
                         {
                          $error[]='This exam name is already used for this schedual..'; 
                         }
                          $countmm=$getCredit->count_by_string_two_col('modules','mid',$mid,'uid',$user_id);

                         if($countmm==0)
                         {
                          $error[]='Invalid module.'; 
                         }

             $folder ="uploads/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'document_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 if($file!='')
 {
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
 $error[] = 'Sorry, only JPG, JPEG, PNG, PDF files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your file is too large. Upload less than 1 MB in size.';
}
 }

 if($file=='')
{
    $new_image_name=Null;
}
if(!isset($error)){
              $lastid=$getCer->insert_exam($ename,$mid,$edes,$new_image_name,$user_id,$id);  
              if($lastid>0) 
              {
                 if($file!=''){
             move_uploaded_file($file, 'uploads/' . $new_image_name); 
           }
             for ($i = 0; $i < count($reg_id); $i++)
{
        $reg_ids=$reg_id[$i];
        $mark=$marks[$i];
$res=$getCer->insert_marks($id,$reg_ids,$mark,$user_id,$lastid,$id);
}

            }
            else 
            {
                $error[] ='Failed : Something went wrong'; 
            }                            

if($res)
{
  header("location:?detect=exams&id=".$id."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 }
                           }
                            if(isset($error)){
        foreach($error as $error){
            echo '<div class="errormsg">'.$error.'</div><br />';
        }
    }
                         
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="row">
   <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Name</label>
     <input type="text" name="ename" value="<?php if(isset($error)){ echo $ename;} ?>" class="form-control" required>
  </div>
  </div>
  <div class="col-sm-4">
      <div class="form-group">
    <label for="exampleInputEmail1">Module</label>
   <select name="mid" class="form-control" required>
    <option value=""> Select</option>
<?php 
$rowsm = $getCredit->get_by_id('modules', 'uid',$user_id); 
foreach($rowsm as $rowi) {
    echo '<option value="'.$rowi['mid'].'">'.$rowi['modname'].'</option>'; 
}
?>

                  
        </select>
  </div>
  </div>
  <div class="col-sm-4">
      
  </div>

  <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Description</label>
     <textarea name="edes" rows="5" class="form-control" required><?php if(isset($error)){ echo $edes;} ?></textarea>
  </div>
  </div>
  <div class="col-md-4">
       <div class="form-group">
        <br>
         <label class="lable">Attach Document</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
    <small>(JPG,PNG,JPEG,PDF)</small>
    <div id="error_image"></div>

  
  </div>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
       <div class="form-group">
<strong>Exam Score</strong>
  </div>
</div>



</div>
<?php echo '
<div class="row" style="width: 80%;background: #f2f2f2; border-radius: 10px; padding: 20px 0px;">
<div class="col-sm-12">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
            
           <th>Exam Score</th>
            </tr>
           ';

foreach($rows as $rm)
{
  ?>
    <tr> 
         <td style="width: 270px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
      
   
      <td style="width: 200px;"><input type="number" name="marks[]" placeholder="" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Add Exam</button></center>
</div>
</div>


';
}
else 
{
 echo 'No Record found'; 
}
?>
</form>

<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'editexam':
       $id=$_GET['id'];
         $sid=$_GET['sid'];
             

// $sql = "SELECT * 
//         FROM exams 
//         LEFT JOIN schedual ON exams.sid = schedual.sid 
//         LEFT JOIN ts_gtw_users ON exams.uid = ts_gtw_users.id
//         LEFT JOIN groups ON schedual.gid = groups.gid 
//         LEFT JOIN marks ON exams.eid = marks.eid 
//         LEFT JOIN registrations ON marks.reg_id = registrations.reg_id 
//         LEFT JOIN modules ON exams.mid = modules.mid 
//         WHERE exams.sid = :id AND exams.eid = :id2";

        $sql = "SELECT DISTINCT * 
        FROM exams 
        LEFT JOIN schedual ON exams.sid = schedual.sid 
        LEFT JOIN ts_gtw_users ON exams.uid = ts_gtw_users.id
        LEFT JOIN groups ON schedual.gid = groups.gid 
        LEFT JOIN marks ON exams.eid = marks.eid 
        LEFT JOIN registrations ON marks.reg_id = registrations.reg_id 
        LEFT JOIN modules ON exams.mid = modules.mid 
        WHERE exams.sid = :id AND marks.eid = :id2";



$rows=$getCredit->get_by_id_query_two_col($sql,$sid,$id);
foreach($rows as $row){}

        if(count($rows)>0)
        {
echo '
<h1 style="color:#0d67a5;">Edit Exam for <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong>
</h1>

';
                        if(isset($_POST['subpost'])){
                          $ename=$_POST['ename'];
                           $mid=$_POST['mid'];
                           $edes=$_POST['edes'];
                           $maid=$_POST['maid'];
                            $marks=$_POST['marks'];
             $folder ="uploads/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'document_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 $rows=$getCredit->get_by_id('exams','eid',$id); 
  foreach($rows as $row)
  {
      $uesource=$row['esource'];
      $oldename=$row['ename'];
       $oldmid=$row['mid'];
  }
  if($oldename!=$ename)
  {
    $countm=$getCredit->count_by_string_two_col('exams','ename',$ename,'sid',$sid);

                         if($countm>0)
                         {
                          $error[]='This exam name is already used for this schedual..'; 
                         }

  }
  if($oldmid!=$mid)
  {
    $countm=$getCredit->count_by_string_two_col('modules','mid',$mid,'uid',$uid);

                         if($countm==0)
                         {
                          $error[]='Invalid module.'; 
                         }

  }
  

 if($file!='')
 {
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
 $error[] = 'Sorry, only JPG, JPEG, PNG, PDF files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your file is too large. Upload less than 1 MB in size.';
}

 }

 if($file=='')
{
    $new_image_name=$uesource;
}
if(!isset($error)){
              $lastid=$getCer->update_exam($ename,$mid,$edes,$new_image_name,$id);  
              if($lastid)  
              {
 if($file!=''){
             unlink('uploads/'.$uesource);
             move_uploaded_file($file, 'uploads/' . $new_image_name); 
           }

                for ($i = 0; $i < count($maid); $i++)
{
        $maids=$maid[$i];
        $mark=$marks[$i];
$res=$getCer->update_marks($maids,$mark);
}

              }  
              else 
{
  $error[] ='Failed : Something went wrong'; 
}                          

if($res)
{
  header("location:?detect=editexam&&id=".$id."&sid=".$sid."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 }

                           }

                         
?>
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>

<form action="" method="post" enctype="multipart/form-data">
  <?php foreach($rows as $rmk)
  {}
  ?>
<div class="row">
   <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Name</label>
     <input type="text" name="ename" value="<?php echo $rmk['ename'];?>" class="form-control" required>
  </div>
  </div>
  <div class="col-sm-4">
      <div class="form-group">
    <label for="exampleInputEmail1">Module</label>
   <select name="mid" class="form-control" required>
    <option value="<?php echo $rmk['mid'];?>" style="background:#d7d1d0;"><?php echo $rmk['modname'];?></option>
<?php 
 $rowsm = $getCredit->get_by_id('modules', 'uid',$user_id);  
foreach($rowsm as $rowi) {
    echo '<option value="'.$rowi['mid'].'">'.$rowi['modname'].'</option>'; 
}
?>

                  
        </select>
  </div>
  </div>
  <div class="col-sm-4">
      
  </div>

  <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Description</label>
     <textarea name="edes" rows="5" class="form-control" required><?php echo $rmk['edes'];?></textarea>
  </div>
  </div>
  <div class="col-md-4">
       <div class="form-group">
        <br>
         <label class="lable">Attach Document</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
    <small>(JPG,PNG,JPEG,PDF)</small>
 <?php 
    if($rmk['esource']!='')
    {
        echo '<br>'.$rmk['esource'].' &nbsp; <a target="_blank" class="btn btn-success" href="uploads/'.$rmk['esource'].'">View</a>';
    }
    else 
    {
          echo 'N/A';
    }
    ?>

  
  </div>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
       <div class="form-group">
<strong>Exam Score</strong>
  </div>
</div>



</div>
<?php echo '
<div class="row" style="width: 80%;background: #f2f2f2; border-radius: 10px; padding: 20px 0px;">
<div class="col-sm-12">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
            
           <th>Exam Score</th>
            </tr>
           ';

foreach($rows as $rm)
{
  ?>
    <tr> 
         <td style="width: 270px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="maid[]" value="<?php echo $rm['maid'];?>"><?php echo $rm['name'];?></td>
      
   
      <td style="width: 200px;"><input type="number" value="<?php echo $rm['marks'];?>" name="marks[]" placeholder="" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Save</button></center>
</div>
</div>


';
}
else 
{
 echo 'No Record found'; 
}
?>
</form>

<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'delexam': 
  // $id=$_GET['id'];
  // $sid=$_GET['sid'];
  // $getCredit->delete_by_id('marks','eid',$id);
  // $res=$getCredit->delete_by_id('exams','eid',$id);
  //    if($res)
  //    {
  //     header("Location:group?detect=exams&id=".$sid."&action=Deleted");
  //    }
  //    else 
  //    {
  //     echo 'Something went wrong.....';
  //    }
  break;

  case 'delblock': 

  break;
  default:

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Group</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

                    
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Group </button></a>
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
  <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Group Name</th>
<th>Formation</th>
<th>Schedule</th>
<th>Status</th>
<th>Seances</th>
<th>Created</th>
<th>Edit</th>

      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajaxm.php?detect=group",
    type:"POST",
    data:{is_type:is_type}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>
<?php } ?>

                   </div>
  <?php
  break; 
  case 'prof':

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
  case 'seances':
  $id=$_GET['id'];
    $query="SELECT *
FROM groups  
LEFT JOIN schedual ON groups.gid=schedual.gid 
LEFT JOIN ts_gtw_users ON schedual.pid=ts_gtw_users.id 
 WHERE schedual.pid='$user_id' AND groups.gid='$id'
";
$count=$getCredit->count_by_query($query); 
if($count==0)
{
  header("location:group");
  exit();
}

  ?>

<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
   $sql="SELECT * 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
 WHERE groups.gid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
  $gid=$row['gid'];
?>
  
                    <div class="row">
                      <div class="col-sm-4"> </div>
                       <div class="col-sm-4" > <h2 style=" color: #000;
    padding: 10px;
    background: #dcfff3;
    border: 1px solid green; border-radius:5px;">Seances of Groupe <strong><?php echo $row['gname'];?></strong></h2></div>
                   <div class="col-sm-4"> </div>
                        </div>
           <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Prof</th>
<th>Date Seance</th>
<th></th>
<th></th>

      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajaxp.php?detect=seance",
    type:"POST",
    data:{is_type:is_type,gid:<?php echo $gid;?>}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>



<?php } ?>
  <?php 
     break; 
     case 'presence':
       $id=$_GET['id'];

       $counts=$getCredit->count_by_string_two_col('schedual','sid',$id,'pid',$user_id);
       if($counts==0)
       {
        header("location:group"); 
        exit();
       }
             $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
WHERE 
 schedual.sid=:id
";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row){}

       $count=$getCredit->count_by_id('presence','sid',$id); 
       if($count==0)
       {
        

        if(count($rows)>0)
        {
 
echo '
<h1 style="color:#0d67a5;"> List Presence of <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                        if(isset($_POST['subpost'])){
                          $pre=$_POST['pre'];
                           $reg_id=$_POST['reg_id'];
                           $pnote=$_POST['pnote'];
                                    if(!isset($error)){ 
                                      $i=0;
          foreach ($_POST['pre'] as $reg_id => $status) {
        $pnote1=$pnote[$i];
$res=$getCer->insert_presence($id,$reg_id,$status,$user_id,$pnote1);
$i++;
}
if($res)
{
  header("location:?detect=presence&id=".$id."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 
 }
                           }
                         

echo '
<form action="" method="POST">
<div class="row">
<div class="col-sm-10">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
             <th><input type="checkbox" name="checkall" id="checkall" class="form-control" style="height: calc(.65em + .65rem + 2px);"></th>
           <th>Presence</th>
            </tr>
           ';
foreach($rows as $rm)
{
  ?>
 
   
    <tr>
     
         <td style="width: 260px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
       <td> 
        <input type="hidden" name="pre[<?php echo $rm['reg_id'];?>]" value="0">
 <input type="checkbox" name="pre[<?php echo $rm['reg_id'];?>]" value="1" class="form-control check" style="height: calc(.65em + .65rem + 2px);">
</td>
   
      <td style="width: 400px;"><input type="text" name="pnote[]" placeholder="Presence note here" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Save</button></center>
</div>
</div>

</form>
';
}
else 
{
 echo 'No Record found'; 
}

}

else 
{ // edit 
  ?>
  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}


echo '
<h1 style="color:#0d67a5;"> List Presence of <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                        if(isset($_POST['subpost'])){
                          $pre=$_POST['pre'];
                           $reg_id=$_POST['reg_id'];
                           $pnote=$_POST['pnote'];
                           $prid=$_POST['prid'];
                                    if(!isset($error)){ 
                                      $i=0;
          foreach ($_POST['pre'] as $reg_id => $status) {
        $pnote1=$pnote[$i];
         $prid1=$prid[$i];
$res=$getCer->update_presence($reg_id, $status,$pnote1,$prid1);
if($prid1=='')
{
  $res=$getCer->insert_presence($id,$reg_id,$status,$user_id,$pnote1);
}
$i++;
}
if($res)
{
   header("location:?detect=presence&id=".$id."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 
 }
                           }
                         

echo '
<form action="" method="POST">
<div class="row">
<div class="col-sm-10">
<table class="table">
    <tr>
    
           <th>ID</th>
          <th>Group</th>
           <th>Full Name</th>
             <th><input type="checkbox" name="checkall" id="checkall" class="form-control" style="height: calc(.65em + .65rem + 2px);">
</th>
           <th>Presence</th>
            </tr>
           ';


$sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id, 
  presence.prid, 
  presence.pnote, 
  presence.pre
FROM 
  registrations 
  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
  LEFT JOIN presence ON schedual.sid=presence.sid AND registrations.reg_id=presence.reg_id
WHERE 
  schedual.sid=:id
";
$rowss=$getCredit->get_by_id_query($sql,$id);
foreach($rowss as $rm)
{
 
  ?>
 
   
    <tr>
         <td><input type="hidden" name="prid[]" value="<?php echo $rm['prid'];?>"> <?php echo $rm['prid'];?></td>
         <td style="width: 260px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
       <td> 


<input type="hidden" name="pre[<?php echo $rm['reg_id'];?>]" value="0">
<input type="checkbox" name="pre[<?php echo $rm['reg_id'];?>]" value="1" class="form-control check" style="height: calc(.65em + .65rem + 2px);" <?php if($rm['pre'] == 1) echo 'checked'; ?>>

</td>
   
      <td style="width: 400px;"><input type="text" name="pnote[]" value="<?php echo $rm['pnote'];?>" placeholder="Presence note here" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Save</button></center>
</div>
</div>

</form>
';


}
?>

<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'exams':
      $id=$_GET['id'];
       $counts=$getCredit->count_by_string_two_col('schedual','sid',$id,'pid',$user_id);
       if($counts==0)
       {
        header("location:group"); 
        exit();
       }

     ?>
     
<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
 $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
WHERE 
 schedual.sid=:id
";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row){}

?>
  
                    <div class="row">
                      <div class="col-sm-12">
                        <?php echo '<h1 style="color:#0d67a5;"> Exam <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                      ?>
                       </div>
                      
               
                        </div>
                         <a href="?detect=addexam&id=<?php echo $id;?>"><button class="btn btn-success" >Add New </button></a>
           <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Exam</th>
<th>Date</th>
<th>Added By</th>
<th></th>

      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajaxp.php?detect=exams",
    type:"POST",
    data:{is_type:is_type,gid:<?php echo $id;?>}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>



     <?php 

       break;
       case 'addexam':
       $id=$_GET['id'];
             $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
WHERE 
 schedual.sid=:id
";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row){}

        if(count($rows)>0)
        {
echo '
<h1 style="color:#0d67a5;">Add Exam for <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong>
</h1>


';
                        if(isset($_POST['subpost'])){
                          $ename=$_POST['ename'];
                           $mid=$_POST['mid'];
                           $edes=$_POST['edes'];
                           $reg_id=$_POST['reg_id'];
                            $marks=$_POST['marks'];
                           $countm=$getCredit->count_by_string_two_col('exams','ename',$ename,'sid',$id);

                         if($countm>0)
                         {
                          $error[]='This exam name is already used for this schedual..'; 
                         }
             $folder ="uploads/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'document_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 if($file!='')
 {
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
 $error[] = 'Sorry, only JPG, JPEG, PNG, PDF files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your file is too large. Upload less than 1 MB in size.';
}
 }

 if($file=='')
{
    $new_image_name=Null;
}
if(!isset($error)){
              $lastid=$getCer->insert_exam($ename,$mid,$edes,$new_image_name,$user_id,$id);  
              if($lastid>0) 
              {
                 if($file!=''){
             move_uploaded_file($file, 'uploads/' . $new_image_name); 
           }
             for ($i = 0; $i < count($reg_id); $i++)
{
        $reg_ids=$reg_id[$i];
        $mark=$marks[$i];
$res=$getCer->insert_marks($id,$reg_ids,$mark,$user_id,$lastid,$id);
}

            }
            else 
            {
                $error[] ='Failed : Something went wrong'; 
            }                            

if($res)
{
  header("location:?detect=exams&id=".$id."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 }
                           }
                            if(isset($error)){
        foreach($error as $error){
            echo '<div class="errormsg">'.$error.'</div><br />';
        }
    }
                         
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="row">
   <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Name</label>
     <input type="text" name="ename" value="<?php if(isset($error)){ echo $ename;} ?>" class="form-control" required>
  </div>
  </div>
  <div class="col-sm-4">
      <div class="form-group">
    <label for="exampleInputEmail1">Module</label>
   <select name="mid" class="form-control" required>
    <option value=""> Select</option>
<?php 
$rowsm = $getCredit->fetch_all('modules', 'modname', 'ASC'); 
foreach($rowsm as $rowi) {
    echo '<option value="'.$rowi['mid'].'">'.$rowi['modname'].'</option>'; 
}
?>

                  
        </select>
  </div>
  </div>
  <div class="col-sm-4">
      
  </div>

  <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Description</label>
     <textarea name="edes" rows="5" class="form-control" required><?php if(isset($error)){ echo $edes;} ?></textarea>
  </div>
  </div>
  <div class="col-md-4">
       <div class="form-group">
        <br>
         <label class="lable">Attach Document</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
    <small>(JPG,PNG,JPEG,PDF)</small>
    <div id="error_image"></div>

  
  </div>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
       <div class="form-group">
<strong>Exam Score</strong>
  </div>
</div>



</div>
<?php echo '
<div class="row" style="width: 80%;background: #f2f2f2; border-radius: 10px; padding: 20px 0px;">
<div class="col-sm-12">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
            
           <th>Exam Score</th>
            </tr>
           ';

foreach($rows as $rm)
{
  ?>
    <tr> 
         <td style="width: 270px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
      
   
      <td style="width: 200px;"><input type="number" name="marks[]" placeholder="" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Add Exam</button></center>
</div>
</div>


';
}
else 
{
 echo 'No Record found'; 
}
?>
</form>

<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'editexam':
       $id=$_GET['id'];
         $sid=$_GET['sid'];
             

// $sql = "SELECT * 
//         FROM exams 
//         LEFT JOIN schedual ON exams.sid = schedual.sid 
//         LEFT JOIN ts_gtw_users ON exams.uid = ts_gtw_users.id
//         LEFT JOIN groups ON schedual.gid = groups.gid 
//         LEFT JOIN marks ON exams.eid = marks.eid 
//         LEFT JOIN registrations ON marks.reg_id = registrations.reg_id 
//         LEFT JOIN modules ON exams.mid = modules.mid 
//         WHERE exams.sid = :id AND exams.eid = :id2";

        $sql = "SELECT DISTINCT * 
        FROM exams 
        LEFT JOIN schedual ON exams.sid = schedual.sid 
        LEFT JOIN ts_gtw_users ON exams.uid = ts_gtw_users.id
        LEFT JOIN groups ON schedual.gid = groups.gid 
        LEFT JOIN marks ON exams.eid = marks.eid 
        LEFT JOIN registrations ON marks.reg_id = registrations.reg_id 
        LEFT JOIN modules ON exams.mid = modules.mid 
        WHERE exams.sid = :id AND marks.eid = :id2";



$rows=$getCredit->get_by_id_query_two_col($sql,$sid,$id);
foreach($rows as $row){}

        if(count($rows)>0)
        {
echo '
<h1 style="color:#0d67a5;">Edit Exam for <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong>
</h1>

';
                        if(isset($_POST['subpost'])){
                          $ename=$_POST['ename'];
                           $mid=$_POST['mid'];
                           $edes=$_POST['edes'];
                           $maid=$_POST['maid'];
                            $marks=$_POST['marks'];
             $folder ="uploads/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'document_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 $rows=$getCredit->get_by_id('exams','eid',$id); 
  foreach($rows as $row)
  {
      $uesource=$row['esource'];
      $oldename=$row['ename'];
  }
  if($oldename!=$ename)
  {
    $countm=$getCredit->count_by_string_two_col('exams','ename',$ename,'sid',$sid);

                         if($countm>0)
                         {
                          $error[]='This exam name is already used for this schedual..'; 
                         }

  }

 if($file!='')
 {
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
 $error[] = 'Sorry, only JPG, JPEG, PNG, PDF files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your file is too large. Upload less than 1 MB in size.';
}

 }

 if($file=='')
{
    $new_image_name=$uesource;
}
if(!isset($error)){
              $lastid=$getCer->update_exam($ename,$mid,$edes,$new_image_name,$id);  
              if($lastid)  
              {
 if($file!=''){
             unlink('uploads/'.$uesource);
             move_uploaded_file($file, 'uploads/' . $new_image_name); 
           }

                for ($i = 0; $i < count($maid); $i++)
{
        $maids=$maid[$i];
        $mark=$marks[$i];
$res=$getCer->update_marks($maids,$mark);
}

              }  
              else 
{
  $error[] ='Failed : Something went wrong'; 
}                          

if($res)
{
  header("location:?detect=editexam&&id=".$id."&sid=".$sid."&action=Saved");
 //echo '<div class="success">Saved</div>';
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
 }

                           }

                         
?>
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>

<form action="" method="post" enctype="multipart/form-data">
  <?php foreach($rows as $rmk)
  {}
  ?>
<div class="row">
   <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Name</label>
     <input type="text" name="ename" value="<?php echo $rmk['ename'];?>" class="form-control" required>
  </div>
  </div>
  <div class="col-sm-4">
      <div class="form-group">
    <label for="exampleInputEmail1">Module</label>
   <select name="mid" class="form-control" required>
    <option value="<?php echo $rmk['mid'];?>" style="background:#d7d1d0;"><?php echo $rmk['modname'];?></option>
<?php 
$rowsm = $getCredit->fetch_all('modules', 'modname', 'ASC'); 
foreach($rowsm as $rowi) {
    echo '<option value="'.$rowi['mid'].'">'.$rowi['modname'].'</option>'; 
}
?>

                  
        </select>
  </div>
  </div>
  <div class="col-sm-4">
      
  </div>

  <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Description</label>
     <textarea name="edes" rows="5" class="form-control" required><?php echo $rmk['edes'];?></textarea>
  </div>
  </div>
  <div class="col-md-4">
       <div class="form-group">
        <br>
         <label class="lable">Attach Document</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
    <small>(JPG,PNG,JPEG,PDF)</small>
 <?php 
    if($rmk['esource']!='')
    {
        echo '<br>'.$rmk['esource'].' &nbsp; <a target="_blank" class="btn btn-success" href="uploads/'.$rmk['esource'].'">View</a>';
    }
    else 
    {
          echo 'N/A';
    }
    ?>

  
  </div>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
       <div class="form-group">
<strong>Exam Score</strong>
  </div>
</div>



</div>
<?php echo '
<div class="row" style="width: 80%;background: #f2f2f2; border-radius: 10px; padding: 20px 0px;">
<div class="col-sm-12">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
            
           <th>Exam Score</th>
            </tr>
           ';

foreach($rows as $rm)
{
  ?>
    <tr> 
         <td style="width: 270px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="maid[]" value="<?php echo $rm['maid'];?>"><?php echo $rm['name'];?></td>
      
   
      <td style="width: 200px;"><input type="number" value="<?php echo $rm['marks'];?>" name="marks[]" placeholder="" class="form-control"></td>
    </tr>
 
<?php } 
echo '</table>
<center> <button type="submit" name="subpost" class="btn plan-button btn-lg">Save</button></center>
</div>
</div>


';
}
else 
{
 echo 'No Record found'; 
}
?>
</form>

<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'delexam': 
  // $id=$_GET['id'];
  // $sid=$_GET['sid'];
  // $getCredit->delete_by_id('marks','eid',$id);
  // $res=$getCredit->delete_by_id('exams','eid',$id);
  //    if($res)
  //    {
  //     header("Location:group?detect=exams&id=".$sid."&action=Deleted");
  //    }
  //    else 
  //    {
  //     echo 'Something went wrong.....';
  //    }
  break;

  case 'del': 
  // $id=$_GET['id'];
  // $rows=$getCredit->get_by_id('schedual','gid',$id);
  // foreach($rows as $row)
  // {
  //   $sid=$row['sid'];
  //    $getCredit->delete_by_id('presence','sid',$sid);
  //    $getCredit->delete_by_id('exams','sid',$sid);
  // }
  // $getCredit->delete_by_id('schedual','gid',$id);
  //  $getCredit->delete_by_id('inscription','gid',$id);
  // $res=$getCredit->delete_by_id('groups','gid',$id);
  //    if($res)
  //    {
  //     header("Location:group?action=Deleted");
  //    }
  //    else 
  //    {
  //     echo 'Something went wrong.....';
  //    }

  break;
  default:

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Group</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

                    
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Group </button></a>
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
  <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Group Name</th>
<th>Formation</th>
<th>Schedule</th>
<th>Status</th>
<th>Seances</th>
<th>Added  By</th>
<th>Created</th>

      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajaxp.php?detect=group",
    type:"POST",
    data:{is_type:is_type}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>
<?php } ?>

                   </div> 
  <?php 
  break; 
  case 'employee':
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
  case 'seances':
  $id=$_GET['id'];
    $query="SELECT *
FROM groups  
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND groups.gid='$id'
";
$count=$getCredit->count_by_query($query); 
if($count==0)
{
  header("location:group");
  exit();
}

  ?>

<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
   $sql="SELECT * 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
 WHERE groups.gid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
  $gid=$row['gid'];
?>
  
                    <div class="row">
                      <div class="col-sm-4"> </div>
                       <div class="col-sm-4" > <h2 style=" color: #000;
    padding: 10px;
    background: #dcfff3;
    border: 1px solid green; border-radius:5px;">Seances of Groupe <strong><?php echo $row['gname'];?></strong></h2></div>
                   <div class="col-sm-4"> </div>
                        </div>
           <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Prof</th>
<th>Date Seance</th>
<th></th>
<th></th>

      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajaxy.php?detect=seance",
    type:"POST",
    data:{is_type:is_type,gid:<?php echo $gid;?>}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>



<?php } ?>
  <?php 
     break; 
     case 'presence':
       $id=$_GET['id'];
        $query="SELECT *
FROM groups  
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
LEFT JOIN schedual ON groups.gid=schedual.gid
 WHERE links.id='$user_id' AND schedual.sid='$id'
";
$counts=$getCredit->count_by_query($query);
if($counts==0)
       {
        header("location:group"); 
        exit();
       }

             $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
WHERE 
 schedual.sid=:id
";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row){}

       $count=$getCredit->count_by_id('presence','sid',$id); 
       if($count==0)
       {
        

        if(count($rows)>0)
        {
 
echo '
<h1 style="color:#0d67a5;"> List Presence of <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                        
                        
echo '
<div class="row">
<div class="col-sm-10">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
             <th><input type="checkbox" name="checkall" id="checkall" class="form-control" style="height: calc(.65em + .65rem + 2px);"></th>
           <th>Presence</th>
            </tr>
           ';
foreach($rows as $rm)
{
  ?>
 
   
    <tr>
     
         <td style="width: 260px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
       <td> 
        <input type="hidden" name="pre[<?php echo $rm['reg_id'];?>]" value="0">
 <input type="checkbox" name="pre[<?php echo $rm['reg_id'];?>]" value="1" class="form-control check" style="height: calc(.65em + .65rem + 2px);">
</td>
   
      <td style="width: 400px;"><input type="text" name="pnote[]"  class="form-control" readonly></td>
    </tr>
 
<?php } 
echo '</table>
</div>
</div>
';
}
else 
{
 echo 'No Record found'; 
}

}

else 
{ // edit 
  ?>
  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}


echo '
<h1 style="color:#0d67a5;"> List Presence of <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                        
                         

echo '

<div class="row">
<div class="col-sm-10">
<table class="table">
    <tr>
    
           <th>ID</th>
          <th>Group</th>
           <th>Full Name</th>
             <th><input type="checkbox" name="checkall" id="checkall" class="form-control" style="height: calc(.65em + .65rem + 2px);">
</th>
           <th>Presence</th>
            </tr>
           ';


$sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id, 
  presence.prid, 
  presence.pnote, 
  presence.pre
FROM 
  registrations 
  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
  LEFT JOIN presence ON schedual.sid=presence.sid AND registrations.reg_id=presence.reg_id
WHERE 
  schedual.sid=:id
";
$rowss=$getCredit->get_by_id_query($sql,$id);
foreach($rowss as $rm)
{
 
  ?>
 
   
    <tr>
         <td><input type="hidden" name="prid[]" value="<?php echo $rm['prid'];?>"> <?php echo $rm['prid'];?></td>
         <td style="width: 260px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="reg_id[]" value="<?php echo $rm['reg_id'];?>"><?php echo $rm['name'];?></td>
       <td> 


<input type="hidden" name="pre[<?php echo $rm['reg_id'];?>]" value="0" readonly>
<input type="checkbox" name="pre[<?php echo $rm['reg_id'];?>]" value="1" class="form-control check" style="height: calc(.65em + .65rem + 2px);" <?php if($rm['pre'] == 1) echo 'checked'; ?> readonly>

</td>
   
      <td style="width: 400px;"><input type="text" name="pnote[]" value="<?php echo $rm['pnote'];?>"  class="form-control" readonly></td>
    </tr>
 
<?php } 
echo '</table>
</div>
</div>

';


}
?>

<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'exams':
      $id=$_GET['id'];
             $query="SELECT *
FROM groups  
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
LEFT JOIN schedual ON groups.gid=schedual.gid
 WHERE links.id='$user_id' AND schedual.sid='$id'
";
$counts=$getCredit->count_by_query($query);
if($counts==0)
       {
        header("location:group"); 
        exit();
       }
     ?>
     
<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
 $sql="SELECT * 
FROM schedual 
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE schedual.sid=:id";         
 $sql = "SELECT 
  groups.gname, 
  registrations.name, 
  registrations.reg_id,
  schedual.sdate
FROM 
  registrations 

  INNER JOIN inscription ON registrations.reg_id=inscription.reg_id 
  INNER JOIN groups ON inscription.gid=groups.gid 
  INNER JOIN schedual ON groups.gid=schedual.gid 
WHERE 
 schedual.sid=:id
";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row){}

?>
  
                    <div class="row">
                      <div class="col-sm-12">
                        <?php echo '<h1 style="color:#0d67a5;"> Exam <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong></h1>';
                      ?>
                       </div>
                      
               
                        </div>
                        
           <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Exam</th>
<th>Date</th>
<th>Added By</th>
<th></th>

      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajaxy.php?detect=exams",
    type:"POST",
    data:{is_type:is_type,gid:<?php echo $id;?>}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>



     <?php 
     break;
     case 'editexam':
       $id=$_GET['id'];
         $sid=$_GET['sid'];
                  $query="SELECT *
FROM groups  
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
LEFT JOIN schedual ON groups.gid=schedual.gid
 WHERE links.id='$user_id' AND schedual.sid='$sid'
";
 $counts=$getCredit->count_by_query($query);
if($counts==0)
       {
        header("location:group"); 
        exit();
       }


// $sql = "SELECT * 
//         FROM exams 
//         LEFT JOIN schedual ON exams.sid = schedual.sid 
//         LEFT JOIN ts_gtw_users ON exams.uid = ts_gtw_users.id
//         LEFT JOIN groups ON schedual.gid = groups.gid 
//         LEFT JOIN marks ON exams.eid = marks.eid 
//         LEFT JOIN registrations ON marks.reg_id = registrations.reg_id 
//         LEFT JOIN modules ON exams.mid = modules.mid 
//         WHERE exams.sid = :id AND exams.eid = :id2";

        $sql = "SELECT DISTINCT * 
        FROM exams 
        LEFT JOIN schedual ON exams.sid = schedual.sid 
        LEFT JOIN ts_gtw_users ON exams.uid = ts_gtw_users.id
        LEFT JOIN groups ON schedual.gid = groups.gid 
        LEFT JOIN marks ON exams.eid = marks.eid 
        LEFT JOIN registrations ON marks.reg_id = registrations.reg_id 
        LEFT JOIN modules ON exams.mid = modules.mid 
        WHERE exams.sid = :id AND marks.eid = :id2";



$rows=$getCredit->get_by_id_query_two_col($sql,$sid,$id);
foreach($rows as $row){}

        if(count($rows)>0)
        {
echo '
<h1 style="color:#0d67a5;">Edit Exam for <strong>Day '.$getDatabase->easy_date2($row['sdate']).' ('.$getDatabase->easy_dayname2($row['sdate']).')</strong>
</h1>

';
                      
?>
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
  <?php foreach($rows as $rmk)
  {}
  ?>
<div class="row">
   <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Name</label>
     <input type="text" name="ename" value="<?php echo $rmk['ename'];?>" class="form-control" disabled>
  </div>
  </div>
  <div class="col-sm-4">
      <div class="form-group">
    <label for="exampleInputEmail1">Module</label>
   <select name="mid" class="form-control" required disabled>
    <option value="<?php echo $rmk['mid'];?>" style="background:#d7d1d0;"><?php echo $rmk['modname'];?></option>

        </select>
  </div>
  </div>
  <div class="col-sm-4">
      
  </div>

  <div class="col-sm-4">
      <div class="form-group">          
    <label for="exampleInputEmail1">Exam Description</label>
     <textarea name="edes" rows="5" class="form-control" required disabled><?php echo $rmk['edes'];?></textarea>
  </div>
  </div>
  <div class="col-md-4">
       <div class="form-group">
        <br>
         <label class="lable">Attach Document</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;" disabled>
    <small>(JPG,PNG,JPEG,PDF)</small>
 <?php 
    if($rmk['esource']!='')
    {
        echo '<br>'.$rmk['esource'].' &nbsp; <a target="_blank" class="btn btn-success" href="uploads/'.$rmk['esource'].'">View</a>';
    }
    else 
    {
          echo 'N/A';
    }
    ?>

  
  </div>
</div>
<div class="col-md-4">
</div>
<div class="col-md-4">
       <div class="form-group">
<strong>Exam Score</strong>
  </div>
</div>



</div>
<?php echo '
<div class="row" style="width: 80%;background: #f2f2f2; border-radius: 10px; padding: 20px 0px;">
<div class="col-sm-12">
<table class="table">
    <tr>
    
      
          <th>Group</th>
           <th>Full Name</th>
            
           <th>Exam Score</th>
            </tr>
           ';

foreach($rows as $rm)
{
  ?>
    <tr> 
         <td style="width: 270px;"><?php echo $rm['gname'];?></td>
      <td><i class="fa fa-user"></i> <input type="hidden" name="maid[]" value="<?php echo $rm['maid'];?>" disabled><?php echo $rm['name'];?></td>
      
   
      <td style="width: 200px;"><input type="number" value="<?php echo $rm['marks'];?>" name="marks[]" placeholder="" class="form-control" disabled></td>
    </tr>
 
<?php } 
echo '</table>

</div>
</div>


';
}
else 
{
 echo 'No Record found'; 
}
?>


<script>
  $(document).ready(function() {
    $('#checkall').click(function() {
      $('.check').prop('checked', this.checked);
    });
  });
</script>


     <?php 
     break;
     case 'delexam': 
  // $id=$_GET['id'];
  // $sid=$_GET['sid'];
  // $getCredit->delete_by_id('marks','eid',$id);
  // $res=$getCredit->delete_by_id('exams','eid',$id);
  //    if($res)
  //    {
  //     header("Location:group?detect=exams&id=".$sid."&action=Deleted");
  //    }
  //    else 
  //    {
  //     echo 'Something went wrong.....';
  //    }
  break;

  case 'del': 
  // $id=$_GET['id'];
  // $rows=$getCredit->get_by_id('schedual','gid',$id);
  // foreach($rows as $row)
  // {
  //   $sid=$row['sid'];
  //    $getCredit->delete_by_id('presence','sid',$sid);
  //    $getCredit->delete_by_id('exams','sid',$sid);
  // }
  // $getCredit->delete_by_id('schedual','gid',$id);
  //  $getCredit->delete_by_id('inscription','gid',$id);
  // $res=$getCredit->delete_by_id('groups','gid',$id);
  //    if($res)
  //    {
  //     header("Location:group?action=Deleted");
  //    }
  //    else 
  //    {
  //     echo 'Something went wrong.....';
  //    }

  break;
  default:

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Group</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
  <div class="row">
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Group Name</th>
<th>Formation</th>
<th>Schedule</th>
<th>Status</th>
<th>Seances</th>
<th>Added  By</th>
<th>Created</th>

      </tr>
     </thead>
    </table>
   </div>
   </div>
     
   </div>   
      <script type="text/javascript" language="javascript" >
$(document).ready(function(){
 
 load_data();

 function load_data(is_type)
 {
  var dataTable = $('#product_data').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],
   "ajax":({
    url:"ajaxy.php?detect=group",
    type:"POST",
    data:{is_type:is_type}
   }),

   "columnDefs":[
    {
     "targets":[2],
     "orderable":false,
    },
   ],


  });
 }
 
 $(document).on('change', '#is_type', function(){
  var category = $(this).val();
  
  $('#product_data').DataTable().destroy();
  if(category != '')
  {
      
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>
<?php } ?>

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