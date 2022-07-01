<?php
    $conf_file = "../conf/pages.json";
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
        $config = getConfig($conf_file);
        $c = count($config);
        for ($i = 0; $i <= $c; $i++) {
            foreach($config[$i] as $sleutel => $waarde) {
                if($sleutel == 'placement'){
                    $place = $waarde;
                }
                if($sleutel == 'name') {
                    $link[$place]['name'] = $waarde;
                }
                if($sleutel == 'app') {
                    $link[$place]['app'] = $waarde;
                }
                if($sleutel == 'url') {
                    $link[$place]['url'] = $waarde;
                }
                if($sleutel == 'icon') {
                    $link[$place]['icon'] = $waarde;
                }
            }
        }
        ksort($link);
        function replace_in_array($array, $old_value, $new_value) {
            foreach($array as $key => $value) {
                $value['placement'] = $new_value;
            }
            return $value['placement'];
        }
?>
<html>
    <head>
        <style>
            body {
                background: none;
                color: rgba(255,255,255,0.7);
            }
            #sortlist {
                width: 250px;
            }
            .slist {
                list-style: none;
                padding: 0;
                margin: 0;
            }
            .slist li {
                margin: 10px;
                padding: 15px;
                border: 1px solid #dfdfdf;
                background: #4d4d4d;
            }
            .slist li.hint {
                border: 1px solid #ffc49a;
                background: #6b6c4e;
            }
            .slist li.active {
                border: 1px solid #ffa5a5;
                background: #221e1e;
            }
        </style>
        <script type="application/javascript">
            function slist(target) {
              target.classList.add("slist");
              let items = target.getElementsByTagName("li"), current = null;
              var listOrder = document.querySelector("ul");
              console.log(listOrder);  
              for (let i of items) {
                i.draggable = true;
                i.ondragstart = (ev) => {
                  current = i;
                  for (let it of items) {
                    if (it != current) { it.classList.add("hint"); }
                  }
                };
                i.ondragenter = (ev) => {
                  if (i != current) { i.classList.add("active"); }
                };
                i.ondragleave = () => {
                  i.classList.remove("active");
                };
                i.ondragend = () => { for (let it of items) {
                    it.classList.remove("hint");
                    it.classList.remove("active");
                }};
                i.ondragover = (evt) => { evt.preventDefault(); };
                i.ondrop = (evt) => {
                  evt.preventDefault();
                  if (i != current) {
                    let currentpos = 0, droppedpos = 0;
                    for (let it = 0; it < items.length; it++) {
                      if (current == items[it]) { currentpos = it; }
                      if (i == items[it]) { droppedpos = it; }
                    }
                    if (currentpos < droppedpos) {
                      i.parentNode.insertBefore(current, i.nextSibling);
                      changeList();
                    } else {
                      i.parentNode.insertBefore(current, i);
                      changeList();
                    }
                  }
                };
              }
            }
            function changeList() {
                    const list = document.getElementsByClassName("menu_list")[0];
                    const nodes = list.getElementsByClassName("list_li");
                    const count = nodes.innerHTML = nodes.length;
                    for (var i = 0; i < count; i++) {
                        var c = i;
                        var p = document.getElementsByClassName("list_li")[i].id;
                        document.getElementsByClassName("list_li")[i].id = c;
                        var input = input+'<input type="hidden" name="c'+ p +'" value="'+ p +','+ c +'">';
                    }
                    postChange(input);
                    var listOrder = document.querySelector("ul");    
            }
            function postChange(input_arr) {
                var form_head = '<form id="change" method="post">';
                var form_bottom = '<input name="changed" type="hidden" /></form>';
                document.body.innerHTML += form_head+input_arr+form_bottom;
                document.getElementById("change").submit();
            }
        </script>
    </head>
    <body>
    <table>
        <tr>
            <td style="vertical-align: text-top;">
                <h2>Change order of menu:</h2>
                <ul id="sortlist" class="menu_list">
                  <?php
                    foreach($link as $place => $val) {
                        echo "\t\t\t<li id=\"".$place."\" class=\"list_li\" name=\"".$place."\">".$val['name']."</li>\n";
                    }
                  ?>
                </ul>
            </td>
            <td width="10px;">
                <br />
            </td>
            <td style="vertical-align: text-top;">
                <h2>Add new menu item:</h2>
                <form method="post" id="add_menu_item">
                    <table>
                        <tr>
                            <td width="100px;">Active:</td>
                            <td width="250px;">
                                <input style="width: 250px;" type="text" name="active" placeholder="1" value="1" />
                            </td>
                        </tr>
                        <tr>
                            <td>URL:</td>
                            <td>
                                <input style="width: 250px;" type="text" name="url" placeholder="http://url_here">
                            </td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td>
                                <input style="width: 250px;" type="text" name="name" placeholder="Name of application in ZoidbergNet">
                            </td>
                        </tr>
                        <tr>
                            <td>App:</td>
                            <td>
                                <input style="width: 250px;" type="text" name="app" placeholder="App_link_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Icon link:</td>
                            <td>
                                <input style="width: 250px;" type="text" name="icon" placeholder="Link to icon file">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: right;">
                                <input type="submit" value="Add new menu item" name="add_new" />
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>    
    </table>
        <script  type="application/javascript">
            window.addEventListener("DOMContentLoaded", () => {
                slist(document.getElementById("sortlist"));
            });
        </script>
        <?php
            if(isset($_POST['add_new'])) {
                $c = count($config);
                $config[$c]['placement'] = $c;
                $config[$c]['active'] = $_POST['active'];
                $config[$c]['name'] = $_POST['name'];
                $config[$c]['app'] = $_POST['app'];
                $config[$c]['url'] = $_POST['url'];
                $config[$c]['icon'] = $_POST['icon'];
                ksort($config);
                        $json = json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
                        file_put_contents($conf_file.'.tmp', $json);
                        copy($conf_file.'.tmp', $conf_file);
                        chmod($conf_file.'.tmp', 0766);
                        unlink($conf_file.'.tmp');
                        echo "<pre>";
                            print_r($json);
                        echo "</pre>";
            }
            if(isset($_POST['changed'])) {
                foreach ($_POST as $key => $value) {
                    if($key == 'changed'){
                        
                    } else {
                        $split = explode(",", $value);
                        $old_placement = $split['0'];
                        $new_placement = $split['1'];
                        if($old_placement != $new_placement){
                            $config[$old_placement]['placement'] = $new_placement;
                        }
                        $c = count($config);
                            for ($i = 0; $i <= $c; $i++) {
                                foreach($config[$i] as $sleutel => $waarde) {
                                        if($sleutel == 'placement') {
                                            $pl = $waarde;
                                            $config_2[$pl]['placement'] = $waarde;
                                        }
                                        if($sleutel == 'active') {
                                            $config_2[$pl]['active'] = $waarde;
                                        }
                                        if($sleutel == 'url') {
                                            $config_2[$pl]['url'] = $waarde;
                                        }
                                        if($sleutel == 'name') {
                                            $config_2[$pl]['name'] = $waarde;
                                        }
                                        if($sleutel == 'app') {
                                            $config_2[$pl]['app'] = $waarde;
                                        }
                                        if($sleutel == 'icon') {
                                            $config_2[$pl]['icon'] = $waarde;
                                        }
                                }
                           }
                    ksort($config_2);
                        $json = json_encode($config_2, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
                        file_put_contents($conf_file.'.tmp', $json);
                        copy($conf_file.'.tmp', $conf_file);
                        chmod($conf_file.'.tmp', 0766);
                        unlink($conf_file.'.tmp');
                        echo "<pre>";
                            print_r($json);
                        echo "</pre>";
                }
            }
        }
        ?>
    </body>
</html>
