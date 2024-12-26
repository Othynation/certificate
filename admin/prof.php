<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
       include("functions.php");
?>
<?php include("header.php"); 
//if($postm!='admin'){header("location:index");exit();}
?>
                <?php include("sidebar.php"); 
                switch($postm) 
{
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
                <h3>Add New Prof</h3>

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
          $cent_id=$_POST['cent_id'];
         $salary_type=NULL;
          $samount=0;
           if (!preg_match('/^[0-9]+(\.[0-9]+)?$/', $samount)) {
    $error []= "Invalid salary amount. Please enter a valid number.";
}



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

$post='prof'; 
$error=$getUser->ac_validate($fname,$lname,$username,$email,$password,$passwordConfirm,'','','add'); 
         if($error==NULL){
           $lastid=$getUser->insert_user2($fname,$lname,$username,$email,$password,$post,$new_image_name,$ucin,$uphone,$salary_type,$samount,$user_id,$cent_id); 
                 if($lastid>0)
                {
                    if($file!=''){
             move_uploaded_file($file, 'uploads/' . $new_image_name); 
} 

//                         if($cat_id!=''){
//     if(is_array($cat_id)){
//     foreach($_POST['cent_id'] as $cat_id){
//         $getUser->insert_links($lastid,$cat_id); 
//     }
// }
// }

                  header('Location:prof?action=added');
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
               </div>
               <div class="col-sm-3">
                 <div class="col-md-12 col-sm-12">
       <div class="form-group">
        <br>
         <label class="lable">Upload File</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
    <small>(JPG,PNG,JPEG,PDF)</small>
    <div id="error_image"></div>

  
  </div>
</div>

                  
        <div class="col-md-12 col-sm-12 ">
          <br>
        <input type='submit' class="btn plan-button" name='add_submit' value='Add Prof'>
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
                <h3>Edit Prof</h3>

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
        $salary_type=NULL;
        $cent_id=$_POST['cent_id'];
          $samount=0;
          if (!preg_match('/^[0-9]+(\.[0-9]+)?$/', $samount)) {
    $error []= "Invalid salary amount. Please enter a valid number.";
}



               if(isset($_POST['cent_id']))
                           {
                            $cat_id =$_POST['cent_id'];
                           }
                           else 
                           {
                            $cat_id='';
                           }
                           $status=$_POST['status'];

       $post='prof';
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
          $res=$getUser->update_user2($fname,$lname,$username,$email,$password,$post,$status,$new_image_name,$ucin,$uphone,$salary_type,$samount,$cent_id,$id); 
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

 $sql="SELECT * 
FROM ts_gtw_users 
LEFT JOIN centres ON ts_gtw_users.cnt_id=centres.cent_id
 WHERE ts_gtw_users.id=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
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
  ?> 
              
                    </div>
                </div>
                <?php 
                break;
                case 'salary':
                $id=$_GET['id'];
                $rows=$getCredit->get_by_id('ts_gtw_users','id',$id); 
  foreach($rows as $row)
  {
    $dbfname=$row['fname'];
    $dblname=$row['lname'];
    $dbusername=$row['username'];

  }

                ?>
                <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              
                <h1>Professor <strong><?php  echo '('.$getCredit->jump_to("prof?detect=edit&id=".$row['id']."",$row["username"]).')'; ?></strong> salary report</h1>

             

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
   
   
<div class="row"> 
             <div class="col-md-12 col-sm-12">
              <?php 
               if(isset($error)){
        foreach($error as $error){
            echo '<p class="errormsg">'.$error.'</p>';
        }
    }?>

      <div class="row">
        <div class="col-sm-1">  <div class="form-group">  <label for="exampleInputEmail1">Group</label></div></div> 
         <div class="col-sm-2"> <div class="form-group">          
     <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 
 $sql="SELECT DISTINCT r.gname, r.gid 
      FROM inscription i 
      LEFT JOIN groups r ON i.gid = r.gid 
      LEFT JOIN schedual s ON r.gid=s.gid 
      WHERE pid='$id' 
      ORDER BY r.gname ASC;";

$rg=$getCredit->get_by_query($sql);

              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
              }
              ?>
     </select>
  </div></div>
      <div class="col-sm-1">  <div class="form-group">  <label for="exampleInputEmail1">From </label></div></div> 
      <div class="col-md-2"><input type="date" name="from" id="from" value="" class="form-control" required> </div>
       <div class="col-sm-1">  <div class="form-group">  <label for="exampleInputEmail1">To</label></div></div> 
      <div class="col-md-2"><input type="date" name="to" id="to" class="form-control" required>
        <input type="hidden" name="prof_id" id="prof_id" value="<?php echo $id;?>" class="form-control" required>
       </div>
      <div class="col-md-2"><div class="form-group"> <input type='submit' class="btn btn-success" id="fmsub" name='add_submit' value='Filter'></div></div>
       <div class="col-sm-8"> </div>
         <div class="col-sm-1"><div class="form-group"> <input type='submit' class="btn btn-warning" id="prev" name='add_submit' value='Prev'></div></div>
         
         <div class="col-sm-1"><div class="form-group"> <input type='submit' class="btn btn-warning" id="next" name='add_submit' value='Next'></div></div>
          
    

      <div class="col-md-12"> <hr></div>

      </div>
<div id="amarea"> </div>


               </div>
               <div class="col-sm-3">
                
               </div>
</div>

<script type="text/javascript">
$('#from').change(function() {
  var from = $(this).val();
  var fromDate = new Date(from);
  var nextMonth = new Date(fromDate.getFullYear(), fromDate.getMonth() + 1, fromDate.getDate());
  var toValue = nextMonth.toISOString().split('T')[0];
  $('#to').val(toValue);
  $('#to').attr('min', from);
});

  $(document).on('click', '#fmsub', function(){
var gid = $('#gid').val();
var from = $('#from').val();
var to = $('#to').val();
var prof_id = $('#prof_id').val();
if(gid.trim() == ''){
alert('Please select a group');
} 
else if(from.trim() == ''){
alert('Please select from date');
} 
else if(to.trim() == ''){
alert('Please select to date');
} 
else {
$.ajax({
method:"POST",
url: "action?detect=salary",
data: {
gid: gid,
from: from,
to: to,
prof_id: prof_id
},
beforeSend: function(){
$("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");

},
success: function(data){
//alert(data);
$("#amarea").html(data);
}
});
}
});

   $(document).on('change', '#gid', function(){
  var gid= $('#gid').val();
  //alert(gid);
  if(gid.trim() == '' ) {          
   alert('Please select a Group'); 
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=gsalary",      
data: {gid: gid },
        beforeSend: function() {
           $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");
           },
        success: function(data){ 
        var from = data.trim();
  $("#from").val(from);
  
  if(from != '') {
    var fromDate = new Date(from);
    var toDate = new Date(fromDate.getFullYear(), fromDate.getMonth() + 1, fromDate.getDate());
    var year = toDate.getFullYear();
    var month = (toDate.getMonth() + 1).toString().padStart(2, '0');
    var day = toDate.getDate().toString().padStart(2, '0');
    var to = year + '-' + month + '-' + day;
    $("#to").val(to); // Assuming you have an input field with id "to"
  }
  $("#amarea").html('');
    }});
}
 });


