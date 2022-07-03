$(document).ready(function(){
	liEach();
});
function liEach(){
	$(".main-left li").click(function(){
		$(this).addClass("active").siblings().removeClass("active");
	});
	//历史
	$(".main-left li").eq(1).click(function(){
		$(".mainTitle").text("历史信息");
		
		var parrentNode = $(".main-right ul");
		parrentNode.width(610);
		parrentNode.children().remove();
		  var tableHead = $("<li>").addClass("tc tableHead");
		    var title1 = $("<span>").addClass("dib w300").text("时间");
		    var title2 = $("<span>").addClass("dib w150").text("身份");
		    var title3 = $("<span>").addClass("dib w150").text("结果");
		  tableHead.append(title1);
		  tableHead.append(title2);
		  tableHead.append(title3);
		parrentNode.append(tableHead);
		$.getJSON("admin.php",{
			type : "getHistory"
		},function(data){
			for(var i=0; i<data.length; i++){
				var tableTbody = $("<li>").addClass("tc tableTbody");
				  var time = $("<span>").addClass("dib w300").text(data[i].time);
				  var name = $("<span>").addClass("dib w150").text(data[i].name);
				  var content = $("<span>").addClass("money dib w150").text(data[i].content);
				tableTbody.append(time);
				tableTbody.append(name);
				tableTbody.append(content);
              parrentNode.append(tableTbody);
			}
		});
	});
	//用户板块
	$(".main-left li").eq(2).click(function(){
		$(".mainTitle").text("用户信息");
		
		var parrentNode = $(".main-right ul");
		parrentNode.width(660);
		parrentNode.children().remove();
		  var tableHead = $("<li>").addClass("tc tableHead");
		    var title1 = $("<span>").addClass("dib w150").text("用户名");
		    var title2 = $("<span>").addClass("dib w150").text("密码");
		    var title3 = $("<span>").addClass("dib w150").text("余额");
		    var title4 = $("<span>").addClass("dib w200").text("操作");
		  tableHead.append(title1);
		  tableHead.append(title2);
		  tableHead.append(title3);
		  tableHead.append(title4);
		parrentNode.append(tableHead);
		$.getJSON("admin.php",{
			type : "getUserInfo"
		},function(data){
			for(var i=0; i<data.length; i++){
				var tableTbody = $("<li>").addClass("tc tableTbody");
				  var userName = $("<span>").addClass("dib w150").text(data[i].user_name);
				  var userPwd = $("<span>").addClass("dib w150").text(data[i].user_pwd);
				  var userMoney = $("<span>").addClass("money dib w150").text("￥"+data[i].user_money);
				  var sys = $("<span>").addClass("dib w200");
				    var addMoney = $("<input>").addClass("addMoney w100 h20 bb pl5 mr5").attr(
				    	           {
				    	              "type":"text",
                                      "placeholder":"请输入充值金额"
				    	            });
				    var addBt = $("<button>").addClass("add w40 h20 bb nb mr5").text("充值").attr({
				    	                                                                        "userName" : data[i].user_name,
				    	                                                                        "userMoney" : data[i].user_money
				                                                                                });
				    var delBt = $("<button>").addClass("delUser w40 h20 bb nb").text("删除").attr("userName", data[i].user_name);
				  sys.append(addMoney);
				  sys.append(addBt);
				  sys.append(delBt);
				tableTbody.append(userName);
				tableTbody.append(userPwd);
				tableTbody.append(userMoney);
				tableTbody.append(sys);
              parrentNode.append(tableTbody);
			}
            delUser();
            addr();
		});
	});
	//商家板块
	$(".main-left li").eq(3).click(function(){
		$(".mainTitle").text("商家信息");
		var parrentNode = $(".main-right ul");
		parrentNode.width(910);
		parrentNode.children().remove();
		  var tableHead = $("<li>").addClass("tc tableHead");
		    var title1 = $("<span>").addClass("dib w150").text("商家名");
		    var title2 = $("<span>").addClass("dib w150").text("店铺名");
		    var title3 = $("<span>").addClass("dib w150").text("类别");
		    var title4 = $("<span>").addClass("dib w200").text("地址");
		    var title5 = $("<span>").addClass("dib w150").text("余额");
		    var title6 = $("<span>").addClass("dib w100").text("操作");
		  tableHead.append(title1);
		  tableHead.append(title2);
		  tableHead.append(title3);
		  tableHead.append(title4);
		  tableHead.append(title5);
		  tableHead.append(title6);
		parrentNode.append(tableHead);
		$.getJSON("admin.php",{
			type : "getShopInfo"
		},function(data){
			for(var i=0; i<data.length; i++){
				var tableTbody = $("<li>").addClass("tc tableTbody");
				  var shopName = $("<span>").addClass("dib w150 vm").text(data[i].shop_name);
				  var storeName = $("<span>").addClass("dib w150 vm").text(data[i].store_name);
				  var shopClass = $("<span>").addClass("dib w150 vm").text(data[i].shop_class);
				  var shopAddr = $("<span>").addClass("dib w200 ss vm").text(data[i].shop_addr);
				  var shopMoney = $("<span>").addClass("dib w150 vm").text("￥"+data[i].shop_money);
				  var sys = $("<span>").addClass("dib w100");
				    var delBt = $("<button>").addClass("delShop w40 h20 bb nb").text("删除").attr("shopName",data[i].shop_name);
				  sys.append(delBt);
				tableTbody.append(shopName);
				tableTbody.append(storeName);
				tableTbody.append(shopClass);
				tableTbody.append(shopAddr);
				tableTbody.append(shopMoney);
				tableTbody.append(sys);
              parrentNode.append(tableTbody);
			}
			delShop();
		});
	});
}
function addr(){
	$(".add").unbind().click(function(){
		var btNode = $(this);
		userName = btNode.attr("userName");
		userMoney = btNode.attr("userMoney");
		addMoney = btNode.prev().val();
		sumMoney = Number(userMoney)+Number(addMoney);
		console.log(sumMoney);
		$.post("admin.php",{
			type : "addr",
			userName : userName,
			addMoney : addMoney,
			sumMoney : sumMoney
		},function(data){
			btNode.attr("userMoney",sumMoney);
			btNode.parents(".tableTbody").find(".money").text("￥"+sumMoney);
		});
	});
}
function delUser(){
	$(".delUser").unbind().click(function(){
		var btNode = $(this);
		userName = btNode.attr("userName");
		$.post("admin.php",{
			type : "delUser",
			userName : userName
		},function(data){
			btNode.parents(".tableTbody").remove();
		});
	});
}
function delShop(){
	$(".delShop").unbind().click(function(){
		var btNode = $(this);
		shopName = btNode.attr("shopName");
		$.post("admin.php",{
			type : "delShop",
			shopName : shopName
		},function(data){
			btNode.parents(".tableTbody").remove();
		});
	});
}

//<li class="tc tableHead">
//              		<span class="dib w150">用户名</span>
//              		<span class="dib w150">密码</span>
//              		<span class="dib w150">头像地址</span>
//              		<span class="dib w150">余额</span>
//              		<span class="dib w200">操作</span>
//              	</li>
//              	<li class="tc tableTbody">
//              		<span class="dib w150">phone</span>
//              		<span class="dib w150">qq602923957</span>
//              		<span class="dib w150">
//              			123214214.jpg
//              		</span>
//              		<span class="dib w150">&yen;100.00</span>
//              		<span class="dib w200">
//              			<input class="money w100 h20 bb pl5" type="text" placeholder="请输入充值金额">
//              			<button class="add w40 h20 bb nb">充值</button>
//              			<button class="del w40 h20 bb nb">删除</button>
//              		</span>
//              	</li>