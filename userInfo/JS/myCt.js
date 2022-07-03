$(document).ready(function(){
	cancel();
    $(".strip-addr1-info").text(sessionStorage.area);
    $(".strip-addr2-item1-info").text(sessionStorage.city);
	keda();
    bukeda();
    seach();
});
function keda(){
	$.getJSON("ctDetails.php",{
		type : "keda",
		lng :　sessionStorage.lng,
		lat : sessionStorage.lat
	},function(data){
		var parrents = $(".accessible");
		    var h2 = $("<h2>").addClass("f18").html("当前区域共有<strong class='number pl5 pr5'>"+data.length+"</strong>家可配送商家");
		parrents.append(h2);        
		for(var i=0; i<data.length;i++){
			var parrent = $("<div>").addClass("ctItem w300 mr20 mb20 fl");
			    var ctItemtop = $("<div>").addClass("ctItem-top h90 pr");
			        var bgBox = $("<figure>").addClass("top-bg");
			            var ABQ = $("<a>").attr("href","../shop.php?shopname="+data[i].shop_name);
			                var bg = $("<img>").attr("src","../image/bg2.jpg");
			            ABQ.append(bg);
			        bgBox.append(ABQ);
			        var imgBox = $("<figure>").addClass("top-logo pa")
			            var img = $("<img>").attr("src","../image/shop/"+data[i].logo);
			        imgBox.append(img);
			    ctItemtop.append(bgBox);
			    ctItemtop.append(imgBox);
			    var ctItemMiddle = $("<div>").addClass("ctItem-middle tc");
			        var tjzs = $("<meter>").addClass("mt5 mb15 w70 h10 db bc").attr("value",data[i].tjzs);
			        var middleMoney = $("<span>").addClass("middle-money dib mb15");
			            var title1 = $("<p>").addClass("middle-money-title fc6 mb10 f12").text("起送价格");
			            var money = $("<p>").addClass("f18").text("￥"+data[i].qbj);
			        middleMoney.append(title1);
			        middleMoney.append(money);
			        var middleTime = $("<span>").addClass("middle-time dib f12 mb15");
			            var title2 = $("<p>").addClass("middle-time-title fc6 mb10").text("送餐时间");
			            var time = $("<p>").addClass("f18").text(data[i].sdsj+"分");	
			        middleTime.append(title2);
			        middleTime.append(time );
			    ctItemMiddle.append(tjzs);
			    ctItemMiddle.append(middleMoney);
			    ctItemMiddle.append(middleTime);
			    var ctItemBottom = $("<div>").addClass("ctItem-bottom p10");
			        var empty = $("<span>").addClass("dib emptyIcon fr").attr("data-id",data[i].id);
			    ctItemBottom.append(empty);
			parrent.append(ctItemtop);
			parrent.append(ctItemMiddle);
			parrent.append(ctItemBottom);
	    parrents.append(parrent);
	    deleteCt();
	   }
		
	});
}
function bukeda(){
	$.getJSON("ctDetails.php",{
		type : "bukeda",
		lng :　sessionStorage.lng,
		lat : sessionStorage.lat
	},function(data){
		var parrents = $(".unreachable");
		    var h2 = $("<h2>").addClass("f18").html("当前区域不可配送的商家");
		parrents.append(h2);        
		for(var i=0; i<data.length;i++){
			var parrent = $("<div>").addClass("ctItem w300 mr20 mb20 fl");
			    var ctItemtop = $("<div>").addClass("ctItem-top h90 pr");
			        var bgBox = $("<figure>").addClass("top-bg");
			            var ABQ = $("<a>").attr("href","../shop.php?shopname="+data[i].shop_name);
			                var bg = $("<img>").attr("src","../image/bg2.jpg");
			            ABQ.append(bg);
			        bgBox.append(ABQ);
			        var imgBox = $("<figure>").addClass("top-logo pa")
			            var img = $("<img>").attr("src","../image/shop/"+data[i].logo);
			        imgBox.append(img);
			    ctItemtop.append(bgBox);
			    ctItemtop.append(imgBox);
			    var ctItemMiddle = $("<div>").addClass("ctItem-middle tc");
			        var tjzs = $("<meter>").addClass("mt5 mb15 w70 h10 db bc").attr("value",data[i].tjzs);
			        var middleMoney = $("<span>").addClass("middle-money dib mb15");
			            var title1 = $("<p>").addClass("middle-money-title fc6 mb10 f12").text("起送价格");
			            var money = $("<p>").addClass("f18").text("￥"+data[i].qbj);
			        middleMoney.append(title1);
			        middleMoney.append(money);
			        var middleTime = $("<span>").addClass("middle-time dib f12 mb15");
			            var title2 = $("<p>").addClass("middle-time-title fc6 mb10").text("送餐时间");
			            var time = $("<p>").addClass("f18").text(data[i].sdsj+"分");	
			        middleTime.append(title2);
			        middleTime.append(time );
			    ctItemMiddle.append(tjzs);
			    ctItemMiddle.append(middleMoney);
			    ctItemMiddle.append(middleTime);
			    var ctItemBottom = $("<div>").addClass("ctItem-bottom p10");
			        var empty = $("<span>").addClass("dib emptyIcon fr").attr("data-id",data[i].id);

			    ctItemBottom.append(empty);
			parrent.append(ctItemtop);
			parrent.append(ctItemMiddle);
			parrent.append(ctItemBottom);
	    parrents.append(parrent);
	    deleteCt();
		}
	});
}
function deleteCt(){
	$(".emptyIcon").unbind().click(function(){
		var bt = $(this);
		ctId = bt.attr("data-id");
		$.post('ct.php',{
			type : "deleteCt",
			ctId : ctId
		},
		function(data){
			bt.parents(".ctItem").remove();
		});
	})
}
