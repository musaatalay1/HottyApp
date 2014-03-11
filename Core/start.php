<?php

	ob_start();

	session_start();

	require_once '../Engines/connector.php';

    require_once '../Engines/connection.php';

	require_once '../Languages/'.$_COOKIE["lang"].'.php';

	$Lang = new Language;

	$language = $Lang->get();


?>