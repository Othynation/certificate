<?php require_once("autoload.php");
include("includes/functions.php"); 
$title='Home'; $head='
<style type="text/css">
.form-box
    {
      -webkit-box-shadow: -1px 1px 5px 1px rgba(91,88,102,1);
-moz-box-shadow: -1px 1px 5px 1px rgba(91,88,102,1);
box-shadow: -1px 1px 5px 1px rgba(91,88,102,1);
padding: 40px ;
padding-bottom: 20px ;
    }
    .form_area
    {
        padding-bottom: 60px ;
    }
.success
{
    font-size:20px ;
} 
.btn-grad {
    text-align: center;
    text-transform: uppercase;
    transition: 0.5s; 
    background-size: 200% auto;
    color: white;
    box-shadow: 0 0 20px #eee;
    border-radius: 10px;
    width:100%;
  

}
.btn-grad {
    background: #166a72;
}
.mt-4, .my-4 {
    margin-top: 1.5rem !important;
}
body {
    background: linear-gradient(180deg, rgba(233, 233, 240, 1) 48%, rgba(227, 241, 241, 1) 100%);
}


    </style>'; 
include("templates/head.php"); 
include("templates/header.php"); 
?>
    <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
                <span class="close">&times;</span>
          </div>
        </div>
        <div class="body_div2"></div>
        <div class="event-heading">
            <center><h2><b><br></b></h2></center>
        </div>
        <div class="container mt-3  main-div" style="border-radius:10px;">
            <div class="container mt-5">
                <div class="row form_area" >
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
    <div class="form-box" style="background: #fff;">
    <center>
        <a href="registration.php"><button class="btn mt-4 btn-grad" style="padding: 20px;">Registration(Admission)</button></a> <br> <br> 
         <a href="exam-registration.php"><button class="btn mt-4 btn-grad" style="padding: 20px;">Exam Registration</button></a> <br> <br> 
          <a href="hall-ticket.php"><button class="btn mt-4 btn-grad" style="padding: 20px;">Hall Ticket</button></a>
           <a href="franchise.php"><button class="btn mt-4 btn-grad" style="padding: 20px;">Franchise</button></a>
                      <a href="institutes.php"><button class="btn mt-4 btn-grad" style="padding: 20px;">Find Institutes</button></a>
    </center>
</div>
   
        </div>
         <div class="col-sm-2">
        </div>
        </div>
                
    </div>
</div>



<?php include("templates/footer.php");