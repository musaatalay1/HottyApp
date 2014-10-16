<?php



	class Language{

	

		private $return=array();

		

		function __construct(){

			

			$this->return["index"] = "Home";

			$this->return["profile"] = "Profile";

			$this->return["categories"] = "Categories";	

			$this->return["page_adult"] = "Adult Videos";

			$this->return["page_virgin"] = "Virgin Videos";

			$this->return["page_gay"] = "Gay Videos";

			$this->return["page_lesbian"] = "Lesbian Videos";

			$this->return["page_group"] = "Group Sex Videos";

			$this->return["page_couple"] = "Swingers Videos";

			$this->return["page_housewife"] = "House Wife Sex Videos";

			$this->return["contact_us"] = "Contact Us";		

			$this->return["langs"] = "Languages";	

			$this->return["videos"] = "Videos";		

			$this->return["watch"] = "Watch It";

			$this->return["remove"] = "Remove";

			$this->return["delete"] = "Delete";

			$this->return["buy"] = "Buy";

			$this->return["rent"] = "Rent";	

			$this->return["play"] = "Play";	

			$this->return["stop"] = "Stop";

			$this->return["pause"] = "Pause";	

			$this->return["back"] = "Previous";

			$this->return["next"] = "Forward";	

			$this->return["previous"] = "Back";

			$this->return["forward"] = "Next";

			$this->return["sign_in"] = "Sign In";

			$this->return["submit"] = "Submit";

			$this->return["username"] = "Username";

			$this->return["password"] = "Password";

			$this->return["invalid_login"] = "Cannot found this user!";

			$this->return["required_username"] = "Your username is required!";

			$this->return["required_password"] = "Your password is required!";

            $this->return["all"] = "All";

			$this->return["free"] = "Free";

            $this->return["paid"] = "Paid";

            $this->return["data_not_found"] = "There is not anything to show you!";

            $this->return["movie_has_been_removed"] = "Sory, This movie has been removed!";

		}

		

		function get(){

			

			return $this->return;	

				

		}



	}



?>

