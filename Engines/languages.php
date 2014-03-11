<?php

	

	$ip_adresi = GetIP();

	

	$parse = explode(".",$ip_adresi);



    $languages = $Connection->Query("SELECT * FROM languages WHERE ip='?'",array($parse[0]));

	

	if(mysql_num_rows($languages)<=0){


		setcookie("lang","default",(time()+(604800*4)),"/");


		require_once "Languages/default.php";

			

	}else{



		$langs = mysql_fetch_object($languages);

	
		setcookie("lang",$langs->language,(time()+(604800*4)),"/");


		require_once "Languages/".$langs->language.".php";

		

	}



?>