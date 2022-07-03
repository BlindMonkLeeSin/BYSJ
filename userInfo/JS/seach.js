function seach(){
	$(".seachIcon").click(function(){
		var text = $(".strip-search-text").val();
		lng = sessionStorage.lng;
		lat = sessionStorage.lat;
		window.location.href="../seach.php?lng="+lng+"&lat="+lat+"&text="+text;
	});
}