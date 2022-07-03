<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>地址管理</title>
		<link rel="stylesheet" href="../css/bass.css" />
        <link rel="stylesheet" href="../css/common/header.css" />
		<link rel="stylesheet" href="../css/common/icon.css" />
		<link rel="stylesheet" href="../css/common/footer.css" />
		<link rel="stylesheet" href="../css/common/login.css" />
		<link rel="stylesheet" href="../css/common/userInfo.css" />
		<link rel="stylesheet" href="../css/common/editAddr.css" />
		<link rel="stylesheet" href="css/addrMm.css" />
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=icGhZG9f0PkrWOlkverHyrIhwpvz4uFu"></script>
		<script type="text/javascript" src="../js/jQuery/jquery-3.2.1.js" ></script>
		<script type="text/javascript" src="JS/cancel.js" ></script>
		<script type="text/javascript" src="JS/seach.js" ></script>
		<script type="text/javascript" src="JS/addrMm.js" ></script>
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
                		<li><a class="active" href="addrMm.php">地址管理</a></li>
                	</ul>
                </li>
                <li><a href="myCt.php">我的收藏</a></li>
			</ul>
			<div class="main fr f14 clearfix">
				<h1 class="f18">地址管理</h1>
				<!--<?php
              		$userName = $_SESSION['username'];
              		$stmt=$mysqli->stmt_init();
                    $sql="select id,name,sex,tel,addr,addrDetails,lng,lat from user_addr where user_name = '$userName'";
                    if($stmt->prepare($sql)){
	                    $stmt->execute();
	                    $stmt->bind_result($id,$name,$sex,$tel,$addr,$addrDetails,$lng,$lat);
	                    while ($stmt->fetch()) {
	            ?>
				<div class="addrBlock fl h100 bb mr10 mt15 p15 pt15 f14 pr">
					<div class="fl fc3 mb10">
						<span class="addrBlock-name"><?php echo $name;?></span>
						<span class="addrBlock-sex ml15"><?php echo $sex;?></span>
					</div>
					<div class="addrBlock-buttons fr mb10">
						<button class="addrBlock-buttons-edit nb fc9" type="button">修改</button>
						<button class="addrBlock-buttons-delete nb fc9" type="button">删除</button>
					</div>
					<div class="addrBlock-addrControl cb h20 mb5">
					    <span class="addrBlock-addr mr10 fc3"><?php echo $addr;?></span>
                        <span class="addrBlock-addrDetails fc6"><?php echo $addrDetails;?></span>
                    </div>
                    <p class="addrBlock-tel fc6 mt"><?php echo $tel;?></p>
                    <div class="addrBlock-hint h100 tc pa f14 none">
                        <p class="fcf">确认删除收获地址?</p>
                        <button class="addrBlock-hint-OK mt5 mr10 w60 nb " type="button">确定</button>
                        <button class="addrBlock-hint-close mt5 w60 nb" type="button">取消</button>
                    </div>
                    <input class="addrBlock-id" type="hidden" value="<?php echo $id;?>">
                    <input class="addrBlock-lng" type="hidden" value="<?php echo $lng;?>">
                    <input class="addrBlock-lat" type="hidden" value="<?php echo $lat;?>">
				</div>
			    <?php	
                	   }
	                   $stmt->close();
                    }
                    $mysqli->close();
              	?>-->
				<div class="addAddr fl h100 bb tc mt15 f14 ">
                    <span>添加地址</span>
				</div>

			</div>
		</div>
      <div class="curtain w pa none">
      <form enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<div class="addrDialog w500 fc3 f14 pf">
			<div class="addrDialog-title clearfix p15">
				<h1 class="f18 fl">编辑地址</h1>
				<span class="dib closeIcon w15 h15 fr"></span>
			</div>
			<div class="addrDialog-content">
				<div class="addrDialog-content-name mb20">
					<label>姓名</label>
					<input type="text" name="name" id="name">
				</div>
				<div class="addrDialog-content-sex clearfix mb20">
					<label class="fl">性别</label>
					<div class="sex-delist fl">
						<input class="vm ml5" type="radio" name="sex" value="先生" id="man">
						<label>男</label>
						<input class="vm" type="radio" name="sex" value="女士" id="lady">
						<label>女</label>
					</div>
				</div>
				<div class="addrDialog-content-addr mb20">
					<label>定位地址</label>
					<input type="text" name="addr" id="addr">
					<div class="none" id="prompt"></div>
				</div>
				<div class="addrDialog-content-map w h200 pr mb20 none" id="bdMap">
					
				</div>
				<div class="addrDialog-content-addrDetails mb20" >
					<label>详细地址</label>
					<input type="text" name="addrDetails" id="addrDetails">	
				</div>
				<div class="addrDialog-content-tel mb20">
					<label>手机号</label>
					<input type="tel" name="tel" id="tel">	
				</div>
				<div class="addrDialog-content-buttons">
					<label></label>
					<button class="addrDialog-content-buttons-save h40 w100 nb fcf mr10" id="save" type="button">保存</button>
					<button class="addrDialog-content-buttons-add h40 w100 nb fcf mr10" id="add" type="button">添加</button>
					<button class="addrDialog-content-buttons-close h40 w60 bb nb fc9" id="abrot" type="button">取消</button>
				</div>
				<div class="addrDialog-content-hiddens">
					<input type="hidden" name="addrId" id="addrId" value="">
					<input type="hidden" name="lng" id="lng" value="">
					<input type="hidden" name="lat" id="lat" value="">
					<input type="hidden" name="type" id="type" value="">
				</div>
			</div>
		</div>
	   </form>
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
