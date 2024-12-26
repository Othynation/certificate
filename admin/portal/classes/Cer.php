<?php Class Cer extends Database { 
	 private $dbConnection;
 function __construct($db)
 {
  $this->dbConnection = $db;
 }
   public function insert_state($st_name)
        {
            $sql = "INSERT INTO pstate(sname) VALUES(:st_name)";
                                  $stmt = $this->dbConnection->prepare($sql);

            $stmt->bindParam(':st_name',$st_name, PDO::PARAM_STR);
          
          
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
        public function update_institute($name,$reg_no,$address,$mobile,$idate,$sid,$did,$tid,$id)
        {
$sql = "UPDATE pinstitute SET iname=:name,ireg_no=:reg_no,iaddress=:address,imobile=:mobile,idate=:idate,sid=:sid,did=:did,tid=:tid WHERE iid=:id";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':name',$name, PDO::PARAM_STR);
              $stmt->bindParam(':reg_no',$reg_no, PDO::PARAM_STR);
                $stmt->bindParam(':address',$address, PDO::PARAM_STR);
                  $stmt->bindParam(':mobile',$mobile, PDO::PARAM_STR);
                    $stmt->bindParam(':idate',$idate, PDO::PARAM_STR);
                      $stmt->bindParam(':sid',$sid, PDO::PARAM_INT);
                        $stmt->bindParam(':did',$did, PDO::PARAM_INT);
                         $stmt->bindParam(':tid',$tid, PDO::PARAM_INT);
                         $stmt->bindParam(':id',$id, PDO::PARAM_INT);
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
        public function insert_institute($name,$reg_no,$address,$mobile,$idate,$sid,$did,$tid)
        {
$sql = "INSERT INTO pinstitute(iname,ireg_no,iaddress,imobile,idate,sid,did,tid) VALUES(:name,:reg_no,:address,:mobile,:idate,:sid,:did,:tid)";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':name',$name, PDO::PARAM_STR);
              $stmt->bindParam(':reg_no',$reg_no, PDO::PARAM_STR);
                $stmt->bindParam(':address',$address, PDO::PARAM_STR);
                  $stmt->bindParam(':mobile',$mobile, PDO::PARAM_STR);
                    $stmt->bindParam(':idate',$idate, PDO::PARAM_STR);
                      $stmt->bindParam(':sid',$sid, PDO::PARAM_INT);
                        $stmt->bindParam(':did',$did, PDO::PARAM_INT);
                         $stmt->bindParam(':tid',$tid, PDO::PARAM_INT);
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
        public function insert_taluka($sname,$sid)
         {
            $sql = "INSERT INTO ptaluka(tname,did) VALUES(:st_name,:sid)";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':st_name',$sname, PDO::PARAM_STR);
            $stmt->bindParam(':sid',$sid, PDO::PARAM_STR);
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

        public function insert_district($st_name,$sid)
        {
            $sql = "INSERT INTO pdistrict(dname,sid) VALUES(:st_name,:sid)";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':st_name',$st_name, PDO::PARAM_STR);
            $stmt->bindParam(':sid',$sid, PDO::PARAM_STR);
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

        
        public function update_state($st_name,$id){
     $sql = "UPDATE pstate SET sname=:st_name WHERE sid=:st_id";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':st_name',$st_name, PDO::PARAM_STR);
            $stmt->bindParam(':st_id',$id, PDO::PARAM_INT);
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
        
        public function update_district($st_name,$sid,$id)
        {
     $sql = "UPDATE pdistrict SET dname=:st_name,sid=:sid WHERE did=:st_id";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':st_name',$st_name, PDO::PARAM_STR);
                 $stmt->bindParam(':sid',$sid, PDO::PARAM_STR);
            $stmt->bindParam(':st_id',$id, PDO::PARAM_INT);
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
public function update_taluka($st_name,$sid,$id)
        {
     $sql = "UPDATE ptaluka SET tname=:st_name,did=:sid WHERE tid=:st_id";
            $stmt = $this->dbConnection->prepare($sql);
            $stmt->bindParam(':st_name',$st_name, PDO::PARAM_STR);
                 $stmt->bindParam(':sid',$sid, PDO::PARAM_STR);
            $stmt->bindParam(':st_id',$id, PDO::PARAM_INT);
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



 public function update_subject($subject,$id)
           {
            $sql = "UPDATE dep SET dep_title=:subject_name WHERE dep_id=:id";
              $stmt = $this->dbConnection->prepare($sql);         
                   $stmt->bindParam(':subject_name',$subject, PDO::PARAM_STR);
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
                   public function ranval($type,$limit)
{
   $add_time=rand(999,10000);

   $final_unique_id=$type.$add_time.date('s'); 
   return $final_unique_id;
}

public function user_freg($name,$institute_name,$mobile,$email,$address,$city,$state,$district,$pincode,$area,$aadhaar,$image2,$image3,$image4,$image5,$image6,$image7,$image8)
{
  $sql = "INSERT INTO pfranchise(name,institute_name,mobile,email,address,city,state,district,pincode,area,aadhaar,created_date,pancard,photo,qualification,outdoor_institute,class_room,local_noc,other) VALUES(:name,:institute_name,:mobile,:email,:address,:city,:state,:district,:pincode,:area,:aadhaar,:created_date,:image2,:image3,:image4,:image5,:image6,:image7,:image8)";
                $created_date=$this->get_date();   
              $stmt = $this->dbConnection->prepare($sql);         
         $stmt->bindParam(':name',$name, PDO::PARAM_STR);
         $stmt->bindParam(':institute_name',$institute_name, PDO::PARAM_STR);
              $stmt->bindParam(':created_date',$created_date, PDO::PARAM_STR);
                 $stmt->bindParam(':mobile',$mobile, PDO::PARAM_STR);
                 $stmt->bindParam(':aadhaar',$aadhaar, PDO::PARAM_STR);
                $stmt->bindParam(':email',$email, PDO::PARAM_STR);
                 $stmt->bindParam(':address',$address, PDO::PARAM_STR);
                 $stmt->bindParam(':city',$city, PDO::PARAM_STR);
                  $stmt->bindParam(':state',$state, PDO::PARAM_STR);
                  $stmt->bindParam(':district',$district, PDO::PARAM_STR);
                   $stmt->bindParam(':pincode',$pincode, PDO::PARAM_STR);
                  $stmt->bindParam(':area',$area, PDO::PARAM_STR);
                   $stmt->bindParam(':image2',$image2, PDO::PARAM_STR);
                    $stmt->bindParam(':image3',$image3, PDO::PARAM_STR);
                     $stmt->bindParam(':image4',$image4, PDO::PARAM_STR);
                      $stmt->bindParam(':image5',$image5, PDO::PARAM_STR);
                       $stmt->bindParam(':image6',$image6, PDO::PARAM_STR);
                        $stmt->bindParam(':image7',$image7, PDO::PARAM_STR);
                         $stmt->bindParam(':image8',$image8, PDO::PARAM_STR);
              $res=$stmt->execute(); 
               $lastid=$this->dbConnection->lastInsertId();
               return $lastid;

}


           public function user_reg($namef,$namel,$fname,$mname,$aadhar,$email,$mobile,$city,$state,$district,$taluka,$pincode,$course,$duration,$qualification,$institute,$new_profile_image,$other_image,$txnid,$reg_no,$dob,$session)
        {
            $sql = "INSERT INTO pregistrations(namef,namel,fname,mname,image,source,course,reg_date,reg_no,aadhar,email,mobile,city,state,district,taluka,pincode,duration,qualification,institute,txnid,dob,session) VALUES(:namef,:namel,:fname,:mname,:image,:source,:course,:reg_date,:reg_no,:aadhar,:email,:mobile,:city,:state,:district,:taluka,:pincode,:duration,:qualification,:institute,:txnid,:dob,:session)";
                $reg_date=$this->get_date();   
                $reg_no='';
              $stmt = $this->dbConnection->prepare($sql);         
         $stmt->bindParam(':namef',$namef, PDO::PARAM_STR);
         $stmt->bindParam(':namel',$namel, PDO::PARAM_STR);
          $stmt->bindParam(':dob',$dob, PDO::PARAM_STR);
           $stmt->bindParam(':fname',$fname, PDO::PARAM_STR);
            $stmt->bindParam(':mname',$mname, PDO::PARAM_STR);
             $stmt->bindParam(':image',$new_profile_image, PDO::PARAM_STR);
             $stmt->bindParam(':source',$other_image, PDO::PARAM_STR);
              $stmt->bindParam(':course',$course, PDO::PARAM_STR);
              $stmt->bindParam(':reg_date',$reg_date, PDO::PARAM_STR);
               $stmt->bindParam(':reg_no',$reg_no, PDO::PARAM_STR);
                 $stmt->bindParam(':aadhar',$aadhar, PDO::PARAM_STR);
                $stmt->bindParam(':email',$email, PDO::PARAM_STR);
                   $stmt->bindParam(':mobile',$mobile, PDO::PARAM_STR);
                 $stmt->bindParam(':city',$city, PDO::PARAM_STR);
                  $stmt->bindParam(':state',$state, PDO::PARAM_STR);
                  $stmt->bindParam(':district',$district, PDO::PARAM_STR);
                 $stmt->bindParam(':taluka',$taluka, PDO::PARAM_STR);
                   $stmt->bindParam(':pincode',$pincode, PDO::PARAM_STR);
                  $stmt->bindParam(':duration',$duration, PDO::PARAM_STR);
                   $stmt->bindParam(':qualification',$qualification, PDO::PARAM_STR);
                    $stmt->bindParam(':institute',$institute, PDO::PARAM_STR);
                    $stmt->bindParam(':txnid',$txnid, PDO::PARAM_STR);
					   $stmt->bindParam(':session',$session, PDO::PARAM_STR);
              $res=$stmt->execute(); 
               $lastid=$this->dbConnection->lastInsertId();
               return $lastid;
        }

             public function exam_reg($session,$institute_code,$exam_fee,$txnid,$reg_id)
        {
            $sql = "INSERT INTO pexam(session,institute_code,etxnid,reg_id,exam_fee,created) VALUES(:session,:institute_code,:txnid,:reg_id,:exam_fee,:created)";
                $reg_date=$this->get_date();   
              $stmt = $this->dbConnection->prepare($sql);         
         $stmt->bindParam(':session',$session, PDO::PARAM_STR);
         $stmt->bindParam(':institute_code',$institute_code, PDO::PARAM_STR);
           $stmt->bindParam(':txnid',$txnid, PDO::PARAM_STR);
            $stmt->bindParam(':reg_id',$reg_id, PDO::PARAM_STR);
             $stmt->bindParam(':exam_fee',$exam_fee, PDO::PARAM_STR);
             $stmt->bindParam(':created',$reg_date, PDO::PARAM_STR);
              $res=$stmt->execute(); 
               $lastid=$this->dbConnection->lastInsertId();
               return $lastid;
        }
           public function checkImage($image,$id,$type)
           {
            if($image!='')
            {
                if($type=='reg')
                {
                     return '<img src="uploads/'.$image.'" height="100"> <a href="remove.php?image='.$image.'&to=registrations.php&folder=uploads/&table=pregistrations&id='.$id.'&col=image&colid=reg_id" onClick=\'return confirm("Are you sure you want to remove this photo ?")\' ><div class="icon-bin" style="color:red;"></div></a>';
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
             $sql = "UPDATE pmore SET signature=:signature,watermark=:watermark,certified=:certified,stamp=:stamp,iso=:iso WHERE id=:id";
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

            public function insert_subject($subject)
           {
              $sql = "INSERT INTO dep(dep_title) VALUES(:subject_name)";
              $stmt = $this->dbConnection->prepare($sql);         
                   $stmt->bindParam(':subject_name',$subject, PDO::PARAM_STR);
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
           public function insert_reg($name,$fname,$mname,$dep_title,$new_image_name,$new_image_names,$reg_no) 
           {
             $sql = "INSERT INTO  registrations(name,fname,mname,dep,image,sign,reg_date,reg_no) VALUES(:name,:fname,:mname,:dep_title,:image,:sign,:reg_date,:reg_no)";
              $stmt = $this->dbConnection->prepare($sql);   
                $reg_date=$this->get_date();
                   $stmt->bindParam(':name',$name, PDO::PARAM_STR);
                   $stmt->bindParam(':fname',$fname, PDO::PARAM_STR);
                   $stmt->bindParam(':mname',$mname, PDO::PARAM_STR);
                   $stmt->bindParam(':dep_title',$dep_title, PDO::PARAM_INT);
                   $stmt->bindParam(':image',$new_image_name, PDO::PARAM_STR);
                   $stmt->bindParam(':sign',$new_image_names, PDO::PARAM_STR);
                   $stmt->bindParam(':reg_date',$reg_date, PDO::PARAM_STR);
                        $stmt->bindParam(':reg_no',$reg_no, PDO::PARAM_STR);
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
           public function update_reg($name,$lname,$fname,$mname,$reg_no,$aadhar,$new_image_name,$new_image_names,$email,$mobile,$city,$state,$district,$taluka,$pincode,$course,$duration,$qualification,$institute,$txnid,$status,$dob,$session,$id)  
           {
             $sql = "UPDATE pregistrations SET namef=:name,namel=:lname,fname=:fname,mname=:mname,reg_no=:reg_no,aadhar=:aadhar,image=:image,source=:source,email=:email,mobile=:mobile,city=:city,state=:state,district=:district,taluka=:taluka,pincode=:pincode,course=:course,duration=:duration,qualification=:qualification,institute=:institute,txnid=:txnid,status=:status,dob=:dob,session=:session WHERE reg_id=:id";
              $stmt = $this->dbConnection->prepare($sql);   
             
                  $stmt->bindParam(':name',$name, PDO::PARAM_STR);
         $stmt->bindParam(':lname',$lname, PDO::PARAM_STR);
           $stmt->bindParam(':fname',$fname, PDO::PARAM_STR);
            $stmt->bindParam(':mname',$mname, PDO::PARAM_STR);
             $stmt->bindParam(':reg_no',$reg_no, PDO::PARAM_STR);
               $stmt->bindParam(':aadhar',$aadhar, PDO::PARAM_STR);
             $stmt->bindParam(':image',$new_image_name, PDO::PARAM_STR);
             $stmt->bindParam(':source',$new_image_names, PDO::PARAM_STR);
              $stmt->bindParam(':course',$course, PDO::PARAM_STR);
                $stmt->bindParam(':email',$email, PDO::PARAM_STR);
                   $stmt->bindParam(':mobile',$mobile, PDO::PARAM_STR);
                 $stmt->bindParam(':city',$city, PDO::PARAM_STR);
                  $stmt->bindParam(':state',$state, PDO::PARAM_STR);
                  $stmt->bindParam(':district',$district, PDO::PARAM_STR);
                 $stmt->bindParam(':taluka',$taluka, PDO::PARAM_STR);
                   $stmt->bindParam(':pincode',$pincode, PDO::PARAM_STR);
                  $stmt->bindParam(':duration',$duration, PDO::PARAM_STR);
                   $stmt->bindParam(':qualification',$qualification, PDO::PARAM_STR);
                    $stmt->bindParam(':institute',$institute, PDO::PARAM_STR);
                    $stmt->bindParam(':txnid',$txnid, PDO::PARAM_STR);
                     $stmt->bindParam(':status',$status, PDO::PARAM_INT);
                     $stmt->bindParam(':dob',$dob, PDO::PARAM_STR);
					  $stmt->bindParam(':session',$session, PDO::PARAM_STR);
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

            public function insert_certificate($cno,$duration,$grade,$year,$reg_id)
           {
            $sql = "INSERT INTO certificates(cno,duration,grade,year,reg_id,cdate,token) VALUES(:cno,:duration,:grade,:year,:reg_id,:cdate,:token)";
              $stmt = $this->dbConnection->prepare($sql);   
              $cdate=$this->get_date();  
               $token=$this->randomKey(16); 
                    $stmt->bindParam(':cno',$cno, PDO::PARAM_STR);
                           $stmt->bindParam(':duration',$duration, PDO::PARAM_STR);
                            $stmt->bindParam(':grade',$grade, PDO::PARAM_STR);
                             $stmt->bindParam(':year',$year, PDO::PARAM_STR);
                                $stmt->bindParam(':reg_id',$reg_id, PDO::PARAM_INT);
                                $stmt->bindParam(':cdate',$cdate, PDO::PARAM_STR);
                                 $stmt->bindParam(':token',$token, PDO::PARAM_STR);
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
            public function update_certificate($session,$institute_code,$txnid,$status,$exam_fee,$id)
           {
            $sql = "UPDATE pexam SET session=:session,institute_code=:institute_code,etxnid=:etxnid,exam_status=:exam_status,exam_fee=:exam_fee WHERE eid=:id";
              $stmt = $this->dbConnection->prepare($sql);   
                    $stmt->bindParam(':session',$session, PDO::PARAM_STR);
                           $stmt->bindParam(':institute_code',$institute_code, PDO::PARAM_STR);
                            $stmt->bindParam(':etxnid',$txnid, PDO::PARAM_STR);
                             $stmt->bindParam(':exam_status',$status, PDO::PARAM_STR);
                             $stmt->bindParam(':exam_fee',$exam_fee, PDO::PARAM_STR);
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







}
?>