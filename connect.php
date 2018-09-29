<?php
	class Database {
		public $con;
		public function __construct(){
			$this->con = mysqli_connect("localhost", "root", "", "k12admin");
			if (!$this->con) {
				echo "Error in Connecting ".mysqli_connect_error();
			}
		}
	}
?>