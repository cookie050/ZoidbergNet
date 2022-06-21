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