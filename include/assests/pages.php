        <?php
        foreach($link as $place => $val) {
            echo "\t\t<embed id=\"".$val['app']."\" src=\"".$val['url']."\" type=\"text/html\"></embed>\n";
        } ?>
        <embed id="Settings" src="/include/pages/settings.php" type="text/html"></embed>