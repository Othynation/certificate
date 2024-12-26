<?php require_once("../autoload.php"); 
if($getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:index");}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Password Reset </title>

    <!-- Bootstrap -->
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!--<link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">-->
    <link href="assets/awesome/style.css" rel="stylesheet">
  
    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet">
        <link href="assets/css/custom.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
         
     <?php 
if(isset($_POST['set_forgo'])){ 
  $password=$_POST['password']; 
$passwordConfirm=$_POST['passwordConfirm']; 
 $error=$getCredit->validate_set_pass($password,$passwordConfirm,$_GET['token']); 
 if($error==NULL)
  { 
$result=$getCredit->update_set_pass($password,$_GET['token']);
if($result){ 
   $success='<div class="success">Your password has been updated successfully...';
  $hide_form=1; 
  }
  else 
    { 
   $error[]='Something went wrong..'; 
    }
}
}

?>
     
<?php 
if(isset($success))
  { 
 echo $success;
  }
if(!isset($hide_form)) { ?> 
         <form action="" method="POST" class="form">
              <h1>Reset Password </h1>

              <?php 
if(isset($error)){
        foreach($error as $error){
            echo '<div class="errormsg">'.$error.'</div><br />';
        }
    }

              ?>
              <div class="col-md-12 col-sm-12 ">
          

                <form method="POST" action="">
        <label>Password</label>
        <input type='password' name='password' class="form-control" value='<?php if(isset($error)){ echo $_POST['password'];}?>' required>
</div>
<div class="col-md-12 col-sm-12 ">
        <label>Confirm Password</label>
        <input type='password' name='passwordConfirm' class="form-control" value='<?php if(isset($error)){ echo $_POST['passwordConfirm'];}?>' required>
</div>

              <div>
              
                <button class="btn btn-primary" name="set_forgo">Submit</button>

                <!--<a class="reset-pass.php" href="#">Lost your password?</a>-->
              </div>

              <div class="clearfix"></div>

             
            </form>
          <?php } ?> 
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
