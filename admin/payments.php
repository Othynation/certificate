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
                <h3>Payment Inscription</h3>

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
                         $reg_id=$_POST['reg_id'];
$gid= trim($_POST['gid']);
$deposit= trim($_POST['deposit']);
$paydate= trim($_POST['paydate']);
if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $deposit)) {
    $error[]="Invalid deposit amount. Please enter a valid number.";  
}
         if(!isset($error)){ 
$lastid=$getCer->insert_payment($reg_id,$gid,$deposit,$paydate,$user_id);
           if($lastid>0)
    {
       $cno=$format.$lastid; 
  $result=$getCer->update_cno($cno,$lastid); 
if($result)
{
 header("Location:?action=Added");  
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
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
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Full Name</label>
     <select name="reg_id" id="reg_id" class="form-control" required>
        <option value="">Sélectioner l'Utilisateur..</option>
        <?php
$sql="
SELECT DISTINCT r.name, r.reg_id,r.cin
FROM inscription i
LEFT JOIN registrations r ON i.reg_id = r.reg_id
ORDER BY i.inid DESC; 
";        
$rows=$getCredit->get_by_query($sql);
foreach($rows as $row)
 {
  echo '<option value="'.$row['reg_id'].'">'.$row['name'].' (CIN:'.$row['cin'].')</option>'; 
 }
        ?> 
     </select>
  </div>
 </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Group</label>
     <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 

//              $sql="
// SELECT DISTINCT r.gname, r.gid
// FROM inscription i
// LEFT JOIN groups r ON i.gid = r.gid
// ORDER BY r.gname ASC; 
// ";        
// $rg=$getCredit->get_by_query($sql);

//               foreach($rg as $arr)
//               {
//               echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
//               }
              ?>
     </select>
  </div>

                      </div>
                    </div>

                      <div id="amarea">  </div>
                      
                  <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Add Deposit</label>
     <input type="number" name="deposit" class="form-control" required>
  </div>
                      </div>
                      
                     
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date</label>
     <input type="date" name="paydate" value="<?php echo date("Y-m-d"); ?>" class="form-control" required>
  </div>
                      </div>
                      
                    
                        </div>
                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Payment</button>
                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 
  
 

  </form>
              
                    </div>
                </div> 
                <script type="text/javascript">
                    $(document).on('change', '#reg_id', function(){
                         $("#gid").val("");
                    });
                           $(document).on('change', '#gid', function(){
  var gid= $('#gid').val();
  var reg_id= $('#reg_id').val();
  if(gid.trim() == '' ) {          
   alert('Please select a group'); 

            return false;
        }
        else if(reg_id.trim() == '')
        {
          $("#gid").val("");

           alert('Please first select full name'); 
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=payment",      
data: {gid: gid, reg_id: reg_id},
        beforeSend: function() {
           $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");
           },
        success: function(data){ 
            //alert(data);
            $("#amarea").html(data);
    }});
}
 });
     $(document).on('change', '#reg_id', function(){
  var reg_id= $('#reg_id').val();
  if(reg_id.trim() == '' ) {          
   alert('Please select a username'); 

            return false;
        }
        else if(reg_id.trim() == '')
        {
          $("#gid").val("");

           alert('Please first select full name'); 
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=groupbyreg",      
data: {reg_id: reg_id},
        beforeSend: function() {
           $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");
           },
        success: function(data){ 
            //alert(data);
            $("#gid").html(data);
             $("#amarea").html("");
    }});
}
 });



                </script>
  <?php 
  break; 
  case 'edit':
  $id=$_GET['id'];
  ?> 
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Edit Payment</h3>

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
$paydate= trim($_POST['paydate']);
$deposit= trim($_POST['deposit']);
if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $deposit)) {
    $error[]="Invalid deposit amount. Please enter a valid number.";
   
}

         if(!isset($error)){ 
$result=$getCer->update_payment($paydate,$deposit,$id);

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
  $sql="
SELECT * 
FROM payments
LEFT JOIN registrations ON payments.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON payments.uid=ts_gtw_users.id
LEFT JOIN groups ON payments.gid=groups.gid
WHERE payments.pay_id=:id";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
?>
          <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Utilisateur</label>
     <select name="reg_id" class="form-control" disabled>
        <option value="<?php echo $row['reg_id'];?>" style="background: #CBCDD1;"><?php echo $row['name'].'(CIN:'.$row['cin'].')';?></option>
       
     </select>
  </div>

                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Group</label>
     <select name="gid" class="form-control" disabled>
      <option value="<?php echo $row['gid'];?>" style="background: #CBCDD1;"><?php echo $row['gname'];?></option>
     </select>
  </div>

                      </div>
                      <?php 
   $gid=$row['gid'];  $reg_id=$row['reg_id'];
    $count=$getCredit->count_by_string_two_col('inscription','gid',$gid,'reg_id',$reg_id);
    if($count==0)
    {
   'No record found'; 
    }
    else 
    {
       $rowsk=$getCredit->get_by_string_two_col('inscription','gid',$gid,'reg_id',$reg_id);
       foreach($rowsk as $rowk)
       {
         $servicefees=$rowk['inservicefees'];  $infees=$rowk['infees'];
         $total=$servicefees+$infees;
       }
         $total_deposit=$getCredit->getsumdeposite($gid,$reg_id);

         $payamount=$total-$total_deposit;
         ?>
       
           <div class="col-sm-2"></div>
          <div class="col-sm-8" style="background:#ffffb6;border-radius: 10px;border-left: 2px solid #008000;color: #000;">
                        <div class="form-group">          
    <h3>Total Deposits: <strong><?php echo $total_deposit; ?> <?php echo $getCredit->get_option_value('currency');?></strong></h3>
     <h3>Service Fees + Inscription Fees: <strong><?php echo $total; ?> <?php echo $getCredit->get_option_value('currency');?></strong></h3>
     <h3>Left to pay: <strong><?php echo $payamount; ?> <?php echo $getCredit->get_option_value('currency');?></strong></h3>
   
  </div>
                      </div>
                       <div class="col-sm-2"></div>
                  
                  



         <?php 
    }
    ?>

                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Deposit</label>
     <input type="number" name="deposit" value="<?php echo $row['deposit'];?>" class="form-control" required>
  </div>
                      </div>
                      
                     
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date</label>
     <input type="date" name="paydate" value="<?php echo $row['paydate']; ?>" class="form-control" required>
  </div>
                      </div>
                      
                    
                     

                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Modifier Payment</button>
                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 
  
 

  </form>
<?php } ?>
              
                    </div>
                </div>
  <?php 
  break; 
  case 'del': 
  $id=$_GET['id'];
  $res=$getCredit->delete_by_id('payments','pay_id',$id);
     if($res)
     {
      header("Location:?action=Deleted");
     }
     else 
     {
      echo 'Something went wrong.....';
     }
  break;
  default:
  if(isset($_GET['inid']))
  {
  $id=$_GET['inid'];   
}
else 
{
$id='';
}
$countin=$getCredit->count_by_id('inscription','inid',$id);

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Payment Inscription</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>
            <?php 
            if($countin>0)
            {
               $sql="SELECT * 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE inscription.inid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
}
              ?>
              <div class="row">
                      <div class="col-sm-4"> </div>
                       <div class="col-sm-4" > <h2 style=" color: #000;
    padding: 10px;
    background: #dcfff3;
    border: 1px solid green; border-radius:5px;">Payments of <strong><?php echo $row['name'];?></strong></h2></div>
                   <div class="col-sm-4"> </div>
                        </div>

              <?php 

            }

            ?>

                    
 <a href="?detect=add"><button class="btn btn-success" >Add Payment</button></a>
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
      <th>Group Name</th>
      <th>Deposit</th>
      <th>Payment Date</th>
