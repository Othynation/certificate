<?php require_once("../autoload.php");
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login.php");}
?>
<?php include("header.php"); ?>

                <?php include("sidebar.php"); ?>
        <!-- /top navigation -->

        <!-- page content -->
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Options</h3>
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
  case 'edit':
  ?> 
  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
                         $id=$_GET['id']; 
                        if(isset($_POST['subpost'])){
                            extract($_POST);
                              
       
         if(!isset($error)){ 
$result=$getOption->update_option($option_value,$option_note,$id); 

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
$rows=$getCredit->get_by_id('poptions','option_id',$id); 
foreach($rows as $row)
{
  $option_note=$row['option_note']; 
   $option_name=$row['option_name']; 
       $option_value=$row['option_value']; 
       $type=$row['type']; 

}
?>


                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="form-group">
    <label for="exampleInputEmail1">Option Name</label>
    <input type="text" value="<?php echo $option_name;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
   
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Option Value(Content)</label>
       <textarea name="option_value" class="form-control" rows="6"><?php echo htmlspecialchars($option_value); ?></textarea>
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Option Note</label>
    <input type="text" name="option_note" value="<?php echo $option_note;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required="">
  </div>





                    </div>
                     <div class="col-md-3"> 
<br>
  <br>
  <div class="form-group">
    <label for="exampleInputEmail1">Option Type </label>
    <input type="text" value="<?php echo $type;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  disabled>
  </div>
  
  
  <button type="submit" name="subpost" class="btn plan-button btn-lg btn-block">Save </button>

  </form>
              
                    </div>
                </div>
  <?php 
  break; 
  case 'del': 
  $id=$_GET['id'];
     $rows=$getCredit->get_by_id('media','id',$id);
  foreach($rows as $row)
  {
       $image=$row['source_name']; 
  }
  unlink('../assets/uploads/'.$image);
     $res=$getCredit->delete_by_id('media','id',$id);
     if($res)
     {
      header("Location:media?action=deleted");
     }
     else 
     {
      echo 'Something went wrong.....';
     }
  break;
  default:
?> 
                      
<div class="row">
  <?php 
  $rows=$getCredit->fetch_distinct('poptions','type','option_id','ASC');
  ?> 
      <div class="col-sm-4"></div>
         <div class="col-sm-4">  <select name="is_type" id="is_type" class="form-control">
         <option value="">Select Type </option>
         <?php 
  $rows=$getCredit->fetch_distinct('poptions','type','option_id','ASC');
  foreach($rows as $rowt)
  {
    echo '<option value="'.$rowt['type'].'"> '.$rowt['type'].'</option>'; 
  }
  ?>
        </select></div>
            <div class="col-sm-4"></div>
            
  </div>


  <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Option Name </th>
<th>Type 
</th>
<th>Option Note </th>
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
    url:"ajax.php?detect=option",
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