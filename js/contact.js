    $(document).ready(function(){

	'use strict'; // use strict mode
	
     $("#send").click(function(){
        var name   = $("#name").val();
        var email  = $("#email").val();
        var phone  = $("#phone").val();
        var message  = $("#message").val();
        var is_human = $("#is_human").val();

        var error = false;

        if(name.length == 0 ){
          var error = true;
          $("#error_name").fadeIn(500);
        }else{
          $("#error_name").fadeOut(500);
        }

        if(phone.length < 10  ){
          var error = true;
          $("#error_phone").fadeIn(500);
        }else{
          $("#error_phone").fadeOut(500);
        }

         if(phone.length < 10 && (email.length == 0 || email.indexOf("@") == "-1" || email.indexOf(".") == "-1")){
           var error = true;
           $("#error_email").fadeIn(500);
         }else{
           $("#error_email").fadeOut(500);
         }
         if(message.length == 0){
            var error = true;
            $("#error_message").fadeIn(500);
         }else{
            $("#error_message").fadeOut(500);
         }
         
         if(error == false){
           $("#send").attr({"disabled" : "true", "value" : "Sending..." });
            
           $.ajax({
             type: "POST",
             url : "api/send",    
             data: "is_human="+is_human+"&name=" + name +"&phone=" + phone +  "&email=" + email + "&message=" + message,
           }).done(function(data){

            $("#mail_result").html(data.message).fadeIn(500);  
            if(data.success == true){
              $("#send").attr({"disabled" : "true", "value" : "Thank You!!" });
              $("#mail_result").removeClass("error").addClass("success");
            }else{           
              $("#send").removeAttr("disabled").attr("value", "send");
              $("#mail_result").removeClass("success").addClass("error");
            }   
           
           });  
        }
		    return false;                      
      });    
    });
