function port(m,u,b,d,t="html"){

    

                var socket;



                if (window.XMLHttpRequest) { socket = new XMLHttpRequest(); } else { socket = new ActiveXObject("Microsoft.XMLHTTP"); }



                socket.onreadystatechange = function () {


                    if (socket.readyState == 4 && socket.status == 200) {


                        var return_doc = socket.responseText;



                        if(t=="xml"){

                            

                            var return_doc = socket.responseXML;



                        }



                        return Array(socket.readyState, socket.status, return_doc);

                    }

                }



                socket.open(m,u,b);



                socket.setRequestHeader("Content-type", "application/x-www-form-urlencoded");



                socket.send(d);



}



function login(form){



    var username = form.getElementsByName("username");



    var password = form.getElementsByName("password");



    var postData = "username="+username+"&password"+password;



    var post = port("POST","start.php?p=login&c=query")



}