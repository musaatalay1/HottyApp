<?php

    //error_reporting(FALSE);    

    //ob_start();

    //session_start();

    require_once "Engines/isWatchKey.php";

    $keyController = new keyController;

    $keyControl = $keyController->Control($Connection,$_GET["token"]);

    if((!isset($_GET["token"])||empty($_GET["token"]))||$keyControl==FALSE){

        header("Location:/err404&[view]");

        exit("Page Not Found");

    }

    /*require_once "Engines/isWatchKey.php";

    $keyController = new keyController;

    $keyControl = $keyController->Control($Connection,$_GET["token"]);

    if($keyControl==FALSE){
        
        header("Location:/err404&[view]");

        exit("Page Not Found");

    }*/

    require_once "Engines/isPaid.php";

    $payController = new isPaid($Connection,$keyControl->movie_id,$_SESSION["uid"]);

    $Q_Movie = mysql_fetch_object($Connection->Query("SELECT * FROM `movies` WHERE `id` = '?'",array($keyControl->movie_id)));

    mysql_close();

    if($payController){

        header("Location:".$Q_Movie->full_url);

    }else{

        header("Location:".$Q_Movie->trailer_url);

    }

?>