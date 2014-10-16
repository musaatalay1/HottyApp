<?php

    error_reporting(FALSE);    

    ob_start();

    session_start();

    if((!isset($_GET["watching_key"])||empty($_GET["watching_key"]))||!isset($_GET["movie_id"])||empty($_GET["movie_id"])){

        header("Location:/err404&[view]");

        exit("Page Not Found");

    }

    require_once "../Engines/isWatchKey.php";

    $keyController = new keyController($_REQUEST["watching_key"]);

    if($keyController==FALSE){
        
        header("Location:/err404&[view]");

        exit("Page Not Found");

    }

    $q = $Connection->Query("SELECT * FROM `movies` WHERE `id` = '?'",array($_REQUEST["movie_id"]));

    if(mysql_num_rows($q)<=0){

        header("Content-type: text/xml; charset=utf-8");
        
        echo "<list>
            <status>none</status>
            <mess>".$language["movie_has_been_removed"]."</mess>
        </list>";

    }else{

        $fetch = mysql_fetch_object($q);
        
        $classes = array("1"=>"video_package","2"=>"video_blob");

        require_once $classes[$fetch->class].'.php';

        $video = new Video($fetch->id); //This will return a variable as Array. => [0]=>Should Pay For Ful Video?{1=Yes;2=No(Was Paid)}, [1]=>Video Url For Player(İf has been full account, it will get the full url or it will get the Trailer Vide Url)

        /*
        echo "<list>";

        if($video[0]=1){
            
            echo "<full>no</full>";

        }

        if($video[0]=2){
            
            echo "<full>yes</full>";

        }

        echo "<movie_url>".$video[1]."</movie_url>";
        echo "</list>";
        */

    }

?>