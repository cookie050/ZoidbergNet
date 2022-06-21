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