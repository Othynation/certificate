<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
       include("functions.php");
?>

<?php include("header.php"); 
//if($postm!='admin'){header("location:index");exit();}

 include("sidebar.php");
switch($postm) {
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
                <h3>Ajouter Registration</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
    
                        if(isset($_POST['subpost'])){
                         $honorifics=$_POST['honorifics'];
                         $username=$_POST['username'];
                         $cin=$_POST['cin'];
                         $dob=$_POST['dob'];
                         $bplace=$_POST['bplace'];
                          $address=$_POST['address'];   $mobile=$_POST['mobile']; $fid=$_POST['fid']; $cent_id=$_POST['cent_id'];
                          
 $folder ="assets/profile/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'profile_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 if($file!=''){
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
 $error[] = 'Sorry, only JPG, JPEG & PNG files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your image is too large. Upload less than 1 MB in size.';
}
}

 if($file=='')
{
    $new_image_name=Null;
}

         if(!isset($error)){ 
$result=$getCer->insert_reg($honorifics,$username,$cin,$dob,$bplace,$address,$mobile,$fid,$cent_id,$new_image_name); 
           if($result)
    {
       if($file!=''){
             move_uploaded_file($file, 'assets/profile/' . $new_image_name); 
} 

 header("Location:registrations?action=Added");
          }
    else{
      $error[] ='Failed : Something went wrong';
    }
 }
 } ?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Honorifics</label>
     <select name="honorifics" class="form-control">
      <?php 
              $course_durations=$getCredit->get_option_value('honorifics');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Nom Complet</label>
     <input type="text" name="username" class="form-control" required>

  </div>

                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">CIN</label>
     <input type="text" name="cin" class="form-control">

  </div>

                      </div>
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date De Naissance</label>
     <input type="date" name="dob" class="form-control">

  </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Lieu De Naissance</label>
     <input type="text" name="bplace" class="form-control">
  </div>
                      </div>
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Address</label>
     <input type="text" name="address" class="form-control">
  </div>
                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Tél</label>
     <input type="number" name="mobile" class="form-control">
  </div>
                      </div>
                       <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Parents Phone</label>
          <input type="fid" name="fid" value="" class="form-control">
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
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 
                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 
 <div class="form-group">
         <label class="lable">Profile Image</label>
   <div style="border: 1px solid black; height: 152px; width: 152px; ">
      <img id="output"  width="150" height="150" / src="assets/icon/avatar.png">
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

