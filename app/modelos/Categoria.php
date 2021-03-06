<?php

require_once '../app/config/Conexion.php';
class Categoria extends Conexion
{

	public function __construct()
	{
		$this->conectar = parent::abrirConexion();
	}

	private $conectar;
	private $tabla = "categoria";
	public $id;
	public $name;
	public $returnData = [];

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
			$consulta = "SELECT * FROM CATEGORIA ";

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

	public function buscarCategoria($id)
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

	public function store()
	{
		try {
			$sql = "INSERT INTO " . $this->tabla . " (DESCRIPCION, FECHA_CREACION) VALUES(?,?)";

			$stmt = $this->conectar->prepare($sql);

			$stmt->bindValue(1, $this->name);
			$stmt->bindValue(2, date("Y-m-d"));

			$stmt->execute();
		} catch (PDOException $ex) {
			$returnData = $this->msg(0, 500, '' . $ex->getMessage());
		}
	}

	public function update()
	{

		try {
			$sql = "UPDATE " . $this->tabla . " SET DESCRIPCION = ? WHERE ID_CATEGORIA = ?";

			$stmt = $this->conectar->prepare($sql);
			$stmt->bindValue(1, $this->name);
			$stmt->bindValue(2, $this->id);

			$stmt->execute();
		} catch (PDOException $ex) {
			$returnData = $this->msg(0, 500, '' . $ex->getMessage());
		}
	}


	public function delete($id)
	{

		try {
			$sql = "DELETE FROM " . $this->tabla . " WHERE ID_CATEGORIA = ?";

			$stmt = $this->conectar->prepare($sql);
			$stmt->bindValue(1, $id);

			$stmt->execute();
		} catch (PDOException $ex) {
			$returnData = $this->msg(0, 500, '' . $ex->getMessage());
		}
	}
}
