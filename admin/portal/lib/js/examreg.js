//edit for update
$("#payment").hide();
$(document).on('change', '#exam_fee', function(){
  var duration = $('#exam_fee').val(); 
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
        var session = $("#session").val().trim(); 
         var institute_code = $("#institute_code").val().trim(); 
                 var exam_fee = $("#exam_fee").val().trim();
                     var txnid = $("#txnid").val().trim();
               var form_data = new FormData(document.querySelector('#user_form'));
                   if(session.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#sessione").text('Please select Annual Session.');
                        $("#session").focus();  
                        alertMsg();
                      }
                   
                                  else if(institute_code.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#institute_codee").text('Please enter Institute Code.');
                        $("#institute_code").focus();  
                        alertMsg();
                      }

                      else if(exam_fee.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#exam_feee").text('Please select Exam Fee.');
                        $("#exam_fee").focus();  
                        alertMsg();
                      }
                      else if(txnid.length<2)
                      { 
                        $(".alert-msg").show(); 
                        $("#txnide").text('Please enter payment ID.');
                        $("#txnid").focus();  
                        alertMsg();
                      }

                      else
                      {
                        var formData = new FormData(this);

                        fetch("app/exam_actionsesv47665255352565.php", {
                          method: "POST",
                          body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                          console.log(data);
                          document.getElementById("message").innerHTML = data.error;
                          if (data.error.trim()!='') {
                            alert(data.error)
                          }else{
                            document.getElementById("user_form").reset();
                            window.location = "exam-receipt.php";
                          }
                        })
                        .catch(error => console.error("Error:", error));
                        
  }
   })

 function alertMsg(){
            setTimeout(function() {
    $('.alert-msg').fadeOut('fast');
     $(".alert-msg").text(''); 

}, 8000); 
          }


