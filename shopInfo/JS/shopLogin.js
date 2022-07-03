$(document).ready(function(){
		shopLogin();

});

function shopLogin(){
	var flag;
	$(".inputs-text").val("");
	
	$(".inputs-text").blur(function(){
		var patt = /^1[0-9]{10}$/;
		var userName =  $(this).val();
		if(patt.test(userName)){
			$(".shopLogin-content-prompt").addClass("none");
			flag = 1;
		}else{
			$(".shopLogin-content-prompt").removeClass("none");
			flag = 0;
		}
	});
	
	$(".inputs-codeBt").click(function(){
      if(flag){
      	 var userName = $(".inputs-text").val();
		 var codeBt = $(this);
		 codeBt.attr("disabled","disabled");
		 var codeBtText = codeBt.text();		 		
		 var code = Math.floor(Math.random()*(999999-100000)+100000);
		 console.log("用户名："+userName+"的验证码是："+code);
		 var i = 30;
		 
		$.get('../login.php',{
			userName : userName,
			code : code,
			type : "insertCode"
		},function(data){
		 	
		});
		 
		 var timeId = setInterval(function(){
		 	if(i>0){
		 		i--;
		 		codeBt.text(i+"s");

		 	}else{
		 		clearInterval(timeId);
		 		codeBt.text(codeBtText);
		 		codeBt.removeAttr("disabled");
		 	}
		 }
		 ,950);
      }
	});
	
	$(".shopLogin-content-submit").click(function(){
		var userName = $(".inputs-text").val();
	    var code = $(".shopLogin-content-code").val();
		if(flag && code){
           $.get("../login.php",{
           	   userName : userName,
           	   code : code,
           	   type: "shop_status"
           },function(data){
           	   console.log(data);
        	   if(data == "login\r\n"){
        	   	    window.location.href = "shopInfo.php";
        	   }
        	   if(data == 'register\r\n'){
        	   	    alert(data);
        	   	    window.location.href = "shopInt.html";
        	   }
           });
        }
	});
}
