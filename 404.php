<?php require_once("autoload.php"); include("admin/functions.php"); include("functions.php");
$extra_head=''; $image=$paypath.'assets/image/'.$logo; 
$footer='<script src="'.$paypath.'assets/js/functions.js"></script>'; 
include("templates/head.php");
include("templates/header.php");
 ?>   
<main>
    
<!-- =======================
Main Banner START -->
<section class="position-relative overflow-hidden pt-10 pt-lg-0" style="margin-top:-40px;">
    <div class="container">
        <!-- Title -->
        <div class="row align-items-center">
            <div class="col-sm-2"></div>
             <div class="col-sm-8" style="text-align:center;" ><div class="col-sm-12"><img  src="assets/images/<?php echo $signature; ?>" class="certif-not-found"></div>
  <div class="col-sm-12"><p class="p-not-found">Merci de vérifier que vous avez saisi le code d'attestation correctement.</p></div>
                    <!-- Button -->
                    
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


                  <div class="row">
                    <div class="col-sm-2"> </div>
                      <div class="col-sm-8">  <center><form class="position-relative" action="" method="POST">
                            <input class="form-control pe-9 bg-transparent p-3" type="search" placeholder="Entrez votre code d'attestation.." name="keywords" value="" aria-label="Search" style="" required>
                            <button class="p-3 position-absolute top-50 end-0 translate-middle-y border-0  btn btn-lg btn-primary" type="submit" name="search_process" style="">
                                Chercher  <i class="fas fa-search fs-6 "></i>
                            </button>
                        </form> </center> </div>
                        <div class="col-sm-2"> </div>
                  </div>
                        <?php 
                        if(isset($msg)) { echo $msg;}
                        ?>
                      
                    
               

                  

             </div>
              <div class="col-sm-2"></div>
             
        </div>
    </div>
</section>
<style>
    .certif-not-found{
        height: 500px;width: auto;
    }
    .p-not-found{
        font-size: 14px; font-weight: 100;margin-top: 0px; font-family: arial;text-align: center; color: #0F70EB;
    }
    @media only screen and (max-width: 500px) {
      .certif-not-found{
            height: 400px;
        }
    }
</style>



        </div>
    </div>
</section>
</main>

<?php include("templates/no-footer.php");?>