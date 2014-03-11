<?php

	

    /*



	$h="localhost";

	$u="hottyapp_hotty";

	$p="Admin4321";

	$d="hottyapp_hotty";

	

	$connection=@mysql_connect($h,$u,$p);

	if($connection){

		

		$select_db=@mysql_select_db($d, $connection);

		if($select_db){

			

			@mysql_query("SET NAMES 'utf8'");

			@mysql_query("SET CHARACTER SET utf8");

			@mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'");

				

		}else{

			

			exit("Hata:Veritabanı seçilemedi!");

			

		}

	

	}else{

			

		exit("Hata:Veritabanı sunucusuna bağlanılamadı!");

			

	}



    */



    $Connection = (new Connection("mysql:dbname=hottyapp_hotty;host=localhost;user=hottyapp_hotty;pass=Admin4321"))->utf8();

	

?>