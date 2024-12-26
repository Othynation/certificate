<?php
require_once("../autoload.php");
require_once("valtxnid.php");

$name = $_POST['name']; 
if ($name != '') {
    $reg_no = '';
    $namef = trim($_POST['name']);
    $namel = trim($_POST['lname']);
      $dob = trim($_POST['dob']);
	  $session=trim($_POST['session']);
    $fname = trim($_POST['fname']);
    $mname = trim($_POST['mname']);
    $aadhar = trim($_POST['aadhar']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $district = trim($_POST['district']);
    $taluka = trim($_POST['taluka']);
    $pincode = trim($_POST['pincode']);
    $course = trim($_POST['course']);
    $duration = trim($_POST['duration']);
    $qualification = trim($_POST['qualification']);
    $institute = trim($_POST['institute']);

    $txnid = trim($_POST['txnid']);

    // Check if the txnid already exists
    if (checkExistingTxnid($txnid)) {
        $error = 'Transaction ID already exists.';
        $status = 'failed';
        
    } else {
        // Your existing code to insert data into the database goes here
        $loc = '../admin/uploads/';
        if (!empty($_FILES['profile_img']['tmp_name'])) {
            $test = explode('.', $_FILES['profile_img']['name']); 
            $extension = end($test);    
            $image = 'photo_'.rand() . '.' . $extension;
            $location = $loc.$image;
        } else { 
            $image = NULL;
        }

        if (!empty($_FILES['press_id']['tmp_name'])) {
            $test = explode('.', $_FILES['press_id']['name']); 
            $extensiono = end($test);    
            $osource = 'source_'.rand() . '.' . $extensiono;
            $locationo = $loc.$osource;
        } else { 
            $osource = NULL;
        }
 if($extension!= "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "PNG" && $extension != "JPG" && $extension != "JPEG") {
      $error = 'Upload only JPG , PNG or JPEG format for photo.';
        $status = 'failed';
 }
 else if($extensiono!= "jpg" && $extensiono != "png" && $extensiono != "jpeg" && $extensiono != "PNG" && $extensiono != "JPG" && $extensiono != "JPEG" && $extensiono != "pdf" && $extensiono != "PDF")
 {
  $error = 'Document formats: PNG , JPG , JPEG AND PDF allowed only.';
        $status = 'failed';    
 }
 else 
 {

        $new_profile_image = $image;
        $other_image = $osource;
        $lastid = $getCer->user_reg($namef, $namel, $fname, $mname, $aadhar, $email, $mobile, $city, $state, $district, $taluka, $pincode, $course, $duration, $qualification, $institute, $new_profile_image, $other_image, $txnid, $reg_no,$dob,$session);

        if ($lastid > 0) {
            if (!empty($_FILES['profile_img']['tmp_name'])) {
                move_uploaded_file($_FILES['profile_img']['tmp_name'], $location); 
            } 

            if (!empty($_FILES['press_id']['tmp_name'])) {
                move_uploaded_file($_FILES['press_id']['tmp_name'], $locationo); 
            }

            $_SESSION['success_id'] = $lastid;
            $error = ''; 
            $status = 'ok';
        } else {
            $error = 'Something went wrong. Please try again...'; 
            $status = 'failed';
        }
 }

    }

    $response = array(
        'error' =>  $error,
        'status' => $status
    );
    
    echo json_encode($response);
}
?>
