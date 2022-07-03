<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>账户余额</title>
		<link rel="stylesheet" href="../css/bass.css" />
        <link rel="stylesheet" href="../css/common/header.css" />
		<link rel="stylesheet" href="../css/common/icon.css" />
		<link rel="stylesheet" href="../css/common/footer.css" />
		<link rel="stylesheet" href="../css/common/login.css" />
		<link rel="stylesheet" href="../css/common/userInfo.css" />
		<link rel="stylesheet" href="css/accountBalance.css" />
		<script type="text/javascript" src="../js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="JS/cancel.js" ></script>
		<script type="text/javascript" src="JS/seach.js" ></script>
		<script type="text/javascript" src="JS/accountBalance.js" ></script>
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
                		<li><a class="active" href="accountBalance.php">账户余额</a></li>
                		<li><a href="personalData.php">个人资料</a></li>
                		<li><a href="addrMm.php">地址管理</a></li>
                	</ul>
                </li>
                <li><a href="myCt.php">我的收藏</a></li>
			</ul>
			<div class="main fr">
                <h1 class="f18">账户余额</h1>
                <div class="main-content pl30 pr30 mt10">
                <?php
              		$userName = $_SESSION['username'];
              		$stmt=$mysqli->stmt_init();
                    $sql="select user_money from user where user_name = '$userName'";
                    if($stmt->prepare($sql)){
	                    $stmt->execute();
	                    $stmt->bind_result($user_money);
	                    while ($stmt->fetch()) {
	            ?>
                	<span class="f14 fc3 mr50">
                		当前账户余额:
                		<strong class="f18"><?php echo $user_money; ?></strong>
                		元
                	</span>
                	<!--<input class="rechargeMoney w40 h30 bb tc" type="text">
                	<button class="rechargeBt nb fcf">充值</button>-->
                <?php	
                	   }
	                   $stmt->close();
                    }
                    $mysqli->close();
              	?>
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
