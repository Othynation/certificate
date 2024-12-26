<footer class="pt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3">
                <!-- logo -->
                <a class="me-0" href="<?php echo $paypath;?>">
                    <img class="light-mode-item h-40px" src="<?php echo $paypath.'assets/image/'.$logo;?>" alt="logo">
                    <img class="dark-mode-item h-40px" src="<?php echo $paypath.'assets/image/'.$logo;?>" alt="logo">
                </a>
                <p class="my-3"><?php echo $getCredit->get_option_value('footer_about'); ?></p>
                <!-- Social media icon -->
                <ul class="list-inline mb-0 mt-3">
                    <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-facebook" href="<?php echo $getCredit->get_option_value('fb'); ?>"><i class="fab fa-fw fa-facebook-f"></i></a> </li>
                    <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-instagram" href="<?php echo $getCredit->get_option_value('instagram'); ?>"><i class="fab fa-fw fa-instagram"></i></a> </li>
                    <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-twitter" href="<?php echo $getCredit->get_option_value('twitter'); ?>"><i class="fab fa-fw fa-twitter"></i></a> </li>
                    <li class="list-inline-item"> <a class="btn btn-white btn-sm shadow px-2 text-linkedin" href="<?php echo $getCredit->get_option_value('linkedin'); ?>"><i class="fab fa-fw fa-linkedin-in"></i></a> </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <!-- Link block -->
                    <div class="col-6 col-md-4">
                        <h5 class="mb-2 mb-md-4"><?php echo $getCredit->get_option_value('footer_col2_title'); ?></h5>
                        <ul class="nav flex-column">
                             <?php $rows=$getCredit->get_by_string('menus','type','footer_menu_1'); 
                               foreach($rows as $row)
                               {
                                echo ' <li class="nav-item"><a class="nav-link" href="'.$row['link'].'">'.$row['title'].'</a></li>';
                               }
                            ?> 
                        </ul>
                    </div>
                                    
                    <!-- Link block -->
                    <div class="col-6 col-md-4">
                        <h5 class="mb-2 mb-md-4"><?php echo $getCredit->get_option_value('footer_col3_title'); ?></h5>
                        <ul class="nav flex-column">
                             <?php $rows=$getCredit->get_by_string('menus','type','footer_menu_2'); 
                               foreach($rows as $row)
                               {
                                echo ' <li class="nav-item"><a class="nav-link" href="'.$row['link'].'">'.$row['title'].'</a></li>';
                               }
                            ?> 
                        </ul>
                    </div>

                    <!-- Link block -->
                    <div class="col-6 col-md-4">
                        <h5 class="mb-2 mb-md-4"><?php echo $getCredit->get_option_value('footer_col4_title'); ?></h5>
                        <ul class="nav flex-column">
                          <?php $rows=$getCredit->get_by_string('menus','type','footer_menu_3'); 
                               foreach($rows as $row)
                               {
                                echo ' <li class="nav-item"><a class="nav-link" href="'.$row['link'].'">'.$row['title'].'</a></li>';
                               }
                            ?> 
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <h5 class="mb-2 mb-md-4"><?php echo $getCredit->get_option_value('footer_col5_title'); ?></h5>
                <!-- Time -->
                <p class="mb-2">
                    <?php $footer_mobile=$getCredit->get_option_value('footer_mobile'); 
                       if($footer_mobile!='')
                       {
                      echo 'Contact No :<span class="h6 fw-light ms-2"><a href="tel:'.$footer_mobile.'">'.$footer_mobile.'</a></span>
                      <span class="d-block small">'.$getCredit->get_option_value('call_timing').'</span>';
                       }
                    ?>  
                </p>
                <p class="mb-0">
                  <?php $footer_email=$getCredit->get_option_value('footer_email'); 
                       if($footer_email!=''){
                        echo ' Email:<span class="h6 fw-light ms-2"><a href="mailto:'.$footer_email.'">'.$footer_email.'</span></a>'; 
                       } 
                       ?>
                       </p>

               

            </div> 
        </div>
        <hr class="mt-4 mb-0">
        <div class="py-3">
            <div class="container px-0">
                <div class="d-lg-flex justify-content-between align-items-center py-3 text-center text-md-left">
                    <!-- copyright text -->
                    <div class="text-primary-hover"><?php echo $getCredit->get_option_value('left_copyright');?></div>
                    <!-- copyright links-->
                    <div class="justify-content-center mt-3 mt-lg-0">
                          <div class="text-primary-hover">Developed by <a target="_blank" class="text-body" href="https://zachsolution.com/">ZACH SOLUTION</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>
<script src="<?php echo $paypath;?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $paypath;?>assets/vendor/tiny-slider/tiny-slider.js"></script>
<script src="<?php echo $paypath;?>assets/vendor/glightbox/js/glightbox.js"></script>
<script src="<?php echo $paypath;?>assets/vendor/purecounterjs/dist/purecounter_vanilla.js"></script>


<?php if(isset($footer))
{
echo $footer;
} ?>
</body>
</html>
