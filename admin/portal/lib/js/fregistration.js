$(document).on('submit','#user_form',function(e){
      e.preventDefault();
        var name = $("#name").val().trim();
         var institute_name = $("#institute_name").val().trim(); 
                var mobile = $("#mobile").val().trim();
                  var email = $("#email").val().trim();
                   var mobile = $("#mobile").val().trim();
                          var city = $("#city").val().trim();
                      var state = $("#sts").val();
                     var district = $("#state").val();
                      var pincode = $("#pincode").val().trim();
                       var area = $("#area").val().trim();
                            var address = $("#address").val().trim();
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                 var regPhone = /^(0|[+91]{3})?[7-9][0-9]{9}$/;
                  var regText = /^[a-zA-Z ]*$/;
                  var regUsername = /^^[^0-9][a-z0-9]+([_-]?[a-z0-9])*$/;
                   var regPincode=/^[1-9][0-9]{5}$/;
                   var regAadhar=/^[1-9][0-9]{11}$/;
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                             var form_data = new FormData(document.querySelector('#user_form'));
                             var property = document.getElementById('image1').files;

         property = property[0];    
if(property){
    var image_name1 = property.name;
     var image_size1 = property.size;
    var image_extension = image_name1.split('.').pop().toLowerCase();
    form_data.append("image1",property);
}
else{
  var image_name1='';
}
//image 2 

 var property = document.getElementById('image2').files;

         property = property[0];    
if(property){
    var image_name2 = property.name;
     var image_size2 = property.size;
    var image_extension = image_name2.split('.').pop().toLowerCase();
    form_data.append("image1",property);
}
else{
  var image_name2='';
}
//image 3 

 var property = document.getElementById('image3').files;

         property = property[0];    
if(property){
    var image_name3 = property.name;
     var image_size3 = property.size;
    var image_extension = image_name3.split('.').pop().toLowerCase();
    form_data.append("image3",property);
}
else{
  var image_name3='';
}
//image 4 

 var property = document.getElementById('image4').files;

         property = property[0];    
if(property){
    var image_name4 = property.name;
     var image_size4 = property.size;
    var image_extension = image_name4.split('.').pop().toLowerCase();
    form_data.append("image4",property);
}
else{
  var image_name4='';
}

//image 5 

 var property = document.getElementById('image5').files;

         property = property[0];    
if(property){
    var image_name5 = property.name;
     var image_size5 = property.size;
    var image_extension = image_name5.split('.').pop().toLowerCase();
    form_data.append("image5",property);
}
else{
  var image_name5='';
}

//image 6 

 var property = document.getElementById('image6').files;

         property = property[0];    
if(property){
    var image_name6 = property.name;
     var image_size6 = property.size;
    var image_extension = image_name6.split('.').pop().toLowerCase();
    form_data.append("image6",property);
}
else{
  var image_name6='';
}

//image 7

 var property = document.getElementById('image7').files;

         property = property[0];    
if(property){
    var image_name7 = property.name;
     var image_size7 = property.size;
    var image_extension = image_name7.split('.').pop().toLowerCase();
    form_data.append("image6",property);
}
else{
  var image_name7='';
}

//image 8

 var property = document.getElementById('image8').files;

         property = property[0];    
if(property){
    var image_name8 = property.name;
     var image_size8 = property.size;
    var image_extension = image_name8.split('.').pop().toLowerCase();
    form_data.append("image8",property);
}
else{
  var image_name8='';
}








  

                   if(name.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#namee").text('Please enter full name');
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
                                  else if(institute_name.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#institute_namee").text('Please enter institute name');
                        $("#institute_name").focus();  
                        alertMsg();
                      }
                         else if(!regPhone.test(mobile))  
                      {
                         $(".alert-msg").show(); 
                        $("#mobilee").text('Please enter 10 digits Mobile No.');
                        $("#mobile").focus();  
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
                       else if(address.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#addresse").text('Please enter address.');
                        $("#address").focus();  
                        alertMsg();
                      }
                     
                        else if(city.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#citye").text('Please enter your city.');
                        $("#city").focus();  
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
                      
                    
                      else if(!regPincode.test(pincode))  
                      {
                         $(".alert-msg").show(); 
                        $("#pincodee").text('Please enter 6 digits correct pincode.'); 
                        $("#pincode").focus();  
                        alertMsg();
                       
                      }
                      
                      else if(area.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#areae").text('Please enter total centre area in square feet.');
                        $("#area").focus();  
                        alertMsg();
                      }
                      else if(image_name1=='')
                      {
                           $(".alert-msg").show(); 
                        $("#aadhaare").text('<-Please upload Aadhaar image.');
                        $("#image1").focus();  
                        alertMsg();

                      }
                      else if(image_size1>200000)
                      {
                        $(".alert-msg").show(); 
                        $("#aadhaare").text('<-Aadhar size under 200kb allowed.');
                        $("#image1").focus();  
                        alertMsg();
                      }

                       else if(image_name2=='')
                      {
                           $(".alert-msg").show(); 
                        $("#pancarde").text('<-Please upload pan card.');
                        $("#image2").focus();  
                        alertMsg();

                      }
                      else if(image_size2>200000)
                      {
                        $(".alert-msg").show(); 
                        $("#pancarde").text('<-Pan card size under 200kb allowed.');
                        $("#image2").focus();  
                        alertMsg();
                      }

                       else if(image_name3=='')
                      {
                           $(".alert-msg").show(); 
                        $("#photoe").text('<-Please upload photo.');
                        $("#image3").focus();  
                        alertMsg();

                      }
                      else if(image_size3>200000)
                      {
                        $(".alert-msg").show(); 
                        $("#photoe").text('<-Photo size under 200kb allowed.');
                        $("#image3").focus();  
                        alertMsg();
                      }

                         else if(image_name4=='')
                      {
                           $(".alert-msg").show(); 
                        $("#qualificatione").text('<-Please upload qualification document.');
                        $("#image4").focus();  
                        alertMsg();

                      }
                      else if(image_size4>200000)
                      {
                        $(".alert-msg").show(); 
                        $("#qualificatione").text('<-Qualification document size under 200kb allowed.');
                        $("#image4").focus();  
                        alertMsg();
                      }
                           else if(image_name5=='')
                      {
                           $(".alert-msg").show(); 
                        $("#outdoor_institutee").text('<-Please upload Outdoor Institute Photos.');
                        $("#image5").focus();  
                        alertMsg();

                      }
                      else if(image_size5>200000)
                      {
                        $(".alert-msg").show(); 
                        $("#outdoor_institutee").text('<-Outdoor Institute Photos size under 200kb allowed.');
                        $("#image5").focus();  
                        alertMsg();
                      }

                           else if(image_name6=='')
                      {
                           $(".alert-msg").show(); 
                        $("#class_roome").text('<-Please upload Indoor Class Room.');
                        $("#image5").focus();  
                        alertMsg();

                      }
                      else if(image_size6>200000)
                      {
                        $(".alert-msg").show(); 
                        $("#class_roome").text('<-Indoor Class Room size under 200kb allowed.');
                        $("#image6").focus();  
                        alertMsg();
                      }

                       else if(image_name7=='')
                      {
                           $(".alert-msg").show(); 
                        $("#local_noce").text('<-Please upload local NOC.');
                        $("#image7").focus();  
                        alertMsg();

                      }
                      else if(image_size7>200000)
                      {
                        $(".alert-msg").show(); 
                        $("#local_noce").text('<-Local NOC size under 200kb allowed.');
                        $("#image7").focus();  
                        alertMsg();
                      }

                       else if(image_name8=='')
                      {
                           $(".alert-msg").show(); 
                        $("#othere").text('<-Please upload Trust , Society, MSME, Electricity bill, Other Documents Any One.');
                        $("#image7").focus();  
                        alertMsg();

                      }
                      else if(image_size8>200000)
                      {
                        $(".alert-msg").show(); 
                        $("#othere").text('<-Trust , Society, MSME, Electricity bill, Other Documents Any One. size under 200kb allowed.');
                        $("#image8").focus();  
                        alertMsg();
                      }



                      else
                      {
    $.ajax({
      url:"app/freg_actionsesv7766.php",
      type:"post",
      data:new FormData(this),
      processData: false,
      contentType: false,
      success:function(data){
        //alert(data);
        var obj = JSON.parse(data);
$('#message').html(obj.errors);
  var status=obj.status ; 
  if(status=='ok')
  {
     $("#user_form").trigger("reset");
    $('#user_form')[0].reset();
    window.location = 'thank_you.php';
  }

                  
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

