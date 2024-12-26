<?php require_once("autoload.php");
include("includes/functions.php");
?>
<!DOCTYPE html>
<html>
<?php
$id=3;
$rowm=$getCredit->fetch_all('more','id','ASC');
foreach($rowm as $ro)
{
$watermark=$ro['watermark'];
$signature=$ro['signature'];
$iso=$ro['iso'];
$certified=$ro['certified'];
$stamp=$ro['stamp'];
}
  $color_code=$theme_color;

 if($color_code!='')
 {
  $color=$color_code;
 }
 else 
 {
  $color= '#1D6589';
 }

   

 $extra_head="<style>
  .address{
        color:".$color." !important;
    }
    .main-heading
    {
      font-size:35px !important;color:".$color." !important; text-shadow: 2px 0 ".$color." !important;
font-weight:bold !important; text-align:center;
    }
    .sub-heading{
      font-weight:bold !important;color:".$color." !important;
    }

    .email{
      color:".$color." !important;text-align: center !important;
    }
    .hrcls{
      background:".$color." !important; height: 2px !important;
    }
    .cno{
         font-weight:bold !important;color:".$color." !important;
    }
    .hcol{
        !important;color:".$color." !important;  font-style: italic !important;
    }
     .underline{
text-decoration-line: underline !important;
  text-decoration-style: dotted !important;  text-decoration-color: ".$color." !important;
   line-height:60px;


     }
    .value{
      font-size:20px !important;color:#000000 !important;
font-weight:bold !important; text-align:center !important; 
padding-left: 5px !important;
    }
    .heading-two
    {
      color: ".$color." !important; font-weight: bold !important; font-size: 40px !important;text-align: center !important;
    }
    .sub-heading-two
    {
      color: ".$color." !important; font-weight: bold !important; text-align: center !important; font-size: 25px
    }
    .main-container{
      background-image:url(assets/images/".$watermark.") !important;background-repeat:no-repeat !important; vertical-align:middle !important; background-size:cover !important;  -webkit-background-size: cover !important;
-moz-background-size: cover !important;
-o-background-size: cover !important;
background-size: cover !important;background-position:center !important; border: 20px solid ".$color." !important;

 -webkit-print-color-adjust: exact;
    }
       @media print {
        #printbtn {
        display: none !important;
    }

    #nav {
       display: none !important;
    }
    #footer {
       display: none !important;
    }
    #link
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
@page { size: auto;  margin: 0mm; margin-right: -65px; margin-left: -65px;}
@media print {
    a[href]:after {
        content: none !important;
    }
}


 
</style>";

?> 
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Print</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <?php echo $extra_head;?> 
</head>
<body>

<?php 
  
    $rows=$getCredit->rc($id);
