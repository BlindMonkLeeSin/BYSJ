$(document).ready(function(){
	
	cancel();
	seach();
    $(".strip-addr1-info").text(sessionStorage.area);
    $(".strip-addr2-item1-info").text(sessionStorage.city);
    
    getDate();
	showBdmap();
	getJWD();
	
	addMm();
	close();
	Ajax();
	
	
});
function getDate(){
	$(".addrBlock").remove();
	$.getJSON("addr.php",{
		type : "domeData"
	},function(data){
		for(var i=0; i<data.length; i++){
			var parrentNode = $("<div>").addClass("addrBlock fl h100 bb mr10 mt15 p15 pt15 f14 pr");
			  var title = $("<div>").addClass("fl fc3 mb10");
			    var name = $("<span>").addClass("addrBlock-name").text(data[i].name);
			    var sex = $("<span>").addClass("addrBlock-sex ml15").text(data[i].sex);
			  title.append(name);
			  title.append(sex);
			  var buttons = $("<div>").addClass("addrBlock-buttons fr mb10");
			    var eidtButton = $("<button>").addClass("addrBlock-buttons-edit nb fc9 mr10").attr("type" , "button").text("修改");
			    var deleButton = $("<button>").addClass("addrBlock-buttons-delete nb fc9").attr("type" , "button").text("删除");
			  buttons.append(eidtButton);
			  buttons.append(deleButton);
			  var ctl = $("<div>").addClass("addrBlock-addrControl cb h20 mb5");
			    var addr = $("<span>").addClass("addrBlock-addr mr10 fc3").text(data[i].addr);
			    var addrDetails = $("<span>").addClass("addrBlock-addrDetails fc6").text(data[i].addrDetails);
			  ctl.append(addr);
			  ctl.append(addrDetails);
			  var tel = $("<p>").addClass("addrBlock-tel fc6 mt").text(data[i].tel);;
			  var hint = $("<div>").addClass("addrBlock-hint h100 tc pa f14 none");
			    var prompt = $("<p>").addClass("fcf").text("确认删除收获地址?");
			    var okButton = $("<button>").addClass("addrBlock-hint-OK mt5 mr10 w60 nb").attr("type" , "button").text("确认");
			    var closeButton = $("<button>").addClass("addrBlock-hint-close mt5 w60 nb").attr("type" , "button").text("取消");
			  hint.append(prompt);
			  hint.append(okButton);
			  hint.append(closeButton);
			  var addrId = $("<input>").addClass("addrBlock-id").attr("type" , "hidden").val(data[i].id);
			  var lng = $("<input>").addClass("addrBlock-lng").attr("type" , "hidden").val(data[i].lng);
			  var lat = $("<input>").addClass("addrBlock-lat").attr("type" , "hidden").val(data[i].lat);
			parrentNode.append(title);
			parrentNode.append(buttons);
			parrentNode.append(ctl);
			parrentNode.append(tel);
			parrentNode.append(hint);
			parrentNode.append(addrId);
			parrentNode.append(lng);
			parrentNode.append(lat);
	    $(".addAddr").before(parrentNode);
	    eidtMm();
	    delMm();
		}
	});
}

