<?php require_once("autoload.php");
include("includes/functions.php"); 
$title='Exam Registration'; $head='
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

    </style><script>

            setTimeout(function() {
    $(".alert-msg").fadeOut("fast");
     $(".alert-msg").text(""); 

}, 5000); 
          </script><script src="lib/js/examreg.js"></script>'; 

include("templates/head.php"); 
include("templates/header.php"); 
?>
<?php if(!isset($_SESSION['start'])){ ?>
<div class="container">
    <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
                <span class="close">&times;</span>
          </div>
        </div>
        <div class="body_div2"></div>
        <div class="event-heading">
            <center><h2><b>Exam Regisgration</b></h2></center>
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
            $count=$getCredit->count_by_id('pregistrations','reg_no',$reg_no);
            if($count==0)
            {
               $msg='<div class="text-red alert-msg" style="text-align:center;">No record found.Please enter correct details .</div>';
            }
            else 
            {
                $_SESSION['start']=$reg_no;
               header("location:exam-registration.php"); 
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
             <div class="col-sm-6"><input type="submit" name="submit" class="btn btn-primary" value="Start Registration"></div>
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

   $rid=$_SESSION['start'];
    $rows=$getCredit->get_by_string('pregistrations','reg_no',$rid); 
    foreach($rows as $row)
    {
    $status=$row['status'];
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
             <div class="col-sm-4" style="background:#f7f7f7;border: 1px solid #dad1d1;"><p>Sorry, you are unable to proceed. Your registration is under processing. </p></div>
              <div class="col-sm-4"> </div>

        </div>
    </div>


    <?php 
    unset($_SESSION['start']);
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
             <div class="col-sm-4" style="background:#f7f7f7;border: 1px solid #dad1d1;"><p>Sorry, you are unable to proceed. We reviewed your registration form and found the issue. Your registration has been failed.</p></div>
              <div class="col-sm-4"> </div>

        </div>
    </div>
    <?php
     unset($_SESSION['start']);
     }
    else {
$count=$getCredit->count_by_id('pexam','reg_id',$reg_id); 
if($count==1)
{
 ?>
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
             <div class="col-sm-4" style="background:#f7f7f7;border: 1px solid #dad1d1;"><p>You have already submitted exam form.</p></div>
              <div class="col-sm-4"> </div>

        </div>
    </div>
 <?php  
 unset($_SESSION['start']);  
}
else {
    $rowm=$getCredit->fetch_all('pmore','id','ASC');
foreach($rowm as $ro)
{
$qrcode=$ro['iso'];
}
    ?>
<div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
                <span class="close">&times;</span>
          </div>
        </div>
        <div class="body_div2"></div>
        <div class="event-heading">
            
            <center><h2><b>Exam Registration Form</b></h2></center>

        </div>
         <p style="text-align:center;"><?php echo $getCredit->get_option_value('register_note'); ?> </p>
         <div class="container">
            <div class="row">
                <div class="col-md-12"><a href="logout.php" style="float:right;color: red; font-weight: 700;">Logout</a></div>
                    </div>
         </div>
         <hr>
        <div class="container mt-3  main-div" style="border-radius:10px; margin-bottom: 80px; ">
            <div class="container mt-5">
                
                <form  id="user_form"  method="post" enctype="multipart/form-data">


            <div class="form-group">
                <div class="row">
                    <div class="col-md-2" style="margin-top:100px;">
                    <label for="">Full name<span id="red">*</span>:</label>
                    
                    </div>
                    <div class="col-md-3 image_div_col" style="margin-top:100px;">
                         <input type="text" name="name" id="name"  class="form-control" value="<?php echo $namef.' '.$namel;?>" disabled>
                    </div>
                     <div class="col-md-2" style="margin-top:100px;">
                    <label for="">Father Name<span id="red">*</span>:</label>
                    
                    </div>
                     <div class="col-md-3 image_div_col" style="margin-top:100px;">
                         <input type="text" name="name" id="name"  class="form-control" value="<?php echo $fname ;?>" disabled>
                    </div>
                    <div class="col-md-2">
                        
                        <div id="photo">
                            <img src="admin/uploads/<?php echo $image;?>" height="150" width="150" class="border border-dark" id="img1">
                        </div>
                
                                <div class="text-red alert-msg" id="imagee"> </div>
                            </div>

                    
                    </div>
                </div>
                   
                    <div class="line-all">
                    </div>
                  
                    <div class="form-group">
                        <div class="row">
                            
                      <div class="col-md-3">
                            <label for="">Annual Session<span id="red">*</span>:</label>
                            
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="session" id="session" >
                                        <option value="">Select Session</option>
                                        <?php 
                            $qualification=$getCredit->get_option_value('session');
                            $arrs=explode(',',$qualification); 
                            foreach($arrs as $arr)
                            {
                            echo '<option value="'.$arr.'">'.$arr.'</option>';  
                            }
                            ?>
                                        
                                </select>
                                <div class="text-red alert-msg" id="sessione"> </div>
                            </div>

                            <div class="col-md-3">
                                <label for="">Enrollment No.<span id="red">*</span>:</label>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="enrollment" id="enrollment" value="<?php echo $reg_no;?>" class="form-control" disabled>
                                <div class="text-red alert-msg" id="enrollmente"> </div>
                            </div>

                        </div>
                    </div>
                    <div class="line-all">
                    </div>
                    <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Institute Code<span id="red">*</span>:</label>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="institute_code" id="institute_code"  class="form-control" placeholder="Institute Code">
                        <div class="text-red alert-msg" id="institute_codee"> </div>
                    </div>
                    <div class="col-md-3">
                        <label for="">Course Name<span id="red">*</span>:</label>

                    </div>

                    <div class="col-md-3">
                        <input type="text" name="course" id="course"  class="form-control" value="<?php echo $course;?>" / disabled>
                        <div class="text-red alert-msg" id="coursee"> </div>
                    </div>
                </div>
            </div>
                   
            <div class="line-all">
            </div>
             <div class="form-group">
                <div class="row">
                  
                    <div class="col-md-3">
                        <label for="">Institute Name<span id="red">*</span>:</label>

                    </div>

                    <div class="col-md-9">
                        <input type="text" name="institute_name" id="institute_name"  class="form-control" placeholder="Institute Name" value="<?php echo $institute;?>" disabled/>
                        <div class="text-red alert-msg" id="institute_namee"> </div>
                    </div>
                </div>
            </div>
              <div class="line-all">
            </div>

           
            <div class="form-group">
    

                <div class="row">
                              
                     

                    <div class="col-md-3">
                            <label for="">Exam Fee<span id="red">*</span>:</label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="exam_fee" id="exam_fee">
                                        <option value="">Select Fee</option>
                                                    <?php 
                            $course_durations=$getCredit->get_option_value('exam_fees');
                            $arrs=explode(',',$course_durations); 
                            foreach($arrs as $arr)
                            {
                            echo '<option value="'.$arr.'">'.$arr.'</option>';  
                            }
                            ?>
                                </select>
                                <div class="text-red alert-msg" id="exam_feee"> </div>
                            </div>

                    
                </div>
            </div>
            <div class="line-all">
            </div>
            
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div id="payment" style="border: 3px solid #6739b7;padding: 5px;">
                    <h3>Scan Below QrCode to Pay Fees and Submit Transaction Id:</h3>
                    <hr>
                    <h4>Amount of course duration: <span id="amount"></span></h4>
                    <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Transaction Id<span id="red">*</span>:</label>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="txnid" id="txnid" class="form-control" placeholder="Txn ID">
                        <div class="text-red alert-msg" id="txnide"> </div>
                    </div>
                
                </div>
            </div>
             <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
            <img src="assets/images/<?php echo $qrcode;?>" class="img-responsive" style="height:200px;">
        </div>
        <div class="col-sm-4">
        </div>
        </div>
        <h5 style="text-align:center;">UPI/VPA: <br><strong><?php echo $getCredit->get_option_value('upi_id');?></strong></h5>

                </div>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
            <div class="form-group">
                <input type="checkbox" id="vehicle1" checked disabled>
            <label for="vehicle1">The responsibility of the information sent by the correspondent will be on the correspondent himself. No information will be published without evidence.</label>
                <p class="text-red" id="message"></p>
                <center><button type="submit" id="submit" class="btn btn-grad sub-btn pl-4 pr-4 pt-2 pb-2 mb-2" name="button">Submit</button></center>
            </div>
        </form>
    </div>
</div>
<script language="javascript">
    print_state("sts");
</script>
<script type="text/javascript">
    $(document).on('change','#drop',change);
        function change(){
        var id_val = $(this).val();
        $('.verify_id').text(id_val);
    }
    
</script>
<script>

</script>
<script type="text/javascript">
$(document).ready(function(){
$('#agent-home').click(function(){
window.location.href="login.html";
});
});
</script>
<script type="text/javascript">

function preview(){
    $('.preview').html(
        `
        <style>
        .image_preview{
         position: fixed;
         top: 50%;
         left: 50%;
         transform:translate(-50%,-50%);
         height: 500px;
         width: 360px;
         background: #fff;
         box-shadow: 0px 0px 5px 1px lightgray;
         border-radius: 10px;
         z-index: 999;
         overflow: hidden;
         display: none;
     }
     .image_preview div{
         height: 100%;
         width: 100%;
         position: relative;

     }
     .image_preview img{
         width: 90%;
         height: auto;
         position: absolute;
         top: 50%;
         left: 50%;
         transform:translate(-50%,-50%);
         z-index: 999999999;
     }
     .image_preview p{
         padding: 10px;
         background: #e62e25;
         text-align: center;
         color: #fff;
         font-size: 20px;
         transition: .3s;
         cursor: pointer;
     }
     img{
         cursor: pointer;
     }
     .image_preview p:hover{
         background: #e8524a;
         transition: .3s;
     }
        </style>
        <div class="image_preview">
         <div class="">
             <p id="preview_cancel">Cancel</p>
             <img src="complain_img/Screenshot (2)_0412022140228.png" alt="">
         </div>
     </div>
        `
    );
    $(document).on('click','img',function(){
        var src = $(this).attr('src');
        $('.image_preview img').attr('src',src);
        $('.image_preview').css('display','block');
    })
    $(document).on('click','#preview_cancel',function(){
     $('.image_preview').css('display','none');
 })
}
preview();
$(document).on('change','input[type=file]',function(event){
    var id = $(this).attr('data-id');
    var img = document.getElementById(`${id}`);
    var reader = new FileReader();
     reader.onload = function(){
         img.src = reader.result;
     };
     reader.readAsDataURL(event.target.files[0]);
})



</script>

<?php } } } ?>
<?php include("templates/footer.php");