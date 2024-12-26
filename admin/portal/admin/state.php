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
                <h3>State</h3>
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
              if($st_name ==''){
            $error[] = 'Please enter State Name.';
        }

         if(!isset($error)){ 
          $arr=explode(",",$st_name);
foreach($arr as $sname)
{
  $result=$getCer->insert_state($sname);
}

           if($result)
    {   
   header("Location:state.php?action=Created");
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
    <label for="exampleInputEmail1">State Name </label>
    <textarea name="st_name" class="form-control" rows="5"><?php if(isset($error)){ echo $_POST['st_name'];}?></textarea>
   <small>For multiple use commas between states name</small>
  </div>

<button type="submit" name="subpost" class="btn btn-primary" style="float:right;">Create</button>
  
                    </div>
                     <div class="col-md-3"> 
<br>

  
  

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

              if($st_name ==''){
            $error[] = 'Please enter the State Name.';
        }
        $rows=$getCredit->get_by_string('pstate','sid',$id);
foreach($rows as $row)
{
    $oldst_name=$row['sname'];
}
if($oldst_name!=$st_name){
        $count=$getCredit->count_by_id('pstate','sname',$st_name); 
if($count>0)
{
$error[] = 'This State is already created..';
}
}
         if(!isset($error)){ 

$result=$getCer->update_state($st_name,$id);
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
$rows=$getCredit->get_by_id('pstate','sid',$id);
foreach($rows as $row)
{
    $st_name=$row['sname'];
}
?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="form-group">
    <label for="exampleInputEmail1">State Name</label>
    <input type="text" name="st_name" value="<?php echo $st_name;?>" class="form-control" required="">
  </div>
  <center><button type="submit" name="subsave" class="btn btn-primary btn-lg">Save</button></center>
                    </div>
                     <div class="col-md-3"> 
<br>
  </form>
         </div>
                </div>  
   
  <?php 
  break; 
  case 'del': 
  $id=$_GET['id'];
     $res=$getCredit->delete_by_id('pstate','sid',$id);
     if($res)
     {
      header("Location:state.php?action=Deleted");
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
    url:"ajax.php?detect=state",
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