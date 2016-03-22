<?php
/**
 * This class will be needed for connection to the database and hashing the passwords
 */
class Config {
	public static function dbConnect() {
		return mysqli_connect("localhost", "root", "therealsam", "rapandoc_misn");
	}

	public static function passHasher($pass, $salt) {
		return hash('sha256', $pass).$salt;
	}

	public static function saltGenerator() {
		$no = rand(23754, 843743);
		return substr(hash('sha512', $no), 2, 34);
	}

}

?>