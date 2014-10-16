<?php

    header("Content-type: text/xml; charset=utf-8");

	require_once 'start.php';

    if(strlen($language[$_REQUEST["word"]])<=0){

		echo "<lang><status>none</status></lang>";

	}else{
	    
        echo "<lang>";
        echo "<status>ok</status>";
        echo "<found>".$language[$_REQUEST["word"]]."</found>";
        echo "</lang>";

    }

?>