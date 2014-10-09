$(document).ready(function() {
   $('form input').keyup(function(){
     var emailAddr = $("#RegisterForm_email").val();
     var passwd = $("#RegisterForm_password").val();
     var confirmpasswd = $("#RegisterForm_passwordRepeat").val();
    
     if(vaildEmailAddr(emailAddr) && passwd != "" &&  passwd==confirmpasswd){         
         $("#submitBtn").removeAttr("disabled");
     }else{
         $("#submitBtn").prop("disabled","disabled");    
     }     
   });   
   function vaildEmailAddr(a){
        if(!a) return false;
        b = a.indexOf("@"),
        c = a.lastIndexOf(".");
        if(1 > b || b + 2 > c || c + 2 >= a.length){
            return !1;
        }else{
            return !0;
        }        
    }
});
