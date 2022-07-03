$(document).ready(function(){
	cancel();
	btCtl();
});
function btCtl(){
	$(".harvestButton").click(function(){
		var bh = $(this).attr("data-bh");
		var parrent = $(this).parents("tr");
		console.log(bh);
		$.post("updateOrderStatus.php",{
			type : "fh",
			bh : bh
		},function(data){
			parrent.remove();
		});
	});
	$(".arrivalButton").click(function(){
		var bh = $(this).attr("data-bh");
		var parrent = $(this).parents("tr");
		console.log(bh);
		$.post("updateOrderStatus.php",{
			type : "sd",
			bh : bh
		},function(data){
			parrent.remove();
		});
	});
}
