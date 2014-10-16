<?php

class isPaid{

	public function __construct(Connection $Conn,$MovieID,$userID)
	{
		
		$Q_Prepare = $Conn->prepare("SELECT * FROM `payments` WHERE `user_id` = '?' AND (((`type` = '?' OR `type` = '?' OR `type` = '?') AND `due_date` >= '?') OR ((`type` = '?' AND `movie_id` = '?') OR ((`type` = '?' AND `movie_id` = '?') AND `due_date` >= '?')))");

		$DueDate = date("Y-m-d H:i:s",mktime("23","59","59",date("m"),date("d"),date("Y")));

		$Q = $Conn->Query(array($_SESSION["uid"],1,2,3,$DueDate,5,$MovieID,4,$MovieID,$DueDate));

		if(mysql_num_rows($Q)>=1){

			return TRUE;

		}else{

			return FALSE;

		}

	}

}

//$isPaid = new isPaid(1,1);

?>