<button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Register</button>

  </form>
              
                    </div>
                </div> 
  <?php 
  break; 
  case 'edit':
  $id=$_GET['id'];
  ?> 
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Modifier Registration</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
                         
                        if(isset($_POST['subpost'])){
                        $honorifics=$_POST['honorifics'];
                         $username=$_POST['username'];
                         $cin=$_POST['cin'];
                         $dob=$_POST['dob'];
                         $bplace=$_POST['bplace'];
                          $address=$_POST['address'];   $mobile=$_POST['mobile']; $fid=$_POST['fid']; $cent_id=$_POST['cent_id'];
                          $folder ="assets/profile/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'profile_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 $rows=$getCredit->get_by_id('registrations','reg_id',$id);
foreach($rows as $row)
{
       $oldimage=$row['image'];        
}

if($file!='')
{
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
 $error[] = 'Sorry, only JPG, JPEG & PNG files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your image is too large. Upload less than 1 MB in size.';
} 
}
else 
{
       $new_image_name=$oldimage;      
}

          
         if(!isset($error)){ 
$result=$getCer->update_reg($honorifics,$username,$cin,$dob,$bplace,$address,$mobile,$fid,$cent_id,$new_image_name,$id); 

           if($result)
    {  
      if($file!='')
{
unlink('assets/profile/'.$oldimage);
  move_uploaded_file($file, 'assets/profile/' . $new_image_name);   
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

  $sql="SELECT * 
FROM registrations 
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
 WHERE registrations.reg_id=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Honorifics</label>
     <select name="honorifics" class="form-control">
        <option value="<?php echo $row['honorific'];?>" style="background: #CBCDD1;"><?php echo $row['honorific'];?></option>
        <?php 
              $course_durations=$getCredit->get_option_value('honorifics');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Nom Complet</label>
     <input type="text" name="username" value="<?php echo $row['name'];?>" class="form-control">

  </div>

                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">CIN</label>
     <input type="text" name="cin" value="<?php echo $row['cin'];?>" class="form-control">

  </div>

                      </div>
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date De Naissance</label>
     <input type="date" name="dob" value="<?php echo $row['dob'];?>" class="form-control">

  </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Lieu De Naissance</label>
     <input type="text" name="bplace" value="<?php echo $row['bplace'];?>" class="form-control">
  </div>
                      </div>
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Address</label>
     <input type="text" name="address" value="<?php echo $row['address'];?>" class="form-control">
  </div>
                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Tél</label>
     <input type="number" name="mobile"  value="<?php echo $row['mobile'];?>" class="form-control">
  </div>
                      </div>
                       <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Parents Phone</label>
     <input type="fid" name="fid" value="<?php echo $row['fid'];?>" class="form-control">

  </div>
                       </div>
                        <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" >
       <option value="<?php echo $row['cent_id'];?>" style="background: #CBCDD1;"><?php echo $row['centre_name'];?></option>
 <?php $rows=$getCredit->fetch_all('centres','cent_id','DESC'); 
 foreach($rows as $rowc)
 {
  echo '<option value="'.$rowc['cent_id'].'">'.$rowc['centre_name'].'</option>'; 
 }
        ?> 
                  
        </select>
  </div>
                       </div>
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 
                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 
  
 <div class="form-group">
         <label class="lable">Profile Image</label>
   <div style="border: 1px solid black; height: 152px; width: 152px; ">
    <?php 
    if($row['image']!='')
    {
      echo '<img id="output"  width="150" height="150" / src="assets/profile/'.$row['image'].'">';
    }
    else 
    {
      echo ' <img id="output"  width="150" height="150" / src="assets/icon/avatar.png">';
    }
    ?>
      
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
  <button type="submit" name="subpost" class="btn plan-button btn-lg">Modifier Registration</button>


  </form>
<?php } ?>
              
                    </div>
                </div>
  <?php 
  break; 
  case 'del': 
  $id=$_GET['id'];
  $res=$getCredit->delete_by_id('certificates','reg_id',$id);
     $res=$getCredit->delete_by_id('registrations','reg_id',$id);
     if($res)
     {
      header("Location:registrations?action=Deleted");
     }
     else 
     {
      echo 'Something went wrong.....';
     }
  break;
  default:

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Registrations</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

                    
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Nouveau </button></a>
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
<th>ID</th>
<th>Profile</th>
<th>Full Name</th>
<th>CIN</th>
<th>Birth Date</th>
<th>Parents Phone</th>
<th>Centre</th>
<th>Added By</th>
<th>Reg Date</th>
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
                <h3>Ajouter Registration</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
    
                        if(isset($_POST['subpost'])){
                         $honorifics=$_POST['honorifics'];
                         $username=$_POST['username'];
                         $cin=$_POST['cin'];
                         $dob=$_POST['dob'];
                         $bplace=$_POST['bplace'];
                          $address=$_POST['address'];  
                           $mobile=$_POST['mobile']; $fid=$_POST['fid']; $cent_id=$_POST['cent_id'];

                           $count=$getCredit->count_by_string_two_col('links','id',$user_id,'cent_id',$cent_id);
                           if($count==0)
                           {
                           $error[]='Invalid centre'; 
                           }
                           $folder ="assets/profile/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'profile_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
  if($file!=''){
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
 $error[] = 'Sorry, only JPG, JPEG & PNG files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your image is too large. Upload less than 1 MB in size.';
}
}

 if($file=='')
{
    $new_image_name=Null;
}
         if(!isset($error)){ 
$result=$getCer->insert_reg($honorifics,$username,$cin,$dob,$bplace,$address,$mobile,$fid,$cent_id,$new_image_name); 
           if($result)
    {
       if($file!=''){
             move_uploaded_file($file, 'assets/profile/' . $new_image_name); 
} 

 header("Location:registrations?action=Added");
          }
    else{
      $error[] ='Failed : Something went wrong';
    }
 }
 } 
   if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
} 

 ?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Honorifics</label>
     <select name="honorifics" class="form-control" required>
      <?php 
              $course_durations=$getCredit->get_option_value('honorifics');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Nom Complet</label>
     <input type="text" name="username" class="form-control" required>

  </div>

                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">CIN</label>
     <input type="text" name="cin" class="form-control">

  </div>

                      </div>
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date De Naissance</label>
     <input type="date" name="dob" class="form-control" required>

  </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Lieu De Naissance</label>
     <input type="text" name="bplace" class="form-control">
  </div>
                      </div>
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Address</label>
     <input type="text" name="address" class="form-control">
  </div>
                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Tél</label>
     <input type="number" name="mobile" class="form-control">
  </div>
                      </div>
                       <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Parents Phone</label>
   <input type="fid" name="fid" value="" class="form-control">
  </div>
                       </div>
                        <div class="col-sm-6">

                         <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" required>
         <option value="">Selectionner Centre </option> 
                          <?php 
                          $sql="SELECT * 
