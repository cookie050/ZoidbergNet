			<?php 
                if((!empty($_SESSION['picture'])) && (file_exists('.'.$_SESSION['picture']))) {
                    $profile_pic = $_SESSION['picture'];
                } else {
                    $profile_pic = '/include/img/icons/profle.png';
                }
				echo "<div id='user_img'><img id=\"load\" src=\"".$profile_pic."\" height=\"64px\" /></div><br />";
                echo "<div id='user_text'><a href=\"javascript:void(0)\" onclick=\"toggleUserMenu('open')\">".ucfirst(strtolower($_SESSION['name']))."</a></div>";
			?>