<?php



	class Language{

	

		private $return=array();

		

		function __construct(){

			

			$this->return["index"] = "Ana Sayfa";

			$this->return["profile"] = "Profil";	

			$this->return["categories"] = "Kategoriler";

			$this->return["page_adult"] = "Adult Sex Videoları";

			$this->return["page_virgin"] = "Bakire Videoları";

			$this->return["page_gay"] = "Gay Videoları";

			$this->return["page_lesbian"] = "Lezbiyen Videoları";

			$this->return["page_group"] = "Grup Sex Videoları";

			$this->return["page_couple"] = "Swinger Videoları ";

			$this->return["page_housewife"] = "Ev Kadını Videoları";

			$this->return["contact_us"] = "İletişim";		

			$this->return["langs"] = "Diller";	

			$this->return["videos"] = "Videolar";		

			$this->return["watch"] = "İzle";

			$this->return["buy"] = "Satın Al";

			$this->return["rent"] = "Kirala";	

			$this->return["play"] = "Oynat";	

			$this->return["stop"] = "Durdur";

			$this->return["pause"] = "Duraklat";	

			$this->return["back"] = "Geri";

			$this->return["next"] = "İler";	

			$this->return["previous"] = "Önceki";

			$this->return["forward"] = "Sonraki";

            $this->return["sign_in"] = "Giriş Yap";

			$this->return["submit"] = "Gönder";

			$this->return["username"] = "Kullanıcı Adı";

			$this->return["password"] = "Şifre";

			$this->return["invalid_login"] = "Kullanıcı bilgileri hatalı!";

            $this->return["not_found"] = "Sayfa Bulunamadı!";

            $this->return["required_username"] = "Lütfen kullanıcı adınızı giriniz!";

            $this->return["required_password"] = "Lütfen şifrenizi giriniz!";

			

		}

		

		function get(){

			

			return $this->return;	

				

		}



	}



?>

