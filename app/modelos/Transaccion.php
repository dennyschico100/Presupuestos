<?php

require_once '../app/config/Conexion.php';
class Transaccion extends Conexion
{

	public function __construct()
	{
		$this->conectar = parent::abrirConexion();
	}

	private $conectar;
	private $tabla = "transacciones";

	public $returnData = [];
	public $id;
	public $idUser;
	public $origin;
	public $destiny;
	public $desc;
	public $amount;
	public $status;

	public function msg($success, $status, $message, $extra = [])
	{

		return array_merge([
			'success' => $success,
			'status' => $status,
			'message' => $message
		], $extra);
	}


	public function listar()
	{

		try {
			//$consulta="SELECT *FROM PRODUCTOS  WHERE NOMBRE_PRODUCTO LIKE '%a' ";
			$consulta = "SELECT *FROM  ".$this->tabla;
			$sentencia = $this->conectar->prepare($consulta);

			if ($sentencia->execute()) {
				$res = $sentencia->fetchAll(PDO::FETCH_ASSOC);
				$rows = count($res);

				if ($rows > 0) {

					//var_dump($res);		
					return $res;

					//$returnData=$this->msg(1,202,'DA');

				} else {
					$returnData = $this->msg(1, 204, 'No se encontro ningun dato');
				}
			} else {
				$returnData = $this->msg(0, 500, 'Ocurrio un error al consltar datos ');

				//$msg['message']='Ocurrio un error al consltar datos';

			}

			//$res=$sentencia->fetchAll();

		} catch (PDOException $ex) {
			$returnData = $this->msg(0, 500, 'Ocurrio un error :' . $ex->getMessage());

			//$msg['message']="Error al listar usuraios ";
		}

		//return json_encode($returnData);	
	}
	public function guardar()
	{
		try {
			$sql = "INSERT INTO " . $this->tabla . " (ID_USUARIO, MONTO, ID_PRESUPUESTO_ORIGEN, ID_PRESUPUESTO_DESTINO,DESCRIPCION, ESTADO,FECHA_CREACION) VALUES (?,?,?,?,?,?, now()) ";

			$stmt = $this->conectar->prepare($sql);

			$stmt->bindValue(1, $this->idUser);
			$stmt->bindValue(2, $this->amount);
			$stmt->bindValue(3, $this->origin);
			$stmt->bindValue(4, $this->destiny);
			$stmt->bindValue(5, $this->desc);
			$stmt->bindValue(6, 'enProceso');
			
			//id user debe recogerse desde una sesion !!!

			$stmt->execute();
		} catch (PDOException $ex) {
			$returnData = $this->msg(0, 500, '' . $ex->getMessage());
		}

		//return   (object) $returnData;
	}

	public function updateOrigin($origin){
		try {
			$sql = "UPDATE presupuesto SET MONTO_ACTUAL = :monto WHERE ID_PRESUPUESTO = :id";

			$stmt = $this->conectar->prepare($sql);

			$stmt->bindValue(":id", $origin->id);
			$stmt->bindValue(":monto", $origin->monto);
			
		
			$stmt->execute();
		} catch (PDOException $ex) {
			$returnData = $this->msg(0, 500, '' . $ex->getMessage());
		}

	}

	public function updateDestiny($destiny){
		try {
			$sql = "UPDATE presupuesto SET MONTO_ACTUAL = :monto WHERE ID_PRESUPUESTO = :id";

			$stmt = $this->conectar->prepare($sql);

			$stmt->bindValue(":id", $destiny->id);
			$stmt->bindValue(":monto", $destiny->monto);
			
		
			$stmt->execute();
		} catch (PDOException $ex) {
			$returnData = $this->msg(0, 500, '' . $ex->getMessage());
		}

	}

	
	public function buscarTransaccionId($id)
	{

		try {
			$this->id = (int)$id;

			$consulta = " SELECT *FROM " . $this->tabla . " WHERE ID_TRANSACCION = ? ";
			$sentencia = $this->conectar->prepare($consulta);

			$sentencia->bindValue(1, $this->id);


			if ($res = $sentencia->execute()) {

				//$rows=$sentencia->fetchColumn(); 

				$res = $sentencia->fetchAll(\PDO::FETCH_ASSOC);
				$rows = count($res);
				if ($rows > 0) {
					/*$this->returnData = [
						'success' => 1,
						'status'=> 202,
						'usuario' => $res[0]
					];*/
					echo json_encode($res[0]);
				} else {
					$res = null;
					$returnData = $this->msg(0, 422, 'No se encontro ningun registro ocn ese ID ');
				}
			} else {

				$msg['message'] = 'ERROR AL CONSULTAR DATOS ';

				$returnData = $this->msg(0, 500, 'Error al consultar datos');
				//return false;
			}
		} catch (PDOException $ex) {
			//$msg['message'] = 'ERROR  ';
			$returnData = $this->msg(0, 422, 'No se encontro ningun registro ocn ese ID ' . $ex->getMessage());
		}

		return $this->returnData;
	}

	
	public function modificarEstado($data){
		try{

			
			//parent::set_names();
			$consulta="UPDATE  ".$this->tabla."  SET ESTADO=? where ID_TRANSACCION = ? ";
			

			if( isset($data->ID_TRANSACCION) && isset($data->ESTADO) )
			{				
				
				if(!empty(trim($data->ID_TRANSACCION))  &&  !empty(trim($data->ESTADO))     )
				{
					
				$this->id=$data->ID_TRANSACCION;
				$this->status= $data->ESTADO;

				//$this->cargo= test_input($data->nombre)
				//$this->estado= $data->estado;
				$sentencia=$this->conectar->prepare($consulta);

				
				$sentencia->bindValue(1,$this->status);	
				$sentencia->bindValue(2,$this->id);
				
					

					if($sentencia->execute()){
						//$msg['message'] = 'Usuario registrado correctamente !' ;
						$returnData=$this->msg(1,201,'Estado Modificado correctamente');
								
					}
					else{
						$returnData=$this->msg(0,500,'No se pudo modificar los datos ');
						
					}
				
				
				
				}else{
					$returnData=$this->msg(0,422,'Valores nulos detectados,  completa todo le formulario ');
				}

            }else{
				$returnData=$this->msg(0,422,'Complete todos los campos '); 
				
			}
			
			}catch(PDOException $ex){
				$returnData=$this->msg(0,500,''.$ex->getMessage());
			}

			echo json_encode($returnData);
	}

	
}
