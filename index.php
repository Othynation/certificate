<?php require_once("autoload.php"); include("admin/functions.php"); include("functions.php");
$extra_head=''; $image=$paypath.'assets/image/'.$logo; 
$footer='<script src="'.$paypath.'assets/js/functions.js"></script>'; 
include("templates/head.php");
include("templates/header.php");
 ?>   
<main>
    
<!-- =======================
Main Banner START -->
<section class="position-relative overflow-hidden pt-5 pt-lg-3">
    <div class="container">
        <!-- Title -->
        <div class="row align-items-center g-5">
            <!-- Left content START -->
            <div class="col-lg-5 col-xl-6 position-relative z-index-1 text-center text-lg-start mb-5 mb-sm-0">
                <!-- Title -->
                <h1 class="mb-0 display-6"><?php echo $getCredit->get_option_value("home_left_title");?> 
                        <!-- SVG END -->
                  
                </h1>
                
                <!-- Content -->

                <p class="my-4 lead"><?php echo $getCredit->get_option_value("description");?> </p>
             <?php 
                 if(isset($_POST['search_process']))
                 {
                    $keywords=trim($_POST['keywords']); 
                    $count=$getCredit->count_by_id("certificates","cno",$keywords);
                   if($count==0)
                   {
                   header("location:404");
                   }
                   else 
                   {
                    $_SESSION['cid']=$keywords;
                    header("location:certificate");
                   }
                 }
                ?> 

                <div class="d-sm-flex align-items-center justify-content-center justify-content-lg-start">
                    <!-- Button -->
                    <div class="nav my-4 my-xl-0 px-4 flex-nowrap align-items-center form-search">
                    <div class="nav-item w-100">
                        <?php 
                        if(isset($msg)) { echo $msg;}
                        ?>
                        <form class="position-relative" action="" method="POST">
                            <input class="form-control pe-8 bg-transparent p-3" type="search" placeholder="Trouver votre certificate.." name="keywords" value="" aria-label="Search" style="border-radius: 25px;" required>
                            <button class="p-3 position-absolute top-50 end-0 translate-middle-y border-0  btn btn-lg btn-primary" type="submit" name="search_process" style="border-radius: 25px;">
                                Rechercher  <i class="fas fa-search fs-6 "></i>
                            </button>
                        </form>
                    </div>
                </div>

                                     
                    <!-- Video button -->
                                    </div>
            </div>
            <!-- Left content END -->

            <!-- Right content START -->
            <div class="col-lg-7 col-xl-6 text-center position-relative">
                
                <!-- Icon logos START -->
                <div class="p-2 bg-white shadow rounded-3 position-absolute top-50 start-0 translate-middle-y mt-n7 d-none d-sm-block">
                    
                </div>
                <div class="p-2 bg-white shadow rounded-3 position-absolute top-0 end-0 me-5">
                    
                </div>
                <div    class="p-2 bg-white shadow rounded-3 position-absolute top-50 end-0 translate-middle-y mt-5 ms-5 d-none d-lg-block z-index-9">
                    
                </div>
                
                <!-- Image -->
                <div class="position-relative">
                    <img src="assets/images/<?php echo $iso;?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>




        </div>
    </div>
</section>
</main>

<?php include("templates/no-footer.php");?>