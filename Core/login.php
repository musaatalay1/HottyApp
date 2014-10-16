<?php

	header("Content-type: text/xml; charset=utf-8");

	require_once 'start.php';

	$q = $Connection->Query("SELECT * FROM `users` WHERE `username` = '?' AND `password` = '?'",array($_POST["username"],md5($_POST["password"])));

	if(mysql_num_rows($q)<=0){

		echo "<sess><status>none</status><mess>".$language["invalid_login"]."</mess></sess>";

	}else{

		$fetch = mysql_fetch_object($q);
		
		$_SESSION["u"] = $fetch->username;

		$_SESSION["p"] = $fetch->password;

        $_SESSION["uid"] = $fetch->user_id;

		echo "<sess>";
		echo "<status>ok</status>";
        echo "<user_id>".$fetch->user_id."</user_id>";
		echo "<username>".$fetch->username."</username>";
		echo "<password>".$fetch->password."</password>";
		echo "<life>".(time()+(604800*4))."</life>";
		echo "<domain>".$_SERVER["HTTP_HOST"]."</domain>";
		echo "</sess>";

	}

?>