<?php require_once("../autoload.php");
if(!$getUser->admin_log_check(isset($_SESSION["user_post"]))){
       header("location:login.php");} include("header.php");?> 
       <style type="text/css">
          .faqBox {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    clear: both;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column; position:relative
}

.faqBox .detailBox {
    padding: 20px 20px 0px 20px;
    border-bottom: 1px solid #E4DCDC;
}

.faqBox .detailBox .innerDetails {
    display: none;
    padding-bottom: 10px;
}

.faqBox .detailBox .innerDetails p {
    margin-bottom: 10px;
}

.faqBox .detailBox.active {
    background-color: #F4F4F4;
}

.faqBox .detailBox.active h5 {
    color: #CE0E2D;
}
.faqBox .detailBox .innerDetails {
    display: none;
    padding-bottom: 10px;
}

.faqBox .detailBox .innerDetails p {
    margin-bottom: 10px;
}

.faqBox .detailBox.active {
    background-color: #F4F4F4;
}

.faqBox .detailBox.active h5 {
    color: #CE0E2D;
}

.faqBox h5 {
    color: #231F20;
    cursor: pointer;
    font-size: 1rem;
    padding-right: 35px;
    position: relative;
    padding-bottom:10px;
    margin-bottom:0;
}
.title_style
{
  font-size: 25px;
    font-weight: 800;
    letter-spacing: 5px;
    text-transform: uppercase;
}
.head_content
{
  padding: 50px;
}
.box2 {
    padding: 30px;
    background-color: #f2f2f2;
}
.wallet-text {
    text-align: left;
    font-weight: 600;
    font-family: Roboto;
    font-size: 20px;
    letter-spacing: .4px;
    color: #404040;
    opacity: 1;
}
.m-b-30 {
    margin-bottom: 30px;
}
.assist-line {
    position: relative;
    border-bottom: 2px dotted grey;
}
.benefits-heading {
    text-align: left;
    font-size: 14px;
    letter-spacing: .28px;
    color: #404040;
    opacity: 1;
    font-family: Roboto;
}
.oneassist-benefits-heading {
    font-weight: 500;
}
.m-b-15 {
    margin-bottom: 15px;
}
.plan-header .plan-title, .plan-price .price, .plan-list li, .plan-button{
  font-family: "Lato", sans-serif;
}

.price_style{
    margin: 15px auto;
  overflow: hidden;
    position: relative;
  text-align: center;
  border: 1px solid #eee;
  -webkit-transition: all .3s ease-in-out;
  -moz-transition: all .3s ease-in-out;
  -o-transition: all .3s ease-in-out;
  transition: all .3s ease-in-out;
  background-color: #5A738E !important;
}
.price_style .plan-header{
    padding: 30px 0 40px 0;
  position: relative;
}
.price_style .plan-header .plan-title{
  margin: -14px 0 4px 0;
  color: #f7f7f7;
  line-height: 40px;
    font-size: 20px;
  font-weight: 400;
}
.price_style .plan-price .price{
  margin: 0;
  font-size: 55px;
    font-weight: 900;
  line-height: 46px;
    color: #fff;
}
.price_style .plan-price .price span{
  padding: 0 5px;
  font-size: 16px;
    font-weight: 400;
    color: #fff;
}
.price_style .plan-list{
    padding: 15px 0;
    margin-bottom: 0;
  background-color: #fff;
    text-align: left;
  position: relative;
  z-index: 1;
}
.price_style .plan-list li{
    margin: 0 30px;
  position: relative;
    list-style-type: none;
    color: #888;
    line-height: 35px;
    font-size: 14px;
    font-weight: 400;
    letter-spacing: 0.02rem;
}
.price_style .plan-list li i{
    margin-right: 5px;
    position: relative;
    font-size: 13px;
    line-height: 42px;
}
.price_style .plan-bottom{
  padding: 10px 0 40px 0;
  position:relative;
  overflow:hidden;
  background: #fff;
}

.price_style .plan-header{
  background-color: #5A738E !important;
}

.price_style .plan-list li i{
  color: #4c3bb3;
}
.price_style:hover{
  border: 2px solid #b76cd2;
}
.tax_style
{
  font-size: 10px;
  color: #fff;
  top:2px;
}

        </style>
                <?php include("sidebar.php"); ?>
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row">
          <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
             <h3 class="plan-title">
             Users 
             </h3>
             <div class="plan-price">
              <p class="price">
              <?php echo $getCredit->count('pts_gtw_users');?>
              </p>
              <p class="tax_style">(Total Users )</p>
             </div>
                </div>
                <ul class="plan-list">
                  

                </ul>
                <div class="plan-bottom">
                  <a class="plan-button" href="users.php">View All </a>
                </div>
              </div>
                </div>
                 <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
             <h3 class="plan-title">
           Registrations
             </h3>
             <div class="plan-price">
              <p class="price">
              <?php echo $getCredit->count('pregistrations');?>
              </p>
              <p class="tax_style">(Total Registrations)</p>
             </div>
                </div>
                <ul class="plan-list">
                  

                </ul>
                <div class="plan-bottom">
                  <a class="plan-button" href="registrations.php">View All </a>
                </div>
              </div>
                </div>

                 <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
             <h3 class="plan-title">
           Exam Registration
             </h3>
             <div class="plan-price">
              <p class="price">
              <?php echo $getCredit->count('pexam');?>
              </p>
              <p class="tax_style">(Total exam registrations)</p>
             </div>
                </div>
                <ul class="plan-list">
                  

                </ul>
                <div class="plan-bottom">
                  <a class="plan-button" href="examreg.php">View All </a>
                </div>
              </div>
                </div>
            

        </div>
        <!-- /page content -->
        <?php include("footer.php") ?>

        