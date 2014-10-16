<?php
    
    error_reporting(FALSE);    

    ob_start();

    header("Content-type: text/xml; charset=utf-8");

	require_once 'start.php';

	$page = $_REQUEST["page"];

    $_LIMIT_ = 12;

    settype($page,int);

    $START = (($page-1)*12);

    $q = $Connection->Query("SELECT * FROM `watch_later` WHERE `user_id` = '?' ORDER BY `id` ASC LIMIT ".$START.",".$_LIMIT_,array($_SESSION["uid"]));

    if(mysql_num_rows($q)<=0){

		echo "<list>
                <status>none</status>
                <mess>".$language["data_not_found"]."</mess>
            </list>";

	}else{
	    
        echo "<list>";

        echo "<status>ok</status>";

        while($fetch=mysql_fetch_object($q)){
            
            $getMovie = mysql_fetch_object($Connection->Query("SELECT * FROM `movies` WHERE `id`='?'",array($fetch->movie_id)));

            echo "<movie>";

            echo "<list_id>".$fetch->id."</list_id>";

            echo "<movie_id>".$fetch->movie_id."</movie_id>";

            echo "<movie_name>".$getMovie->name."</movie_name>";

            echo "<movie_thumb>".$getMovie->thumb."</movie_thumb>";

            echo "<remove_text>".$language["remove"]."</remove_text>";

            echo "<watch_text>".$language["watch"]."</watch_text>";

            echo "</movie>";

        }

        echo "</list>";

	}

?>