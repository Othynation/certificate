<!DOCTYPE html>
<html lang="en">
<head>
  <title>Install </title>
  <meta charset="utf-8">
  <meta name="description" content="">    
<meta name="keywords" content="">
<link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet" />
 <link href="../admin/assets/css/custom.min.css" rel="stylesheet" />
 <link href="../admin/assets/css/custom.css" rel="stylesheet" />
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
require_once "../includes/conscrmg.php";  // this is connect.php file 
try{ 
 $db = new PDO("mysql:host=".$DBHOST.";dbname=".$DBNAME, $DBUSER, $DBPASS); 
header("location:dbinstallingexe.php");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {

 ?> 

  <div class="container">

    <div style="row">
    <h1 style="text-align:center;">Install</h1>
      <hr>
<div class="col-sm-3"></div>
<div class="col-sm-6 login-box" >
  <?php if(isset($_GET['error'])){
  echo "<div class='errormsg'>Connection failed. Kindly check your host , username , database name and password...</div>";
} 

?>  
  <form action="installing.php" method="post">
    <div class="form-row">
    <div class="form-group col-md-12">
      <label >Database Host </label>
      <input type="text" name="dbhost" class="form-control" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label >Database Username </label>
      <input type="text" name="dbuser" class="form-control" required>
    </div>
  
   
  </div>

<div class="form-row">
    <div class="form-group col-md-12">
      <label >Database Name</label>
      <input type="text" name="dbname" class="form-control" required>
    </div>
  
   
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-12">
      <label >Password</label>
      <input type="password" name="dbpass" class="form-control">
    </div>
  
   
  </div>

      <div class="form-row">
    <div class="form-group col-md-12">
    
      <center><input type="submit" name="formsubone" class="btn btn-success"></center>
    </div>

 </form>
  </div>


<div class="col-sm-6">

</div>
</div>
<div class="col-sm-3"></div>


    </div>
  </div>
  
<?php }?>
</body>

</html>