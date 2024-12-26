<?php require_once("../autoload.php");
$gid=32;
$rows=$getCredit->get_sch($gid);
echo var_dump($rows);
 ?> 