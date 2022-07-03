$(document).ready(function(){
	getUserName();
	addressInit('cmbProvince', 'cmbCity', 'cmbArea');  
    selectButton();
});
function getUserName(){
	$.get('../login.php',{
		type : "getUserName",
	},function(data){
		if(data == "error\r\n"){
			alert("非法操作");
		}else{
			$("#userName").val(data);
		}
	});
}
function selectButton(){
	$("#cmbProvince").change(function(){
		getBdMap($(this).val(),10);
		$("#form-map").show();
	});
    $("#cmbCity").change(function(){
		getBdMap($(this).val(),10);
	});
	$("#cmbArea").change(function(){
		getBdMap($(this).val(),14);
	});
}
function getBdMap(city,num){
	 // 百度地图API功能
	function G(id) {
		return document.getElementById(id);
	}

	var map = new BMap.Map("form-map");
	map.centerAndZoom(city,num);                   // 初始化地图,设置城市和地图级别。
    map.enableScrollWheelZoom(true);              //开启滚轮
	var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
		{"input" : "addrDetails"
		,"location" : map
	});

	ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
		console.log(e.point);
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
		G("form-item-prompt").innerHTML = str;
		
	});

	var myValue;
	ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
	var _value = e.item.value;
		myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		G("form-item-prompt").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;
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
		alert(e.point.lng + ", " + e.point.lat);
		
				$("#lng").val(e.point.lng);  
				$("#lat").val(e.point.lat);                 

	}
}
