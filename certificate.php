<?php require_once("autoload.php"); include("admin/functions.php"); include("functions.php");  
if(!isset($_SESSION['cid'])) { header("location:./"); exit();}
    else 
    {
$cid=$_SESSION['cid'];
    }
$extra_head=''; $image=$paypath.'assets/image/'.$logo; 
$footer='<script src="'.$paypath.'assets/js/functions.js"></script>'; 
include("templates/head.php");
include("templates/header.php");
$countcc=$getCredit->count_by_string('certificates','cno',$cid);if($countcc==0){ echo 'Sorry, No certificate found';exit();}
include("admin/functions.php");
 ?>   
<main> 

<!-- =======================
Main Banner START -->
<section class="position-relative overflow-hidden pt-5 pt-lg-3">
    <div class="container">
      <div class="col-sm-2"> </div>
      <div class="col-sm-8"> 

 <?php
  $sql="SELECT * 
FROM certificates 
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id 
LEFT JOIN formation ON registrations.fid=formation.fid
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
WHERE certificates.cno=:id";         
$rows=$getCredit->get_by_id_query($sql,$cid);
foreach($rows as $row)
{
        ?> 
                
<div class="cr-main">
  <img src="assets/images/<?php echo $stamp;?>" alt="">
  <div class="cr-container">
<div class="row">
    <div class="col-sm-12"><p class="cr-col-1"><img  src="assets/image/<?php echo $logo;?>" alt="logo"></p></div>  
    </div>
    <table border="0" class="cr-table-1">
             <tr><td>
                <p class="cr-table-p">Certificate of <span style="color: #0065C3;"><?php echo $row['honorific']; ?> <?php echo $row['name']; ?></span> <img  src="assets/images/<?php echo $certified;?>" style="height: 60px;width: auto;"> </p>
             </td></tr>
        </table>
    <div class="row">

    <div class="col-sm-12"><p class="cr-col-2">A Suivi au Sein de Notre établissement une Formation Pratique en :</p></div>  
    </div>
    
         <table border="0" class="cr-table-2">
             <tr><td>
                 <p class="cr-col-3"><?php echo $row['formation_name']; ?></p>
             </td></tr>
        </table>
    
    <div class="row">
    <div class="col-sm-12"><p class="cr-col-4">Pour l’année : <span style="font-weight: 900;"><?php echo $row['cyear'];?></span></p></div>  
    </div>


    <br>
  </div>
</div>

</div>

<?php } ?>


      </div>
       <div class="col-sm-2"> </div>
    </div>
</section>




        </div>
    </div>
</section>
</main>

<style>
    .cr-main{
        position:relative; width:842px; height:595px; left: 25%; top:-30px;
    }
    .cr-main img{
        width:100%; height:100%;
    }
    .cr-container{
        position:absolute; top:100px; left:133px; width:100%; height:100%;
    }
    .cr-col-1{
        font-family: arial;font-size: 27px; font-weight: 900;margin-top: 25px; font-family: Times New Roman;margin-left: 180px;text-transform: uppercase;text-decoration: underline;
    }
    .cr-col-1 img{
        height: 110px;width: auto;
    }
    .cr-col-2{
        font-size: 10px; font-weight: 100;margin-top: 15px; font-family: arial;margin-left: 95px;color: #000;word-spacing: 2px;letter-spacing: 1px;
    }
    .cr-col-3{
        font-size: 20px; font-weight: 400;margin-top: 10px; font-family: arial;margin-left: 0px;color: #000;text-transform: uppercase;text-align: center;
    }
    .cr-col-4{
        font-size: 10px; font-weight: 100;margin-top: 15px; font-family: arial;margin-left: 220px;color: #000;word-spacing: 2px;letter-spacing: 1px;
    }
    .cr-table-p{
        font-size: 35px; font-weight: 900;margin-top: 25px; font-family: arial;color: #000;
    }
    .cr-table-1{
        margin-left: -90px;text-align: center; width:758px; 
    }
    .cr-table-2{
        margin-left: -90px; width:758px;
    }
    
    @media only screen and (max-width: 400px) {
        .cr-main{
            position: relative; width: auto; height: 595px; left: 0; top: 0;
        }
        .cr-main img{
            width:100%; height:100%;
        }
        .cr-container{
            top: 100px; left: 0;
        }
        .cr-col-1{
            margin: 0px 0px !important;
        }
        .cr-col-1 img{
            margin: 0px auto; width: 150px;
        }
        .cr-col-2{
            margin: 20px auto !important; width: 70%; text-align: center; font-size: 15px;
        }
        .cr-col-3{
            margin: 0px 0px !important;
        }
        .cr-col-4{
             margin: 20px auto !important; width: 70%; text-align: center; font-size: 15px;
        }
        .cr-table-p{
            font-size: 16px;
        }
        .cr-table-p img{
            display:none;
        }
        .cr-table-1{
            width: 100%; margin: 0;
        }
        .cr-table-2{
            width: 100%; margin: 0;
        }
    }
</style>

<?php include("templates/no-footer.php");?>