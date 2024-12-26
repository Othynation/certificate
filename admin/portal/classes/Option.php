<?php Class Option extends Database { 
	 private $dbConnection;
 function __construct($db)
 {
  $this->dbConnection = $db;
 }
 public function update_option($option_value,$option_note,$id) 
{
$sql = "UPDATE poptions SET option_value=:title,option_note=:link WHERE option_id=:id";
              $stmt = $this->dbConnection->prepare($sql);         
         $stmt->bindParam(':title',$option_value, PDO::PARAM_STR);
            $stmt->bindParam(':link',$option_note, PDO::PARAM_STR);
                         $stmt->bindParam(':id',$id, PDO::PARAM_STR);
              $res=$stmt->execute(); 
               if($res)
               {
                return true;
               }
               else 
               {
                return false;
               }
}

 public function update_general($web_title,$web_path,$web_url,$web_desc,$web_tags,$contact_email,$from_email,$logo,$fav,$currency,$reg,$id) 
        { 
     $web_title=$this->sanitize($web_title,'string');
     $web_path=$this->sanitize($web_path,'string');
              $web_url=$this->sanitize($web_url,'string');
              $reg=$this->sanitize($reg,'string');
               $web_desc=$this->sanitize($web_desc,'string');
               $web_tags=$this->sanitize($web_tags,'string');
                 $contact_email=$this->sanitize($contact_email,'string');
                 $from_email=$this->sanitize($from_email,'email');
                 $logo=$this->sanitize($logo,'string');
                 $fav=$this->sanitize($fav,'string');
                   $currency=$this->sanitize($currency,'string');
                             if($logo!= "")
                             {                              
              $sql= "UPDATE pgeneral SET logo= :logo WHERE id=:id"; 
              $stmt = $this->dbConnection->prepare($sql);
               $stmt->bindParam(':logo',$logo, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
                             }
                             if($fav!= "")
                             {                              
              $sql= "UPDATE pgeneral SET fav= :fav WHERE id=:id"; 
              $stmt = $this->dbConnection->prepare($sql);
               $stmt->bindParam(':fav',$fav, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
                             }

                              $sql= "UPDATE pgeneral SET web_title=:web_title,web_path=:web_path,web_url=:web_url,web_desc= :web_desc,web_tags=:web_tags,contact_email= :contact_email,from_email=:from_email,currency=:currency,reg=:reg WHERE id=:id"; 
              $stmt = $this->dbConnection->prepare($sql);
               $stmt->bindParam(':web_title',$web_title, PDO::PARAM_STR);
              $stmt->bindParam(':web_path',$web_path, PDO::PARAM_STR);
             $stmt->bindParam(':web_url',$web_url, PDO::PARAM_STR);
             $stmt->bindParam(':web_desc',$web_desc, PDO::PARAM_STR);
               $stmt->bindParam(':reg',$reg, PDO::PARAM_STR);
                $stmt->bindParam(':web_tags',$web_tags, PDO::PARAM_STR);
                   $stmt->bindParam(':contact_email',$contact_email, PDO::PARAM_STR);
                      $stmt->bindParam(':from_email',$from_email, PDO::PARAM_STR);
                       $stmt->bindParam(':currency',$currency, PDO::PARAM_STR);
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
public function update_general_color($color,$id)
{
     $color=$this->sanitize($color,'string');                      
                              $sql= "UPDATE pgeneral SET color=:color WHERE id=:id"; 
              $stmt = $this->dbConnection->prepare($sql);
               $stmt->bindParam(':color',$color, PDO::PARAM_STR);
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
 public function get_all_data($table)
    { 
       $sql="SELECT count(*) FROM $table"; 
     $stmt = $this->dbConnection->prepare($sql);
    $stmt->execute();
        $number_of_rows = $stmt->fetchColumn(); 
        return $number_of_rows; 
    }
    public function fetch_filter_val($column,$table,$orderby){ 
  $query="SELECT distinct $column from $table order by $orderby";
 $stmt = $this->dbConnection->prepare($query);
    $stmt->execute();
     $row=$stmt->fetchAll(); 
     return $row;
}
   public function sql($column,$search){
$i=1;
$con='';
  foreach($column as $col){
   $total =count($column);
    if($i<$total){ $or='OR';
  }
  else 
    { 
$or='';
    }
 $con.= $col." LIKE \"%".trim($search)."%\" ".$or.' ';
$i++;
  }
 return $con;
}


public function ajax($column,$table,$id,$search,$length,$start,$orderby,$type)
    { 
$query = "
 SELECT * FROM  $table WHERE 
";

if(isset($_POST["is_type"]))
{
  $query .= "$type = :is_type AND  ";
}
if(isset($search))
{
 $query .='('.$this->sql($column,$search).')';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['7']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= "ORDER BY $id $orderby ";
}
$stmt = $this->dbConnection->prepare($query);
if(isset($_POST["is_type"]))
{
 $stmt->bindParam(':is_type', $_POST["is_type"], PDO::PARAM_STR);
}
    $stmt->execute();
     $row=$stmt->fetchAll(); 
     $val1=count($row);

$query1 = '';
if($length != -1)
{
 $query1 .= 'LIMIT ' . $start. ', ' . $length;
}
$query=$query . $query1;

 $stmt = $this->dbConnection->prepare($query);
    if(isset($_POST["is_type"]))
{
 $stmt->bindParam(':is_type', $_POST["is_type"], PDO::PARAM_STR);
}
    $stmt->execute();
     $row=$stmt->fetchAll(); 
   $val2=$row;
   $val3=count($row);
return array($val1,$val2);
    }


public function ajax_join($column,$table,$id,$search,$length,$start,$orderby,$type)
    { 
$query ="SELECT * 
FROM pexam 
JOIN pregistrations ON pexam.reg_id=pregistrations.reg_id WHERE 
";
if(isset($_POST["is_type"]))
{
  $query .= "$type = :is_type AND  ";
}
if(isset($search))
{
 $query .='('.$this->sql($column,$search).')';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['7']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= "ORDER BY $id $orderby ";
}
$stmt = $this->dbConnection->prepare($query);
if(isset($_POST["is_type"]))
{
      $stmt->bindParam(':is_type', $_POST["is_type"], PDO::PARAM_STR);
    }
    $stmt->execute();
     $row=$stmt->fetchAll(); 
     $val1=count($row);

$query1 = '';
if($length != -1)
{
 $query1 .= 'LIMIT ' . $start. ', ' . $length;
}
$query=$query . $query1;
 $stmt = $this->dbConnection->prepare($query);
 if(isset($_POST["is_type"]))
{
     $stmt->bindParam(':is_type', $_POST["is_type"], PDO::PARAM_STR);
 }
    $stmt->execute();
     $row=$stmt->fetchAll(); 
   $val2=$row;
return array($val1,$val2);
    }


       

} 

?> 