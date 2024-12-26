<?php require_once("../autoload.php");
if($getUser->admin_log_check(isset($_SESSION["user_post"]))){
  header("location:index.php");}
  ?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel </title>

    <!-- Bootstrap -->
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!--<link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">-->
    <link href="assets/awesome/style.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="assets/css/custom.min.css" rel="stylesheet">
        <link href="assets/css/custom.css" rel="stylesheet">
        <link href="assets/css/custom1.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php
    if(isset($_POST['submit'])){
        $loginu = trim($_POST['loginu']);
        $password = trim($_POST['password']);
         $check=$getUser->login_ts_val($loginu,$password);
        if($check){ 
            header('Location: index.php');
            exit;
        } else {
            $message = '<div class="errormsg">Invalid username or Password</div>'; 
             $loginuerr = trim($_POST['loginu']);
        }

    }
    if(isset($message)){ echo $message; }
    ?>
         <form action="" method="POST" class="form">
              <h1>Admin Login</h1>
             <?php if(isset($_GET['allset'])) {
              echo "<div class='success'><center> All Set </center></div>";
             } ?> 
                <input type="text" name="loginu" class="form-control" placeholder="Username or Email " value="<?php if(isset($loginuerr))
                {echo $loginuerr; }?>"required="" />
        
            
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
        
        
              
                <button class="btn btn-primary" name="submit">Log in</button>

                <a href="forgot-password">Lost your password?</a>
       

              <div class="clearfix"></div>

             
            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
