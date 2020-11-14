<?php

require_once '../app/config/Conexion.php';
class Categoria extends Conexion {

    public function __construct(){
        $this->conectar=parent::abrirConexion();
        
    }
    
    private $conectar;
    private $tabla = "categoria";

    public $returnData = [];

    public function msg($success,$status,$message,$extra=[] ){

        return array_merge([
            'success'=>$success,
            'status'=>$status,
            'message'=>$message
        ],$extra);
    }


    public function listar(){
		
		try{
		
			//$consulta="SELECT *FROM PRODUCTOS  WHERE NOMBRE_PRODUCTO LIKE '%a' ";
			//$consulta = "SELECT C.ID_CATEGORIA, C.DESCRIPCION FROM categoria as C INNER JOIN presupuesto as c 
			//ON  C.ID_CATEGORIA = P.ID_CATEGORIA ";
            $consulta="SELECT *from CATEGORIA ";
            
			$sentencia=$this->conectar->prepare($consulta);
			
			if($sentencia->execute()){
            
				$res=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			    $rows=count($res);
                
				if($rows > 0 ){

					//var_dump($res);		
					echo json_encode( $res);
                     
					//$returnData=$this->msg(1,202,'DA');
					
				}else{ 
					$returnData=$this->msg(1,204,'No se encontro ningun dato');
					
				}

			}else{
				$returnData=$this->msg(0,500,'Ocurrio un error al consltar datos ');
				
				//$msg['message']='Ocurrio un error al consltar datos';
				
			}

			//$res=$sentencia->fetchAll();
			
		}catch(PDOException $ex ){
			$returnData=$this->msg(0,500,'Ocurrio un error :'.$ex->getMessage());
					
			//$msg['message']="Error al listar usuraios ";
		}

		//return json_encode($returnData);	
	}
   
	public function buscarCategoria($id){
		
		try{
			$this->id=(int)$id;
			
			$consulta=" SELECT *FROM ".$this->tabla." WHERE ID_CATEGORIA= ? ";
			$sentencia=$this->conectar->prepare($consulta);
			
			$sentencia->bindValue(1,$this->id);
			
			
			if($res=$sentencia->execute()){ 
			
				//$rows=$sentencia->fetchColumn(); 
			
				$res= $sentencia->fetchAll(\PDO::FETCH_ASSOC);
				$rows =count($res);
				if($rows > 0 ){ 
					/*$this->returnData = [
						'success' => 1,
						'status'=> 202,
						'usuario' => $res[0]
					];*/
					 echo json_encode($res[0]);
					
				}else{
						$res=null;
						$returnData=$this->msg(0,422,'No se encontro ningun registro ocn ese ID ');
				}
					
			}else{
				
				$msg['message'] = 'ERROR AL CONSULTAR DATOS ';
			
				$returnData=$this->msg(0,500,'Error al consultar datos');
				//return false;
			}

		}catch( PDOException $ex ){
			//$msg['message'] = 'ERROR  ';
			$returnData=$this->msg(0,422,'No se encontro ningun registro ocn ese ID '.$ex->getMessage());
		
		}
		
		return $this->returnData;

	}
	
}




?>