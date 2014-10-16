<?php

	

	ob_start();

	

	session_start();

	

    header("Content-type: text/html; charset=utf-8");



    require_once 'Engines/connector.php';

    require_once 'Engines/connection.php';

    //require_once 'Engines/mysql_queries.php';

	require_once 'functions.php';

	require_once 'Engines/languages.php';

	require_once 'Engines/session.php';

    require_once 'Engines/settings.php';



	$Lang = new Language;

	$language = $Lang->get();

    $Settings = new Settings($Connection);

	$Session = new Session;

    try{

        
        if(!isset($_GET["p"])||empty($_GET["p"])){

            $_GET["p"] = "index";

        }

        if(!isset($_GET["c"])||empty($_GET["c"])){

            $_GET["c"] = "view";

        }


        if($Settings->settings->force_to_login==1||$_GET["p"]=="login"||$Session->control()){



            if($_GET["c"]=="view"){


                try{

        

                    $page = 'Themplates/'.$Settings->settings->theme.'/'.$_GET["p"].'.php';



                    if(file_exists($page)){

                        $VideoURL = NULL;

                        if($_GET["p"]=="movie"){

                            $WatchToken = md5($_SESSION["u"].$_SESSION["p"].$_SESSION["uid"].date("Y-m-d-H-i-s"));

                            //$VideoURL = "start.php?p=video&c=query&token=".$WatchToken;

                            $VideoURL = "video-query-".$WatchToken.".mp4";

                            $Connection->Query("INSERT INTO `watching_token`(`key`,`user_id`,`movie_id`) VALUES('?','?','?')",array($WatchToken,$_SESSION["uid"],$_GET["movie_id"]));

                            $Video = $Connection->Q("SELECT * FROM `movies` WHERE `id`='?'",array($_GET["movie_id"]))->fetch_obj();
                        
                        }

                        require_once $page;



                    }else{

            

                        throw new Exception($language["not_found"]);



                    }



                }catch(Exception $Sayfa){

        

                    /*header("Location:err404?".substr(base64_encode($Sayfa->getMessage()),0,(strlen(base64_encode($Sayfa->getMessage()))-0)));*/



                    header("Location:err404&[view]");



                }



            }



            if($_GET["c"]=="query"){

                /*if($_GET["p"]=="video"){

                    require_once "Engines/isWatchKey.php";

                    require_once "Engines/isPaid.php";

                }*/

                require_once "Core/".$_GET["p"].".php";



            }



        }else{

            

            throw new Exception($language["sign_in"]);



        }



    }catch(Exception $Mesaj){

            

            /*header("Location:login?".substr(base64_encode($Mesaj->getMessage()),0,(strlen($Mesaj->getMessage)-1)));*/

            header("Location:login&[view]");

            //exit($settings->force_to_login);



    }

	

?>