<!DOCTYPE html>
<html lang="en">
<?php
$user_id=$_SESSION['user_id'];
$rom=$getCredit->get_by_id('ts_gtw_users','id',$user_id); 
foreach($rom as $rm)
{
   $postm=$rm['post']; $usernamem=$rm['username'];
}
?>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Admin - Atlantique Formation</title>
    <link rel="icon" type="image/ico" href="https://certificate.atlantique.ma/assets/image/favicon.png" />

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/awesome/style.css" rel="stylesheet">
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/custom.min.css" rel="stylesheet">
       <link href="assets/css/custom.css" rel="stylesheet">

       <?php if(isset($extra_head)){
        echo $extra_head;
       }?>
        <link href="assets/css/custom.min.css" rel="stylesheet">
    <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/datatables.min.js"></script>
   <link rel="stylesheet" href="assets/css/datatables.min.css" />
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index" class="site_title"><img src="assets/images/logo.png" width="160"></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
           
            <!-- /menu profile quick info -->

            <br />

