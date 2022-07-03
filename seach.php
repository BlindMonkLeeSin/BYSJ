<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/bass.css" />
        <link rel="stylesheet" href="css/common/header.css" />
		<link rel="stylesheet" href="css/common/icon.css" />
		<link rel="stylesheet" href="css/common/footer.css" />
		<link rel="stylesheet" href="css/common/login.css" />
		<link rel="stylesheet" href="css/common/shoppingCart.css" />
		<link rel="stylesheet" href="css/seach.css" />
		<script type="text/javascript" src="js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="js/common//login.js" ></script>
		<script type="text/javascript" src="js/common/ifLogin.js" ></script>
		<script type="text/javascript" src="js/common/shopCart.js" ></script>
		<script type="text/javascript" src="js/seach.js" ></script>
		<title>搜索页面</title>
	</head>
	<body>

		<header class="headerBlue">
		  <div class="container bc clearfix">
			<span class="logoBlue fl"></span>
			<nav class="fl ml30">
               <ul class="navList f0 colorWhite">
               	<li><a href="index1.html">首页</a></li>
               	<li><a href="javascript:void(0);" id="orderAddr">我的订单</a></li>
               </ul>
			</nav>
			<div class="strip fl f0 ml30">
				<div class="strip-addr1 dib vm f14 w200 h40">
					<span class="addrIcon dib vm ml10 mr10"></span>
					<span class="strip-addr1-info dib vm"></span>
				</div>
				<div class="strip-addr2 dib f0 vm w200 h40 none">
					<p class="strip-addr2-item1 dib w80 h40 pl10 bb f14 vm">
					    <span class="strip-addr2-item1-info dib vm">地址啊asssas</span>
					    <span class="strip-addr2-item1-listIcon listIcon dib vm"></span>
					</p>
					<input class="strip-addr2-item2 h40 nb pl10 bb f12 vm" type="text" placeholder="请输入送餐地址">
				</div>
				<div class="strip-search dib vm f0 w200 h40">
				    <span class="seachIcon dib vm ml10"></span>
				    <input class="strip-search-text h40 nb vm pl10 bb f12" type="text" placeholder="搜索商家或产品">
			    </div>
			</div>
			<div class="fr">
               <ul class="loginList f0">
               	<li id="loginBt"><a href="javascript:void(0);">登录</a></li>
               	<li id="registerBt"><a href="javascript:void(0);">注册</a></li>
               	<li id="userName" class="pr none">
               		<a href="javascript:void(0);">用户名</a>
               		<span class="dib listIcon w15 h15"></span>
               		<ul class="loginListDetalist f14 pa tc none">
               			<li><a href="userInfo/myOrder.php">我的订单</a></li>
               			<li><a href="userInfo/personalData.php">我的资料</a></li>
               			<li><a href="userInfo/myCt.php">我的收藏</a></li>
               			<li class="cancel"><a href="javascript:void(0);">退出</a></li>
               		</ul>
               	</li>
               	<li id="openShop"><a href="shopInfo/shopLogin.html">开店</a></li>
               	<li id="shopName" class="pr none">
               		<a href="shopInfo/shopLogin.html">商家名</a>
               		<span class="dib listIcon w15 h15"></span>
               		<ul class="loginListDetalist f14 pa tc none">
               			<li><a href="shopInfo/shopInfo.php">店铺信息</a></li>
               			<li><a href="shopInfo/shopNewOrder.php">我的订单</a></li>
               			<li><a href="shopInfo/shopProductInfo.php">商品管理</a></li>
               			<li class="cancel"><a href="javascript: void(0);">退出</a></li>
               		</ul>
               	</li>
               </ul>
			</div>
		  </div>
		</header>
		<div class="main-productList clearfix mt30">
		<?php
			include_once 'conn.php';
			$lng = $_GET['lng'];
            $lat = $_GET['lat'];
            $minLng = $lng-0.025;
            $maxLng = $lng+0.025;
            $minlat = $lat-0.025;
            $maxlat = $lat+0.025;
            $text = $_GET['text'];
            
		

            $stmt=$mysqli->stmt_init();
            $sql="select shop_name,store_name,logo,shop_tel,shop_class,notice,psf,sdsj,tjzs from shop where store_name like '%$text%' and (shop_lng<='$maxLng' and shop_lng>='$minLng' and shop_lat<='$maxlat' and shop_lat>='$minlat')";
            if($stmt->prepare($sql)){
	            $stmt->execute();
	            $stmt->bind_result($shop_name,$store_name,$logo,$shop_tel,$shop_class,$notice,$psf,$sdsj,$tjzs);
	            while ($stmt->fetch()) {
	    
		?>
				 <div class="productList-content fl pr">
				 	<a class="clearfix w300 p20 bb db" href="shop.php?shopname=<?php echo $shop_name;?>">
                      <figure class="fl">
                      	<img src="image/shop/<?php echo $logo;?>">
                      	<figcaption class="tc f12 fca pt10 pb10"><?php echo $sdsj;?>分钟</figcaption>
                      </figure>
                      <div class="productList-content-synopsis fl">
                      	 <h1 class="ml20 mb10 f20 fb"><?php echo $store_name;?></h1>
                      	 <meter class="ml20 mb10 w70 h10" min="0" low="0.1" high="0.9" max="1" value="<?php echo $tjzs?>" optimum="1"></meter>
                      	 <h2 class="ml20 f14 fca">配送费<?php echo $psf;?>&yen;</h2>
                      </div>
                    </a>
                      <div class="productList-content-details w300 pl10 pr10 pt20 bb pa none">
                      	 <h1 class="f20 fb"><?php echo $store_name;?></h1>
                      	 <h2 class="f14 fca pt10 pb10"><?php echo $shop_class;?></h2>
                      	 <p class="productList-content-details-dispatching mt20 mb20 pt10 pb10 pl20 f14 fc2">
                      	 	<span class="productList-content-details-dispatching-money pr20">
                      	 		<?php if($psf==0){echo "免配送费";}else{ echo $psf."&yen;";}?>
                      	 	</span>
                      	 	<span class="productList-content-details-dispatching-time">
                      	 		平均<mark><?php echo $sdsj;?></mark>分送达
                      	 	</span>
                      	 </p>
                      	 <p class="productList-content-details-notice fc3 f14">
                      	 	<?php echo $notice;?>
                      	 </p>
                      	 <div class="productList-content-details-bugle pa db"></div>
                      </div>
				 </div>	
		<?php                  
	            }
	            $stmt->close();
	        }
	        $mysqli->close();
        ?>
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
		<div class="curtain pa h200 w none">
        	<div class="curtain-content pf w300 bb pl20 pr20 pt15">
        		<div class="clearfix">
        			<span class="logoWhite fl"></span>
        			<span class="closeIcon w15 h15 dib fr"></span>
        		</div>
                <ul class="curtain-content-list f0 tc mb10 h30">
                	<li>登录</li>
                	<li>注册</li>
                </ul>
        		<div class="login none">
        			<input class="login-text w h40 pl15 bb f16 mb10" type="text" placeholder="手机号">
        			<input class="login-pwd w h40 pl15 bb f16 mb10" type="password" placeholder="密码">
        			<button class="login-button w h40 bb f16 mb10 nb">登录</button>
        		</div>
        		<div class="register none">
        			<input class="register-text w h40 pl15 bb f16 mb5" type="text" placeholder="手机号">
        			<label class="register-text-prompt none"></label>
        			<input class="register-pwd w h40 pl15 bb f16 mt5 mb5" type="password" placeholder="密码">
        			<label class="register-pwd-prompt none"></label>
        			<button class="register-button w h40 bb f16 mt5 mb5 nb">注册</button>
        		</div>
        	</div>
        </div>
        <div class="shoppingCart pf">
        		<div class="shoppingCart-main none">
        			<div class="shoppingCart-mian-header clearfix">
        				 <h1 class="fl f15">购物车</h1>
        				 <span class="header-empty dib emptyIcon fr"></span>
        			</div>
                    <ul class="shoppingCart-main-list">
                    	<li class="clearfix">
                    		<span class="list-productTitle fl fc6">店名</span>
                    		<div class="list-productNumber w70 f0 fl nb">
                    			<button class="delNum h20 w20 tc f14 bb nb vm ">-</button>
                    			<input class="w30 h20 f14 tc bb nb vm " type="text" value="0">
                    			<button class="addNum h20 w20 tc f14 bb nb vm">+</button>
                    		</div>
                    		<span class="list-productMoney fr tr">&yen;10</span>
                    	</li>
                    	<li class="clearfix">
                    		<span class="list-productTitle fl fc6">店名</span>
                    		<div class="list-productNumber w70 f0 fl nb">
                    			<button class="number- h20 w20 tc f14 bb nb vm ">-</button>
                    			<input class="w30 h20 f14 tc bb nb vm " type="text" value="10">
                    			<button class="number+ h20 w20 tc f14 bb nb vm">+</button>
                    		</div>
                    		<span class="list-productMoney fr tr">&yen;1000000</span>
                    	</li>
                    </ul>
        		</div>
        		<div class="shoppingCart-control clearfix">
        			<div class="shoppingCart-control-left fl pl20 bb">
        				<span class="dib shoppingIcon pr">
        					<span class="redNumber dib pa tc none">1</span>
        				</span>
        				<span class="sumMoney f20"></span>
        				<span class="dispatchingMoney fc9 f12 ml5 pl10 dib mb5 vm"></span>
        			</div>
        			<button class="shoppingCart-control-right fr f15 bb nb" disabled="disabled">
        			</button>
        		</div>
        </div>
	</body>
</html>
