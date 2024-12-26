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

    <title>Forgot Password </title>

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
        <div class="admin-logo" style="text-align: center;">
            <a href="/admin"><img src="assets/images/logo.png" width="200"/></a>
        </div>
 
         <form action="" method="POST" class="form">
              <h1>Forgot Password</h1>
      <?php 
if(isset($_POST['submitforgot'])){ 
$login_var=trim($_POST['login']);
$error=$getUser->user_forgot_check($login_var);
if($error==NULL)
{
    $row=$getUser->get_user_details($login_var);
    $db_email=$row['email'];
     $error=$getCredit->insert_token($db_email);
     if($error==NULL)
     {
       $hide=1;
     }


}
}
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?> 
<?php if(!isset($hide)) {?>
              <div class="form-group">
                <input type="text" name="login" class="form-control" placeholder="Username or Email" value="<?php if(isset($error)){ echo $login_var; } ?>"" required="" />
              </div>
             
              <div class="form-group">
              
                <button class="btn btn-primary" name="submitforgot">Submit </button>
              </div>

              <div class="clearfix"></div>

             <?php } else {
echo "<div class='success'>Reset link has been sent to your registered email id . Kindly check your email. It can be taken 1 to 2 minutes to deliver on your email id . May be in your spam folder...</div>"; 
             } ?> 
            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