//修改地址
function eidtMm(){
	//删除地址弹窗显示
	$(".addrBlock-buttons-delete").unbind();
	$(".addrBlock-buttons-delete").click(function(){
		var parent = $(this).parents(".addrBlock");
		parent.children(".addrBlock-hint").show();
	})
	//删除地址弹窗关闭
	$(".addrBlock-hint-close").unbind();
	$(".addrBlock-hint-close").click(function(){
		$(this).parent().hide();
	})
	//编辑地址弹窗显示
	$(".addrBlock-buttons-edit").unbind();
	$(".addrBlock-buttons-edit").click(function(){
		$(".curtain").show();
		$(".addrDialog-title h1").text("编辑地址");
		var parent = $(this).parents(".addrBlock");
		//获得值
		var name = parent.find(".addrBlock-name").text();
		var sex = parent.find(".addrBlock-sex").text();
		var addr = parent.find(".addrBlock-addr").text();
		var addrDetails = parent.find(".addrBlock-addrDetails").text();
		var tel = parent.find(".addrBlock-tel").text();
		var addrId = parent.find(".addrBlock-id").val();
		var lng = parent.find(".addrBlock-lng").val();
		var lat = parent.find(".addrBlock-lat").val();
		
		//设置值
		$("#name").val(name);
		if($("#man").val() == sex){ $("#man").attr("checked",true); }else{$("#man").removeAttr("checked");}
		if($("#lady").val() == sex){ $("#lady").attr("checked",true); }else{$("#lady").removeAttr("checked");}
		$("#addr").val(addr);
		$("#addrDetails").val(addrDetails);
		$("#tel").val(tel);
		$("#addrId").val(addrId);
		$("#lng").val(lng);
		$("#lat").val(lat);
		
		//
		$(".addrDialog-content-buttons-save").text("保存");
		$(".addrDialog-content-buttons-save").attr("id","save");
		$("#save").show();
		$("#add").hide();
		
		$("#type").val("updateAddr");
		
	});
}
function delMm(){
	$(".addrBlock-hint-OK").unbind();
	$(".addrBlock-hint-OK").click(function(){
	  var parent = $(this).parents(".addrBlock");
	  var addrId = parent.find(".addrBlock-id").val();
	  $.post("addr.php",{
	  	type : "deleteAddr",
	  	addrId : addrId
	  },function(data){
	  	alert(data);
	  	getDate();//重新获取数据
	  });
	});
}
//删除、修改、添加地址
function Ajax(){
	$("#save,#add").click(function(){
		var form = $(this).parents("form");
        var formData = new FormData(form[0]);
        $.ajax({
            url: 'addr.php',  //server script to process data
            type: 'POST',
            xhr: function() {  // custom xhr
                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){ // check if upload property exists
//              myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // for handling the progress of the upload
                }
                return myXhr;
            },
        //Ajax事件
//          beforeSend: beforeSendHandler,
            success: function(data){
        	    alert(data);
        	    getDate();//重新获取数据
            },
//         error: errorHandler,
           // Form数据
            data: formData,
           //Options to tell JQuery not to process data or worry about content-type
            cache: false,
            contentType: false,
            processData: false
        });
	});
}
//添加地址
function addMm(){
	$(".addAddr").click(function(){
	    $(".curtain").show();
	    $(".addrDialog-title h1").text("添加地址");
	    //所有值置空
		$("#name").val("");
		$("#man").removeAttr("checked");
		$("#lady").removeAttr("checked");
		$("#addr").val("");
		$("#addrDetails").val("");
		$("#tel").val("");
		$("#addrId").val("");
		$("#lng").val("");
		$("#lat").val("");
		
		$("#save").hide();
		$("#add").show();
		
		$("#type").val("addAddr");
	});
}
//关闭编辑和添加地址弹窗
function close(){
	$(".addrDialog-content-buttons-close,.closeIcon,#add,#save").click(function(){
		$(".curtain").hide();
	});
}
//显示百度地图
function showBdmap(){
	$("#addr").focus(function(){
		$("#bdMap").show();
	});
	$("#addr").blur(function(){		
		$("#bdMap").hide();
	})
}
//获得经纬度
function getJWD(){
		var geolocation = new BMap.Geolocation();
	    geolocation.getCurrentPosition(function(r){
		if(this.getStatus() == BMAP_STATUS_SUCCESS){
			var mk = new BMap.Marker(r.point);
			var map = new BMap.Map("bdMap");
			map.addOverlay(mk);
			map.panTo(r.point);
			var point = new BMap.Point(r.point.lng,r.point.lat);
			getBdMap(point);
		}
		else {
			alert('failed'+this.getStatus());
		}        
	    },{enableHighAccuracy: true});
}
//百度地图
function getBdMap(point){
	 // 百度地图API功能
	function G(id) {
		return document.getElementById(id);
	}	

	var map = new BMap.Map("bdMap");
	map.centerAndZoom(point,12);                   // 初始化地图,设置城市和地图级别。
    map.enableScrollWheelZoom(true);              //开启滚轮
	var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
		{"input" : "addr"
		,"location" : map
	});

	ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
	var str = "";
		var _value = e.fromitem.value;
		var value = "";
		if (e.fromitem.index > -1) {
			value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		}    
		str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;
		
		value = "";
		if (e.toitem.index > -1) {
			_value = e.toitem.value;
			value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		}    
		str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
		$("#prompt")[0].innerHTML = str;
		
	});

	var myValue;
	ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
	var _value = e.item.value;
		myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		$("#prompt")[0].innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;
		setPlace();
	});

	function setPlace(){
		map.clearOverlays();    //清除地图上所有覆盖物
		function myFun(){
			var pp = local.getResults().getPoi(0).point;
			//获取第一个智能搜索的结果
			map.centerAndZoom(pp, 18);
			map.addOverlay(new BMap.Marker(pp)); //添加标注

				$("#lng").val(pp.lng);  
				$("#lat").val(pp.lat);
		}
		var local = new BMap.LocalSearch(map, { //智能搜索
		  onSearchComplete: myFun
		});
		local.search(myValue);
	}
	map.addEventListener("click", showInfo);//点击事件
	function showInfo(e){
		
				$("#lng").val(e.point.lng);  
				$("#lat").val(e.point.lat);                 

	}
}
//               <div class="addrBlock fl h100 bb mr10 mt15 p15 pt15 f14 pr">
//					<div class="fl fc3 mb10">
//						<span class="addrBlock-name"><?php echo $name;?></span>
//						<span class="addrBlock-sex ml15"><?php echo $sex;?></span>
//					</div>
//					<div class="addrBlock-buttons fr mb10">
//						<button class="addrBlock-buttons-edit nb fc9" type="button">修改</button>
//						<button class="addrBlock-buttons-delete nb fc9" type="button">删除</button>
//					</div>
//					<div class="addrBlock-addrControl cb h20 mb5">
//					    <span class="addrBlock-addr mr10 fc3"><?php echo $addr;?></span>
//                      <span class="addrBlock-addrDetails fc6"><?php echo $addrDetails;?></span>
//                  </div>
//                  <p class="addrBlock-tel fc6 mt"><?php echo $tel;?></p>
//                  <div class="addrBlock-hint h100 tc pa f14 none">
//                      <p class="fcf">确认删除收获地址?</p>
//                      <button class="addrBlock-hint-OK mt5 mr10 w60 nb " type="button">确定</button>
//                      <button class="addrBlock-hint-close mt5 w60 nb" type="button">取消</button>
//                  </div>
//                  <input class="addrBlock-id" type="hidden" value="<?php echo $id;?>">
//                  <input class="addrBlock-lng" type="hidden" value="<?php echo $lng;?>">
//                  <input class="addrBlock-lat" type="hidden" value="<?php echo $lat;?>">
 //                </div>
