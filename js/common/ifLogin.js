function ifLogin(){
	$.get('login.php',{type : "ifLogin"},function(data){
	    var arr = data.split(",");
//		console.log(arr);
		 if(arr[1] == "user\r\n" || arr[1] == "shop\r\n" ){
		 	$("#loginBt,#registerBt").hide();
		 	console.log(arr[1]);
		 	if(arr[1] == "user\r\n"){
		 		$("#userName").removeClass("none").children("a").text(arr[0]);
		 		$("#orderAddr").attr("href","userInfo/myOrder.php");
		 	}
		 	if(arr[1] == "shop\r\n"){
		 		$("#openShop").addClass("none");
		 		$("#shopName").removeClass("none").children("a").text(arr[0]);
		 		$("#orderAddr").attr("href","shopInfo/shopNewOrder.php");
		 	}
		 }else{
	 	    $("#loginBt,#registerBt").show();
	 	    $("#userName").addClass("none");
	 	    $("#shopName").addClass("none");
	 	    $("#openShop").removeClass("none");
		 }
		 
	});
}
