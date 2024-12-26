<?php 
$rows=$getCredit->get_by_id('pgeneral','id',1); 
     foreach($rows as $row)
     {
        $title=$row['web_title'];
        $paypath=$row['web_path']; 
        $weburl=$row['web_url']; 
        $logo=$row['logo'];  
        $fav=$row['fav']; 
        $desc=$row['web_desc']; 
       $indiatl_no=$row['web_tags']; 
        $contact_email=$row['contact_email']; 
        $from_email=$row['from_email'];
          $format=$row['currency'];
          
     }
?> 