<?php
    $style = 'position: absolute; 
    bottom: 0; 
    right: 0; 
    margin auto;
    border-top-left-radius: 10px; 
    border-top: 2px rgba(147, 147, 147, 0.7) groove; 
    border-left: 2px rgba(147, 147, 147, 0.7) groove; 
    width: 200px; 
    height: 25px; 
    padding-top: 5px; 
    text-align: center;   
    font-weight: bolder;
    background-color: rgba(255,25,25,0.9); 
    color: rgba(255,255,255,0.8);
    z-index: 9;';
    $cur_version = file_get_contents('include/conf/version');
    $git_version = file_get_contents('https://raw.githubusercontent.com/cookie050/ZoidbergNet/main/include/conf/version');
    if($cur_version < $git_version) {
        echo '<div style="'.$style.'"><a style="text-decoration: none;" href="https://github.com/cookie050/ZoidbergNet/" target="_blank">Update available!</a></div>';
    } elseif($cur_version > $git_version) {
        die("Something went wrong, stop fucking arround in the files. You can break it.");
    } elseif($cur_version == $git_version) {
    }
?>
