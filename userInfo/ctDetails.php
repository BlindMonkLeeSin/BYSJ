<?php
   include_once '../conn.php';
    if(isset($_SESSION['flag']) && $_SESSION['flag'] == "user"){
    	function decodeUnicode($str){
            return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
                create_function(
                    '$matches',
                    'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
                ),
            $str);
        }
        $resultArr = array();
        $con = mysql_connect("localhost","root","root");
	    mysql_select_db("BYSJ", $con);
        $type = $_GET['type'];
        $userName = $_SESSION['username'];
        $lng = $_GET['lng'];
        $lat = $_GET['lat'];
        $minLng = $lng-0.025;
        $maxLng = $lng+0.025;
        $minlat = $lat-0.025;
        $maxlat = $lat+0.025;
        //可达的收藏
        if($type == "keda"){

//          where shop_lng<='$maxLng' and shop_lng>='$minLng' and shop_lat<='$maxlat' and shop_lat>='$minlat'"

            $sql2="select user_ct.id,shop.shop_name,shop.logo,shop.sdsj,shop.tjzs,shop.qbj from user_ct inner join shop where user_ct.shop_name=shop.shop_name and user_name='$userName' and (shop_lng<='$maxLng' and shop_lng>='$minLng' and shop_lat<='$maxlat' and shop_lat>='$minlat')";
            $result = mysql_query($sql2);
                			  		
            while($row = mysql_fetch_array($result))
            {      
    	        $resultArr[] = $row;
            }
            $josn = json_encode($resultArr);
            echo decodeUnicode($josn);
            //不可达的收藏
        }if($type == "bukeda"){
//          where shop_lng<='$maxLng' and shop_lng>='$minLng' and shop_lat<='$maxlat' and shop_lat>='$minlat'"
            $sql2="select user_ct.id,shop.shop_name,shop.logo,shop.sdsj,shop.tjzs,shop.qbj from user_ct inner join shop where user_ct.shop_name=shop.shop_name and user_name='$userName' and (shop_lng>'$maxLng' or shop_lng<'$minLng' or shop_lat>'$maxlat' or shop_lat<'$minlat')";
            $result = mysql_query($sql2);
                			  		
            while($row = mysql_fetch_array($result))
            {      
    	        $resultArr[] = $row;
            }
            
            $josn = json_encode($resultArr);
            echo decodeUnicode($josn);
        }    	
    }else{
    	header("location:index1.html");
    }
    mysql_close($con);
?>