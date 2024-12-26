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
                <h3>Add New Module</h3>

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
                          $title=trim($_POST['title']); 
                           $fid=trim($_POST['fid']); 
                         
         if(!isset($error)){ 
$result=$getCer->insert_module($title,$fid,$user_id); 

           if($result)
    {
     
 header("Location:modules?action=Created");
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

?>


                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Parent Formation</label>
   <select name="fid" class="form-control" required>
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

   <div class="col-sm-6"> <div class="form-group">
    <label for="exampleInputEmail1">Module Name</label>
    <input type="text" name="title" class="form-control" required="">
   
  </div></div>
                  
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Add Module</button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
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
                <h3>Edit Module</h3>

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
                         $title=trim($_POST['title']); 
                           $fid=trim($_POST['fid']); 
         if(!isset($error)){ 
$result=$getCer->update_module($title,$fid,$id);

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
 $sql="
SELECT * 
FROM modules 
LEFT JOIN formation ON modules.fid=formation.fid 
WHERE modules.mid=:id 
";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)

{
?>


                   <form action="" method="POST" enctype='multipart/form-data'>

                    <div class="row">
                                         <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Parent Formation</label>
   <select name="fid" class="form-control" required>
         <option value="<?php echo $row['fid'];?>" style="background: #CBCDD1;"><?php echo $row['formation_name'];?></option>
<?php 
$rowsk = $getCredit->fetch_all('formation', 'formation_name', 'ASC'); // Fetch data ordered by formation_name ascending
foreach($rowsk as $rowk) {
    echo '<option value="'.$rowk['fid'].'">'.$rowk['formation_name'].'</option>'; 
}
?>                
        </select>
  </div>
                       </div>

   <div class="col-sm-6"> <div class="form-group">
    <label for="exampleInputEmail1">Module Name</label>
    <input type="text" name="title" value="<?php echo $row['modname'];?>" class="form-control" required="">
   
  </div></div>
                    
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
  <button type="submit" name="subpost" class="btn btn-success btn-lg">Save </button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>


                    </div>
                     <div class="col-md-3"> 
<br>
  
  
  

  </form>
<?php } ?>
              
                    </div>
                </div>
  <?php 
  break;
  case 'del': 
  $id=$_GET['id'];
     $res=$getCredit->delete_by_id('modules','mid',$id);
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
                <h3>Modules</h3>
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
       <th>Formation</th>
            <th>Module</th>
             <th>Added By</th>
            <th>Created</th>
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
    url:"ajax.php?detect=module",
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
                <h3>Add New Module</h3>

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
                          $title=trim($_POST['title']); 
                           $fid=trim($_POST['fid']); 
                         
         if(!isset($error)){ 
$result=$getCer->insert_module($title,$fid,$user_id); 

           if($result)
    {
     
 header("Location:modules?action=Created");
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

?>


                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Parent Formation</label>
   <select name="fid" class="form-control" required>
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

   <div class="col-sm-6"> <div class="form-group">
    <label for="exampleInputEmail1">Module Name</label>
    <input type="text" name="title" class="form-control" required="">
   
  </div></div>
                  
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Add Module</button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>
                    

  
                    </div>
                     <div class="col-md-3"> 
 
  </form>
              
                    </div>
                </div>

  <?php 
  break; 
   case 'edit':
    $id=$_GET['id'];
     $count=$getCredit->count_by_string_two_col('modules','mid',$id,'uid',$user_id);
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
                <h3>Edit Module</h3>

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
                         $title=trim($_POST['title']); 
                           $fid=trim($_POST['fid']); 
         if(!isset($error)){ 
$result=$getCer->update_module($title,$fid,$id);

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
 $sql="
SELECT * 
FROM modules 
LEFT JOIN formation ON modules.fid=formation.fid 
WHERE modules.mid=:id 
";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)

{
?>


                   <form action="" method="POST" enctype='multipart/form-data'>

                    <div class="row">
                                         <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Parent Formation</label>
   <select name="fid" class="form-control" required>
         <option value="<?php echo $row['fid'];?>" style="background: #CBCDD1;"><?php echo $row['formation_name'];?></option>
<?php 
$rowsk = $getCredit->fetch_all('formation', 'formation_name', 'ASC'); // Fetch data ordered by formation_name ascending
foreach($rowsk as $rowk) {
    echo '<option value="'.$rowk['fid'].'">'.$rowk['formation_name'].'</option>'; 
}
?>                
        </select>
  </div>
                       </div>

   <div class="col-sm-6"> <div class="form-group">
    <label for="exampleInputEmail1">Module Name</label>
    <input type="text" name="title" value="<?php echo $row['modname'];?>" class="form-control" required="">
   
  </div></div>
                    
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
  <button type="submit" name="subpost" class="btn btn-success btn-lg">Save </button>
</div>
<div class="col-sm-4">
</div>
                    
                    </div>


                    </div>
                     <div class="col-md-3"> 
<br>
  
  
  

  </form>
<?php } ?>
              
                    </div>
                </div>
  <?php 
  break;
  case 'delblock': 
  // $id=$_GET['id'];
  //    $res=$getCredit->delete_by_id('modules','mid',$id);
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
                <h3>Modules</h3>
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
       <th>Formation</th>
            <th>Module</th>
           
            <th>Created</th>
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
    url:"ajaxm.php?detect=module",
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
  case 'employee'
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
  default:
?> 
                      

  <?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
<div class="page-title">
              <div class="title_left">
                <h3>Modules</h3>
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
       <th>Formation</th>
            <th>Module</th>
             <th>Added by</th>
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
    url:"ajaxy.php?detect=module",
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