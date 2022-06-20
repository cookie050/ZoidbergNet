<html>
<body>
  <head>
  	<link rel="icon" href="/include/img/favicon.png" sizes="32x32" type="image/png" />
  	<link rel="icon" href="/include/img/favicon.ico" sizes="32x32" type="image/x-icon" />
    <link rel="shortcut icon" href="/include/img/favicon.png" sizes="32x32" type="image/png" />
    <link rel="shortcut icon" href="/include/img/favicon.ico" sizes="32x32" type="image/x-icon" />
<?php
session_start();
if(isset($_GET['logout'])){
        unset($_SESSION["login"]);
        unset($_SESSION['user']);
        unset($_SESSION["invalids"]);
        session_destroy();
        session_start();
?>
  	<title>ZoidbergNet</title>
</head>
<body style="background-image: linear-gradient(to bottom right, #273032, #122023); font-size: 64px; color: #CCC; margin: 0; padding: 0;">
<div style='display: flex; justify-content: center; align-items: center; width: 100%; height:100%;'>
<?php
        echo "<span style=\"margin-top: -50px;\">Bye!</span>";
        header("refresh: 3; url = /");
?>
    </div>
</body>
<?php
} else {

if(!isset($_SESSION["invalids"])) {
	$invalid = 0; 
} else {
	$invalid = $_SESSION["invalids"];
}
if($invalid >= '3') {
	die();
}
function getSettings($file) {
    $open = fopen($file, 'r');
    $read = fread($open, filesize($file));
    $conf = json_decode($read, TRUE);
    fclose($open);
    return $conf;
}
$settings = getSettings('include/conf/settings.json');
foreach($settings['users'] as $i => $users_array) {
    foreach($users_array as $sleutel => $waarde) {
        if($sleutel == 'username'){
            $user_list[$i]['username'] = $waarde;
        }
        if($sleutel == 'hash'){
            $hash = $waarde;
            $user_list[$i]['hash'] = $hash;
        }
        if($sleutel == 'password'){
            $password = $waarde;
        }
        $user_list[$i]['password'] = md5($hash.'.'.$password);
        if($sleutel == 'name'){
            $user_list[$i]['name'] = $waarde;
        }
        if($sleutel == 'picture'){
            $user_list[$i]['picture'] = $waarde;
        }
        if($sleutel == 'rights'){
            $user_list[$i]['rights'] = $waarde;
        }
    }
}
foreach($user_list as $sleutel => $waarde) {
    if($user_list[$sleutel]['username'] == $_POST["username"]){
        $hash = $user_list[$sleutel]['hash'];
        $pass = $user_list[$sleutel]['password'];
        $user = $user_list[$sleutel]['username'];
        $name = $user_list[$sleutel]['name'];
        $picture = $user_list[$sleutel]['picture'];
        $rights = $user_list[$sleutel]['rights'];
    }
}     
$errorMsg = "";
$validUser = $_SESSION["login"] === true;
if(isset($_POST["sub"])) {
  if($hash){
    $validUser = md5($hash.'.'.$_POST["password"]) == $pass;
  }
  if(!$validUser) { 
  	$errorMsg = "Invalid username or password."; 
  	$_SESSION["invalids"] = $invalid + 1;
  } else {
  	$_SESSION["login"] = true;
  	$_SESSION['user'] = $user;
  	$_SESSION['name'] = $name;
  	$_SESSION['picture'] = $picture;
  	$_SESSION['rights'] = $rights;
  	$_SESSION["invalids"] = 0;
  }
}
if($validUser != true) {
?>
  	<title>ZoidbergNet</title>
</head>
<body style="background-image: linear-gradient(to bottom right, #273032, #172023); color: #CCC; margin: 0; padding: 0;">
<div style='display: flex; justify-content: center; align-items: center; width: 100%; height:100%;'>
  <form name="input" action="/" method="post">
     <table style="margin-top: -50px;">
         <tr>
             <td><img src="/include/img/Zoidberg.png" height="64px" /></td>
             <th style="font-size: 32px; vertical-align: bottom; padding-bottom: 10px;">ZoidbergNet</th>
         </tr>
	<tr>
		<td  style="width: 75px;"><label for="username">Username:</label></td>
		<td style="text-align: right; width: 125px;"><input type="text" value="<?= $_POST["username"] ?>" id="username" name="username" /></td>
	</tr>
	<tr>
		<td><label for="password">Password:</label></td>
		<td style="text-align: right;"><input type="password" value="" id="password" name="password" /></td>
	</tr>
	<tr>
		<td><div class="error"><?= $errorMsg ?></div></td>
		<td style="text-align: right;"><input type="submit" value="Login" name="sub"/></td>
	</tr>
     </table>
  </form>
</div>
</body>
<?php
}
if($validUser) {
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
  	<title>ZoidbergNet: QBittorrent</title>
  	<style>
		html {
			margin: 0;
			padding: 0;
			height: 100%;
			width: 100%;
			background-image: linear-gradient(to bottom right, #273032, #172023, #2d2d2d);
		}
        body {
			margin: 0;
			padding: 0;
			height: 100%;
			width: 100%;
  			color: rgba(255,255,255,0.7);
            background-image: linear-gradient(90deg, rgba(23,32,35,0.3) 0.5%, rgba(43,43,43,0.15) 2%, rgba(255,255,255,0) 4%);
        }
        #user_menu {
			background-image: linear-gradient(to bottom right, #273032, #172023, #2d2d2d);
            border-radius: 15px;
            border: 2px groove rgba(147, 147, 147, 0.7);
            position: relative;
            flex: 1;
            height: 80%;
            width: 85%;
            top: 50%;
            margin-top: -20%;
            bottom: 0;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            display: none;
            z-index: 4;
        }
		#logo {
			position: fixed;
  			top: 5px;
  			left: 5px;
		}
        #logo img {
            height: 75px;
            width: 75px;
            opacity: 0.8;
            z-index: 1;
        }
            #toggle-close {
                display: block;
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                transition: 1.5s;
            }
            #toggle-open {
                display: none;
                -webkit-transform: scaleX(-1);
                transform: scaleX(-1);
                transition: 1.5s;
            }
	  	#box {
		  	display: flex;
			margin: 0;
			padding: 0;
			width: 100%;
			position: absolute;
  			top: 80px;
  			left: 0;
  			right: 0;
  			bottom: 0;
            z-index: 3;
		}
		#top {
			top:0;
			height: 80px;
  			position: absolute;
  			left: 0;
  			right: 0;
  			text-align: center;
  			font-size: 42px;
  			padding-left: 200px;
            padding-top: 15px;
            z-index: 3;
            transition: padding-left .5s;
            color: rgba(255,255,255,0.7);
			background-image: linear-gradient(180deg, rgba(23,32,35,0.3) 0.5%,rgba(43,43,43,0.15) 2%,rgba(255,255,255,0) 4%);
		}
            #top #user_info {
				position: fixed;
				top: 5px;
				right: 5px;
                height: 80px;
                width: 68px;
                text-align: center;
			}
            #top #user_info #user_img {
                height: 76px;
                width: 76px;
                float: left;
            }
                #top #user_info #user_img img {
                    border-radius: 50%;
                }
            #top #user_info #user_text {
                font-size: 18px;
                margin-top: -28px;
                text-align: center;
                float: right;
                width: 64px;
                height: 20px;
                margin-right: -3px;
                color: rgba(255,255,255,0.8);
                background-color: rgba(0,0,0,0.5);
                color: rgba(255,255,255,0.7);
                border-radius: 5px;
                border: 1px groove rgba(147, 147, 147, 0.7);
            }
                #top #user_info #user_text a {
                    color: rgba(255,255,255,0.8);
                    text-decoration: none;
                }
		#left {
		  	flex: 0 0 200px;
            width: 200px;
            height: 100%;
  			font-size: 18px;
            z-index: 2;
            transition: 0.5s;
            overflow-x: hidden;
            overflow-y: hidden;
		}
            #left #menu {
                margin-top:15px;
            }
            #left #menu #scroll_menu {
                max-height: 70%;
                display: inline-block;
                overflow-x: auto;
            }
            #left .menu_text {
                transition: margin-right 0.25s;
                display: inline;
                height: 36px;
                width: 155px;
                bottom: 11px;
                padding-left: 5px;
                vertical-align: middle;
            }
			#left a {
	  			color: rgba(255,255,255,0.7);
                text-decoration: none;
                vertical-align: middle;
			}
            #left .icon {
                height: 26px;
                width: 26px;
                padding-left: 4px;
                padding-bottom: 5px;
                padding-top: 5px;
                vertical-align: middle;
            }
            #left #options {
                bottom: 40px;
                padding-left: 2px;
                height: auto;
                vertical-align: text-bottom;
                transition: 0.5s;
                flex: 0 0 200px;
                z-index: 3;
                width: 195px;
                position: absolute;
                transition: margin-right 0.25s;
            }
                #left #options .menu_text {
                    transition: margin-right 0.25s;
                    display: inline;
                    height: 36px;
                    width: 155px;
                    bottom: 11px;
                    padding-left: 5px;
                }
                #left #options .menu_item {
                    display: inline-table;
                    height: 36px;
                    width: 195px;
                    vertical-align: middle;
                    border: none;   
                }
                #left #options #menu_item :hover {
                    background-color: rgba(255,255,255,0.1); 
                    display: table-row;
                    height: 36px;
                    width: 170px;        
                }
            #left #menu_item {
                display: inline-table;
                height: 36px;
                width: 195px;
                vertical-align: middle;
            }
                #left #menu_item :hover {
                    background-color: rgba(255,255,255,0.1); 
                    display: table-row;
                    height: 36px;
                    width: 170px;           
                }
            #copyright {
                display: block;
                margin-bottom: 10px;
                bottom: 0px;
                width: 195px;
                margin-top: 10px;
                font-size: 16px;
                text-align: center;
                position: absolute;
                transition: margin-right 0.5s;
            }
		#right {
		  	flex: 1;
            transition: margin-left .5s;
            z-index: 1;
            bottom: 0;
            right: 0;
            background: #172023;
		}
        embed {
            z-index: 2;
            flex: 1;
            border-top-left-radius: 10px;
		  	outline: 2px #969696 groove;          
        }
