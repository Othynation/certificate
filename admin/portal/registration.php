<?php require_once("autoload.php");
include("includes/functions.php"); 
$title='Registration';
 $head='<link rel="stylesheet" href="lib/css/style4.css"><script src="lib/js/registration.js"></script><style type="text/css">
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
			<center><h2><b>Registration Form</b></h2></center>
		</div>
		 <p style="text-align:center;"><?php echo $getCredit->get_option_value('register_note');?></p>
		 <hr>
		<div class="container mt-3  main-div" style="border-radius:10px; margin-bottom: 80px; ">
			<div class="container mt-5">
				
				<form  id="user_form"  method="post" enctype="multipart/form-data">


			<div class="form-group">
				<div class="row">
					<div class="col-md-3" style="margin-top:100px;">
					<label for="">PHOTO<span id="red">*</span>:</label>
					
					</div>
					<div class="col-md-6 image_div_col" style="margin-top:100px;">
						<div class="image_preview_div">
						
							<label for="profile_img"><i class="fa fa-camera" aria-hidden="true"></i></label>
						<input type="file" id="profile_img" name="profile_img" data-id="img1" style="visibility:hidden" accept=".png, .jpg, .jpeg" id="sel-file1" class="form-control-file border file1"  name="Profile">
						 </div>
					</div>
					<div class="col-md-3">
						
						<div id="photo">
							<img src="assets/image/dummy-vs12.png" height="150" width="150" class="border border-dark" id="img1">
						</div>
				
								<div class="text-red alert-msg" id="imagee"> </div>
							</div>

					
					</div>
				</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-1">
								<label for="">First Name<span id="red">*</span> :</label>
							</div>
							<div class="col-md-3">
								<input type="text" name="name" id="name"  value="" class="form-control" placeholder="First Name">
								<div class="text-red alert-msg" id="namee"> </div>
							</div>
							<div class="col-md-1">
								<label for="">Last Name<span id="red">*</span> :</label>
							</div>
							<div class="col-md-3">
								<input type="text" name="lname" id="lname"  value="" class="form-control" placeholder="Last Name">
								<div class="text-red alert-msg" id="lnamee"> </div>
							</div>
							<div class="col-md-1">
								<label for="">DOB<span id="red">*</span> :</label>
							</div>
							<div class="col-md-3">
								<input type="date" name="dob" id="dob"  value="" class="form-control">
								<div class="text-red alert-msg" id="dobe"> </div>
							</div>


						</div>
					</div>
					<div class="line-all">
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-3">
								<label for="">Father Name<span id="red">*</span> :</label>
							</div>
							<div class="col-md-3">
								<input type="text" name="fname" id="fname"  value="" class="form-control" placeholder="Father Name">
								<div class="text-red alert-msg" id="fnamee"> </div>
							</div>

							<div class="col-md-3">
								<label for="">Mother Name<span id="red">*</span> :</label>
							</div>
							<div class="col-md-3">
								<input type="text" name="mname" id="mname"  value="" class="form-control" placeholder="Mother Name">
								<div class="text-red alert-msg" id="mnamee"> </div>
							</div>
						</div>
					</div>

					<div class="line-all">
					</div>
					<div class="form-group">
						<div class="row">
							
							<div class="col-md-3">
								<label for="">Aadhaar Number<span id="red">*</span>:</label>
							</div>
							<div class="col-md-3">
								<input type="text" name="aadhar" id="aadhar" value="" class="form-control" placeholder="Aadhar Number">
								<div class="text-red alert-msg" id="aadhare"> </div>
							</div>
							<div class="col-md-3">
								<label for="">Email<span id="red">*</span>:</label>
							</div>
							<div class="col-md-3">
								<input type="text" name="email" id="email" value="" class="form-control" placeholder="Email Id">
								<div class="text-red alert-msg" id="emaile"> </div>
							</div>

						</div>
					</div>
					<div class="line-all">
					</div>
					<div class="form-group">
				<div class="row">
					<div class="col-md-3">
						<label for="">Mobile No<span id="red">*</span>:</label>
					</div>

					<div class="col-md-3">
						<input type="text" name="mobile" id="mobile" value="" class="form-control" placeholder="Mobile Number">
						<div class="text-red alert-msg" id="mobilee"> </div>
					</div>
					<div class="col-md-3">
						<label for="">Village/City<span id="red"></span>:</label>

					</div>

					<div class="col-md-3">
						<input type="text" name="city" id="city"  value="" class="form-control" placeholder="Village/City" />
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
							</div>
							<div class="col-md-3">
							<select onchange="print_city('state', this.selectedIndex);" id="sts" name ="state" class="form-control" ></select>
							<div class="text-red alert-msg" id="statee"> </div>
						</div>
						<div class="col-md-3">
							<label for="">District<span id="red">*</span>:</label>
						</div>
						<div class="col-md-3">
						<select id ="state" class="form-control" name="district"></select>
						<div class="text-red alert-msg" id="districte"> </div>
					</div>
				</div>
			</div>
			<div class="line-all">
			</div>
			<div class="form-group">
	

				<div class="row">
								<div class="col-md-3">
						<label for="">Taluka<span id="red">*</span>:</label>
					</div>
					<div class="col-md-3">
						<input type="text" name="taluka" id="taluka" value="" class="form-control" placeholder="Taluka">
						<div class="text-red alert-msg" id="talukae"> </div>
					</div>
					<div class="col-md-3">
						<label for="">Pin Code<span id="red">*</span>:</label>
					</div>
					<div class="col-md-3">
						<input type="text" name="pincode" id="pincode"  value="" class="form-control" placeholder="Pincode">
						<div class="text-red alert-msg" id="pincodee"> </div>
					</div>
					
				</div>
			</div>
			<div class="line-all">
			</div>
			<div class="form-group">
	

				<div class="row">
								<div class="col-md-3">
							<label for="">Course Name<span id="red">*</span>:</label>
							</div>
							<div class="col-md-3">
								<select class="form-control" name="course" id="course" >
										<option value="">Select Course</option>
								<?php 
							$course_durations=$getCredit->get_option_value('course_names');
							$arrs=explode(',',$course_durations); 
							foreach($arrs as $arr)
							{
							echo '<option value="'.$arr.'">'.$arr.'</option>';	
							}
							?>

								</select>
								<div class="text-red alert-msg" id="coursee"> </div>
							</div>

					<div class="col-md-3">
							<label for="">Institute Name<span id="red">*</span>:</label>
							</div>
							<div class="col-md-3">
									<input type="text" name="institute" id="institute" class="form-control" placeholder="Institute Name">
						<div class="text-red alert-msg" id="institutee"> </div>

							</div>

					
				</div>
			</div>
			<div class="line-all">
			</div>
			<div class="form-group">
	

				<div class="row">
								<div class="col-md-3">
							<label for="">Qualification<span id="red">*</span>:</label>
							
							</div>
							<div class="col-md-3">
								<select class="form-control" name="qualification" id="qualification" >
										<option value="">Select Qualification</option>
										<?php 
							$qualification=$getCredit->get_option_value('qualifications');
							$arrs=explode(',',$qualification); 
							foreach($arrs as $arr)
							{
							echo '<option value="'.$arr.'">'.$arr.'</option>';	
							}
							?>
										
								</select>
								<div class="text-red alert-msg" id="qualificatione"> </div>
							</div>

					<div class="col-md-3">
							<label for="" id="label">Upload documents</label>
							</div>
								<div class="col-md-3 image_div_col">
						<div class="image_preview_div">
							<img id="img3" src="webimg/id.html" alt="">
					
						<input type="file" id="press_id" data-id='img3' accept="application/pdf,application/vnd.ms-excel,.png, .jpg, .jpeg .pdf" name="press_id" style="width:250px !important;">
					</div>
					</div>

				</div>
			</div>
	
			<div class="line-all">
			</div>
			<div class="form-group">
	

				<div class="row">
								<div class="col-md-3">
							<label for="">Type <span id="red">*</span>:</label>
							</div>
							<div class="col-md-3">
								<select class="form-control" name="type" id="type">
										<option value="">Select Type</option>
								
							<option value="2">Technical </option>
							<option value="1">Paramedical</option>
						  
								</select>
								<div class="text-red alert-msg" id="typee"> </div>
							</div>

					<div class="col-md-3">
							<label for="">Course Duration<span id="red">*</span>:</label>
							</div>
							<div class="col-md-3">
								<select class="form-control" name="duration" id="duration">
										<option value="">Select duration</option>
													
								</select>
								<div class="text-red alert-msg" id="duratione"> </div>
							</div>


					
				</div>
			</div>
			<div class="form-group">
	

				<div class="row">
								<div class="col-md-3">
							<label for="">Session<span id="red">*</span>:</label>
							</div>
							<div class="col-md-3">
								<select class="form-control" name="session" id="session">
										<option value="">Select Session</option>
								  <?php 
								     $session=$getCredit->get_option_value('sessions'); 
									  $arr= explode(",", $session);

									 foreach ($arr as $ar) {
    echo "<option value='$ar'>$ar</option>";
}

								  ?>
							
						   
								</select>
								<div class="text-red alert-msg" id="sessione"> </div>
							</div>


					
				</div>
			</div>
			
			<div class="line-all">
			</div>

			<div class="row">
				<div class="col-sm-2">
				</div>
				<div class="col-sm-8">
					<div id="payment" style="border: 3px solid #6739b7;padding: 5px;">
					<h3>Scan Below QrCode to Pay Fees and Submit Transaction Id:</h3>
					<hr>
					<h4>Amount of course duration: <span id="amount"></span></h4>
					<div class="form-group">
				<div class="row">
					<div class="col-md-3">
						<label for="">Transaction Id<span id="red">*</span>:</label>
					</div>

					<div class="col-md-6">
						<input type="text" name="txnid" id="txnid" class="form-control" placeholder="Txn ID">
						<div class="text-red alert-msg" id="txnide"> </div>
					</div>
				
				</div>
			</div>
	         <div class="row">
	         	<div class="col-sm-4">
	         	</div>
	         	<div class="col-sm-4">
			<img src="assets/images/<?php echo $qrcode;?>" class="img-responsive" style="height:200px;">
		</div>
		<div class="col-sm-4">
		</div>
		</div>
		<h5 style="text-align:center;">UPI/VPA: <br><strong><?php echo $getCredit->get_option_value('upi_id');?></strong></h5>

				</div>
				</div>
				<div class="col-sm-2">
				</div>
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
	$(document).on('click','img',function(){
		var src = $(this).attr('src');
		$('.image_preview img').attr('src',src);
		$('.image_preview').css('display','block');
	})
	$(document).on('click','#preview_cancel',function(){
	 $('.image_preview').css('display','none');
 })
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

$(document).on('change', '#type', function(){
  var type = $('#type').val(); 
  if(type!='')
  {
    $.ajax({
      url:"app/changetype.php",
      type:"post",
       data: {type:type},
        type: "POST",
      success:function(data){
         $("#duration").html(data);
      }
    })

  }
 });



</script>
<?php include("templates/footer.php");