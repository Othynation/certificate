<?php require_once("autoload.php");
include("includes/functions.php"); 
$title='Hall Ticket'; $head='
<style type="text/css">
.form-box
    {
      -webkit-box-shadow: -1px 1px 5px 1px rgba(91,88,102,1);
-moz-box-shadow: -1px 1px 5px 1px rgba(91,88,102,1);
box-shadow: -1px 1px 5px 1px rgba(91,88,102,1);
padding: 40px ;
padding-bottom: 20px ;
    }
    .form_area
    {
        padding-bottom: 60px ;
    }
.success
{
    font-size:20px ;
} 
.text-red
                    {
                        color: red;
                        font-size: 12px;
                    }
                    #payment
{
    display:none;
}
@page { size: auto;  margin: 0mm;}
@media print {
    a[href]:after {
        content: none !important;
    }
}
.hcol
{
    font-weight:600;
     font-size:22px;
}
.hcol2
{
     font-size:18px;
     text-transform: uppercase;
       
}
.hcol3
{
     font-size:18px;
     width   : 200px;
  height  : 50px;   
  position: relative;
  z-index : 1;

     
}

@media print {
        #printbtn {
        display: none !important;
    }

    #header {
       display: none !important;
    }
    #footer {
       display: none !important;
    }
    #link
    {
      display: none !important;
    }
      #find
    {
      display: none !important;
    }

    #title
    {
      display: none !important;
    }
     #bg
    {
      display: none !important;
    }
    .main-heading
    {
      font-size:30px !important;
    }
    

    .underline{
line-height: 27px !important;
 text-decoration-style: dotted !important;
}

}
.line2 {
    width: 97% !important;
    height: 1px !important;
    margin-left:150px !important;
    margin-bottom: 20px !important;
    background: rgb(204, 204, 204) !important;
}

    </style><script>

            setTimeout(function() {
    $(".alert-msg").fadeOut("fast");
     $(".alert-msg").text(""); 

}, 5000); 
          </script><script src="lib/js/examreg.js"></script>'; 