$(document).ready(function() {
  $("#next, #prev").click(function(e) {
    e.preventDefault();
    
    var from = $("#from").val().split("-");
    var to = $("#to").val().split("-");
    
    var fromDate = new Date(from[0], from[1] - 1, from[2]);
    var toDate = new Date(to[0], to[1] - 1, to[2]);
    
 if ($(this).attr("id") === "next") {
      toDate.setMonth(toDate.getMonth() + 1);
      fromDate = new Date(toDate.getFullYear(), toDate.getMonth() - 1, toDate.getDate());
    } else {
      fromDate.setMonth(fromDate.getMonth() - 1);
      toDate = new Date(fromDate.getFullYear(), fromDate.getMonth() + 1, fromDate.getDate());
    }
    
    $("#from").val(formatDate(fromDate));
    $("#to").val(formatDate(toDate));
  });

  function formatDate(date) {
    var year = date.getFullYear();
    var month = (date.getMonth() + 1).toString().padStart(2, '0');
    var day = date.getDate().toString().padStart(2, '0');
    
    return year + '-' + month + '-' + day;
  }
});



</script>

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
        header("location:prof?action=deleted"); 
      }
      else 
      {
        echo 'Something went wrong'; 
      } 
       }
       else 
       {
        echo 'Sorry , You can`t delete first user '; 
       }
     
  break;
  default:

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Profs</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>             
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Prof</button></a>
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
<th>Full Name</th>
<th>Phone</th>
<th>Centre</th>
<th>Status</th>
<th>Salary</th>
<th>Added By</th>
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
    url:"ajax.php?detect=profs",
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
                <h3>Add New Prof</h3>

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
         $salary_type=NULL;
          $samount=0;
           if (!preg_match('/^[0-9]+(\.[0-9]+)?$/', $samount)) {
    $error []= "Invalid salary amount. Please enter a valid number.";
}
                                 if(isset($_POST['cent_id']))
                           {
                            $cat_id =$_POST['cent_id'];
                           }
                           else 
                           {
                            $cat_id='';
                           }

                           $cent_id=$_POST['cent_id'];
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

