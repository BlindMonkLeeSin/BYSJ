<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>店铺页</title>
		<link rel="stylesheet" href="css/bass.css" />
        <link rel="stylesheet" href="css/common/header.css" />
		<link rel="stylesheet" href="css/common/icon.css" />
		<link rel="stylesheet" href="css/common/footer.css" />
		<link rel="stylesheet" href="css/common/login.css" />
		<link rel="stylesheet" href="css/common/shoppingCart.css" />
		<link rel="stylesheet" href="css/shop.css" />
		<link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css" />
		<script type="text/javascript" src="js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="js/common//login.js" ></script>
		<script type="text/javascript" src="js/common/ifLogin.js" ></script>
		<script type="text/javascript" src="js/shop.js" ></script>
	</head>
	<body>
		<header class="headerBlack clearfix ">
		  <div class="container bc">
			<span class="logoBlack fl"></span>
			<nav class="fl ml30">
               <ul class="navList f0">
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
				    <input class="strip-search-text h40 nb vm pl10 bb f12" type="text" placeholder="输入搜索的产品和商家">
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
				<?php
					include_once 'conn.php';
              		$shopName = $_GET['shopname'];
              		$stmt=$mysqli->stmt_init();
                    $sql="select store_name,logo,shop_tel,open_time,start_time,shop_addr,introduce,notice,psf,qbj,sdsj,tjzs from shop where shop_name = '$shopName'";
                    if($stmt->prepare($sql)){
	                    $stmt->execute();
	                    $stmt->bind_result($store_name,$logo,$shop_tel,$open_time,$start_time,$shop_addr,$introduce,$notice,$psf,$qbj,$sdsj,$tjzs);
	                    while ($stmt->fetch()) {
	                    	
	            ?>
		<div class="drama pr">
			<figure>
				<img class="bg" src="image/bg1.jpg">
			</figure>
		  <div class="container clearfix pa">
			<div class="drama-left fl w04">
				<div class="shop-info clearfix h200 pt50 pb50 bb">
					<figure class="fl">
						<img src="image/shop/<?php echo $logo; ?>">
					</figure>
					<div class="shop-info-sideBar fl pt20 pl10">
						<div class="sideBar-content clearfix">
							<h1 class="fl f20"><?php echo $store_name;?></h1>
							<span class="fl f12 mt5 ml10 none">店家休息</span>
						</div>
						<meter class="w70 h10" min="0" low="0.6" high="0.9" max="1" value="<?php echo $tjzs;?>" optimum="100"></meter>
						<span class="f12 ml15"><?php echo $tjzs*100;?>%</span>
					</div>
					<div 
						id="data"
						data-shopName="<?php echo $shopName?>" data-psf="<?php echo $psf ?>" data-qbj="<?php echo $qbj?>"
				    >
						
					</div>
				</div>
				<div class="shop-details fc6 f14 pr p20 none">
					<p class="shop-details-introduce pb20">
                        <?php echo $introduce;?>
					</p>
					<p class="mt20">
						详细地址：<?php echo $shop_addr;?>
					</p>
					<p>
						营业时间： <span><?php echo $open_time;?></span>--<span><?php echo $start_time;?></span>
					</p>
				</div>
			</div>
			<div class="drama-right fl w06 h200 bb tc f14">
				<span class="drama-right-front w02 fl">
					<em class="db mb20">起送价</em>
					<strong class="f20"><?php echo $qbj;?>&yen;</strong>
				</span>
				<span class="drama-right-in w03 fl">
					<em class="dib mb20 ml100">配送费</em>
					<strong class="f20 ml100">配送费&yen;<?php echo $psf;?></strong>
				</span>
				<span class="drama-right-after w03 fl">
					<em class="dib mb20 ml100">平均送达速度</em>
					<strong class="f20 ml100"><?php echo $sdsj;?>分钟</strong>
				</span>
				<?php	
                	   }
	                   $stmt->close();
                    }

              		$flag = 0;
              		if(isset($_SESSION['flag']) && $_SESSION['flag'] == "user"){
              			$userName = $_SESSION['username'];
              		    $stmt=$mysqli->stmt_init();
                        $sql="select shop_name from user_ct where user_name ='$userName' and shop_name='$shopName'";
                        if($stmt->prepare($sql)){
	                        $stmt->execute();
	                        $stmt->bind_result($shopname);
	                        if($stmt->fetch()) {
	                        	$flag = 1; 
	                        }
	                        $stmt->close();
	                    }
	            ?>                 
	                    <a id="ct" class="fr pr" href="javascript:void(0);">
					        <i class="icon ion-heart f20 db <?php if($flag == "1"){ echo 'active';}?>"></i>
					        <span id="ctText"><?php if($flag == "1"){echo '取消收藏';}else{echo '收藏';}?></span>
					        <span class="none" id="hideShopName"><?php echo $shopName;?></span>
				        </a>
				<?php
	                }
                ?>
                
			</div>
		  </div>
		</div>

		<div class="shopNav">
		  <div class="container bc clearfix">
		  	<div class="shopNav-control fl w900">
			    <ul class="control-list fl">
				    <li>
				    	<a class="borderRight" href="javascript:void(0);">菜单</a>
				    </li>
				    <li class="active none">
				    	<a href="javascript:void(0);">评论</a>
				    </li>
			    </ul>
			    <div class="control-show fr f30">
			    	<i class="icon ion-grid active" id="vertival"></i>
			    	<i class="icon ion-navicon-round" id="transverse"></i>
			    </div>
			</div>
			<div class="shopNav-seach fl f0 w300 bb pl30">
				<input  id="seachText" class="h40 pl10 bb vm" type="text" placeholder="搜索商家和美食">
				<button id="seach" class="nb h40 w40 bb vm" >
					<i class="icon ion-search placeholder-icon f20 fcc"></i>
				</button>
			</div>
	      </div>
		</div>
		<div class="container bc clearfix mt20 mb20">
			<div class="main fl">
				<div class="main-classify w900 mr30 bb p10 pl20 mb15">
					<ul class="clearfix">
						<?php              
   	                        $stmt=$mysqli->stmt_init();
                            $sql="select id,product_class from product_class where shop_name='$shopName'";
                            if($stmt->prepare($sql)){
	                            $stmt->execute();
	                            $stmt->bind_result($id,$product_class);
	                            while ($stmt->fetch()){
                            ?>
                                    <li><a href="javascript: void(0);"><?php echo $product_class;?></a></li>
                        <?php                  
	                            }
	                             $stmt->close();
	                        }
                        ?>
					</ul>
				</div>
				<div class="fill"></div>
				<div class="main-productList fc6">
						<?php              
   	                        $stmt=$mysqli->stmt_init();
                            $sql="select id,product_class from product_class where shop_name='$shopName'";
                            if($stmt->prepare($sql)){
	                            $stmt->execute();
	                            $stmt->bind_result($id,$product_class);
	                            while ($stmt->fetch()){
                        ?>
					
					<ul class="clearfix">
						<h1 class="pl20 f20 fc6 mb10"><?php echo $product_class?></h1>
						    <?php
						        $con = mysql_connect("localhost","root","root");
                			    	if (!$con)
                                    {
                                         die('Could not connect: ' . mysql_error());
                                    }
                                    mysql_select_db("BYSJ", $con);
                                    $sql2="select * from product where product_class='$product_class'";
                                    $result = mysql_query($sql2);
                			    		
                                    while($row = mysql_fetch_array($result))
                                    {
                            ?>
						<li class="clearfix">
							<figure class="fl">
								<img src="image/product/<?php echo $row['product_img']; ?>">
							</figure>
							<div class="productList-info fl">
								<div class="top">
								    <h3><?php echo $row['product_name']; ?></h3>
								    <span class="f14 fcc">月销<?php echo $row['product_sv']; ?>份</span>
							    </div>
                                <div class="bottom clearfix">
                            	    <span class="fl">&yen;<?php echo $row['product_money']; ?></span>
                            	    <button 
                            	    	class="submit fr"
                            	    	data-productId="<?php echo $row['Id']; ?>"
                            	        data-productName ="<?php echo $row['product_name']; ?>"
                            	        data-productMoney ="<?php echo $row['product_money']; ?>"
                            	    >
                            	    	加入购物车
                            	    </button>
                                </div>
							</div>
						</li>
                            <?php
                                }
                                mysql_close($con);
                            ?>
					</ul>
					    <?php                  
	                            }
	                             $stmt->close();
	                        }
	                        $mysqli->close();
                        ?>
				</div>
			</div>
			<div class="commentList w900 fl mr30 none">
				 <ul class="commentList-nav clearfix f14">
				 	<li><a href="javascript:void(0);">全部(100)</a></li>
				 	<li class="active"><a href="javascript:void(0);">满意(99)</a></li>
				 	<li><a href="javascript:void(0);">不满意(1)</a></li>
				 </ul>
				 <div class="commentList-content pr">
				 	<div class="commentList-content-item clearfix pt20 pr20">
				 		<figure class="item-img fl pl30 pr30">
				 			<img src="image/头像.jpg"> 
				 		</figure>
				 		<div class="item-sideBar fl clearfix">
				 			<div class="item-sideBar-header clearfix h50 pb15">
				 				<div class="header-left fl">
				 					<h1 class>用户名</h1>
				 					<strong class="f14 active">满意</strong>
				 				</div>
				 				<div class="header-right fr">
				 					<span class="f12 fc9">2018-04-02 12:00:00</span>
				 				</div>
				 			</div>
				 			<div class="item-sideBar-message pt15 pb30 f14 fc3">
				 				<p class="message-content pb15">真的难吃</p>
				 				<button class="fr">回复</button>
				 				<div class="message-Reply p15 pr none">
				 					<h1 class="fc6 mb10">店家回复:</h1>
				 					你好啊!
				 					<span class="horn pa"></span>
				 				</div>
				 			</div>
				 		</div>
				 	</div>
                    <div class="commentList-content-item clearfix pt20 pr20">
				 		<figure class="item-img fl pl30 pr30">
				 			<img src="image/头像.jpg"> 
				 		</figure>
				 		<div class="item-sideBar fl clearfix">
				 			<div class="item-sideBar-header clearfix h50 pb15">
				 				<div class="header-left fl">
				 					<h1 class>用户名</h1>
				 					<strong class="f14 active">满意</strong>
				 				</div>
				 				<div class="header-right fr">
				 					<span class="f12 fc9">2018-04-02 12:00:00</span>
				 				</div>
				 			</div>
				 			<div class="item-sideBar-message pt15 pb30 f14 fc3">
				 				<p class="message-content pb15">真的难吃</p>
				 				<button class="fr none">回复</button>
				 				<div class="message-Reply p15 pr">
				 					<h1 class="fc6 mb10">店家回复:</h1>
				 					你好啊!
				 					<span class="horn pa"></span>
				 				</div>
				 			</div>
				 		</div>
				 	</div>
				 </div>
			</div>
			<div class="notice fl">
				<h1 class="p10 pl20">商家公告</h1>
				<p class="notice-content p10 pl20 f14">
					<?php echo $notice;?>
				</p>
			</div>
		</div>
		<footer class="footer h150 tc" >
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
        				<span class="dispatchingMoney fc9 f12 ml5 pl10 dib mb5 vm">配送费<?php echo $psf;?>&yen;</span>
        			</div>
        			<button class="shoppingCart-control-right fr f15 bb nb" disabled="disabled">
        			</button>
        		</div>
        </div>
	</body>
</html>
