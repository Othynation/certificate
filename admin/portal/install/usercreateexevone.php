<!DOCTYPE html>
<html lang="en">
<head>
  <title>Install </title>
  <meta charset="utf-8">
  <meta name="description" content="">    
<meta name="keywords" content="">

   <link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet" />
 <link href="../admin/assets/css/custom.css" rel="stylesheet" />
  <link href="../admin/assets/css/custom.min.css" rel="stylesheet" />
 <style type="text/css">
  body {
  background: #f1f1f1;
    font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif,  Open Sans;
    
}
.login-box{
   
    margin-top: 4%;
    border: 1px solid #ccd0d4;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    background: white;
    padding: 20px;
}


</style>

</head>


<body>
<?php 
ini_set('display_errors', 0);
require_once("../autoload.php");
if($getCredit->tableExists('ts_gtw_users'))
    { 
$nRowscl = $getCredit->count('ts_gtw_users');
if($nRowscl>0) 
  { 
header("location:../admin/login");
  }
  else
    { 
      
       ?> 
                  <?php 

                        if(isset($_POST['adduser'])){
                            extract($_POST);
                             if(strlen($fname)<3){ // Minimum 
            $error[] = 'Please enter First Name using 3 charaters atleast.';
        }
if(strlen($fname)>20){  // Max 
            $error[] = 'First Name: Max length 20 Characters Not allowed';
        }
  if(!preg_match("/^[A-Za-z _]*[A-Za-z ]+[A-Za-z _]*$/", $fname)){
            $error[] = 'Invalid Entry First Name. Please Enter letters without any Digit or special symbols like ( 1,2,3#,$,%,&,*,!,~,`,^,-,)';

              }    

              if(strlen($lname)<3){ // Minimum 
            $error[] = 'Please enter Last Name using 3 charaters atleast.';
        }
if(strlen($lname)>20){  // Max 
            $error[] = 'Last Name: Max length 20 Characters Not allowed';
        }
  if(!preg_match("/^[A-Za-z _]*[A-Za-z ]+[A-Za-z _]*$/", $lname)){
            $error[] = 'Invalid Entry Last Name. Please Enter letters without any Digit or special symbols like ( 1,2,3#,$,%,&,*,!,~,`,^,-,)';

              }    
              if(strlen($username)<3){ // Change Minimum Lenghth   
            $error[] = 'Please enter Username using 3 charaters atleast.';
        }
  if(strlen($username)>50){ // Change Max Length 
            $error[] = 'Username : Max length 50 Characters Not allowed';
        }
  if(!preg_match("/^[A-Za-z0-9 _]*[A-Za-z]+[A-Za-z0-9 _]*$/", $username)){
            $error[] = 'Invalid Entry for username. Please Enter letters without any special symbols like ( #,$,%,&,*,!,~,`,^,-,';

              } 
if(strlen($email)>50){  // Max 
            $error[] = 'Email: Max length 50 Characters Not allowed';
        }



                            if($passwordConfirm ==''){
            $error[] = 'Please confirm the password.';
        }

        if($password != $passwordConfirm){
            $error[] = 'Passwords do not match.';
        }
          if(strlen($password)<5){ // min 
            $error[] = 'The password is 6 characters long.';
        }
        
         if(strlen($password)>20){ // Max 
            $error[] = 'Password: Max length 20 Characters Not allowed';
        }
         $hash = password_hash($password, PASSWORD_DEFAULT);

         if(!isset($error)){ 


            try {

                //insert into database
              $date=date('Y-m-d'); 
                $stmt = $db->prepare('INSERT INTO ts_gtw_users(fname,lname,username,password,email,date) VALUES (:fname,:lname,:username, :password, :email, :date)') ;
                $stmt->execute(array(
                    ':username' => $username,
                    ':password' => $hash,
                    ':email' => $email,
                      ':fname' => $fname,
                    ':lname' => $lname,
                    ':date' => $date
                ));

                //redirect to user page 
                      header("Location:../admin/login?allset=1");
        
            } catch(PDOException $e) {
          $error[] ='Failed : Something went wrong';
            }

                 }
                           } ?>




  <div class="container">

    <div style="row">
    <h1 style="text-align:center;">Create User </h1>

<div class="col-sm-3"></div>
<div class="col-sm-6 login-box" >
 <?php 
  if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errormsg">'.$error.'</p>'; 
}
}

?>

  <form action="" method="post">
    <div class="form-group">
    <label for="exampleInputEmail1">First Name </label>
    <input type="text" name="fname" value="<?php if(isset($error)){ echo $_POST['fname'];}?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First Name" required="">
   
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Last Name</label>
    <input type="text" name="lname" value="<?php if(isset($error)){ echo $_POST['lname'];}?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Last Name" required="">
    
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username"class="form-control" value="<?php if(isset($error)){ echo $_POST['username'];}?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" required="">
    
  </div>



  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" value="<?php if(isset($error)){ echo $_POST['email'];}?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required="">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password"  name="password" value="<?php if(isset($error)){ echo $_POST['password'];}?>" class="form-control" id="exampleInputPassword1" placeholder="Password" required="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" name="passwordConfirm" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password" required="">
  </div>

      <div class="form-row">
    <div class="form-group col-md-12">
    
      <center><input type="submit" name="adduser" class="btn btn-success"></center>
    </div>

 </form>
  </div>


<div class="col-sm-6">

</div>
</div>
<div class="col-sm-3"></div>


    </div>
  </div>
 <?php 
 

    }
} 
else{ 
 header("location:../install"); 
}
?> 



</body>
</html>