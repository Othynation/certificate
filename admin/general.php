<?php  require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}}
?>
<?php include("header.php");
if($postm!='admin'){header("location:index");exit();}
 ?>

                <?php include("sidebar.php"); ?>
        <!-- /top navigation -->

        <!-- page content -->
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>General Details </h3>
              </div>
              <div class="title_right">
                
              </div>
            </div>

            <div class="clearfix"></div>

        

             <div class="row">
              <!-- form input mask -->
       

              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                   
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
<?php

              $id="1";
               $rows=$getCredit->get_by_id('general',$id,1); 
     foreach($rows as $row)
     {
       $oldlogo=$row['logo'];  
        $oldlogo_bg=$row['fav']; 
     }
    if(isset($_POST['submit'])){

        //collect form data
        extract($_POST);

    $image_temp=$_FILES['logo']['tmp_name'];
     $folder ="../assets/image/"; 
$logo = $_FILES['logo']['name'];

  $path = $folder . $logo ; 
   $target_file=$folder.basename($_FILES["logo"]["name"]);
    $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
    
    if ($_FILES["logo"]["size"] > 500000) {
   $error[] = 'Sorry, your image is too large. Upload less than 500 KB in size . Suggestion 200X200.';
 
}
  if($image_temp != "")
  {
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "GIF" && $imageFileType != "JPEG") {
    
   $error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
}
}


// Result bg 
$image_temp_bg=$_FILES['logob']['tmp_name'];
$logo_bg = $_FILES['logob']['name'];
 $path2 = $folder . $logo_bg; 
   $target_file=$folder.basename($_FILES["logob"]["name"]);
    $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
    
  if($image_temp_bg!="")
  {
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "PNG" && $imageFileType != "JPG" && $imageFileType != "GIF" && $imageFileType != "JPEG" && $imageFileType != "ico" && $imageFileType != "ICO") {
    
   $error[] = 'Result bg : Sorry, only JPG, JPEG, PNG & GIF files are allowed';
    
    
}

}  
  
        if(!isset($error)){
            $id='1';
               $stmt = $getOption->update_general($web_title,$web_path,$web_url,$web_desc,$web_tags,$contact_email,$from_email,'','',$currency,$reg,$id);

                    if($image_temp != "")
                { 
unlink($folder.$oldlogo);
  move_uploaded_file( $_FILES['logo'] ['tmp_name'], $path); 
   
   $stmt = $getOption->update_general($web_title,$web_path,$web_url,$web_desc,$web_tags,$contact_email,$from_email,$logo,'',$currency,$reg,$id);


                }
                       if($image_temp_bg!="")
                { 
unlink($folder.$oldlogo_bg);
    move_uploaded_file($_FILES['logob'] ['tmp_name'], $path2); 
    $stmt = $getOption->update_general($web_title,$web_path,$web_url,$web_desc,$web_tags,$contact_email,$from_email,'',$logo_bg,$currency,$reg,$id);


                }


      if($stmt){ //redirect to users page 
            header("location:general.php?saved=1"); 
                 }
               

        }

    }

    ?>


    <?php
    //check for any errors
    if(isset($error)){
        foreach($error as $error){
            echo '<div class="errormsg">'.$error.'</div><br />';
        }
    }

     $rows=$getCredit->get_by_id('general',$id,1); 
     foreach($rows as $row)
     {
        $web_title=$row['web_title'];
        $web_path=$row['web_path']; 
        $web_url=$row['web_url']; 
        $logo=$row['logo'];  
        $fav=$row['fav']; 
        $web_desc=$row['web_desc']; 
        $web_tags=$row['web_tags']; 
        $contact_email=$row['contact_email']; 
        $from_email=$row['from_email'];
        $currency=$row['currency'];
        $reg=$row['reg'];
     }

    ?>

  <?php if(isset($_GET['saved'])) { 
          echo '<div class="success"> Saved </div>';
  }?> 
  <div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
     <form action='' method='post' enctype='multipart/form-data'>
  
