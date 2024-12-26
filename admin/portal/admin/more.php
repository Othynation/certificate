<?php  require_once("../autoload.php");
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login.php");}
?>
<?php include("header.php"); ?>

                <?php include("sidebar.php"); ?>
        <!-- /top navigation -->

        <!-- page content -->
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>More Settings</h3>
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
<?php

              $id="1";
             $rows=$getCredit->get_by_id('pmore','id',$id);
             foreach($rows as $row)
             {
                $oldimage=$row['watermark'];
              $oldimages=$row['signature'];
              $oldimagec=$row['certified'];
               $oldimagess=$row['stamp'];
               $oldimagei=$row['iso'];
             }
      
    //if form has been submitted process it
    if(isset($_POST['submit'])){

        //collect form data
        extract($_POST);
     $folder ="../assets/images/"; 
             $file = $_FILES['image']['tmp_name'];  
$file_name = $_FILES['image']['name']; 
$file_name_array = explode(".", $file_name); 
 $img_namee=$file_name_array[0]; 
 $img_name=$getCredit->slug($img_namee); 
 $extension = end($file_name_array);
 $new_image_name = 'watermark_'.rand() . '.' . $extension;
 //sig 
 $files = $_FILES['imagee']['tmp_name'];  
$file_names = $_FILES['imagee']['name']; 
$file_name_arrays = explode(".", $file_names); 
 $img_namees=$file_name_arrays[0]; 
 $img_names=$getCredit->slug($img_namees); 
 $extensions = end($file_name_arrays);
 $new_image_names = 'sign'.rand() . '.' . $extensions;
 //certifies
 $filess = $_FILES['imagess']['tmp_name'];  
$file_namess= $_FILES['imagess']['name']; 
$file_name_arrayss = explode(".", $file_namess); 
 $img_nameess=$file_name_arrayss[0]; 
 $img_namess=$getCredit->slug($img_nameess); 
 $extensionss = end($file_name_arrayss);
 $new_image_namess = 'stamp_'.rand() . '.' . $extensionss;
  //iso
 $filei = $_FILES['imagei']['tmp_name'];  
$file_namei= $_FILES['imagei']['name']; 
$file_name_arrayi = explode(".", $file_namei); 
 $img_nameei=$file_name_arrayi[0]; 
 $img_namei=$getCredit->slug($img_nameei); 
 $extensioni = end($file_name_arrayi);
 $new_image_namei = 'iso_'.rand() . '.' . $extensioni;

 //imagec 
 //iso
 $filec = $_FILES['imagec']['tmp_name'];  
$file_namec= $_FILES['imagec']['name']; 
$file_name_arrayc = explode(".", $file_namec); 
 $img_nameec=$file_name_arrayc[0]; 
 $img_namec=$getCredit->slug($img_nameec); 
 $extensionc = end($file_name_arrayc);
 $new_image_namec = 'certified_'.rand() . '.' . $extensionc;


if($file=='')
{
    $new_image_name=$oldimage;
}
if($files=='')
{
    $new_image_names=$oldimages;
}
if($filec=='')
{
    $new_image_namec=$oldimagec;
}
if($filess=='')
{
    $new_image_namess=$oldimagess;
}

if($filei=='')
{
    $new_image_namei=$oldimagei;
}


$result=$getCer->update_more($new_image_names,$new_image_name,$new_image_namec,$new_image_namess,$new_image_namei,$id); 
        if($result)
    {
     
      if($file!=''){
          unlink('../assets/images/'.$oldimage);
   
 move_uploaded_file($file, '../assets/images/' . $new_image_name); 
} 
if($files!=''){
   unlink('../assets/images/'.$oldimages);
 move_uploaded_file($files, '../assets/images/' . $new_image_names); 
} 
if($filec!=''){
   unlink('../assets/images/'.$oldimagec);
 move_uploaded_file($filec, '../assets/images/' .$new_image_namec); 
} 
if($filess!=''){
   unlink('../assets/images/'.$oldimagess);
 move_uploaded_file($filess, '../assets/images/' .$new_image_namess); 
} 
if($filei!=''){
   unlink('../assets/images/'.$oldimagei);
 move_uploaded_file($filei, '../assets/images/' .$new_image_namei); 
} 

header("location:more.php?saved=1");
          }

   
    else{
      $error[] ='Failed : Something went wrong';
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

       

    ?>

  <?php if(isset($_GET['saved'])) { 
          echo '<div class="success"> Saved </div>';
  }?> 
    <form action='' method='post' enctype='multipart/form-data'>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group" style="border:5px solid #33CC00 ;border-style: dotted; padding: 10px;">
    <label for="exampleInputEmail1">Header Banner</label>
 <?php if($row['watermark']!=''){?>
    <img src="../assets/images/<?php echo $row['watermark'];?>" class="imgavt" alt="Logo" style="width:100px;"> <a href="remove.php?image=<?php echo $row['watermark'];?>&to=more.php&folder=../assets/images/&table=pmore&id=1&col=watermark&colid=id" onClick='return confirm("Are you sure you want to remove?")' ><button class="btn btn-danger" type="button">Remove</button></a>
    <?php } else { ?> 
<img src="uploads/noimagecx.png" class="imgavt" alt="Logo" style="width:100px;">
    <?php } ?> 
    <br>
<label for="exampleInputEmail1">Change Header Banner </label>
    <input type="file" name="image" class="form-control" value="Change Logo">
   
  </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group" style="border:5px solid #33CC00 ;border-style: dotted; padding: 10px;">
                    <?php if($row['iso']!=''){?>
    <label for="exampleInputEmail1">OR CODE </label>
    <img src="../assets/images/<?php echo $row['iso'];?>" class="imgavt" alt="Logo" style="width:100px;">
    <a href="remove.php?image=<?php echo $row['iso'];?>&to=more.php&folder=../assets/images/&table=pmore&id=1&col=iso&colid=id" onClick='return confirm("Are you sure you want to remove?")' ><button class="btn btn-danger" type="button">Remove</button></a>
    <?php } else { ?> 
<img src="uploads/noimagecx.png" class="imgavt" alt="Logo" style="width:100px;">
    <?php } ?> 
   <br>

<label for="exampleInputEmail1">Change QR Code</label>
    <input type="file" name="imagei" class="form-control"  id="exampleInputEmail1">
   
  </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group" style="border:5px solid #33CC00 ;border-style: dotted;">
                    <?php if($row['certified']!=''){?>
    <label for="exampleInputEmail1">Hall Ticket Right side Logo</label>
    <img src="../assets/images/<?php echo $row['certified'];?>" class="imgavt" alt="Logo" style="width:100px;">
    <a href="remove.php?image=<?php echo $row['certified'];?>&to=more.php&folder=../assets/images/&table=pmore&id=1&col=certified&colid=id" onClick='return confirm("Are you sure you want to remove?")' ><button class="btn btn-danger" type="button">Remove</button></a>
    <?php } else { ?> 
<img src="uploads/noimagecx.png" class="imgavt" alt="Logo" style="width:100px;">
    <?php } ?> 
   
<br>
<label for="exampleInputEmail1">Change Hall Ticket Right side Logo</label>
    <input type="file" name="imagec" class="form-control"  id="exampleInputEmail1">
   
  </div>
              
            </div>

        </div>
 
<div class="row">
    <div class="col-sm-6">
        <div class="form-group" style="border:5px solid #33CC00 ;border-style: dotted;">
            <?php if($row['stamp']!=''){?>
    <label for="exampleInputEmail1">Stamp </label>
    <img src="../assets/images/<?php echo $row['stamp'];?>" class="imgavt" alt="Logo" style="width:100px;">
   <a href="remove.php?image=<?php echo $row['stamp'];?>&to=more.php&folder=../assets/images/&table=pmore&id=1&col=stamp&colid=id" onClick='return confirm("Are you sure you want to remove?")' ><button class="btn btn-danger" type="button">Remove</button></a>
    <?php } else { ?> 
<img src="uploads/noimagecx.png" class="imgavt" alt="Logo" style="width:100px;">
    <?php } ?> 
<br>
<label for="exampleInputEmail1">Change Stamp</label>
    <input type="file" name="imagess" class="form-control"  id="exampleInputEmail1">
   
  </div>

        
    </div>
     <div class="col-sm-6">
          <div class="form-group" style="border:5px solid #33CC00 ;border-style: dotted; padding: 10px;">
            <?php if($row['signature']!=''){?>
    <label for="exampleInputEmail1">Authority Signature</label>
    <img src="../assets/images/<?php echo $row['signature'];?>" class="imgavt" alt="Logo" style="width:100px;">
    <a href="remove.php?image=<?php echo $row['signature'];?>&to=more.php&folder=../assets/images/&table=pmore&id=1&col=signature&colid=id" onClick='return confirm("Are you sure you want to remove?")' ><button class="btn btn-danger" type="button">Remove</button></a>
    <?php } else { ?> 
<img src="uploads/noimagecx.png" class="imgavt" alt="Logo" style="width:100px;">
    <?php } ?> 

   <br>

<label for="exampleInputEmail1">Change Signature</label>
    <input type="file" name="imagee" class="form-control"  id="exampleInputEmail1">
   
  </div>

        
    </div>
</div>
  
  



        <div class="col-md-12 col-sm-12 ">
        <input type='submit' class="btn btn-success" name='submit' value='Save'>
      </div>

    </form>
               </div>
</div>


                      </div>
                    </div>

        <!-- /page content -->

        <!-- footer content -->
                <?php include("footer.php"); ?>