<?php
class Transacciones  extends Controlador
{

    public function __construct()
    {
        session_start();
        //$this->usuarioModelo = $this->modelo('Usuario');
        $this->TransaccionesModelo = $this->modelo('Transaccion');
    }

    private $data = array();
    private $dataUsuario = ['errores' => ''];
    private $userActivado = false;
    private $idUsuario;
    private $idPresupuesto;

    public function sanitizar_campos($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function index()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $input = json_decode(file_get_contents('php://input'));
        $method = $_SERVER['REQUEST_METHOD'];

        if ($this->isLoggedIn()) {
            $this->vista("home/index");
        } else {
            echo "otra vez";
            $this->vista("usuarios/login");
        }
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_rol_presupuestos']) && isset($_SESSION['user_id_presupuestos']) && isset($_SESSION['user_nombres_presupuestos']) && isset($_SESSION['user_email_presupuestos'])) {

            if ($_SESSION['user_rol_presupuestos'] == 1) {

                return true;
            } else {
                return false;
            }
        }
    }



    public function obtenerTodos()
    {


        //$resultado=$this->PresupuestosModelo->listar();

    }
    public function guardar()
    {
        $transfer = $this->TransaccionesModelo;
        $input = json_decode(file_get_contents("php://input"));

        foreach ($input as $key => $value) {
            $this->data[$key] = $this->sanitizar_campos($value);
        }
        $datosTransfer = (object) $this->data;

        $transfer->idUser = (int) $_SESSION['user_id_presupuestos'];
        $transfer->origin = (int) $datosTransfer->origin;
        $transfer->destiny = (int) $datosTransfer->destiny;
        $transfer->amount = (float) $datosTransfer->amount;
        $transfer->desc = $datosTransfer->description;

        $transfer->guardar();
       
    }

    public function updateOrigin()
    {
        $transfer = $this->TransaccionesModelo;
        $input = json_decode(file_get_contents("php://input"));
        $originData = array();

        foreach ($input as $key => $value) {
            $this->data[$key] = $this->sanitizar_campos($value);
        }
        $datosTransfer = (object) $this->data;

        if ($datosTransfer->monto != null && $datosTransfer->monto > 0) {
           $transfer->updateOrigin($datosTransfer);
        }else {
            echo 'datos erroneos';
        }
    }

    public function updateDestiny()
    {
        $transfer = $this->TransaccionesModelo;
        $input = json_decode(file_get_contents("php://input"));

        foreach ($input as $key => $value) {
            $this->data[$key] = $this->sanitizar_campos($value);
        }
        $datosTransfer = (object) $this->data;

        if ($datosTransfer->monto != null && $datosTransfer->monto > 0) {
            $transfer->updateOrigin($datosTransfer);
        }else {
            echo 'datos erroneos';
        }
    }

    public function create()
    {


        if (!$this->isLoggedIn()) {

            if (isset($_SESSION['user_email_presupuestos'])) {
                //echo "".$_SESSION['user_email'];

            }

            $this->vista('usuarios/login');
        } else {
            $data = [
                "titulo" => "Home",
                "mensaje" => "METODO INDEX DEL HOME "
            ];
            $this->vista('Transacciones/createTransaction');
        }
    }
}
