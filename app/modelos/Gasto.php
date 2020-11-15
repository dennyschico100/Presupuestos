<?php
require_once '../app/config/Conexion.php';
class Gasto extends Conexion
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
	public $usuarioCrea = 0;




	public function msg($success, $status, $message, $extra = [])
	{

		return array_merge([
			'success' => $success,
			'status' => $status,
			'message' => $message
		], $extra);
	}



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

	
}