<th>Added By</th>
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
    url:"ajax.php?detect=payments",
    type:"POST",
    <?php if($countin>0){?>
    data:{is_type:is_type,inid:<?php echo $id;?>}
  <?php } else {?> 
       data:{is_type:is_type}
     <?php } ?>
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
                <h3>Ajouter une inscription</h3>

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
                         $reg_id=$_POST['reg_id'];
$gid= trim($_POST['gid']);
$deposit= trim($_POST['deposit']);
$paydate= trim($_POST['paydate']);
if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $deposit)) {
    $error[]="Invalid deposit amount. Please enter a valid number.";
   
}

 $count=$getCredit->count_by_string_two_col('registrations','reg_id',$reg_id,'uid',$user_id);
                         if($count==0)
                         {
                          $error[]="This username is not found..";
                         }

                         $gid = trim($_POST['gid']);
           $countg=$getCredit->count_by_string_two_col('groups','gid',$gid,'uid',$user_id);
                         if($countg==0)
                         {
                          $error[]="Sorry , Invalid group.";
                         }



         if(!isset($error)){ 
$lastid=$getCer->insert_payment($reg_id,$gid,$deposit,$paydate,$user_id);
           if($lastid>0)
    {
       $cno=$format.$lastid; 
  $result=$getCer->update_cno($cno,$lastid); 
if($result)
{
 header("Location:?action=Added");  
}
else 
{
  $error[] ='Failed : Something went wrong'; 
}
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
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Full Name</label>
     <select name="reg_id" id="reg_id" class="form-control" required>
        <option value="">Sélectioner l'Utilisateur..</option>
        <?php
$sql="
SELECT DISTINCT r.name, r.reg_id,r.cin
FROM inscription i
LEFT JOIN registrations r ON i.reg_id = r.reg_id
LEFT JOIN groups g ON i.gid=g.gid
INNER JOIN centres c ON g.cnt_id=c.cent_id
INNER JOIN links l ON c.cent_id=l.cent_id
 WHERE l.id='$user_id';
";        
$rows=$getCredit->get_by_query($sql);
foreach($rows as $row)
 {
  echo '<option value="'.$row['reg_id'].'">'.$row['name'].' (CIN:'.$row['cin'].')</option>'; 
 }
        ?> 
     </select>
  </div>
 </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Group</label>
     <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 

             $sql="
SELECT DISTINCT r.gname, r.gid
FROM inscription i
LEFT JOIN groups r ON i.gid = r.gid
INNER JOIN centres c ON g.cnt_id=c.cent_id
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
  </div>

                      </div>
                    </div>

                      <div id="amarea">  </div>
                      
                  <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Add Deposit</label>
     <input type="number" name="deposit" class="form-control" required>
  </div>
                      </div>
                      
                     
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date</label>
     <input type="date" name="paydate" value="<?php echo date("Y-m-d"); ?>" class="form-control" required>
  </div>
                      </div>
                      
                    
                        </div>
                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Payment</button>
                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 
  
 

  </form>
              
                    </div>
                </div> 
                <script type="text/javascript">
                    $(document).on('change', '#reg_id', function(){
                         $("#gid").val("");
                    });
                           $(document).on('change', '#gid', function(){
  var gid= $('#gid').val();
  var reg_id= $('#reg_id').val();
  if(gid.trim() == '' ) {          
   alert('Please select a group'); 

            return false;
        }
        else if(reg_id.trim() == '')
        {
          $("#gid").val("");

           alert('Please first select full name'); 
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=payment",      
data: {gid: gid, reg_id: reg_id},
        beforeSend: function() {
           $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");
           },
        success: function(data){ 
            //alert(data);
            $("#amarea").html(data);
    }});
}
 });

 $(document).on('change', '#reg_id', function(){
  var reg_id= $('#reg_id').val();
  if(reg_id.trim() == '' ) {          
   alert('Please select a username'); 

            return false;
        }
        else if(reg_id.trim() == '')
        {
          $("#gid").val("");

           alert('Please first select full name'); 
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=groupbyreg",      
data: {reg_id: reg_id},
        beforeSend: function() {
           $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");
           },
        success: function(data){ 
            //alert(data);
            $("#gid").html(data);
             $("#amarea").html("");
    }});
}
 });

                </script>
  <?php 
  break; 
  case 'edit':
  $id=$_GET['id'];
