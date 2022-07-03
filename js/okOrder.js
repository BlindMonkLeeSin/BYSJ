$(document).ready(function(){
	cancel();
	
	var Json = showJson();
	btCtl(Json);
	getBalnce(Json);
	setWidth();
});
//注销
function cancel(){
	$(".cancel").click(function(){
		$.get('login.php',{type : "cancel"},function(data){
			window.location.href = "index1.html";
		});
	});
}
function showJson(){
	if(sessionStorage.data != null){
		var Json = JSON.parse(sessionStorage.data);
	}
	$("#eidt").attr("href","shop.php?shopname="+Json.shopName);
	var countNum = 0;
	for(var i=0; i<Json.product.length; i++){
		var title = $(".titleList");
		var item = $("<ul>").addClass("orderDetailsItem clearfix  pl30 pr30 fc6");
		    var name = $("<li>").text(Json.product[i].name);
		    var num = $("<li>").text(Json.product[i].num);
		    var money = $("<li>").text("￥"+Json.product[i].money);
		item.append(name);
		item.append(num);
		item.append(money);
		title.after(item);
//		console.log(title);
        countNum += Json.product[i].num ;
	}
	$(".dbFee li").eq(2).text("￥"+Json.psf);
	var countMoney = Number(Json.psf)+Number(Json.num);
	$(".num").text("￥"+countMoney);
	$(".payment i").text("￥"+countMoney);
	$(".countNum").text(countNum);
	
	$(".payment i").text("￥"+countMoney);/*弹窗金额*/
	return Json;
}
//获得余额;
function getBalnce(Json){
	$.post("userInfo/user.php",{
		type : "balance"
	},function(data){
		$(".balance i").text("￥"+data);
		ifOk();
	});
	//判断按钮能否点击
	function ifOk(){
		//用正则提取数字
		var payment =$(".payment i").text().replace(/[^0-9]/ig,"");
		payment = Number(payment);
		var balance = $(".balance i").text().replace(/[^0-9]/ig,"");
		ca = Number(balance-payment); 
		if( payment > balance){
			$(".prompt .ok").attr("disabled","disabled");
			alert("余额不足");
		}else{
			$(".prompt .ok").removeAttr("disabled");
		}
		$(".prompt .ok").unbind().click(function(){
			var text = $("#remarks").val();
		    Json.remarks = text;
		    Json.balance = ca;
		    //生成订单
            $.post("orderInfo.php",{
        	    data : JSON.stringify(Json)
            },function(data){
        	    sessionStorage.removeItem('data');
        	    alert('订单生成成功');
        	    window.location.href="product.html";
            });
		});
	}
}
function btCtl(Json){
	$(".userInfo-addrBlock").hide();
	$(".userInfo-addrBlock").eq(0).addClass("active").show();
	Json.addrId = $(".userInfo-addrBlock").eq(0).attr("data-Id");
	$(".more").click(function(){
		$(this).hide();
		$(".stop").show();
		$(".userInfo-addrBlock").show();
	});
	$(".stop").click(function(){
		$(this).hide();
		$(".more").show();
		$(".userInfo-addrBlock").hide();
        $(".userInfo-addrBlock").each(function(index){
        	if($(this)[0].classList.contains("active")){
        		$(this).show();
        	}
        });
	});
	
	console.log(Json);
	$(".userInfo-addrBlock").click(function(){
		$(this).addClass("active").siblings().removeClass("active");
		Json.addrId = $(this).attr("data-Id");
	});

	$(".okOrder").click(function(){
		$(".curtain").show();
		//获得用户余额		
	});
	$(".prompt .close").click(function(){
		$(".curtain").hide();
	});
}
function setWidth(){
	$(".curtain").height($(document).height());
}
//              <div class="orderDetails-content f12">
//					<ul class="titleList clearfix fc9">
//						<li class="pl30">商品</li>
//						<li>份数</li>
//						<li class="pr30">小计(元)</li>
//					</ul>
//					<ul class="orderDetailsItem clearfix  pl30 pr30 fc6">
//						<li>BBQ鸡肉披萨-10寸</li>
//						<li class="tc">
//                          10
//						</li>
//						<li>&yen;59.00</li>
//					</ul>
//					<ul class="dbFee clearfix  pl30 pr30 fc6">
//						<li>配送费</li>
//						<li>&nbsp;</li>
//						<li>&yen;5.00</li>
//					</ul>
//					<p class="pl30 pr30 tr">
//						<span class="num">&yen;140.00</span>
//					</p>
//					<p class="pl30 pr30 tr">
//						共<span class="pl5 pr5">2</span>份商品
//					</p>
//				</div>
