<?php

class keyController{

	public function Control(Connection $Conn,$Key)
	{

		$Query = $Conn->Query("SELECT * FROM `watching_token` WHERE `key` = '?' AND `user_id` = '?' AND `mod` = '?'",array($Key,$_SESSION["uid"],0));

		if(mysql_num_rows($Query)=="1"){

			$Conn->Query("UPDATE `watching_token` SET `mod` = '?' WHERE `key` = '?'",array(1,$Key));

			return mysql_fetch_object($Query);

		}else{

			return FALSE;

		}

	}

}

?>