$sql="SELECT count(*) as total
FROM payments
LEFT JOIN registrations ON payments.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON payments.uid=ts_gtw_users.id
LEFT JOIN groups ON payments.gid=groups.gid
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND payments.pay_id='$id';
";
$count=$getCredit->count_by_query2($sql);

    //$count=$getCredit->count_by_string_two_col('payments','pay_id',$id,'uid',$user_id);
  if($count==0)
  {
    header("location:index");
    exit();
  }
  
  ?> 
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Edit Payment</h3>

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
$paydate= trim($_POST['paydate']);
$deposit= trim($_POST['deposit']);
if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $deposit)) {
    $error[]="Invalid deposit amount. Please enter a valid number.";
   
}

         if(!isset($error)){ 
$result=$getCer->update_payment($paydate,$deposit,$id);

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
  $sql="
SELECT * 
FROM payments
LEFT JOIN registrations ON payments.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON payments.uid=ts_gtw_users.id
LEFT JOIN groups ON payments.gid=groups.gid
WHERE payments.pay_id=:id";

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
?>
          <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Utilisateur</label>
     <select name="reg_id" class="form-control" disabled>
        <option value="<?php echo $row['reg_id'];?>" style="background: #CBCDD1;"><?php echo $row['name'].'(CIN:'.$row['cin'].')';?></option>
       
     </select>
  </div>

                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Group</label>
     <select name="gid" class="form-control" disabled>
      <option value="<?php echo $row['gid'];?>" style="background: #CBCDD1;"><?php echo $row['gname'];?></option>
     </select>
  </div>

                      </div>
                      <?php 
   $gid=$row['gid'];  $reg_id=$row['reg_id'];
    $count=$getCredit->count_by_string_two_col('inscription','gid',$gid,'reg_id',$reg_id);
    if($count==0)
    {
   'No record found'; 
    }
    else 
    {
       $rowsk=$getCredit->get_by_string_two_col('inscription','gid',$gid,'reg_id',$reg_id);
       foreach($rowsk as $rowk)
       {
         $servicefees=$rowk['inservicefees'];  $infees=$rowk['infees'];
         $total=$servicefees+$infees;
       }
         $total_deposit=$getCredit->getsumdeposite($gid,$reg_id);

         $payamount=$total-$total_deposit;
         ?>
       
           <div class="col-sm-2"></div>
          <div class="col-sm-8" style="background:#ffffb6;border-radius: 10px;border-left: 2px solid #008000;color: #000;">
                        <div class="form-group">          
    <h3>Total Deposits: <strong><?php echo $total_deposit; ?> <?php echo $getCredit->get_option_value('currency');?></strong></h3>
     <h3>Service Fees + Inscription Fees: <strong><?php echo $total; ?> <?php echo $getCredit->get_option_value('currency');?></strong></h3>
     <h3>Left to pay: <strong><?php echo $payamount; ?> <?php echo $getCredit->get_option_value('currency');?></strong></h3>
   
  </div>
                      </div>
                       <div class="col-sm-2"></div>
                  
                  



         <?php 
    }
    ?>

                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Deposit</label>
     <input type="number" name="deposit" value="<?php echo $row['deposit'];?>" class="form-control" required>
  </div>
                      </div>
                      
                     
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date</label>
     <input type="date" name="paydate" value="<?php echo $row['paydate']; ?>" class="form-control" required>
  </div>
                      </div>
                      
                    
                     

                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Modifier Payment</button>
                       </div>
                        <div class="col-sm-4">
                       </div>


                    </div>
            
                    </div>
                     <div class="col-md-3"> 
  
 

  </form>
<?php } ?>
              
                    </div>
                </div>
  <?php 
  break; 
  case 'delblock': 
  // $id=$_GET['id'];
  // $res=$getCredit->delete_by_id('payments','pay_id',$id);
  //    if($res)
  //    {
  //     header("Location:?action=Deleted");
  //    }
  //    else 
  //    {
  //     echo 'Something went wrong.....';
  //    }
  break;
  default:
