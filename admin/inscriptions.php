<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
       include("functions.php");
?>
<?php include("header.php"); 
//if($postm!='admin'){header("location:index");exit();}
?>

<style type="text/css">
table td:nth-child(1) {
width: 30%;
}
table td:nth-child(2) {
width: 30%;
}
table td:nth-child(3) {
width: 30%;
}
table td:nth-child(4) {
width: 30%;
}
.fixed-right {
  position: fixed;
  right: 20px;
  bottom: 20px;
}             

table tr td, table tr th {
  padding: 10px; /* Add 10px padding to all sides */
  color:#000;
}

@media print {
    .nav_menu {
      display: none;
    }
    #printbtn
    {
       display: none;
    }
    #backbtn
    {
      display: none;
    }
  }





</style>

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
                          $count=$getCredit->count_by_id('registrations','reg_id',$reg_id);
                         if($count==0)
                         {
                          $error[]="This username is not found..";
                         }

                         $gid = trim($_POST['gid']);
           $countg=$getCredit->count_by_id('groups','gid',$gid);
                         if($countg==0)
                         {
                          $error[]="Sorry , Invalid group.";
                         }

$instatus = trim($_POST['instatus']);
$indeposit = trim($_POST['indeposite']);
$infees = trim($_POST['infees']);
// $intotal = trim($_POST['intotal']);
$indate = trim($_POST['indate']);
$indedeut = trim($_POST['indedeut']);
//$intime = trim($_POST['intime']);
     $intime=$getDatabase->get_hour();
