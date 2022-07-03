/*让登录页面显示*/
$(".login-sc ul li").each(function(index){
    $(this).click(function(){
    	if(index<2){
    		var screenWidth = $(window).innerHeight()+$(window).scrollTop();
    		$(".bg").css("height",screenWidth);
	        $(".bg").toggle();
	        $(".hideContent ul li").eq(index).addClass("active");
	        $(".hideContent div").eq(index+1).toggle();
        }
    });
});
/*关闭按钮*/
$("span.close").click(function(){
	$(".bg").toggle();
	$(".hideContent ul").nextAll().hide();
    $(".hideContent ul li").removeClass("active");
});
/*tab切换*/
var timeId;
 $(".hideContent ul li").hover(function(){
 	var liNode = $(this)
 	timeId = setTimeout(function(){
 	   liNode.siblings().removeClass("active");
 	   liNode.addClass("active");
 	   $(".hideContent ul").nextAll().toggle();
 	},500);
 },function(){
 	clearTimeout(timeId);
 });
 /*忘记密码*/
$(".login span").click(function(){
	$(".login input[type^='password']").hide();
	$(".login .code-content").show();
	$(".login .code-button").show();
	$(this).hide();
});
/*验证码*/
$(".register .code-button,.login .code-button").click(function(){
	var i = 60;
	var Node = $(this);
	var nodeText = Node.text();
	var timeId = setInterval(function(){
		if( i >= 0){
		   	Node.text(i+"秒后重置");
		   	
		}else{
		    clearInterval(timeId);
		    Node.text(nodeText);
		    Node.removeAttr("disabled");
	    }
		i--;
	},1000);
	if( i = 59 ){
		var code = getCode();
		console.log("验证码是"+code);
		Node.attr("disabled","false");
	}
});
function getCode(){
	var code = Math.floor(Math.random()*(9999-1000)+1000);
	return code;
}

	

 

