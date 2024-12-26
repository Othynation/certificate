<?php require_once("../autoload.php");
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login.php");}
       include("functions.php");
       if(isset($_POST['getid']))
{
  if(!isset($_POST['rid'])) 
  {
    echo '<div class="errormsg">Please select atleast one row..</div>'; 
  }
  else 
  {
      $rid=$_POST['rid'];
       $subcodes=implode(',',$rid);
      $rows=$getCredit->getallin('pregistrations','reg_id',$subcodes); 
$output="Enrollment,First Name,Last Name,Father Name,Mother Name,Course,Aadhaar,Email,Mobile,City,State,District,Taluka,Pincode,Duration,Qualification,Institute,Transaction Id,Status
  ";
  foreach($rows as $row)
  {
     $output .= "".$getDatabase->FormatCSV($row["reg_no"]).
    ",";
    $output .= "".$getDatabase->FormatCSV($row["namef"]).
    ",";
     $output .= "".$getDatabase->FormatCSV($row["namel"]).
    ",";
       $output .= "".$getDatabase->FormatCSV($row["fname"]).
    ",";
       $output .= "".$getDatabase->FormatCSV($row["mname"]).
    ",";
       $output .= "".$getDatabase->FormatCSV($row["course"]).
    ",";
        $output .= "".$getDatabase->FormatCSV($row["aadhar"]).
    ",";
           $output .= "".$getDatabase->FormatCSV($row["email"]).
    ",";
           $output .= "".$getDatabase->FormatCSV($row["mobile"]).
    ",";
           $output .= "".$getDatabase->FormatCSV($row["city"]).
    ",";
           $output .= "".$getDatabase->FormatCSV($row["state"]).
    ",";
           $output .= "".$getDatabase->FormatCSV($row["district"]).
    ",";
           $output .= "".$getDatabase->FormatCSV($row["taluka"]).
    ",";
           $output .= "".$getDatabase->FormatCSV($row["pincode"]).
    ",";
           $output .= "".$getDatabase->FormatCSV($row["duration"]).
    ",";
           $output .= "".$getDatabase->FormatCSV($row["qualification"]).
    ",";
           $output .= "".$getDatabase->FormatCSV($row["institute"]).
    ",";
               $output .= "".$getDatabase->FormatCSV($row["txnid"]).
    ",";
     $output .= "".$getDatabase->FormatCSV($getCredit->status2($row["status"]))."
    ";
  }
 $FileName ="record-".date("d-m-y-h:i:s").".csv";
        header('Content-Type: application/csv'); 
        header('Content-Disposition: attachment; filename="' . $FileName . '"'); 
  //
  echo $output;
  exit;
  }
}
?>

  <script src="ckeditor/ckeditor.js"></script>