FROM centres 
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rows=$getCredit->get_by_id_query($sql,$user_id);
                      
 foreach($rows as $row)
 {
  echo '<option value="'.$row['cent_id'].'">'.$row['centre_name'].'</option>'; 
 }
        ?> 
                  
        </select>
  </div>
                       </div>
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 

                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 
  
 <div class="form-group">
         <label class="lable">Profile Image</label>
   <div style="border: 1px solid black; height: 152px; width: 152px; ">
      <img id="output"  width="150" height="150" / src="assets/icon/avatar.png">
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
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Register</button>
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
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Modifier Registration</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <div class="row">
                    
                    <div class="col-md-9">
                        <?php 
                         
                        if(isset($_POST['subpost'])){
                        $honorifics=$_POST['honorifics'];
                         $username=$_POST['username'];
                         $cin=$_POST['cin'];
                         $dob=$_POST['dob'];
                         $bplace=$_POST['bplace'];
                          $address=$_POST['address'];   $mobile=$_POST['mobile']; $fid=$_POST['fid']; $cent_id=$_POST['cent_id'];
                          $count=$getCredit->count_by_string_two_col('links','id',$user_id,'cent_id',$cent_id);
                           if($count==0)
                           {
                           $error[]='Invalid centre'; 
                           }
          
                                   $folder ="assets/profile/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'profile_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 $rows=$getCredit->get_by_id('registrations','reg_id',$id);
foreach($rows as $row)
{
       $oldimage=$row['image'];        
}

if($file!='')
{
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
 $error[] = 'Sorry, only JPG, JPEG & PNG files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your image is too large. Upload less than 1 MB in size.';
} 
}
else 
{
       $new_image_name=$oldimage;      
}

         if(!isset($error)){ 
$result=$getCer->update_reg($honorifics,$username,$cin,$dob,$bplace,$address,$mobile,$fid,$cent_id,$new_image_name,$id); 
           if($result)
    { 
        if($file!='')
{
unlink('assets/profile/'.$oldimage);
  move_uploaded_file($file, 'assets/profile/' . $new_image_name);   
} 

echo '<div class="success">Saved</div>';
          }

   
    else{
      $error[] ='Failed : Something went wrong';
    }

    }
                           }
 if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
} 


                            ?>


<?php 

  $sql="SELECT * 
FROM registrations 
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND registrations.reg_id=:id"; 

      $rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
?>

                   <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Honorifics</label>
     <select name="honorifics" class="form-control">
        <option value="<?php echo $row['honorific'];?>" style="background: #CBCDD1;"><?php echo $row['honorific'];?></option>
        <?php 
              $course_durations=$getCredit->get_option_value('honorifics');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Nom Complet</label>
     <input type="text" name="username" value="<?php echo $row['name'];?>" class="form-control">

  </div>

                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">CIN</label>
     <input type="text" name="cin" value="<?php echo $row['cin'];?>" class="form-control">

  </div>

                      </div>
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date De Naissance</label>
     <input type="date" name="dob" value="<?php echo $row['dob'];?>" class="form-control">

  </div>

                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Lieu De Naissance</label>
     <input type="text" name="bplace" value="<?php echo $row['bplace'];?>" class="form-control">
  </div>
                      </div>
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Address</label>
     <input type="text" name="address" value="<?php echo $row['address'];?>" class="form-control">
  </div>
                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Tél</label>
     <input type="number" name="mobile"  value="<?php echo $row['mobile'];?>" class="form-control">
  </div>
                      </div>
                       <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Parents Phone</label>
   <input type="fid" name="fid" value="<?php echo $row['fid'];?>" class="form-control">
  </div>
                       </div>
                        <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" >
       <option value="<?php echo $row['cent_id'];?>" style="background: #CBCDD1;"><?php echo $row['centre_name'];?></option>
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
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 

                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 
  <div class="form-group">
         <label class="lable">Profile Image</label>
   <div style="border: 1px solid black; height: 152px; width: 152px; ">
    <?php 
    if($row['image']!='')
    {
      echo '<img id="output"  width="150" height="150" / src="assets/profile/'.$row['image'].'">';
    }
    else 
    {
      echo ' <img id="output"  width="150" height="150" / src="assets/icon/avatar.png">';
    }
    ?>
      
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
  <button type="submit" name="subpost" class="btn plan-button btn-lg">Modifier Registration</button>

 

  </form>
<?php } ?>
              
                    </div>
                </div>
  <?php 
  break; 
  case 'delblock': 
  break;
  default:

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Registrations</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

                    
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Nouveau </button></a>
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
<th>ID</th>
<th>Profile</th>
<th>Full Name</th>
<th>CIN</th>
<th>Birth Date</th>
<th>Parents Phone</th>
<th>Centre</th>
<th>Reg Date</th>
<th>Edit</th>


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
    url:"ajaxm.php?detect=registrations",
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

<div class="page-title">
              <div class="title_left">
                <h3>Registrations</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

   
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
<th>ID</th>
<th>Profile</th>
<th>Full Name</th>
<th>CIN</th>
<th>Birth Date</th>
<th>Parents Phone</th>
<th>Centre</th>
<th>Added By</th>
<th>Reg Date</th>
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
    url:"ajaxy.php?detect=registrations",
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
  default:
header("location:index");
  break;
}
  ?>




          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
        
        
    
    <!-- Select Input Search -->
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

  <!-- Include Select2 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function() {
      $('select[name="fid"]').select2();
    });
  </script>
  
  <style>
      .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ced4da !important;
            font-size: 1rem;
            font-weight: 400;
            color: #495057;
            border-radius: 4px;
            border-radius: 25px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 6px !important;
        }
  </style>
    <!-- /Select Input Search -->
    
        
      </div>
    </div>
   <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
  </body>
</html>