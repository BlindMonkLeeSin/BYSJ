$(document).ready(function(){
	ifLogin();
	
	showCurtain();
    login();
    register();
    cancel();
    
    cityMap();
    if(sessionStorage.city){
    	var city = sessionStorage.city;
    	$(".main-adress-content").text(city);
    	getBdMap(city);
    	
    }
    
})
