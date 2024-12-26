<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
?>
<?php include("header.php");
if($postm!='admin'){header("location:index");exit();} 
?>

                <?php include("sidebar.php"); ?>
        <!-- /top navigation -->

        <!-- page content -->
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
                <h3>Add New Centre</h3>

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
                          $city=trim($_POST['city']); 
         if(!isset($error)){ 
$result=$getCer->insert_centre($title,$city); 

           if($result)
    {
     
 header("Location:centres?action=Created");
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
                      <div class="col-sm-6"> <div class="form-group">
    <label for="exampleInputEmail1">Centre Title</label>
    <input type="text" name="title" class="form-control" required="">
   
  </div></div>
                        <div class="col-sm-6"> 
                          <div class="form-group">
    <label for="exampleInputEmail1">City</label>
    <input type="text" name="city" class="form-control">
  </div>
</div>
<div class="col-sm-4">
</div>
<div class="col-sm-4 form-group" style="text-align:center;">
  <br> 
     <button type="submit" name="subpost" class="btn btn-success">Add Centre</button>
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
                <h3>Edit Centre</h3>

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
                          $city=trim($_POST['city']); 
         if(!isset($error)){ 
$result=$getCer->update_centre($title,$city,$id); 

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
$rows=$getCredit->get_by_id('centres','cent_id',$id); 
foreach($rows as $row)
{
?>


                   <form action="" method="POST" enctype='multipart/form-data'>

                    <div class="row">
                      <div class="col-sm-6"> <div class="form-group">
    <label for="exampleInputEmail1">Centre Title</label>
    <input type="text" name="title" class="form-control" value="<?php echo $row['centre_name'];?>" required="">
   
  </div></div>
                        <div class="col-sm-6"> 
                          <div class="form-group">
    <label for="exampleInputEmail1">City</label>
    <input type="text" name="city" value="<?php echo $row['city'];?>" class="form-control">
  </div>
</div>
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
     $res=$getCredit->delete_by_id('centres','cent_id',$id);
     if($res)
     {
      header("Location:centres?action=Deleted");
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
                <h3>Centres</h3>
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
       <th>Centre Name</th>
        <th>City</th>
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
    url:"ajax.php?detect=centres",
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