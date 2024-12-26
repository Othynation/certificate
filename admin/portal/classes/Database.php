<?php
    Class Database {
        public function get_date() 
        { 
      $date = new DateTime(null, new DateTimezone("Asia/Kolkata"));
$date=$date->format('Y-m-d H:i:s');
return $date; 
        }
          public function easy_date2($date) 
{  
    if($date>0) 
    {
return date('d M Y',strtotime($date));  
}
}

        
        public function easy_date($date) 
{  
	if($date>0) 
	{
return date('d M Y,g:i a',strtotime($date));  
}
}
 public function FormatCSV($entry) {
   $entry=preg_replace('/[^A-Za-z0-9\-,]/', ' ', $entry); // Removes special chars.
    if(strpos($entry, ',') !== false) return '"'.$entry.'"';
    return $entry;
}


     
      public function sanitize($var,$type)
        { 
 $filter = false;
        switch($type)
        {
            case 'email':
                $var = substr($var, 0, 254);
                $filter = FILTER_VALIDATE_EMAIL;    
            break;
            case 'int':
                $filter = FILTER_VALIDATE_INT;
            break;
            case 'boolean':
                $filter = FILTER_VALIDATE_BOOLEAN;
            break;
            case 'ip':
                $filter = FILTER_VALIDATE_IP;
            break;
            case 'url':
                $filter = FILTER_VALIDATE_URL;
            break;
             case 'string':
            default:
                $filter = FILTER_SANITIZE_STRING;
            break;

        }
        return $filter= trim(filter_var($var, $filter)); 
    }  


    }

?>