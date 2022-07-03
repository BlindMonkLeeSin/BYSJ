<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>确认订单</title>
		<link rel="stylesheet" href="css/bass.css" />
        <link rel="stylesheet" href="css/common/header.css" />
		<link rel="stylesheet" href="css/common/icon.css" />
		<link rel="stylesheet" href="css/common/footer.css" />
		<link rel="stylesheet" href="css/okOrder.css" />
		<script type="text/javascript" src="js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="js/okOrder.js" ></script>
	</head>
	<body>
		<?php
			include_once 'conn.php';
			if(isset($_SESSION['flag']) && $_SESSION['flag'] == "user"){
				
			}else{
				header("location:index1.html");
			}
		?>
		<header class="headerBlue">
		  <div class="container bc clearfix ">
			<span class="logoBlue fl"></span>
			<nav class="fl ml30">
               <ul class="navList f0 colorWhite">
               	<li><a href="index1.html">首页</a></li>
               	<li><a href="userInfo/myOrder.php">我的订单</a></li>
               </ul>
			</nav>
			<div class="fr">
               <ul class="loginList f0">
               	<li id="userName" class="pr">
               		<a href="javascript:void(0);">
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
               			<li><a href="userInfo/myOrder.php">我的订单</a></li>
               			<li><a href="userInfo/personalData.php">我的资料</a></li>
               			<li><a href="userInfo/myCt.php">我的收藏</a></li>
               			<li class="cancel"><a href="javascript:void(0);">退出</a></li>
               		</ul>
               	</li>
               </ul>
			</div>
		  </div>
		</header>
		<div class="container bc mt15 mb20 clearfix">
			<div class="orderDetails fl w400 pb20">
				<h1 class="f18 p20">
					订单详情
					<a id="eidt" class="fr f14 fc6" href="shop.html">&lt;返回商家修改</a>
				</h1>
				<div class="orderDetails-content f12">
					<ul class="titleList clearfix fc9">
						<li class="pl30">商品</li>
						<li>份数</li>
						<li class="pr30">小计(元)</li>
					</ul>
					<!--<ul class="orderDetailsItem clearfix  pl30 pr30 fc6">
						<li>BBQ鸡肉披萨-10寸</li>
						<li class="tc">
                            10
						</li>
						<li>&yen;59.00</li>
					</ul>-->
					<ul class="dbFee clearfix  pl30 pr30 fc6">
						<li>配送费</li>
						<li>&nbsp;</li>
						<li>&yen;0</li>
					</ul>
					<p class="pl30 pr30 tr">
						<span class="num">&yen;140.00</span>
					</p>
					<p class="pl30 pr30 tr">
						共<span class="countNum pl5 pr5">2</span>份商品
					</p>
				</div>
			</div>
			<div class="userInfo fr pl30 pr20 pt20 pb20 f14">
				<h1 class="f18 pb15">
					收获地址
					<a class="fr fc6" href="userInfo/addrMm.php">添加修改地址</a>
				</h1>
				<?php
              		$userName = $_SESSION['username'];
              		$stmt=$mysqli->stmt_init();
                    $sql="select id,name,sex,tel,addr,addrDetails,lng,lat from user_addr where user_name = '$userName'";
                    if($stmt->prepare($sql)){
	                    $stmt->execute();
	                    $stmt->bind_result($id,$name,$sex,$tel,$addr,$addrDetails,$lng,$lat);
	                    while ($stmt->fetch()) {
	            ?>
				<div 
					class="userInfo-addrBlock clearfix pt15 pb15 mb10 pr"
					data-Id="<?php echo $id;?>"
				>
					<span class="fl addrIcon ml15 mr15"></span>
					<div class="addrBlock-info fl fc6 pl15">
						<p>
							<span><?php echo $name;?></span>
							<span><?php echo $sex;?></span>
							<span><?php echo $tel;?></span>
						</p>
						<p>
							<span><?php echo $addr;?></span><span<?php echo $addrDetails;?></span>
						</p>
					</div>
					<!--<p class="addrBlock-hide pa w h bb pt10 pr10 none">
					    <span class="addrBlock-hide-delete f12 fr">x</span>						
					    <span class="addrBlock-hide-edit mr5 fr">修改</span>
				    </p>-->
				</div>
				<?php	
                	   }
	                   $stmt->close();
                    }
                    $mysqli->close();
              	?>
				<!--<div class="userInfo-addrBlock clearfix pt15 pb15 mb10 pr">
					<span class="fl addrIcon ml15 mr15"></span>
					<div class="addrBlock-info fl fc6 pl15">
						<p>
							<span>name</span>
							<span>男</span>
							<span>phone</span>
						</p>
						<p>
							桥下镇西岸村桥下镇西岸村
						</p>
					</div>
					<p class="addrBlock-hide pa w h bb pt10 pr10 none">
					    <span class="addrBlock-hide-delete f12 fr">x</span>						
					    <span class="addrBlock-hide-edit mr5 fr">修改</span>
				    </p>
				</div>-->
				<p class="more">
					<span class="fc6">显示更多地址</span><span class="dib listIcon"></span>
				</p>
				<p class="none stop">
					<span class="fc6">收起</span><span class="dib listIcon1"></span>
				</p>
				<h2 class="f18 mt30 mb15">
					其他信息
				</h2>
				<div class="userInfo-it pl15 mb30">
					<p>
						<span class="mr20">发票信息</span>
						<span>无</span>
					</p>
					<p class="mt15">
					<p>
						<span class="mr20">订单备注</span>
						<input id="remarks" class="w200 h30 nb pl10 bb"type="text">
					</p>
				</div>
				<button class="okOrder nb fcf h40">确认下单</button>
			</div>
		</div>
		<div class="curtain pa none">
			<div class="prompt pf pl15 pr15 pb15 bb tc">
			    <h1 class="pt5 pb5 mb5 f18">确认支付？</h1>
			    <p class="mb10 tl clearfix f14 w">
			    	<span class="fl payment">支付金额<i class="f16">￥0</i></span>
			    	<span class="fr balance">余额<i class="f16">￥0</i></span>
			    </p>
			    <button class="ok nb w80 h30 mr20">确定</button>
			    <button class="close nb w80 h30">取消</button>
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
</html>
