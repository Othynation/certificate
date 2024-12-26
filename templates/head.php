<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title;?></title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content=""/>
<meta name="keywords" content="" />
<link rel="canonical" href="<?php echo $weburl;?>" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="" />
<meta name="twitter:image:src" content="<?php echo $image;?>" />
<meta name="twitter:title" content="<?php echo $title;?>" />
<meta property="og:url"           content="<?php echo $weburl;?>" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="<?php echo $title;?> " />
  <meta property="og:description"   content="" />
  <meta property="og:image"         content="<?php echo $image;?>" />
<?php $rows=$getCredit->get_by_id('general','id',1); 
     foreach($rows as $row){ $fav=$row['fav']; $paypath=$row['web_path']; }?>
<link rel="icon" type="image/ico" href="<?php echo $paypath.'assets/image/'.$fav;?>" />
<link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">
    <link rel="stylesheet" type="text/css" href="<?php echo $paypath;?>assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $paypath;?>assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $paypath;?>assets/vendor/tiny-slider/tiny-slider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $paypath;?>assets/vendor/glightbox/css/glightbox.css">
    <link id="style-switch" rel="stylesheet" type="text/css" href="<?php echo $paypath;?>assets/css/style.css">
     <link id="style-switch" rel="stylesheet" type="text/css" href="<?php echo $paypath;?>assets/css/custom.css">
    <?php echo $extra_head;?> <?php echo $getCredit->get_option_value('head_code');?>

</head>
<body>