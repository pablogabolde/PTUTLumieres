<?php 
	class Connexion{
		private $_connexion;
		public function __construct(){
			$this->_connexion = new PDO('mysql:host=localhost;dbname=fetedeslumieres;charset=utf8','root','');
		}

		function getConnexion(){
			return $this->_connexion;
		}
	}
?>