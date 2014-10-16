<?php

	//$f = fopen("video.mp4","r");

	//$c = base64_encode(fread($f, filesize("video.mp4")));

	//echo "<textarea cols='59' rows='5'>".$c."</textarea>"

	header("Content-type:video/mp4");
	header('Accept-Ranges: bytes');
	header('Content-disposition: inline;filename="video.mp4"');

	 header('Content-Transfer-Encoding: binary');
	  header('Expires: 0');
	  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	  header('Pragma: public');
	  header('Content-Length:'.filesize("video.mp4"));
	  header('Connection: close');

	  ob_clean();
	  flush();

	//echo fread($f, filesize("video.mp4"));

	//header("Location:video.mp4");

	exit(file_get_contents("video.mp4"));

?>