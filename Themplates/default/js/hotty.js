function sock(m, u, b, d) {

                t = "html";

                var socket;

                if (window.XMLHttpRequest) { socket = new XMLHttpRequest(); } else { socket = new ActiveXObject("Microsoft.XMLHTTP"); }

                socket.open(m, u, b);

                socket.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                socket.send(d);

                return socket;

            }

            function login(){

                var username = document.querySelector("input[type='text'][name='username']").value;

                var password = document.querySelector("input[type='password'][name='password']").value;

                if(username.length<=4){

                    var u = document.getElementById("contactNameFieldError");

                    u.style.display="block";

                    setTimeout(function(){u.style.display="none";},2500);

                    return false;

                }

                if(password.length<=8){

                    var p = document.getElementById("contactPasswordFieldError");

                    p.style.display="block";

                    setTimeout(function(){p.style.display="none";},2500);

                    return false;

                }

                var div = document.createElement("div");

                div.setAttribute("class","loading-div");

                var img = document.createElement("img");

                img.setAttribute("class","loading-gif");

                img.setAttribute("src","Themplates/default/images/loading.gif");

                var body = document.body;

                div.appendChild(img);

                body.appendChild(div);

                var postData = "username="+username+"&password="+password;

                var port = sock("POST", "start.php?p=login&c=query", true, postData);

                port.onreadystatechange = function () {

                    if (port.readyState == 4 && port.status == 200) {

                        var xmldoc = port.responseXML;

                        var status = xmldoc.getElementsByTagName("status")[0].childNodes[0].nodeValue;

                        if (status == "ok") {

                            var u = xmldoc.getElementsByTagName("username")[0].childNodes[0].nodeValue;

                            var p = xmldoc.getElementsByTagName("password")[0].childNodes[0].nodeValue;

                            var l = xmldoc.getElementsByTagName("life")[0].childNodes[0].nodeValue;

                            var d = xmldoc.getElementsByTagName("domain")[0].childNodes[0].nodeValue;

                            docCookies.setItem("u", u, l, "/");

                            docCookies.setItem("p", p, l, "/");

                            setTimeout(function(){document.location.href="/";},2000);

                        } else {

                            var m = xmldoc.getElementsByTagName("mess")[0].childNodes[0].nodeValue;

                            document.body.removeChild(document.body.getElementsByClassName("loading-div")[0]);

                            var alert = '<div class="alertBox alertBoxStop"><p class="alertBoxContent">'+m+'</p></div>';

                            document.body.getElementsByClassName("alert")[0].innerHTML = alert;

                        }

                    }

                }

            }