<?php foreach($link as $place => $val) {
            echo "\t\t\t#".$val['app']." {\n";
            echo "\t\t\t\tborder: none;\n"; 
            echo "\t\t\t\theight: 100%;\n";
            echo "\t\t\t\twidth: 100%;\n";
            if($place == '0') {
                echo "\t\t\t\tdisplay: block;\n";                 
            } else {
                echo "\t\t\t\tdisplay: none;\n";
            }
            echo "\t\t\t}\n";
        } ?>
            #Settings {
				border: none; 
				height: 100%;
				width: 100%;
				display: none;
			}
  	</style>
  	<script type="text/javascript">
        function changeOnLoad() {
            let hash = window.location.href.split('#')[1];
            if (window.location.href.split('#')[1]) {
                changeFrame(hash);
            } else {
                var ids = "<?php echo $list; ?>, Settings, ";
		        var idList = ids.split(", ");
                changeFrame(idList[0]);
            }
        }
		function changeFrame(id) {
            let <?php echo $js_arr; ?>
		    var ids = "<?php echo $list; ?>, Settings, ";
		    var idList = ids.split(", ");
		    let idsNone = idList.filter(function(e) { return e !== id });
		    for (var i = 0; i < idsNone.length; i++) {
   			    document.getElementById(idList[i]).style.display = "none";
            }
    		document.getElementById('tilte').textContent = titleArr[id];
    		document.title = "ZoidbergNet: " + titleArr[id];
            document.getElementById(id).style.display = "block"; 
		}
        function openMenu() {
            document.getElementById("toggle-close").style.display = "block";
            document.getElementById("toggle-open").style.display = "none";
            const list = document.getElementsByClassName("left")[0];
            const nodes = list.getElementsByClassName("menu_text");
            const count = nodes.innerHTML = nodes.length;
            document.getElementById("left").style.flex = "0 0 200px";
            document.getElementById("left").style.width = "200px";
            document.getElementById("copyright").style.display = "block";
            document.getElementById("options").style.width = "200px";
            document.getElementById("options").style.bottom = "40px";
            document.getElementById("top").style.paddingLeft = "200px";
            for (var i = 0; i < count; i++) {
                list.getElementsByClassName("icon")[i].style.height = "26px";
                list.getElementsByClassName("icon")[i].style.width = "26px";
                list.getElementsByClassName("menu_text")[i].style.display = "inline";
                list.getElementsByClassName("menu_text")[i].style.verticalAlign = "text-middle";
            }
            const list_o = document.getElementsByClassName("options")[0];
            const nodes_o = list_o.getElementsByClassName("menu_text");
            const count_o = nodes_o.innerHTML = nodes_o.length;
            for (var i = 0; i < count_o; i++) {
                    list_o.getElementsByClassName("menu_text")[i].style.display = "inline";
                    list_o.getElementsByClassName("menu_item")[i].style.width = "195px";
                    list_o.getElementsByClassName("icon")[i].style.height = "26px";
                    list_o.getElementsByClassName("icon")[i].style.width = "26px";
                    list_o.getElementsByClassName("icon")[i].style.paddingLeft = "5px";
            }
        }
        function closeMenu() {
            document.getElementById("toggle-open").style.display = "block";
            document.getElementById("toggle-close").style.display = "none";
            const list = document.getElementsByClassName("left")[0];
            const nodes = list.getElementsByClassName("menu_text");
            const count = nodes.innerHTML = nodes.length;
            for (var i = 0; i < count; i++) {
                list.getElementsByClassName("menu_text")[i].style.display = "none";
                list.getElementsByClassName("icon")[i].style.height = "36px";
                list.getElementsByClassName("icon")[i].style.width = "36px";
            }
            const list_o = document.getElementsByClassName("options")[0];
            const nodes_o = list_o.getElementsByClassName("menu_text");
            const count_o = nodes_o.innerHTML = nodes_o.length;
            for (var i = 0; i < count_o; i++) {
                    list_o.getElementsByClassName("menu_text")[i].style.display = "none";
                    list_o.getElementsByClassName("menu_item")[i].style.width = "46px";
                    list_o.getElementsByClassName("icon")[i].style.height = "36px";
                    list_o.getElementsByClassName("icon")[i].style.width = "36px";
                    list_o.getElementsByClassName("icon")[i].style.paddingLeft = "2px";
            }
            document.getElementById("left").style.flex = "0 0 46px";
            document.getElementById("left").style.width = "0px";
            document.getElementById("copyright").style.display = "none";
            document.getElementById("options").style.width = "46px";
            document.getElementById("options").style.bottom = "5px";
            document.getElementById("top").style.paddingLeft = "56px";
        }
        function refreshPage() {
            let hash = window.location.href.split('#')[1];
            var code = document.getElementById(hash);
            code.src = code.src;
        }
        window.addEventListener('load', function() {
            var favicon = document.querySelector('link[rel~="icon"]');
            var clone = favicon.cloneNode(!0);
            clone.href = "/include/img/favicon.ico";
            favicon.parentNode.removeChild(favicon);
            document.head.appendChild(clone);
        }, false);
        function copyValue() {
            let text = document.querySelector("#Copy_this_Value");
            text.select();
            text = text.value;
            if (window.clipboardData && window.clipboardData.setData) {
                return window.clipboardData.setData("Text", text);
            } else if (document.queryCommandSupported && 
            document.queryCommandSupported("copy")) {
                var textarea = document.createElement("textarea");
                textarea.textContent = text;
                textarea.style.position = "fixed";
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    return document.execCommand("copy");
                } catch (ex) {
                    console.warn("Copy to clipboard failed.", ex);
                    return false;
                } finally {
                    document.body.removeChild(textarea);
                }
            }

        }
        
        function toggleUserMenu(value) {
            if(value === 'open') {
                document.getElementById("user_menu").style.display = "block";
            } else if(value === 'close') {
                document.getElementById("user_menu").style.display = "none";
            }
        }
    </script>
  </head>
  <body onload="changeOnLoad()">
    <div id="top">
        ZoidbergNet: 
        <span id="tilte">QBittorrent</span>
        <div id="user_info">
			<?php 
                if((!empty($_SESSION['picture'])) && (file_exists('.'.$_SESSION['picture']))) {
                    $profile_pic = $_SESSION['picture'];
                } else {
                    $profile_pic = '/include/img/icons/profle.png';
                }
				echo "<div id='user_img'><img id=\"load\" src=\"".$profile_pic."\" height=\"64px\" /></div><br />";
                echo "<div id='user_text'><a href=\"javascript:void(0)\" onclick=\"toggleUserMenu('open')\">".ucfirst(strtolower($_SESSION['name']))."</a></div>";
			?>
		</div>
    </div>
    <div id="box">
	<div id="left" class="left">
        <div id="logo">
            <img src="/include/img/Zoidberg.png" onclick="openMenu()" id="toggle-open" title="Open menu" />
            <img src="/include/img/Zoidberg.png" onclick="closeMenu()" id="toggle-close" title="Close menu" />
        </div>
        <div id="menu">
            <div id="scroll_menu">
            <?php
            foreach($link as $place => $val) {
                if($val['app'] == 'id') {
                    $onclick = ';copyValue();';
                } else {
                    $onclick = '';
                }
                echo "\t\t\t<div id=\"menu_item\" class=\"menu_item\">\n";
                echo "\t\t\t\t<a href=\"/#".$val['app']."\" onclick=\"changeFrame('".$val['app']."')".$onclick."\">\n";
                echo "\t\t\t\t\t<img id=\"Icon_".$val['app']."\" class=\"icon\" src=\"".$val['icon']."\" title=\"".$val['name']."\" />\n";
                echo "\t\t\t\t\t<span class=\"menu_text\"> ".$val['name']." </span>\n";
                echo "\t\t\t\t</a>\n";
                echo "\t\t\t</div>\n";
            } ?>
            </div>
            <div id='options' class="options">
                <?php if($_SESSION['rights'] == 'admin') { ?><div id="menu_item" class="menu_item">
                    <a href="/#Settings" onclick="changeFrame('Settings')">
                        <img class="icon" src="/include/img/icons/settings.png" title="Settings" /> 
                        <span class="menu_text"> Settings </span>
                    </a>
                </div><?php } ?>
                <div id="menu_item" class="menu_item">
                    <a href="javascript:void(0)" onclick="refreshPage()">
                        <img class="icon" src="/include/img/icons/refresh.png" title="Refresh page" /> 
                        <span class="menu_text"> Refresh page </span>
                    </a>
                </div>
                <div id="menu_item" class="menu_item">
    		        <a href="/?logout" onclick="">
                        <img class="icon" src="/include/img/icons/logout.png" title="Logout" /> 
                        <span class="menu_text"> Logout </span>
                    </a>
                </div>
            </div>
        </div>
                <span id="copyright">
                    <a href="https://vdwielen.eu/" target="_blank">ZoidbergNet &copy; <?=date('Y')?></a>
                </span>
	</div>
    <div id="right">
<?php
        foreach($link as $place => $val) {
            echo "\t\t<embed id=\"".$val['app']."\" src=\"".$val['url']."\" type=\"text/html\"></embed>\n";
        } 
    ?>
        <embed id="Settings" src="/include/pages/settings.php" type="text/html"></embed>
    </div>
    
    </div>
    <input id="Copy_this_Value" style="display: none; font-size: 0px;" value="">
    <div id="user_menu">
        <a style="float: right; margin-right:15px; margin-top: 10px;" href="javascript:void(0)" onclick="toggleUserMenu('close')">X</a>
    </div>
</body>
<?php
} 
} 
?>
</html>
