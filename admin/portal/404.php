<?php require_once("autoload.php"); $extra_head='';  include("functions.php");$image=$paypath.'assets/image'.$fav; $title='404 Page Not Found'; $desc="404"; $tags="404"; $weburl=$paypath.'404';
 $extra_head='  
<link href="'.$paypath.'assets/dist/bundle/app.styleBundle.css" rel="stylesheet">
<link href="'.$paypath.'assets/dist/style/jquery-ui.css" rel="stylesheet">
<link href="'.$paypath.'assets/dist/style/swiper.min.css" rel="stylesheet">
<link href="'.$paypath.'assets/dist/style/jquery.mCustomScrollbar.min.css" rel="stylesheet">
';

include("templates/head.php");
include("templates/header.php");
 ?>
        <section id="easyLoanSteps" class="graybg">
    <div class="container text-center">
        <div class="helpwrap">
            <div class="title wt6 pb-2">
                <h1>We are sorry </h1>
            </div>
        </div>

        <div id="applyloanform"></div>        
    </div>
</section>                                 

<section class="simplify_your_life">
    <div class="container">
404
<p>Unfortunately, the page you were looking for could not be found. It may be temporarily unavailable, moved or no longer exists</p>
<div class="text-center">
	<a href="<?php echo $paypath;?>" class="plan-button btn">Home </a> <a href="<?php echo $paypath;?>products" class="plan-button btn">Products (Services)</a>
	</div>
    </div>
</section>
 <?php include("templates/footer.php"); ?> 