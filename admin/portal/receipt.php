<?php require_once("autoload.php");
include("includes/functions.php"); 
if(!isset($_SESSION['success_id']))
{
	header('location:registration.php'); 
	exit();
}
else 
{
	$rid=$_SESSION['success_id'];
}
$title='PAYMENT RECEIPT';
 $head='<link rel="stylesheet" href="lib/css/style4.css"><script src="lib/js/registran.js"></script><style type="text/css">
					.text-red
					{
						color: red;
						font-size: 12px;
					}
          table td 
          {
          	border:2px dotted;
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
@page { size: auto;  margin: 0mm;}
@media print {
    a[href]:after {
        content: none !important;
    }
}
.hcol
{
	font-weight:600;
	 text-transform: uppercase;
}
				</style>'; 
include("templates/head.php"); include("templates/header.php"); 
$rowm=$getCredit->fetch_all('pmore','id','ASC');
foreach($rowm as $ro)
{
$qrcode=$ro['iso'];
}
?>
 <div id="myModal" class="modal">
		  <!-- Modal content -->
		  <div class="modal-content">
				<span class="close">&times;</span>
		  </div>
		</div>
		<div class="container mt-3  main-div" style="border-radius:10px; margin-bottom: 80px; ">
			<div class="container mt-5">
				<br>
				<div class="row">
					<div class="col-sm-1">
					</div>
						<div class="col-sm-10">
							<?php 
							$rows=$getCredit->get_by_id('pregistrations','reg_id',$rid); 
							foreach($rows as $row){
							?>
								<table class="table" style="border:2px dotted;" border="1">
				<tr>
					<td style="width:50%;"> 
					
					<center><h3><?php echo $row['institute'];?></h3><!--<img src="assets/image/<?php echo $logo;?>" class="img-responsive img-center">--></center>
						<p class="hcol"><?php echo $certificate_header_sub_heading;?></p>
							<p class="hcol"><?php echo $certificate_header_address;?></p>

					</td>
					<td>
						<table border="0" style="width:100%;border: 2px solid white;">
							<tr>
								<td style="width:50%;border: 2px solid white;"><p class="hcol">TRANSACTION ID:</p></td>
								<td><p class="hcol"><?php echo $row['txnid'];?></p></td>
							</tr>
								<tr style="border: 2px solid white;">
								<td style="width:50%;border: 2px solid white;"><p class="hcol">DATE&TIME:</p></td>
								<td><p class="hcol"><?php echo $getDatabase->easy_date($row['reg_date']);?></p></td>
							</tr>
							
								<tr style="border: 2px solid white;">
								<td style="width:50%;border: 2px solid white;"><p class="hcol">CANDIDATE NAME:</p></td>
								<td><p class="hcol"><?php echo $row['namef'].' '.$row['namel'];?></p></td>
							</tr>
								<tr style="border: 2px solid white;">
								<td style="width:50%;border: 2px solid white;"><p class="hcol">FATHER`S NAME:</p></td>
								<td><p class="hcol"><?php echo $row['fname'];?></p></td>
							</tr>
							<tr style="border: 2px solid white;">
								<td style="width:50%;border: 2px solid white;"><p class="hcol">COURSE:</p></td>
								<td><p class="hcol"><?php echo $row['course'];?></p></td>
							</tr>
							<tr style="border: 2px solid white;">
								<td style="width:50%;border: 2px solid white;"><p class="hcol">SESSION:</p></td>
								<td><p class="hcol"><?php echo $row['session'];?></p></td>
							</tr>

						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<h2 style="font-weight: 900; text-align: center;background: #F5F5F5 !important; ">ONLINE FEE PAYMENT RECEIPT</h2>
					</td>
				</tr>
					<tr>
					<td colspan="2">
						<table border="0" style="width:100%;border: 2px solid white;">
							<tr style="background: #F5F5F5 !important;">
								<td style="width:30%;border: 2px solid white;"><p class="hcol">S.NO.</p></td>
								<td style="width:40%; border: 2px solid white;"><p class="hcol">PARTICULARS</p></td>
								<td><p class="hcol">Amount of course duration</p></td>
							</tr>
								<tr style="border: 2px solid white;">
								<td style="width:30%;border: 2px solid white;"><p class="hcol">1</p></td>
								<td  style="width:40%; border: 2px solid white;"><p class="hcol">FEE&DURATION</p></td>
								<td><p class="hcol"><?php echo $row['duration'];?></p></td>
							</tr>

						</table>

					</td>
				</tr>
				<tr>
					<td colspan="2">
						<h4 style="font-weight:700;"><?php echo $getCredit->get_option_value('receipt_note');?></h4>
					</td>
				</tr>

			</table>
		<?php } ?>
					</div>
						<div class="col-sm-1">
					</div>
				</div>
				 <center><img src="assets/image/print-ico-in.png" id="printbtn" onclick="window.print()" style="cursor:pointer;"></center>
		
	</div>
</div>

<?php include("templates/footer.php");