<!DOCTYPE html>
<html lang="en">
<head>
  <title>Install </title>
  <meta charset="utf-8">
  <meta name="description" content="">    
<meta name="keywords" content="">

   <link href="../admin/assets/css/bootstrap.css" rel="stylesheet" />
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
.loader {
  border: 10px solid #f3f3f3;
  border-radius: 50%;
  border-top: 10px solid #3498db;
  width: 60px;
  height: 60px;
  -webkit-animation: spin 1s linear infinite; /* Safari */
  animation: spin 1s linear infinite;

}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}



</style>

</head>


<body>

 

  <div class="container">

<center><div id="loader"></div></center>
<div class="col-sm-3"></div>
<div class="col-sm-6 login-box" >

<?php  
    
    
    if(empty($_POST['dbhost']&&
             $_POST['dbname']&&
            
             $_POST['dbuser'])){
                 echo"<h2 align=center >All Fields are required! Please Re-enter</h2>";

    }else{
        if(isset($_POST['formsubone']))
        {
            $writer="<?php".'
    '.'$DBHOST = '."'".$_POST['dbhost']."'".';
    '.'$DBNAME = '."'".$_POST['dbname']."'".';
    '.'$DBUSER = '."'".$_POST['dbuser']."'".';
    '.'$DBPASS = '."'".$_POST['dbpass']."'".';
    '."?>"

    ;
            $write=fopen('../includes/conscrmg.php' , 'w');
            fwrite($write,$writer);
            fclose($write);
include ("../includes/conscrmg.php");
try{
 $db = new PDO("mysql:host=".$DBHOST.";dbname=".$DBNAME, $DBUSER, $DBPASS); 
header("location:dbinstallingexe.php");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {

      header("location:../install?error=1"); }
            
        }else{ echo "<h2 align=center >Error<h2>"; }}
?>

<div class="col-sm-3"></div>
</div> 
</body>
</html>