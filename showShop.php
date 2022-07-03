<?php
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
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    
        $type = $_GET["type"];
        $lng = $_GET['lng'];
        $lat = $_GET['lat'];
        $minLng = $lng-0.025;
        $maxLng = $lng+0.025;
        $minlat = $lat-0.025;
        $maxlat = $lat+0.025;
        
    if($type == "全部商家"){

        mysql_select_db("BYSJ", $con);
        $sql2="select shop_name,store_name,logo,shop_tel,shop_class,notice,psf,sdsj,tjzs from shop where shop_lng<='$maxLng' and (shop_lng>='$minLng' and shop_lat<='$maxlat' and shop_lat>='$minlat')";
        $result = mysql_query($sql2);
                			  		
        while($row = mysql_fetch_array($result))
        {      
    	    $resultArr[] = $row;
        }
        mysql_close($con);
        $josn = json_encode($resultArr);
        echo decodeUnicode($josn);
    }else{
    	mysql_select_db("BYSJ", $con);
        $sql2="select shop_name,store_name,logo,shop_tel,shop_class,notice,psf,sdsj,tjzs from shop where shop_lng<='$maxLng' and shop_lng>='$minLng' and shop_lat<='$maxlat' and shop_lat>='$minlat' and shop_class='$type'";
        $result = mysql_query($sql2);
                			  		
        while($row = mysql_fetch_array($result))
        {      
    	    $resultArr[] = $row;
        }
        mysql_close($con);
        $josn = json_encode($resultArr);
        echo decodeUnicode($josn);
    	
    } 


?>
