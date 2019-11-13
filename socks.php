<?php
# function #
function curl($url, $var = null) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_TIMEOUT, 25);
    if ($var != null) {
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $var);
    }
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
function getStr($string,$start,$end){
    $str = explode($start,$string,2);
    $str = explode($end,$str[1],2);
    return $str[0];
}
$format = $_POST['get_sock'];
if ($format == "1") {
$domain = array("http://www.vipsocks24.net","http://www.live-socks.net");
$rand = rand(0,1);
$curl = curl($domain[$rand]);
$potong = getStr($curl,"<h3 class='post-title entry-title' itemprop='name'>","</h3>");
$potong_lagi = getStr($potong,"<a href='","'");
$page = curl($potong_lagi);
$socks = getStr($page,' wrap="hard">','</textarea>');
$jancok["code"] = 0;
$jancok["msg"] = "Success";
$jancok["socks"] = "$socks";
$dewa = json_encode($jancok);
$dewa = str_replace('\n',',',$dewa);
echo $dewa;
} else {
echo 'Access Denied';
}
?>