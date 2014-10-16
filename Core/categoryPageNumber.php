<?php

    error_reporting(FALSE);    

    ob_start();

    header("Content-type: text/xml; charset=utf-8");

	require_once 'start.php';

    $page = $_REQUEST["page"];

    $_LIMIT_ = 12;

    settype($page,int);

    $START = (($page-1)*12);

    $q = $Connection->Query("SELECT * FROM `movies` WHERE `category` = '?' ORDER BY `id` ASC",array($_REQUEST["category_id"]));

    echo "<list>";

    if(mysql_num_rows($q)<=0){
        
        echo "<num>0</num>";

    }else{

        $num = ceil((mysql_num_rows($q)/$_LIMIT_));

        echo "<num>".$num."</num>";

    }

    echo "</list>";