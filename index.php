<html>
   <head>
	<link rel="icon" href="/include/img/favicon.png" sizes="32x32" type="image/png" />
  	<link rel="icon" href="/include/img/favicon.ico" sizes="32x32" type="image/x-icon" />
    	<link rel="shortcut icon" href="/include/img/favicon.png" sizes="32x32" type="image/png" />
    	<link rel="shortcut icon" href="/include/img/favicon.ico" sizes="32x32" type="image/x-icon" />
<?php
session_start();
include("include/assests/login.php");
include("include/assests/functions.php");
include("include/assests/headers.php");
      
if($validUser) {
?>
  	<title>ZoidbergNet: <?php echo $link['1']['name']; ?></title>
    <?php
        include("include/assests/style.css.php");
        include("include/assests/functions.js.php");
    ?>
  </head>
  <body onload="changeOnLoad()">
    <div id="top">
        ZoidbergNet: 
        <span id="tilte"><?php echo $link['1']['name']; ?></span>
        <div id="user_info">
            <?php include("include/assests/user_icon.php"); ?>
		</div>
    </div>
    <div id="box">
	<div id="left" class="left">
        <div id="logo">
            <img src="/include/img/Zoidberg.png" onclick="openMenu()" id="toggle-open" title="Open menu" />
            <img src="/include/img/Zoidberg.png" onclick="closeMenu()" id="toggle-close" title="Close menu" />
        </div>
        <div id="menu">
            <?php include("include/assests/menu.php"); ?>
        </div>
        <span id="copyright">
            <a href="https://vdwielen.eu/" target="_blank">ZoidbergNet &copy; <?=date('Y')?></a>
        </span>
	</div>
    <div id="right">
            <?php include("include/assests/pages.php"); ?>
    </div>
    
    </div>
    <input id="Copy_this_Value" style="display: none; font-size: 0px;" value="">
    <div id="user_menu">
        <a style="float: right; margin-right:15px; margin-top: 10px;" href="javascript:void(0)" onclick="toggleUserMenu('close')">X</a>
    </div>
  </body>
<?php
} 
?>
</html>
