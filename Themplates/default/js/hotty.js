function triggerEvent(el, type)
{
    if ((el[type] || false) && typeof el[type] == 'function')
    {
        el[type](el);
    }
}
function adaptPortfolio(){
		
		$('.portfolioTwoWrapper').css('width', $('.portfolioTwoPageWrapper').width() - 12);
		$('.portfolioTwoFilterableWrapper .portfolioFilterableItemsWrapper').css('width', $('.portfolioTwoFilterablePageWrapper').width() - 12);
		$('.recentProjects').css('width', $('.recentProjectsOuterWrapper').width() + 36);
		
		var portfolioTwoItemWidth = ($('.portfolioTwoPageWrapper').width() - 48 - 36)/2;
		var portfolioTwoFilterableItemWidth = ($('.portfolioTwoFilterablePageWrapper').width() - 48 - 36)/2;
		var recentProjectItemWidth = ($('.recentProjectsOuterWrapper').width() - 36)/2;
		
		$('.portfolioTwoItemWrapper').css('width', portfolioTwoItemWidth);
		$('.portfolioTwoFilterableWrapper .portfolioFilterableItemWrapper').css('width', portfolioTwoFilterableItemWidth);
		$('.recentProject').css('width', recentProjectItemWidth);
		
	};
function transparentLoading(){
    
    var transparentLoadingDiv = document.createElement("div");

    transparentLoadingDiv.setAttribute("class","transparentLoadingDiv");

    var transparentLoadingImg = document.createElement("img");

    transparentLoadingImg.setAttribute("class","transparentLoadingImg");

    transparentLoadingImg.setAttribute("src","Themplates/default/images/colorbox/loading.gif");

    transparentLoadingDiv.appendChild(transparentLoadingImg);

    document.body.appendChild(transparentLoadingDiv);

}

