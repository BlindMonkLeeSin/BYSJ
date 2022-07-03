function showCurtain(){
	$(".curtain").height($(window).innerHeight());
	
	$("#loginBt").click(function(){
		$(".curtain").show();
	    $(".curtain-content-list li").siblings().removeClass("active").first().addClass("active");
	    $(".login").show();
	});
	$("#registerBt").click(function(){
		$(".curtain").show();
		$(".curtain-content-list li").siblings().removeClass("active").last().addClass("active");
		$(".register").show();
	});	
	$(".curtain .closeIcon").click(function(){
		$(".curtain").hide();
		$(".login").hide();
		$(".register").hide();
	});
	$(".curtain-content-list li").click(function(){
		$(this).siblings().removeClass("active");
		$(this).addClass("active");
	});
	$(".curtain-content-list li").first().click(function(){
		$(".login").show();
		$(".register").hide();
	});
	$(".curtain-content-list li").last().click(function(){
		$(".login").hide();
		$(".register").show();
	});
}
function login(){
	$(".login-button").click(function(){
		var userName = $(".login-text").val();
		var userPwd = $(".login-pwd").val();
		if(userName.length != 0 && userPwd.length != 0  ){
			$.get('login.php',{
			    userName : userName,
			    userPwd : userPwd,
			    type : "login"
		   },function(data){
			    alert(data);
			    if(data == "登录成功\r\n"){
			        $(".curtain").hide();
			        $(".login").hide();
			    }

		    });
		}else{
			alert("用户名和密码不能为空");
		}
	ifLogin();
	});

}
function register(){
	var flag = 0;
	$(".register-text").blur(function(){
		var userName = $(this).val()
		var prompt = $(".register-text-prompt");
		var patt = /^1[0-9]{10}$/;
		if( patt.test(userName) ){
	        flag = 1;
	        prompt.hide();
	        $.get('login.php',{
	        	userName : userName,
	        	type :  "check"
	        },function(data){
	        	prompt.text(data).show();
	        });
		}else{
			prompt.text("请输入正确的手机号码").show();
			flag = 0;
		}	
	});
	$(".register-pwd").blur(function(){
		var userPwd = $(this).val()
		var prompt = $(".register-pwd-prompt");
		var patt =  /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{8,12}$/;
		if( patt.test(userPwd) ){
	        flag = 1;
	        prompt.hide();
		}else{
			prompt.text("密码应介于8~12位,且字符数字混合").show();
			flag = 0;
		}
	});
	$(".register-button").click(function(){
		var userName = $(".register-text").val();
		var userPwd = $(".register-pwd").val();
		if(flag && userName && userPwd){
			 $.get('login.php',{
			 	userName : userName,
			 	userPwd : userPwd,
			 	type : "register"
			},function(data){
	        	alert(data);
			    if(data == "注册成功\r\n"){
			        $(".curtain").hide();
			        $(".register").hide();
			    }
	        });
		}
		ifLogin();
	});
}
function cancel(){
	$(".cancel").click(function(){
		$.get('login.php',{type : "cancel"},function(data){
			alert(data);
		});
    ifLogin();
	});
}
