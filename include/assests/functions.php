<?php
function getConfig($config_file) {
    $open = fopen($config_file, 'r');
    $read = fread($open, filesize($config_file));
    $conf = json_decode($read, TRUE);
    fclose($open);
    foreach($conf as $array => $per_conf) {
        foreach($per_conf as $key => $value) {
            $config[$array][$key] .= $value;
        }
    }
    return $config;
}
function nameLengthCheck($name, $length = '18') {
    $c_length = strlen($name);
    $c_correct = $length-3;
    $name_arr = str_split($name);
    if($c_length> $length){
        for($i = 0; $i < $c_correct; $i++) {
            $tmp_name .= $name_arr[$i];
        }
        $name = $tmp_name."...";
    } else {
        $name = $name;
    }
    return $name;
}
    
$config = getConfig('include/conf/pages.json');
$c = count($config) - 1;
$js_arr = "titleArr = { \n\t\t\t\t\tSettings: \"Settings\",\n";
for ($i = 0; $i <= $c; $i++) {
    foreach($config[$i] as $sleutel => $waarde) {
        if($sleutel == 'active') {
            if($waarde == '1') {
                $show = 'true';
            } else {
                $show = 'false';
            }
        }
        if($sleutel == 'placement'){
            $place = $waarde;
        }
        if($show == 'true') {
            if($sleutel == 'name') {
                $link[$place]['name'] = nameLengthCheck($waarde);
            }
            if($sleutel == 'app') {
                $link[$place]['app'] = $waarde;
                if($i < $c) {
                    $list .= $waarde.', '; 
                    $js_arr .= "\t\t\t\t\t".$link[$place]['app'].": \"".$link[$place]['name']."\",\n";
                } elseif($i == $c) {
                    $list .= $waarde; 
                    $js_arr .= "\t\t\t\t\t".$link[$place]['app'].": \"".$link[$place]['name']."\" \n\t\t\t };\n";
                }
            }
            if($sleutel == 'url') {
                $link[$place]['url'] = $waarde;
            }
            if($sleutel == 'icon') {
                $link[$place]['icon'] = $waarde;
            }
        }
    }
}
function cors() {
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        }
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
        exit(0);
    }
    
}
ksort($link);
?>