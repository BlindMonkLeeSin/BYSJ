<?php
	include_once '../conn.php';
	if(isset($_SESSION['flag']) && $_SESSION['flag'] == "shop"){
			    
				
	}else{
		header("location:shopLogin.html");
	}
    $type = $_POST['type'];
    //插入产品
    if($type == "insertProduct"){
   	    //图片上传设置
        $allowtype = array("gif", "png", "jpg");   //设置允许上传的类型为gif, png和jpg
        $size = 1000000;                           //设置允许大小为1M（1000000字节）以内的文件
        $path = "../image/product";                       //设置上传后保存文件的路径
        //1. 判断文件是否可以成功上传到服务器，$_FILES['myfile']['error'] 为0表示上传成功
        if($_FILES['myfile']['error'] > 0) {    
            echo '上传错误: ';
            switch ($_FILES['myfile']['error']){
                case 1:  die('上传文件大小超出了PHP配置中的约定值：upload_max_filesize');  
                case 2:  die('上传文件大小超出了表单中的约定值：MAX_FILE_SIZE');  
                case 3:  die('文件只被部分上载'); 
                case 4:  die('没有上传任何文件'); 
                case 6:  die('找不到临时文件夹');
                case 7:  die('文件写入失败');
                default: die('末知错误');
            }
        } 
        //2. 判断上传的文件是否为允许的文件类型,通过文件的后缀名
        $tuming= explode(".", $_FILES['myfile']['name']);
        $hz = array_pop($tuming); //array_pop() 函数弹出数组中的最后一个元素

        //3. 通过判断文件的后缀方式，来决定文件是否是允许上传的文件类型
        if(!in_array($hz, $allowtype)) {
            die("这个后缀是<b>{$hz}</b>,不是允许的文件类型!");
        }
        //4. 判断上传的文件是否为允许大小
        if($_FILES['myfile']['size'] > $size ) {
            die("超过了允许的<b>{$size}</b>字节大小");
        }
        //5. 为了系统安全，也为了同名文件不会被覆盖，上传后将文件名使用系统定义
        $filename = date("YmdHis").rand(100,999).".".$hz;
        //6. 判断是否为上传文件
        if (is_uploaded_file($_FILES['myfile']['tmp_name'])) { 
            if (!move_uploaded_file($_FILES['myfile']['tmp_name'], $path.'/'.$filename)) {  
                die('问题: 不能将文件移动到指定目录。');
            }
        }else{
            die("问题: 上传文件{$_FILES['myfile']['name']}不是一个合法文件: ");
        }
        //7. 如果文件上传成功则输出
        echo "文件{ $filename }上传成功,保存在{$path}中，大小为{$_FILES['myfile']['size']}字节";
        $userName = $_SESSION['username'];
        $productName = $_POST['productName'];
   	    $productClass = $_POST['productClass'];
   	    $productMoney = $_POST['productMoney'];

        $productImg=$filename;
        
        
        $sql="insert into product values('','$userName','$productName','$productImg','$productClass','$productMoney','')";
        $result=$mysqli->query($sql);
        
        if($result){
        	echo "插入成功";
            header("location:addProduct.php");	
        }
        $mysqli->close();
    }
    
    //显示产品
    if($type == "showProduct"){
    	
    	$userName = $_SESSION['username'];
    	$productClass =$_POST['productClass'];
   	    $stmt=$mysqli->stmt_init();
   	    if($productClass =="全部商品"){
   	    	$sql="select id,product_name,product_img,product_class,product_money,product_sv from product where shop_name='$userName'";
   	    }else{
   	        $sql="select id,product_name,product_img,product_class,product_money,product_sv from product where shop_name='$userName' and product_class='$productClass'";
   	    }
        if($stmt->prepare($sql)){
	        $stmt->execute();
	        $stmt->bind_result($id,$product_name,$product_img,$class,$product_money,$product_sv);
	        while ($stmt->fetch()){
?>
                  <form action="product.php" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
                	<div class="productInfo fl clearfix mb10 pr">
                		<figure class="fl pr">
                			<img class="productInfo-img w100 h100" src="../image/product/<?php echo $product_img;?>">
                			<input class="imgSc w100 h100 bb pa" type="file" name="myfile" >
                		</figure>
                		<div class="productInfo-details fl pl15 bb">
                			<input class="productName db h20 bb pl10 mt5 f12 fc9" type="text" name="productName" value="<?php echo $product_name;?>">
                			<p class="f0">
                			    <span class="dib w80 mt5 mb5 f12">月销售额<?php echo $product_sv;?></span>
                			    <select class="selectClass w100 h20 mt5 f12 bb" name="productClass">
                			    	<?php
                			    		$con = mysql_connect("localhost","root","root");
                			    		if (!$con)
                                        {
                                            die('Could not connect: ' . mysql_error());
                                        }
                                        mysql_select_db("BYSJ", $con);
                                        $sql2="select product_class from product_class where shop_name='$userName'";
                                        $result = mysql_query($sql2);
                			    		
                                        while($row = mysql_fetch_array($result))
                                        {
                                    ?>
                                        <option 
                                        	<?php if($class == $row['product_class']){echo "selected";} ?>
                                        >
                                        	<?php echo $row['product_class']; ?>
                                        </option>
                                    <?php

                                       }
                                        mysql_close($con);
                                    ?>
                			    </select>
                			</p>
                			<input class="productMoney db h20 bb pl10 f12 fc9" type="text" name="productMoney" value="<?php echo $product_money;?>">
                			<div class="productControl f0 mt5">
                				<button class="control-edit nb w60 h20 fcf ml10" type="button">修改</button>
                				<button class="control-delete nb w60 h20 fcf ml10" type="button">删除</button>
                				<input type="hidden" name="productId" value="<?php echo $id; ?>">
                			    <input type="hidden" class="productImg" name="productImg" value="<?php echo $product_img; ?>">
                			    <input type="hidden" name="type" value="updateProduct">
                			</div>
                		</div>
                	</div>
                  </form>	
<?php               
	        }
	        $stmt->close();
	    }
    $mysqli->close();
    }
    if($type =="delProduct"){
    	$productId = $_POST['productId'];
	    $dirname="../image/product";
	    $file=$dirname.'/'.$_POST['productImg'];
	    unlink($file);
    	echo $productId;
    	$sql="delete from product where Id='$productId'";
	    $result=$mysqli->query($sql);
	    if($result){
		    echo "删除成功！";
		}
	    $mysqli->close();
    }
