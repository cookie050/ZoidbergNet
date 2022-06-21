<?php
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
} else 

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
  	<title>ZoidbergNet: Login</title>
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
?>