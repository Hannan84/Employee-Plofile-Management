<?php

	class connect{
		public $host="localhost";
		public $username="root";
		public $password="";
		public $database="project";
		public $connect;
		
		public function __construct(){
			$this->connect = new mysqli($this->host,$this->username,$this->password,$this->database);
	//		print_r($this->connect);
			if(!$this->connect){
				echo "Server Busy....";
			}
		}
		
		public function insert($insert){
			$insert = $this->connect->query($insert);
			if(!$insert){
				echo "Server Busy....";
			}
		}
		
		public function update($update){
			$update = $this->connect->query($update);
			if(!$update){
				echo "Server Busy....";
			}
		}
		
		public function select($select){
			$select = $this->connect->query($select);
			return $select;
		}
		
		public function option($select_option){
			$select_option = $this->connect->query($select_option);
			return $select_option;
		}
		
		public function login($login){
			$login = $this->connect->query($login);
			if(mysqli_num_rows($login)==1){
				throw new exception;
			}
		}
	}
	

?>