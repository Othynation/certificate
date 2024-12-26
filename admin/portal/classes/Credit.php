<?php Class Credit extends Database { 
	 private $dbConnection;
 function __construct($db)
 {
  $this->dbConnection = $db;
 }
 
 public function show_institutes($sid,$did,$tid)
    {
        $sql="SELECT * from pinstitute WHERE sid=:sid AND did=:did AND tid=:tid order by iid DESC"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':sid', $sid, PDO::PARAM_INT);
         $stmt->bindParam(':did', $did, PDO::PARAM_INT);
          $stmt->bindParam(':tid', $tid, PDO::PARAM_INT);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows; 

    }


 public function get_sname($id)
{
    if($id>0)
    {
    $rows=$this->get_by_id('pstate','sid',$id); 
foreach($rows as $row)
{
    return $row['sname'];
}    
    }
    else 
    {
         return '';
    }

}
public function get_dname($id)
{
    if($id>0)
    {
    $rows=$this->get_by_id('pdistrict','did',$id); 
foreach($rows as $row)
{
    return $row['dname'];
}    
    }
    else 
    {
         return '';
    }

}
public function get_tname($id)
{
    if($id>0)
    {
    $rows=$this->get_by_id('ptaluka','tid',$id); 
foreach($rows as $row)
{
    return $row['tname'];
}    
    }
    else 
    {
         return '';
    }

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
public function count_by_id($table,$col,$id)
{ 
 $sql= "SELECT count(*) FROM $table WHERE $col=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
     $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        return $number_of_rows;  
}

  public function getallin($table,$where,$id)
    { 
       $sql="SELECT * FROM $table WHERE $where IN ($id)"; 
     $stmt = $this->dbConnection->prepare($sql);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;
    }


   public function fetch_all($table,$col,$order)
    { 
       $sql="SELECT* FROM $table order by $col $order"; 
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
    public function getexamdetails($id)
    {
      $sql="SELECT * 
FROM pexam 
JOIN pregistrations ON pexam.reg_id=pregistrations.reg_id  WHERE eid=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;    
    }
     public function getexamdetails_by_enroll($id)
    {
      $sql="SELECT * 
FROM pexam 
JOIN pregistrations ON pexam.reg_id=pregistrations.reg_id  WHERE pregistrations.reg_no=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows;    
    }

     public function count_for_hallticket($id)
    {
      $sql="SELECT count(*) 
FROM pexam 
JOIN pregistrations ON pexam.reg_id=pregistrations.reg_id  WHERE pregistrations.reg_no=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
         $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        return $number_of_rows;   
    }



    public function fetch_distinct($table,$col1,$col,$order)
    { 
       $sql="SELECT distinct $col1 FROM $table order by $col $order"; 
     $stmt = $this->dbConnection->prepare($sql);
    $stmt->execute();
        $rows=$stmt->fetchAll(); 
        return $rows; 
    }

    public function get_by_id($table,$where,$id)
    { 
       $sql="SELECT* FROM $table WHERE $where=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
       $sql="SELECT* FROM $table WHERE $where=:id"; 
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
       $sql="SELECT* FROM $table order by $col $order limit $limit"; 
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
          $rows=$this->get_by_string('poptions','option_name',$option_name); 
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
         public function status($val)
 {
     if($val=='1')
     {
        return '<span style="color:#33CC00;">Success<i class="fa fa-check"></i></span>'; 
     }
     elseif($val=='3')
     {
      return '<span style=color:red;">Failed<i class="fa fa-close"></i></span>';
     }
     else
     {
        return '<span style=color:blue;>Pending<i class="fa fa-history"></i></span>'; 
     }
 }
  public function status2($val)
 {
     if($val=='1')
     {
        return 'Success'; 
     }
     elseif($val=='3')
     {
      return 'Failed';
     }
     else
     {
        return 'Pending'; 
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
         $subject="You have received password reset email from ".$FromName; 
     $msg="Your password reset link <br> <a href='".$paypath."admin/password-reset?token=".$token."'>Reset Here </a> <br> Reset your password with this link .Click or open in new tab<br><br> <br> <br> <center>".$credits."</center>"; 
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

} 
?>