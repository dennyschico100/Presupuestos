<?php
require_once '../app/config/Conexion.php';
class Presupuesto extends Conexion
{

	public function __construct()
	{
		$this->conectar = parent::abrirConexion();
	}

	private $conectar;
	private $tabla = "presupuesto";

	public $returnData = [];

	public $idPresupuesto=0;
	public $idCategoria = 0;
	public $nombre_presupuesto="";
	public $descripcion_presupuesto="";
	public $montoInicial = 0;
	public $montoActual = 0;
	public $montoEstado = 0;
	public $porcentajeEjecutado = 0;
	public $usuarioCrea = 0;




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
			$consulta = "SELECT P.ID_PRESUPUESTO, P.MONTO_INICIAL,P.MONTO_ACTUAL,P.PORCENTAJE_EJECUTADO,P.NOMBRE_PRESUPUESTO, C.DESCRIPCION ,C.ID_CATEGORIA FROM presupuesto as P INNER JOIN categoria as c 
                        ON  P.ID_CATEGORIA= C.ID_CATEGORIA ";
			$sentencia = $this->conectar->prepare($consulta);

			if ($sentencia->execute()) {
				$res = $sentencia->fetchAll(PDO::FETCH_ASSOC);
				$rows = count($res);

				if ($rows > 0) {

					//var_dump($res);		
					echo json_encode($res);

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
	public function listarEnProceso()
	{

		try {
			//$consulta="SELECT *FROM PRODUCTOS  WHERE NOMBRE_PRODUCTO LIKE '%a' ";
			$consulta = "SELECT *from  ".$this->tabla." WHERE ESTADO ='EnProceso' ";
			$sentencia = $this->conectar->prepare($consulta);

			if ($sentencia->execute()) {
				$res = $sentencia->fetchAll(PDO::FETCH_ASSOC);
				$rows = count($res);

				if ($rows > 0) {

							
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


	public function buscarPresupuesto($id)
	{

		try {
			$this->id = (int)$id;

			$consulta = " SELECT *FROM " . $this->tabla . " WHERE ID_PRESUPUESTO= ? ";
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
<<<<<<< HEAD
	public function buscarPresupuestoId($id)
	{

		try {
			$this->id = (int)$id;

			$consulta = " SELECT *FROM " . $this->tabla . " WHERE ID_PRESUPUESTO = ? ";
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
	public function buscarPresupuestoCategoria($id)
	{

		try {
			$this->id = (int)$id;

			$consulta = " SELECT *FROM " . $this->tabla . " WHERE ID_CATEGORIA= ? ";
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
					return  $res[0];
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
=======
>>>>>>> nuevaRama

	public function registrarPresupuesto($data)
	{

		try {
			
			$consulta = " INSERT INTO   " . $this->tabla . " (ID_CATEGORIA,NOMBRE_PRESUPUESTO,DESCRIPCION_PRESUPUESTO,MONTO_INICIAL,MONTO_ACTUAL,PORCENTAJE_EJECUTADO,
			ESTADO,USUARIO_CREA,FECHA_CREACION ) VALUES (?,?,?,?,?,?,?,?,?)    ";



			if (
				isset($data->ID_CATEGORIA) && isset($data->MONTO_INICIAL)  && isset($data->MONTO_ACTUAL)  && isset($data->PORCENTAJE_EJECUTADO) &&
				isset($data->ESTADO) && isset($data->USUARIO_CREA)
			) {
				//echo var_dump($data);


				if (!empty(trim($data->ID_CATEGORIA))  &&  !empty(trim($data->MONTO_INICIAL)) &&  !empty(trim($data->MONTO_ACTUAL))  &&  !empty(trim($data->ESTADO)) &&  !empty(trim($data->USUARIO_CREA))) {
					//&!empty(trim($data->PORCENTAJE_EJECUTADO))
					

					$this->idCategoria = intval($data->ID_CATEGORIA);
					$this->montoInicial = floatval($data->MONTO_INICIAL);
					$this->montoActual = floatval($data->MONTO_ACTUAL);
					$this->porcentjeEjecutado = intval($data->PORCENTAJE_EJECUTADO);
					$this->estado = $data->ESTADO;
					$this->usuarioCrea = $data->USUARIO_CREA;
					$this->nombre_presupuesto=$data->NOMBRE_PRESUPUESTO;
					$this->descripcion_presupuesto=$data->DESCRIPCION_PRESUPUESTO;

					$sentencia = $this->conectar->prepare($consulta);
					$sentencia->bindValue(1, $this->idCategoria);
					$sentencia->bindValue(2, $this->nombre_presupuesto);
					$sentencia->bindValue(3, $this->descripcion_presupuesto);
					
					$sentencia->bindValue(4, $this->montoInicial);
					$sentencia->bindValue(5, $this->montoActual);
					$sentencia->bindValue(6, $this->porcentajeEjecutado);
					$sentencia->bindValue(7, $this->estado);
					$sentencia->bindValue(8, $this->usuarioCrea);
					$sentencia->bindValue(9, date("Y-m-d"));

					if ($sentencia->execute()) {
						$obj = (object) $this->buscarPresupuestoCategoria($this->idCategoria);



						$this->returnData = [
							"success" => 1,
							"status" => 201,
							"message" => 'Presupuesto Guardado',
							"IdPresupuesto" => $obj->ID_PRESUPUESTO

						];
					} else {
						$returnData = $this->msg(0, 500, 'No se ingresaron datos ');
					}
				} else {
					$returnData = $this->msg(0, 422, 'Valores nulos detectados,  completa todo le formulario ');
				}
			} else {
				$returnData = $this->msg(0, 422, 'Complete todos los campos ');
			}
		} catch (PDOException $ex) {
				echo json_encode( $ex->getMessage());
			$returnData = $this->msg(0, 500, $ex->getMessage());
		}

		//echo json_encode( $this->returnData);

		return (object) $this->returnData;
	}

<<<<<<< HEAD
	public function modificarEstado($data){
		try{
			
			//parent::set_names();
			$consulta="UPDATE  ".$this->tabla." SET  ESTADO = ? WHERE ID_PRESUPUESTO = ? ";
			

			if( isset($data->ESTADO) &&   isset($data->ID_PRESUPUESTO) )
			{				
				

				if(!empty(trim($data->ESTADO))  &&  !empty(trim($data->ID_PRESUPUESTO))    )
				{
					
				$this->estado=$data->ESTADO;
				$this->idPresupuesto= $data->ID_PRESUPUESTO;
				
				$sentencia=$this->conectar->prepare($consulta);

				$sentencia->bindValue(1,$this->estado);
				$sentencia->bindValue(2,$this->idPresupuesto);
				if($sentencia->execute()){
					//$msg['message'] = 'Usuario registrado correctamente !' ;
					$returnData=$this->msg(1,201,'Datos Modificado correctamente');
							
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
=======
	
}
>>>>>>> nuevaRama
