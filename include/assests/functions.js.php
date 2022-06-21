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