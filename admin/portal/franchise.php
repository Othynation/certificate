<?php require_once("autoload.php");
include("includes/functions.php"); 
$title='franchise Registration';
 $head='<link rel="stylesheet" href="lib/css/style4.css"><script src="lib/js/fregistration.js"></script><style type="text/css">
					.text-red
					{
						color: red;
						font-size: 12px;
					}
.border-dark {
    border: 1px solid black !important;
}
.border {
     border: 1px solid black !important;
}
#payment
{
	display:none;
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
		<div class="body_div2"></div>
		<div class="event-heading">
			<center><h2><b>Franchise Registration Form</b></h2></center>
		</div>
		 <p style="text-align:center;"><?php echo $getCredit->get_option_value('register_note');?></p>
		 <hr>
		<div class="container mt-3  main-div" style="border-radius:10px; margin-bottom: 80px;border:2px solid #eeeeee;padding: 20px;">
			<div class="container mt-5">
				<br>
				
				<form  id="user_form"  method="post" enctype="multipart/form-data">


			
				</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label for="">Owner Name<span id="red">*</span> :</label>
								<input type="text" name="name" id="name"  value="" class="form-control" placeholder="Owner Name">
								<div class="text-red alert-msg" id="namee"> </div>
							</div>
							
							<div class="col-md-4">
								<label for="">Institute Name<span id="red">*</span> :</label>
								<input type="text" name="institute_name" id="institute_name"  value="" class="form-control" placeholder="Institute Name">
								<div class="text-red alert-msg" id="institute_namee"> </div>
							</div>
							<div class="col-md-4">
								<label for="">Mobile No<span id="red">*</span> :</label>
								<input type="text" name="mobile" id="mobile"  value="" class="form-control" placeholder="Mobile Number">
								<div class="text-red alert-msg" id="mobilee"> </div>
							</div>

						</div>
					</div>
					<div class="line-all">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label for="">Email<span id="red">*</span> :</label>
								<input type="text" name="email" id="email"  value="" class="form-control" placeholder="Email">
								<div class="text-red alert-msg" id="emaile"> </div>
							</div>
							
							<div class="col-md-4">
								<label for="">Address<span id="red">*</span> :</label>
								<input type="text" name="address" id="address"  value="" class="form-control" placeholder="Address">
								<div class="text-red alert-msg" id="addresse"> </div>
							</div>
							<div class="col-md-4">
								<label for="">City<span id="red">*</span> :</label>
								<input type="text" name="city" id="city"  value="" class="form-control" placeholder="City Name">
								<div class="text-red alert-msg" id="citye"> </div>
							</div>

						</div>
					</div>


					<div class="line-all">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label for="">State<span id="red">*</span> :</label>
									<select onchange="print_city('state', this.selectedIndex);" id="sts" name ="state" class="form-control" ></select>
							<div class="text-red alert-msg" id="statee"> </div>
							</div>
							
							<div class="col-md-3">
								<label for="">District<span id="red">*</span> :</label>
								<select id ="state" class="form-control" name="district"></select>
						<div class="text-red alert-msg" id="districte"> </div>
							</div>
							<div class="col-md-3">
								<label for="">Pincode<span id="red">*</span> :</label>
								<input type="text" name="pincode" id="pincode"  value="" class="form-control" placeholder="Pincode">
								<div class="text-red alert-msg" id="pincodee"> </div>
							</div>
								<div class="col-md-3">
								<label for="">Total centre area in square feet<span id="red">*</span> :</label>
								<input type="text" name="area" id="area"  value="" class="form-control" placeholder="Area">
								<div class="text-red alert-msg" id="areae"> </div>
							</div>


						</div>
					</div>
					
					
					<div class="line-all">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-3" >
								<label for="">Aadhaar <span id="red">(image size 200kb)</span> :</label>
								<div class="image_div_col">
						<div class="image_preview_div">
							<img id="img1" src="webimg/id.html" alt="">
							<label for="image1"><i class="fa fa-camera" aria-hidden="true"></i></label>
						<input type="file" id="image1" data-id='img1' style="visibility:hidden" accept=".png, .jpg, .jpeg"  class="form-control-file border file3"  name="image1">
					</div>
					</div>

							<div class="text-red alert-msg" id="aadhaare"> </div>
							
							</div>
							 
							<div class="col-md-3">
								<label for="">Pan Card<span id="red"> (image size 200kb)</span> :</label>
							
						<div class="image_preview_div image_div_col">
							<img id="img2" src="webimg/id.html" alt="">
							<label for="image2"><i class="fa fa-camera" aria-hidden="true"></i></label>
						<input type="file" id="image2" data-id='img2' style="visibility:hidden" accept=".png, .jpg, .jpeg"  class="form-control-file border file3"  name="image2">
					</div>
						<div class="text-red alert-msg" id="pancarde"> </div>
							</div>
							<div class="col-md-3">
								<label for="">Owner Photo<span id="red"> (image size 200kb)</span> :</label>
							<div class="image_preview_div image_div_col">
							<img id="img3" src="webimg/id.html" alt="">
							<label for="image3"><i class="fa fa-camera" aria-hidden="true"></i></label>
						<input type="file" id="image3" data-id='img3' style="visibility:hidden" accept=".png, .jpg, .jpeg"  class="form-control-file border file3"  name="image3">
					</div>
								<div class="text-red alert-msg" id="photoe"> </div>
							</div>
								<div class="col-md-3">
								<label for="">Qualification Documents<span id="red"> (image size 200kb)</span> :</label>
							<div class="image_preview_div image_div_col">
							<img id="img4" src="webimg/id.html" alt="">
							<label for="image4"><i class="fa fa-camera" aria-hidden="true"></i></label>
						<input type="file" id="image4" data-id='img4' style="visibility:hidden" accept=".png, .jpg, .jpeg"  class="form-control-file border file3"  name="image4">
					</div>
								<div class="text-red alert-msg" id="qualificatione"> </div>
							</div>



						</div>
					</div>
					<div class="line-all">
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-md-4" >
								<label for="">Outdoor Institute Photos <span id="red">(image size 200kb)</span> :</label>
								<div class="image_div_col">
						<div class="image_preview_div">
							<img id="img5" src="webimg/id.html" alt="">
							<label for="image5"><i class="fa fa-camera" aria-hidden="true"></i></label>
						<input type="file" id="image5" data-id='img5' style="visibility:hidden" accept=".png, .jpg, .jpeg"  class="form-control-file border file3"  name="image5">
					</div>
					</div>

							<div class="text-red alert-msg" id="outdoor_institutee"> </div>
							
							</div>
							 
							<div class="col-md-4">
								<label for="">Indoor Class Room<span id="red"> (image size 200kb)</span> :</label>
							
						<div class="image_preview_div image_div_col">
							<img id="img6" src="webimg/id.html" alt="">
							<label for="image6"><i class="fa fa-camera" aria-hidden="true"></i></label>
						<input type="file" id="image6" data-id='img6' style="visibility:hidden" accept=".png, .jpg, .jpeg"  class="form-control-file border file3"  name="image6">
					</div>
						<div class="text-red alert-msg" id="class_roome"> </div>
							</div>
							<div class="col-md-4">
								<label for="">Local NOC <span id="red"> (image size 200kb)</span> :</label>
							<div class="image_preview_div image_div_col">
							<img id="img7" src="webimg/id.html" alt="">
							<label for="image7"><i class="fa fa-camera" aria-hidden="true"></i></label>
						<input type="file" id="image7" data-id='img7' style="visibility:hidden" accept=".png, .jpg, .jpeg"  class="form-control-file border file3"  name="image7">
					</div>
								<div class="text-red alert-msg" id="local_noce"> </div>
							</div>
						



						</div>
					</div>



			<div class="form-group">
				<div class="row">
				<label for="">Trust , Society, MSME, Electricity bill, Other Documents Any One <span id="red"> (image size 200kb)</span> :</label>
					<div class="col-md-12">
                     <div class="image_preview_div image_div_col">
							<img id="img8" src="webimg/id.html" alt="">
							<label for="image8"><i class="fa fa-camera" aria-hidden="true"></i></label>
						<input type="file" id="image8" data-id='img8' style="visibility:hidden" accept=".png, .jpg, .jpeg"  class="form-control-file border file3"  name="image8">
					</div>
								<div class="text-red alert-msg" id="othere"> </div>

					</div>
				</div>
			</div>
			<div class="line-all">
			</div>
			
			<div class="form-group">
				<input type="checkbox" id="vehicle1" checked disabled>
  			<label for="vehicle1">The responsibility of the information sent by the correspondent will be on the correspondent himself. No information will be published without evidence.</label>
				<p class="text-red" id="message"></p>
				
				<input type="hidden" name="reg_no" id="reg_no" value="" readonly>
				<center><button type="submit" id="submit" class="btn btn-grad sub-btn pl-4 pr-4 pt-2 pb-2 mb-2" name="button">Register</button></center>
			</div>
		</form>
	</div>
</div>
<script language="javascript">
	print_state("sts");
</script>
<script type="text/javascript">
	$(document).on('change','#drop',change);
		function change(){
		var id_val = $(this).val();
		$('.verify_id').text(id_val);
	}
	
</script>
<script>

</script>
<script type="text/javascript">
$(document).ready(function(){
$('#agent-home').click(function(){
window.location.href="login.html";
});
});
</script>
<script type="text/javascript">

function preview(){
	$('.preview').html(
		`
		<style>
		.image_preview{
		 position: fixed;
		 top: 50%;
		 left: 50%;
		 transform:translate(-50%,-50%);
		 height: 500px;
		 width: 360px;
		 background: #fff;
		 box-shadow: 0px 0px 5px 1px lightgray;
		 border-radius: 10px;
		 z-index: 999;
		 overflow: hidden;
		 display: none;
	 }
	 .image_preview div{
		 height: 100%;
		 width: 100%;
		 position: relative;

	 }
	 .image_preview img{
		 width: 90%;
		 height: auto;
		 position: absolute;
		 top: 50%;
		 left: 50%;
		 transform:translate(-50%,-50%);
		 z-index: 999999999;
	 }
	 .image_preview p{
		 padding: 10px;
		 background: #e62e25;
		 text-align: center;
		 color: #fff;
		 font-size: 20px;
		 transition: .3s;
		 cursor: pointer;
	 }
	 img{
		 cursor: pointer;
	 }
	 .image_preview p:hover{
		 background: #e8524a;
		 transition: .3s;
	 }
		</style>
		<div class="image_preview">
		 <div class="">
			 <p id="preview_cancel">Cancel</p>
			 <img src="complain_img/Screenshot (2)_0412022140228.png" alt="">
		 </div>
	 </div>
		`
	);
	
}
preview();
$(document).on('change','input[type=file]',function(event){

	var id = $(this).attr('data-id');
	var img = document.getElementById(`${id}`);
	var reader = new FileReader();
	 reader.onload = function(){
		 img.src = reader.result;
	 };
	 reader.readAsDataURL(event.target.files[0]);
})


</script>
<?php include("templates/footer.php");