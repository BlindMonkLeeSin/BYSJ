$(document).ready(function(){
	//判断登录
	ifLogin();
	//登录相关
	showCurtain();
    login();
    register();
    cancel();

    //购物车相关
    var Json = showJson();
    num(Json);
    
    empty(Json);
    cartShow();
    submit();
    
    seach();
    
    $(".strip-addr1-info").text(sessionStorage.area);
    $(".strip-addr2-item1-info").text(sessionStorage.city);
});
function seach(){
	$(".seachIcon").click(function(){
		var text = $(".strip-search-text").val();
		lng = sessionStorage.lng;
		lat = sessionStorage.lat;
		window.location.href="seach.php?lng="+lng+"&lat="+lat+"&text="+text;
	});
}


