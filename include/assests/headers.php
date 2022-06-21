<?php
header('Set-Cookie: SameSite=None; Secure'); 
header("X-Frame-Options: SAMEORIGIN");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, UPDATE');
header("Access-Control-Allow-Headers: X-Requested-With, Origin, Content-Type, X-Auth-Token, Proxy-Authorization, Max-Forwards");
foreach($link as $place => $val){
    header("X-Frame-Options: ALLOW-FROM ".$val['url']."");
}
echo cors();
?>