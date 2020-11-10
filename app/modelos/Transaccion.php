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
	public $idUser = 5;
	public $origin;
	public $destiny;
	public $desc;
	public $amount;


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
	public function guardar()
	{
		try {
			$sql = "INSERT INTO " . $this->tabla . " (ID_USUARIO, MONTO, ID_PRESUPUESTO_ORIGEN, ID_PRESUPUESTO_DESTINO,DESCRIPCION, FECHA_CREACION) VALUES (?,?,?,?,?, now()) ";

			$stmt = $this->conectar->prepare($sql);

			$stmt->bindValue(1, $this->idUser);
			$stmt->bindValue(2, $this->amount);
			$stmt->bindValue(3, $this->origin);
			$stmt->bindValue(4, $this->destiny);
			$stmt->bindValue(5, $this->desc);
			//id user debe recogerse desde una sesion !!!

			$stmt->execute();
		} catch (PDOException $ex) {
			$returnData = $this->msg(0, 500, '' . $ex->getMessage());
		}

		return   (object) $returnData;
	}
}
