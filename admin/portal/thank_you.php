<?php require_once("autoload.php");
include("includes/functions.php"); 
$title='Thank You'; $head='
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
.text-red
                    {
                        color: red;
                        font-size: 12px;
                    }
                    #payment
{
    display:none;
}
@page { size: auto;  margin: 0mm;}
@media print {
    a[href]:after {
        content: none !important;
    }
}
.hcol
{
    font-weight:600;
     font-size:22px;
}
.hcol2
{
     font-size:18px;
     text-transform: uppercase;
       
}
.hcol3
{
     font-size:18px;
     width   : 200px;
  height  : 50px;   
  position: relative;
  z-index : 1;

     
}

@media print {
        #printbtn {
        display: none !important;
    }

    #header {
       display: none !important;
    }
    #footer {
       display: none !important;
    }
    #link
    {
      display: none !important;
    }
    #title
    {
      display: none !important;
    }
     #bg
    {
      display: none !important;
    }
    .main-heading
    {
      font-size:30px !important;
    }
    

    .underline{
line-height: 27px !important;
 text-decoration-style: dotted !important;
}

}
.line2 {
    width: 97% !important;
    height: 1px !important;
    margin-left:150px !important;
    margin-bottom: 20px !important;
    background: rgb(204, 204, 204) !important;
}

    </style><script>

            setTimeout(function() {
    $(".alert-msg").fadeOut("fast");
     $(".alert-msg").text(""); 

}, 5000); 
          </script><script src="lib/js/examreg.js"></script>'; 

include("templates/head.php"); 
include("templates/header.php"); 
?>
<?php if(isset($_SESSION['success_fid'])){ ?>
<div class="container">
    <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
                <span class="close">&times;</span>
          </div>
        </div>
        <div class="body_div2"></div>
        <div class="event-heading">
            <center><h2><b>Thank You ! </b></h2></center>
        </div>
        <div class="container mt-3  main-div" style="border-radius:10px; margin-bottom: 132px; ">
            <div class="container mt-5">
                <style type="text/css">
                    .text-red
                    {
                        color: red;
                        font-size: 12px;
                    }
                </style>
                <div class="row form_area" >
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
    <div class="form-box">

  <p> <strong>Your registration has been successful.</p>
 </div>
   
        </div>
         <div class="col-sm-3">
        </div>
        </div>
                
    </div>
</div>

</div>

<?php } include("templates/footer.php");