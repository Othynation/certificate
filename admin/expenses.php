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
                <h3>Add New Charge</h3>

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
  $etype = trim($_POST['etype']);
  $eamount = trim($_POST['eamount']);
  $enote = trim($_POST['enote']);
  $edate = trim($_POST['edate']);
  $cent_id = trim($_POST['cent_id']); 

    if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $eamount)) {
    $error[]="Invalid amount. Please enter a valid number.";
}

   // Assuming cent_id is selected from a dropdown

  if(!isset($error)){
    $result = $getCer->insert_expense($etype, $eamount, $enote, $edate, $cent_id,$user_id);
    if($result) {
      header("Location:expenses?action=Created");
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
        <label for="exampleInputEmail1">Charge Type</label>
        <select name="etype" class="form-control" required>
          <option value="">Select</option>
          <!-- Add options here, e.g., -->
          <option value="Teacher Payment">Teacher Payment</option>
          <option value="Ingredient">Ingredient</option>
          <option value="Other">Other</option>
          <!-- ... -->
        </select>
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
        <label for="exampleInputEmail1">Amount</label>
        <input type="number" name="eamount" class="form-control" required>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Note</label>
        <input type="text" name="enote" class="form-control">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Date</label>
        <input type="date" name="edate" value="<?php echo date("Y-m-d"); ?>" class="form-control">
      </div>
    </div>
    <div class="col-sm-12 form-group" style="text-align:center;">
      <br>
      <button type="submit" name="subpost" class="btn btn-success">Add Expense</button>
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
                <h3>Edit Expense</h3>

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
                          $etype = trim($_POST['etype']);
  $eamount = trim($_POST['eamount']);
  $enote = trim($_POST['enote']);
  $edate = trim($_POST['edate']);
  $cent_id = trim($_POST['cent_id']); 
      if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $eamount)) {
    $error[]="Invalid amount. Please enter a valid number.";
}


         if(!isset($error)){ 
$result=$getCer->update_expense($etype, $eamount, $enote, $edate, $cent_id,$id);

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
FROM expenses 
LEFT JOIN centres ON expenses.cent_id=centres.cent_id WHERE expenses.exid=:id";        
$rows=$getCredit->get_by_id_query($sql,$id);

foreach($rows as $row)
{
?>
 <form action="" method="POST" enctype='multipart/form-data'>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Charge Type</label>
        <select name="etype" class="form-control" required>
          <option value="<?php echo $row['etype']?>" style="background: #e3e2e1;"><?php echo $row['etype']?></option>
          <!-- Add options here, e.g., -->
          <option value="Teacher Payment">Teacher Payment</option>
          <option value="Ingredient">Ingredient</option>
          <option value="Other">Other</option>
          <!-- ... -->
        </select>
      </div>
    </div>
    <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" required>
 <option value="<?php echo $row['cent_id']?>" style="background: #e3e2e1;"><?php echo $row['centre_name']?></option> 
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
        <label for="exampleInputEmail1">Amount</label>
        <input type="number" name="eamount" value="<?php echo $row['eamount'];?>" class="form-control" required>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Note</label>
        <input type="text" name="enote" value="<?php echo $row['enote'];?>" class="form-control">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Date</label>
        <input type="date" name="edate" value="<?php echo $row['edate'];?>" value="<?php echo date("Y-m-d"); ?>" class="form-control">
      </div>
    </div>
    <div class="col-sm-12 form-group" style="text-align:center;">
      <br>
      <button type="submit" name="subpost" class="btn btn-success">Save Expense</button>
    </div>
  </div>
</form>

<?php } ?>
              
                    </div>
                </div>
  <?php 
  break;
  case 'del': 
  $id=$_GET['id'];
     $res=$getCredit->delete_by_id('expenses','exid',$id);
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
                <h3>All Expenses</h3>
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
       <th>Charge Type</th>
        <th>Amount</th>
          <th>Note</th>
            <th>Charge Date</th>
            <th>Added By</th>
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
    url:"ajax.php?detect=expenses",
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
                <h3>Add New Charge</h3>

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
  $etype = trim($_POST['etype']);
  $eamount = trim($_POST['eamount']);
  $enote = trim($_POST['enote']);
  $edate = trim($_POST['edate']);
  $cent_id = trim($_POST['cent_id']); 

    if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $eamount)) {
    $error[]="Invalid amount. Please enter a valid number.";
}

 $countc=$getCredit->count_by_string_two_col('links','id',$user_id,'cent_id',$cent_id);
                           if($countc==0)
                           {
                           $error[]='Invalid centre'; 
                           }
          

   // Assuming cent_id is selected from a dropdown

  if(!isset($error)){
    $result = $getCer->insert_expense($etype, $eamount, $enote, $edate, $cent_id,$user_id);
    if($result) {
      header("Location:expenses?action=Created");
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
        <label for="exampleInputEmail1">Charge Type</label>
        <select name="etype" class="form-control" required>
          <option value="">Select</option>
          <!-- Add options here, e.g., -->
          <option value="Teacher Payment">Teacher Payment</option>
          <option value="Ingredient">Ingredient</option>
          <option value="Other">Other</option>
          <!-- ... -->
        </select>
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
        <label for="exampleInputEmail1">Amount</label>
        <input type="number" name="eamount" class="form-control" required>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Note</label>
        <input type="text" name="enote" class="form-control">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Date</label>
        <input type="date" name="edate" value="<?php echo date("Y-m-d"); ?>" class="form-control">
      </div>
    </div>
    <div class="col-sm-12 form-group" style="text-align:center;">
      <br>
      <button type="submit" name="subpost" class="btn btn-success">Add Expense</button>
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
FROM expenses 
LEFT JOIN centres ON expenses.cent_id=centres.cent_id
LEFT JOIN ts_gtw_users ON expenses.uid=ts_gtw_users.id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND expenses.exid='$id';
";
    $count=$getCredit->count_by_query2($sql);
  
     //$count=$getCredit->count_by_string_two_col('expenses','exid',$id,'uid',$user_id);
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
                <h3>Edit Expense</h3>

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
                          $etype = trim($_POST['etype']);
  $eamount = trim($_POST['eamount']);
  $enote = trim($_POST['enote']);
  $edate = trim($_POST['edate']);
  $cent_id = trim($_POST['cent_id']); 
      if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $eamount)) {
    $error[]="Invalid amount. Please enter a valid number.";
}


         if(!isset($error)){ 
$result=$getCer->update_expense($etype, $eamount, $enote, $edate, $cent_id,$id);

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
FROM expenses 
LEFT JOIN centres ON expenses.cent_id=centres.cent_id WHERE expenses.exid=:id";        
$rows=$getCredit->get_by_id_query($sql,$id);

foreach($rows as $row)
{
?>
 <form action="" method="POST" enctype='multipart/form-data'>
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Charge Type</label>
        <select name="etype" class="form-control" required>
          <option value="<?php echo $row['etype']?>" style="background: #e3e2e1;"><?php echo $row['etype']?></option>
          <!-- Add options here, e.g., -->
          <option value="Teacher Payment">Teacher Payment</option>
          <option value="Ingredient">Ingredient</option>
          <option value="Other">Other</option>
          <!-- ... -->
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

    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Amount</label>
        <input type="number" name="eamount" value="<?php echo $row['eamount'];?>" class="form-control" required>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Note</label>
        <input type="text" name="enote" value="<?php echo $row['enote'];?>" class="form-control">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Date</label>
        <input type="date" name="edate" value="<?php echo $row['edate'];?>" value="<?php echo date("Y-m-d"); ?>" class="form-control">
      </div>
    </div>
    <div class="col-sm-12 form-group" style="text-align:center;">
      <br>
      <button type="submit" name="subpost" class="btn btn-success">Save Expense</button>
    </div>
  </div>
</form>

<?php } ?>
              
                    </div>
                </div>
  <?php 
  break;
  case 'del': 
  // $id=$_GET['id'];
  //    $res=$getCredit->delete_by_id('expenses','exid',$id);
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
                <h3>All Expenses</h3>
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
       <th>Charge Type</th>
        <th>Amount</th>
          <th>Note</th>
            <th>Charge Date</th>
          
<th>Edit </th>

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
    url:"ajaxm.php?detect=expenses",
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
                <h3>All Expenses</h3>
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
       <th>Charge Type</th>
        <th>Amount</th>
          <th>Note</th>
            <th>Charge Date</th>
            <th>Added By</th>

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
    url:"ajaxy.php?detect=expenses",
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