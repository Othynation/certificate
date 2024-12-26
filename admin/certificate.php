<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}$rom=$getCredit->get_by_id('ts_gtw_users','id',$user_id); foreach($rom as $rm){$postm=$rm['post']; }
include("../includes/functions.php"); $id=$_GET['id'];if($postm=='user'){$countcc=$getCredit->count_by_string_two_col('certificates','uid',$user_id,'cid',$id);if($countcc==0){ echo 'Sorry, No certificate found';exit();}}
$rowm=$getCredit->fetch_all('more','id','ASC');
foreach($rowm as $ro)
{
$watermark=$ro['watermark'];
}
if($postm=='employee')
{
                   $query="SELECT *
FROM certificates  
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND certificates.cid='$id'
";
$counts=$getCredit->count_by_query($query);
if($counts==0)
       {
        header("location:group"); 
        exit();
       }
}
?>
<!DOCTYPE>
<html>
<head>
    <title>Certificate</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="lib/css/font-awesome.min.css">
    <script type="text/javascript" src="assets/jss/jspdf.min.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
     <link href="lib/css/stylecf.css" rel="stylesheet">
    <script type="text/javascript" src="assets/jss/html2canvas.js"></script>
          <script src="assets/jss/jquery.js"></script>
   <style type="text/css">
    u {    
    border-bottom: 2px dotted #000;
    text-decoration: none;
}
.line {
  width: 87px;
  border: 1px solid #898786;
  margin-top: -19px;
}
.main-container{
                    width: 842px!important;
                    height: 595px!important;
                }
                
  </style>
<style type="text/css" media="print">
    body { visibility: hidden; display: none }
