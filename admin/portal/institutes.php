<?php require_once("autoload.php");
include("includes/functions.php"); 
$title='Institutes'; $head='
<style type="text/css">
.form-box
    {
      -webkit-box-shadow: -1px 1px 5px 1px rgba(91,88,102,1);
-moz-box-shadow: -1px 1px 5px 1px rgba(91,88,102,1);
box-shadow: -1px 1px 5px 1px rgba(91,88,102,1);
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

.hcol 
{
    font-weight:700;
}
table {
  border-collapse: collapse !important;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}
table, th, td {
  border: 1px solid #EAEAEA !important;
}
.plate
{
      background: #3929f3 !important;
    color: #fff !important;
  }
                    .text-red
                    {
                        color: red;
                        font-size: 12px;
                    }


    </style><script>

            setTimeout(function() {
    $(".alert-msg").fadeOut("fast");
     $(".alert-msg").text(""); 

}, 5000); 
          </script><script src="lib/js/ishow.js"></script>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
          '; 

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
        <title><?php echo $title;?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
<script src="lib/js/jquery.min.js"></script>
<script src="lib/js/popper.min.js"></script>
<script src="lib/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Acme&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="lib/css/font-awesome.min.css">
<link rel="stylesheet" href="css-loader-master/dist/css-loader4fae.css?v=1672394882">
<link href="https://fonts.googleapis.com/css2?family=Bree+Serif&amp;display=swap" rel="stylesheet">


<link rel="stylesheet" href="lib/css/css-loader.css">
<!-- Layout styles -->
<link rel="stylesheet" href="lib/css/style3.css">
    <link rel="stylesheet" href="lib/css/style2.css">
        <link rel="stylesheet" href="lib/css/style.css">
        <link rel="stylesheet" href="lib/css/style4.css">
        <script src="../../ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="lib/js/cities.js"></script>
        <?php echo $head;?> 
    </head>

<?php
include("templates/header.php"); 
?>
<div class="container">
    <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
                <span class="close">&times;</span>
          </div>
        </div>
        <div class="body_div2"></div>
        <div class="event-heading">
         <br>
        </div>
     
            <div class="container">


                <div class="row" >
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <div class="card">
  <div class="card-header">
   Institutes
  </div>
  <div class="card-body">
   <form  id="user_form"  method="post">
   <div class="row">
    <div class="col-sm-4">
 <div class="form-group mb-2">
<select name="sid"  id="sid" class="form-control" required>
 <option value="">Select State</option> 
 <?php 
 $rows=$getCredit->fetch_all('pstate','sname','ASC');
 foreach($rows as $row)
 {
echo '<option value="'.$row['sid'].'">'.$row['sname'].'</option>';
 }
 ?>

</select>
</div>
</div>
     <div class="col-sm-4">
        <div class="form-group mb-2">
        <select name="did" id="did" class="form-control" required>
 <option value="">Select District</option> 
 
</select>

</div>
      </div>
      <div class="col-sm-4"> 
        <div class="form-group mb-2">
<select name="tid" id="tid" class="form-control" required>
 <option value="">Select Taluka</option> 

</select>
</div>

      </div>
   </div>

   <br>
   <div class="form-group">
<center><button type="submit" id="submit" class="btn btn-primary sub-btn pl-4 pr-4 pt-2 pb-2 mb-2" name="button">Show</button></center>
</div>
 </form>

  </div>
</div>
<br>
<div class="row" id="display">
   
</div>

   
        </div>
         <div class="col-sm-1">
        </div>
        </div>


                
    </div>


</div>

<script type="text/javascript">
    $(document).on('submit','#user_form',function(e){
      e.preventDefault();
      var sid = $("#sid").val().trim(); 
         var did = $("#did").val().trim(); 
                var tid = $("#tid").val().trim();
                if(sid>0 && did>0 && tid>0)
                {

                     $.ajax({
      url:"app/insshowv6765554645.php",
      type:"post",
      data:new FormData(this),
      processData: false,
      contentType: false,
      success:function(data){
$('#display').html(data);


                  
      }
    })

                }
  });
                  $(document).on('change', '#sid', function(){
  var sid = $('#sid').val();
  var type ='1'; 
  if(sid!='')
  {
    $.ajax({
      url:"app/changetype2.php",
      type:"post",
       data: { sid:sid, type:type },
        type: "POST",
      success:function(data){
         $("#did").html(data);
      }
    })

  }
 });

                   $(document).on('change', '#did', function(){
  var sid = $('#did').val();
  var type ='2'; 
  if(sid!='')
  {
    $.ajax({
      url:"app/changetype2.php",
      type:"post",
       data: { sid:sid, type:type },
        type: "POST",
      success:function(data){
         $("#tid").html(data);
      }
    })

  }
 });

                </script>

<?php include("templates/footer.php");