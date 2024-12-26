<?php require_once("../autoload.php");
$name=$_POST['name']; 
if($name!='')
{
	$name=trim($_POST['name']);
	$institute_name=trim($_POST['institute_name']);
     $mobile=trim($_POST['mobile']);
   $email=trim($_POST['email']);
       $address=trim($_POST['address']);
      $city=trim($_POST['city']);
   $state=trim($_POST['state']);
   $district=trim($_POST['district']);
       $pincode=trim($_POST['pincode']);
         $area=trim($_POST['area']);
$loc='../admin/uploads/';
if(!empty($_FILES['image1']['tmp_name'])){
     $test = explode('.', $_FILES['image1']['name']); 
    $extension = end($test);    
    $image1 = 'aadhaar_'.rand() . '.' . $extension;
    $location = $loc.$image1;
} 
else 
{ 
     $image1=NULL;
}

//image2

if(!empty($_FILES['image2']['tmp_name'])){
     $test = explode('.', $_FILES['image2']['name']); 
    $extension = end($test);    
    $image2 = 'pancard_'.rand() . '.' . $extension;
    $location2 = $loc.$image2;
} 
else 
{ 
     $image2=NULL;
}

//image3

if(!empty($_FILES['image3']['tmp_name'])){
     $test = explode('.', $_FILES['image3']['name']); 
    $extension = end($test);    
    $image3 = 'owner_photo_'.rand() . '.' . $extension;
    $location3 = $loc.$image3;
} 
else 
{ 
     $image3=NULL;
}

//image4

if(!empty($_FILES['image4']['tmp_name'])){
     $test = explode('.', $_FILES['image4']['name']); 
    $extension = end($test);    
    $image4 = 'qualification_'.rand() . '.' . $extension;
    $location4 = $loc.$image4;
} 
else 
{ 
     $image4=NULL;
}

//image5

if(!empty($_FILES['image5']['tmp_name'])){
     $test = explode('.', $_FILES['image5']['name']); 
    $extension = end($test);    
    $image5 = 'outdoo_institute_photo_'.rand() . '.' . $extension;
    $location5 = $loc.$image5;
} 
else 
{ 
     $image5=NULL;
}

//image6

if(!empty($_FILES['image6']['tmp_name'])){
     $test = explode('.', $_FILES['image6']['name']); 
    $extension = end($test);    
    $image6 = 'indoor_class_room_'.rand() . '.' . $extension;
    $location6 = $loc.$image6;
} 
else 
{ 
     $image6=NULL;
}


//image7

if(!empty($_FILES['image7']['tmp_name'])){
     $test = explode('.', $_FILES['image7']['name']); 
    $extension = end($test);    
    $image7 = 'local_noc_'.rand() . '.' . $extension;
    $location7 = $loc.$image7;
} 
else 
{ 
     $image7=NULL;
}

//image8

if(!empty($_FILES['image8']['tmp_name'])){
     $test = explode('.', $_FILES['image8']['name']); 
    $extension = end($test);    
    $image8 = 'other_'.rand() . '.' . $extension;
    $location8 = $loc.$image8;
} 
else 
{ 
     $image8=NULL;
}



 $lastid=$getCer->user_freg($name,$institute_name,$mobile,$email,$address,$city,$state,$district,$pincode,$area,$image1,$image2,$image3,$image4,$image5,$image6,$image7,$image8); 
 if($lastid>0)
 {
 if(!empty($_FILES['image1']['tmp_name'])){
    move_uploaded_file($_FILES['image1']['tmp_name'], $location); 
} 
//image 2
 if(!empty($_FILES['image2']['tmp_name'])){
    move_uploaded_file($_FILES['image2']['tmp_name'], $location2); 
} 
//image 3
 if(!empty($_FILES['image3']['tmp_name'])){
    move_uploaded_file($_FILES['image3']['tmp_name'], $location3); 
} 

//image 4
 if(!empty($_FILES['image4']['tmp_name'])){
    move_uploaded_file($_FILES['image4']['tmp_name'], $location4); 
} 
//image 5
 if(!empty($_FILES['image5']['tmp_name'])){
    move_uploaded_file($_FILES['image5']['tmp_name'], $location5); 
} 

//image 6
 if(!empty($_FILES['image6']['tmp_name'])){
    move_uploaded_file($_FILES['image6']['tmp_name'], $location6); 
} 
//image 7
 if(!empty($_FILES['image7']['tmp_name'])){
    move_uploaded_file($_FILES['image7']['tmp_name'], $location7); 
} 

//image 8
 if(!empty($_FILES['image8']['tmp_name'])){
    move_uploaded_file($_FILES['image8']['tmp_name'], $location8); 
} 


$_SESSION['success_fid']=$lastid;
     $error=''; 
     $status='ok'; 
   $response = array(
        'error' =>  $error,
        'status' => $status
    );

 }
 else 
 {
 	 $error='Something went wrong . Please try again... '; 
     $status='failed'; 
   $response = array(
        'error' =>  $error,
        'status' => $status
    );

 }
 echo json_encode($response);

}
?>