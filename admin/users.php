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
                <h3>Add New User</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <?php
    if(isset($_POST['add_submit'])){
        extract($_POST);
         $uphone=$_POST['uphone'];
          $ucin=$_POST['ucin'];


        $post=$_POST['post'];
                                 if(isset($_POST['cent_id']))
                           {
                            $cat_id =$_POST['cent_id'];
                           }
                           else 
                           {
                            $cat_id='';
                           }
                           $folder ="uploads/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'file_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
 $error[] = 'Sorry, only JPG, JPEG, PNG, PDF files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your file is too large. Upload less than 1 MB in size.';
}

 if($file=='')
{
    $new_image_name=Null;
}


$error=$getUser->ac_validate($fname,$lname,$username,$email,$password,$passwordConfirm,'','','add'); 
         if($error==NULL){
           $lastid=$getUser->insert_user($fname,$lname,$username,$email,$password,$post,$new_image_name,$ucin,$uphone); 
                 if($lastid>0)
                {
                    if($file!=''){
             move_uploaded_file($file, 'uploads/' . $new_image_name); 
} 

                        if($cat_id!=''){
    if(is_array($cat_id)){
    foreach($_POST['cent_id'] as $cat_id){
        $getUser->insert_links($lastid,$cat_id); 
    }
}
}

                  header('Location:users?action=added');
                }
                else 
                {
                    echo '<p class="errormsg">Something went wrong..</p>';
                }
                

        
        }

    }
 ?>
    
   
   
<div class="row"> 
             <div class="col-md-8 col-sm-8">
              <?php 
               if(isset($error)){
        foreach($error as $error){
            echo '<p class="errormsg">'.$error.'</p>';
        }
    }?>

  
    <form action='' method='post' enctype='multipart/form-data'>
      <div class="col-md-6 col-sm-6">
      <label>First Name </label>

        <input type='text' name='fname' class="form-control" value='<?php if(isset($error)){ echo $_POST['fname'];}?>' required>
      </div>
      <div class="col-md-6 col-sm-6">
      <label>Last Name </label>

        <input type='text' name='lname' class="form-control" value='<?php if(isset($error)){ echo $_POST['lname'];}?>' required>
      </div>

<div class="col-md-6 col-sm-6">
      <label>Username</label>

        <input type='text' name='username' class="form-control" value='<?php if(isset($error)){ echo $_POST['username'];}?>' required>
      </div>
<div class="col-md-6 col-sm-6">
        <label>Email</label>
        <input type='email' name='email' class="form-control" value='<?php if(isset($error)){ echo $_POST['email'];}?>' required>
        <br>
        </div>

<div class="col-md-6 col-sm-6">
        <label>Password</label>
        <input type='password' name='password' class="form-control" value='<?php if(isset($error)){ echo $_POST['password'];}?>' required>
</div>
<div class="col-md-6 col-sm-6">
        <label>Confirm Password</label>
        <input type='password' name='passwordConfirm' class="form-control" value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>' required>
</div>

        <div class="col-md-12 col-sm-12">
            <hr>
        </div>
        <div class="col-md-6 col-sm-6">
      <label>Phone Number</label>

        <input type='number' name='uphone' class="form-control" value='<?php if(isset($error)){ echo $_POST['uphone'];}?>'>
      </div>

        <div class="col-md-6 col-sm-6">
      <label>CIN</label>

        <input type='text' name='ucin' class="form-control" value='<?php if(isset($error)){ echo $_POST['ucin'];}?>'>
      </div>

        <div class="col-md-12 col-sm-12">
       <div class="form-group">
        <br>
         <label class="lable">Upload File</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
    <small>(JPG,PNG,JPEG,PDF)</small>
    <div id="error_image"></div>

  
  </div>
</div>



               </div>
               <div class="col-sm-3">
                  <div class="form-group">
    
    <label for="exampleInputEmail1">Authorise Centres</label> 
     <br>
     <div style="height:180px; overflow: auto; border: 1px solid gray; padding: 5px;">
     <?php    
$checked = null; 
       $rows2=$getCredit->fetch_all('centres','centre_name','ASC');
    foreach($rows2 as $row2){

        if(isset($_POST['cent_id'])){

            if(in_array($row2['cent_id'], $_POST['centre_name'])){
               $checked="";
            }else{
               

            }
        }

        echo "<input type='checkbox' name='cent_id[]' value='".$row2['cent_id']."' $checked> ".$row2['centre_name']."<br />";
    }

    ?>