function removeTransparentLoading(){
    
    document.body.removeChild(document.getElementsByClassName("transparentLoadingDiv")[0]);

}

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
        /*
        var div = document.createElement("div");

        div.setAttribute("class","loading-div");

        var img = document.createElement("img");

        img.setAttribute("class","loading-gif");

        img.setAttribute("src","Themplates/default/images/loading.gif");

        var body = document.body;

        div.appendChild(img);

        body.appendChild(div);*/

        transparentLoading();

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

                    var ui = xmldoc.getElementsByTagName("user_id")[0].childNodes[0].nodeValue;

                    docCookies.setItem("u", u, l, "/");

                    docCookies.setItem("p", p, l, "/");

                    docCookies.setItem("uid", p, l, "/");

                    setTimeout(function () { document.location.href = "/"; }, 2000);

                } else {

                    var m = xmldoc.getElementsByTagName("mess")[0].childNodes[0].nodeValue;

                    //document.body.removeChild(document.body.getElementsByClassName("loading-div")[0]);

                    removeTransparentLoading();

                    var alert = '<div class="alertBox alertBoxStop"><p class="alertBoxContent">' + m + '</p></div>';

                    document.body.getElementsByClassName("alert")[0].innerHTML = alert;

                }

            }

        }

    }

    function callCategoryPageNumbers(category, page) {

        var postData = "category_id=" + category + "&page=" + page;

        var port = sock("POST", "Core/categoryPageNumber.php", true, postData);

        port.onreadystatechange = function () { //alert(port.responseText);

            if (port.readyState == 4 && port.status == 200) {

                var bodyElement = document.getElementsByClassName("pageNumbersWrapper")[0];

                var htmlData = "";

                var xmldoc = port.responseXML;

                var num = xmldoc.getElementsByTagName("num")[0].childNodes[0].nodeValue;

                if (num == 1) {

                    htmlData += '<span class="pageNumber currentPageNumber">1</span>';

                }

                if (num >= 2) {

                    for (var i = page; i < num; i++) {

                        if (i > 5) {

                            if (i < num) {

                                htmlData += '<span class="pageNumber">...</span>';

                            }

                            if (page >= 2) {

                                htmlData += '<a href="javascript:runCategory('+category+','+(i-2)+');return false;" class="pageNumber">«</a>';

                            } else {

                                htmlData += '<span class="pageNumber">«</span>';

                            }

                            if (i < num) {

                                htmlData += '<a href="javascript:runCategory('+category+','+i+');return false;" class="pageNumber">»</a>';

                            } else {

                                htmlData += '<span class="pageNumber">»</span>';

                            }

                            break;

                        }

                        if (i == page) {

                            htmlData += '<span class="pageNumber currentPageNumber">' + i + '</span>';

                        } else {

                            htmlData += '<a href="javascript:runCategory('+category+','+i+');return false;" class="pageNumber">' + i + '</a>';

                        }

                    }

                }

                bodyElement.innerHTML = htmlData;

                //alert(bodyElement);

            }

        }

    }


    function callWatchLaterPageNumbers(page) {

        var postData = "page=" + page;

        var port = sock("POST", "Core/watchLaterPageNumber.php", true, postData);

        port.onreadystatechange = function () { //alert(port.responseText);

            if (port.readyState == 4 && port.status == 200) {

                var bodyElement = document.getElementsByClassName("pageNumbersWrapper")[0];

                var htmlData = "";

                var xmldoc = port.responseXML;

                var num = xmldoc.getElementsByTagName("num")[0].childNodes[0].nodeValue;

                if (num == 1) {

                    htmlData += '<span class="pageNumber currentPageNumber">1</span>';

                }

                if (num >= 2) {

                    for (var i = page; i < num; i++) {

                        if (i > 5) {

                            if (i < num) {

                                htmlData += '<span class="pageNumber">...</span>';

                            }

                            if (page >= 2) {

                                htmlData += '<a href="javascript:runWatchLater('+(i-2)+');return false;" class="pageNumber">«</a>';

                            } else {

                                htmlData += '<span class="pageNumber">«</span>';

                            }

                            if (i < num) {

                                htmlData += '<a href="javascript:runWatchLater('+i+');return false;" class="pageNumber">»</a>';

                            } else {

                                htmlData += '<span class="pageNumber">»</span>';

                            }

                            break;

                        }

                        if (i == page) {

                            htmlData += '<span class="pageNumber currentPageNumber">' + i + '</span>';

                        } else {

                            htmlData += '<a href="javascript:runWatchLater('+i+');return false;" class="pageNumber">' + i + '</a>';

                        }

                    }

                }

                bodyElement.innerHTML = htmlData;

                //alert(bodyElement);

            }

        }

    }