</style>
</head>
<!-- <body oncontextmenu="return false;"> -->
    <body>
    <?php $count=$getCredit->count_by_string('certificates','cid',$id);
            if($count==0)
            {?> 
        <div class="container mt-3  main-div" style="border-radius:10px; margin-bottom: 80px; ">
            <div class="container mt-5">
                <div class="row form_area" >
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
    <div class="form-box">
             <center><p class="text-red">No record found..</p>
                    </center>
</div>
   
        </div>
         <div class="col-sm-4">
        </div>
        </div>
                
    </div>
</div>
<?php } else {

  $sql="SELECT * 
FROM certificates 
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id 
LEFT JOIN formation ON certificates.fid=formation.fid
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
WHERE certificates.cid=:id";         
$rows=$getCredit->get_by_id_query($sql,$id);
foreach($rows as $row)
{
        ?> 
            
    <div id="testDiv">
       
              <?php if(isset($_GET['download'])){?>
      <div class="container" style="margin-left: -0px;padding:0px !important;">  
              <div class="row"> 
        <?php }
        else 
        {?>
            <br> 
          <div class="container" style="margin-left:-0px;">    
          <div class="row" style="margin-left:28%;"> 
            
        <?php }
    ?> 
    
    <?php
        $name = $row['name'];
        $fontSize = (strlen($name) > 26) ? '17px' : '20px';
    ?>
          
                
            <div class="col-sm-12">
<div style="position:relative; width:842px; height:595px;">
<!-- <div style="position:relative; width:80%; height:100%;"> -->
  <img src="../assets/images/<?php echo $watermark;?>" alt="" style="display:block; width:100%; height:100%;">
  <div style="position:absolute; top:198px; left:133px; width:100%; height:100%;">
   
      
     <div class="row">
     <div class="col-sm-10" style="right: 53px;font-size: 14.5px;text-align:center;">
        Nous Soussignés, la Direction du Centre Atlantique de Formation Continue Attestons
         </div> 
     <div class="col-sm-7">
        <p style="font-family: arial; font-size: <?php echo $fontSize; ?>; font-weight: 700; margin-top: 0px; text-transform: uppercase; position: relative; left: 70px; margin-left: 0px; font-family: Times New Roman;">
            <?php echo $row['honorific']; ?> <?php echo $name; ?>
        </p>
     </div>
     <div class="col-sm-3" style="right: 50px;font-size: 15px;text-align:end;">
          <?php 
        if($row['cin']!=''){
        echo 'CIN : <span style="font-family: arial;font-size: 20px; font-weight: 700;margin-top: 0px;font-family: Times New Roman;text-transform: uppercase;"> '. $row['cin'] .'</span>' ; } ?>
         
         </div>   
    </div>
    <div class="row" style="margin-top: -15px;">
    <div class="col-sm-3"><p style="font-family: arial;font-size: 20px; font-weight: 700;margin-top: 0px;margin-left: 77px;font-family: Times New Roman;"><?php echo $getDatabase->easy_date2($row['dob']); ?></p></div>  
     <div class="col-sm-7" style="right: 50px;font-size: 15px;text-align:end;">
         <?php 
        if($row['bplace']!=''){
        echo 'Lieu de Naissance : <span style="font-family: arial;font-size: 20px; font-weight: 700;margin-top: 0px;font-family: Times New Roman;text-transform: uppercase;">'. $row['bplace'].'</span> '; } ?>
            
         </div>  
    </div>
     <div class="row">
        <table border="0" width="765" style="margin-left: -80px;text-align: center;">
            <?php 
                if($row['heures']!=''){
                    echo '<tr><td><p style="height: 17px;font-family: arial;font-size: 15px;font-weight: 400;margin-top: 0px;margin: 0px;text-align: center;top: 5px;position: relative;display: inline-block;">A accompli <span style="font-size: 16px; font-weight: 700; font-family: Times New Roman;">'. $row['heures'] .' Heures</span> de Formation Pratique au Sein de Notre établissement en :</p></td></tr> ';
                } 
                else{
                    echo '<tr><td><p style="font-family: arial;font-size: 15px;font-weight: 400;margin-top: 0px;margin: 0px;text-align: center;top: 5px;position: relative;display: inline-block;">A Suivi au Sein de Notre établissement une Formation Pratique en :</p></td></tr> '; 
                }
            ?>
             <tr><td>
                 <p style="font-family: arial;font-size: 22px; font-weight: 900; margin-top: 0px; font-family: Times New Roman;margin-left: 0px;text-transform: uppercase;text-align: center;top: 10px; position: relative;display: inline-block; border-bottom: 2px solid black; padding-bottom: 2px;"><?php echo $row['formation_name']; ?></p>
             </td></tr>
        </table>
   
    </div>
    <div class="row">
    <div class="col-sm-4"><p style="font-family: arial;font-size: 20px; font-weight: 700;margin-top: 0px;margin-left: 48px;font-family: Times New Roman;"><?php echo $row['cyear']; ?></p></div>  
    <div class="col-sm-4"><p style="font-family: arial;font-size: 20px; font-weight: 700;margin-top: 0px;margin-left: -65px;font-family: Times New Roman;text-transform: uppercase;">
        <?php 
        if($row['niveau']!=''){
        echo '<span style="font-weight: 100;font-family: arial;font-size:14px;text-transform: none;">Niveau: </span> '. $row['niveau']; } ?>
            

        </p></div>  

     <div class="col-sm-4"><p style="font-family: arial;font-size: 20px; font-weight: 700;margin-top: 0px;margin-left: -144px;font-family: Times New Roman;text-transform: uppercase;"><span style="font-weight: 100;font-family: arial;font-size:15px;text-transform: none;">Durée de formation: </span> <?php echo $row['mois']; ?></p></div>  
    </div>

     <div class="row" style="margin-top: 15px;">
        <div class="col-sm-6"></div>
    <div class="col-sm-3"><p style="font-family: arial;font-size: 14px; font-weight: 100;margin-top: 0px;margin-left: 71px;font-family: Times New Roman;"><?php echo $getDatabase->easy_date2($row['cdate']); ?></p></div>  
     <div class="col-sm-3"><p style="font-family: arial;font-size: 14px; font-weight: 100;margin-top: 0px;margin-left: -62px;font-family: Times New Roman;text-transform: capitalize;;"> <?php echo $row['city']; ?></p></div>  
    </div>
    <div class="row" style="margin-top: 76px;">
        <div class="col-sm-9"></div>
      
     <div class="col-sm-3"><p style="font-family: arial;font-size: 10px; font-weight: 700;margin-top: 3px;margin-left: -67px;font-family: Times New Roman;text-transform: uppercase;"> <?php echo $row['cno']; ?></p></div>  
    </div>





    <br>
  </div>
</div>

         <div class="row">
    
  </div>
  <!--test div end-->
    </div>
</div>
</div>
</div>

<div class="container">
<div class="row"> 
    <div class="col-sm-4">
    </div>
     <div class="col-sm-4">
          
    </div>
     <div class="col-sm-4" style="text-align:right;position: fixed;width: 60px;height: 60px;bottom: 40px;right: 70px;background-color: transparent; cursor: pointer;">
      <span id="loading"></span>
    </div>
</div>
</div>
<?php 
if(isset($_GET['download'])){
    $sanitizedName = preg_replace('/[^\w\s\-]/', '', $row['name']); // Sanitize the filename
?>
    <script type="text/javascript">
        window.onload = function() {
            genPDF('<?php echo $sanitizedName; ?>');
        };
    </script>
<?php 
} 
?>
   <script type="text/javascript" src="assets/jss/custom.js"></script>

        <?php 
    }
}


    ?> 
</body>
</html>