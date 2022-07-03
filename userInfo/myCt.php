<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>我的收藏</title>
		<link rel="stylesheet" href="../css/bass.css" />
        <link rel="stylesheet" href="../css/common/header.css" />
		<link rel="stylesheet" href="../css/common/icon.css" />
		<link rel="stylesheet" href="../css/common/footer.css" />
		<link rel="stylesheet" href="../css/common/login.css" />
		<link rel="stylesheet" href="../css/common/userInfo.css" />
		<link rel="stylesheet" href="css/myCt.css" />
		<script type="text/javascript" src="../js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="JS/cancel.js" ></script>
		<script type="text/javascript" src="JS/seach.js" ></script>
		<script type="text/javascript" src="JS/myCt.js" ></script>
	</head>
	<body>
		<?php
			include_once '../conn.php';
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
               	<li><a href="../index1.html">首页</a></li>
               	<li><a href="myOrder.php">我的订单</a></li>
               </ul>
			</nav>
			<div class="strip fl f0 ml30 ">
				<div class="strip-addr1 dib vm f12 w200 h40 ">
					<span class="addrIcon dib vm ml10 mr10 vm"></span>
					<span class="strip-addr1-info dib vm">上帝之家</span>
				</div>
				<div class="strip-addr2 dib f0 vm w200 h40 none">
					<p class="strip-addr2-item1 dib w80 h40 pl10 bb vm">
					    <span class="strip-addr2-item1-info dib vm fc3 f12">温州市永嘉县</span>
					    <span class="strip-addr2-item1-listIcon listIcon dib vm"></span>
					</p>
					<input class="strip-addr2-item2 h40 nb pl10 bb f12 vm" type="text" placeholder="请输入送餐地址">
				</div>
				<div class="strip-search dib vm f0 w200 h40">
				    <span class="seachIcon dib vm ml10"></span>
				    <input class="strip-search-text h40 nb vm pl10 bb f12" type="text" placeholder="搜索产品和商家">
			    </div>
			</div>
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
               			<li><a href="myOrder.php">我的订单</a></li>
               			<li><a href="personalData.php">我的资料</a></li>
               			<li><a href="myCt.php">我的收藏</a></li>
               			<li class="cancel"><a href="javascript:void(0);">退出</a></li>
               		</ul>
               	</li>
               </ul>
			</div>
		  </div>
		</header>
		<div class="container bc clearfix mt50 mb20">
			<ul class="userInfoList fl mt20 ml50">

                <li>
                	我的订单
                	<ul class="userInfoList-item">
                		<li><a  href="myOrder.php">近三个月的订单</a></li>
                	</ul>
                </li>
                <li>
                	我的资料
                	<ul class="userInfoList-item">
                		<li><a href="accountBalance.php">账户余额</a></li>
                		<li><a href="personalData.php">个人资料</a></li>
                		<li><a href="addrMm.php">地址管理</a></li>
                	</ul>
                </li>
                <li><a class="active" href="myCt.php">我的收藏</a></li>
			</ul>
			<div class="main fr f14 clearfix">
				<h1 class="f18">地址管理</h1>
				<div class="accessible mt30 pl30 clearfix">
					<!--<h2 class="mb15">
						当前区域共有<strong class="number pl5 pr5">1</strong>家可配送商家
					</h2>
					<div class="ctItem w300 mr20 mb20 fl">
						<div class="ctItem-top h90 pr">
							<figure class="top-bg">
								<img src="image/bg2.jpg">
							</figure>
							<p class="top-name pa fcf f16">咪咕小站黄焖鸡米饭</p>
							<figure class="top-logo pa">
								<img src="image/cheshi.png">
							</figure>							
						</div>
						<div class="ctItem-middle tc">
							<meter class="mt5 mb15 w70 h10 db bc" min="0" low="60" high="90" max="100" value="60" optimum="100">100</meter>
                            <span class="middle-money dib mb15">
                            	<p class="middle-money-title fc6 mb10 f12">起送价格</p>
                            	<p class="f18">&yen;16</p>
                            </span>
                            <span class="middle-time dib f12 mb15">
                            	<p class="middle-time-title fc6 mb10">送餐时间</p>
                            	<p class="f18">22分</p>                           	
                            </span>
						</div>
						<div class="ctItem-bottom p10">
							<span class="dib emptyIcon fr"></span>
						</div>
					</div>-->
				</div>
                <div class="unreachable mt30 pl30 clearfix">
					<!--<h2 class="mb15">
						当前区域不可配送的商家
					</h2>
					<div class="ctItem w300 mr20 mb20 fl">
						<div class="ctItem-top h90 pr">
							<figure class="top-bg">
								<a><img src="image/bg2.jpg"></a>
							</figure>
							<p class="top-name pa fcf f16">咪咕小站黄焖鸡米饭</p>
							<figure class="top-logo pa">
								<img src="image/cheshi.png">
							</figure>							
						</div>
						<div class="ctItem-middle tc">
							<meter class="mt5 mb15 w70 h10 db bc" min="0" low="60" high="90" max="100" value="60" optimum="100">100</meter>
                            <span class="middle-money dib mb15">
                            	<p class="middle-money-title fc6 mb10 f12">起送价格</p>
                            	<p class="f18">&yen;16</p>
                            </span>
                            <span class="middle-time dib f12 mb15">
                            	<p class="middle-time-title fc6 mb10">送餐时间</p>
                            	<p class="f18">22分</p>                           	
                            </span>
						</div>
						<div class="ctItem-bottom p10">
							<span class="dib emptyIcon fr"></span>
						</div>-->
					</div>
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
	</body>
</html>
