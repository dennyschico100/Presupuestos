<?php

class DetallePresupuestoController extends Controlador
{
    public $Details;
    //public $id;

    public function __construct()
    {
        session_start();
        $this->Details = $this->modelo('DetallePresupuesto');
    }

    /**
     * monstrando los detalles de una transaccion
     */

    public function Detail()
    {
        $_SESSION['id'] = isset($_GET['id']) ? (int)$_GET['id'] : die();
        $this->vista('detalles/detalle');
        //header('Location:http://localhost/practicas/Presupuestos/detallepresupuestocontroller/getDetail');
        
    }
    /**
     * end-point detalles
     */
    public function getDetail()
    {
       // header('Access-Control-Allow-Origin: *');
        //header('Content-Type: application/json; charset=UTF-8');
      

        $id = isset($_SESSION['id']) ? $_SESSION['id'] : $_GET['id'];

        if (isset($id)) {
            $details = $this->Details->show($id);

            $rowsCount = $details->rowCount();

            if ($rowsCount > 0) {
                $itemDetails['data'] = array();

                while ($item = $details->fetch(PDO::FETCH_ASSOC)) {
                    extract($item);
                    $data = array(
                        "id" => $ID_DETALLE_PRESUPUESTO,
                        "presupuesto_id" => $ID_PRESUPUESTO,
                        "nombre" => $NOMBRE_GASTO,
                        "unidades" => $UNIDADES,
                        "monto" => $MONTO,
                        "monto_total" => $MONTO_TOTAL,
                        "pertenece_a" => $USUARIO_CREA,
                        "fecha" => $FECHA_CREACION
                    );
                    array_push($itemDetails['data'], $data);
                }
                echo json_encode($itemDetails);
            } else {
                http_response_code(404);
                echo json_encode(
                    array("message" => "No record found.")
                );
            }

           
        } else {
            header('Location: http://localhost/practicas/Presupuestos/presupuestos/listar');
        }
    }
}
