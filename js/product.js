$(document).ready(function(){
	//判断登录
	ifLogin();
	//登录相关
	showCurtain();
    login();
    register();
    cancel();
    //列表显示控制
    listControl();
    
    showShop("全部商家");
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
function listControl(){
	//背景控制
	$(".main-classify-contennt li").not("#whole").click(function(){
		$(this).addClass("active").siblings().removeClass("active");
		$("#whole").find("a").removeClass("active");
	});
	$("#whole").click(function(){
		$(this).find("a").addClass("active").parent().siblings().removeClass("active");
	});
	//显示控制
	$(".main-classify-contennt li").click(function(){
        var textNode = $(this).children().text();
        showShop(textNode);
	});
}
function showShop(textNode){
	$(".productList-content").remove();
	$.getJSON("showShop.php",{
		type : textNode,
		lng : sessionStorage.lng,
		lat : sessionStorage.lat
	}
	,function(data){
		for(var i=0; i<data.length; i++){
		          
			      var logo = $("<img>").attr("src","image/shop/"+data[i].logo);
			      var logoTitle = $("<figcaption>").addClass("tc f12 fca pt10 pb10").text(data[i].sdsj+"分钟");
			      var logoBox = $("<figure>").addClass("fl");
			      logoBox.append(logo);
			      logoBox.append(logoTitle);
			      
			      var store_name1 =$("<h1>").addClass("ml20 mb10 f20 fb").text(data[i].store_name);
			      var tjzs = $("<meter>").attr({
			      	"min" : 0,
			      	"low" : 0.6,
			      	"hight" : 0.9,
			      	"max" : 1,
			      	"optimum" : 100,
			      	"value" : data[i].tjzs
			      }).addClass("ml20 mb10 w70 h10");
			      var psf = $("<h2>").addClass("ml20 f14 fca").text("配送费"+data[i].psf+'￥');
			      var synopsis = $("<div>").addClass("productList-content-synopsis fl");
			      synopsis.append(store_name1);
			      tjzs.appendTo(synopsis);
			      synopsis.append(psf);
			      
			    var ABQ = $("<a>").addClass("clearfix w300 p20 bb db").attr("href","shop.php?shopname="+data[i].shop_name);
			    ABQ.append(logoBox);
			    ABQ.append(synopsis);
			      
			      var detailsName = $("<h1>").addClass("f20 fb").text(data[i].store_name);
			      var shopClass = $("<h2>").addClass("f14 fca pt10 pb10").text(data[i].shop_class);
			         var dispatchingMoney = $("<span>").addClass("productList-content-details-dispatching-money pr20").text(data[i].psf+"￥");
			         var dispatchingTime = $("<span>").addClass("productList-content-details-dispatching-time pr20").text("平均"+data[i].sdsj+"分送达");
			      var dispatching =$("<p>").addClass("productList-content-details-dispatching mt20 mb20 pt10 pb10 pl20 f14 fc2");
			      dispatching.append(dispatchingMoney);
			      dispatching.append(dispatchingTime);
			      var notice = $("<p>").addClass("productList-content-details-notice fc3 f14").text(data[i].notice);
			      var bugle = $("<div>").addClass("productList-content-details-bugle pa db");
			    var details = $("<div>").addClass("productList-content-details w300 pl10 pr10 pt20 bb pa none");
			    details.append(detailsName);
			    details.append(shopClass);
			    details.append(dispatching);
			    details.append(notice);
			    details.append(bugle);
			      
			  var parrent = $("<div>").addClass("productList-content fl pr");
			      
			  parrent.append(ABQ);
			  parrent.append(details);
			var parrents = $(".main-productList");
			parrents.append(parrent);
//			       <div class='productList-content fl pr'>
//				 	<a class="clearfix w300 p20 bb db" href="shop.html">
//                    <figure class="fl">
//                    	<img src="image/shop/<?php echo $row['logo'];?>">
//                    	<figcaption class="tc f12 fca pt10 pb10"><?php echo $row['sdsj'];?></figcaption>
//                    </figure>
//                    <div class="productList-content-synopsis fl">
//                    	 <h1 class="ml20 mb10 f20 fb"><?php echo $row['store_name'];?></h1>
//                    	 <meter class="ml20 mb10 w70 h10" min="0" low="0.1" high="0.9" max="1" value="<?php echo $row['tjzs'];?>" optimum="1"></meter>
//                    	 <h2 class="ml20 f14 fca">配送费<?php echo $row['psf'];?>&yen;</h2>
//                    </div>
//                  </a>
//                    <div class="productList-content-details w300 pl10 pr10 pt20 bb pa none">
//                    	 <h1 class="f20 fb"><?php echo $row['store_name'];?></h1>
//                    	 <h2 class="f14 fca pt10 pb10"><?php echo $row['shop_class'];?></h2>
//                    	 <p class="productList-content-details-dispatching mt20 mb20 pt10 pb10 pl20 f14 fc2">
//                    	 	<span class="productList-content-details-dispatching-money pr20">
//                    	 		<?php if($row['psf']==0){echo "免配送费";}else{ echo $row['psf']."&yen;";}?>
//                    	 	</span>
//                    	 	<span class="productList-content-details-dispatching-time">
//                    	 		平均<mark><?php echo $row['sdsj'];?></mark>分送达
//                    	 	</span>
//                    	 </p>
//                    	 <p class="productList-content-details-notice fc3 f14">
//                    	 	<?php echo $row['notice'];?>
//                    	 </p>
//                    	 <div class="productList-content-details-bugle pa db"></div>
//                    </div>
		}
	})
}
function seach(){
	$(".seachIcon").click(function(){
		var text = $(".strip-search-text").val();
		lng = sessionStorage.lng;
		lat = sessionStorage.lat;
		window.location.href="seach.php?lng="+lng+"&lat="+lat+"&text="+text;
	});
}


