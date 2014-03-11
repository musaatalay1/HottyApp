<?php

	$metin = file_get_contents("http://vk.com/video_ext.php?oid=242260463&id=167902734&hash=ebd68be7fbc993ef&hd=2");

	$aranan = '/<param name=\"flashvars\" value=\"(.*)\"><\/param>/';

	preg_match($aranan, $metin, $sonuc);

	//echo $sonuc[1];

	$vLink = "/url240=(.*)240\.mp4/";

	preg_match($vLink, $sonuc[1], $video_url);

	echo $video_url[1];

?>