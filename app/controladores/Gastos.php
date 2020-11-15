<?php

class Gastos extends Controlador
{

    private $data = ['errores' => ''];

    private $dataDetalle = ['errores' => ''];
    private $dataUsuario = ['errores' => ''];
    private $userActivado = false;
    private $idUsuario;
    
    

    public function __construct()
    {
        session_start();
        //$this->usuarioModelo = $this->modelo('Usuario');
        $this->GastosModelo = $this->modelo('Gasto');

        
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



    public function sanitizar_campos($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



    public function isLoggedIn()
    {
        if (isset($_SESSION['user_rol_presupuestos']) && isset($_SESSION['user_id_presupuestos']) && isset($_SESSION['user_nombres_presupuestos']) && isset($_SESSION['user_email_presupuestos'])) {

            if ($_SESSION['user_rol_presupuestos'] == 4) {

                return true;
            } else {
                return false;
            }
        }
    }


    public function obtenerTodos()
    {
       // $resultado = $this->PresupuestosModelo->listar();

    }

   
    

    public function registrar()
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
            $this->vista('gastos/crear');
        }
    }
    
    function guardar()
    {
        if (!$this->isLoggedIn()) {
            $this->vista('usuarios/login', $this->data);
                
        } else {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $input = json_decode(file_get_contents('php://input'));

                // Sanitize POST Data
                //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $numRegistros =  count($input);


                foreach ($input[0] as $key => $value) {
                    //echo json_encode($value);

                $this->data[$key] = $this->sanitizar_campos($value);
                } $this->data = (object) $this->data;

                $res = [];
                //echo var_dump($this->data);

                //$res = (object) $this->GatosModelo->registrarGasto($this->data);


                if ($res->success == 1) {
                    
                    /*if($exito){
                        //$this->returnData = $this->msg(1, 201, '');

                        echo json_encode(["success"=>1,
                            "status"=>201,
                            "message"=>"Detalle de Presupuesto Guardado con exito"
                        ]);
                    }*/
                    //$res= (object) ;



                } else {
                    echo json_encode($res);
                }

               
            } else {

                $this->vista('usuarios/login', $this->data);

            }
        }
    }
}