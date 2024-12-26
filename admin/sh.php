<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
?>
<?php include("header.php");
//if($postm!='admin'){header("location:index");exit();} 
?>
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
                <h3>Add New Salary</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
                       if(isset($_POST['subpost'])){
  $pid = trim($_POST['pid']);
  $shamount= trim($_POST['shamount']);
  if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $shamount)) {
    $error[]="Invalid salary amount. Please enter a valid number.";
}
  $shnote = trim($_POST['shnote']);
  $shdate = trim($_POST['shdate']);
  $cent_id = trim($_POST['cent_id']);  // Assuming cent_id is selected from a dropdown

  if(!isset($error)){
    $result = $getCer->insert_salary($pid, $shamount, $shnote, $shdate, $cent_id,$user_id);
    if($result) {
      $etype='Salary';
          $result = $getCer->insert_expense($etype, $shamount, $shnote, $shdate, $cent_id,$user_id);

      header("Location:?action=Created");
    } else{
      $error[] ='Failed : Something went wrong';
    }
  }
}

  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
}

?>

<form action="" method="POST" enctype='multipart/form-data'>
  <div class="row">

    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Prof</label>
<select name="pid" class="form-control" required>
  <?php 
  if(isset($_GET['pid']))
  {
     echo '<option value="'.$_GET['pid'].'" style="background: #CBCDD1;">'.$_GET['fname'].' '.$_GET['lname'].'</option>';
  }
  else 
  {
    echo '<option value=""> Select</option>';
  }
  ?>
<?php
$rowsr=$getCredit->get_by_string('ts_gtw_users','post','prof');
foreach($rowsr as $rowr){
echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';
}
?>
</select>

      </div>
    </div>
  
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Salary Amount</label>
        <input type="number" name="shamount" value="<?php if(isset($_GET['shamount'])){ echo $_GET['shamount'];} ?>" class="form-control" required>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        <textarea class="form-control" name="shnote"><?php if(isset($_GET['shnote'])){ echo $_GET['shnote'];} ?></textarea>
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

    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Date</label>
        <input type="date" name="shdate" value="<?php echo date("Y-m-d"); ?>" class="form-control">
      </div>
    </div>
    <div class="col-sm-12 form-group" style="text-align:center;">
      <br>
      <button type="submit" name="subpost" class="btn btn-success">Add Salary</button>
    </div>
  </div>