include("templates/head.php"); 
include("templates/header.php"); 
?>
<?php if(!isset($_SESSION['hall_ticket_enroll'])){ ?>
<div class="container">
    <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
                <span class="close">&times;</span>
          </div>
        </div>
        <div class="body_div2"></div>
        <div class="event-heading">
            <center><h2><b>Hall Ticket</b></h2></center>
        </div>
        <div class="container mt-3  main-div" style="border-radius:10px; margin-bottom: 132px; ">
            <div class="container mt-5">
                <style type="text/css">
                    .text-red
                    {
                        color: red;
                        font-size: 12px;
                    }
                </style>
                <div class="row form_area" >
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
    <div class="form-box">
        <?php 
        if(isset($_POST['submit']))
        {
             $reg_no=$_POST['reg_no']; 
            $count=$getCredit->count_for_hallticket($reg_no);
            if($count==0)
            {
               $msg='<div class="text-red alert-msg" style="text-align:center;">No record found.Please enter correct details .</div>';
            }
            else 
            {
                $_SESSION['hall_ticket_enroll']=$reg_no;
               header("location:hall-ticket.php"); 
            }
        }
        ?> 
         <?php if(isset($msg))
        {
            echo  $msg;
        }  ?>
        <form action="" method="POST">
            
        <div class="row">
         
            <div class="col-sm-6" style="padding-top: 5px;">
               <label>ENROLLMENT NO:-</label> </div>
             <div class="col-sm-6"><input type="text" name="reg_no"class="form-control" value="<?php if(isset($reg_no)){echo $reg_no;} ?>" required></div>
        </div>

        <div class="row"> 
            <div class="col-sm-6"></div>
             <div class="col-sm-6"><input type="submit" name="submit" class="btn btn-primary" value="Get Hall Ticket"></div>
        </div>
    </form>
 <br> 
 <br>  <br>  <br> 
  <p> <strong>Note:-</strong> Please enter your enrollment number.</p>
 </div>
   
        </div>
         <div class="col-sm-3">
        </div>
        </div>
                
    </div>
</div>

</div>
<?php } else { 

    $id=$_SESSION['hall_ticket_enroll'];
    $rows=$getCredit->getexamdetails_by_enroll($id); 
    foreach($rows as $row)
    {
   $status=$row['exam_status'];
     $reg_id=$row['reg_id'];
     $namef=$row['namef'];
      $namel=$row['namel'];    $fname=$row['fname'];    $image=$row['image']; $reg_no=$row['reg_no']; $course=$row['course'];
      $institute=$row['institute'];

    }
    if($status==0)
    {?> 

     
        <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
                <span class="close">&times;</span>
          </div>
        </div>
        <div class="body_div2"></div>
        <div class="event-heading">
            
            <center><h2><b></b></h2></center>
        </div>
        <div class="container">
        <div class="row" style="height:528px;">
            <div class="col-sm-4"> </div>
             <div class="col-sm-4" style="background:#f7f7f7;border: 1px solid #dad1d1;"><p>Sorry,Your exam registration is under processing. </p></div>
              <div class="col-sm-4"> </div>

        </div>
    </div>


    <?php
    unset($_SESSION['hall_ticket_enroll']);
     }
    else if($status==3)
    {?>

        <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
                <span class="close">&times;</span>
          </div>
        </div>
        <div class="body_div2"></div>
        <div class="event-heading">
            
            <center><h2><b></b></h2></center>
        </div>
        <div class="container">
        <div class="row" style="height:528px;">
            <div class="col-sm-4"> </div>
             <div class="col-sm-4" style="background:#f7f7f7;border: 1px solid #dad1d1;"><p>Sorry, you are unable to proceed. We reviewed your exam registration form and found the issue. Your exam registration has been failed.</p></div>
              <div class="col-sm-4"> </div>

        </div>
    </div>
    <?php
     unset($_SESSION['hall_ticket_enroll']);
     }
    else {

    $rowm=$getCredit->fetch_all('pmore','id','ASC');
foreach($rowm as $ro)
{
$qrcode=$ro['iso'];
$sidelogo=$ro['certified'];
$signature=$ro['signature'];
$stamp=$ro['stamp'];
}

    ?>
<div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
                <span class="close">&times;</span>
          </div>
        </div>
        <div class="container mt-3  main-div" style="border-radius:10px; margin-bottom: 80px; ">
            <div class="container mt-5">
                <br>
                <div class="row" style="border:2px solid #9d9797;">
                    <div class="col-sm-1">
                    </div>
                        <div class="col-sm-10">
                            <?php 
                            $rows=$getCredit->getexamdetails_by_enroll($id); 
                            foreach($rows as $row){
                            ?>

                                <table style="width: 100%;">
                <tr>
                    <td style="width:33%;"><img src="assets/image/<?php echo $logo;?>" class="img-responsive img-center"></td>
                    <td style="width:33%;">
                        <h3 style="font-weight:700;text-decoration: underline; text-align:center;margin-top: 100px;">HALL TICKET</h3>
                    </td>
                     <td style="width:33%;">
                     <?Php if($sidelogo!=''){?>
                        <img src="assets/images/<?php echo $sidelogo;?>" class="img-responsive img-center" style="height: 150px;float: right;">
                     <?php }?>
                    </td>
                </tr>
                <tr>
                <td colspan="3">
                      <br><br>
                    <table width="100%">
                         <tr>
                             <td style="width:80%;">
                                <table border="0" width="100%">
                                    <tr>
                                        <td style="width:45%"><p class="hcol">Annual Session:</p></td>
                                        <td><p class="hcol2"><strong><?php echo $row['session'];?></strong></p></td>
                                    </tr>
                                    <tr style="line-height: 2px;">
                                        <td colspan="2" style="height: 14px"><div class="line2"></div></td>
                                    </tr>
                                    <tr>
                                        <td style="width:45%"><p class="hcol">Name Of Student:</p></td>
                                        <td><p class="hcol2"><?php echo $row['namef'].' '.$row['namel'];?></p></td>
                                    </tr>
                                     <tr style="line-height: 2px;">
                                        <td colspan="2" style="height: 14px"><div class="line2"></div></td>
                                    </tr>
                                     <tr>
                                        <td style="width:100%" colspan="2"><p class="hcol">Father Name: <span class="hcol2" style="font-weight:100;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['fname'];?></span></p> </td>
                                        
                                    </tr>
                                      <tr style="line-height: 2px;">
                                        <td colspan="2" style="height: 14px"><div class="line2"></div></td>
                                    </tr>
                                      <tr>
                                        <td style="width:50%"><p class="hcol">Enrollment No.: <span class="hcol3" style="font-weight:700; font-size: 16px;"><?php echo $row['reg_no'];?></span></p> </td>
                                        <td style="width:50%"><p class="hcol">Institute Code: <span class="hcol3" style="font-weight:400;"><?php echo $row['institute_code'];?></span></p> </td>
                                        
                                    </tr>
                                      <tr style="line-height: 2px;">
                                        <td colspan="2" style="height: 14px"><div class="line2"></div></td>
                                    </tr>
                                     <tr>
                                        <td style="width:100%" colspan="2"><p class="hcol">Course Name: <span class="hcol2" style="font-weight:100;">&nbsp;<?php echo $row['course'];?></span></p> </td>
                                        
                                    </tr>
                                      <tr style="line-height: 2px;">
                                        <td colspan="2" style="height: 14px"><div class="line2"></div></td>
                                    </tr>
                                      <tr>
                                        <td style="width:100%" colspan="2"><p class="hcol">Institute Name: <span class="hcol2" style="font-weight:100;">&nbsp;<?php echo $row['institute'];?></span></p> </td>
                                        
                                    </tr>
                                      <tr style="line-height: 2px;">
                                        <td colspan="2" style="height: 14px"><div class="line2"></div></td>
                                    </tr>


                                </table>
                                 
                             </td>
                              <td style="width:20%"> <img src="admin/uploads/<?php echo $row['image'];?>" height="150" width="150" style="margin-top:-90px;"> 
                                <img src="assets/images/<?php echo $stamp;?>" height="130" width="130">
                              </td>

                         </tr>

                    </table>
                    <table style="width:100%;">
                         <tr>
                             <td >  <img src="assets/images/<?php echo $signature;?>" class="img-responsive" style="height: 100px; width: auto">
                                <p class="hcol" style="margin-top:-15px">Authorized Sig.</p>
                             </td>
                              <td> 
                                <p  class="img-responsive" style="height: 100px; width: auto;">
                                 <p class="hcol" style="text-align: right;margin-top:-15px;">Signature Of Student</p>
                              </td>
                         </tr>
                    </table>
                </td>
                </tr>
                

            </table>
        <?php } ?>
                    </div>
                        <div class="col-sm-1">
                    </div>
                </div>
                 <center><img src="assets/image/print-ico-in.png" id="printbtn" onclick="window.print()" style="cursor:pointer;"></center>
                <br><br>
                 <center><a href="logout2.php" id="find">Find more Hall Ticket</a></center>
        
    </div>
</div>


<?php } }  ?>
<?php include("templates/footer.php");