<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>修改信息</title>
		<link rel="stylesheet" href="../css/bass.css" />
        <link rel="stylesheet" href="../css/common/header.css" />
		<link rel="stylesheet" href="../css/common/icon.css" />
		<link rel="stylesheet" href="../css/common/footer.css" />
		<link rel="stylesheet" href="../css/common/userInfo.css" />
		<style>
			.submit{background-color: #0089DC; width: 150px}
		</style>
		<script type="text/javascript" src="../js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="JS/cancel.js" ></script>

	</head>
	<body>
		<?php
	        include_once '../conn.php';
		    if(isset($_SESSION['flag']) && $_SESSION['flag'] == "shop"){
			    
				
		    }else{
			    header("location:shopLogin.html");
	        }
	    ?>
		<header class="headerBlue">
		  <div class="container bc clearfix ">
			<span class="logoBlue fl"></span>
			<nav class="fl ml30">
               <ul class="navList f0 colorWhite">
               	<li><a href="../index1.html">首页</a></li>
               	<li><a href="shopNewOrder.php">我的订单</a></li>
               </ul>
			</nav>
			<div class="fr">
               <ul class="loginList f0">
                  <li id="shopName" class="pr">
               		<a href="shopInfo/shopLogin.html">
               			<?php 
               				if(isset($_SESSION['username'])){
               				    echo $_SESSION['username'];
               			    }else{
               			    	echo "";
               			    } 
               		    ?>
               		</a>
               		<span class="dib listIcon w15 h15"></span>
               		<ul class="loginListDetalist f14 pa tc none">
               			<li><a href="shopInfo.php">店铺信息</a></li>
               			<li><a href="shopNewOrder.php">我的订单</a></li>
               			<li><a href="shopProductInfo.php">商品管理</a></li>
               			<li class="cancel"><a href="javascript: void(0);">退出</a></li>
               		</ul>
               	  </li>
               </ul>
			</div>
		  </div>
		</header>
		<div class="container bc clearfix mt50 mb20">
            <ul class="userInfoList fl mt20 ml50">
                <li>
                	店铺信息
                	<ul class="userInfoList-item">
                		<li><a href="shopInfo.php">基本信息</a></li>
                		<li><a href="shopEidtInfo.php">修改信息</a></li>
                	</ul>
                </li>
                <li>
                	我的订单
                	<ul class="userInfoList-item">
                		<li><a href="shopNewOrder.php">新的订单</a></li>
                		<li><a href="shopLssueOrder.php">发出的订单</a></li>
                		<li><a href="shopHistoryOrder.php">历史订单</a></li>
                	</ul>
                </li>
                <li>
                	商品管理
                	<ul class="userInfoList-item">
                		<li><a href="shopProductInfo.php">商品信息</a></li>
                		<li><a class="active" href="addProduct.php">添加商品</a></li>
                	</ul>
                </li>
			</ul>
			<div class="main fr f14 fc6">
                <h1 class="f18">添加产品</h1>
                <div class="main-conten fc6 w300 mt20 ml30">
                  <form  action="product.php" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
                	<div class="f0 mb15">
                		<label class="dib w80 f14">商品名</label>
                		<input class="w200 h40 bb pl15" type="text" name="productName">
                	</div>
                	<div class="f0 mb15">
                		<label class="dib w80 f14">分类</label>
                		<select class="w200 h40 bb pl10" name="productClass">
                		<?php
                			$userName = $_SESSION['username'];
   	                        $stmt=$mysqli->stmt_init();
                            $sql="select product_class from product_class where shop_name='$userName'";
                            if($stmt->prepare($sql)){
	                            $stmt->execute();
	                            $stmt->bind_result($product_class);
	                            while ($stmt->fetch()){
                		?>
                			<option><?php echo $product_class; ?></option>
                		<?php                  
	                            }
	                            $stmt->close();
	                        }
                            $mysqli->close();
                        ?>
                		</select>
                	</div>
                	<div class="f0 mb15">
                		<label class="dib w80 f14">上传图片</label>
                		<input class="w200 h40 bb" type="file" name="myfile">
                	</div>
                	<div class="f0 mb15">
                		<label class="dib w80 f14">价格</label>
                		<input class="w200 h40 bb pl15" type="text" name="productMoney">
                	</div>
                	<input type="hidden" name="type" value="insertProduct">
                	<div class="tc">
                		<button class="submit h40 bb nb fcf" type="submit">添加</button>
                	</div>
                  </from>
                </div>
           </div>
		</div>
        <footer class="footer h150 tc">
 	        <address class="addr pt20 pb10">
 		        <span>name</span>
 		        <span>40214157</span>
 		        <span>班级14101</span>
 		        <span>phone</span>
 	        </address>
 	        <span class="fca">copyright&copy2017-2018</span>
        </footer>
    <script>
    	cancel();
    </script>
	</body>
</html>
