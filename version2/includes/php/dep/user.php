<?php
class User {
	private $username;
	private $password;
	private $group;

	function __construct($username, $password, $group) {
		$this->username = $username;
		$this->password = $password;
		$this->group = $group;
	}

	
	function __destruct() {
        $username = "";
        $password = "";
        $group = "";
	}

}

?>