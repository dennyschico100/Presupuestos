<?php
//header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json; charset=UTF-8');

require_once '../app/config/Conexion.php';
class  DetallePresupuesto extends Conexion
{

	public function __construct()
	{
		$this->conectar = parent::abrirConexion();
	}

	private $conectar;
	private $tabla = "detalle_presupuesto";

	public $returnData = [];

	

	public $idDetalle = 0;
	public $idPresupuesto = 0;
	public $nombreGasto = 0;
	public $unidades = 0;
	public $monto = 0;
	public $montoTotal = 0;
	public $usuarioCrea = 0;
	public $fechaCreacion = 0;

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
			$consulta = "SELECT P.ID_PRESUPUESTO, P.MONTO_INICIAL,P.MONTO_ACTUAL,P.PORCENTAJE_EJECUTADO, C.DESCRIPCION ,C.ID_CATEGORIA FROM presupuesto as P INNER JOIN categoria as c 
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
	public function buscarPresupuesto($id)
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

	public function registrarDetallePresupuesto($data)
	{

		try {

			$consulta = " INSERT INTO   " . $this->tabla . " (ID_PRESUPUESTO ,NOMBRE_GASTO,UNIDADES,MONTO,
			MONTO_TOTAL,USUARIO_CREA,FECHA_CREACION ) VALUES (?,?,?,?,?,?,?)    ";
			//  echo var_dump($data);
			if (
				isset($data->idPresupuesto) && isset($data->descripcion)  && isset($data->unidades)
				&& isset($data->monto) && isset($data->total) && isset($data->usuarioCrea)
			) {
				if (
					!empty(trim($data->idPresupuesto))  &&  !empty(trim($data->descripcion)) &&  !empty(trim($data->unidades)) &&
					!empty(trim($data->monto)) &&  !empty(trim($data->total)) &&  !empty(trim($data->usuarioCrea))
				) {

					$this->idPresupuesto = intval($data->idPresupuesto);
					$this->nombreGasto = $data->descripcion;
					$this->unidades = intval($data->unidades);
					$this->monto = floatval($data->monto);
					$this->montoTotal = floatval($data->total);
					$this->usuarioCrea = $data->usuarioCrea;

					$sentencia = $this->conectar->prepare($consulta);
					$sentencia->bindValue(1, $this->idPresupuesto);
					$sentencia->bindValue(2, $this->nombreGasto);
					$sentencia->bindValue(3, $this->unidades);
					$sentencia->bindValue(4, $this->monto);
					$sentencia->bindValue(5, $this->montoTotal);
					$sentencia->bindValue(6, $this->usuarioCrea);
					$sentencia->bindValue(7, date("Y-m-d"));

					if ($sentencia->execute()) {

						return true;
						
					} else {
						$this->returnData = $this->msg(0, 500, 'No se ingresaron datos ');
					}
				} else {
					$this->returnData = $this->msg(0, 422, 'Valores nulos detectados,  completa todo le formulario ');
				}
			} else {
				$this->returnData = $this->msg(0, 422, 'Complete todos los campos ');
			}
		} catch (PDOException $ex) {

			$this->returnData = $this->msg(0, 500, $ex->getMessage());
		}

		echo json_encode($this->returnData);
	}

	/**
	 * API
	 * metodo utilizado por la api "getDetail" regresara todos los datos
	 * de relacionados a un presupuesto
	 */

	public function show($id)
	{
		$sql = 'SELECT ID_DETALLE_PRESUPUESTO,
		ID_PRESUPUESTO,
		NOMBRE_GASTO,
		UNIDADES,
		MONTO,
		MONTO_TOTAL,
		USUARIO_CREA,
		FECHA_CREACION
		FROM detalle_presupuesto WHERE ID_PRESUPUESTO = ?';

		$stmt = $this->conectar->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();

		return $stmt;
	}
}
