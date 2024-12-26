$("#payment").hide();
$(document).on('change', '#duration', function(){
  var duration = $('#duration').val(); 
  if(duration!='')
  {
    $("#payment").show();
    $("#amount").html(duration);
  }
  else 
  {
      $("#payment").hide();
        $("#amount").html(duration);
  }
 });



$(document).on('submit','#user_form',function(e){
      e.preventDefault();
        var name = $("#name").val().trim(); 
         var lname = $("#lname").val().trim(); 
          var dob = $("#dob").val().trim();
           var session = $("#session").val().trim();
                var fname = $("#fname").val().trim();
                 var mname = $("#mname").val().trim();
                var aadhar = $("#aadhar").val().trim();
                  var email = $("#email").val().trim();
                     var type = $("#type").val().trim();
                      
                   var mobile = $("#mobile").val().trim();
                          var city = $("#city").val().trim();
                      var state = $("#sts").val();
                     var district = $("#state").val();
                      var taluka = $("#taluka").val().trim();

                      var pincode = $("#pincode").val().trim();
                       var course = $("#course").val().trim();
                         var duration = $("#duration").val().trim();
                           var qualification = $("#qualification").val().trim();
                              var institute = $("#institute").val().trim();
                                var txnid = $("#txnid").val().trim();
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                 var regPhone = /^(0|[+91]{3})?[7-9][0-9]{9}$/;
                  var regText = /^[a-zA-Z ]*$/;
                  var regUsername = /^^[^0-9][a-z0-9]+([_-]?[a-z0-9])*$/;
                   var regPincode=/^[1-9][0-9]{5}$/;
                   var regAadhar=/^[1-9][0-9]{11}$/;
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                             var form_data = new FormData(document.querySelector('#user_form'));
                             var property = document.getElementById('profile_img').files;

         property = property[0];    
if(property){
    var image_namei = property.name;
     var image_sizei = property.size;
    var image_extension = image_namei.split('.').pop().toLowerCase();
    form_data.append("profile_img",property);
}
else{
  var image_namei='';
}
  if(image_namei=='')
                      {
                           $(".alert-msg").show(); 
                        $("#imagee").text('<-Please select profile picture');
                        $("#photo").focus();  
                        alertMsg();

                      }
                      else if(image_sizei>1048576)
                      {
                        $(".alert-msg").show(); 
                        $("#imagee").text('<-Picture size under 1MB allowed.');
                        $("#photo").focus();  
                        alertMsg();
                      }

                   else if(name.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#namee").text('Please enter first name');
                        $("#name").focus();  
                        alertMsg();
                      }
                      else if(!regText.test(name))  
                      {
                        $(".alert-msg").show(); 
                        $("#namee").text('Please enter only alphabets..');
                        $("#name").focus();  
                          alertMsg();
                      }
                                  else if(lname.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#lnamee").text('Please enter last name');
                        $("#lname").focus();  
                        alertMsg();
                      }
                       else if(!regText.test(lname))  
                      {
                        $(".alert-msg").show(); 
                        $("#lnamee").text('Please enter only alphabets..');
                        $("#lname").focus();  
                          alertMsg();
                      }
                       else if(dob=='')
                      { 
                        $(".alert-msg").show(); 
                        $("#dobe").text('Please select date of birth.');
                        $("#dob").focus();  
                        alertMsg();
                      }

                    
                      else if(fname.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#fnamee").text('Please enter your Father Name');
                        $("#fname").focus();  
                        alertMsg();
                      }
                        else if(!regText.test(fname))  
                      {
                        $(".alert-msg").show(); 
                        $("#fnamee").text('Please enter only alphabets..');
                        $("#fname").focus();  
                          alertMsg();
                      }
                        else if(mname.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#mnamee").text('Please enter your Mother Name');
                        $("#mname").focus();  
                        alertMsg();
                      }
                        else if(!regText.test(mname))  
                      {
                        $(".alert-msg").show(); 
                        $("#mnamee").text('Please enter only alphabets..');
                        $("#mname").focus();  
                          alertMsg();
                      }
                      else if(!regAadhar.test(aadhar))  
                      {
                         $(".alert-msg").show(); 
                        $("#aadhare").text('Please enter 12 digits aadhar No.'); 
                        $("#aadhar").focus();  
                        alertMsg();
                       
                      }
                       else if(email.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#emaile").text('Please enter your email.');
                        $("#email").focus();  
                        alertMsg();
                      }

                      else if(!regex.test(email))
                      {
                         $(".alert-msg").show(); 
                        $("#emaile").text('Please enter valid email address');
                        $("#email").focus();  
                        alertMsg();
                      }
                        else if(!regPhone.test(mobile))  
                      {
                         $(".alert-msg").show(); 
                        $("#mobilee").text('Please enter 10 digits Mobile No.');
                        $("#mobile").focus();  
                        alertMsg();
                       
                      }
                        else if(city.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#city").text('Please enter your village/city.');
                        $("#citye").focus();  
                        alertMsg();
                      }

                      else if(state.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#statee").text('Please select your state');
                        $("#sts").focus();  
                        alertMsg();
                      }
                      else if(district.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#districte").text('Please select your district');
                        $("#state").focus();  
                        alertMsg();
                      }
                       else if(taluka.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#talukae").text('Please enter taluka.');
                        $("#taluka").focus();  
                        alertMsg();
                      }
                    
                    
                      else if(!regPincode.test(pincode))  
                      {
                         $(".alert-msg").show(); 
                        $("#pincodee").text('Please enter 6 digits correct pincode.'); 
                        $("#pincode").focus();  
                        alertMsg();
                       
                      }
                       else if(course.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#coursee").text('Please enter course.');
                        $("#course").focus();  
                        alertMsg();
                      }
                     
                        else if(qualification.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#qualificatione").text('Please enter course qualification.');
                        $("#qualification").focus();  
                        alertMsg();
                      }
                       else if(institute.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#institutee").text('Please enter institute.');
                        $("#institute").focus();  
                        alertMsg();
                      }
                        else if(txnid.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#txnide").text('Please enter payment transaction ID.');
                        $("#txnid").focus();  
                        alertMsg();
                      }
                       else if(type.length<1)
                      { 
                        $(".alert-msg").show(); 
                        $("#typee").text('Please select registration type.');
                        $("#type").focus();  
                        alertMsg();
                      }

                       else if(duration.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#duratione").text('Please select course duration.');
                        $("#duration").focus();  
                        alertMsg();
                      }
                      else if(session.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#sessione").text('Please select session.');
                        $("#session").focus();  
                        alertMsg();
                      }

                     

                      else
                      {
fetch("app/reg_actionsesv47665255352565.php",{
  method:"POST",
  body:new FormData(this)
}).then(res=>res.json())
.then(dt=>{
  if(dt.error){
    alert("Error: "+dt.error)
  }else{
    $("#user_form").trigger("reset");
    $('#user_form')[0].reset();
    window.location = 'receipt.php';
  }
})
  }
 })

 function alertMsg(){
            setTimeout(function() {
    $('.alert-msg').fadeOut('fast');
     $(".alert-msg").text(''); 

}, 8000); 
          }