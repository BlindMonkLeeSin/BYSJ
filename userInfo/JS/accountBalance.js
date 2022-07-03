$(document).ready(function(){
	cancel();
    $(".strip-addr1-info").text(sessionStorage.area);
    $(".strip-addr2-item1-info").text(sessionStorage.city);
	recharge();
	
	seach();
});
function recharge(){
	$(".rechargeBt").click(function(){
		var money = $(".rechargeMoney").val();
		$.post('user.php',{
			type : "recharge",
			money : money
		},function(data){
			
		});
	})

	
}
