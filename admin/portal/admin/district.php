<?php require_once("../autoload.php"); 
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login");}
?>
  <script src="ckeditor/ckeditor.js"></script>
<?php include("header.php"); ?>
                <?php include("sidebar.php"); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>District</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

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
                    
                    <div class="col-md-9">
                        <?php 
    
                        if(isset($_POST['subpost'])){     
                    $st_name=trim($_POST['st_name']); 
                    $sid=trim($_POST['sid']); 
              if($st_name ==''){
            $error[] = 'Please enter District Name.';
        }

         if(!isset($error)){ 
          $arr=explode(",",$st_name);
foreach($arr as $sname)
{
  $result=$getCer->insert_district($sname,$sid);
}

           if($result)
    {   
   header("Location:district.php?action=Created");
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
                    <div class="form-group">
    <label for="exampleInputEmail1">District Name </label>
    <textarea name="st_name" class="form-control" rows="5"><?php if(isset($error)){ echo $_POST['st_name'];}?></textarea>
   <small>For multiple use commas between name</small>
  </div>


  
                    </div>
                     <div class="col-md-3"> 
<br>
<div class="form-group">
<select name="sid" class="form-control" required>
 <option value="">Select State</option> 
 <?php 
 $rows=$getCredit->fetch_all('pstate','sname','ASC');
 foreach($rows as $row)
 {
echo '<option value="'.$row['sid'].'">'.$row['sname'].'</option>';
 }
 ?>

</select>
</div>
<br><br>
<div class="form-group">
  <button type="submit" name="subpost" class="btn btn-primary btn-lg btn-block">Create</button>
  </div>

  </form>
              
                    </div>
                </div>
  <?php 
  break; 
  case 'edit':
  $id=$_GET['id'];
  
  ?> 
  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
            $id=$_GET['id'];
                        if(isset($_POST['subsave'])){     
                            $st_name=trim($_POST['st_name']); 
                             $sid=trim($_POST['sid']); 

              if($st_name ==''){
            $error[] = 'Please enter the district name.';
        }
        $rows=$getCredit->get_by_string('pdistrict','did',$id);
foreach($rows as $row)
{
    $oldst_name=$row['dname'];
}
if($oldst_name!=$st_name){
        $count=$getCredit->count_by_id('pdistrict','dname',$st_name); 
if($count>0)
{
$error[] = 'This District is already created..';
}
}
         if(!isset($error)){ 

$result=$getCer->update_district($st_name,$sid,$id);
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
$rows=$getCredit->get_by_id('pdistrict','did',$id);
foreach($rows as $row)
{
    $st_name=$row['dname'];
     $sid=$row['sid'];
}
?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="form-group">
    <label for="exampleInputEmail1">District Name</label>
    <input type="text" name="st_name" value="<?php echo $st_name;?>" class="form-control" required="">
  </div>
                    </div>
                     <div class="col-md-3"> 
                      <br>
<div class="form-group">
<select name="sid" class="form-control" required>
 <option value="<?php echo $sid;?>" style="background: #EAEAEA;"><?php echo $getCredit->get_sname($sid);?></option> 
 <?php 
 $rows=$getCredit->fetch_all('pstate','sname','ASC');
 foreach($rows as $row)
 {
echo '<option value="'.$row['sid'].'">'.$row['sname'].'</option>';
 }
 ?>

</select>
</div>
<br>
<div class="form-group">
  <button type="submit" name="subsave" class="btn btn-primary btn-lg btn-block">Save</button>

  </form>
         </div>
                </div>  
   
  <?php 
  break; 
  case 'del': 
  $id=$_GET['id'];
     $res=$getCredit->delete_by_id('pdistrict','did',$id);
     if($res)
     {
      header("Location:district.php?action=Deleted");
     }
     else 
     {
      echo 'Something went wrong.....';
     }
  break;
  default:
?> 
 <div class="row">  
  <div class="col-sm-12">
     <a href="?detect=add"><button class="btn btn-success">Add New </button></a>
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>

  </div>  
 </div>                 

 

  <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
         <tr>
               <th>District Name</th>   
          <th>State Name</th>
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
    url:"ajax.php?detect=district",
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
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
   <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
  </body>
</html>