<div class="col-md-12 col-sm-12 ">
   <input type='hidden' name='id' value='<?php echo $row['id'];?>'> 

      <label>ORG Title(Certificate)  </label>

        <input type='text' name='web_title' class="form-control" value='<?php echo $web_title;?>'> 
        <small> Title for your certificate , your org title</small>
      </div>
<div class="col-md-12 col-sm-12 ">
        <label>Website </label>
        <input type='text' name='web_url' class="form-control" value='<?php echo $web_url; ?>'> 

         <small>Web address on certificate</small>
      <br>  
</div>

<div class="col-md-12 col-sm-12 ">
        <label>Path </label>
        <input type='text' name='web_path' class="form-control" value='<?php echo $web_path; ?>'>
        <small>Path for source like - example.com/ or example.com/results/  .. Must include / forward slash at the end of path url  </small>
  <br>
</div>
<br>

 <div class="clearfix"></div>
 <div style="border:5px solid #0066c3 ;border-style: dotted; padding: 10px;">
    <div class="form-group">
    <label for="exampleInputEmail1">Website Logo </label>
    <img src="../assets/image/<?php echo $logo; ?>" class="imgavt" alt="Logo" style="width:100px;">
    <br>
<label for="exampleInputEmail1">Change Logo </label>
    <input type="file" name="logo" class="form-control" value="Change Logo" id="exampleInputEmail1">
   
  </div>
</div>
<br>
<div style="border:5px solid #0066c3 ;border-style: dotted; padding: 10px;">
  <div class="form-group">
    <label for="exampleInputEmail1">Favicon </label>
    <img src="../assets/image/<?php echo $fav;?>" class="imgavt" alt="Bg" style="width:64px;">
    <br>
<label for="exampleInputEmail1">Change Favicon</label>
    <input type="file" name="logob" class="form-control">
   
  </div>
</div>

<div class="col-md-12 col-sm-12 ">
     
        <input type='hidden' name='reg' class="form-control" value='<?php echo $reg; ?>'> 

        
      <br>  
</div>

<div class="col-md-12 col-sm-12 ">
   <input type='hidden' name='id' value='1'> 
      <!-- <label>Website Email </label> -->

        <input type='text' name='from_email' class="form-control" value='<?php echo $from_email;?>'> 
        <small> Email for password reset . Example - no-reply@yoursite.com</small>
      </div>
      
      <div class="col-md-12 col-sm-12 ">
   <input type='hidden' name='id' value='1'> 
      <!-- <label> Email id and  website or phone no on certificate</label> -->

        <input type='hidden' name='contact_email' class="form-control" value='<?php echo $contact_email;?>'> 
      </div>

<div class="col-md-12 col-sm-12 ">
        <!-- <label>Address</label> -->
        <input type='hidden' name='web_desc' class="form-control" value='<?php echo $web_desc; ?>'> 
      <!-- <small>Address on Certificate</small> -->
 <br>
</div>

<div class="col-md-12 col-sm-12 ">
   <input type='hidden' name='id' value='1'> 
      <!-- <label>Registration id starting alphabets </label> -->

        <input type='hidden' name='currency' class="form-control" value='<?php echo $currency;?>'> 
        <!-- <small>Alphabets like- TS , MYCMP, MYINS any org related short form.</small> -->

      </div>
      <div class="col-md-12 col-sm-12 ">
   <input type='hidden' name='id' value='1'> 
      <!-- <label>Registration starts from the numbers </label> -->

        <input type='hidden' name='web_tags' class="form-control" value='<?php echo $web_tags;?>'> 
        <!-- <small>Registration nuber will be started from given numbers above. </small> -->

      </div>

      <br> 

        <div class="col-md-12 col-sm-12 ">
        <input type='submit' class="btn plan-button" name='submit' value='Save'>
      </div>

    </form>
    </div>
    <div class="col-sm-2">
    </div>

  </div>
    
               </div>
</div>


                      </div>
                    </div>

        <!-- /page content -->

        <!-- footer content -->
                <?php include("footer.php"); ?>