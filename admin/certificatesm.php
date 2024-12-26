<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
       include("functions.php");
?>
<?php include("header.php"); 
if($postm!='user'){header("location:index");exit();}
?>
                <?php include("sidebar.php"); ?>
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
$lastid=$getCer->insert_certificate($reg_id,$cyear,$cdate,$mois,$niveau,$heures); 
           if($lastid>0)
    {
       $cno=$format.$lastid; 
  $result=$getCer->update_cno($cno,$lastid); 
if($result)
{
 header("Location:certificatesm?action=Added");  
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
    <label for="exampleInputEmail1">Nom d'utilisateur</label>
     <select name="reg_id" class="form-control" required>
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
                      <div class="col-sm-6">
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
$result=$getCer->update_certificate($reg_id,$cyear,$cdate,$mois,$niveau,$heures,$id); 

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
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id WHERE certificates.cid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
?>
          <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Username</label>
     <select name="reg_id" class="form-control" required>
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
                      <div class="col-sm-6">
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
    <label for="exampleInputEmail1">Date Certificate</label>
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
    <!-- /Select Input Search -->
    
    
   <script src="assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
  </body>
</html>