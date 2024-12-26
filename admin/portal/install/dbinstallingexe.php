<!DOCTYPE html>
<html lang="en">
<head>
  <title>Install </title>
  <meta charset="utf-8">
  <meta name="description" content="">    
<meta name="keywords" content="">

   <link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet" />
 <link href="../admin/assets/css/custom.min.css" rel="stylesheet" />
 <style type="text/css">
  body {
  background: #f1f1f1;
    font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif,  Open Sans;
    
}
.login-box{
   
    margin-top: 4%;
    border: 1px solid #ccd0d4;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    background: white;
    padding: 20px;
}
</style>

</head>


<body>

 

  <div class="container">

<center><div id="loader"></div></center>
<div class="col-sm-3"></div>
 <div class="col-sm-6 login-box" >

<?php  
require_once "../includes/conscrmg.php";  // this is connect.php file 
try {
  $dc = new PDO("mysql:host=".$DBHOST.";dbname=".$DBNAME, $DBUSER, $DBPASS);
  $dc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Your page is connected with database successfully..";
  //execute db 
  $sql="CREATE TABLE `ts_gtw_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `username` varchar(300) NOT NULL UNIQUE,
  `email` varchar(300) NOT NULL UNIQUE,
  `password` varchar(300) NOT NULL,
  `date` datetime DEFAULT NULL
);
  CREATE TABLE `certificates` (
  `cid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `cno` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `grade` varchar(40) DEFAULT NULL,
  `year` varchar(40) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `reg_id` int(11) NOT NULL,
  `token` varchar(50) DEFAULT NULL
);
  CREATE TABLE `dep` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `dep_title` varchar(255) DEFAULT NULL
);
  CREATE TABLE `custom_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(355) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
);
  CREATE TABLE `general` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `web_title` varchar(255) DEFAULT NULL,
  `web_path` varchar(255) DEFAULT NULL,
  `web_url` varchar(355) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `fav` varchar(100) DEFAULT NULL,
  `web_desc` text DEFAULT NULL,
  `web_tags` text DEFAULT NULL,
  `contact_email` varchar(355) DEFAULT NULL,
  `from_email` varchar(50) DEFAULT NULL,
  `currency` varchar(40) DEFAULT NULL,
  `reg` varchar(355) NOT NULL,
  `color` varchar(255) NOT NULL
);
  CREATE TABLE `more` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `signature` varchar(50) DEFAULT NULL,
  `watermark` varchar(50) DEFAULT NULL,
  `stamp` varchar(100) DEFAULT NULL,
  `certified` varchar(50) DEFAULT NULL,
  `iso` varchar(50) DEFAULT NULL
);
  CREATE TABLE `registrations` (
  `reg_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `sign` varchar(50) DEFAULT NULL,
  `dep` int(11) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `reg_no` varchar(255) DEFAULT NULL
);
  CREATE TABLE `options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `option_name` varchar(355) DEFAULT NULL,
  `option_value` longtext DEFAULT NULL,
  `option_note` varchar(355) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
);
INSERT INTO `general` (`id`, `web_title`, `web_path`, `web_url`, `logo`, `fav`, `web_desc`, `web_tags`, `contact_email`, `from_email`, `currency`, `reg`, `color`) VALUES
(1, 'TECHNO SMARTER HELP COMMUNITY COACHING ORG | INSTITUTE', 'http://localhost:8081/certificate/', 'http://localhost:8081/certificate/', 'logo.png', 'insta.png', 'Hed.Office: Shubhash Nagar , Delhi Prasad Road, New Delhi - 110001 Register office: Shubash Nagar Building no 9, New Delhi  Techno Smarter Soft 10001', '4500', 'Email:- technosmarterinfo@gmail.com, Website:- www.technosmarter.com', 'noreply@yoursite.com', 'TSCERT', 'Ministry of Corporate Affairs (Govt. of India ) Govt. CIN. No. U90745UK2022NPL2788001 TAN. PRSG 89910T', '#1D6589');
INSERT INTO `more` (`id`, `signature`, `watermark`, `stamp`, `certified`, `iso`) VALUES
(1, 'sign1254856798.png', 'watermark_106032784.jpg', 'stamp_1496427900.png', 'certified_2142934284.png', 'iso_1174489802.png');

INSERT INTO `options` (`option_id`, `option_name`, `option_value`, `option_note`, `type`) VALUES
(36, 'grades', 'A,A<sup>+</sup>,A<sup>-</sup>,B,B<sup>+</sup>,B<sup>-</sup>,D,D<sup>+</sup>,D<sup>-</sup>,E,E<sup>+</sup>,E<sup>-</sup>', 'Grades separated by commas | Grade', 'certificate'),
(37, 'certificate_no_text', 'Certificate No.', 'Certificate No Text | 1', 'certificate_text'),
(38, 'certificate_main_text', '<h1 class=\"heading-two\">Certificate</h1> <p class=\"sub-heading-two\">OF COURSE COMPLETION</p>', 'Certificate\r\nOF COURSE COMPLETION', 'certificate_text'),
(39, 'certificate_text_3', 'This is certified that Mr/Mrs', 'This is certified that Mr/Mrs', 'certificate_text'),
(40, 'father_name_text', 'Father Name', 'Father Name Text', 'certificate_text'),
(41, 'mother_name_text', 'Mother Name ', 'Mother Name Text', 'certificate_text'),
(42, 'certificate_text_6', 'has successfully completed the course', 'has successfully completed the course', 'certificate_text'),
(43, 'certificate_text_7', 'from our institute . Duration of course is', 'from our institute . Duration of course is | Text 7', 'certificate_text'),
(44, 'certificate_text_8', 'grade is', 'grade is | Text 8', 'certificate_text'),
(45, 'certificate_text_9', 'certificate issued year ', 'certificate issued year  | Text 9 ', 'certificate_text'),
(46, 'certificate_text_10 ', 'We are issuing a training certificate by our institute .', 'We are issuing a training certificate by our institutee | Text 10', 'certificate_text'),
(47, 'certificate_text_11', 'I wish you all the success.Happiness and bright future ..', 'I wish you all the success.Happiness and bright future .. | Text 11', 'certificate_text'),
(48, 'autority_sign_text', 'Authority Sign', 'Authority Sign', 'certificate_text');
";  
require_once("../autoload.php");
ini_set('display_errors', 0);
if($getCredit->tableExists('ts_gtw_users'))
{
header("location:usercreateexevone.php"); 
}
else 
{
 $db->exec($sql);
 header("refresh:5;  url=usercreateexevone.php"); 
  echo "Please wait..Creating database..";
}
  // execute db end
} catch(PDOException $e) {
  //echo "Issue -> Connection failed: " . $e->getMessage();
  header("location:../install"); 
}

?>

<div class="col-sm-3"></div>
</div> 
</body>
</html>