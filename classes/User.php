<?php Class User extends Database { 
	 private $dbConnection;
 function __construct($db)
 {
  $this->dbConnection = $db;
 }
  public function admin_log_check(){
        if(isset($_SESSION['ts_admin_sess_log']) && $_SESSION['ts_admin_sess_log'] == true){
            return true;
        } }
        public function logout(){
        	unset($_SESSION['ts_admin_sess_log']); 
           unset($_SESSION['user_id']); 
            return true;
        }
            public function fetch_status_by_id($id)
    {
    $sql="SELECT ustatus FROM ts_gtw_users WHERE id=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
        $row=$stmt->fetch(); 
            $ustatus=$row['ustatus'];
        return $ustatus;
    }


         public function final_check($id)
    {
        $sql= "SELECT count(*) FROM ts_gtw_users WHERE id=:id"; 
     $stmt = $this->dbConnection->prepare($sql);
       $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
        $count= $stmt->fetchColumn();
        if($count>0)
        {
           $ustatus=$this->fetch_status_by_id($id);
           if($ustatus==0)
           {
            unset($_SESSION['ts_admin_sess_log']); 
            unset($_SESSION['user_id']); 
            return false; 
           }
           else 
           {
            return true;
           }

        }
        else 
        {
           unset($_SESSION['ts_admin_sess_log']); 
           unset($_SESSION['user_id']); 
            return false; 
        }
    }

         public function login_ts_val($login_var,$password)
          { 

                $sql= "SELECT count(*) from ts_gtw_users WHERE (username=:username OR email=:email)"; 
              $stmt = $this->dbConnection->prepare($sql);
               $stmt->bindParam(':username', $login_var, PDO::PARAM_STR);
               $stmt->bindParam(':email', $login_var, PDO::PARAM_STR);
            $stmt->execute();
             $count = $stmt->fetchColumn();
            if($count>0){ 
                 $sql= "SELECT ustatus,id,password from ts_gtw_users WHERE (username=:username OR email=:email)"; 
              $stmt = $this->dbConnection->prepare($sql);
               $stmt->bindParam(':username', $login_var, PDO::PARAM_STR);
               $stmt->bindParam(':email', $login_var, PDO::PARAM_STR);
            $stmt->execute();
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
             $status=$row['ustatus'];
             if($status==0)
             {
return 3;
             }
             else 
             {
                        if(@password_verify($password,$row['password'])){
           $_SESSION["ts_admin_sess_log"]="1"; 
             $_SESSION["user_id"]= $row['id'];
             return 1; 
          }
          else 
         {
              return 0; 
         }
             }
       
  }

   else 
         {
         	  return 0; 
         }
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

public function ac_validate($fname,$lname,$username,$email,$password,$passwordConfirm,$oldusername,$oldemail,$action) 
        { 
     $fname=$this->sanitize($fname,'string');
     $lname=$this->sanitize($lname,'string');
               $username=$this->sanitize($username,'string');
               $password=$this->sanitize($password,'string');
               $username=$this->sanitize($username,'string');
                   $email=$this->sanitize($email,'email');
               $passwordConfirm=$this->sanitize($passwordConfirm,'string');
        if(strlen($fname)<3){
            $error[] = 'Please enter First name using 3 charaters atleast.';
        }
    
          if(strlen($lname) <3){
            $error[] = 'Please enter Last name using 3 charaters atleast.';
        }
        
        if(strlen($lname)>20){
            $error[] = 'Last Name: Max length 20 Characters Not allowed';
        }
         if(strlen($username) <4){
            $error[] = 'Please enter Username using 4 charaters atleast.';
        }
        
        if(strlen($username)>20){
            $error[] = 'UserName: Max length 20 Characters Not allowed';
        }
        
          if(!preg_match("/^^[^0-9][a-z0-9]+([_-]?[a-z0-9])*$/", $username)){
            $error[] = 'Invalid Entry for Username. Enter lowercase letters without any space and No number at the start- Eg - myusername, okuniqueuser or myusername123';
        } 
              if($email ==''){
            $error[] = 'Please enter the email address.';
        
        }
         if($oldusername!=$username){
        
 $count=$this->count_by_string('ts_gtw_users','username',$username);

      if ($count > 0) {
        if($username==isset($row['username']))
        {
$error[] = 'Username  already exists.';
        }
   
             }
         }
 if($oldemail!=$email){
             $countm=$this->count_by_string('ts_gtw_users','email',$email);
      if ($countm > 0) {
    if($email==isset($row['email']))
    {
$error[] = 'Email already exists.';
    }
   
             }
         }

if($action=='edit'){
        if(strlen($password) > 0){
            if($password ==''){
                $error[] = 'Please enter the password.';
            }
            if($passwordConfirm ==''){
                $error[] = 'Please confirm the password.';
            }
            if(strlen($password)<6){
            $error[] = 'The password should be 6 characters long.';
        }
         if(strlen($password)>20){
            $error[] = 'Password: Max length 20 Characters Not allowed';
        }
            if($password != $passwordConfirm){
                $error[] = 'Passwords do not match.';
            }


        }
    }
    elseif($action=='add'){

        if($password ==''){
                $error[] = 'Please enter the password.';
            }
            if($passwordConfirm ==''){
                $error[] = 'Please confirm the password.';
            }

            if(strlen($password)<6){
            $error[] = 'The password should be 6 characters long.';
        }
         if(strlen($password)>20){
            $error[] = 'Password: Max length 20 Characters Not allowed';
        }
            if($password != $passwordConfirm){
                $error[] = 'Passwords do not match.';
            }
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
public function insert_user($fname,$lname,$username,$email,$password,$post,$new_image_name,$ucin,$uphone) 
        { 
     $fname=$this->sanitize($fname,'string');
     $lname=$this->sanitize($lname,'string');
               $username=$this->sanitize($username,'string');
               $password=$this->sanitize($password,'string');
               $username=$this->sanitize($username,'string');
                   $email=$this->sanitize($email,'email');
                        $date=$this->get_date();            
  $options = array("cost"=>4);
$hashedpassword= password_hash($password,PASSWORD_BCRYPT,$options);
                             $sql = "INSERT INTO  ts_gtw_users(fname,lname,username,email,password,date,post,usource,ucin,uphone) VALUES(:fname,:lname,:username,:email,:password,:created_date,:post,:usource,:ucin,:uphone)";
                                  $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':fname',$fname, PDO::PARAM_STR);
              $stmt->bindParam(':lname',$lname, PDO::PARAM_STR);
             $stmt->bindParam(':username',$username, PDO::PARAM_STR);
             $stmt->bindParam(':email',$email, PDO::PARAM_STR);
             $stmt->bindParam(':password',$hashedpassword, PDO::PARAM_STR);
                $stmt->bindParam(':post',$post, PDO::PARAM_STR);
             $stmt->bindParam(':created_date',$date, PDO::PARAM_STR);
             $stmt->bindParam(':usource',$new_image_name, PDO::PARAM_STR);
              $stmt->bindParam(':uphone',$uphone, PDO::PARAM_STR);
                  $stmt->bindParam(':ucin',$ucin, PDO::PARAM_STR);
            $res=$stmt->execute();
 $lastid =$this->dbConnection->lastInsertId();
               return $lastid; 
}
public function insert_user2($fname,$lname,$username,$email,$password,$post,$new_image_name,$ucin,$uphone,$salary_type,$samount,$uid,$cent_id) 
        { 
     $fname=$this->sanitize($fname,'string');
     $lname=$this->sanitize($lname,'string');
               $username=$this->sanitize($username,'string');
               $password=$this->sanitize($password,'string');
               $username=$this->sanitize($username,'string');
                   $email=$this->sanitize($email,'email');

                        $date=$this->get_date();            
  $options = array("cost"=>4);
$hashedpassword= password_hash($password,PASSWORD_BCRYPT,$options);
                             $sql = "INSERT INTO  ts_gtw_users(fname,lname,username,email,password,date,post,usource,ucin,uphone,salary_type,samount,uid,cnt_id) VALUES(:fname,:lname,:username,:email,:password,:created_date,:post,:usource,:ucin,:uphone,:salary_type,:samount,:uid,:cnt_id)";
                                  $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':fname',$fname, PDO::PARAM_STR);
              $stmt->bindParam(':lname',$lname, PDO::PARAM_STR);
             $stmt->bindParam(':username',$username, PDO::PARAM_STR);
             $stmt->bindParam(':email',$email, PDO::PARAM_STR);
             $stmt->bindParam(':password',$hashedpassword, PDO::PARAM_STR);
                $stmt->bindParam(':post',$post, PDO::PARAM_STR);
             $stmt->bindParam(':created_date',$date, PDO::PARAM_STR);
             $stmt->bindParam(':usource',$new_image_name, PDO::PARAM_STR);
              $stmt->bindParam(':uphone',$uphone, PDO::PARAM_STR);
                  $stmt->bindParam(':ucin',$ucin, PDO::PARAM_STR);
                   $stmt->bindParam(':salary_type',$salary_type, PDO::PARAM_STR);
                   $stmt->bindParam(':samount',$samount, PDO::PARAM_STR);
                       $stmt->bindParam(':uid',$uid, PDO::PARAM_INT);
                       $stmt->bindParam(':cnt_id',$cent_id, PDO::PARAM_INT);
            $res=$stmt->execute();
 $lastid =$this->dbConnection->lastInsertId();
               return $lastid; 
}


  public function insert_links($postid,$cat_id)
 {
$sql = "INSERT INTO links(id,cent_id) VALUES(:post_id,:cat_id)";
  $stmt = $this->dbConnection->prepare($sql);    
   $stmt->bindParam(':post_id',$postid, PDO::PARAM_INT);             
      $stmt->bindParam(':cat_id',$cat_id, PDO::PARAM_INT);
       $res=$stmt->execute(); 
 }

public function update_user2($fname,$lname,$username,$email,$password,$post,$status,$usource,$ucin,$uphone,$salary_type,$samount,$cent_id,$id) 
        { 
     $fname=$this->sanitize($fname,'string');
     $lname=$this->sanitize($lname,'string');
               $username=$this->sanitize($username,'string');
               $password=$this->sanitize($password,'string');
               $username=$this->sanitize($username,'string');
                   $email=$this->sanitize($email,'email');
                             if($password!= "")
                             {                              
              $sql= "UPDATE ts_gtw_users SET password= :password WHERE id=:id"; 
              $stmt = $this->dbConnection->prepare($sql);
                $options = array("cost"=>4);
$hashedpassword= password_hash($password,PASSWORD_BCRYPT,$options);
               $stmt->bindParam(':password',$hashedpassword, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
                             }
                              $sql= "UPDATE ts_gtw_users SET fname= :fname,lname= :lname,username= :username,email= :email, post=:post,ustatus=:status,usource=:usource,ucin=:ucin,uphone=:uphone,salary_type=:salary_type,samount=:samount,cnt_id=:cnt_id WHERE id=:id"; 
              $stmt = $this->dbConnection->prepare($sql);
               $stmt->bindParam(':fname',$fname, PDO::PARAM_STR);
              $stmt->bindParam(':lname',$lname, PDO::PARAM_STR);
             $stmt->bindParam(':username',$username, PDO::PARAM_STR);
             $stmt->bindParam(':email',$email, PDO::PARAM_STR);
           $stmt->bindParam(':post',$post, PDO::PARAM_STR);
           $stmt->bindParam(':usource',$usource, PDO::PARAM_STR);
            $stmt->bindParam(':uphone',$uphone, PDO::PARAM_STR);
                  $stmt->bindParam(':ucin',$ucin, PDO::PARAM_STR);
            $stmt->bindParam(':status',$status, PDO::PARAM_INT);
                   $stmt->bindParam(':salary_type',$salary_type, PDO::PARAM_INT);
                    $stmt->bindParam(':samount',$samount, PDO::PARAM_STR);
                       $stmt->bindParam(':cnt_id', $cent_id, PDO::PARAM_INT);
             $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
                            
          
                        if($stmt)
     { 

return true; 
     }
     else 
          { 
    return false;
          }


}


public function update_user($fname,$lname,$username,$email,$password,$post,$status,$usource,$ucin,$uphone,$id) 
        { 
     $fname=$this->sanitize($fname,'string');
     $lname=$this->sanitize($lname,'string');
               $username=$this->sanitize($username,'string');
               $password=$this->sanitize($password,'string');
               $username=$this->sanitize($username,'string');
                   $email=$this->sanitize($email,'email');
                             if($password!= "")
                             {                              
              $sql= "UPDATE ts_gtw_users SET password= :password WHERE id=:id"; 
              $stmt = $this->dbConnection->prepare($sql);
                $options = array("cost"=>4);
$hashedpassword= password_hash($password,PASSWORD_BCRYPT,$options);
               $stmt->bindParam(':password',$hashedpassword, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
                             }
                              $sql= "UPDATE ts_gtw_users SET fname= :fname,lname= :lname,username= :username,email= :email, post=:post,ustatus=:status,usource=:usource,ucin=:ucin,uphone=:uphone WHERE id=:id"; 
              $stmt = $this->dbConnection->prepare($sql);
               $stmt->bindParam(':fname',$fname, PDO::PARAM_STR);
              $stmt->bindParam(':lname',$lname, PDO::PARAM_STR);
             $stmt->bindParam(':username',$username, PDO::PARAM_STR);
             $stmt->bindParam(':email',$email, PDO::PARAM_STR);
           $stmt->bindParam(':post',$post, PDO::PARAM_STR);
           $stmt->bindParam(':usource',$usource, PDO::PARAM_STR);
            $stmt->bindParam(':uphone',$uphone, PDO::PARAM_STR);
                  $stmt->bindParam(':ucin',$ucin, PDO::PARAM_STR);
            $stmt->bindParam(':status',$status, PDO::PARAM_INT);
             $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
                            
          
                        if($stmt)
     { 

return true; 
     }
     else 
          { 
    return false;
          }


}


 public function user_forgot_check($login_var)
    {
      $sql= "SELECT count(*) from ts_gtw_users WHERE (username=:username OR email=:email)";
     
              $stmt = $this->dbConnection->prepare($sql);
               $stmt->bindParam(':username', $login_var, PDO::PARAM_STR);
               $stmt->bindParam(':email', $login_var, PDO::PARAM_STR);
            $stmt->execute();
              $number_of_rows = $stmt->fetchColumn(); 
            if($number_of_rows>0){ 
               $error=Null; 
           }

           else{
            $error[]='No user found'; 
             return $error;
           }
    }
     public function get_user_details($login_var)
    {
        $sql= "SELECT id,email from ts_gtw_users WHERE (username=:username OR email=:email)"; 
              $stmt = $this->dbConnection->prepare($sql);
     $stmt->bindParam(':username', $login_var, PDO::PARAM_STR);
               $stmt->bindParam(':email', $login_var, PDO::PARAM_STR);
            $stmt->execute();
             $rows = $stmt->fetch();
             return $rows;
    }


}
	?> 