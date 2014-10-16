<?php

    error_reporting(FALSE);    

    ob_start();

    header("Content-type: text/xml; charset=utf-8");

	require_once 'start.php';

    $page = $_REQUEST["page"];

    $_LIMIT_ = 12;

    settype($page,int);

    $START = (($page-1)*12);

    $q = $Connection->Query("SELECT * FROM `movies` WHERE `category` = '?' ORDER BY `id` ASC LIMIT ".$START.",".$_LIMIT_,array($_REQUEST["category_id"]));

    if(mysql_num_rows($q)<=0){

		echo "<list>
                <status>none</status>
                <mess>".$language["data_not_found"]."</mess>
            </list>";

	}else{
	    
        echo "<list>";
        echo "<status>ok</status>";
        while($fetch=mysql_fetch_object($q)){

            $mod = "paid";

            if($mod==2){
                
                $mod = "free";

            }

            echo "<movie>";

            echo "<movie_id>".$fetch->id."</movie_id>";

            echo "<movie_name>".$fetch->name."</movie_name>";

            echo "<movie_thumb>".$fetch->thumb."</movie_thumb>";

            echo "<movie_mod>".$mod."</movie_mod>";

            echo "</movie>";

        }

        echo "</list>";

	}

?>