<?php include("conscrmg.php"); 
try{ 
$db = new PDO("mysql:host=".$DBHOST.";dbname=".$DBNAME, $DBUSER, $DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {
    header("location:install"); 
    }
?>