</div>
  </div>
   <div class="form-group">
     <label>User Type</label>
    <select name="post" class="form-control" required>
         <option value="">Select User Type</option>
       <option value="user">User</option>
       <option value="admin">Admin</option>
         <option value="employee">Employee</option>
    </select>
   </div>
  

        <div class="col-md-12 col-sm-12 ">
          <br>
        <input type='submit' class="btn plan-button" name='add_submit' value='Add User'>
      </div>
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
                <h3>Edit User</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br>

  <?php
$id=$_GET['id']; 
 $rows=$getCredit->get_by_id('ts_gtw_users','id',$id); 
  foreach($rows as $row)
  {
    $dbfname=$row['fname'];
    $dblname=$row['lname'];
    $dbusername=$row['username'];
    $dbemail=$row['email'];
     $dbpost=$row['post'];
  }

    if(isset($_POST['submit'])){
        extract($_POST);
              $post=$_POST['post'];
               if(isset($_POST['cent_id']))
                           {
                            $cat_id =$_POST['cent_id'];
                           }
                           else 
                           {
                            $cat_id='';
                           }
                           $status=$_POST['status'];

        if($id==1)
        {
          $post='admin'; 
          $status=1;

        }
        if($post=='admin')
        {
             $cat_id=''; 
        }
        $folder ="uploads/";
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'file_'.rand() . '.' . $extension;
 $imageFileType =strtolower($extension);
 $rows=$getCredit->get_by_id('ts_gtw_users','id',$id); 
  foreach($rows as $row)
  {
      $uusource=$row['usource'];
  }
if($file!='')
{
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf") {
 $error[] = 'Sorry, only JPG, JPEG, PNG, PDF files are allowed';   
}
//Set image upload size 
    if ($_FILES["image"]["size"] > 1000020) {
   $error[] = 'Sorry, your file is too large. Upload less than 1 MB in size.';
}
  
}
else
{
    $new_image_name=$uusource;
}

      $error=$getUser->ac_validate($fname,$lname,$username,$email,$password,$passwordConfirm,$dbusername,$dbemail,'edit'); 

        if($error==NULL){
          $res=$getUser->update_user($fname,$lname,$username,$email,$password,$post,$status,$new_image_name,$ucin,$uphone,$id); 
               if($res)
               {
                  if($file!=''){
                                unlink('uploads/'.$uusource);
             move_uploaded_file($file, 'uploads/' . $new_image_name); 
} 


                if($cat_id!='')
      {
         $getCredit->delete_by_id('links','id',$id); 
        if(is_array($cat_id)){
    foreach($_POST['cent_id'] as $cat_id){
        $getUser->insert_links($id,$cat_id); 
    }
}
      }

             echo '<div class="success">Saved</div>';
                 
               }
               else 
               {
                echo '<div class="errormsg">Something went wrong</div><br />';
               }
               
              
        }

    }

 $rows=$getCredit->get_by_id('ts_gtw_users','id',$id); 
  foreach($rows as $row)
  {
    $dbfname=$row['fname'];
    $dblname=$row['lname'];
    $dbusername=$row['username'];
    $dbemail=$row['email'];
     $dbpost=$row['post'];
      $dbstatus=$row['ustatus'];
      $usource=$row['usource'];
       $ucin=$row['ucin']; $uphone=$row['uphone'];

  }
    ?>

<div class="row"> 
             <div class="col-md-8 col-sm-8">
    <?php
    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo '<div class="errormsg">'.$error.'</div><br />';
        }
    }

        try {

        } catch(PDOException $e) {
            echo $e->getMessage();
        }

    ?>

  
    <form action='' method='post' enctype='multipart/form-data'>
      <div class="col-md-6 col-sm-6">
      <label>First Name </label>
        <input type='text' name='fname' class="form-control" value='<?php echo $dbfname; ?>'>
      </div>
      <div class="col-md-6 col-sm-6">
      <label>Last Name </label>
        <input type='text' name='lname' class="form-control" value='<?php echo $dblname; ?>'>
      </div>

<div class="col-md-6 col-sm-6">
      <label>Username</label>
        <input type='text' name='username' class="form-control" value='<?php echo $dbusername; ?>'>
      </div>
      <div class="col-md-6 col-sm-6">
        <label>Email</label>
        <input type='text' name='email' class="form-control" value='<?php echo $dbemail;?>'>
        <br>
        </div>
