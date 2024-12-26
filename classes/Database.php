<?php
    Class Database {
        public function get_date() 
        { 
      $date = new DateTime(null, new DateTimezone("Africa/Casablanca"));
$date=$date->format('Y-m-d H:i:s');
return $date; 
        }
          public function get_hour() 
        { 
      $date = new DateTime(null, new DateTimezone("Africa/Casablanca"));
$date=$date->format('H:i');
return $date; 
        }

        

          public function get_date2() 
        { 
      $date = new DateTime(null, new DateTimezone("Africa/Casablanca"));
$date=$date->format('Y-m-d');
return $date; 
        }

public function ap($val)
{
if($val==1)
{
    return 'Present';
}
else 
{
    return '<span style="color:red;">Absent</span>';
}
}
        
        public function easy_date($date) 
{  
	if($date>0) 
	{
return date('d M Y,g:i a',strtotime($date));  
}
}
        public function easy_date2($date) 
{  
    if($date>0) 
    {
return date('d/m/Y',strtotime($date));  
}
}
        
        public function easy_dayname($date) 
{  
    if($date>0) 
    {
return date('l',strtotime($date));  
}
}
   public function easy_dayname2($date) 
{  
    if($date>0) 
    {
return date('l , M',strtotime($date));  
}
}
   public function easy_date3($date) 
{  
    if($date>0) 
    {
return date('M , Y',strtotime($date));  
}
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
    public function getDayName($dayNumber) {
$days = array(
"1" => "Monday",
"2" => "Tuesday",
"3" => "Wednesday",
"4" => "Thursday",
"5" => "Friday",
"6" => "Saturday",
"7" => "Sunday"
);
return $days[$dayNumber];
}
public function getDayNumber($day) {
if ($day == "Monday") return 1;
elseif ($day == "Tuesday") return 2;
elseif ($day == "Wednesday") return 3;
elseif ($day == "Thursday") return 4;
elseif ($day == "Friday") return 5;
elseif ($day == "Saturday") return 6;
elseif ($day == "Sunday") return 7;
else {
// $day is not a day name, return null or a default value
return null;
}
}


public function getDayName2($dayNumber) {
$days = array(
"1" => "Mon",
"2" => "Tue",
"3" => "Wed",
"4" => "Thu",
"5" => "Fri",
"6" => "Sat",
"7" => "Sun"
);
return $days[$dayNumber];
}
public function getSalaryType($salaryTypeNumber) {
if ($salaryTypeNumber == 1) {
return "Per Month";
} elseif ($salaryTypeNumber == 2) {
return "Per Hour";
} elseif ($salaryTypeNumber == 3) {
return "Per Student";
} else {
return "N/A";
}
}
function monthDiff($fromDate, $toDate) {
  $fromYear = date('Y', strtotime($fromDate));
  $fromMonth = date('m', strtotime($fromDate));
  $toYear = date('Y', strtotime($toDate));
  $toMonth = date('m', strtotime($toDate));

  $monthDiff = ($toYear - $fromYear) * 12 + ($toMonth - $fromMonth);
  return $monthDiff;
}
    }

?>