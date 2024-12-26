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
                <h3>Ajouter une certificate</h3>

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
                          $fid=$_POST['fid'];
                         $reg_id=$_POST['reg_id'];
                               $sql="
SELECT count(*)
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id 
LEFT JOIN groups ON inscription.gid=groups.gid 
LEFT JOIN formation ON groups.fid=formation.fid 
WHERE inscription.reg_id=:id AND groups.fid=:id2
";         
$countf=$getCredit->count_by_id_query_two_col($sql,$reg_id,$fid);
if($countf==0)
{
$error[]='Sorry, Invalid formation';
}
$sql="
SELECT count(*)
FROM certificates
WHERE reg_id=:id AND fid=:id2
";         
$countp=$getCredit->count_by_id_query_two_col($sql,$reg_id,$fid);

if($countp>0)
{
 $error[]='This certificate is already created.'; 
}

                          $count=$getCredit->count_by_id('registrations','reg_id',$reg_id);
                         if($count==0)
                         {
                          $error[]="This username is not found..";
                         }
                         else
                         {
                          $sql="SELECT * 
FROM registrations 
LEFT JOIN centres ON registrations.cent_id=centres.cent_id WHERE registrations.reg_id=:id";         
$rows=$getCredit->get_by_id_query($sql,$reg_id);
foreach($rows as $row)
{
  $city=$row['city']; 
  $format = substr($city, 0, 3);
}
                         }
                         $cyear=$_POST['cyear'];
                         $cdate=$_POST['cdate'];
                         $mois=$_POST['mois'];
                          $niveau=$_POST['niveau'];
                       if($niveau=='')
                       {
                        $niveau=NULL;
                       }
                          $heures=$_POST['heures'];
                       if($heures=='')
                       {
                        $heures=NULL;
                       }
         if(!isset($error)){ 
$lastid=$getCer->insert_certificate($reg_id,$cyear,$cdate,$mois,$niveau,$heures,$fid); 
           if($lastid>0)
    {
       $cno=$format.$lastid; 
  $result=$getCer->update_cno($cno,$lastid); 
if($result)
{
 header("Location:certificates?action=Added");  
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
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Nom d'utilisateur</label>
     <select name="reg_id" id="reg_id" class="form-control" required>
        <option value="">Sélectioner l'Utilisateur..</option>
        <?php $rows=$getCredit->fetch_all('registrations','reg_id','DESC'); 
 foreach($rows as $row)
 {
  echo '<option value="'.$row['reg_id'].'">'.$row['name'].' (CIN:'.$row['cin'].')</option>'; 
 }
        ?> 
     </select>
  </div>


                      </div>
                       <div class="col-sm-4">
                         <div class="form-group">
    <label for="exampleInputEmail1">Formation</label>
   <select name="fid" id="fid" class="form-control" required>
    <option value="">Select</option>
                  
        </select>
  </div>
                       </div>
                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Année du Certificate</label>
     <select name="cyear" class="form-control" required>
         <?php 
              $course_durations=$getCredit->get_option_value('year');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
                
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date du Certificate</label>
     <input type="date" name="cdate" class="form-control" required>

  </div>

                      </div>




                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Mois du Certificate</label>
     <select name="mois" class="form-control">
        <?php 
              $course_durations=$getCredit->get_option_value('mois');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
              
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Niveau</label>
     <input type="text" name="niveau" class="form-control">
  </div>
                      </div>
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Nombre d'Heures</label>
     <input type="text" name="heures" class="form-control">
  </div>
                      </div>
                        </div>
                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Certificate</button>
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
  $id=$_GET['id'];
  ?> 
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Modifier Certificate</h3>

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
 $fid=$_POST['fid']; 
  $sql="
SELECT count(*)
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id 
LEFT JOIN groups ON inscription.gid=groups.gid 
LEFT JOIN formation ON groups.fid=formation.fid 
WHERE inscription.reg_id=:id AND groups.fid=:id2
";                 
$countf=$getCredit->count_by_id_query_two_col($sql,$reg_id,$fid);
if($countf==0)
{
$error[]='Sorry, Invalid formation';
}
  $sql="SELECT * 
FROM certificates 
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id 
LEFT JOIN formation ON certificates.fid=formation.fid
WHERE certificates.cid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
  $dbreg_id=$row['reg_id'];  $dbfid=$row['fid'];
}
if($reg_id!=$dbreg_id OR $fid!=$dbfid)
{
  $sql="
SELECT count(*)
FROM certificates
WHERE reg_id=:id AND fid=:id2
";         
$countp=$getCredit->count_by_id_query_two_col($sql,$reg_id,$fid);
if($countp>0)
{
 $error[]='This certificate is already created.'; 
}

}
                         $cyear=$_POST['cyear'];
                         $cdate=$_POST['cdate'];
                         $mois=$_POST['mois'];
                          $niveau=$_POST['niveau'];
                       if($niveau=='')
                       {
                        $niveau=NULL;
                       }
                          $heures=$_POST['heures'];
                       if($heures=='')
                       {
                        $heures=NULL;
                       }
          
         if(!isset($error)){ 
$result=$getCer->update_certificate($reg_id,$cyear,$cdate,$mois,$niveau,$heures,$fid,$id); 

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
  $sql="SELECT * 
FROM certificates 
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id 
LEFT JOIN formation ON certificates.fid=formation.fid
WHERE certificates.cid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
?>
          <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Utilisateur</label>
     <select name="reg_id" id="reg_id" class="form-control" required>
        <option value="<?php echo $row['reg_id'];?>" style="background: #CBCDD1;"><?php echo $row['name'].'(CIN:'.$row['cin'].')';?></option>
        <?php $rows=$getCredit->fetch_all('registrations','reg_id','DESC'); 
 foreach($rows as $rowm)
 {
  echo '<option value="'.$rowm['reg_id'].'">'.$rowm['name'].'(CIN:'.$rowm['cin'].')</option>'; 
 }
        ?> 
     </select>
  </div>
     </div>
     <div class="col-sm-4">
                         <div class="form-group">
    <label for="exampleInputEmail1">Formation</label>
   <select name="fid" id="fid" class="form-control" required>
  <option value="<?php echo $row['fid'];?>" style="background: #CBCDD1;"><?php echo $row['formation_name'];?></option>
                  
        </select>
  </div>
                       </div>

                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Année du Certificate</label>
     <select name="cyear" class="form-control">
       <option value="<?php echo $row['cyear'];?>" style="background: #CBCDD1;"><?php echo $row['cyear'];?></option>

         <?php 
              $course_durations=$getCredit->get_option_value('year');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
                
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date du Certificate</label>
     <input type="date" name="cdate" value="<?php echo $row['cdate'];?>" class="form-control">

  </div>

                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Mois du Certificate</label>
     <select name="mois" class="form-control">
      <option value="<?php echo $row['mois'];?>" style="background: #CBCDD1;"><?php echo $row['mois'];?></option>
        <?php 
              $course_durations=$getCredit->get_option_value('mois');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
              
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Niveau</label>
     <input type="text" name="niveau" value="<?php echo $row['niveau'];?>" class="form-control">
  </div>
                      </div>
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Nombre d'Heures</label>
     <input type="text" name="heures" value="<?php echo $row['heures'];?>" class="form-control">
  </div>
                        </div>
                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Modifier Certificate</button>
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
  $res=$getCredit->delete_by_id('certificates','cid',$id);
     if($res)
     {
      header("Location:certificates?action=Deleted");
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
                <h3>Certificates</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

                    
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Certificate </button></a>
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
<th>CIN</th>
<th>Certificate Date</th>
<th>Formation</th>
<th>Year</th>
<th>Added By</th>
<th>Created</th>
<th>View</th>
<th>Download</th>
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
     <script type="text/javascript">
                   $(document).on('change', '#reg_id', function(){
                   var reg_id= $('select[name="reg_id"]').val();
                     if(reg_id.trim() == '' ) {          
    $(".alert-msg").show(); 
                        $("#statee").text('Select username');
                        $("#state").focus();  
                        alertMsg();
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=formation",
        data:{reg_id:reg_id},
        beforeSend: function() {
              // $("#msg").hide();
              // $("#loading-image").show();   
           },
        success: function(data){ 
            $("#fid").html(data);
    }});
}


});

                </script>
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
                <h3>Ajouter Certificate</h3>

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
                        $count=$getCredit->count_by_string_two_col('registrations','uid',$user_id,'reg_id',$reg_id);
                           if($count==0)
                           {
                           $error[]='Invalid username....'; 
                           }
                           else
                           {
                             $sql="SELECT * 
FROM registrations 
LEFT JOIN centres ON registrations.cent_id=centres.cent_id WHERE registrations.reg_id=:id";         
$rows=$getCredit->get_by_id_query($sql,$reg_id);
foreach($rows as $row)
{
  $city=$row['city']; 
  $format = substr($city, 0, 3);
}
                           }

                         $cyear=$_POST['cyear'];
                         $cdate=$_POST['cdate'];
                         $mois=$_POST['mois'];
                         $fid=$_POST['fid'];
                          $niveau=$_POST['niveau'];
                       if($niveau=='')
                       {
                        $niveau=NULL;
                       }
                          $heures=$_POST['heures'];
                       if($heures=='')
                       {
                        $heures=NULL;
                       }
         if(!isset($error)){ 
$lastid=$getCer->insert_certificate($reg_id,$cyear,$cdate,$mois,$niveau,$heures,$fid);  

           if($lastid>0)
    {
       $cno=$format.$lastid; 
  $result=$getCer->update_cno($cno,$lastid); 
if($result)
{
 header("Location:certificates?action=Added");  
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
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Nom d'utilisateur</label>
     <select  name="reg_id" id="reg_id" class="form-control" required>
        <option value="">Sélectioner l'Utilisateur.. </option>
        <?php $rows=$getCredit->get_by_id('registrations','uid',$user_id); 
 foreach($rows as $row)
 {
  echo '<option value="'.$row['reg_id'].'">'.$row['name'].'(CIN:'.$row['cin'].')</option>'; 
 }
        ?> 
     </select>
  </div>

                      </div>
                        <div class="col-sm-4">
                         <div class="form-group">
    <label for="exampleInputEmail1">Formation</label>
   <select name="fid" id="fid" class="form-control" required>
    <option value="">Select</option>         
        </select>
  </div>
                       </div>

                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Année du Certificate</label>
     <select name="cyear" class="form-control">
         <?php 
              $course_durations=$getCredit->get_option_value('year');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
                
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Certificate</label>
     <input type="date" name="cdate" class="form-control" required>

  </div>

                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Mois du Certificate</label>
     <select name="mois" class="form-control" required>
        <?php 
              $course_durations=$getCredit->get_option_value('mois');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
              
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Niveau</label>
     <input type="text" name="niveau" class="form-control">
  </div>
                      </div>
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Nombre d'Heures</label>
     <input type="text" name="heures" class="form-control">
  </div>
                        </div>
                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Certificate</button>
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
  $id=$_GET['id'];
$sql="SELECT count(*) as total
FROM certificates 
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id
LEFT JOIN formation ON certificates.fid=formation.fid
LEFT JOIN groups ON formation.fid=groups.fid
INNER JOIN centres ON registrations.cent_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND certificates.cid='$id';
";


    $count=$getCredit->count_by_query2($sql);

    //$count=$getCredit->count_by_string_two_col('certificates','cid',$id,'uid',$user_id);

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
                <h3>Modifier Certificate</h3>

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
                         $cyear=$_POST['cyear'];
                         $cdate=$_POST['cdate'];
                         $mois=$_POST['mois'];
                         $fid=$_POST['fid'];
                          $niveau=$_POST['niveau'];
                       if($niveau=='')
                       {
                        $niveau=NULL;
                       }
                          $heures=$_POST['heures'];
                       if($heures=='')
                       {
                        $heures=NULL;
                       }
          
         if(!isset($error)){ 
$result=$getCer->update_certificate($reg_id,$cyear,$cdate,$mois,$niveau,$heures,$fid,$id); 

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
  $sql="SELECT * 
FROM certificates 
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id 
LEFT JOIN formation ON certificates.fid=formation.fid
WHERE certificates.cid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
?>
          <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Utilisateur</label>
     <select name="reg_id" id="reg_id" class="form-control" required>
        <option value="<?php echo $row['reg_id'];?>" style="background: #CBCDD1;"><?php echo $row['name'].'(CIN:'.$row['cin'].')';?></option>
        <?php $rows=$getCredit->get_by_id('registrations','uid',$user_id); 
 foreach($rows as $rowm)
 {
  echo '<option value="'.$rowm['reg_id'].'">'.$rowm['name'].'(CIN:'.$rowm['cin'].')</option>'; 
 }
        ?> 
     </select>
  </div>
     </div>
     <div class="col-sm-4">
                         <div class="form-group">
    <label for="exampleInputEmail1">Formation</label>
   <select name="fid" id="fid" class="form-control" required>
  <option value="<?php echo $row['fid'];?>" style="background: #CBCDD1;"><?php echo $row['formation_name'];?></option>
                  
        </select>
  </div>
                       </div>

                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Année du Certificate</label>
     <select name="cyear" class="form-control">
       <option value="<?php echo $row['cyear'];?>" style="background: #CBCDD1;"><?php echo $row['cyear'];?></option>

         <?php 
              $course_durations=$getCredit->get_option_value('year');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
                
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date du Certificate</label>
     <input type="date" name="cdate" value="<?php echo $row['cdate'];?>" class="form-control">

  </div>

                      </div>
                      <div class="col-sm-6">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Mois du Certificate</label>
     <select name="mois" class="form-control">
      <option value="<?php echo $row['mois'];?>" style="background: #CBCDD1;"><?php echo $row['mois'];?></option>
        <?php 
              $course_durations=$getCredit->get_option_value('mois');
              $arrs=explode(',',$course_durations); 
              foreach($arrs as $arr)
              {
              echo '<option value="'.$arr.'">'.$arr.'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
              
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Niveau</label>
     <input type="text" name="niveau" value="<?php echo $row['niveau'];?>" class="form-control">
  </div>
                      </div>
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Nombre d'Heures</label>
     <input type="text" name="heures" value="<?php echo $row['heures'];?>" class="form-control">
  </div>
                        </div>
                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Modifier Certificate</button>
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
  break;
  default:

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Certificates</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

                    
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Certificate </button></a>
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
<th>Username</th>
<th>CIN</th>
<th>Certificate Date</th>
<th>Formation</th>
<th>Year</th>
<th>Created</th>
<th>View</th>
<th>Download</th>
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
    url:"ajaxm.php?detect=certificates",
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
  <script type="text/javascript">
                   $(document).on('change', '#reg_id', function(){
                   var reg_id= $('select[name="reg_id"]').val();
                     if(reg_id.trim() == '' ) {          
    $(".alert-msg").show(); 
                        $("#statee").text('Select username');
                        $("#state").focus();  
                        alertMsg();
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=formation",
        data:{reg_id:reg_id},
        beforeSend: function() {
              // $("#msg").hide();
              // $("#loading-image").show();   
           },
        success: function(data){ 
            $("#fid").html(data);
    }});
}


});

                </script>
                
    <!-- /Select Input Search -->
    

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
                <h3>Certificates</h3>
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
<th>CIN</th>
<th>Certificate Date</th>
<th>Formation</th>
<th>Year</th>
<th>Added By</th>
<th>Created</th>
<th>View</th>
<th>Download</th>
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
    url:"ajaxy.php?detect=certificates",
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
     <script type="text/javascript">
                   $(document).on('change', '#reg_id', function(){
                   var reg_id= $('select[name="reg_id"]').val();
                     if(reg_id.trim() == '' ) {          
    $(".alert-msg").show(); 
                        $("#statee").text('Select username');
                        $("#state").focus();  
                        alertMsg();
            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=formation",
        data:{reg_id:reg_id},
        beforeSend: function() {
              // $("#msg").hide();
              // $("#loading-image").show();   
           },
        success: function(data){ 
            $("#fid").html(data);
    }});
}


});

                </script>
                 <?php
                 break; 
                 default:
                 //header("location:index");
                 break; 
                }
                ?>


   <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
  </body>
</html>