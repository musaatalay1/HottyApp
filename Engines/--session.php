<?php
	
	class Session{
		/*
		private $u;
		private $p;
		
		function __construct(){
			
			$this->u = $_SESSION["u"];
			
			$this->p = $_SESSION["p"];
			
		}
		*/
		
		function control(){

                //try{
                
                    if((!isset($_SESSION["u"])||empty($_SESSION["u"]))||(!isset($_SESSION["p"])||empty($_SESSION["p"]))){
				
				        if((!isset($_COOKIE["u"])||empty($_COOKIE["u"]))||(!isset($_COOKIE["p"])||empty($_COOKIE["p"]))){
					
					        header("Location:login?page=".$_SERVER['SCRIPT_NAME']."&query_string=".urlencode($_SERVER['QUERY_STRING']));
					
				        }else{
				
					        $_SESSION["u"] = $_COOKIE["u"];
				
					        $_SESSION["p"] = $_COOKIE["p"];
					
				        }
				
			        }else{
			
				        return TRUE;
				
			        }else{
			            
                        return FALSE;

			        }

                 /*throw new Exception ( 'MySQL Kullanıcı bulunamadı' );

            }catch(Exception $istisna){
                
                echo $istisna->getMessage();

            }*/

		}
		
		function login($u,$p,$r="false"){
		
			$isset_user = mysql_query("SELECT * FROM users WHERE username = '".mysql_real_escape_string($u)."' AND password = '".md5($p)."'");
			
			if($isset_user){
			
				$_SESSION["u"] = $u;
				
				$_SESSION["p"] = md5($p);
				
				if($r="true"){
					
					setcookie("u",$u,(time()+(60*60*24*365)),"/");
					
					setcookie("p",md5($p),(time()+(60*60*24*365)),"/");
						
				}
				
				$page = $_GET["page"];
				
				if(empty($page)){
				
					$page = "index.html";
					
				}
				
				header("Location: "+$_GET["page"]."?".urldecode($_GET["query_string"]));
				
			}
			
		}
		
		function logout(){
			
			$_SESSION["u"]=NULL;
			
			$_SESSION["p"]=NULL;
			
			$_COOKIE["u"]=NULL;
			
			$_COOKIE["p"]=NULL;
			
			session_destroy();
			
			header("Location:login");
			
		}
			
	}
	
?>