<?php include("header.php"); ?>
                <?php include("sidebar.php"); ?>
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Registrations</h3>
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
  ?> 
  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
    
                        if(isset($_POST['subpost'])){
                         $name=$_POST['name'];
                         $fname =$_POST['fname'];
                         $mname=$_POST['mname'];
                         $reg_no=$_POST['reg_no'];
                         $dep_title=$_POST['dep_title'];
          
         if(!isset($error)){ 
          
            $folder ="uploads/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'photo_'.rand() . '.' . $extension;
 //sig 
 $files = $_FILES['imagee']['tmp_name'];  
$file_names = $_FILES['imagee']['name']; 
$file_name_arrays = explode(".", $file_names); 
 $img_namees=$file_name_arrays[0]; 
 $img_names=$getCredit->slug($img_namees); 
 $extensions = end($file_name_arrays);
 $new_image_names = 'sign_'.rand() . '.' . $extensions;

if($file=='')
{
    $new_image_name=Null;
}
if($files=='')
{
    $new_image_names=Null;
}
$result=$getCer->insert_reg($name,$fname,$mname,$dep_title,$new_image_name,$new_image_names,$reg_no); 

           if($result)
    {
     
      if($file!=''){
 move_uploaded_file($file, 'uploads/' . $new_image_name); 
} 
if($files!=''){
 move_uploaded_file($files, 'uploads/' . $new_image_names); 
} 

 header("Location:registrations?action=Added");
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
              $allacount=$getCredit->count('pregistrations'); 
              if($allacount==0)
              {
                 $final_reg=$format.$indiatl_no;
              }
              else {
              $resu=$getCredit->fetch_by_limit('pregistrations','reg_no','DESC','1'); 
             foreach($resu as $res)
             {
              $in=1; 
              $last_reg_id=$getCredit->reg_no($res['reg_no']); 

               $reg_no=$last_reg_id+$in; 
                $final_reg=$format.$reg_no;
             }
             $count_val=$getCredit->count_by_id('pregistrations','reg_no',$reg_no); 
             if($count_val>0)
             {
              $in=1; 
                $reg_no=$reg_no+$in;
                 $final_reg=$format.$reg_no;
             }
           }


?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="form-group">
                     
    <label for="exampleInputEmail1">Reg No</label>
    <input type="text" name="reg_no" value="<?php echo $final_reg;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required="">
   
  </div>

                    <div class="form-group">
                     
    <label for="exampleInputEmail1">Full Name</label>
    <input type="text" name="name" value="<?php if(isset($error)){ echo $_POST['name'];}?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required="">
   
  </div>
  <div class="form-group">
                     
    <label for="exampleInputEmail1">Father Name</label>
    <input type="text" name="fname" value="<?php if(isset($error)){ echo $_POST['fname'];}?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
  <div class="form-group">
                     
    <label for="exampleInputEmail1">Mother Name</label>
    <input type="text" name="mname" value="<?php if(isset($error)){ echo $_POST['mname'];}?>" class="form-control">
   
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Course| Dep</label>
   <select name="dep_title" class="form-control" required>
         <option value="">Select </option> 
 <?php $rows=$getCredit->fetch_all('dep','dep_id','DESC'); 
 foreach($rows as $row)
 {
  echo '<option value="'.$row['dep_id'].'">'.$row['dep_title'].'</option>'; 
 }
        ?>
             
                  
        </select>
   
  </div>


                    </div>
                     <div class="col-md-3"> 

  <div class="form-group">
         <label class="lable"> Photo </label>
   <div style="border: 1px solid black; height: 150px; width: 150px; ">
      <img id="output"  width="150" height="150" / style="display:none">
  </div>
    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" accept="image/*" / style="width:150px;">
    <div id="error_image"></div>
  

<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    }; 

  $('#output').show();
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
  </div>


   <div class="form-group">
    <label for="exampleInputEmail1">Signature</label> 
    <input type="file" name="imagee" onchange="loadFiles(event)" class="form-control">
    <img id="outputs"  width="auto" height="100" / style="display:none">
<script>
  var loadFiles = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('outputs');
      output.src = reader.result;
    }; 
  $('#outputs').show();
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
  </div>
  
 
  
  <button type="submit" name="subpost" class="btn plan-button btn-lg btn-block">Register </button>

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
                         $name=$_POST['name'];
                         $lname=$_POST['lname'];
						 $session=$_POST['session'];
                         $fname =$_POST['fname'];
                         $mname=$_POST['mname'];
                         $reg_no=$_POST['reg_no']; $aadhar=$_POST['aadhar']; $email=$_POST['email'];$mobile=$_POST['mobile'];
                         $city=$_POST['city']; $state=$_POST['state']; $district=$_POST['district']; $taluka=$_POST['taluka'];
                          $pincode=$_POST['pincode']; $course=$_POST['course']; $duration=$_POST['duration']; 
                          $qualification=$_POST['qualification']; $institute=$_POST['institute']; $txnid=$_POST['txnid'];
                           $status=$_POST['status']; $dob=$_POST['dob'];

                         
         if(!isset($error)){ 
          $rows=$getCredit->get_by_id('pregistrations','reg_id',$id); 
foreach($rows as $row)
{

       $oldimage=$row['image']; 
       $oldimages=$row['source']; 
}
          
            $folder ="uploads/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'photo_'.rand() . '.' . $extension;
 //sig 
 $files = $_FILES['imagee']['tmp_name'];  
$file_names = $_FILES['imagee']['name']; 
$file_name_arrays = explode(".", $file_names); 
 $img_namees=$file_name_arrays[0]; 
 $img_names=$getCredit->slug($img_namees); 
 $extensions = end($file_name_arrays);
 $new_image_names = 'source_'.rand() . '.' . $extensions;

if($file=='')
{
    $new_image_name=$oldimage;
}
if($files=='')
{
    $new_image_names=$oldimages;
}
$result=$getCer->update_reg($name,$lname,$fname,$mname,$reg_no,$aadhar,$new_image_name,$new_image_names,$email,$mobile,$city,$state,$district,$taluka,$pincode,$course,$duration,$qualification,$institute,$txnid,$status,$dob,$session,$id);  

           if($result)
    {
     
      if($file!=''){
          unlink('uploads/'.$oldimage);
   
 move_uploaded_file($file, 'uploads/' . $new_image_name); 
} 
if($files!=''){
   unlink('uploads/'.$oldimages);
 move_uploaded_file($files, 'uploads/' . $new_image_names); 
} 

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
            
$rows=$getCredit->get_by_id('pregistrations','reg_id',$id); 
foreach($rows as $row)
{
?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-4">
                         <div class="form-group">
                     
    <label for="exampleInputEmail1">Enrollment Number</label>
    <input type="text" name="reg_no" value="<?php echo $row['reg_no'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required="">
   
  </div>
                      </div>
                       <div class="col-sm-4">
                         <div class="form-group">
                     
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" name="name" value="<?php echo $row['namef'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required="">
   
  </div>
                      </div>
                       <div class="col-sm-4">
                          <div class="form-group">
                     
    <label for="exampleInputEmail1">Last Name</label>
    <input type="text" name="lname" value="<?php echo $row['namel'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required="">
   
  </div>

                      </div>

                    </div>
                     <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                     
    <label for="exampleInputEmail1">Father Name</label>
    <input type="text" name="fname" value="<?php echo $row['fname'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
                      </div>
                       <div class="col-sm-4">
                         <div class="form-group">
                     
    <label for="exampleInputEmail1">Mother Name</label>
    <input type="text" name="mname" value="<?php echo $row['mname'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required="">
   
  </div>
                      </div>
                       <div class="col-sm-4">
                          <div class="form-group">
                     
    <label for="exampleInputEmail1">Aadhaar No</label>
    <input type="text" name="aadhar" value="<?php echo $row['aadhar'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  required="">
   
  </div>

                      </div>

                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                     
    <label for="exampleInputEmail1">Email</label>
    <input type="text" name="email" value="<?php echo $row['email'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
                      </div>
                       <div class="col-sm-4">
                         <div class="form-group">
                     
    <label for="exampleInputEmail1">Mobile No</label>
    <input type="text" name="mobile" value="<?php echo $row['mobile'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
                      </div>
                       <div class="col-sm-4">
                          <div class="form-group">
                     
    <label for="exampleInputEmail1">Village/City</label>
    <input type="text" name="city" value="<?php echo $row['city'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>

                      </div>

                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                     
    <label for="exampleInputEmail1">State</label>
    <input type="text" name="state" value="<?php echo $row['state'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
                      </div>
                       <div class="col-sm-4">
                         <div class="form-group">
                     
    <label for="exampleInputEmail1">District</label>
    <input type="text" name="district" value="<?php echo $row['district'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
                      </div>
                       <div class="col-sm-4">
                          <div class="form-group">
                     
    <label for="exampleInputEmail1">Taluka</label>
    <input type="text" name="taluka" value="<?php echo $row['taluka'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>

                      </div>

                    </div>
                     <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                     
    <label for="exampleInputEmail1">Pincode</label>
    <input type="text" name="pincode" value="<?php echo $row['pincode'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
                      </div>
                       <div class="col-sm-4">
                         <div class="form-group">
                     
    <label for="exampleInputEmail1">Course Name</label>
<?php  
$string=$getCredit->get_option_value('course_names'); 
    $garr=explode(',',$string); 
?>
   <select name="course" class="form-control">
     <?php 
     echo '<option value="'.$row['course'].'" style="background:#ECE6E5;">'.$row['course'].'</option>';

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
                     
    <label for="exampleInputEmail1">Course Duration</label>
    <?php  
$string=$getCredit->get_option_value('course_durations'); 
    $garr=explode(',',$string); 
?>
   <select name="duration" class="form-control">
     <?php 
     echo '<option value="'.$row['duration'].'" style="background:#ECE6E5;">'.$row['duration'].'</option>';

foreach($garr as $rm)
{
  echo '<option value="'.htmlspecialchars($rm).'">'.$rm.'</option>'; 
}
     ?> 

   </select>
   
  </div>

                      </div>

                    </div>

                     <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                     
    <label for="exampleInputEmail1">Qualification</label>
    <?php  
$string=$getCredit->get_option_value('qualifications'); 
    $garr=explode(',',$string); 
?>
   <select name="qualification" class="form-control">
     <?php 
     echo '<option value="'.$row['qualification'].'" style="background:#ECE6E5;">'.$row['qualification'].'</option>';

foreach($garr as $rm)
{
  echo '<option value="'.htmlspecialchars($rm).'">'.$rm.'</option>'; 
}
     ?> 

   </select>
  </div>
                      </div>
                       <div class="col-sm-8">
                         <div class="form-group">
                     
    <label for="exampleInputEmail1">Instute Name</label>
    <input type="text" name="institute" value="<?php echo $row['institute'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">
                     
    <label for="exampleInputEmail1">DOB</label>
    <input type="date" name="dob" value="<?php echo $row['dob'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
                      </div>
					   <div class="col-sm-6">
                         <div class="form-group">
                     
    <label for="exampleInputEmail1">Session</label>
    <input type="text" name="session" value="<?php echo $row['session'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
                      </div>

                     

                    </div>

                    </div>
                     <div class="col-md-3"> 

  <div class="form-group">
         <label class="lable"> Photo </label>
   <div style="border: 1px solid black; height: 150px; width: 150px; ">
      <img src="uploads/<?php echo $row['image'];?>" id="output"  width="150" height="150" />
  </div>
    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" accept="image/*" / style="width:150px;">
    <div id="error_image"></div>
  

<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    }; 

  $('#output').show();
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
  </div>


   <div class="form-group">
    <label for="exampleInputEmail1">Source File</label> 
    <input type="file" name="imagee" onchange="loadFiles(event)" class="form-control">
    <?php if($row['source']!=''){?>
    <a target="_blank" href="uploads/<?php echo $row['source'];?>" style="float: right;"><i class="fa fa-eye"></i></a>
  <?php } else { echo 'N/A'; }?>

  </div>
   <div class="form-group">          
    <label for="exampleInputEmail1">Payment ID</label>
    <input type="text" name="txnid" value="<?php echo $row['txnid'];?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Status </label>
    <select name="status" class="form-control">
            <option value="<?php echo $row['status'];?>" style="background: #E7E0DF;"><?php echo $getCredit->status($row['status']);?></option>
<option value="1">Success</option>
<option value="3">Failed</option>
<option value="0">Pending</option>
    </select>
  </div>


  <button type="submit" name="subpost" class="btn plan-button btn-lg btn-block">Save </button>

  </form>
<?php } ?>
              
                    </div>
                </div>
  <?php 
  break; 
  case 'del': 
  $id=$_GET['id'];
     $rows=$getCredit->get_by_id('pregistrations','reg_id',$id);
  foreach($rows as $row)
  {
       $image=$row['image']; 
        $images=$row['source']; 
  }
  unlink('uploads/'.$image);
    unlink('uploads/'.$images);
    $getCredit->delete_by_id('pexam','reg_id',$id);
     $res=$getCredit->delete_by_id('pregistrations','reg_id',$id);
     if($res)
     {
      header("Location:registrations.php?action=Deleted");
     }
     else 
     {
      echo 'Something went wrong.....';
     }
  break;
  default:
?> 
                      

 <!-- <a href="?detect=add"><button class="btn plan-button">Add New </button></a> -->
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}

?>
<form action="" method="POST">
<div class="row">
  <div class="col-sm-4"> </div> <div class="col-sm-4"></div><div class="col-sm-4">

   
       <button name="getid" class="btn btn-primary" >Export CSV</button> 
  

    </div> 
  </div>


<input type="checkbox" name="all"  id="ckbCheckAll" > Select All 
  <div class="row" >
       
             
 <div class="table-responsive">
 <div class="col-sm-12">
         <div id="checkBoxes">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
        <th>#</th>
<th>Photo</th>
<th>Enrollment No.</th>
<th>Name</th>
<th>Father Name </th>
<th>Mother Name</th>
<th>Course</th>
<th>Reg Date</th>
<th>Status</th>
<th>Edit</th>
<th>Delete</th>


      </tr>
     </thead>
    </table>
   </div>
 </div>
   </div>
     
   </div>

    </form>

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
    url:"ajax.php?detect=registrations",
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
$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
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