if($type == "updateProduct"){
    	//图片上传设置
    if($_FILES['myfile']['size']!=0){	//如果有上传文件就删除原来的文件。
	    $dirname="../image/product";
	    $file=$dirname.'/'.$_POST['productImg'];
	    unlink($file);

	    $allowtype = array("gif", "png", "jpg");   //设置允许上传的类型为gif, png和jpg
        $size = 1000000;                           //设置允许大小为1M（1000000字节）以内的文件
        $path = "../image/product";                       //设置上传后保存文件的路径

        //1. 判断文件是否可以成功上传到服务器，$_FILES['myfile']['error'] 为0表示上传成功
        if($_FILES['myfile']['error'] > 0) {    
            echo '上传错误: ';
            switch ($_FILES['myfile']['error']){
                case 1:  die('上传文件大小超出了PHP配置中的约定值：upload_max_filesize');  
                case 2:  die('上传文件大小超出了表单中的约定值：MAX_FILE_SIZE');  
                case 3:  die('文件只被部分上载'); 
                case 4:  die('没有上传任何文件'); 
                case 6:  die('找不到临时文件夹');
                case 7:  die('文件写入失败');
                default: die('末知错误');
            }
        } 
        //2. 判断上传的文件是否为允许的文件类型,通过文件的后缀名
        $tuming= explode(".", $_FILES['myfile']['name']);
        $hz = array_pop($tuming); //array_pop() 函数弹出数组中的最后一个元素

        //3. 通过判断文件的后缀方式，来决定文件是否是允许上传的文件类型
        if(!in_array($hz, $allowtype)) {
            die("这个后缀是<b>{$hz}</b>,不是允许的文件类型!");
        }
        //4. 判断上传的文件是否为允许大小
        if($_FILES['myfile']['size'] > $size ) {
            die("超过了允许的<b>{$size}</b>字节大小");
        }
        //5. 为了系统安全，也为了同名文件不会被覆盖，上传后将文件名使用系统定义
        $filename = date("YmdHis").rand(100,999).".".$hz;
        //6. 判断是否为上传文件
        if (is_uploaded_file($_FILES['myfile']['tmp_name'])) { 
            if (!move_uploaded_file($_FILES['myfile']['tmp_name'], $path.'/'.$filename)) {  
                die('问题: 不能将文件移动到指定目录。');
            }
        }else{
            die("问题: 上传文件{$_FILES['myfile']['name']}不是一个合法文件: ");
        }
        //7. 如果文件上传成功则输出
        echo "文件{ $filename }上传成功,保存在{$path}中，大小为{$_FILES['myfile']['size']}字节";
	}
        
        $productName = $_POST['productName'];
   	    $productClass = $_POST['productClass'];
   	    $productMoney = $_POST['productMoney'];
   	    $productId = $_POST['productId'];
    	if($_FILES['myfile']['size']!=0){$productImg=$filename;}else{$productImg=$_POST['productImg'];}//如果有上传文件就用上传文件生成的图片名。否者就用表单的。    
	    $sql="update product set product_name ='$productName',product_img='$productImg',product_class='$productClass',product_money='$productMoney' where Id='$productId'";
	    $result=$mysqli->query($sql);
	    if($result){
//          header("location:shopProductInfo.html");
            echo "修改成功";
		}
	    $mysqli->close();
    	
}
?>