<div class="col-md-6 col-sm-6">
        <label>Password</label>
        <input type='password' name='password' class="form-control">
</div>
<div class="col-md-6 col-sm-6">
        <label>Confirm Password</label>
        <input type='password' name='passwordConfirm' class="form-control">
</div>

          <div class="col-md-12 col-sm-12">
            <hr>
        </div>
        <div class="col-md-6 col-sm-6">
      <label>Phone Number</label>

        <input type='number' name='uphone' class="form-control" value='<?php echo $uphone;?>'>
      </div>

        <div class="col-md-6 col-sm-6">
      <label>CIN</label>

        <input type='text' name='ucin' class="form-control" value='<?php echo $ucin;?>'>
      </div>

        <div class="col-md-12 col-sm-12">
       <div class="form-group">
        <br>
         <label class="lable">Upload File</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
     <small>(JPG,PNG,JPEG,PDF)</small>

  <?php 
    if($usource!='')
    {
        echo '<br>'.$usource.' &nbsp; <a target="_blank" class="btn btn-success" href="uploads/'.$usource.'">View</a>';
    }
    else 
    {
          echo 'N/A';
    }
    ?>

  </div>
</div>



  </div>

  <div class="col-sm-3">
                  <div class="form-group">
    
    <label for="exampleInputEmail1">Authorise Centres</label> 
     <br>
     <div style="height:180px; overflow: auto; border: 1px solid gray; padding: 5px;">
      <?php
$checked = '';
     $rows2 = $getCredit->fetch_all('centres','centre_name','ASC'); 
    foreach($rows2 as $row2){ 
      $rt_catid=$row2['cent_id'];
                  $row3=$getCredit->fecth_by_string_two_col_fetch('links','cent_id',$rt_catid,'id',$id);
                  // echo var_dump($rows3) ;
        if(isset($row3['cent_id']) == $row2['cent_id']){
            $checked = 'checked=checked';
        } else {
            $checked = '';
        }

        echo "<input type='checkbox' name='cent_id[]' value='".$row2['cent_id']."' $checked> ".$row2['centre_name']."<br />";
    }

    ?>


</div>
  </div>
   <div class="form-group">
     <label>User Type</label>
    <select name="post" class="form-control" required>
         <option value="<?php echo $dbpost; ?>" style="background: #6B89FF;"><?php echo $dbpost; ?></option>
       <option value="user">User</option>
       <option value="admin">Admin</option>
       <option value="employee">Employee</option>
    </select>
   </div>

   <div class="form-group">
     <label>Status</label>
    <select name="status" class="form-control" required>
         <option value="<?php echo $dbstatus;?>" style="background: #E7E0DF;"><?php echo $getCredit->status($dbstatus);?></option>
       <option value="1">Unblock</option>
       <option value="0">Block</option>
    </select>
   </div>


        <div class="col-md-12 col-sm-12 ">
          <br>
       <input type='submit' class="btn plan-button" name='submit' value='Update User'>
      </div>
          </form>

               </div>

</div>
  <?php 
  break;
 case 'del':
       $id=$_GET['id'];
       if($id!=1) 
       {
          $res=$getCredit->delete_by_id('links','id',$id);
           $rows=$getCredit->get_by_id('ts_gtw_users','id',$id); 
          foreach($rows as $row)
  {
      $uusource=$row['usource'];
  }
    unlink('uploads/'.$uusource);

          $res=$getCredit->delete_by_id('ts_gtw_users','id',$id); 
      if($res)
      {
        header("location:users?action=deleted"); 
      }
      else 
      {
        echo 'Something went wrong'; 
      } 
       }
       else 
       {
        echo 'Sorry , You cant delete first user '; 
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
                <h3>Users</h3>
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
        <th class="column-title">ID</th>
        <th class="column-title">First Name</th>
                            <th class="column-title">Last Name </th>
                            <th class="column-title">Username  </th>
                            <th class="column-title">Email</th>
                            <th class="column-title">User Type</th>
                            <th class="column-title">Date </th>
                            <th class="column-title">Status</th>
                            <th class="column-title">Edit </th>
                            <th class="column-title">Delete </th>


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
    url:"ajax.php?detect=users",
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