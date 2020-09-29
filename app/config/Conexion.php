<?php
class Conexion{
    protected $conn;
 	private $url="localhost";
	private $user="root";
	private $pass="Francisco100";
	private $db="aulas4";
		
	protected function abrirConexion(){
    
 		$this->conn=null;
		
			try {
			//$this->conn = new PDO("mysql:host=localhost;dbname=dbproyecto","root","Francisco100");	
			
			
		    $this->conn= new PDO("mysql:host=".$this->url.";dbname=".$this->db,
			$this->user,$this->pass,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ) );
					
			} catch (PDOException $e) {
				$msg['message']="Connection error : ".$e->getMessage();
				echo json_encode($msg);
				
				die();
			}
			return $this->conn;


		 } //cierre de llave de la function conexion()


		 public function set_names(){

		 	return $this->dbh->query("SET NAMES 'utf8'");
		 }


		 public function ruta(){
            
             
		 }
}

?>