</form>

              
                    </div>
                </div>

  <?php 
  break; 
   case 'edit':
  ?> 
  
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Edit Salary History</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
                         $id=$_GET['id'];
                        if(isset($_POST['subpost'])){
                         $pid = trim($_POST['pid']);
  $shamount= trim($_POST['shamount']);
  $shnote = trim($_POST['shnote']);
  $shdate = trim($_POST['shdate']);
  $cent_id = trim($_POST['cent_id']);
    if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $shamount)) {
    $error[]="Invalid salary amount. Please enter a valid number.";
}
         if(!isset($error)){ 
 $result = $getCer->update_salary($pid, $shamount, $shnote, $shdate, $cent_id,$id);
           if($result)
    { 
echo '<div class="success">Saved</div>';
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
FROM sh
LEFT JOIN centres ON sh.cent_id=centres.cent_id 
LEFT JOIN ts_gtw_users ON sh.pid=ts_gtw_users.id
 WHERE sh.shid=:id";        
$rows=$getCredit->get_by_id_query($sql,$id);

foreach($rows as $row)
{
?>
 <form action="" method="POST" enctype='multipart/form-data'>
    <div class="row">
       
        <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Prof</label>
<select name="pid" class="form-control" required>
  <option value="<?php echo $row['id'];?>" style="background: #e0dedc;"><?php echo $row['fname'].' '.$row['lname'];?></option>
<?php
$rowsr=$getCredit->get_by_string('ts_gtw_users','post','prof');
foreach($rowsr as $rowr){
echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';
}
?>
</select>

      </div>
    </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Salary Amount</label>
                <input type="number" name="shamount" value="<?php echo $row['shamount']; ?>" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea class="form-control" name="shnote"><?php echo $row['shnote']; ?></textarea>
            </div>
        </div>
         
                       </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Centre</label>
                <select name="cent_id" class="form-control" required>
                    <option value="<?php echo $row['cent_id'];?>" style="background: #e0dedc;"><?php echo $row['centre_name'];?></option>
                  <?php 
$rowsc = $getCredit->fetch_all('centres', 'centre_name', 'ASC'); // Fetch data ordered by formation_name ascending
foreach($rowsc as $rowc) {
    echo '<option value="'.$rowc['cent_id'].'">'.$rowc['centre_name'].'</option>'; 
}
?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Date</label>
                <input type="date" name="shdate" value="<?php echo $row['shdate']; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-12 form-group" style="text-align:center;">
            <br>
            <button type="submit" name="subpost" class="btn btn-success">Save</button>
        </div>
    </div>
</form>


                    </div>
                </div>
  <?php 
}
  break;
  case 'del': 
  $id=$_GET['id'];
     $res=$getCredit->delete_by_id('sh','shid',$id);
     if($res)
     {
      header("Location:?action=Deleted");
     }
     else 
     {
      echo 'Something went wrong.....';
     }
  break;
  default:
?> 
                      

  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
<div class="page-title">
              <div class="title_left">
                <h3>Salary History</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

<a href="?detect=add"><button class="btn btn-success">Add New </button></a>

  <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>ID</th>
       <th>Salary Amount</th>
        <th>Paid To</th>
          <th>Description</th>
            <th>Date</th>
            <th>Added By</th>
            <th>Centre</th>
<th>Edit </th>
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
    url:"ajax.php?detect=sh",
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
                <h3>Add New Salary</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
                       if(isset($_POST['subpost'])){
  $pid = trim($_POST['pid']);
  $shamount= trim($_POST['shamount']);
  if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $shamount)) {
    $error[]="Invalid salary amount. Please enter a valid number.";
}
  $shnote = trim($_POST['shnote']);
  $shdate = trim($_POST['shdate']);
  $cent_id = trim($_POST['cent_id']);  // Assuming cent_id is selected from a dropdown
  $count=$getCredit->count_by_string_two_col('ts_gtw_users','id',$pid,'uid',$user_id);
  if($count==0)
  {
    $error[]='Invalid prof'; 
  }
   $countc=$getCredit->count_by_string_two_col('links','id',$user_id,'cent_id',$cent_id);
                           if($countc==0)
                           {
                           $error[]='Invalid centre'; 
                           }
          

  if(!isset($error)){
    $result = $getCer->insert_salary($pid, $shamount, $shnote, $shdate, $cent_id,$user_id);
    if($result) {
      $etype='Salary';
          $result = $getCer->insert_expense($etype, $shamount, $shnote, $shdate, $cent_id,$user_id);
          
      header("Location:?action=Created");
    } else{
      $error[] ='Failed : Something went wrong';
    }
  }
}

  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
}

?>

<form action="" method="POST" enctype='multipart/form-data'>
  <div class="row">

    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Prof</label>
<select name="pid" class="form-control" required>
  <?php 
  if(isset($_GET['pid']))
  {
     echo '<option value="'.$_GET['pid'].'" style="background: #CBCDD1;">'.$_GET['fname'].' '.$_GET['lname'].'</option>';
  }
  else 
  {
    echo '<option value=""> Select</option>';
  }
  ?>
<?php
$sql="SELECT ts_gtw_users.fname,ts_gtw_users.lname,ts_gtw_users.id 
FROM ts_gtw_users
LEFT JOIN centres ON ts_gtw_users.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rowsr=$getCredit->get_by_id_query($sql,$user_id); foreach($rowsr as $rowr){
echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';
}
?>
</select>

      </div>
    </div>
  
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Salary Amount</label>
        <input type="number" name="shamount" value="<?php if(isset($_GET['shamount'])){ echo $_GET['shamount'];} ?>" class="form-control" required>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        <textarea class="form-control" name="shnote"><?php if(isset($_GET['shnote'])){ echo $_GET['shnote'];} ?></textarea>
      </div>
    </div>
     <div class="col-sm-6">
       <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>

   <select name="cent_id" class="form-control" required>
    <option value="">Select Centre</option>
 <?php  $sql="SELECT * 
FROM centres 
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rowsk=$getCredit->get_by_id_query($sql,$user_id);
                      
 foreach($rowsk as $rowk)
 {
  echo '<option value="'.$rowk['cent_id'].'">'.$rowk['centre_name'].'</option>'; 
 }
        ?> 
                  
        </select>
  </div>

                       
                       </div>

    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Date</label>
        <input type="date" name="shdate" value="<?php echo date("Y-m-d"); ?>" class="form-control">
      </div>
    </div>
    <div class="col-sm-12 form-group" style="text-align:center;">
      <br>
      <button type="submit" name="subpost" class="btn btn-success">Add Salary</button>
    </div>
  </div>
</form>

              
                    </div>
                </div>

  <?php 
  break; 
   case 'edit':
      $id=$_GET['id'];
      $sql="SELECT count(*) as total
