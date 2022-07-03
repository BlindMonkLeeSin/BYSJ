$(document).ready(function(){
	cancel();
	
	insertClass();
	classListControl();
	showProduct("全部商品");
});
//插入类
function insertClass(){
	$("#addClassBt").click(function(){
		var classText = $("#insertClassText").val();
		$.post("productClass.php",{
			type : "insertClass",
			productClass : classText
		},function(data){
			alert(data);
		});
	})
}
//列表控制
function classListControl(){
	var flag = 0;
	$(".classIf-box,.listIcon").click(function(){
		$(".classIf-content").toggle();
		if(flag == 0){
			$(".listIcon").addClass("listIcon1");
			flag = 1;
			showClass();
		}else{
			$(".listIcon").removeClass("listIcon1");
			flag = 0;
		}
	});
}
//类显示
function showClass(){
    $(".classIf-content").load("productClass.php",{
    	  type : "showClass"
    },function(data){
    	classItemControl();
    });
    
}
//列表项目控制
function classItemControl(){
	$(".classIf-content li").click(function(){
		var itemText = $(this).children("a").text();
		$(".classIf-box").text(itemText);
		showProduct(itemText);
	});
	$(".classIf-content li span").click(function(){
		var spnaNode = $(this);
     	var productClass = spnaNode.siblings().text();
//   	console.log(className);
		$.post("productClass.php",{
			type : "deleteClass",
			productClass : productClass
		},function(data){
			spnaNode.parent("li").remove();
		});
	});
}
//显示产品
function showProduct(productClass){
	$(".main-content").load("product.php",{
		productClass : productClass,
		type : "showProduct"
	},function(data){
		imgHx();
		deleteProduct();
		updateProduct();
	})
}
//删除产品
function deleteProduct(){
	$(".control-delete").click(function(){
		var btNode = $(this);
		var productId = btNode.next().val();
		var productImg = $(".productImg").val();
	    $.post("product.php",{
		    productId : productId,
		    productImg : productImg,
		    type : "delProduct"
	    },function(data){
		    btNode.parents(".productInfo").remove();
	    });
	});
}
//图片回显
function imgHx(){
	$(".imgSc").change(function(){
		var fileNode = $(this);
		var fil = fileNode[0].files;
		for(var i = 0;i<fil.length;i++){
			reads(fil[i],fileNode);
		}
	});
}
function reads(fil,fileNode){
	var reader =new FileReader();
	reader.readAsDataURL(fil);
	reader.onload =function(){
		fileNode.prev().attr("src",reader.result);
	}
}
//更新产品
function updateProduct(){
	$(".control-edit").click(function(){
	var form = $(this).parents("form");
    var formData = new FormData(form[0]);
        $.ajax({
            url: 'product.php',  //server script to process data
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
