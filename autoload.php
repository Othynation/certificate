<?php ob_start(); session_start(); 
    // constants
    define('APPROOT', dirname(dirname(__FILE__)));
    require_once("pdo-config-ts.php");

    try
{
  $dsn = 'mysql:host=' .DBHOST . ';dbname=' . DBNAME.';utf8';
  $db= new PDO($dsn,DBUSER,DBPASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch(PDOException $e)
{
 echo $e->getMessage();
}
    spl_autoload_register(function($className){
        require_once("classes/$className.php");
    });
    $getDatabase=new Database();
    $getUser=new User($db);
    $getCredit= new Credit($db);
    $getOption= new Option($db);
         $getCer= new Cer($db);
     if(!$db)
     {
        echo 'Please install it.'; 
     }

?>