<?php

    class Session{
        
        function __construct(){
            


        }

        public function control(){
            
            if((!isset($_SESSION["u"])||empty($_SESSION["u"]))||(!isset($_SESSION["p"])||empty($_SESSION["p"]))){
                
                if((!isset($_COOKIE["u"])||empty($_COOKIE["u"]))||(!isset($_COOKIE["p"])||empty($_COOKIE["p"]))){
                    
                    return FALSE;

                }else{
                    
                    $_SESSION["u"] = $_COOKIE["u"];
				
                    $_SESSION["p"] = $_COOKIE["p"];
                    
                    $_SESSION["uid"] = $_COOKIE["uid"];

                    return TRUE;

                }

            }else{
                
                return TRUE;

            }

        }

    }    

?>