foreach($rows as $row)
{
  $dep=$row['dep']; 
  $deps=$getCredit->get_by_id('dep','dep_id',$dep);
  foreach($deps as $dp) 
  {
    $dep_title=$dp['dep_title'];
  }

?>
<div class="container-fluid">
<div class="row">
     <div class="col-sm-1"></div>
      <div class="col-sm-10 main-container">

        <!--header--> 
         <div class="row" style="padding:10px;">
          <div class="col-2">

            <img src="assets/image/<?php echo $logo;?>" class="img-responsive img-center">
          </div>
           <div class="col">
          <?php if(strlen($webtitle)>1){?>
              <div class="main-heading"> <?php echo $webtitle;?></div>
            <?php } ?>
            <?php if(strlen($certificate_header_sub_heading)>1){?>
     <p class="sub-heading"> <?php echo $certificate_header_sub_heading;?></p>
   <?php } ?> 
           <?php if(strlen($certificate_header_address)>1){?>
      <div class="address"> <?php echo $certificate_header_address;?></div>
    <?php } ?> 
      <?php if(strlen($certificate_header_email)>1){?>
         <p class="email"> <?php echo $certificate_header_email;?></p>
       <?php } ?> 
          </div>
          <div class="col-sm-12">
            <hr class="hrcls"> 
          </div>
           <div class="col">
           <span class="cno"><?php echo $getCredit->get_option_value('certificate_no_text');?> </span> <span class="value underline"> <?php echo $row['cno'];?></span>
            <?php if($iso!=''){?>
                 <img src="assets/images/<?php echo $iso;?>" class="img-responsive" style="height: 60px; width: auto;">
               <?php } ?> 
          </div>
          <div class="col">

            <br> <br>
            <?php echo $getCredit->get_option_value('certificate_main_text');?> 
        </div>
         <div class="col">
          <br>
          <?php if($row['image']!='' OR $row['sign']!='')
          {?>
          <div style="text-align: right;">
                <div style="border: 1px solid black; height:202px; width: 145px; float: right;">
                    <?php if($row['image']!=''){?>
                  <img src="admin/uploads/<?php echo $row['image'];?>" height="150" widh="150">
                <?php } ?> 
                  <?php if($row['sign']!=''){?>
                  <img src="admin/uploads/<?php echo $row['sign'];?>" height="50" width="148"></div> <?php } ?> 
            </div>
          <?php } ?> 

         </div>
          <br>
          
          <div class="row">
            <div class="col" style="text-align:center;">
             <span class="hcol"><?php echo $getCredit->get_option_value('certificate_text_3');?>  </span> <span class="value underline"><?php echo $row['name'];?></span>
            </div>
            <div class="col-sm-12">
             <span class="hcol"><?php echo $getCredit->get_option_value('father_name_text');?> </span> <span class="value underline"><?php echo $row['fname'];?></span>
            </div>
             <div class="col-sm-12">
             <span class="hcol"><?php echo $getCredit->get_option_value('mother_name_text');?>  </span> <span class="value underline"><?php echo $row['mname'];?></span>
            </div>
            <div class="col">
             <span class="hcol"><?php echo $getCredit->get_option_value('certificate_text_6');?>  </span> <span class="value underline"> <?php echo $dep_title;?></span> <span class="hcol"> <?php echo $getCredit->get_option_value('certificate_text_7');?></span> <span class="value underline"><?php echo $row['duration'];?></span>
            </div>
            <div class="col-sm-12">
             <span class="hcol"><?php echo $getCredit->get_option_value('certificate_text_8');?> </span> <span class="value underline"><?php echo $row['grade'];?></span> <span class="hcol"><?php echo $getCredit->get_option_value('certificate_text_9');?> </span> <span class="value underline"><?php echo $row['year'];?></span>
            </div>
            <br> 
            <div class="row">
              <div class="col-sm-3">
              </div>
              <div class="col-sm-6">
                <br>
              <span class="hcol"><?php echo $getCredit->get_option_value('certificate_text_10');?></span>
              </div>
              <div class="col-sm-3">
              </div>

            </div>
             <div class="row">
              <div class="col-sm-3">
              </div>
              <div class="col-sm-6">
                <br>
              <span class="hcol"><?php echo $getCredit->get_option_value('certificate_text_11');?></span>
              </div>
              <div class="col-sm-3">
              </div>

            </div>
<div class="clearfix"></div>
  <div class="row">
 
              <div class="col-4">
                    <?php if($certified!=''){?>
                 <img src="assets/images/<?php echo $certified;?>" class="img-responsive" style="height: 100px; width: auto;">
               <?php } ?> 
              </div>
              <div class="col-4">
              <?php if($stamp!=''){?>
                   <div style="margin-left:-40px;">
                 <img src="assets/images/<?php echo $stamp;?>" class="img-responsive" style="height: 100px; width: auto;">
               </div>
             <?php } ?> 
              </div>
              <div class="col-4">
               <?php if($signature!=''){?>
             <div style="float: right;">
             <img src="assets/images/<?php echo $signature;?>" class="img-responsive"style="height: 100px; width: auto;"><br>
                <div class="hcol"><?php echo $getCredit->get_option_value('autority_sign_text');?></div>
              <?php } ?> 
              </div>
              </div>

            </div>


          </div>



         </div>

          <!--End header--> 
          <!--cno--> 
          <div class="row">

          </div>
          <!--cno edn --> 


</div>
     <div class="col-sm-1"></div>

  </div>
<?php } ?> 
  <br>
</div>
</body>
</html>