$post='prof'; 
$error=$getUser->ac_validate($fname,$lname,$username,$email,$password,$passwordConfirm,'','','add'); 
         if($error==NULL){
           $lastid=$getUser->insert_user2($fname,$lname,$username,$email,$password,$post,$new_image_name,$ucin,$uphone,$salary_type,$samount,$user_id,$cent_id); 
                 if($lastid>0)
                {
                    if($file!=''){
             move_uploaded_file($file, 'uploads/' . $new_image_name); 
} 

//                         if($cat_id!=''){
//     if(is_array($cat_id)){
//     foreach($_POST['cent_id'] as $cat_id){
//         $getUser->insert_links($lastid,$cat_id); 
//     }
// }
// }

                  header('Location:prof?action=added');
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

 

</div>
               <div class="col-sm-3">
                 <div class="col-md-12 col-sm-12">
       <div class="form-group">
        <br>
         <label class="lable">Upload File</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
    <small>(JPG,PNG,JPEG,PDF)</small>
    <div id="error_image"></div>

  
  </div>
</div>

                  
        <div class="col-md-12 col-sm-12 ">
          <br>
        <input type='submit' class="btn plan-button" name='add_submit' value='Add Prof'>
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
                <h3>Edit Prof</h3>

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
        $salary_type=NULL;
          $samount=0;
          if (!preg_match('/^[0-9]+(\.[0-9]+)?$/', $samount)) {
    $error []= "Invalid salary amount. Please enter a valid number.";
}
 if(isset($_POST['cent_id']))
                           {
                            $cat_id =$_POST['cent_id'];
                           }
                           else 
                           {
                            $cat_id='';
                           }
                           $cent_id=$_POST['cent_id'];
                           $status=$_POST['status'];

       $post='prof';
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
          $res=$getUser->update_user2($fname,$lname,$username,$email,$password,$post,$status,$new_image_name,$ucin,$uphone,$salary_type,$samount,$cent_id,$id); 
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
    $post='prof';
 $sql="SELECT * 
FROM ts_gtw_users
LEFT JOIN centres ON ts_gtw_users.cnt_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE post='$post' AND ts_gtw_users.id=:id AND  links.id='$user_id'
";
$rows=$getCredit->get_by_id_query($sql,$id);
  foreach($rows as $row)
  {

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
        <input type='text' name='fname' class="form-control" value='<?php echo $row['fname']; ?>'>
      </div>
      <div class="col-md-6 col-sm-6">
      <label>Last Name </label>
        <input type='text' name='lname' class="form-control" value='<?php echo $row['lname']; ?>'>
      </div>

<div class="col-md-6 col-sm-6">
      <label>Username</label>
        <input type='text' name='username' class="form-control" value='<?php echo $row['username']; ?>'>
      </div>
      <div class="col-md-6 col-sm-6">
        <label>Email</label>
        <input type='text' name='email' class="form-control" value='<?php echo $row['email'];?>'>
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
 <div class="col-sm-6">
                         <div class="form-group">
    <label for="exampleInputEmail1">Centre</label>
   <select name="cent_id" class="form-control" >
       <option value="<?php echo $row['cent_id'];?>" style="background: #CBCDD1;"><?php echo $row['centre_name'];?></option>
 <?php

 $sql="SELECT * 
FROM centres 
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id=:id";         
$rows=$getCredit->get_by_id_query($sql,$user_id);
                      
 foreach($rows as $rowc)
 {
  echo '<option value="'.$rowc['cent_id'].'">'.$rowc['centre_name'].'</option>'; 
 }
        ?> 
                  
        </select>
  </div>
                       </div>


          <div class="col-md-12 col-sm-12">
            <hr>
        </div>
        <div class="col-md-6 col-sm-6">
      <label>Phone Number</label>

        <input type='number' name='uphone' class="form-control" value='<?php echo $row['uphone']?>'>
      </div>

        <div class="col-md-6 col-sm-6">
      <label>CIN</label>

        <input type='text' name='ucin' class="form-control" value='<?php echo $row['ucin'];?>'>
      </div>

        <div class="col-md-12 col-sm-12">
       <div class="form-group">
        <br>
         <label class="lable">Upload File</label>

    <input type="file" name="image" id="image" onchange="loadFile(event)" class="form-control" style="width:400px;">
     <small>(JPG,PNG,JPEG,PDF)</small>

  <?php 
    if($row['usource']!='')
    {
        echo '<br>'.$row['usource'].' &nbsp; <a target="_blank" class="btn btn-success" href="uploads/'.$row['usource'].'">View</a>';
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
     <label>Status</label>
    <select name="status" class="form-control" required>
         <option value="<?php echo $row['ustatus'];?>" style="background: #E7E0DF;"><?php echo $getCredit->status($row['ustatus']);?></option>
       <option value="1">Unblock</option>
       <option value="0">Block</option>
    </select>
   </div>


        <div class="col-md-12 col-sm-12 ">
          <br>
       <input type='submit' class="btn plan-button" name='submit' value='Update User'>
      </div>
          </form>
        <?php } ?> 

               </div>

</div>

  <?php
  break;
  ?> 
              
                    </div>
                </div>
                <?php 
                break;
                case 'salary':
                $id=$_GET['id'];
              $sql="SELECT count(*) as total
FROM ts_gtw_users
LEFT JOIN centres ON ts_gtw_users.cnt_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND ts_gtw_users.id='$id'
";
$count=$getCredit->count_by_query2($sql);
    //exit();

    //$count=$getCredit->count_by_string_two_col('ts_gtw_users','id',$id,'uid',$user_id);
  if($count==0)
  {
    header("location:index");
    exit();
  }

   $rows=$getCredit->get_by_id('ts_gtw_users','id',$id); 
  foreach($rows as $row)
  {
    $dbfname=$row['fname'];
    $dblname=$row['lname'];
    $dbusername=$row['username'];
  } ?>
                <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              
                <h1>Professor <strong><?php  echo '('.$getCredit->jump_to("prof?detect=edit&id=".$row['id']."",$row["username"]).')'; ?></strong> salary report</h1>

             

              <div class="title_right">
                
              </div>
            </div>
          </div>
        </div>
        <br> 
   
   
<div class="row"> 
             <div class="col-md-12 col-sm-12">
              <?php 
               if(isset($error)){
        foreach($error as $error){
            echo '<p class="errormsg">'.$error.'</p>';
        }
    }?>

  
    
      <div class="row">
        <div class="col-sm-1">  <div class="form-group">  <label for="exampleInputEmail1">Group</label></div></div> 
         <div class="col-sm-2"> <div class="form-group">          
     <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 

             $sql="
SELECT DISTINCT r.gname, r.gid
FROM inscription i
LEFT JOIN groups r ON i.gid = r.gid
INNER JOIN centres c ON r.cnt_id=c.cent_id
INNER JOIN links l ON c.cent_id=l.cent_id
 WHERE l.id='$user_id'; 
";        
$rg=$getCredit->get_by_query($sql);

              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
              }
              ?>
     </select>
  </div></div>
      <div class="col-sm-1">  <div class="form-group">  <label for="exampleInputEmail1">From </label></div></div> 
      <div class="col-md-2"><input type="date" name="from" id="from" class="form-control" required> </div>
       <div class="col-sm-1">  <div class="form-group">  <label for="exampleInputEmail1">To</label></div></div> 
      <div class="col-md-2"><input type="date" name="to" id="to" class="form-control" required>
        <input type="hidden" name="prof_id" id="prof_id" value="<?php echo $id;?>" class="form-control" required>
       </div>
      <div class="col-md-2"><div class="form-group"> <input type='submit' class="btn btn-success" id="fmsub" name='add_submit' value='Filter'></div></div>
       <div class="col-sm-8"> </div>
          <div class="col-sm-1"><div class="form-group"> <input type='submit' class="btn btn-warning" id="prev" name='add_submit' value='Prev'></div></div>
         <div class="col-sm-1"><div class="form-group"> <input type='submit' class="btn btn-warning" id="next" name='add_submit' value='Next'></div></div>
         
            
      <div class="col-md-12"> <hr></div>
      </div>
<div id="amarea"> </div>


               </div>
               <div class="col-sm-3">
                 
   
         

               </div>
</div>

<script type="text/javascript">
$('#from').change(function() {
  var from = $(this).val();
  var fromDate = new Date(from);
  var nextMonth = new Date(fromDate.getFullYear(), fromDate.getMonth() + 1, fromDate.getDate());
  var toValue = nextMonth.toISOString().split('T')[0];
  $('#to').val(toValue);
  $('#to').attr('min', from);
});

  $(document).on('click', '#fmsub', function(){
var gid = $('#gid').val();
var from = $('#from').val();
var to = $('#to').val();
var prof_id = $('#prof_id').val();
if(gid.trim() == ''){
alert('Please select a group');
} 
else if(from.trim() == ''){
alert('Please select from date');
} 
else if(to.trim() == ''){
alert('Please select to date');
} 
else {
$.ajax({
method:"POST",
url: "action?detect=salary",
data: {
gid: gid,
from: from,
to: to,
prof_id: prof_id
},
beforeSend: function(){
$("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");

},
success: function(data){
//alert(data);
$("#amarea").html(data);
}
});
}
});
  $(document).on('change', '#gid', function(){
  var gid= $('#gid').val();
  //alert(gid);
  if(gid.trim() == '' ) {          
   alert('Please select a Group'); 
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=gsalary",      
data: {gid: gid },
        beforeSend: function() {
           $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");
           },
        success: function(data){ 
        var from = data.trim();
  $("#from").val(from);
  
  if(from != '') {
    var fromDate = new Date(from);
    var toDate = new Date(fromDate.getFullYear(), fromDate.getMonth() + 1, fromDate.getDate());
    var year = toDate.getFullYear();
    var month = (toDate.getMonth() + 1).toString().padStart(2, '0');
    var day = toDate.getDate().toString().padStart(2, '0');
    var to = year + '-' + month + '-' + day;
    $("#to").val(to); // Assuming you have an input field with id "to"
  }
  $("#amarea").html('');
    }});
}
 });
  $(document).ready(function() {
  $("#next, #prev").click(function(e) {
    e.preventDefault();
    
    var from = $("#from").val().split("-");
    var to = $("#to").val().split("-");
    
    var fromDate = new Date(from[0], from[1] - 1, from[2]);
    var toDate = new Date(to[0], to[1] - 1, to[2]);
    
 if ($(this).attr("id") === "next") {
      toDate.setMonth(toDate.getMonth() + 1);
      fromDate = new Date(toDate.getFullYear(), toDate.getMonth() - 1, toDate.getDate());
    } else {
      fromDate.setMonth(fromDate.getMonth() - 1);
      toDate = new Date(fromDate.getFullYear(), fromDate.getMonth() + 1, fromDate.getDate());
    }
    
    $("#from").val(formatDate(fromDate));
    $("#to").val(formatDate(toDate));
  });

  function formatDate(date) {
    var year = date.getFullYear();
    var month = (date.getMonth() + 1).toString().padStart(2, '0');
    var day = date.getDate().toString().padStart(2, '0');
    
    return year + '-' + month + '-' + day;
  }
});


</script>

                <?php
                break; 


 case 'delblock':
    
  break;
  default:

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Profs</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>             
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Prof</button></a>
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
<th>Full Name</th>
<th>Phone</th>
<th>Centre</th>
<th>Status</th>
<th>Salary</th>
<th>Date</th>
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
    url:"ajaxm.php?detect=profs",
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
  default :
  header("location:index");
  break; 
  
}

                ?>

          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    <!-- Select Input Search -->
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

  <!-- Include Select2 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function() {
      $('select[name="reg_id"]').select2();
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
    
   <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
  </body>
</html>