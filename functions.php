<?php 
$rowm=$getCredit->fetch_all('more','id','ASC');
foreach($rowm as $ro)
{
$watermark=$ro['watermark'];
$signature=$ro['signature'];
$iso=$ro['iso'];
$certified=$ro['certified'];
$stamp=$ro['stamp'];
}

?>