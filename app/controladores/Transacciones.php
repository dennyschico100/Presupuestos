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

            if ($_SESSION['user_rol_presupuestos'] !== 1) {

                return true;
            } else {
                return false;
            }
        }
    }



    public function obtenerTodos()
    {
        $resultado=$this->TransaccionesModelo->listar();
        $data= array();
        
        foreach($resultado as $row){
           $sub_array = array();
           
           $est='';
           $atr='';

           $sub_array[]=$row['ID_TRANSACCION'];
           $sub_array[]=$row['ID_USUARIO'];
           $sub_array[]=$row['MONTO'];
           $sub_array[]=$row['ID_PRESUPUESTO_ORIGEN'];
           $sub_array[]=$row['ID_PRESUPUESTO_DESTINO'];
           $sub_array[]=$row['DESCRIPCION'];
           $sub_array[]=$row['ESTADO'];
           $sub_array[]=$row['FECHA_CREACION'];
           
    
           $sub_array[]="<button type='button' name='estado' id='' class='btn btn-success btn-md update' onClick='obtenerTransaccionPorId(".$row["ID_TRANSACCION"].")' ><i class='fas fa-pen'></i></button>";
           
           
           $data[]=$sub_array;
           
        }
        
      $response['status_code_header'] = 'HTTP/1.1 200 OK';
      //$response['body']=json_encode($resultado);
      $response['body']=json_encode($data );
      
      echo json_encode($data);
        

    }
    public function cambiarEstado(){

        
        if ($_SERVER['REQUEST_METHOD']=='PUT') {
             
            $input = json_decode(file_get_contents('php://input'));   
           // Sanitize POST Data
           //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

           foreach($input as $key=>$value)
           {            
               $this->data[$key]=$this->sanitizar_campos($value);    
           }             
           
           if ( $this->isLoggedIn()) {
               //Convirtiedno $data en fomrato JSON PARA PODER ACCEDER  A SUS
               //atributos  sin ningun problema , cuando son recividos en el modelo
               $this->data=(object) $this->data;
               $this->TransaccionesModelo->modificarEstado($this->data);
               //echo json_encode($userAuthenticated);
               
           } else {
               // Load view with errors
               $this->vista('usuarios/login',$this->data);
           }
       } else {
           //$this->vista("usuarios/login");
          
           $this->vista('usuarios/login',$this->data);
       }


    }

    public function obtenerTransaccionPorId()
    {

        //?id_usuario=1
        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            //$idUsuario=$_POST["REQUEST_METHOD"];
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_NUMBER_INT);
            if (!empty($_GET["id_transaccion"])) {

                $this->idPresupuesto = $_GET["id_transaccion"];

                $this->TransaccionesModelo->buscarTransaccionId($this->idPresupuesto);
            } else {
            }
        }
    }

    public function listarTransacciones()
    {
        $this->vista('Transacciones/listar');
            
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