if(isset($_GET['inid']))
  {
  $id=$_GET['inid'];   
   $sql="SELECT count(*) as total 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON inscription.uid=ts_gtw_users.id
LEFT JOIN groups ON inscription.gid=groups.gid 
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND inscription.inid='$id'";
$count=$getCredit->count_by_query2($sql); 
  //$count=$getCredit->count_by_string_two_col('inscription','inid',$id,'uid',$user_id);
  if($count==0)
  {
    header("location:index");
    exit();
  }
}
else 
{
$id='';
}


  $countin=$getCredit->count_by_id('inscription','inid',$id);

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Payment Inscription</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>
 <?php 
            if($countin>0)
            {
               $sql="SELECT * 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
 WHERE inscription.inid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
}
              ?>
              <div class="row">
                      <div class="col-sm-4"> </div>
                       <div class="col-sm-4" > <h2 style=" color: #000;
    padding: 10px;
    background: #dcfff3;
    border: 1px solid green; border-radius:5px;">Payments of <strong><?php echo $row['name'];?></strong></h2></div>
                   <div class="col-sm-4"> </div>
                        </div>

              <?php 

            }

            ?>

                    
 <a href="?detect=add"><button class="btn btn-success" >Add Payment</button></a>
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
      <th>Group Name</th>
      <th>Deposit</th>
      <th>Payment Date</th>
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
    url:"ajaxm.php?detect=payments",
    type:"POST",
   <?php if($countin>0){?>
    data:{is_type:is_type,inid:<?php echo $id;?>}
  <?php } else {?> 
       data:{is_type:is_type}
     <?php } ?>
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
    <div class="page-title">
              <div class="title_left">
                <h3>Payment Inscription</h3>
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
 <th>Full Name</th>
      <th>Group Name</th>
      <th>Deposit</th>
      <th>Payment Date</th>
<th>Added By</th>
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
    url:"ajaxy.php?detect=payments",
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