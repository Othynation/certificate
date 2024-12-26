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
                <h3>List Institute</h3>
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
                    $name=trim($_POST['name']); 
                     $reg_no=trim($_POST['reg_no']); 
                       $address=trim($_POST['address']); 
                        $mobile=trim($_POST['mobile']); 
                        $sid=trim($_POST['sid']); 
                          $did=trim($_POST['did']); 
                            $tid=trim($_POST['tid']); 
                            $idate=trim($_POST['idate']);
         if(!isset($error)){ 
  $result=$getCer->insert_institute($name,$reg_no,$address,$mobile,$idate,$sid,$did,$tid);
           if($result)
    {   
   header("Location:institutes.php?action=Created");
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
    <label for="exampleInputEmail1">Institute Name </label>
    <input type="text" name="name" class="form-control" required>
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Registration No </label>
    <input type="text" name="reg_no" class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" name="address" class="form-control">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Mobile No</label>
    <input type="text" name="mobile" class="form-control">
  </div>



  
                    </div>
                     <div class="col-md-3"> 
<br>
<div class="form-group">
<select name="sid"  id="sid" class="form-control" required>
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

<div class="form-group">
<select name="did" id="did" class="form-control" required>
 <option value="">Select District</option> 
 
</select>
</div>

<div class="form-group">
<select name="tid" id="tid" class="form-control" required>
 <option value="">Select Taluka</option> 

</select>
</div>
<div class="form-group">
 <label>Date</label>
<input type="date" name="idate" class="form-control">

</select>
</div>

<br>
<div class="form-group">
  <button type="submit" name="subpost" class="btn btn-primary btn-lg btn-block">Create</button>
  </div>

  </form>
              
                    </div>
                </div>
      
                <script type="text/javascript">
                  $(document).on('change', '#sid', function(){
  var sid = $('#sid').val();
  var type ='1'; 
  if(sid!='')
  {
    $.ajax({
      url:"../app/changetype2.php",
      type:"post",
       data: { sid:sid, type:type },
        type: "POST",
      success:function(data){
         $("#did").html(data);
      }
    })

  }
 });

                   $(document).on('change', '#did', function(){
  var sid = $('#did').val();
  var type ='2'; 
  if(sid!='')
  {
    $.ajax({
      url:"../app/changetype2.php",
      type:"post",
       data: { sid:sid, type:type },
        type: "POST",
      success:function(data){
         $("#tid").html(data);
      }
    })

  }
 });

                </script>
  <?php 
  break; 
  case 'edit':
  $id=$_GET['id'];
  
  ?> 
  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
    
                        if(isset($_POST['subpost'])){     
                    $name=trim($_POST['name']); 
                     $reg_no=trim($_POST['reg_no']); 
                       $address=trim($_POST['address']); 
                        $mobile=trim($_POST['mobile']); 
                        $sid=trim($_POST['sid']); 
                          $did=trim($_POST['did']); 
                            $tid=trim($_POST['tid']); 
                            $idate=trim($_POST['idate']);
         if(!isset($error)){ 
  $result=$getCer->update_institute($name,$reg_no,$address,$mobile,$idate,$sid,$did,$tid,$id);
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
$rows=$getCredit->get_by_id('pinstitute','iid',$id); 
foreach($rows as $row)
{
?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="form-group">
    <label for="exampleInputEmail1">Institute Name </label>
    <input type="text" name="name" class="form-control" value="<?php echo $row['iname'] ?>" required>
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Registration No </label>
    <input type="text" name="reg_no" class="form-control" value="<?php echo $row['ireg_no'] ?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" name="address" value="<?php echo $row['iaddress'] ?>" class="form-control" >
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Mobile No</label>
    <input type="text" name="mobile" value="<?php echo $row['imobile'] ?>" class="form-control">
  </div>



  
                    </div>
                     <div class="col-md-3"> 
<br>
<div class="form-group">
<select name="sid"  id="sid" class="form-control" required>
 <option value="<?php echo $row['sid'];?>" style="background: #EAEAEA;"><?php echo $getCredit->get_sname($row['sid']);?></option> 
 <?php 
 $rows=$getCredit->fetch_all('pstate','sname','ASC');
 foreach($rows as $rowk)
 {
echo '<option value="'.$rowk['sid'].'">'.$rowk['sname'].'</option>';
 }
 ?>

</select>
</div>

<div class="form-group">
<select name="did" id="did" class="form-control" required>
 <option value="<?php echo $row['did'];?>" style="background: #EAEAEA;"><?php echo $getCredit->get_dname($row['did']);?></option>
 
</select>
</div>

<div class="form-group">
<select name="tid" id="tid" class="form-control" required>
 <option value="<?php echo $row['tid'];?>" style="background: #EAEAEA;"><?php echo $getCredit->get_tname($row['tid']);?></option>

</select>
</div>
<div class="form-group">
 <label>Date</label>
<input type="date" name="idate" value="<?php echo $row['idate'];?>" class="form-control">

</select>
</div>

<br>
<div class="form-group">
  <button type="submit" name="subpost" class="btn btn-primary btn-lg btn-block">Save</button>
  </div>

  </form>
<?php } ?>
              
                    </div>
                </div>
      
                <script type="text/javascript">
                  $(document).on('change', '#sid', function(){
  var sid = $('#sid').val();
  var type ='1'; 
  if(sid!='')
  {
    $.ajax({
      url:"../app/changetype2.php",
      type:"post",
       data: { sid:sid, type:type },
        type: "POST",
      success:function(data){
         $("#did").html(data);
      }
    })

  }
 });

                   $(document).on('change', '#did', function(){
  var sid = $('#did').val();
  var type ='2'; 
  if(sid!='')
  {
    $.ajax({
      url:"../app/changetype2.php",
      type:"post",
       data: { sid:sid, type:type },
        type: "POST",
      success:function(data){
         $("#tid").html(data);
      }
    })

  }
 });

                </script>

  <?php 
  break; 
  case 'del': 
  $id=$_GET['id'];
     $res=$getCredit->delete_by_id('pinstitute','iid',$id);
     if($res)
     {
      header("Location:institutes.php?action=Deleted");
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
               <th>Institute Name</th>   
          <th>Reg No</th>
          <th>Mobile</th>
          <th>State</th>
          <th>District</th>
            <th>Taluka</th>
              <th>Date</th>
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
    url:"ajax.php?detect=institutes",
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