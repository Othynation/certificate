<?php require_once("../autoload.php"); 
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login.php");}
?>
  <script src="ckeditor/ckeditor.js"></script>
<?php include("header.php"); ?>
                <?php include("sidebar.php"); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Exam Registrations</h3>
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
  case 'addblock':
  if(isset($_GET['id']))
  {
    $reg_id=$_GET['id'];
  }

  ?> 
  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
                        if(isset($_POST['subpost'])){
                            extract($_POST);
                            $count=$getCredit->count_by_id('certificates','cno',$cno);
                            if($count==1)
                            {
                              $error[]='This certificate is already created..';
                            }
         if(!isset($error)){ 
$result=$getCer->insert_certificate($cno,$duration,$grade,$year,$reg_id); 
           if($result)
    {

 header("Location:certificates?action=Created");
          }

   
    else{
      $error[] ='Failed : Something went wrong';
    }



                 }




                           } ?>


<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}
 if(isset($_GET['id']))
  {
$rows=$getCredit->get_by_id('registrations','reg_id',$reg_id); 
foreach($rows as $row)
{
  $reg_no=$cno=$row['reg_no']; $name=$row['name']; $fname=$row['fname'];$mname=$row['mname']; $image=$row['image']; $simage=$row['sign']; 
}
}

?>

                   <form action="" method="POST" enctype='multipart/form-data'>
<div class="row">
           <div class="col-sm-6">
                    <div class="form-group">
    <div class="form-group">
         <label class="lable"><?php echo $name;?> (PHOTO)</label>
   <div style="border: 1px solid black; height: 120px; width: 150px; ">
      <img src="uploads/<?php echo $image;?>" width="150" height="120">
  </div>
  </div> 
   
  </div>
</div>
<div class="col-sm-6">
  <div class="form-group">
         <label class="lable"><?php echo $reg_no;?> (SIGN)</label>
   <div style="border: 1px solid black; height: 120px; width: 150px; ">
      <img src="uploads/<?php echo $simage;?>" width="150" height="120">
  </div>
  </div> 
</div>
</div>
   

<div class="row">

                      <div class="col-sm-6">
                    <div class="form-group">
    <label for="exampleInputEmail1">Certificate No</label>
    <input type="text" name="cno" value="<?php if(isset($cno)){ echo $cno;}?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required="">
   
  </div>
</div>
<div class="col-sm-6">
  <div class="form-group">
    <label for="exampleInputEmail1">Duration</label>
    <input type="text" name="duration" value="<?php if(isset($duration)){ echo $duration;}?>" class="form-control">
   
  </div>
</div>
</div>
   
<div class="row">
                      <div class="col-sm-6">
   <div class="form-group">
    <label for="exampleInputEmail1">Grade </label>
<?php  $string=$getCredit->get_option_value('grades'); 
    $garr=explode(',',$string); 
?>
   <select name="grade" class="form-control">
     <?php 
foreach($garr as $rm)
{
  echo '<option value="'.htmlspecialchars($rm).'">'.$rm.'</option>'; 
}
     ?> 

   </select>
  </div>
</div>
<div class="col-sm-6">
  <div class="form-group">
    <label for="exampleInputEmail1">Year</label>
    <input type="text" name="year" value="<?php if(isset($year)){ echo $year;}?>" class="form-control">
   
  </div>
</div>
</div>
 <button type="submit" name="subpost" class="btn btn-success">Create </button>


                    </div>
                     <div class="col-md-3"> 
<br>
  

  
   