$inreceived = trim($_POST['inreceived']);

         if(!isset($error)){ 
$lastid=$getCer->insert_inscription($reg_id, $gid, $instatus, $indeposit, $infees, $indate, $indedeut, $intime, $inreceived);
           if($lastid>0)
    {
       $cno=$format.$lastid; 
  $result=$getCer->update_cno($cno,$lastid); 
if($result)
{
 header("Location:inscriptions?action=Added");  
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
     <select name="reg_id" class="form-control" required>
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
    <label for="exampleInputEmail1">Group</label>
     <select name="gid" class="form-control" required>
       <option value="">Select</option>
         <?php 
              $rg=$getCredit->fetch_all('groups','gname','ASC');

              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].' -'.$getCredit->get_sch($arr['gid']).'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
     <select name="instatus" class="form-control" required>
      <option value="">Select Status</option>
       <option value="2">New</option>
        <option value="1">Active</option>
         <option value="0">Termine</option>
         
     </select>
  </div>

                      </div>
                       <div class="col-sm-2"></div>
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Service Fees</label>
     <input type="number" name="indeposite" class="form-control" required>
  </div>
                      </div>
                        <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Fees Inscription</label>
     <input type="number" name="infees" class="form-control" required>
  </div>
                      </div>
                        <div class="col-sm-2"></div>
                     
                       <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Inscription</label>
     <input type="date" name="indate" class="form-control" required>
  </div>
                      </div>
                       <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Debut Formation</label>
     <input type="date" name="indedeut" class="form-control" required>
  </div>
                      </div>
                       <div class="col-sm-2">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Time Inscription</label>
     <select name="intime" class="form-control" required>
<option value="<?php echo $getDatabase->get_hour();?>"><?php echo $getDatabase->get_hour();?></option>
</select>

  </div>
                      </div>

                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Certificate Received</label>
     <select name="inreceived" class="form-control">
     <option value="0">No</option>
      <option value="1">Yes</option>
     </select>
  </div>

                      </div>
                        </div>
                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Inscription</button>
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
                <h3>Edit Inscription</h3>

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
                          $count=$getCredit->count_by_id('registrations','reg_id',$reg_id);
                         if($count==0)
                         {
                          $error[]="This username is not found..";
                         }
                         $gid = trim($_POST['gid']);
                         $countg=$getCredit->count_by_id('groups','gid',$gid);
                         if($countg==0)
                         {
                          $error[]="Sorry , Invalid group.";
                         }

$instatus = trim($_POST['instatus']);
$indeposit = trim($_POST['indeposite']);
$infees = trim($_POST['infees']);
//$intotal = trim($_POST['intotal']);
$indate = trim($_POST['indate']);
$indedeut = trim($_POST['indedeut']);
$rows=$getCredit->get_by_id('inscription','inid',$id);
foreach($rows as $row)
{
 $intime=$row['intime'] ;
}
$inreceived = trim($_POST['inreceived']);
     
         if(!isset($error)){ 
$result=$getCer->update_inscription($reg_id, $gid, $instatus, $indeposit, $infees, $indate, $indedeut, $intime, $inreceived, $id);

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
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN groups ON inscription.gid=groups.gid
 WHERE inscription.inid=:id
";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
?>
          <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Utilisateur</label>
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

                      </div><div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Group</label>
     <select name="gid" class="form-control" required>
      <option value="<?php echo $row['gid'];?>" style="background: #CBCDD1;"><?php echo $row['gname'] .' -'.$getCredit->get_sch($row['gid']);?></option>

         <?php 
              $rg=$getCredit->fetch_all('groups','gname','ASC');
              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].' -'.$getCredit->get_sch($arr['gid']).'</option>';  
              }
              ?>

     </select>
  </div>

                      </div>
                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
     <select name="instatus" class="form-control" required>
       <option value="<?php echo $row['instatus'];?>" style="background: #CBCDD1;"><?php echo $getCredit->status2($row['instatus']);?></option>
       <option value="2">New</option>
        <option value="1">Active</option>
         <option value="0">Termine</option>
         
     </select>
  </div>

                      </div>
                       <div class="col-sm-2"></div>
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Service Fees</label>
     <input type="number" name="indeposite" value="<?php echo $row['inservicefees'];?>" class="form-control" required>
  </div>
                      </div>
                        <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Fees Inscription</label>
     <input type="number" name="infees" value="<?php echo $row['infees'];?>" class="form-control" required>
  </div>
                      </div>
                       <div class="col-sm-2"></div>

                       <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Inscription</label>
     <input type="date" name="indate"  value="<?php echo $row['indate'];?>" class="form-control" required>
  </div>
                      </div>
                       <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Debut Formation</label>
     <input type="date" name="indedeut"  value="<?php echo $row['indedate_debut'];?>" class="form-control" required>
  </div>
                      </div>
                       <div class="col-sm-2">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Time Inscription</label>
     <input type="text" name="intime"  value="<?php echo $row['intime'];?>" class="form-control" required disabled>
  </div>
                      </div>

                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Certificate Received</label>
     <select name="inreceived" class="form-control">
       <option value="<?php echo $row['inreceived'];?>" style="background: #CBCDD1;"><?php echo $getCredit->status3($row['inreceived']);?></option>
     <option value="0">No</option>
      <option value="1">Yes</option>
     </select>
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

  case 'view':
  $id=$_GET['id'];
  ?> 
  
<?php 
  $sql="
SELECT * 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id 
LEFT JOIN groups ON inscription.gid=groups.gid
LEFT JOIN formation ON groups.fid=formation.fid
WHERE inscription.inid=:id
";        

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
  $rowsk=$getCredit->get_by_string_two_col('inscription','gid',$row['gid'],'reg_id',$row['reg_id']);
       foreach($rowsk as $rowk)
       {
         $servicefees=$rowk['inservicefees'];  $infees=$rowk['infees'];
         $total=$servicefees+$infees;
       }
         $total_deposit=$getCredit->getsumdeposite($row['gid'],$row['reg_id']);

         $payamount=$total-$total_deposit;

?>

  <div class="row">
      <div class="col-md-3" style="background:#f6fcff; border-radius: 15px;color: #000;">
    
  <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">  
                         <table style="border: 0px;" cellpadding="10">
                          <tr>
                            <td><div style="height: 152px; width: 152px;">
      <center>
    <?php 
    if($row['image']!='')
    {
      echo '<img id="output"  width="150" height="150" / src="assets/profile/'.$row['image'].'" style="border-radius:15px;">';
    }
    else 
    {
      echo ' <img id="output"  width="150" height="150" / src="assets/icon/avatar.png">';
    }
    ?>
  </center>
     </div>
      <center>
     <h6><?php echo $row['name']; ?></h6>
   
      <div style="font-size: 10px;color: #9e9c9c;"><u>Contact Information: </u></div>
    </center>
    
  </td>
                          </tr>
                         </table> 
                      

   
   
    <table style="border: 0px;" cellpadding="10">
  <tr><td>CIN</td> <td>:</td><td><?php echo $row['cin']?></td></tr>
  <tr>
    <td>TEL</td>
    <td>:</td>
    <td><?php echo $row['mobile']?></td>
</tr>

<tr>
    <td>Birth Date</td>
    <td>:</td>
    <td><?php echo $getDatabase->easy_date2($row['dob'])?></td>
</tr>
<tr>
    <td>Birth Place</td>
    <td>:</td>
    <td><?php echo $row['bplace']?></td>
</tr>

    </table>
  </div>
</div>
</div>

      </div>
                    
                    <div class="col-md-9">
<div class="row">
    <div class="col-sm-8">
  <div class="page-title">
              <div class="title_left">
                <h3>Inscription Details</h3> 

              </div>

            </div>
          </div>
          <div class="col-sm-4" style="text-align: right;">
               <a href="?detect=fiche&inid=<?php echo $row['inid'];?>"name="subpost" class="btn btn-secondary" style="background: #000;"><i class="fa fa-print"></i> Print Fiche</a>
          </div>

        </div>

          <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                       <div class="col-sm-6">

                        <div class="form-group">          
    <label for="exampleInputEmail1">Formation</label>
     <input type="text" name="indeposite" value="<?php echo $row['formation_name'];?>" class="form-control" disabled>
  </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Group</label>
     <input type="text" name="indeposite" value="<?php echo $row['gname'];?>" class="form-control" disabled>
  </div>
                      </div> 
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Inscription</label>
     <input type="text" name="indate"  value="<?php echo $getDatabase->easy_date2($row['indate']);?>" class="form-control" disabled>
  </div>
                      </div>      
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
     <input type="text" name="indate"  value="<?php echo $getCredit->status_hr($row['instatus']);?>" class="form-control" disabled>
  </div>
                      </div>      
<div class="col-sm-6">
                     
                        <div class="form-group">          
    <label for="exampleInputEmail1">Service Fees + Inscription Fees</label>
     <input type="text" name="intotal" value="<?php echo $total;?> <?php echo $getCredit->get_option_value("currency"); ?>" class="form-control" disabled>
  </div>
                      </div>     


                      <div class="col-sm-6">
                     
                        <div class="form-group">          
    <label for="exampleInputEmail1">Total Deposits</label>
     <input type="text" name="intotal" value="<?php echo $total_deposit;?> <?php echo $getCredit->get_option_value("currency"); ?>" class="form-control" disabled>
  </div>
                      </div>     
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Total to Pay</label>
     <input type="text" name="intotal" value="<?php echo $payamount;?> <?php echo $getCredit->get_option_value("currency"); ?>" class="form-control" disabled>
  </div>
                      </div>     
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Total Presence</label>
     <input type="text" name="intotal" value="<?php echo $getCredit->get_presense($row["reg_id"]);?>" class="form-control" disabled>
  </div>
                      </div>     

        
                    
                         <div class="col-sm-3">
                          <a href="?detect=comments&id=<?php echo $row['inid'];?>"name="subpost" class="btn btn-info btn-lg"><i class="fa fa-comment"></i> Comments</a>
                       </div>
                        <div class="col-sm-3">
                          <a href="payments?inid=<?php echo $row['inid'];?>"name="subpost" class="btn btn-secondary btn-lg"><i class="fa fa-money"></i> Payments</a>
                       </div>

                        <div class="col-sm-3">
 <a href="?detect=edit&id=<?php echo $row['inid'];?>"name="subpost" class="btn plan-button btn-lg">Edit Inscription</a>
                       </div>
                        <div class="col-sm-3">
                           <a href="?detect=print&id=<?php echo $row['inid'];?>"name="subpost" class="btn btn-warning btn-lg"><i class="fa fa-print"></i> Print Notes</a>
 
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
                case 'fiche':
                $id=$_GET['inid'];
                 $sql="
SELECT * 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN groups ON inscription.gid=groups.gid
LEFT JOIN formation ON groups.fid=formation.fid
 WHERE inscription.inid=:id
";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{}
                ?>


              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"> <br> <br></div>

               </div>
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">N° D'inscription: :</span> <?php echo $rowk['inid'];?></h4></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">N° Du Stagiaire :</span> <?php echo $rowk['reg_id'];?></h4></td>
                  <td style="width:10%;"></td>
                </tr>
              </table>
              <div class="row">
                <div class="col-sm-3"></div>
    <div class="col-sm-6" style="text-align:center;">
  <div class="page-title">
<h1 style="color: #000;font-weight: 400;border-bottom: 1px solid black;padding-bottom: 10px;margin-bottom: 20px;">FICHE D'INSCRIPTION</h1>
 <div class="col-sm-3"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-sm-12">
            <table>
              <tr>
                <td style="width:400px;"></td>
                 <td style="width:500px;"><table style="width: 100%;">
  <tr>
    <td>Nom</td>
    <td><?php echo $row['name'];?></td>
  </tr>
  
  <tr>
    <td>Téléphone</td>
    <td><?php echo $row['mobile'];?></td>
  </tr>
  <tr>
    <td>CIN</td>
    <td><?php echo $row['cin'];?></td>
  </tr>
  <tr>
    <td>Date Naissance</td>
    <td><?php echo $getDatabase->easy_date2($row['dob']);?></td>
  </tr>
  <tr>
    <td>Adresse</td>
    <td><?php echo $row['address'];?></td>
  </tr>
  <tr>
    <td>Groupe</td>
    <td><?php echo $row['gname'].' '. $getCredit->get_sch($row["gid"]);?></td>
  </tr>
  <tr>
    <td>Formation</td>
    <td><?php echo $row['formation_name'];?></td>
  </tr>
  <tr>
    <td>Date Inscription</td>
    <td><?php echo $getDatabase->easy_date2($row['indate']);?></td>
  </tr>

</table>
            </td>
                  <td style="width:300px;"></td>
              </tr>
            </table>
            <table style="width:100%; margin-top: 40px;">
              <tr>
                <td style="width:100px;"></td>
                 <td style="width:1000px;"> <p style="font-weight:700px;font-size: 16px;text-decoration: underline;">La formation choisie n'est ni échangée ni remboursée au délai de 48 heures
contact@atlantique.ma www.atlantique.ma</p>
</td>

              </tr>
            </table>
               <table style="width:100%; margin-top: 40px;">
              <tr>
                <td style="width:100px;"></td>
                 <td style="width:1000px;"><h4><span style="font-weight: 900;color: #000;border-bottom: 1px solid black;padding-bottom: 10px;margin-bottom: 20px;text-align: right; float:right;">SIGNATURE</span> </h4>
</td>
              </tr>
            </table>

          </div>
          
        </div>

<center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>

            </div>



<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>

</div>

                <?php
                break;
                 case 'comments':
  $id=$_GET['id'];
  ?>

<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
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
    border: 1px solid green; border-radius:5px;">Comments of <strong><?php echo $row['name'];?></strong></h2></div>
                   <div class="col-sm-4"> </div>
                        </div>

<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
           <div class="row" >
       
              <a href="?detect=addComment&id=<?php echo $id;?>"><button class="btn btn-success">Ajouter Comment</button></a>

 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Description</th>
<th>Date</th>
<th>Added By</th>
<th></th>
<th></th>

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
    url:"ajax.php?detect=comment",
    type:"POST",
    data:{is_type:is_type,inid:<?php echo $id;?>}
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



  <?php 
     break; 
      case 'addComment':
  ?> 
  <div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Ajouter Comment</h3>

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
      $id=$_GET['id'];
                        if(isset($_POST['subpost'])){
                        
$cm_des= trim($_POST['cm_des']);
if($cm_des=='')
{
$error[]="Please enter comment description";
 }
 if(!isset($error)){ 
$result=$getCer->insert_comment($cm_des,$user_id,$id);
if($result)
{
 header("Location:inscriptions?detect=comments&id=".$id);  
 exit();
}
else 
{
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
                      <div class="col-sm-12">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Description</label>
     <textarea class="form-control" name="cm_des" required></textarea>
  </div>
                      </div>
                        </div>
                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Comment</button>
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
  case 'delComment': 
  $id=$_GET['id'];
    $inid=$_GET['inid'];
  $res=$getCredit->delete_by_id('comments','cm_id',$id);
  
     if($res)
     {
      header("Location:inscriptions?detect=comments&id=".$inid."&action=Deleted");
     }
     else 
     {
      echo 'Something went wrong.....';
     }
  break;

  break; 
                case 'print': 
                $id=$_GET['id'];
               ?>
               <style type="text/css">
                 

table tr td, table tr th {
  padding: 10px; /* Add 10px padding to all sides */
  color:#000;
}

@media print {
    .nav_menu {
      display: none;
    }
    #printbtn
    {
       display: none;
    }
  }



               </style>
               <div class="row">
                <div class="col-sm-12">  <img src="assets/images/logo.png" width="160"></div>
               </div>
              
<div class="page-title">
              <div class="title_left">
                <h3>Exam Scores</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                    <form>
                      <input type="hidden" name="inid" id="inid" value="<?php echo $id;?>">
                      <div class="row">
                        <div class="col-sm-4">  <div class="form-group">  <label for="exampleInputEmail1">Group</label></div></div>
                        <div class="col-sm-8">
                            <div class="form-group">          
     <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 

             $sql="
SELECT DISTINCT r.gname, r.gid
FROM inscription i
LEFT JOIN groups r ON i.gid = r.gid
ORDER BY r.gname ASC; 
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

                    

                    </form>
                  </div>
            </div>
            <div class="row">
              <div class="col-sm-12"> </div>
            </div>

              <div id="amarea"></div>
<script type="text/javascript">
  $(document).on('change', '#gid', function(){
  var gid= $('#gid').val();
    var inid= $('#inid').val();
  if(gid.trim() == '' ) {          
   alert('Please select a group'); 

            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=print",      
data: { gid: gid, inid: inid },
        beforeSend: function() {
          $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");  
           },
        success: function(data){ 
            //alert(data);
            $("#amarea").html(data);
    }});
}
 });

</script>
<?php

                break;
  case 'del': 
  $id=$_GET['id'];
  $res=$getCredit->delete_by_id('inscription','inid',$id);
  
     if($res)
     {
      header("Location:inscriptions?action=Deleted");
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
                <h3>Inscription</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

                    
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Inscription </button></a>
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
<th>Group </th>
<th>Service Fees</th>
<th>Inscription Fees</th>
<th>Date Inscription</th>
<th>Added By</th>
<th>Status</th>
<th>Profile</th>
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
    url:"ajax.php?detect=inscription",
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

$instatus = trim($_POST['instatus']);
$indeposit = trim($_POST['indeposite']);
$infees = trim($_POST['infees']);
if(!preg_match('/^[0-9]+$/', $indeposit)) {
    $error[] = "Sorry, service fees. Enter digits only.";
}
if(!preg_match('/^[0-9]+$/', $infees)) {
    $error[] = "Sorry, Invalid inscription fees. Enter digits only";
}
// $intotal = trim($_POST['intotal']);
$indate = trim($_POST['indate']);
$indedeut = trim($_POST['indedeut']);
     $intime=$getDatabase->get_hour();
$inreceived = trim($_POST['inreceived']);

         if(!isset($error)){ 
$lastid=$getCer->insert_inscription($reg_id, $gid, $instatus, $indeposit, $infees, $indate, $indedeut, $intime, $inreceived);
           if($lastid>0)
    {
       $cno=$format.$lastid; 
  $result=$getCer->update_cno($cno,$lastid); 
if($result)
{
 header("Location:inscriptions?action=Added");  
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
     <select name="reg_id" class="form-control" required>
        <option value="">Sélectioner l'Utilisateur..</option>
        <?php $rows=$getCredit->get_by_id('registrations','uid',$user_id); 
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
    <label for="exampleInputEmail1">Group</label>
     <select name="gid" class="form-control" required>
       <option value="">Select</option>
         <?php 
              //$rg=$getCredit->get_by_id('groups','uid',$user_id);
              $sql="SELECT groups.gid,groups.gname
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
LEFT JOIN ts_gtw_users ON groups.uid=ts_gtw_users.id
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id='$user_id'";
              $rg=$getCredit->get_by_query($sql); 
              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].' -'.$getCredit->get_sch($arr['gid']).'</option>';  
              }
              ?>
     </select>
  </div>

                      </div>
                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
     <select name="instatus" class="form-control" required>
      <option value="">Select Status</option>
       <option value="2">New</option>
        <option value="1">Active</option>
         <option value="0">Termine</option>
         
     </select>
  </div>

                      </div>
                       <div class="col-sm-2"></div>
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Service Fees</label>
     <input type="number" name="indeposite" class="form-control" required>
  </div>
                      </div>
                        <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Fees Inscription</label>
     <input type="number" name="infees" class="form-control" required>
  </div>
                      </div>
                        <div class="col-sm-2"></div>
                     
                       <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Inscription</label>
     <input type="date" name="indate" class="form-control" required>
  </div>
                      </div>
                       <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Debut Formation</label>
     <input type="date" name="indedeut" class="form-control" required>
  </div>
                      </div>
                       <div class="col-sm-2">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Time Inscription</label>
     <select name="intime" class="form-control" required>
<option value="<?php echo $getDatabase->get_hour();?>"><?php echo $getDatabase->get_hour();?></option>
</select>

  </div>
                      </div>

                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Certificate Received</label>
     <select name="inreceived" class="form-control">
     <option value="0">No</option>
      <option value="1">Yes</option>
     </select>
  </div>

                      </div>
                        </div>
                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Inscription</button>
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
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON inscription.uid=ts_gtw_users.id
LEFT JOIN groups ON inscription.gid=groups.gid 
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND inscription.inid='$id'";
$count=$getCredit->count_by_query2($sql); 
    // $count=$getCredit->count_by_string_two_col('inscription','inid',$id,'uid',$user_id);
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
                <h3>Edit Inscription</h3>

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
                          $count=$getCredit->count_by_id('registrations','reg_id',$reg_id);
                         if($count==0)
                         {
                          $error[]="This username is not found..";
                         }
                         $gid = trim($_POST['gid']);
                         $countg=$getCredit->count_by_id('groups','gid',$gid);
                         if($countg==0)
                         {
                          $error[]="Sorry , Invalid group.";
                         }

$instatus = trim($_POST['instatus']);
$indeposit = trim($_POST['indeposite']);
$infees = trim($_POST['infees']);
//$intotal = trim($_POST['intotal']);
$indate = trim($_POST['indate']);
$indedeut = trim($_POST['indedeut']);
$rows=$getCredit->get_by_id('inscription','inid',$id);
foreach($rows as $row)
{
 $intime=$row['intime'] ;
}

$inreceived = trim($_POST['inreceived']);
     
         if(!isset($error)){ 
$result=$getCer->update_inscription($reg_id, $gid, $instatus, $indeposit, $infees, $indate, $indedeut, $intime, $inreceived, $id);

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
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN groups ON inscription.gid=groups.gid
 WHERE inscription.inid=:id
";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
?>
          <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Utilisateur</label>
     <select name="reg_id" class="form-control" required>
        <option value="<?php echo $row['reg_id'];?>" style="background: #CBCDD1;"><?php echo $row['name'].'(CIN:'.$row['cin'].')';?></option>
        <?php 
   $rows=$getCredit->get_by_id('registrations','uid',$user_id); 
 foreach($rows as $rowm)
 {
  echo '<option value="'.$rowm['reg_id'].'">'.$rowm['name'].'(CIN:'.$rowm['cin'].')</option>'; 
 }
        ?> 
     </select>
  </div>

                      </div><div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Group</label>
     <select name="gid" class="form-control" required>
      <option value="<?php echo $row['gid'];?>" style="background: #CBCDD1;"><?php echo $row['gname'].' -'.$getCredit->get_sch($row['gid'])?></option>

         <?php 
              //$rg=$getCredit->get_by_id('groups','uid',$user_id);
          $sql="SELECT groups.gid,groups.gname
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
LEFT JOIN ts_gtw_users ON groups.uid=ts_gtw_users.id
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
WHERE links.id='$user_id'";
              $rg=$getCredit->get_by_query($sql); 

              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].' -'.$getCredit->get_sch($arr['gid']).'</option>';  
              }
              ?>

     </select>
  </div>

                      </div>
                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
     <select name="instatus" class="form-control" required>
       <option value="<?php echo $row['instatus'];?>" style="background: #CBCDD1;"><?php echo $getCredit->status2($row['instatus']);?></option>
       <option value="2">New</option>
        <option value="1">Active</option>
         <option value="0">Termine</option>
         
     </select>
  </div>

                      </div>
                       <div class="col-sm-2"></div>
                      <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Service Fees</label>
     <input type="number" name="indeposite" value="<?php echo $row['inservicefees'];?>" class="form-control" required>
  </div>
                      </div>
                        <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Fees Inscription</label>
     <input type="number" name="infees" value="<?php echo $row['infees'];?>" class="form-control" required>
  </div>
                      </div>
                       <div class="col-sm-2"></div>

                
                       <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Inscription</label>
     <input type="date" name="indate"  value="<?php echo $row['indate'];?>" class="form-control" required>
  </div>
                      </div>
                       <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Debut Formation</label>
     <input type="date" name="indedeut"  value="<?php echo $row['indedate_debut'];?>" class="form-control" required>
  </div>
                      </div>
                       <div class="col-sm-4">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Time Inscription</label>
     <select name="intime" class="form-control" required disabled>
      <option value="<?php echo $row['intime'];?>"><?php echo $row['intime'];?></option>
</select>
  </div>
                      </div>

                      <div class="col-sm-4">
                         <div class="form-group">          
    <label for="exampleInputEmail1">Certificate Received</label>
     <select name="inreceived" class="form-control">
       <option value="<?php echo $row['inreceived'];?>" style="background: #CBCDD1;"><?php echo $getCredit->status3($row['inreceived']);?></option>
     <option value="0">No</option>
      <option value="1">Yes</option>
     </select>
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

  case 'view':
  $id=$_GET['id'];
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
  ?> 
  
<?php 
  $sql="
SELECT * 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id 
LEFT JOIN groups ON inscription.gid=groups.gid
LEFT JOIN formation ON groups.fid=formation.fid
WHERE inscription.inid=:id
";        

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{

  $rowsk=$getCredit->get_by_string_two_col('inscription','gid',$row['gid'],'reg_id',$row['reg_id']);
       foreach($rowsk as $rowk)
       {
         $servicefees=$rowk['inservicefees'];  $infees=$rowk['infees'];
         $total=$servicefees+$infees;
       }
         $total_deposit=$getCredit->getsumdeposite($row['gid'],$row['reg_id']);

         $payamount=$total-$total_deposit;

?>

  <div class="row">
      <div class="col-md-3" style="background:#f6fcff; border-radius: 15px;color: #000;">
    
  <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">  
                         <table style="border: 0px;" cellpadding="10">
                          <tr>
                            <td><div style="height: 152px; width: 152px;">
      <center>
    <?php 
    if($row['image']!='')
    {
      echo '<img id="output"  width="150" height="150" / src="assets/profile/'.$row['image'].'" style="border-radius:15px;">';
    }
    else 
    {
      echo ' <img id="output"  width="150" height="150" / src="assets/icon/avatar.png">';
    }
    ?>
  </center>
     </div>
      <center>
     <h6><?php echo $row['name']; ?></h6>
   
      <div style="font-size: 10px;color: #9e9c9c;"><u>Contact Information: </u></div>
    </center>
    
  </td>
                          </tr>
                         </table> 
                      

   
   
    <table style="border: 0px;" cellpadding="10">
  <tr><td>CIN</td> <td>:</td><td><?php echo $row['cin']?></td></tr>
  <tr>
    <td>TEL</td>
    <td>:</td>
    <td><?php echo $row['mobile']?></td>
</tr>

<tr>
    <td>Birth Date</td>
    <td>:</td>
    <td><?php echo $getDatabase->easy_date2($row['dob'])?></td>
</tr>
<tr>
    <td>Birth Place</td>
    <td>:</td>
    <td><?php echo $row['bplace']?></td>
</tr>

    </table>
  </div>
</div>
</div>

      </div>
                    
                    <div class="col-md-9">
<div class="row">
    <div class="col-sm-8">
  <div class="page-title">
              <div class="title_left">
                <h3>Inscription Details</h3> 

              </div>

            </div>
          </div>
          <div class="col-sm-4" style="text-align: right;">
               <a href="?detect=fiche&inid=<?php echo $row['inid'];?>"name="subpost" class="btn btn-secondary" style="background: #000;"><i class="fa fa-print"></i> Print Fiche</a>
          </div>

        </div>

        

          <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                       <div class="col-sm-6">

                        <div class="form-group">          
    <label for="exampleInputEmail1">Formation</label>
     <input type="text" name="indeposite" value="<?php echo $row['formation_name'];?>" class="form-control" disabled>
  </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Group</label>
     <input type="text" name="indeposite" value="<?php echo $row['gname'];?>" class="form-control" disabled>
  </div>
                      </div> 
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Inscription</label>
     <input type="text" name="indate"  value="<?php echo $getDatabase->easy_date2($row['indate']);?>" class="form-control" disabled>
  </div>
                      </div>      
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
     <input type="text" name="indate"  value="<?php echo $getCredit->status_hr($row['instatus']);?>" class="form-control" disabled>
  </div>
                      </div>      
<div class="col-sm-6">
                     
                        <div class="form-group">          
    <label for="exampleInputEmail1">Service Fees + Inscription Fees</label>
     <input type="text" name="intotal" value="<?php echo $total;?> <?php echo $getCredit->get_option_value("currency"); ?>" class="form-control" disabled>
  </div>
                      </div>     


                      <div class="col-sm-6">
                     
                        <div class="form-group">          
    <label for="exampleInputEmail1">Total Deposits</label>
     <input type="text" name="intotal" value="<?php echo $total_deposit;?> <?php echo $getCredit->get_option_value("currency"); ?>" class="form-control" disabled>
  </div>
                      </div>     
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Total to Pay</label>
     <input type="text" name="intotal" value="<?php echo $payamount;?> <?php echo $getCredit->get_option_value("currency"); ?>" class="form-control" disabled>
  </div>
                      </div>     
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Total Presence</label>
     <input type="text" name="intotal" value="<?php echo $getCredit->get_presense($row["reg_id"]);?>" class="form-control" disabled>
  </div>
                      </div>     

        
                    
                         <div class="col-sm-3">
                           <a href="?detect=comments&id=<?php echo $row['inid'];?>"name="subpost" class="btn btn-info btn-lg"><i class="fa fa-comment"></i> Comments</a>
                       </div>
                          <div class="col-sm-3">
                          <a href="payments?inid=<?php echo $row['inid'];?>"name="subpost" class="btn btn-secondary btn-lg"><i class="fa fa-money"></i> Payments</a>
                       </div>

                        <div class="col-sm-3">
  
 <a href="?detect=edit&id=<?php echo $row['inid'];?>"name="subpost" class="btn plan-button btn-lg">Edit Inscription</a>


                       </div>
                        <div class="col-sm-3">
                           <a href="?detect=print&id=<?php echo $row['inid'];?>"name="subpost" class="btn btn-warning btn-lg"><i class="fa fa-print"></i> Print Notes</a>
 
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
                 case 'fiche':
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

                 $sql="
SELECT * 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN groups ON inscription.gid=groups.gid
LEFT JOIN formation ON groups.fid=formation.fid
 WHERE inscription.inid=:id
";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{}
                ?>


              <div class="row">
                <div class="col-sm-12" style="text-align: center;">  <img src="assets/images/logo.png" width="160"> <br> <br></div>

               </div>
            <div class="row">
              <div class="col-sm-12" style="background-image: url('assets/icon/reportbg.jpg'); background-size: cover; background-position: center; height: 1199px;">
                  <?php  foreach($rows as $rowk){} ?>
              <table style="width:100%">
                <tr>    <td style="width:10%;"></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">N° D'inscription: :</span> <?php echo $rowk['inid'];?></h4></td>
                  <td style="text-align:center;"><h4><span style="font-weight: 900;color: #000;">N° Du Stagiaire :</span> <?php echo $rowk['reg_id'];?></h4></td>
                  <td style="width:10%;"></td>
                </tr>
              </table>
              <div class="row">
                <div class="col-sm-3"></div>
    <div class="col-sm-6" style="text-align:center;">
  <div class="page-title">
<h1 style="color: #000;font-weight: 400;border-bottom: 1px solid black;padding-bottom: 10px;margin-bottom: 20px;">FICHE D'INSCRIPTION</h1>
 <div class="col-sm-3"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-sm-12">
            <table>
              <tr>
                <td style="width:400px;"></td>
                 <td style="width:500px;"><table style="width: 100%;">
  <tr>
    <td>Nom</td>
    <td><?php echo $row['name'];?></td>
  </tr>
  
  <tr>
    <td>Téléphone</td>
    <td><?php echo $row['mobile'];?></td>
  </tr>
  <tr>
    <td>CIN</td>
    <td><?php echo $row['cin'];?></td>
  </tr>
  <tr>
    <td>Date Naissance</td>
    <td><?php echo $getDatabase->easy_date2($row['dob']);?></td>
  </tr>
  <tr>
    <td>Adresse</td>
    <td><?php echo $row['address'];?></td>
  </tr>
  <tr>
    <td>Groupe</td>
    <td><?php echo $row['gname'].' '. $getCredit->get_sch($row["gid"]);?></td>
  </tr>
  <tr>
    <td>Formation</td>
    <td><?php echo $row['formation_name'];?></td>
  </tr>
  <tr>
    <td>Date Inscription</td>
    <td><?php echo $getDatabase->easy_date2($row['indate']);?></td>
  </tr>

</table>
            </td>
                  <td style="width:300px;"></td>
              </tr>
            </table>
            <table style="width:100%; margin-top: 40px;">
              <tr>
                <td style="width:100px;"></td>
                 <td style="width:1000px;"> <p style="font-weight:700px;font-size: 16px;text-decoration: underline;">La formation choisie n'est ni échangée ni remboursée au délai de 48 heures
contact@atlantique.ma www.atlantique.ma</p>
</td>

              </tr>
            </table>
               <table style="width:100%; margin-top: 40px;">
              <tr>
                <td style="width:100px;"></td>
                 <td style="width:1000px;"><h4><span style="font-weight: 900;color: #000;border-bottom: 1px solid black;padding-bottom: 10px;margin-bottom: 20px;text-align: right; float:right;">SIGNATURE</span> </h4>
</td>
              </tr>
            </table>

          </div>
          
        </div>

<center><a id="printbtn" onclick="window.print()"><img src="assets/icon/print.png" width="50" style="cursor:pointer;"></a></center>
               </div>

            </div>



<a href="" class="btn btn-primary fixed-right" id="backbtn"><i class="fa fa-arrow-left"></i> Back</a>

</div>

                <?php
                break;
                 case 'comments':
  $id=$_GET['id'];
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

  ?>

<?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
} 
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
    border: 1px solid green; border-radius:5px;">Comments of <strong><?php echo $row['name'];?></strong></h2></div>
                   <div class="col-sm-4"> </div>
                        </div>
                                        
<?php if(isset($_GET['action']))
{
echo '<div class="success">'.$_GET['action'].'</div>';
}
?>
           <div class="row" >
       
              <a href="?detect=addComment&id=<?php echo $id;?>"><button class="btn btn-success">Ajouter Comment</button></a>

 <div class="table-responsive">
 <div class="col-sm-12">
        
    <table id="product_data" class="table table-bordered table-striped">
     <thead>
      <tr>
<th>ID</th>
<th>Description</th>
<th>Date</th>

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
    url:"ajaxm.php?detect=comment",
    type:"POST",
    data:{is_type:is_type,inid:<?php echo $id;?>}
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



  <?php 
     break; 
      case 'addComment':
     $id=$_GET['id'];
      $sql="SELECT count(*) as total 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON inscription.uid=ts_gtw_users.id
LEFT JOIN groups ON inscription.gid=groups.gid 
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND inscription.inid='$id'";
$count=$getCredit->count_by_query2($sql); 

      // $count=$getCredit->count_by_string_two_col('inscription','inid',$id,'uid',$user_id);
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
                <h3>Ajouter Comment</h3>

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
                        
$cm_des= trim($_POST['cm_des']);
if($cm_des=='')
{
$error[]="Please enter comment description";
 }
 if(!isset($error)){ 
$result=$getCer->insert_comment($cm_des,$user_id,$id);
if($result)
{
 header("Location:inscriptions?detect=comments&id=".$id);  
 exit();
}
else 
{
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
                      <div class="col-sm-12">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Description</label>
     <textarea class="form-control" name="cm_des" required></textarea>
  </div>
                      </div>
                        </div>
                     
                       <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4" style="text-align:center;">
   <br> 
 <button type="submit" name="subpost" class="btn plan-button btn-lg">Ajouter Comment</button>
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
                case 'print': 
                $id=$_GET['id'];
                //$count=$getCredit->count_by_string_two_col('inscription','inid',$id,'uid',$user_id);
                 $sql="SELECT count(*) as total 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON inscription.uid=ts_gtw_users.id
LEFT JOIN groups ON inscription.gid=groups.gid 
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND inscription.inid='$id'";
$count=$getCredit->count_by_query2($sql); 

  if($count==0)
  {
    header("location:index");
    exit();
  }

               ?>
               <style type="text/css">
                 

table tr td, table tr th {
  padding: 10px; /* Add 10px padding to all sides */
  color:#000;
}

@media print {
    .nav_menu {
      display: none;
    }
    #printbtn
    {
       display: none;
    }
  }



               </style>
               <div class="row">
                <div class="col-sm-12">  <img src="assets/images/logo.png" width="160"></div>
               </div>
              
<div class="page-title">
              <div class="title_left">
                <h3>Exam Scores</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                    <form>
                      <input type="hidden" name="inid" id="inid" value="<?php echo $id;?>">
                      <div class="row">
                        <div class="col-sm-4">  <div class="form-group">  <label for="exampleInputEmail1">Group</label></div></div>
                        <div class="col-sm-8">
                            <div class="form-group">          
     <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 
$query="SELECT groups.gid,groups.gname
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON inscription.uid=ts_gtw_users.id
LEFT JOIN groups ON inscription.gid=groups.gid 
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND inscription.inid='$id'";

              $rg=$getCredit->get_by_query($query); 

              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
              }
              ?>
     </select>
  </div>
                         </div>

                      </div>

                    

                    </form>
                  </div>
            </div>
            <div class="row">
              <div class="col-sm-12"> </div>
            </div>

              <div id="amarea"></div>
<script type="text/javascript">
  $(document).on('change', '#gid', function(){
  var gid= $('#gid').val();
    var inid= $('#inid').val();
  if(gid.trim() == '' ) {          
   alert('Please select a group'); 

            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=print",      
data: { gid: gid, inid: inid },
        beforeSend: function() {
          $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");  
           },
        success: function(data){ 
            //alert(data);
            $("#amarea").html(data);
    }});
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
                <h3>Inscription</h3>
              </div>

              <div class="title_right">
                
              </div>
            </div>

                    
 <a href="?detect=add"><button class="btn btn-success" >Ajouter Inscription </button></a>
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
<th>Group </th>
<th>Service Fees</th>
<th>Inscription Fees</th>
<th>Date Inscription</th>

<th>Status</th>
<th>Profile</th>
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
    url:"ajaxm.php?detect=inscription",
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
 case 'view':
  $id=$_GET['id'];
  $query="SELECT *
FROM inscription  
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND inscription.inid='$id'
";
 $counts=$getCredit->count_by_query($query);
if($counts==0)
       {
        header("location:group"); 
        exit();
       }
  ?> 
  
<?php 
  $sql="
SELECT * 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id 
LEFT JOIN groups ON inscription.gid=groups.gid
LEFT JOIN formation ON groups.fid=formation.fid
WHERE inscription.inid=:id
";        

$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{

  $rowsk=$getCredit->get_by_string_two_col('inscription','gid',$row['gid'],'reg_id',$row['reg_id']);
       foreach($rowsk as $rowk)
       {
         $servicefees=$rowk['inservicefees'];  $infees=$rowk['infees'];
         $total=$servicefees+$infees;
       }
         $total_deposit=$getCredit->getsumdeposite($row['gid'],$row['reg_id']);

         $payamount=$total-$total_deposit;

?>

  <div class="row">
      <div class="col-md-3" style="background:#f6fcff; border-radius: 15px;color: #000;">
    
  <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">  
                         <table style="border: 0px;" cellpadding="10">
                          <tr>
                            <td><div style="height: 152px; width: 152px;">
      <center>
    <?php 
    if($row['image']!='')
    {
      echo '<img id="output"  width="150" height="150" / src="assets/profile/'.$row['image'].'" style="border-radius:15px;">';
    }
    else 
    {
      echo ' <img id="output"  width="150" height="150" / src="assets/icon/avatar.png">';
    }
    ?>
  </center>
     </div>
      <center>
     <h6><?php echo $row['name']; ?></h6>
   
      <div style="font-size: 10px;color: #9e9c9c;"><u>Contact Information: </u></div>
    </center>
    
  </td>
                          </tr>
                         </table> 
   
    <table style="border: 0px;" cellpadding="10">
  <tr><td>CIN</td> <td>:</td><td><?php echo $row['cin']?></td></tr>
  <tr>
    <td>TEL</td>
    <td>:</td>
    <td><?php echo $row['mobile']?></td>
</tr>

<tr>
    <td>Birth Date</td>
    <td>:</td>
    <td><?php echo $getDatabase->easy_date2($row['dob'])?></td>
</tr>
<tr>
    <td>Birth Place</td>
    <td>:</td>
    <td><?php echo $row['bplace']?></td>
</tr>

    </table>
  </div>
</div>
</div>

      </div>
                    
                    <div class="col-md-9">
<div class="row">
    <div class="col-sm-12">
  <div class="page-title">
              <div class="title_left">
                <h3>Inscription Details</h3>

              </div>

            </div>
          </div>
        </div>

          <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                       <div class="col-sm-6">

                        <div class="form-group">          
    <label for="exampleInputEmail1">Formation</label>
     <input type="text" name="indeposite" value="<?php echo $row['formation_name'];?>" class="form-control" disabled>
  </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Group</label>
     <input type="text" name="indeposite" value="<?php echo $row['gname'];?>" class="form-control" disabled>
  </div>
                      </div> 
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Date Inscription</label>
     <input type="text" name="indate"  value="<?php echo $getDatabase->easy_date2($row['indate']);?>" class="form-control" disabled>
  </div>
                      </div>      
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Status</label>
     <input type="text" name="indate"  value="<?php echo $getCredit->status_hr($row['instatus']);?>" class="form-control" disabled>
  </div>
                      </div>      
<div class="col-sm-6">
                     
                        <div class="form-group">          
    <label for="exampleInputEmail1">Service Fees + Inscription Fees</label>
     <input type="text" name="intotal" value="<?php echo $total;?> <?php echo $getCredit->get_option_value("currency"); ?>" class="form-control" disabled>
  </div>
                      </div>     


                      <div class="col-sm-6">
                     
                        <div class="form-group">          
    <label for="exampleInputEmail1">Total Deposits</label>
     <input type="text" name="intotal" value="<?php echo $total_deposit;?> <?php echo $getCredit->get_option_value("currency"); ?>" class="form-control" disabled>
  </div>
                      </div>     
                        <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Total to Pay</label>
     <input type="text" name="intotal" value="<?php echo $payamount;?> <?php echo $getCredit->get_option_value("currency"); ?>" class="form-control" disabled>
  </div>
                      </div>     
                       <div class="col-sm-6">
                        <div class="form-group">          
    <label for="exampleInputEmail1">Total Presence</label>
     <input type="text" name="intotal" value="<?php echo $getCredit->get_presense($row["reg_id"]);?>" class="form-control" disabled>
  </div>
                      </div>     

        
                    
                         <div class="col-sm-4">
                       </div>
                        <div class="col-sm-4">


                       </div>
                        <div class="col-sm-4">
                           <a href="?detect=print&id=<?php echo $row['inid'];?>"name="subpost" class="btn btn-warning btn-lg"><i class="fa fa-print"></i> Print Notes</a>
 
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
                case 'print': 
                $id=$_GET['id'];

                  $query="SELECT *
FROM inscription  
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND inscription.inid='$id'
";
 $counts=$getCredit->count_by_query($query);
if($counts==0)
       {
        header("location:group"); 
        exit();
       }

      
               ?>
               <style type="text/css">
                 

table tr td, table tr th {
  padding: 10px; /* Add 10px padding to all sides */
  color:#000;
}

@media print {
    .nav_menu {
      display: none;
    }
    #printbtn
    {
       display: none;
    }
  }



               </style>
               <div class="row">
                <div class="col-sm-12">  <img src="assets/images/logo.png" width="160"></div>
               </div>
              
<div class="page-title">
              <div class="title_left">
                <h3>Exam Scores</h3>

              </div>

              <div class="title_right">
                
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                    <form>
                      <input type="hidden" name="inid" id="inid" value="<?php echo $id;?>">
                      <div class="row">
                        <div class="col-sm-4">  <div class="form-group">  <label for="exampleInputEmail1">Group</label></div></div>
                        <div class="col-sm-8">
                            <div class="form-group">          
     <select name="gid" id="gid" class="form-control" required>
       <option value="">Select Group</option>
         <?php 
// $query="SELECT * 
// FROM groups 
// LEFT JOIN formation ON groups.fid=formation.fid
// LEFT JOIN ts_gtw_users ON groups.uid=ts_gtw_users.id
// LEFT JOIN inscription ON groups.gid=inscription.gid
// LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
// LEFT JOIN centres ON registrations.cent_id=centres.cent_id
// LEFT JOIN links ON centres.cent_id=links.cent_id
//  WHERE links.id='$user_id' AND
// ";

            $sql = "SELECT DISTINCT r.gname, r.gid 
        FROM inscription i 
        LEFT JOIN groups r ON i.gid = r.gid 
        LEFT JOIN registrations s ON i.reg_id=s.reg_id
        LEFT JOIN centres c ON s.cent_id=c.cent_id
LEFT JOIN links l ON c.cent_id=l.cent_id
        WHERE l.id = :id";
$rg=$getCredit->get_by_id_query($sql,$user_id);

              foreach($rg as $arr)
              {
              echo '<option value="'.$arr['gid'].'">'.$arr['gname'].'</option>';  
              }
              ?>
     </select>
  </div>
                         </div>

                      </div>

                    

                    </form>
                  </div>
            </div>
            <div class="row">
              <div class="col-sm-12"> </div>
            </div>

              <div id="amarea"></div>
<script type="text/javascript">
  $(document).on('change', '#gid', function(){
  var gid= $('#gid').val();
    var inid= $('#inid').val();
  if(gid.trim() == '' ) {          
   alert('Please select a group'); 

            return false;
        }
        else {  
        $.ajax({
        method:"POST",
        url: "action?detect=print",      
data: { gid: gid, inid: inid },
        beforeSend: function() {
          $("#amarea").html("<center><img src='assets/icon/subloader.gif' alt='Loading...' style='width: 70px; height: auto;'></center>");  
           },
        success: function(data){ 
            //alert(data);
            $("#amarea").html(data);
    }});
}
 });

</script>
<?php

                break;

  default:

?> 

<div class="page-title">
              <div class="title_left">
                <h3>Inscription</h3>
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
<th>Group </th>
<th>Service Fees</th>
<th>Inscription Fees</th>
<th>Date Inscription</th>
<th>Added By</th>
<th>Status</th>
<th>Profile</th>
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
    url:"ajaxy.php?detect=inscription",
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