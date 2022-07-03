$(document).ready(function(){
	//登陆相关
	ifLogin();
	showCurtain();
    login();
    register();
    cancel();
    //排序
	Nav();
	rank();
	ct();
	//购物车
	var Json = initJson();
	addItem(Json);
    empty(Json);
    submit();
    cartShow();
    
    //搜索
    seach();
    
	$(".strip-addr1-info").text(sessionStorage.area);
	$(".strip-addr2-item1-info").text(sessionStorage.city);
});
function Nav(){
	var navHeight = $(".main-classify").outerHeight(true);
	var offsetTop = $(".main-classify")[0].offsetTop;
    $(".main-classify ul li").each(function(index){
    	$(".main-classify ul li").eq(index).click(function(){
      		$(this).children("a").addClass("active");
		    $(this).siblings().children("a").removeClass("active");
		    var productScrollTop = $(".main-productList ul").eq(index).offset().top;
		    var scroll = productScrollTop-navHeight;
		    $(window).scrollTop(scroll);
    	});
    });

	$(window).scroll(function(){
		var scrollTop = $(window).scrollTop();
		var numHeight = scrollTop-offsetTop-navHeight;
		if(offsetTop+navHeight <= scrollTop){
			$(".main-classify").css({
				"position" : "fixed",
				"top" : 0,
				"left" : "58px"
		    })
//			console.log(offsetTop+"："+scrollTop);
			$(".fill").height(navHeight);
		}else{
			$(".main-classify").css({
				"position" : "",
				"top" : "",
				"left" : ""
		  });
		   $(".fill").height(0);
		}
	});
}
function rank(){
	$("#vertival").click(function(){
		$(".main-productList").removeClass("main-productListHorizontal");
		$(this).addClass("active");
		$(this).next().removeClass("active");
	});
	$("#transverse").click(function(){
		$(".main-productList").addClass("main-productListHorizontal");
		$(this).addClass("active");
		$(this).prev().removeClass("active");
	})
}
function ct(){
	$("#ct").click(function(){
		var shopName = $("#hideShopName").text();
		if($("#ctText").text()=="收藏"){
			$.post("userInfo/ct.php",{
				type : "ct",
				shopName : shopName
			},
			function(data){
				$("#ctText").text("取消收藏");
				$("#ctText").prev().addClass("active");
				
			});
		}else{
			$.post("userInfo/ct.php",{
				type : "cancelCt",
				shopName : shopName
			},
			function(data){
				$("#ctText").text("收藏");
				$("#ctText").prev().removeClass("active");
			});
			
		}
	})
}
function initJson(){
	var shopName = $("#data").attr("data-shopName");
	var psf = $("#data").attr("data-psf");
	var qbj = $("#data").attr("data-qbj");
	if(sessionStorage.data!= null){
	   var data = JSON.parse(sessionStorage.data);
	}
    var Json = data || {"shopName" : "","psf" : "","qbj" : "","num" : 0,"product" : []};
    if(Json.shopName == shopName ){
    	showJson(Json);
    	num(Json);
    }else{
    	Json = {"shopName" : shopName,"psf" : psf,"qbj" : qbj,"num" : 0,"product" : []};
    }
    return Json;
}
//添加一条数据
function addItem(Json){
	
	$(".submit").click(function(){
		$(this).attr("disabled",true);
		$(this).css("backgroundColor","#ccc");
		var productId = $(this).attr("data-productId");
		var productName = $(this).attr("data-productName");
		var productMoney = $(this).attr("data-productMoney");
		var childJson = {"id" : productId,"name" : productName,"num" : 1,"money" : productMoney};
		Json.product.push(childJson);
		showJson(Json);
        num(Json);
        $(".shoppingCart-main").slideDown();
        
        sessionStorage.data = JSON.stringify(Json);
	});	
	

	
}
//显示数据
function showJson(Json){
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

	count(Json);
	

	
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
//提交
function submit(){
	$(".shoppingCart-control-right").click(function(){
		window.location.href = "okOrder.php";
	});
}
//搜索
function seach(){
	$(".seachIcon").click(function(){
		var text = $(".strip-search-text").val();
		lng = sessionStorage.lng;
		lat = sessionStorage.lat;
		window.location.href="seach.php?lng="+lng+"&lat="+lat+"&text="+text;
	});
	$("#seach").click(function(){
		var text = $("#seachText").val();
		lng = sessionStorage.lng;
		lat = sessionStorage.lat;
		window.location.href="seach.php?lng="+lng+"&lat="+lat+"&text="+text;
	});
}
//                  <ul class="shoppingCart-main-list">
//                  	<li class="clearfix">
//                  		<span class="list-productTitle fl fc6">店名</span>
//                  		<div class="list-productNumber w70 f0 fl nb">
//                  			<button class="number- h20 w20 tc f14 bb nb vm ">-</button>
//                  			<input class="w30 h20 f14 tc bb nb vm " type="text" value="0">
//                  			<button class="number+ h20 w20 tc f14 bb nb vm">+</button>
//                  		</div>
//                  		<span class="list-productMoney fr tr">&yen;10</span>
//                  	</li>
//                  	<li class="clearfix">
//                  		<span class="list-productTitle fl fc6">店名</span>
//                  		<div class="list-productNumber w70 f0 fl nb">
//                  			<button class="number- h20 w20 tc f14 bb nb vm ">-</button>
//                  			<input class="w30 h20 f14 tc bb nb vm " type="text" value="10">
//                  			<button class="number+ h20 w20 tc f14 bb nb vm">+</button>
//                  		</div>
//                  		<span class="list-productMoney fr tr">&yen;1000000</span>
//                  	</li>
//                  </ul>