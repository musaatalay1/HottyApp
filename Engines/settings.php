<?php

    

    class Settings{

        //public $theme;

    	public $settings;

        function __construct($obj){
            

            //$this->theme = "default";

            $this->settings = mysql_fetch_object($obj->Query("SELECT * FROM `settings` WHERE id = '?'",array(1)));



        }



    }



?>