FROM sh 
LEFT JOIN centres ON sh.cent_id=centres.cent_id
LEFT JOIN ts_gtw_users ON sh.uid=ts_gtw_users.id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND sh.shid='$id';
";
    $count=$getCredit->count_by_query2($sql);

     //$count=$getCredit->count_by_string_two_col('sh','shid',$id,'uid',$user_id);
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
                <h3>Edit Salary History</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br><br>

  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
                      
                        if(isset($_POST['subpost'])){
                         $pid = trim($_POST['pid']);
  $shamount= trim($_POST['shamount']);
  $shnote = trim($_POST['shnote']);
  $shdate = trim($_POST['shdate']);
  $cent_id = trim($_POST['cent_id']);
    if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $shamount)) {
    $error[]="Invalid salary amount. Please enter a valid number.";
}
         if(!isset($error)){ 
 $result = $getCer->update_salary($pid, $shamount, $shnote, $shdate, $cent_id,$id);
           if($result)
    { 
echo '<div class="success">Saved</div>';
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
FROM sh
LEFT JOIN centres ON sh.cent_id=centres.cent_id 
LEFT JOIN ts_gtw_users ON sh.pid=ts_gtw_users.id
 WHERE sh.shid=:id";        
$rows=$getCredit->get_by_id_query($sql,$id);

foreach($rows as $row)
{
?>
 <form action="" method="POST" enctype='multipart/form-data'>
    <div class="row">
       
        <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Prof</label>
<select name="pid" class="form-control" required>
  <option value="<?php echo $row['id'];?>" style="background: #e0dedc;"><?php echo $row['fname'].' '.$row['lname'];?></option>
<?php
$sql="SELECT ts_gtw_users.fname,ts_gtw_users.lname,ts_gtw_users.id 
FROM ts_gtw_users
LEFT JOIN centres ON ts_gtw_users.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rowsr=$getCredit->get_by_id_query($sql,$user_id); foreach($rowsr as $rowr){
echo '<option value="'.$rowr['id'].'">'.$rowr['fname'].' '.$rowr['lname'].'</option>';
}
?>
</select>

      </div>
    </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Salary Amount</label>
                <input type="number" name="shamount" value="<?php echo $row['shamount']; ?>" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea class="form-control" name="shnote"><?php echo $row['shnote']; ?></textarea>
            </div>
        </div>
         
                       </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Centre</label>
                <select name="cent_id" class="form-control" required>
                    <option value="<?php echo $row['cent_id'];?>" style="background: #e0dedc;"><?php echo $row['centre_name'];?></option>
                  <?php 

$sql="SELECT * 
FROM centres 
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rowsc=$getCredit->get_by_id_query($sql,$user_id);
 // Fetch data ordered by formation_name ascending
foreach($rowsc as $rowc) {
    echo '<option value="'.$rowc['cent_id'].'">'.$rowc['centre_name'].'</option>'; 
}
?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Date</label>
                <input type="date" name="shdate" value="<?php echo $row['shdate']; ?>" class="form-control">
            </div>
        </div>
        <div class="col-sm-12 form-group" style="text-align:center;">
            <br>
            <button type="submit" name="subpost" class="btn btn-success">Save</button>
        </div>
    </div>
</form>


                    </div>
                </div>
  <?php 
}
  break;
  case 'delblock': 
  // $id=$_GET['id'];
  //    $res=$getCredit->delete_by_id('sh','shid',$id);
  //    if($res)
  //    {
  //     header("Location:?action=Deleted");
  //    }
  //    else 
  //    {
  //     echo 'Something went wrong.....';
  //    }
  break;
  default:
?> 
                      

  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
<div class="page-title">
              <div class="title_left">
                <h3>Salary History</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

<a href="?detect=add"><button class="btn btn-success">Add New </button></a>

  <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>ID</th>
       <th>Salary Amount</th>
        <th>Paid To</th>
          <th>Description</th>
            <th>Date</th>
 
            <th>Centre</th>
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
    url:"ajaxm.php?detect=sh",
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
          
    <div class="page-title">
              <div class="title_left">
                <h3>Salary History</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

  <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>ID</th>
       <th>Salary Amount</th>
        <th>Paid To</th>
          <th>Description</th>
            <th>Date</th>
            <th>Added By</th>
            <th>Centre</th>
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
    url:"ajaxy.php?detect=sh",
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


                   </div>
  <?php 
  break; 
  default :
  header("location:index");
  break; 
  
}


   ?>
        <!-- /top navigation -->

        <!-- page content -->

          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
   <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
  </body>
</html>