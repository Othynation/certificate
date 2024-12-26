<?php require_once("../autoload.php"); 
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login");}
?>
  <script src="ckeditor/ckeditor.js"></script>
  <style type="text/css">
    
.line-all {
  width: 101%;
  height: 2px;
  margin-bottom: 20px;
  margin-top: 8px;
background: rgb(236,236,236);
background: linear-gradient(158deg, rgba(236,236,236,1) 1%, rgba(0,50,107,1) 81%);
}
  </style>
<?php include("header.php"); ?>
                <?php include("sidebar.php"); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Franchise</h3>
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
  case 'view':
  $id=$_GET['id'];
  
  ?> 
  <div class="row">
                    
                    <div class="col-md-9">
                       
<?php
$rows=$getCredit->get_by_id('pfranchise','fid',$id); 
foreach($rows as $row) 
{
?>
                   <form action="" method="POST" enctype='multipart/form-data'>

<div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label for="">Owner Name<span id="red">*</span> :</label>
                <strong><?php echo $row['name']?></strong>
              </div>
              
              <div class="col-md-4">
                <label for="">Institute Name<span id="red">*</span> :</label>
              <strong><?php echo $row['institute_name']?></strong>
              </div>
              <div class="col-md-4">
                <label for="">Mobile No<span id="red">*</span> :</label>
                  <strong><?php echo $row['mobile']?></strong>
              </div>

            </div>
          </div>
          <div class="line-all">
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label for="">Email<span id="red">*</span> :</label>
                  <strong><?php echo $row['email']?></strong>
              </div>
              
              <div class="col-md-4">
                <label for="">Address<span id="red">*</span> :</label>
                 <strong><?php echo $row['address']?></strong>
              </div>
              <div class="col-md-4">
                <label for="">City<span id="red">*</span> :</label>
                <strong><?php echo $row['city']?></strong>
              </div>

            </div>
          </div>


          <div class="line-all">
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <label for="">State<span id="red">*</span> :</label>
                   <strong><?php echo $row['state']?></strong>
              </div>
              
              <div class="col-md-3">
                <label for="">District<span id="red">*</span> :</label>
                 <strong><?php echo $row['district']?></strong>
              </div>
              <div class="col-md-3">
                <label for="">Pincode<span id="red">*</span> :</label>
                <strong><?php echo $row['pincode']?></strong>
              </div>
                <div class="col-md-3">
                <label for="">Total centre area in square feet<span id="red">*</span> :</label>
               <strong><?php echo $row['area']?></strong>
              </div>


            </div>
          </div>
          
          
          <div class="line-all">
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-3" >
                <label for="">Aadhaar <span id="red">(image size 200kb)</span> :</label>
               <a target="_blank" href="uploads/<?php echo $row['aadhaar']?>" class="btn btn-primary">View</a>

              <div class="text-red alert-msg" id="aadhaare"> </div>
              
              </div>
               
              <div class="col-md-3">
                <label for="">Pan Card<span id="red"> (image size 200kb)</span> :</label>
              
              <a target="_blank" href="uploads/<?php echo $row['pancard']?>" class="btn btn-primary">View</a>
            <div class="text-red alert-msg" id="pancarde"> </div>
              </div>
              <div class="col-md-3">
                 <label for="">Owner Photo <span id="red"> (image size 200kb)</span> :</label>
             <a target="_blank" href="uploads/<?php echo $row['photo']?>" class="btn btn-primary">View</a>
                <div class="text-red alert-msg" id="photoe"> </div>
              </div>
                <div class="col-md-3">
                <label for="">Qualification Documents<span id="red"> (image size 200kb)</span> :</label>
               <a target="_blank" href="uploads/<?php echo $row['qualification']?>" class="btn btn-primary">View</a>

                <div class="text-red alert-msg" id="qualificatione"> </div>
              </div>



            </div>
          </div>
          <div class="line-all">
          </div>
          
          <div class="form-group">
            <div class="row">
              <div class="col-md-4" >
                <label for="">Outdoor Institute Photos <span id="red">(image size 200kb)</span> :</label>
                 <a target="_blank" href="uploads/<?php echo $row['outdoor_institute']?>" class="btn btn-primary">View</a>


              <div class="text-red alert-msg" id="outdoor_institutee"> </div>
              
              </div>
               
              <div class="col-md-4">
                <label for="">Indoor Class Room<span id="red"> (image size 200kb)</span> :</label>
              
           <a target="_blank" href="uploads/<?php echo $row['class_room']?>" class="btn btn-primary">View</a>

            <div class="text-red alert-msg" id="class_roome"> </div>
              </div>
              <div class="col-md-4">
                <label for="">Local NOC <span id="red"> (image size 200kb)</span> :</label>
                <a target="_blank" href="uploads/<?php echo $row['local_noc']?>" class="btn btn-primary">View</a>
                <div class="text-red alert-msg" id="local_noce"> </div>
              </div>
            



            </div>
          </div>

  <div class="line-all">
          </div>

      <div class="form-group">
        <div class="row">
        <label for="">Trust , Society, MSME, Electricity bill, Other Documents Any One <span id="red"> (image size 200kb)</span> :</label>
          <div class="col-md-12">
                     <a target="_blank" href="uploads/<?php echo $row['other']?>" class="btn btn-primary">View</a>

                <div class="text-red alert-msg" id="othere"> </div>

          </div>
        </div>
      </div>
      <div class="line-all">
      </div>

   
<div class="clearfix"></div>
 
  </form>
<?php } ?>
              
                    </div>
                </div>  
   
  <?php 
  break; 
  case 'del': 
  $id=$_GET['id'];
  $rows=$getCredit->get_by_id('pfranchise','fid',$id);
  foreach($rows as $row)
  {
       $aadhaar=$row['aadhaar']; 
        $pancard=$row['pancard']; 
        $photo=$row['photo']; 
         $qualification=$row['qualification'];
          $outdoor_institute=$row['outdoor_institute'];
          $class_room=$row['class_room']; 
           $local_noc=$row['local_noc']; 
            $other=$row['other']; 
  }
  unlink('uploads/'.$aadhaar);
    unlink('uploads/'.$pancard);
        unlink('uploads/'.$photo);
     unlink('uploads/'.$qualification);
       unlink('uploads/'.$outdoor_institute);
         unlink('uploads/'.$class_room);
            unlink('uploads/'.$local_noc);
             unlink('uploads/'.$other);

     $res=$getCredit->delete_by_id('pfranchise','fid',$id);
     if($res)
     {
      header("Location:franchise.php?action=Deleted");
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
<th>Owner Photo</th>
<th>Name</th>
<th>Institute Name</th>
<th>Email</th>
<th>Mobile</th>
<th>City</th>
<th>State</th>
<th>Destrict</th>
<th>Date</th>
<th>View</th>
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
    url:"ajax.php?detect=franchise",
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