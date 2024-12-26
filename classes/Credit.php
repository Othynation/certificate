<?php Class Credit extends Database { 
	 private $dbConnection;
 function __construct($db)
 {
  $this->dbConnection = $db;
 }
 public function count($table)
{ 
 $sql= "SELECT count(*) FROM $table"; 
     $stmt = $this->dbConnection->prepare($sql);
    $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        return $number_of_rows;  
}
function tableExists($table) {
    try {
        $result = $this->dbConnection->query("SELECT 1 FROM {$table} LIMIT 1");
    } catch (Exception $e) {
        return FALSE;
    }
    return $result !== FALSE;
}
  public function status($val)
 {
     if($val==1)
     {
        return '<span style="color:#33CC00;">Live<i class="fa fa-check"></i></span>'; 
     }
     else 
     {
        return '<span style=color:red;">Blocked<i class="fa fa-close"></i></span>'; 
     }
 }
 public function status2($val)
 {
     if($val==2)
     {
        return '<span style="color:blue;">New</span>'; 
     }
     else if($val==0)
     {
        return '<span style=color:red;">Termine</span>'; 
     }
      else if($val==1)
     {
        return '<span style=color:#33CC00;">Active</span>'; 
     }
 }
 public function status4($val)
 {
     if($val==2)
     {
        return '<span style="color:blue;">Inactive</span>'; 
     }
     else if($val==0)
     {
        return '<span style=color:red;">Termine</span>'; 
     }
      else if($val==1)
     {
        return '<span style=color:#33CC00;">Active</span>'; 
     }
 }
 public function status8($val)
 {
     if($val>0)
     {
        return '<span style="color:#1000cc;"><a href="group?detect=editSchedule&id='.$val.'">Re-Scheduled </a> <i class="fa fa-external-link-square"></i></span>'; 
     }
     
 }


 public function status5($val)
 {
     if($val==0)
     {
        return '<span style="color:#33CC00;">Scheduled</span>'; 
     }
     else if($val==1)
     {
        return '<span style=color:red;">Postponed</span>'; 
     }
 }
  public function status6($val)
 {
     if($val==0)
     {
        return 'Scheduled'; 
     }
     else if($val==1)
     {
        return 'Postponed'; 
     }
 }


 public function status_hr2($val)
 {
    if($val==2)
     {
        return 'Inactive'; 
     }
     else if($val==0)
     {
        return 'Termine'; 
     }
      else if($val==1)
     {
        return 'Active'; 
     }
 }


 public function status_hr($val)
 {
     if($val==2)
     {
        return 'New'; 
     }
     else if($val==0)
     {
        return 'Termine'; 
     }
      else if($val==1)
     {
        return 'Active'; 
     }
 }

 public function status3($val)
 {
     if($val==0)
     {
        return '<span style="color:blue;">No</span>'; 
     }
      else
     {
        return '<span style=color:#33CC00;">Yes</span>'; 
     }
   
 }



public function count_by_id($table,$col,$id)
{ 
 $sql= "SELECT count(*) FROM $table WHERE $col=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
     $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        return $number_of_rows;  
}
public function count_registrations_by_month($year) {
    $sql = "SELECT 
            MONTH(reg_date) as month, 
            COUNT(*) as count 
            FROM registrations 
            WHERE YEAR(reg_date) = :year 
            GROUP BY MONTH(reg_date)";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $data = array();
    foreach ($results as $result) {
        $data[date('F', mktime(0, 0, 0, $result['month'], 1))] = $result['count'];
    }
    return json_encode($data);
}
public function count_registrations_by_month2($year,$user_id) {
    $sql = "SELECT 
            MONTH(registrations.reg_date) as month, 
            COUNT(*) as count 
            FROM registrations 
            LEFT JOIN centres ON registrations.cent_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
            WHERE links.id=:uid AND YEAR(registrations.reg_date) = :year 
            GROUP BY MONTH(reg_date)";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':year', $year, PDO::PARAM_INT);
    $stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $data = array();
    foreach ($results as $result) {
        $data[date('F', mktime(0, 0, 0, $result['month'], 1))] = $result['count'];
    }
    return json_encode($data);
}



 public function fecth_by_string_two_col_fetch($table,$where,$id,$col,$val)
    { 
       $sql="SELECT* FROM $table WHERE $where=:id AND $col=:val"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':val', $val, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetch(); 
        return $rows;

    }


public function count_by_string($table,$col,$id)
{ 
 $sql= "SELECT count(*) FROM $table WHERE $col=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
     $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        return $number_of_rows;  
}
public function count_by_sql($query) {
    $stmt = $this->dbConnection->prepare($query);
    $stmt->execute();
    return $stmt->fetchColumn();
}

public function count_by_query($query) {
    $stmt = $this->dbConnection->prepare($query);
    $stmt->execute();
    $number_of_rows = $stmt->rowCount();
    return $number_of_rows;
}
public function count_by_query2($query) {
    $stmt = $this->dbConnection->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

public function count_students_present_in_multiple_schedules($gid, $from_date, $to_date, $prof_id) {
$sql = "SELECT COUNT(*) AS student_count
        FROM (
            SELECT p.reg_id
            FROM presence p
            JOIN schedual s ON p.sid = s.sid
            WHERE s.gid = :gid
            AND s.pid = :pid
            AND s.sdate BETWEEN :from_date AND :to_date
            AND p.pre = 1
            GROUP BY p.reg_id
            HAVING COUNT(DISTINCT p.sid) > 1
        ) AS subquery";

    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);
    $stmt->bindParam(':from_date', $from_date, PDO::PARAM_STR);
    $stmt->bindParam(':to_date', $to_date, PDO::PARAM_STR);
    $stmt->bindParam(':pid', $prof_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($result !== false) {
        return $result['student_count'];
    } else {
        return 0; // or any default value you want to return when no rows are found
    }
}





public function count_schedules($gid, $prof_id, $from, $to) {
  $sql = "SELECT count(*) FROM schedual 
          WHERE gid = :gid 
          AND pid = :pid 
          AND sdate BETWEEN :from_date AND :to_date";

  $stmt = $this->dbConnection->prepare($sql);
  $stmt->bindParam(':gid', $gid, PDO::PARAM_STR);
  $stmt->bindParam(':pid', $prof_id, PDO::PARAM_STR);
  $stmt->bindParam(':from_date', $from, PDO::PARAM_STR);
  $stmt->bindParam(':to_date', $to, PDO::PARAM_STR);
  $stmt->execute();
  $number_of_rows = $stmt->fetchColumn();
  return $number_of_rows;
}


public function calculate_total_hours($gid, $from_date, $to_date, $prof_id) {
    $sql = "SELECT s.sid, s.sfrom, s.sto FROM schedual s WHERE s.gid = :gid AND s.pid = :pid AND s.sdate BETWEEN :from_date AND :to_date";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);
    $stmt->bindParam(':from_date', $from_date, PDO::PARAM_STR);
    $stmt->bindParam(':to_date', $to_date, PDO::PARAM_STR);
    $stmt->bindParam(':pid', $prof_id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll();

    $total_hours = 0;
    foreach ($results as $row) {
        $start_time = strtotime($row['sfrom']);
        $end_time = strtotime($row['sto']);
        $total_hours += ($end_time - $start_time) / 3600;
    }

    return $total_hours;
}






public function count_by_id_query($sql,$id)
{
$stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        return $number_of_rows;  

}
public function count_by_id_query_two_col($sql,$id,$id2)
{
$stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id',$id, PDO::PARAM_STR);
        $stmt->bindParam(':id2',$id2, PDO::PARAM_STR);
    $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        return $number_of_rows;  

}

   public function fetch_all($table,$col,$order)
    { 
       $sql="SELECT * FROM $table order by $col $order"; 
     $stmt = $this->dbConnection->prepare($sql);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows; 
    }
    public function rc($id)
    {
        $sql="SELECT * 
FROM certificates 
JOIN registrations ON certificates.reg_id=registrations.reg_id  WHERE cid=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows; 

    }

    public function fetch_distinct($table,$col1,$col,$order)
    { 
       $sql="SELECT distinct $col1 FROM $table order by $col $order"; 
     $stmt = $this->dbConnection->prepare($sql);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows; 
    }
    public function get_sch($gid) {
$count=$this->count_by_id('schedual','gid',$gid);
if($count>0)
{
   
$sql="SELECT sday,sfrom from schedual WHERE gid=:id AND sparent_id IS NULL";
    $rows=$this->get_by_id_query($sql,$gid);
//$rows=$this->get_by_string_limit('schedual','gid',$gid,'sday','ASC',3);
$arr=array();
foreach($rows as $row)
{
$arr[]=$this->getDayName2($row['sday']).'/'.$row['sfrom'];
}
$string = implode(' - ', $arr);
return $string;
}
else 
{
    return 'N/A'; 
}
}

public function getsumdeposite($gid,$reg_id)
    { 
       $sql="SELECT SUM(deposit) AS value_sum FROM payments WHERE gid=:gid AND reg_id=:reg_id"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);
            $stmt->bindParam(':reg_id', $reg_id, PDO::PARAM_INT);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        foreach($rows as $row)
        {
         $sum=$row['value_sum'];   
        }
        $final_sum=round($sum,2);
        return $final_sum; 
    }


    public function get_by_id($table,$where,$id)
    { 
       $sql="SELECT * FROM $table WHERE $where=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;
}
    public function get_prof($id)
    { 
     $count=$this->count_by_id('ts_gtw_users','id',$id);
     if($count>0)
     {
       $rows=$this->get_by_id('ts_gtw_users','id',$id);
       foreach($rows as $row)
       {
        return $this->jump_to("prof?detect=edit&id=".$row['id']."",$row["username"]);
       }
     }
     else 
     {
        return ''; 
     }
}
public function get_prof2($id)
    { 
     $count=$this->count_by_id('ts_gtw_users','id',$id);
     if($count>0)
     {
       $rows=$this->get_by_id('ts_gtw_users','id',$id);
       foreach($rows as $row)
       {
        return $row["username"];
       }
     }
     else 
     {
        return ''; 
     }
}



public function get_by_string_two_col($table,$where,$id,$id2,$val2)
    { 
       $sql="SELECT * FROM $table WHERE $where=:id AND $id2=:val2"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
         $stmt->bindParam(':val2', $val2, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;
}

public function get_by_id_query($sql,$id)
{
$stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;

}
public function get_by_id_query_two_col($sql,$id,$id2)
{
$stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
         $stmt->bindParam(':id2', $id2, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;

}


public function get_by_query($sql)
{
$stmt = $this->dbConnection->prepare($sql);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;

}

public function get_dep($id)
{
$rows=$this->get_by_id('dep','dep_id',$id); 
foreach($rows as $row)
{
    return $row['dep_title'];
}
}


public function get_by_string($table,$where,$id)
    { 
       $sql="SELECT * FROM $table WHERE $where=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;

    }
    public function get_by_string_limit($table,$where,$id,$col,$order,$limit)
    { 
       $sql="SELECT * FROM $table WHERE $where=:id order by $col $order limit $limit"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;

    }

    public function get_by_string_order($table,$where,$id,$col,$order)
    { 
       $sql="SELECT* FROM $table WHERE $where=:id order by $col $order"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;


    }
public function get_presense($reg_id)
{
    $sql="SELECT COUNT(DISTINCT sid) AS schedule_count
FROM presence
WHERE reg_id = :reg_id;
"; 
$stmt = $this->dbConnection->prepare($sql);
     $stmt->bindParam(':reg_id', $reg_id, PDO::PARAM_INT);
    $stmt->execute();
       $scount = $stmt->fetchColumn(); 
        


        $sql2="SELECT COUNT(DISTINCT sid) AS schedule_count
FROM presence
WHERE reg_id = :reg_id AND pre=:pre;
"; 

$pre=1;
$stmt = $this->dbConnection->prepare($sql2);
     $stmt->bindParam(':reg_id', $reg_id, PDO::PARAM_INT);
         $stmt->bindParam(':pre',$pre,PDO::PARAM_INT);
    $stmt->execute();
        $pcount = $stmt->fetchColumn(); 
         
        return $pcount.'/'.$scount; 
}

public function count_by_string_two_col($table,$where,$id,$col,$val)
    { 
       $sql="SELECT count(*) FROM $table WHERE $where=:id AND $col=:val"; 
     $stmt = $this->dbConnection->prepare($sql);
     $stmt->bindParam(':id', $id, PDO::PARAM_STR);
     $stmt->bindParam(':val', $val, PDO::PARAM_STR);
    $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        return $number_of_rows;  


    }
public function fecth_by_string_two_col($table,$where,$id,$col,$val)
    { 
       $sql="SELECT* FROM $table WHERE $where=:id AND $col=:val"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':val', $val, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;

    }


    

     public function get_all_data($table)
    { 
       $sql="SELECT count(*) FROM $table"; 
     $stmt = $this->dbConnection->prepare($sql);
    $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        return $number_of_rows; 
    }
    function check_certificate($reg_id)
           {

    $count=$this->count_by_id('certificates','reg_id',$reg_id);
    if($count==1)
    {
        $rows=$this->get_by_id('certificates','reg_id',$reg_id); 
        foreach($rows as $rm)
        {
            $cid=$rm['cid'];
        }
return '<a target="_blank" href=\'certificates?detect=edit&id='.$cid.'\'"><button class="btn btn-success">Certificate<i class="fa fa-check"></i></button></a> ';
    }
    else 
    {
    return '<a target="_blank" href=\'certificates?detect=add&id='.$reg_id.'\'"><button class="btn btn-success">Certificate</button></a> ';
}
           }

    
    public function delete_by_id($table,$where,$id)
{
  $sql = "DELETE from $table WHERE $where=:id";
                                  $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':id',$id, PDO::PARAM_STR);
              $stmt->execute(); 
              if($stmt)
              {
                return true;
              }
              else{
                return false;
              }

}
 public function fetch_by_limit($table,$col,$order,$limit)
    { 
       $sql="SELECT * FROM $table order by $col $order limit $limit"; 
     $stmt = $this->dbConnection->prepare($sql);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows; 
    }
   

     function reg_no($val)
        {
       $newString = preg_replace('/[a-z]/i', '', $val); 
          return  $newString;
        }


public function slug($text){ 
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
  $text = trim($text, '-');
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = strtolower($text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  if (empty($text))
  {
    return 'n-a';
  }
  return $text;
}

 
        public function get_option_value($option_name)
        {
          $rows=$this->get_by_string('options','option_name',$option_name); 
          foreach($rows as $row)
          {
            return $row['option_value']; 
          }
         
        }
         public function fetch_options($type){
            $sql = "SELECT option_name,option_value FROM options WHERE type=:type";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(":type", $type, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }


        public function get_price_table($id)
        {
          $rows=$this->get_by_id('price_tables','tid',$id); 
          foreach($rows as $row)
          {
            return $row['ttitle'].' ('.$this->currency().' ' .$row['tprice'].')'; 
          }

        }
        function price_list($content)
        {
          $arrayName=explode('<br>', $content);
          return $arrayName; 
        }

          public function fetch_posts_list($statement,$startpoint,$limit,$cat){
            $sql = "SELECT * from {$statement} LIMIT {$startpoint} , {$limit}";
            $stmt = $this->dbConnection->prepare($sql);
             $stmt->bindParam(":cat", $cat, PDO::PARAM_STR);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            return $rows;
        }
        public function short($str)
        { 
       $res=explode('-',$str); 
        return implode(" ",$res); 
        }
 
    public function insert_token($email){ 
       $error=array();
       $token = bin2hex(random_bytes(50));
$rows=$this->get_by_id('general','id',1); 
     foreach($rows as $row)
     {
        $webtitle=$row['web_title'];
        $paypath=$row['web_path']; 
        $logo=$row['logo'];  
        $contact_email=$row['contact_email']; 
        $from_email=$row['from_email'];
     }
        $FromName=$webtitle;
$FromEmail=$from_email;
 $ReplyTo=$contact_email;
$credits="All rights are reserved | ".$FromName; 
$headers  = "MIME-Version: 1.0\n";
     $headers .= "Content-type: text/html; charset=iso-8859-1\n";
     $headers .= "From: ".$FromName." <".$FromEmail.">\n";
      $headers .= "Reply-To: ".$ReplyTo."\n";
      $headers .= "X-Sender: <".$FromEmail.">\n";
       $headers .= "X-Mailer: PHP\n"; 
       $headers .= "X-Priority: 1\n"; 
       $headers .= "Return-Path: <".$FromEmail.">\n"; 
         $subject="You have received password reset email from Certificate Atlantique Formation"; 
     $msg="<div class='admin-logo' style='text-align: center;'><a href='/admin'><img src='https://certificate.atlantique.ma/admin/assets/images/logo.png' width='200'/></a><br><br><br>Your password reset link <br><br> <a href='".$paypath."admin/password-reset?token=".$token."' style='background: #066bca; color: white; font-weight: 600; padding: 10px 20px; border-radius: 5px; text-decoration: none;'>Reset Here </a> <br><br> Reset your password with this link .Click or open in new tab</div><br><br> <br> <br> <center>".$credits."</center>"; 
  if(@mail($email, $subject, $msg, $headers,'-f'.$FromEmail) ){

      $sql = "INSERT INTO custom_token(email,token,type) VALUES(:email,:token,:type)";
                                  $stmt = $this->dbConnection->prepare($sql);
                                  
                                  $type='af'; 
            $stmt->bindParam(':email',$email, PDO::PARAM_STR);
             $stmt->bindParam(':type',$type, PDO::PARAM_STR);
             $stmt->bindParam(':token',$token, PDO::PARAM_STR);
              $res=$stmt->execute();
    } 

    else {
       $error[]='Server failed to send email , Please try again ...';
} 

      if(isset($error))
           {
             return $error ;  
           }
           else 
            { 
    return $arrayName = [];
            } 
            

}
public function validate_set_pass($password,$passwordConfirm,$token)
        { 
$sql= "SELECT count(*) from custom_token WHERE token=:token AND type=:type";
     $stmt = $this->dbConnection->prepare($sql);
     $type='af'; 
      $stmt->bindParam(':token', $token, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->execute(); 
   $number_of_rows = $stmt->fetchColumn();  
   if($number_of_rows==0){
$error[]='This link has been expired or something missing..';
return $error; 
   }
   else 
   {
   $password=$this->sanitize($password,'string');
   $passwordConfirm=$this->sanitize($passwordConfirm,'string');
    if(strlen($password)<5){
            $error[] = 'The password is 6 characters long.';
        }
         if(strlen($password)>20){
            $error[] = 'Password: Max length 20 Characters Not allowed';
        }
        if($passwordConfirm ==''){
            $error[] = 'Please confirm the password.';
        }
        if($password != $passwordConfirm){
            $error[] = 'Passwords do not match.';
        }
 if(isset($error))
           {
             return $error ;  
           }
           else 
            { 
    return $arrayName = [];
            }  
   }

        }


public function update_set_pass($password,$token)
        { 
   $sql = "SELECT email from custom_token WHERE token=:token AND type=:type";
                $stmt = $this->dbConnection->prepare($sql);
               $type='af'; 

                 $stmt->bindParam(':token', $token, PDO::PARAM_STR);
                      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
    $stmt->execute(); 
   $row = $stmt->fetch(); 
   $final_email=$row['email']; 
$sql = "UPDATE ts_gtw_users SET password=:password WHERE email=:email";
                $stmtup = $this->dbConnection->prepare($sql);
                 $password=$this->sanitize($password,'string');
                  $options = array("cost"=>4);
$hashedpassword= password_hash($password,PASSWORD_BCRYPT,$options);
                $stmtup->bindParam(':password', $hashedpassword, PDO::PARAM_STR);
                  $stmtup->bindParam(':email', $final_email, PDO::PARAM_STR);
                  $stmtup->execute(); 
                  if($stmtup)  {
                   $sql = "DELETE FROM custom_token WHERE email=:email AND type=:type";
                $stmt = $this->dbConnection->prepare($sql);
                $type='af'; 
                  $stmt->bindParam(':email', $final_email, PDO::PARAM_STR);
                 $stmt->bindParam(':type', $type, PDO::PARAM_STR);
                  $res=$stmt->execute(); 
                  if($res){
 return true;

                  }
                  else 
                  { 
 return false; 
                  }    
        }
    }

     public function jump_to($id,$val)
 {
if($val!='')
{
return '<a target="_blank" href="'.$id.'">'.$val.' <i class="fa fa-external-link-square"></i><a>';
}
else 
{
    return '';
}


 }



} 
?>