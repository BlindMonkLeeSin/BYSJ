function cancel(){
	$(".cancel").click(function(){
		$.get('../login.php',{type : "cancel"},function(data){
			alert(data);
		});
		setTimeout(function(){
			window.location.href = "../index1.html";
		},1500);
	});
}