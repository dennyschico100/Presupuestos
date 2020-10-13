<?php
class Transacciones  extends Controlador {

    public function __construct(){
        session_start();
        //$this->usuarioModelo = $this->modelo('Usuario');
        $this->TransaccionesModelo = $this->modelo('Transaccioo');
    }

    private $data = ['errores' => ''];
    private $dataUsuario = ['errores' => ''];
    private $userActivado=false;
    private $idUsuario;
    private $idPresupuesto;
    
    public function sanitizar_campos($data) {
        $data = trim($data);
        $data = stripslashes($data);		
        $data = htmlspecialchars($data);
        return $data;
    }

    public function index(){
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $input = json_decode(file_get_contents('php://input'));
        $method = $_SERVER['REQUEST_METHOD'];
        
        if($this->isLoggedIn()){ 
            $this->vista("home/index");
        }else{
            echo "otra vez";
            $this->vista("usuarios/login");
        }
        
    }
    
    public function isLoggedIn()
    {
        if (  isset($_SESSION['user_rol_presupuestos']) && isset($_SESSION['user_id_presupuestos']) && isset($_SESSION['user_nombres_presupuestos']) && isset($_SESSION['user_email_presupuestos'])) {
                
            if($_SESSION['user_rol_presupuestos'] == 1 ){
                
                return true;

            }  else {
                return false;
            }          
        } 
    }

   
    
    public function obtenerTodos(){
        
        
        //$resultado=$this->PresupuestosModelo->listar();
    
    }
    public function guardar(){

        //$this->usuarioModelo->();
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $input = json_decode(file_get_contents('php://input'));   
           // Sanitize POST Data
           //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           //var_dump($_POST);
           foreach($input as $key=>$value)
           {            
               $this->data[$key]=$this->sanitizar_campos($value);    
               
           }             
           //Make sure are empty
           if ( true) {
               //Convirtiedno $data en fomrato JSON PARA PODER ACCEDER  A SUS
               //atributos  sin ningun problema , cuando son recividos en el modelo
               //var_dump($this->);
               $this->data=(object) $this->data;
               $res= [];

               $res= (object) $this->TransaccionesModelo->guardar($this->data);
                       
           } else {
            
               $this->vista('usuarios/login',$this->data);
           }
       } else {
          
           $this->vista('usuarios/login',$this->data);
       }

   }
   
  


}

?>