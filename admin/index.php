<?php require_once("../autoload.php");
if(!$getUser->admin_log_check()) {header('location:login'); exit();}else {$user_id=$_SESSION['user_id'];if(!$getUser->final_check($user_id)) {header('location:login'); exit();}} $back_hide=1;

       include("header.php");?> 
     <script src="assets/js/chart.js"></script>
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
  border-radius: 15px;
  -webkit-transition: all .3s ease-in-out;
  -moz-transition: all .3s ease-in-out;
  -o-transition: all .3s ease-in-out;
  transition: all .3s ease-in-out;
  background-color: #0065c3 !important;
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
  padding: 15px 0 40px 0;
  position:relative;
  overflow:hidden;
}
a.plan-button{
    border: 1px solid #ffffff36;
    border-radius: 20px;
}

.price_style .plan-list li i{
  color: #4c3bb3;
}
.price_style:hover{
  border: 1px solid #0065c3;
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
          <?php if($postm=='admin') {?> 
            <script type="text/javascript">
$(document).ready(function() {
  $('#filter-form').submit(function(e) {
    e.preventDefault(); // Prevent default form submission
    var formData = $(this).serialize(); // Serialize form data
    $.ajax({
      type: 'POST',
      url: 'action?detect=fetch_record', // Replace with your PHP file URL
      data: formData,
      dataType: 'json', // Specify JSON data type
      success: function(response) {
        var certificates = response.certificates;
        var registrations = response.registrations;
        var inscription = response.inscription;

        // Update your HTML with the received data
        $('#certificates-count').text(certificates);
        $('#registrations-count').text(registrations);
        $('#inscription-count').text(inscription);
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText); // Handle error
      }
    });
  });
});
</script>


  <div class="row">
                    
                    <div class="col-md-9">
                  <form action="" method="POST" id="filter-form">
  <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
        <label for="exampleInputEmail1">From</label>
        <input type="date" name="from" id="from" class="form-control" required>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="exampleInputEmail1">To</label>
        <input type="date" name="to" id="to" class="form-control" required>
      </div>
    </div>
    <div class="col-sm-4">
      <br>
      <center>
        <button type="submit" name="getrecord" id="getrecord" class="btn btn-success"><i class="fa fa-filter"></i> Filter Record</button>
      </center>
    </div>
  </div>
</form>

         </div>
                </div>

          <div class="row">
          <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price" id="certificates-count">
              <?php echo $getCredit->count('certificates');?>
              </p>
              <br>
               <h3 class="plan-title">
            Certificates
             </h3>
             
             </div>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="certificates">View All </a>
                </div>
              </div>
                </div>
                 <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
             
             <div class="plan-price">
              <p class="price"  id="registrations-count">
              <?php echo $getCredit->count('registrations');?>
              </p>
             
             </div>
             <br> 
             <h3 class="plan-title">
           Registrations
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="registrations">View All </a>
                </div>
              </div>
                </div>
                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price"  id="inscription-count">
              <?php echo $getCredit->count('inscription');?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
       Inscription
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="inscriptions">View All </a>
                </div>
              </div>
                </div>
                

                 <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php echo $getCredit->count('formation');?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
          Formations
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="formations">View All </a>
                </div>
              </div>
                </div>
                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php echo $getCredit->count('centres');?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
         Centres
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="centres">View All </a>
                </div>
              </div>
                </div>
                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php echo $getCredit->count_by_string('ts_gtw_users','post','prof');?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
         Prof
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="prof">View All </a>
                </div>
              </div>
                </div>
                

                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php echo $getCredit->count('groups');?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
        Group
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="group">View All </a>
                </div>
              </div>
                </div>

                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php echo $getCredit->count('classroom');?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
        Classroom
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="classroom">View All </a>
                </div>
              </div>
                </div>


        </div>
        <div class="row">
            <div class="col-sm-2"> </div>
     <div class="col-sm-8">
<?php
 $year=date('Y');
 $data = $getCredit->count_registrations_by_month($year);
?>

         
         <canvas id="registrationChart"></canvas>

       <script type="text/javascript">
    const data = <?php echo $data; ?>;
    const ctx = document.getElementById('registrationChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(data),
            datasets: [{
                label: 'Registrations',
                data: Object.values(data),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

     </div>
     <div class="col-sm-2"> </div>
 </div>

<?php 
// SQL query to fetch the top 5 formations with the most registrations
$sql1 = "SELECT formation.formation_name, COUNT(registrations.reg_id) AS registration_count 
         FROM formation 
         LEFT JOIN registrations ON formation.fid = registrations.fid 
         GROUP BY formation.fid 
         ORDER BY registration_count DESC 
         LIMIT 10";
// SQL query to fetch the top 5 centres with the most registrations
$sql2 = "SELECT centres.centre_name, COUNT(registrations.reg_id) AS registration_count 
         FROM centres 
         LEFT JOIN registrations ON centres.cent_id = registrations.cent_id 
         GROUP BY centres.cent_id, centres.centre_name 
         ORDER BY registration_count DESC 
         LIMIT 10";
$result1=$getCredit->get_by_query($sql1);
$result2=$getCredit->get_by_query($sql2);
$row2=$getCredit->get_by_id('ts_gtw_users','id',$user_id);
foreach($row2 as $rs)
{
    $post=$rs['post'];
}
if ($post=='admin') {
    // Display the results in tables
    echo '<div class="row stats">';
    echo '<div class="col-md-5 col-md-offset-2">';
    echo '<h2>Registrations Par Formation</h2>';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th>Formation </th>';
    echo '<th>Nombre de Registrations</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $count = 1;
    foreach ($result1 as $row) {
        echo '<tr>';
        echo '<td>' . $count . '</td>';
        echo '<td>' . $row['formation_name'] . '</td>';
        echo '<td style="text-align: center;">' . $row['registration_count'] . '</td>';
        echo '</tr>';
        $count++;
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';

    echo '<div class="col-md-5">';
    echo '<h2>Registrations Par Centre</h2>';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th>Centre</th>';
    echo '<th>Nombre de Registrations</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    $count = 1;
    foreach ($result2 as $row) {
        echo '<tr>';
        echo '<td>' . $count . '</td>';
        echo '<td>' . $row['centre_name'] . '</td>';
        echo '<td style="text-align: center;">' . $row['registration_count'] . '</td>';
        echo '</tr>';
        $count++;
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
} else {
    echo '<p>No data available.</p>';
}
?>
    <?php }  else if($postm=="user"){?> 

        <div class="row">
          <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php 
              $sql="SELECT count(*) as total
FROM certificates 
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id
LEFT JOIN formation ON certificates.fid=formation.fid
LEFT JOIN groups ON formation.fid=groups.fid
INNER JOIN centres ON registrations.cent_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id';
";
echo $count=$getCredit->count_by_query2($sql);

//echo $getCredit->count_by_id('certificates','uid',$user_id);

               ?>
              </p>
              <br>
               <h3 class="plan-title">
            Certificates
             </h3>
             
             </div>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="certificatesm">View All </a>
                </div>
              </div>
                </div>
                 <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
             
             <div class="plan-price">
              <p class="price">
          <?php

$sql="SELECT count(*) as total
FROM registrations 
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id';
";
   echo  $count=$getCredit->count_by_query2($sql);


          // echo $getCredit->count_by_id('registrations','uid',$user_id);?>
              </p>
             
             </div>
             <br> 
             <h3 class="plan-title">
           Registrations
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="registrationsm">View All </a>
                </div>
              </div>
                </div>
                 <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php
               $post='prof';
              $sql="SELECT count(*) as total
FROM ts_gtw_users
LEFT JOIN centres ON ts_gtw_users.cnt_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id' AND  ts_gtw_users.post='$post'
";
   echo  $count=$getCredit->count_by_query2($sql);


              //echo $getCredit->count_by_string_two_col('ts_gtw_users','post','prof','uid',$user_id);?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
         Prof
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="prof">View All </a>
                </div>
              </div>
                </div>
                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php 
              $post='prof';
              $sql="SELECT count(*) as total
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON inscription.uid=ts_gtw_users.id
LEFT JOIN groups ON inscription.gid=groups.gid 
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id'
";
   echo  $count=$getCredit->count_by_query2($sql);


             // echo $getCredit->count_by_id('inscription','uid',$user_id);?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
       Inscription
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="inscriptions">View All </a>
                </div>
              </div>
                </div>

                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php 
              $sql="SELECT count(*) as total
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
LEFT JOIN ts_gtw_users ON groups.uid=ts_gtw_users.id
INNER JOIN centres ON groups.cnt_id=centres.cent_id
INNER JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id'
";
   echo  $count=$getCredit->count_by_query2($sql);
   

              //echo $getCredit->count_by_id('groups','uid',$user_id);?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
        Group
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="group">View All </a>
                </div>
              </div>
                </div>

                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php echo $getCredit->count_by_id('classroom','uid',$user_id);?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
        Classroom
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="classroom">View All </a>
                </div>
              </div>
                </div>


        </div>

         <div class="row">
            <div class="col-sm-2"> </div>
     <div class="col-sm-8">
<?php
 $year=date('Y');
 $data = $getCredit->count_registrations_by_month2($year,$user_id);
?>

         
         <canvas id="registrationChart"></canvas>

       <script type="text/javascript">
    const data = <?php echo $data; ?>;
    const ctx = document.getElementById('registrationChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(data),
            datasets: [{
                label: 'Registrations',
                data: Object.values(data),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

     </div>
     <div class="col-sm-2"> </div>
 </div>

    <?php } else if($postm=="employee")
    { ?>


<div class="row">
          <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">

              <?php 
              $query="SELECT * 
FROM certificates 
LEFT JOIN registrations ON certificates.reg_id=registrations.reg_id
LEFT JOIN formation ON certificates.fid=formation.fid
LEFT JOIN ts_gtw_users ON certificates.uid=ts_gtw_users.id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id'
";
echo $getCredit->count_by_query($query);?>
              </p>
              <br>
               <h3 class="plan-title">
            Certificates
             </h3>
             
             </div>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="certificates">View All </a>
                </div>
              </div>
                </div>
                 <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
             
             <div class="plan-price">
              <p class="price">
              <?php 
              $query2="SELECT * 
FROM registrations 
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN formation ON registrations.fid=formation.fid
LEFT JOIN ts_gtw_users ON registrations.uid=ts_gtw_users.id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id'";
              echo $getCredit->count_by_query($query2);?>
              </p>
             
             </div>
             <br> 
             <h3 class="plan-title">
           Registrations
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="registrations">View All </a>
                </div>
              </div>
                </div>

                 
        
                
                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php
              $query="SELECT * 
FROM inscription
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN ts_gtw_users ON inscription.uid=ts_gtw_users.id
LEFT JOIN groups ON inscription.gid=groups.gid
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id'";
               echo $getCredit->count_by_query($query);?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
       Inscription
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="inscriptions">View All </a>
                </div>
              </div>
                </div>

                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php 
              $query="SELECT * 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid
LEFT JOIN ts_gtw_users ON groups.uid=ts_gtw_users.id
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id'";
              echo $getCredit->count_by_query($query);?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
        Group
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="group">View All </a>
                </div>
              </div>
                </div>

                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php 
              $query="SELECT distinct classroom.* , ts_gtw_users.username
FROM classroom
LEFT JOIN ts_gtw_users ON classroom.uid=ts_gtw_users.id
LEFT JOIN schedual ON classroom.clsid=schedual.classroom
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id'";
              echo $getCredit->count_by_query($query);?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
        Classroom
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="classroom">View All </a>
                </div>
              </div>
                </div>
                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php 
              $query="SELECT distinct modules.*,ts_gtw_users.username,formation.formation_name
FROM modules 
LEFT JOIN exams ON modules.mid=exams.mid
LEFT JOIN schedual ON exams.sid=schedual.sid
LEFT JOIN groups ON schedual.gid=groups.gid
LEFT JOIN formation ON modules.fid=formation.fid
LEFT JOIN ts_gtw_users ON modules.uid=ts_gtw_users.id
LEFT JOIN inscription ON groups.gid=inscription.gid
LEFT JOIN registrations ON inscription.reg_id=registrations.reg_id
LEFT JOIN centres ON registrations.cent_id=centres.cent_id
LEFT JOIN links ON centres.cent_id=links.cent_id
 WHERE links.id='$user_id'";
              echo $getCredit->count_by_query($query);?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
        Modules
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="module">View All </a>
                </div>
              </div>
                </div>
            </div>



<?php } else if($postm=="prof") {?> 

<div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php 
             $query="SELECT distinct groups.*, formation.formation_name 
FROM groups 
LEFT JOIN formation ON groups.fid=formation.fid 
LEFT JOIN schedual ON groups.gid=schedual.gid 
LEFT JOIN ts_gtw_users ON schedual.pid=ts_gtw_users.id 
 WHERE schedual.pid='$user_id'";
              echo $getCredit->count_by_query($query);?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
        Group
             </h3>
                </div>
                <div class="plan-bottom">
                  <a class="plan-button" href="group">View All </a>
                </div>
              </div>
                </div>
               

                <div class="col-sm-3">
<div class="price_style">
                <div class="plan-header">
            
             <div class="plan-price">
              <p class="price">
              <?php 
            
              echo $getCredit->count_by_id('schedual','pid',$user_id);?>
              </p>
            
             </div>
             <br> 
              <h3 class="plan-title">
        Seances
             </h3>
                </div>
                <div class="plan-bottom">
                  &nbsp;
                </div>
              </div>
                </div>

                <br>

<?php } ?>

<style>
    .stats .col-md-5{
        background: white;
        border-radius: 10px;
        border: 1px solid #0000000f;
        padding: 20px;
        margin: 50px 40px;
    }
</style>




        <!-- /page content -->

        <?php include("footer.php") ?>

        