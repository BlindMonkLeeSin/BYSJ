$(document).ready(function(){
	cancel();
	
    $(".strip-addr1-info").text(sessionStorage.area);
    $(".strip-addr2-item1-info").text(sessionStorage.city);
	imgHx();
	
	seach();
});
//图片回显
function imgHx(){
	$("#myfile").change(function(){
		var fil = $(this)[0].files;
		for(var i = 0;i<fil.length;i++){
			reads(fil[i]);
		}
	});
}
function reads(fil){
	var reader =new FileReader();
	reader.readAsDataURL(fil);
	reader.onload =function(){
		$("#img").attr("src",reader.result);
		upload();
	}
}
//图片异步上传
function upload(){
//	//1.准备FormData
//	var fd = new FormData();
//	fd.append("myfile",$("#myfile")[0].files[0]);
//	var xhr = new XMLHttpRequest();
//	
//	xhr.upload.onprogress = function(event){
//		if(event.lengthComputable){
//			var pereent =Math.round(event.loaded*100/event.total);
//			console.log(pereent);
//		}
//	}
//	xhr.onloadstart = function(event){
//		console.log('load start');
//	}
//	xhr.onload = function(){
//		console.log('load success');
//		
//	}
//	xhr.onerror = function(event){
//		console.log('error');
//	}
//	xhr.onloadend = function(){
//		console.log('load end');
//	}
//	xhr.open('POST','addProduct.php',true);
//	xhr.send(fd);
//	var fd = new FormData();
//	fd.append("myfile",$("#myfile")[0].files[0]);
    var formData = new FormData($('form')[0]);
    $.ajax({
        url: 'user.php',  //server script to process data
        type: 'POST',
        xhr: function() {  // custom xhr
            myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){ // check if upload property exists
                myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // for handling the progress of the upload
            }
            return myXhr;
        },
        //Ajax事件
//      beforeSend: beforeSendHandler,
//      success: function(data){
//      	alert(data);
//      },
//      error: errorHandler,
        // Form数据
        data: formData,
        //Options to tell JQuery not to process data or worry about content-type
        cache: false,
        contentType: false,
        processData: false
    });
}
//进度条处理
function progressHandlingFunction(e){
    if(e.lengthComputable){
        $('progress').attr({value:e.loaded,max:e.total});
    }
}
