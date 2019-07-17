<?php
echo("<html></<!DOCTYPE html>
<html>
<head>
	<title>Shortty API</title>
</head>
<body>");

$url = $_GET['url'];

function shorten($url, $custom = "", $format = "text") {
 $api_key = $_GET['apikey'];
 $api_url = "https://shortty.ml/api/?key=".$api_key;
 $api_url .= "&url=".urlencode(filter_var($url, FILTER_SANITIZE_URL));
 if(!empty($custom)){
 	$api_url .= "&custom=".strip_tags($custom);
 }
 $curl = curl_init();
 curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1,CURLOPT_URL => $api_url));
 $Response = curl_exec($curl);curl_close($curl);
 if($format == "text"){
 	$Ar = json_decode($Response,TRUE);
 	if($Ar["error"]){
 		return $Ar["msg"];
 	}else{
 		return $Ar["short"];
 	}
 }else{
 	return $Response;
 }
}

echo ('Long URL : '
.$url
.'<br />'
."Your shorten URL : "
.shorten($url)
.'<br /><br />'
.'Powered by: <a href="https://shortty.ml">Shortty</a>

</body>
</html>"');
?>