function runCategory(category,page){

    transparentLoading();

    var postData = "category_id="+category+"&page="+page;
    
    var port = sock("POST", "Core/category.php", true, postData);

    port.onreadystatechange = function () { //alert(port.responseText);

        if (port.readyState == 4 && port.status == 200) {

            var xmldoc = port.responseXML;

            //alert(xmldoc.getElementsByTagName("movie").length);

            var movie = xmldoc.getElementsByTagName("movie");

            var status = xmldoc.getElementsByTagName("status")[0].childNodes[0].nodeValue;

            var bodyElement = document.getElementsByClassName("portfolioTwoFilterableWrapper")[0];

            if (movie.length <= 0) {

                //var bodyElement = document.getElementsByClassName("portfolioTwoFilterableWrapper");

                bodyElement.innerHTML = '<div class="alertBox alertBoxWarning"><p class="alertBoxContent">' + xmldoc.getElementsByTagName("mess")[0].childNodes[0].nodeValue + '</p></div>';

                removeTransparentLoading();

            } else {

                //var bodyElement = document.getElementsByClassName("portfolioFilterableItemsWrapper");

                var itemsDiv = document.createElement("div");

                itemsDiv.setAttribute("class", "portfolioFilterableItemsWrapper");

                itemsDiv.setAttribute("id", "portfolioFilterableItemsWrapper");

                itemsDiv.setAttribute("style", "width: 1339px;");

                var htmlData = '';

                for (var i = 0; i < movie.length; i++) {

                    var movie_mod = movie[i].getElementsByTagName("movie_mod")[0].childNodes[0].nodeValue;

                    var movie_id = movie[i].getElementsByTagName("movie_id")[0].childNodes[0].nodeValue;

                    var movie_thumb = movie[i].getElementsByTagName("movie_thumb")[0].childNodes[0].nodeValue;

                    var movie_name = movie[i].getElementsByTagName("movie_name")[0].childNodes[0].nodeValue;

                    htmlData += '<div class="portfolioFilterableItemWrapper" data-type="' + movie_mod + '"> <a href="movie&view-' + movie_id + '" class="portfolioFilterableItemImageWrapper"><img src="' + movie_thumb + '" alt=""/></a><div class="portfolioFilterableItemInfoWrapper"><h4 class="portfolioFilterableItemTitle">' + movie_name + '</h4></div></div>';

                }

                htmlData += "</div>";

                itemsDiv.innerHTML = htmlData;

                bodyElement.appendChild(itemsDiv)

                adaptPortfolio();

                removeTransparentLoading();

            }

        }

    }

    callCategoryPageNumbers(category,page);

}

function runWatchLater(page){

    transparentLoading();

    var postData = "page="+page;
    
    var port = sock("POST", "Core/watch_later.php", true, postData);

    port.onreadystatechange = function () { //alert(port.responseText);

        if (port.readyState == 4 && port.status == 200) {

            var xmldoc = port.responseXML;

            //alert(xmldoc.getElementsByTagName("movie").length);

            var movie = xmldoc.getElementsByTagName("movie");

            var status = xmldoc.getElementsByTagName("status")[0].childNodes[0].nodeValue;

            var bodyElement = document.getElementsByClassName("portfolioOneWrapper")[0];

            if (movie.length <= 0) {

                bodyElement.innerHTML = '<div class="alertBox alertBoxWarning"><p class="alertBoxContent">' + xmldoc.getElementsByTagName("mess")[0].childNodes[0].nodeValue + '</p></div>';

                removeTransparentLoading();

            } else {

                var htmlData = '';

                for (var i = 0; i < movie.length; i++) {

                    var movie_id = movie[i].getElementsByTagName("movie_id")[0].childNodes[0].nodeValue;

                    var list_id = movie[i].getElementsByTagName("list_id")[0].childNodes[0].nodeValue;

                    var movie_name = movie[i].getElementsByTagName("movie_name")[0].childNodes[0].nodeValue;

                    var movie_thumb = movie[i].getElementsByTagName("movie_thumb")[0].childNodes[0].nodeValue;

                    var remove_text = movie[i].getElementsByTagName("remove_text")[0].childNodes[0].nodeValue;

                    var watch_text = movie[i].getElementsByTagName("watch_text")[0].childNodes[0].nodeValue;

                    htmlData += '<div class="portfolioOneItemWrapper"> <a href="movie&view-' + movie_id + '" class="portfolioOneItemImageWrapper"><img src="' + movie_thumb + '" alt="' + movie_name + '"/></a><div class="portfolioOneItemInfoWrapper"><h4 class="portfolioOneItemTitle">' + movie_name + '</h4></div><div class="portfolioOneItemButtonsWrapper"><a href="javascript:removeWatchLater(' + list_id + ',this);" class="portfolioOneDeleteButton">' + remove_text + '</a><a href="movie&view-' + movie_id + '" class="portfolioOneDetailsButton">' + watch_text + '</a></div></div>';

                }

                bodyElement.innerHTML=htmlData;

                //adaptPortfolio();

                removeTransparentLoading();

            }

        }

    }

    callWatchLaterPageNumbers(page);

}

function removeWatchLater(el,list_id){

	

}