<div class="clearfix"></div>
 
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
                        if(isset($_POST['subpost'])){
                     $session=$_POST['session']; 
                     $institute_code=$_POST['institute_code']; 
                     $txnid=$_POST['txnid']; 
                     $status=$_POST['status']; 
                     $exam_fee=$_POST['exam_fee']; 
         if(!isset($error)){ 
$result=$getCer->update_certificate($session,$institute_code,$txnid,$status,$exam_fee,$id); 
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
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}
 if(isset($_GET['id']))
  {
    $rows=$getCredit->get_by_id('pexam','eid',$id); 
  foreach($rows as $row)
  {
    $reg_id=$row['reg_id'];
    $session=$row['session']; 
    $institute_code=$row['institute_code']; 
    $etxnid=$row['etxnid']; 
     $exam_status=$row['exam_status'];
     $exam_fee=$row['exam_fee']; 
  }

$rows=$getCredit->get_by_id('pregistrations','reg_id',$reg_id); 
foreach($rows as $row)
{
  $reg_no=$cno=$row['reg_no']; $name=$row['namef'].' '.$row['namel']; $fname=$row['fname'];$mname=$row['mname']; $image=$row['image']; $institute=$row['institute']; $course=$row['course'];
}

}

?>

                   <form action="" method="POST" enctype='multipart/form-data'>
<div class="row">
           <div class="col-sm-6">
                    <div class="form-group">
    <div class="form-group">
         <label class="lable"><strong>Full Name: </strong><?php echo $name;?> (PHOTO)</label>
         <br>
         <label class="lable"><strong>Enrollment No:</strong> <?php echo $reg_no;?> </label>
         <br>
          <label class="lable"><strong>Father Name:</strong> <?php echo $fname;?> </label>
          <br>
          <label class="lable"><strong>Course Name:</strong> <?php echo $course;?> </label>
          <br>
          <label class="lable"><strong>Institute Name:</strong> <?php echo $institute;?> </label>
  
  </div> 
   
  </div>
</div>
<div class="col-sm-6">
  <div class="form-group">
         
           <div style="border: 1px solid black; height: 120px; width: 150px; ">
      <img src="uploads/<?php echo $image;?>" width="150" height="120">
  </div>
  </div> 
</div>
</div>
   

<div class="row">

                      <div class="col-sm-6">
                    <div class="form-group">
    <label for="exampleInputEmail1">Annual Session</label>
   
    <?php 
    $string=$getCredit->get_option_value('session'); 
    $garr=explode(',',$string); 
?>
   <select name="session" class="form-control">
     <?php 
     echo '<option value="'.$session.'" style="background:#ECE6E5;">'.$session.'</option>';
    
foreach($garr as $rm)
{
  echo '<option value="'.$rm.'">'.$rm.'</option>'; 
}
     ?> 

   </select>

   
  </div>
</div>
<div class="col-sm-6">
  <div class="form-group">
    <label for="exampleInputEmail1">Institute Code</label>
    <input type="text" name="institute_code" value="<?php echo $institute_code;?>" class="form-control">
   
  </div>
</div>
</div>
   
<div class="row">
                      <div class="col-sm-4">
   <div class="form-group">
    <label for="exampleInputEmail1">Exam Fee</label>
<?php  


$string=$getCredit->get_option_value('exam_fees'); 
    $garr=explode(',',$string); 
?>
   <select name="exam_fee" class="form-control">
     <?php 
     echo '<option value="'.$exam_fee.'" style="background:#ECE6E5;">'.$exam_fee.'</option>';
      
foreach($garr as $rm)
{
  echo '<option value="'.htmlspecialchars($rm).'">'.$rm.'</option>'; 
}
     ?> 

   </select>
  </div>
</div>
<div class="col-sm-4">
  <div class="form-group">
    <label for="exampleInputEmail1">Payment Id</label>
    <input type="text" name="txnid" value="<?php echo $etxnid; ?>" class="form-control">
   
  </div>
</div>
<div class="col-sm-4">
 <div class="form-group">
    <label for="exampleInputEmail1">Status </label>
    <select name="status" class="form-control">
            <option value="<?php echo $exam_status;?>" style="background: #E7E0DF;"><?php echo $getCredit->status($exam_status);?></option>
<option value="1">Success</option>
<option value="3">Failed</option>
<option value="0">Pending</option>
    </select>
  </div>

</div>

</div>
<div class="row">
  <div class="col-sm-4">
  </div>
   <div class="col-sm-4">
    <br>
     <button type="submit" name="subpost" class="btn btn-success btn-block">Save </button>
  </div>
   <div class="col-sm-4">
  </div>
</div>



                    </div>
                     <div class="col-md-3"> 
<br>
  

  
   
<div class="clearfix"></div>
 
  </form>
              
                    </div>
                </div>  
   
  <?php 
  break; 
  case 'del': 
  $id=$_GET['id'];
     $res=$getCredit->delete_by_id('pexam','eid',$id);
     if($res)
     {
      header("Location:examreg.php?action=Deleted");
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
  <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>Photo</th>
<th>Enrollment No</th>
<th>Name</th>
<th>Father Name</th>
<th>Course</th>
<th>Annual Session</th>
<th>Date</th>
<th>Status</th>
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
    url:"ajax.php?detect=certificates",
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