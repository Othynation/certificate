<?php Class Cer extends Database { 
	 private $dbConnection;
 function __construct($db)
 {
  $this->dbConnection = $db;
 }
 public function update_centre($title,$city,$id)
           {
            $sql = "UPDATE centres SET centre_name=:centre_name,city=:city WHERE cent_id=:id";
              $stmt = $this->dbConnection->prepare($sql);         
                   $stmt->bindParam(':centre_name',$title, PDO::PARAM_STR);
                      $stmt->bindParam(':city',$city, PDO::PARAM_STR);
                          $stmt->bindParam(':id',$id, PDO::PARAM_INT);
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
           public function update_schedule($is_postpone,$id)
           {
            $sql = "UPDATE schedual SET is_postpone=:is_postpone WHERE sid=:id";
              $stmt = $this->dbConnection->prepare($sql);         
                   $stmt->bindParam(':is_postpone',$is_postpone, PDO::PARAM_INT);
                          $stmt->bindParam(':id',$id, PDO::PARAM_INT);
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




                  public function insert_centre($title,$city)
           {
              $sql = "INSERT INTO centres(centre_name,city) VALUES(:centre_name,:city)";
              $stmt = $this->dbConnection->prepare($sql);         
                   $stmt->bindParam(':centre_name',$title, PDO::PARAM_STR);
                      $stmt->bindParam(':city',$city, PDO::PARAM_STR);
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

           public function update_salary($pid, $shamount, $shnote, $shdate, $cent_id, $id) {
    $sql = "UPDATE sh 
            SET pid = :pid, 
                shamount = :shamount, 
                shnote = :shnote, 
                shdate = :shdate, 
                cent_id = :cent_id 
            WHERE shid = :id";

    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
    $stmt->bindParam(':shamount', $shamount, PDO::PARAM_STR);
    $stmt->bindParam(':shnote', $shnote, PDO::PARAM_STR);
    $stmt->bindParam(':shdate', $shdate, PDO::PARAM_STR);
    $stmt->bindParam(':cent_id', $cent_id, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $res = $stmt->execute();
    return $res;
}


           public function insert_salary($pid, $shamount, $shnote, $shdate, $cent_id, $user_id) {
  $sql = "INSERT INTO sh(pid, shamount, shnote, shdate, cent_id, uid) 
          VALUES(:pid, :shamount, :shnote, :shdate, :cent_id, :user_id)";
  $stmt = $this->dbConnection->prepare($sql);
  $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
  $stmt->bindParam(':shamount', $shamount, PDO::PARAM_STR);
  $stmt->bindParam(':shnote', $shnote, PDO::PARAM_STR);
  $stmt->bindParam(':shdate', $shdate, PDO::PARAM_STR);
  $stmt->bindParam(':cent_id', $cent_id, PDO::PARAM_INT);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
  $res = $stmt->execute();
  if ($res) {
    return true;
  } else {
    return false;
  }
}




public function insert_expense($etype, $eamount, $enote, $edate, $cent_id,$user_id) {
  $sql = "INSERT INTO expenses(etype, eamount, enote, edate, cent_id,uid) VALUES(:etype, :eamount, :enote, :edate, :cent_id,:user_id)";
  $stmt = $this->dbConnection->prepare($sql);
  $stmt->bindParam(':etype', $etype, PDO::PARAM_STR);
  $stmt->bindParam(':eamount', $eamount, PDO::PARAM_STR);
  $stmt->bindParam(':enote', $enote, PDO::PARAM_STR);
  $stmt->bindParam(':edate', $edate, PDO::PARAM_STR);
  $stmt->bindParam(':cent_id', $cent_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
  $res = $stmt->execute();
  if ($res) {
    return true;
  } else {
    return false;
  }
}
public function update_expense($etype, $eamount, $enote, $edate, $cent_id, $id) {
  $sql = "UPDATE expenses SET 
          etype=:etype, 
          eamount=:eamount, 
          enote=:enote, 
          edate=:edate, 
          cent_id=:cent_id 
          WHERE exid=:id";
  $stmt = $this->dbConnection->prepare($sql);
  $stmt->bindParam(':etype', $etype, PDO::PARAM_STR);
  $stmt->bindParam(':eamount', $eamount, PDO::PARAM_STR);
  $stmt->bindParam(':enote', $enote, PDO::PARAM_STR);
  $stmt->bindParam(':edate', $edate, PDO::PARAM_STR);
  $stmt->bindParam(':cent_id', $cent_id, PDO::PARAM_INT);
  $stmt->bindParam(':id',$id, PDO::PARAM_INT);
  $res = $stmt->execute();
  if ($res) {
    return true;
  } else {
    return false;
  }
}




            public function insert_classroom($title,$uid)
           {
              $sql = "INSERT INTO classroom(classname,uid) VALUES(:centre_name,:uid)";
              $stmt = $this->dbConnection->prepare($sql);         
                   $stmt->bindParam(':centre_name',$title, PDO::PARAM_STR);
                      $stmt->bindParam(':uid',$uid, PDO::PARAM_INT);
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
public function update_marks($maid, $mark) {
    $sql = "UPDATE marks 
            SET marks = :mark 
            WHERE maid = :maid";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':maid', $maid, PDO::PARAM_INT);
    $stmt->bindParam(':mark', $mark, PDO::PARAM_INT);
    $res = $stmt->execute();
    return $res;
}

           public function insert_marks($id, $reg_ids, $marks, $user_id,$eid) {
    $sql = "INSERT INTO marks (sid, reg_id, marks, uid,eid) VALUES (:id, :reg_id, :mark, :user_id,:eid)";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':reg_id', $reg_ids, PDO::PARAM_INT);
    $stmt->bindParam(':mark', $marks, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
     $stmt->bindParam(':eid', $eid, PDO::PARAM_INT);
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

public function update_exam($ename, $mid, $edes, $new_image_name, $id) {
    $sql = "UPDATE exams 
            SET ename = :ename, 
                mid = :mid, 
                edes = :edes, 
                esource = :esource 
            WHERE eid=:id";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':ename', $ename, PDO::PARAM_STR);
    $stmt->bindParam(':mid', $mid, PDO::PARAM_INT);
    $stmt->bindParam(':edes', $edes, PDO::PARAM_STR);
    $stmt->bindParam(':esource', $new_image_name, PDO::PARAM_STR);
    $stmt->bindParam(':id',$id,PDO::PARAM_INT);
    $res = $stmt->execute();
    return $res;
}




           public function insert_exam($ename,$mid,$edes,$new_image_name,$user_id,$sid)
           {
              $sql = "INSERT INTO exams(ename, mid, edes, esource, uid, sid, ecreated) 
VALUES (:ename, :mid, :edes, :esource, :uid, :sid, :ecreated)";
$stmt = $this->dbConnection->prepare($sql);
$ecreated=$this->get_date();
$stmt->bindParam(':ename', $ename, PDO::PARAM_STR);
$stmt->bindParam(':mid', $mid, PDO::PARAM_INT);
$stmt->bindParam(':edes', $edes, PDO::PARAM_STR);
$stmt->bindParam(':esource', $new_image_name, PDO::PARAM_STR);
$stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
$stmt->bindParam(':sid', $sid, PDO::PARAM_INT);
$stmt->bindParam(':ecreated', $ecreated, PDO::PARAM_STR);
$res = $stmt->execute();
    $lastid = $this->dbConnection->lastInsertId();
    return $lastid;

           }

           public function insert_module($title, $fid, $user_id) {
  $sql = "INSERT INTO modules(modname, fid, uid,modcreated) VALUES(:title, :fid, :user_id,:modcreated)";
  $stmt = $this->dbConnection->prepare($sql);
  $date=$this->get_date();
  $stmt->bindParam(':title', $title, PDO::PARAM_STR);
  $stmt->bindParam(':fid', $fid, PDO::PARAM_INT);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':modcreated', $date, PDO::PARAM_STR);
  $res = $stmt->execute();
  if ($res) {
    return true;
  } else {
    return false;
  }
}
public function insert_payment($reg_id, $gid, $deposit, $paydate, $user_id) {
  $sql = "INSERT INTO payments(reg_id, gid, deposit, paydate, uid) 
          VALUES(:reg_id, :gid, :deposit, :paydate, :user_id)";
  $stmt = $this->dbConnection->prepare($sql);
  $date = $this->get_date();
  $stmt->bindParam(':reg_id', $reg_id, PDO::PARAM_INT);
  $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);
  $stmt->bindParam(':deposit', $deposit, PDO::PARAM_STR);
  $stmt->bindParam(':paydate', $paydate, PDO::PARAM_STR);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $res = $stmt->execute();
  if ($res) {
    return true;
  } else {
    return false;
  }
}

public function update_payment($paydate, $deposit, $id) {
  $sql = "UPDATE payments 
          SET paydate = :paydate, deposit = :deposit 
          WHERE pay_id = :id";
  $stmt = $this->dbConnection->prepare($sql);
  $stmt->bindParam(':paydate', $paydate, PDO::PARAM_STR);
  $stmt->bindParam(':deposit', $deposit, PDO::PARAM_STR);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $res = $stmt->execute();
  if ($res) {
    return true;
  } else {
    return false;
  }
}





public function update_module($title, $fid,$id) {
  $sql = "UPDATE modules SET modname=:title, fid=:fid WHERE mid=:id";
  $stmt = $this->dbConnection->prepare($sql);
  $stmt->bindParam(':title', $title, PDO::PARAM_STR);
  $stmt->bindParam(':fid', $fid, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $res = $stmt->execute();
  if ($res) {
    return true;
  } else {
    return false;
  }
}





           public function update_classroom($id, $title) {
    $sql = "UPDATE classroom SET classname = :centre_name WHERE clsid = :id";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':centre_name', $title, PDO::PARAM_STR);
    $res = $stmt->execute();
    if ($res) {
        return true;
    } else {
        return false;
    }
}




               public function insert_formation($title,$abbreviation)
           {
              $sql = "INSERT INTO formation(formation_name,abbreviation) VALUES(:centre_name,:abbreviation)";
              $stmt = $this->dbConnection->prepare($sql);         
                   $stmt->bindParam(':centre_name',$title, PDO::PARAM_STR);
                    $stmt->bindParam(':abbreviation',$abbreviation, PDO::PARAM_STR);
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
            public function update_formation($title,$abbreviation,$id)
           {
            $sql = "UPDATE formation SET formation_name=:centre_name,abbreviation=:abbreviation WHERE fid=:id";
              $stmt = $this->dbConnection->prepare($sql);         
                   $stmt->bindParam(':centre_name',$title, PDO::PARAM_STR);
                    $stmt->bindParam(':abbreviation',$abbreviation, PDO::PARAM_STR);
                          $stmt->bindParam(':id',$id, PDO::PARAM_INT);
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




           public function checkImage($image,$id,$type)
           {
            if($image!='')
            {
                if($type=='reg')
                {
                     return '<img src="uploads/'.$image.'" height="100"> <a href="remove?image='.$image.'&to=registrations&folder=uploads/&table=registrations&id='.$id.'&col=image&colid=reg_id" onClick=\'return confirm("Are you sure you want to remove this photo ?")\' ><div class="icon-bin" style="color:red;"></div></a>';
                }
               
               else 
               {
                return '<img src="uploads/'.$image.'" height="100">';
               }

            }
            else 
            {
                return '<img src="uploads/noimagecx.png" height="100"><br>';

            }
           }
           public function checkSign($image,$id,$type)
           {
            if($image!='')
            {
                if($type=='reg')
                {
                  return '<img src="uploads/'.$image.'" height="50" width="100"><a href="remove?image='.$image.'&to=registrations&folder=uploads/&table=registrations&id='.$id.'&col=sign&colid=reg_id" onClick=\'return confirm("Are you sure you want to remove this signature ?")\' ><div class="icon-bin" style="color:red;"></div></a>';  
                }
                else 
                {
                    return '<img src="uploads/'.$image.'" height="50" width="100">';

                }
                

            }
            else 
            {
                return '<img src="uploads/noimagecx.png" height="50"><br>';

            }
           }

           public function update_more($sign,$watermark,$certified,$stamp,$iso,$id)
           {
             $sql = "UPDATE more SET signature=:signature,watermark=:watermark,certified=:certified,stamp=:stamp,iso=:iso WHERE id=:id";
              $stmt = $this->dbConnection->prepare($sql);         
                   $stmt->bindParam(':signature',$sign, PDO::PARAM_STR);
                  $stmt->bindParam(':watermark',$watermark, PDO::PARAM_STR);
                    $stmt->bindParam(':certified',$certified, PDO::PARAM_STR);
                      $stmt->bindParam(':stamp',$stamp, PDO::PARAM_STR);
                       $stmt->bindParam(':iso',$iso, PDO::PARAM_STR);
                  $stmt->bindParam(':id',$id, PDO::PARAM_INT);
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
           public function update_remove($table,$col,$colid,$id)
           {
             $sql = "UPDATE $table SET $col=:col WHERE $colid=:id";
              $stmt = $this->dbConnection->prepare($sql);  
              $image=Null;       
                       $stmt->bindParam(':col',$image, PDO::PARAM_STR);
                  $stmt->bindParam(':id',$id, PDO::PARAM_INT);
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

                public function insert_reg($honorifics,$username,$cin,$dob,$bplace,$address,$mobile,$fid,$cent_id,$image)
           {
             $sql = "INSERT INTO  registrations(name,reg_date,cin,dob,bplace,address,fid,cent_id,mobile,honorific,uid,image) VALUES(:username,:reg_date,:cin,:dob,:bplace,:address,:fid,:cent_id,:mobile,:honorific,:uid,:image)";
              $stmt = $this->dbConnection->prepare($sql);   
                $reg_date=$this->get_date();
                $uid=$_SESSION["user_id"];
                   $stmt->bindParam(':username',$username, PDO::PARAM_STR);
                    $stmt->bindParam(':reg_date',$reg_date, PDO::PARAM_STR);
                   $stmt->bindParam(':cin',$cin, PDO::PARAM_STR);
                   $stmt->bindParam(':dob',$dob, PDO::PARAM_STR);
                   $stmt->bindParam(':bplace',$bplace, PDO::PARAM_STR);
                   $stmt->bindParam(':address',$address, PDO::PARAM_STR);
                    $stmt->bindParam(':fid',$fid, PDO::PARAM_INT);
                     $stmt->bindParam(':cent_id',$cent_id, PDO::PARAM_INT);
                   $stmt->bindParam(':mobile',$mobile, PDO::PARAM_STR);
                     $stmt->bindParam(':honorific',$honorifics, PDO::PARAM_STR);
                      $stmt->bindParam(':image',$image, PDO::PARAM_STR);
                          $stmt->bindParam(':uid',$uid, PDO::PARAM_STR);
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
           public function update_reg($honorifics,$username,$cin,$dob,$bplace,$address,$mobile,$fid,$cent_id,$image,$id) 
           {
             $sql = "UPDATE registrations SET name=:username,honorific=:honorific,cin=:cin,dob=:dob,bplace=:bplace,address=:address,fid=:fid,cent_id=:cent_id,mobile=:mobile,image=:image WHERE reg_id=:id";
              $stmt = $this->dbConnection->prepare($sql);   
             $stmt->bindParam(':username',$username, PDO::PARAM_STR);
                   $stmt->bindParam(':cin',$cin, PDO::PARAM_STR);
                   $stmt->bindParam(':dob',$dob, PDO::PARAM_STR);
                   $stmt->bindParam(':bplace',$bplace, PDO::PARAM_STR);
                   $stmt->bindParam(':address',$address, PDO::PARAM_STR);
                    $stmt->bindParam(':fid',$fid, PDO::PARAM_INT);
                     $stmt->bindParam(':cent_id',$cent_id, PDO::PARAM_INT);
                   $stmt->bindParam(':mobile',$mobile, PDO::PARAM_STR);
                     $stmt->bindParam(':honorific',$honorifics, PDO::PARAM_STR);
                        $stmt->bindParam(':image',$image, PDO::PARAM_STR);
                           $stmt->bindParam(':id',$id, PDO::PARAM_INT);
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
           public function randomKey($limit){
$values = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
$count = strlen($values);
$count--;
$key=NULL;
    for($x=1;$x<=$limit;$x++){
        $rand_var = rand(0,$count);
        $key .= substr($values,$rand_var,1);
    }

return strtolower($key);
}
public function insert_comment($cm_des, $user_id, $inid) {
  $sql = "INSERT INTO comments(cm_des, inid, uid, cm_created) VALUES(:cm_des, :inid, :uid, :cm_created)";
  $stmt = $this->dbConnection->prepare($sql);
  $cm_created = $this->get_date();
  $stmt->bindParam(':cm_des', $cm_des, PDO::PARAM_STR);
  $stmt->bindParam(':inid', $inid, PDO::PARAM_INT);
  $stmt->bindParam(':uid', $user_id, PDO::PARAM_INT);
  $stmt->bindParam(':cm_created', $cm_created, PDO::PARAM_STR);
  $res = $stmt->execute();
               if($res)
               {
                return true;
               }
               else 
               {
                return false;
               }
}





public function insert_inscription($reg_id, $gid, $instatus, $indeposit, $infees,$indate, $indedeut, $intime, $inreceived) {
    $sql = "INSERT INTO inscription(reg_id, gid, instatus, inservicefees, infees, indate, indedate_debut, intime, inreceived, icreated, uid) 
            VALUES(:reg_id, :gid, :instatus, :indeposit, :infees, :indate, :indedeut, :intime, :inreceived, :icreated, :uid)";
    $stmt = $this->dbConnection->prepare($sql);
    $icreated = $this->get_date();
    $uid = $_SESSION["user_id"];
    $stmt->bindParam(':reg_id', $reg_id, PDO::PARAM_INT);
    $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);
    $stmt->bindParam(':instatus', $instatus, PDO::PARAM_STR);
    $stmt->bindParam(':indeposit', $indeposit, PDO::PARAM_STR);
    $stmt->bindParam(':infees', $infees, PDO::PARAM_STR);
    //$stmt->bindParam(':intotal', $intotal, PDO::PARAM_STR);
    $stmt->bindParam(':indate', $indate, PDO::PARAM_STR);
    $stmt->bindParam(':indedeut', $indedeut, PDO::PARAM_STR);
    $stmt->bindParam(':intime', $intime, PDO::PARAM_STR);
    $stmt->bindParam(':inreceived', $inreceived, PDO::PARAM_STR);
    $stmt->bindParam(':icreated', $icreated, PDO::PARAM_STR);
    $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
    $res = $stmt->execute();
    $lastid = $this->dbConnection->lastInsertId();
    return $lastid;
}
public function update_inscription($reg_id, $gid, $instatus, $indeposit, $infees,$indate, $indedeut, $intime, $inreceived, $id) {
    $sql = "UPDATE inscription SET reg_id=:reg_id,gid=:gid,instatus=:instatus,inservicefees=:indeposit,infees=:infees,indate=:indate,indedate_debut=:indedeut,intime=:intime,inreceived=:inreceived WHERE inid=:id";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':reg_id', $reg_id, PDO::PARAM_INT);
    $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);
    $stmt->bindParam(':instatus', $instatus, PDO::PARAM_STR);
    $stmt->bindParam(':indeposit', $indeposit, PDO::PARAM_STR);
    $stmt->bindParam(':infees', $infees, PDO::PARAM_STR);
    //$stmt->bindParam(':intotal', $intotal, PDO::PARAM_STR);
    $stmt->bindParam(':indate', $indate, PDO::PARAM_STR);
    $stmt->bindParam(':indedeut', $indedeut, PDO::PARAM_STR);
    $stmt->bindParam(':intime', $intime, PDO::PARAM_STR);
    $stmt->bindParam(':inreceived', $inreceived, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $res = $stmt->execute();
               if($res)
               {
                return true;
               }
               else 
               {
                return false;
               }

}



public function insert_group($gname, $fid, $classno, $nomformation,$gstatus,$uid,$cent_id) {
$sql = "INSERT INTO groups(gname, fid, classno, nomformation, gstatus,uid,gdate,cnt_id) VALUES(:gname, :fid, :classno, :nomformation, :gstatus,:uid,:gdate,:cent_id)";
$stmt = $this->dbConnection->prepare($sql);
$date=$this->get_date();
$stmt->bindParam(':gname', $gname, PDO::PARAM_STR);
$stmt->bindParam(':fid', $fid, PDO::PARAM_INT);
$stmt->bindParam(':classno', $classno, PDO::PARAM_INT);
$stmt->bindParam(':nomformation', $nomformation, PDO::PARAM_INT);
$stmt->bindParam(':gstatus', $gstatus, PDO::PARAM_STR);
$stmt->bindParam(':gdate', $date, PDO::PARAM_STR);
$stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
$stmt->bindParam(':cent_id', $cent_id, PDO::PARAM_INT);
$stmt->execute();
$lastid=$this->dbConnection->lastInsertId();
return $lastid;
}
public function update_group2($classno,$id)
{
$sql = "UPDATE groups SET classno = :classno WHERE gid = :id";
$stmt = $this->dbConnection->prepare($sql);
$stmt->bindParam(':classno', $classno, PDO::PARAM_INT);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
return $stmt->execute();
}
public function update_group($gname, $fid, $classno, $nomformation, $gstatus, $cent_id,$id)
 {
$sql = "UPDATE groups SET gname = :gname, fid = :fid, classno = :classno, nomformation = :nomformation, gstatus = :gstatus,cnt_id=:cent_id WHERE gid = :id";
$stmt = $this->dbConnection->prepare($sql);
$stmt->bindParam(':gname', $gname, PDO::PARAM_STR);
$stmt->bindParam(':fid', $fid, PDO::PARAM_INT);
$stmt->bindParam(':classno', $classno, PDO::PARAM_INT);
$stmt->bindParam(':nomformation', $nomformation, PDO::PARAM_INT);
$stmt->bindParam(':gstatus', $gstatus, PDO::PARAM_INT);
$stmt->bindParam(':cent_id', $cent_id, PDO::PARAM_INT);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
return $stmt->execute();
}

public function insert_presence($sid,$reg_id,$status,$uid,$pnote)
{
$sql = "INSERT INTO presence(sid,reg_id,pre,prdate,uid,pnote) VALUES (:sid,:reg_id,:pre,:prdate,:uid,:pnote)";
$stmt = $this->dbConnection->prepare($sql);
$prdate=$this->get_date2();
$stmt->bindParam(':reg_id', $reg_id, PDO::PARAM_INT);
$stmt->bindParam(':pre', $status, PDO::PARAM_INT);
$stmt->bindParam(':prdate', $prdate, PDO::PARAM_STR);
$stmt->bindParam(':sid', $sid, PDO::PARAM_INT);
$stmt->bindParam(':uid', $uid, PDO::PARAM_INT);
$stmt->bindParam(':pnote', $pnote, PDO::PARAM_STR);
$res = $stmt->execute();
               if($res)
               {
                return true;
               }
               else 
               {
                return false;
}

}
public function update_presence($reg_id, $status, $pnote,$id) {
    $sql = "UPDATE presence SET  pre=:pre,pnote=:pnote WHERE prid=:id AND reg_id=:reg_id";
    $stmt = $this->dbConnection->prepare($sql);
    $prdate = $this->get_date2();
    $stmt->bindParam(':reg_id', $reg_id, PDO::PARAM_INT);
    $stmt->bindParam(':pre', $status, PDO::PARAM_INT);
    $stmt->bindParam(':pnote', $pnote, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $res = $stmt->execute();
    if ($res) {
        return true;
    } else {
        return false;
    }
}


public function insert_schedule($day, $from, $to, $pid, $classroom, $lastid, $sdate, $st, $sm) {
$sql = "INSERT INTO schedual (sday, sfrom, sto, pid, classroom, gid, sdate, salary_type, samount) VALUES (:day, :sfrom, :sto, :pid, :classroom, :lastid, :sdate, :st, :sm)";
$stmt = $this->dbConnection->prepare($sql);
$stmt->bindParam(':day', $day, PDO::PARAM_STR);
$stmt->bindParam(':sfrom', $from, PDO::PARAM_STR);
$stmt->bindParam(':sto', $to, PDO::PARAM_STR);
$stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
$stmt->bindParam(':classroom', $classroom, PDO::PARAM_STR);
$stmt->bindParam(':sdate', $sdate, PDO::PARAM_STR);
$stmt->bindParam(':st', $st, PDO::PARAM_INT);
$stmt->bindParam(':sm', $sm, PDO::PARAM_INT);
$stmt->bindParam(':lastid', $lastid, PDO::PARAM_INT);
$res = $stmt->execute();
if($res) {
return true;
} else {
return false;
}
}
public function insert_schedule4($day, $from, $to, $pid, $classroom, $lastid, $sdate,$sid, $st, $sm,$sparent_id) {
$sql = "INSERT INTO schedual (sday, sfrom, sto, pid, classroom, gid, sdate, sid , salary_type, samount,sparent_id) VALUES (:day, :sfrom, :sto, :pid, :classroom, :lastid, :sdate, :sid, :st, :sm,:sparent_id)";
$stmt = $this->dbConnection->prepare($sql);
$stmt->bindParam(':day', $day, PDO::PARAM_STR);
$stmt->bindParam(':sfrom', $from, PDO::PARAM_STR);
$stmt->bindParam(':sto', $to, PDO::PARAM_STR);
$stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
$stmt->bindParam(':classroom', $classroom, PDO::PARAM_STR);
$stmt->bindParam(':sdate', $sdate, PDO::PARAM_STR);
$stmt->bindParam(':st', $st, PDO::PARAM_INT);
$stmt->bindParam(':sm', $sm, PDO::PARAM_INT);
$stmt->bindParam(':lastid', $lastid, PDO::PARAM_INT);
$stmt->bindParam(':sparent_id', $sparent_id, PDO::PARAM_STR);
$stmt->bindParam(':sid', $sid, PDO::PARAM_INT);
$res = $stmt->execute();
if($res) {
return true;
} else {
return false;
}
}


public function insert_schedule3($day, $from, $to, $pid, $classroom, $lastid, $sdate, $st, $sm,$sparent_id) {
$sql = "INSERT INTO schedual (sday, sfrom, sto, pid, classroom, gid, sdate, salary_type, samount,sparent_id) VALUES (:day, :sfrom, :sto, :pid, :classroom, :lastid, :sdate, :st, :sm,:sparent_id)";
$stmt = $this->dbConnection->prepare($sql);
$stmt->bindParam(':day', $day, PDO::PARAM_STR);
$stmt->bindParam(':sfrom', $from, PDO::PARAM_STR);
$stmt->bindParam(':sto', $to, PDO::PARAM_STR);
$stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
$stmt->bindParam(':classroom', $classroom, PDO::PARAM_STR);
$stmt->bindParam(':sdate', $sdate, PDO::PARAM_STR);
$stmt->bindParam(':st', $st, PDO::PARAM_INT);
$stmt->bindParam(':sm', $sm, PDO::PARAM_INT);
$stmt->bindParam(':lastid', $lastid, PDO::PARAM_INT);
$stmt->bindParam(':sparent_id', $sparent_id, PDO::PARAM_INT);
$res = $stmt->execute();
if($res) {
return true;
} else {
return false;
}
}

public function insert_schedule_psid($day, $from, $to, $pid, $classroom, $lastid, $sdate, $st, $sm,$psid) {
$sql = "INSERT INTO schedual (sday, sfrom, sto, pid, classroom, gid, sdate, salary_type, samount, postpone_psid) VALUES (:day, :sfrom, :sto, :pid, :classroom, :lastid, :sdate, :st, :sm, :psid)";
$stmt = $this->dbConnection->prepare($sql);
$stmt->bindParam(':day', $day, PDO::PARAM_STR);
$stmt->bindParam(':sfrom', $from, PDO::PARAM_STR);
$stmt->bindParam(':sto', $to, PDO::PARAM_STR);
$stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
$stmt->bindParam(':classroom', $classroom, PDO::PARAM_STR);
$stmt->bindParam(':sdate', $sdate, PDO::PARAM_STR);
$stmt->bindParam(':st', $st, PDO::PARAM_INT);
$stmt->bindParam(':sm', $sm, PDO::PARAM_INT);
$stmt->bindParam(':psid', $psid, PDO::PARAM_INT);
$stmt->bindParam(':lastid', $lastid, PDO::PARAM_INT);
$res = $stmt->execute();
if($res) {
return true;
} else {
return false;
}
}


public function createNextWeekSchedules() {
    // Check if today is Sunday
    // if (date('w') !== 0) { 
    //     return; 
    // }

    // Retrieve schedules with nomformation > 0 from groups
    $sql = "SELECT s.*, g.nomformation 
            FROM schedual s 
            JOIN groups g ON s.gid = g.gid 
            WHERE g.nomformation > 0";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->execute();
    $schedules = $stmt->fetchAll();
    
    // Loop through schedules
    foreach ($schedules as $schedule) {
        // Get last created schedule date for this group
        $lastScheduleDateSql = "SELECT MAX(sdate) AS last_sdate 
                                FROM schedual 
                                WHERE gid = :gid AND sdate > :admin_sdate";
        $lastScheduleDateStmt = $this->dbConnection->prepare($lastScheduleDateSql);
        $lastScheduleDateStmt->bindParam(':gid', $schedule['gid'], PDO::PARAM_INT);
        $lastScheduleDateStmt->bindParam(':admin_sdate', $schedule['sdate'], PDO::PARAM_STR);
        $lastScheduleDateStmt->execute();
        $lastScheduleDate = $lastScheduleDateStmt->fetchColumn();
        
        // If no last schedule date, use admin-created schedule date
        $lastScheduleDate = $lastScheduleDate ?: $schedule['sdate'];
        
        // Count created schedules for this group
        $countSql = "SELECT COUNT(*) FROM schedual WHERE gid = :gid AND sdate > :admin_sdate";
        $countStmt = $this->dbConnection->prepare($countSql);
        $countStmt->bindParam(':gid', $schedule['gid'], PDO::PARAM_INT);
        $countStmt->bindParam(':admin_sdate', $schedule['sdate'], PDO::PARAM_STR);
        $countStmt->execute();
        $createdCount = $countStmt->fetchColumn();
        
        // Check if created count is less than nomformation
        if ($createdCount < $schedule['nomformation'] - 1) { 
            // Calculate next schedule date (7 days from last created schedule)
            echo $nextScheduleDate = date('Y-m-d', strtotime('+1 week', strtotime($lastScheduleDate)));
            
            // Create new schedule
            // $this->insert_schedule(
            //     $schedule['sday'],
            //     $schedule['sfrom'],
            //     $schedule['sto'],
            //     $schedule['pid'],
            //     $schedule['classroom'],
            //     $schedule['gid'],
            //     $nextScheduleDate
            // );
        }
    }
}


public function createAllWeeksSchedules($gid) {
    // Check if schedules already exist for the group
    $existingSchedulesSql = "SELECT COUNT(*) FROM schedual WHERE gid = :gid";
    $existingSchedulesStmt = $this->dbConnection->prepare($existingSchedulesSql);
    $existingSchedulesStmt->bindParam(':gid', $gid, PDO::PARAM_INT);
    $existingSchedulesStmt->execute();
    $existingSchedulesCount = $existingSchedulesStmt->fetchColumn();

    // Retrieve schedules for the specified group (gid)
    $sql = "SELECT s.*, g.nomformation FROM schedual s JOIN groups g ON s.gid = g.gid WHERE s.gid = :gid AND g.nomformation > 0 AND s.is_postpone!=1 AND s.sparent_id IS NULL";
    $stmt = $this->dbConnection->prepare($sql);
    $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);
    $stmt->execute();
    $schedules = $stmt->fetchAll();

    // Retrieve nomformation value
    if (!empty($schedules)) {
    $nomformation = $schedules[0]['nomformation'];
    $initialScheduleDate = strtotime($schedules[0]['sdate']);
    $endDate = date('Y-m-d', strtotime('+' . $nomformation . ' months', $initialScheduleDate));

    $start_date = date('Y-m-d', $initialScheduleDate);
    $end_date = $endDate;

    $existingSchedulesSql = "SELECT COUNT(*) FROM schedual WHERE gid = :gid AND sdate BETWEEN :start_date AND :end_date";
    $existingSchedulesStmt = $this->dbConnection->prepare($existingSchedulesSql);
    $existingSchedulesStmt->bindParam(':gid', $gid, PDO::PARAM_INT);
    $existingSchedulesStmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
    $existingSchedulesStmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
    $existingSchedulesStmt->execute();
    $existingSchedulesCount = $existingSchedulesStmt->fetchColumn();

    if ($nomformation == 1) {
        // Check if schedules exist for the next month
        $nextMonthStartDate = date('Y-m-d', strtotime('+1 month', $initialScheduleDate));
        $nextMonthEndDate = date('Y-m-d', strtotime('+1 month', strtotime($endDate)));
        $existingSchedulesSql = "SELECT COUNT(*) FROM schedual WHERE gid = :gid AND sdate BETWEEN :start_date AND :end_date";
        $existingSchedulesStmt = $this->dbConnection->prepare($existingSchedulesSql);
        $existingSchedulesStmt->bindParam(':gid', $gid, PDO::PARAM_INT);
        $existingSchedulesStmt->bindParam(':start_date', $nextMonthStartDate, PDO::PARAM_STR);
        $existingSchedulesStmt->bindParam(':end_date', $nextMonthEndDate, PDO::PARAM_STR);
        $existingSchedulesStmt->execute();
        $existingSchedulesCount = $existingSchedulesStmt->fetchColumn();

        if ($existingSchedulesCount > 0) {
            return "Schedules already exist for this group.";
        }
    } else {
        if ($existingSchedulesCount >= $nomformation * count($schedules)) {
            return "Schedules already exist for this group.";
        }
    }
}


    // Acquire lock for the group
    $lockSql = "SELECT GET_LOCK('create_schedules_$gid', 300)";
    $lockStmt = $this->dbConnection->prepare($lockSql);
    $lockStmt->execute();
    $lockResult = $lockStmt->fetchColumn();

    // If lock cannot be acquired, return error message
    if ($lockResult != 1) {
        return "Failed to acquire lock. Try again later.";
    }


    // Loop through each schedule
    foreach ($schedules as $index => $schedule) {
        // Get initial schedule date from schedule
        if ($nomformation == 1) {
            $initialScheduleDate = strtotime($schedule['sdate']) + (7 * 24 * 60 * 60); // Add 7 days for child schedules
        } else {
            $initialScheduleDate = strtotime($schedule['sdate']) + ($index * 30 * 24 * 60 * 60);
        }

        // Convert initial schedule date back to string
        $initialScheduleDate = date('Y-m-d', $initialScheduleDate);

        // Calculate end date (nomformation months from initial schedule date)
        $endDate = date('Y-m-d', strtotime('+' . $nomformation . ' months', strtotime($initialScheduleDate)));

        // Initialize current schedule date
        //$currentScheduleDate = $initial;
            // Initialize current schedule date
        $currentScheduleDate = $initialScheduleDate;
        $sparent_id = $schedule['sid'];

          // Loop until end date
        while ($currentScheduleDate <= $endDate) {
            // Check if current schedule date is Sunday
            if (date('w', strtotime($currentScheduleDate)) == 0) {
                $currentScheduleDate = date('Y-m-d', strtotime('+1 day', strtotime($currentScheduleDate)));
                continue;
            }

            // Check if schedule already exists for this date and sid
            $existingScheduleSql = "SELECT COUNT(*) FROM schedual WHERE gid = :gid AND sdate = :sdate AND sparent_id = :sparent_id";
            $existingScheduleStmt = $this->dbConnection->prepare($existingScheduleSql);
            $existingScheduleStmt->bindParam(':gid', $gid, PDO::PARAM_INT);
            $existingScheduleStmt->bindParam(':sdate', $currentScheduleDate, PDO::PARAM_STR);
            $existingScheduleStmt->bindParam(':sparent_id', $sparent_id, PDO::PARAM_INT);
            $existingScheduleStmt->execute();
            $existingScheduleCount = $existingScheduleStmt->fetchColumn();

            // If schedule doesn't exist, create new schedule
            if ($existingScheduleCount == 0) {
                // Insert schedule
                $this->insert_schedule3(
                    $schedule['sday'],
                    $schedule['sfrom'],
                    $schedule['sto'],
                    $schedule['pid'],
                    $schedule['classroom'],
                    $gid,
                    $currentScheduleDate,
                    $schedule['salary_type'],
                    $schedule['samount'],
                    $sparent_id
                );
            }

            // Increment current schedule date by 7 days
            $currentScheduleDate = date('Y-m-d', strtotime('+1 week', strtotime($currentScheduleDate)));
        }
    }

    // Release lock after completion
    $unlockSql = "SELECT RELEASE_LOCK('create_schedules_$gid')";
    $unlockStmt = $this->dbConnection->prepare($unlockSql);
    $unlockStmt->execute();

    return "Schedules created successfully.";
}






public function insert_schedule2($day, $from, $to, $pid, $classroom, $lastid, $sdate,$sid,$st,$sm) {
$sql = "INSERT INTO schedual (sid,sday, sfrom, sto, pid, classroom, gid, sdate, salary_type,samount) VALUES (:sid,:day, :sfrom, :sto, :pid, :classroom, :lastid, :sdate,:st,:sm)";
$stmt = $this->dbConnection->prepare($sql);
$stmt->bindParam(':sid', $sid, PDO::PARAM_INT);
$stmt->bindParam(':day', $day, PDO::PARAM_STR);
$stmt->bindParam(':sfrom', $from, PDO::PARAM_STR);
$stmt->bindParam(':sto', $to, PDO::PARAM_STR);
$stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
$stmt->bindParam(':classroom', $classroom, PDO::PARAM_STR);
$stmt->bindParam(':sdate', $sdate, PDO::PARAM_STR);
$stmt->bindParam(':st', $st, PDO::PARAM_INT);
$stmt->bindParam(':sm', $sm, PDO::PARAM_INT);
$stmt->bindParam(':lastid', $lastid, PDO::PARAM_INT);
$res = $stmt->execute();
if($res) {
return true;
} else {
return false;
}
}



            public function insert_certificate($reg_id,$cyear,$cdate,$mois,$niveau,$heures,$fid)
           {

            $sql = "INSERT INTO certificates(reg_id,cyear,cdate,mois,niveau,heures,ccreated,uid,fid) VALUES(:reg_id,:cyear,:cdate,:mois,:niveau,:heures,:ccreated,:uid,:fid)";
              $stmt = $this->dbConnection->prepare($sql);   
              $ccreated=$this->get_date(); 
                   $uid=$_SESSION["user_id"]; 
                    $stmt->bindParam(':reg_id',$reg_id, PDO::PARAM_INT);
                           $stmt->bindParam(':cyear',$cyear, PDO::PARAM_INT);
                            $stmt->bindParam(':cdate',$cdate, PDO::PARAM_STR);
                             $stmt->bindParam(':mois',$mois, PDO::PARAM_STR);
                                $stmt->bindParam(':niveau',$niveau, PDO::PARAM_STR);
                                $stmt->bindParam(':heures',$heures, PDO::PARAM_STR);
                                $stmt->bindParam(':ccreated',$ccreated, PDO::PARAM_STR);
                                 $stmt->bindParam(':uid',$uid, PDO::PARAM_STR);
                                     $stmt->bindParam(':fid',$fid, PDO::PARAM_INT);
             $res=$stmt->execute();
 $lastid =$this->dbConnection->lastInsertId();
               return $lastid; 
           }

            public function update_certificate($reg_id,$cyear,$cdate,$mois,$niveau,$heures,$fid,$id)
           {
            $sql = "UPDATE certificates SET reg_id=:reg_id,cyear=:cyear,cdate=:cdate,mois=:mois,niveau=:niveau,heures=:heures,fid=:fid WHERE cid=:id";
              $stmt = $this->dbConnection->prepare($sql);   
                    $stmt->bindParam(':reg_id',$reg_id, PDO::PARAM_INT);
                           $stmt->bindParam(':cyear',$cyear, PDO::PARAM_INT);
                            $stmt->bindParam(':cdate',$cdate, PDO::PARAM_STR);
                             $stmt->bindParam(':mois',$mois, PDO::PARAM_STR);
                                $stmt->bindParam(':niveau',$niveau, PDO::PARAM_STR);
                                $stmt->bindParam(':heures',$heures, PDO::PARAM_STR);
                                     $stmt->bindParam(':fid',$fid, PDO::PARAM_STR);
                                $stmt->bindParam(':id',$id, PDO::PARAM_INT);
                            
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
            public function update_cno($cno,$id)
           {
            $sql = "UPDATE certificates SET cno=:cno WHERE cid=:id";
              $stmt = $this->dbConnection->prepare($sql);   
                    $stmt->bindParam(':cno',$cno, PDO::PARAM_STR);
                     $stmt->bindParam(':id',$id, PDO::PARAM_INT);        
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
  public function user_image($val)
 {
     if($val!='')
     {
        return '<img src="assets/profile/'.$val.'" height="70">'; 

     }
     else 
     {
      return '<img src="assets/icon/avatar.png" height="70">';    
     }
 }



}
?>