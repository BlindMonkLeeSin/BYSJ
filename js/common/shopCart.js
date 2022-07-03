function showJson(){
  if(sessionStorage.data!= null){
	var Json = JSON.parse(sessionStorage.data);
//		console.log(Json.num);
	var parrentNode = $(".shoppingCart-main-list");
	parrentNode.children().remove();
	for(var i=0; i<Json.product.length; i++){
			var liNode = $("<li>").addClass("clearfix");
		    var title = $("<span>").addClass("list-productTitle fl fc6").text(Json.product[i].name);
		    var numCtl = $("<div>").addClass("list-productNumber w70 f0 fl nb");
		        var addNum = $("<button>").addClass("delNum h20 w20 tc f14 bb nb vm").text("-");
		        var num = $("<input>").addClass("w30 h20 f14 tc bb nb vm").val(Json.product[i].num);
		        var delNum = $("<button>").addClass("addNum h20 w20 tc f14 bb nb vm").text("+");
		    numCtl.append(addNum);
		    numCtl.append(num);
		    numCtl.append(delNum);
		    var money = $("<span>").addClass("list-productMoney fr tr").text("￥"+Json.product[i].money);
		liNode.append(title);
		liNode.append(numCtl);
		liNode.append(money);
    parrentNode.append(liNode);	
	}
  $(".dispatchingMoney").text("配送费"+Json.psf+"￥");
	count(Json);
	return Json
  }
}
//加减
function num(Json){
    var parrentNode = $(".shoppingCart-main-list");
    parrentNode.children().each(function(index){
    	var index = index;
    	$(this).find(".addNum").click(function(){
    		Json.product[index].num+=1;
    		$(this).prev()[0].value=Number($(this).prev()[0].value)+1;
//  		console.log(Json);
    		count(Json);
    	});
    	
    	$(this).find(".delNum").click(function(){
    		Json.product[index].num-=1;
    		$(this).next()[0].value=Number($(this).next()[0].value)-1;
    		if($(this).next().val() == 0){
    			$(this).parents("li").remove();
//  			var length = JSON.stringify(Json.product[index]).length;
    			Json.product.splice(index,1);
    			console.log(Json.product);
    		}
    		count(Json);
    	});
    }); 
}
//算钱
function count(Json){
	Json.num = 0;
	var countNum = 0;
	for(var i=0; i<Json.product.length; i++){
		Json.num += Json.product[i].money*Json.product[i].num;
		countNum += Json.product[i].num;
	}
	$(".sumMoney").text("￥"+Json.num);
	if(Json.num<Json.qbj){
		var ce = Json.qbj-Json.num;
//		console.log(ce);
		$(".shoppingCart-control-right").removeClass("active").text("还差"+ce+"￥钱起送").attr("disabled",true);
	}else{
		$(".shoppingCart-control-right").addClass("active").text("结算").removeAttr("disabled");
	}
	if(Json.product.length>0){
		
		$(".redNumber").removeClass("none").text(countNum);
	}else{
		$(".redNumber").addClass("none");
	}
	sessionStorage.data = JSON.stringify(Json);
	
}
//清空
function empty(Json){
	$(".header-empty").click(function(){
		Json.num = 0;
        Json.product = [];
        showJson(Json);
//      addItem(Json);
        sessionStorage.data = JSON.stringify(Json);
        count(Json);
	});
}
//显示控制
function cartShow(){
	$(".shoppingCart-control-left").click(function(){
		$(".shoppingCart-main").slideToggle();
	})
}
function submit(){
	$(".shoppingCart-control-right").click(function(){
		window.location.href = "okOrder.php";
	});
}