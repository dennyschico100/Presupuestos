<?php
class Presupuestos extends Controlador {

    public function __construct(){
        session_start();
        //$this->usuarioModelo = $this->modelo('Usuario');
        $this->PresupuestosModelo = $this->modelo('Presupuesto');
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

    public function listar(){
        
        if(!$this->isLoggedIn() ) {
            
            if(isset($_SESSION['user_email_presupuestos'])){
                //echo "".$_SESSION['user_email'];

            }
                
            $this->vista('usuarios/login');
            
         }else{
            $data=[
                "titulo"=>"Home",
                "mensaje"=>"METODO INDEX DEL HOME "
            ];
            $this->vista('presupuestos/listar');       
         }
          
    }
    
    public function obtenerTodos(){
        
        
        $resultado=$this->PresupuestosModelo->listar();
    
    }
    public function obtenerPresupuesto(){
        
        //?id_usuario=1
        if($_SERVER["REQUEST_METHOD"]=="GET"){

            //$idUsuario=$_POST["REQUEST_METHOD"];
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_NUMBER_INT);
            if(!empty($_GET["id_presupuesto"])){
                    
                $this->idPresupuesto= $_GET["id_presupuesto"];
                
                $this->PresupuestosModelo->buscarPresupuesto($this->idPresupuesto);  

            }   else{
                
            }    
        }
    }


    public function transaccion(){
                
        if(!$this->isLoggedIn() ) {
            
            if(isset($_SESSION['user_email_presupuestos'])){
                //echo "".$_SESSION['user_email'];

            }
                
            $this->vista('usuarios/login');
            
         }else{
            $data=[
                "titulo"=>"Home",
                "mensaje"=>"METODO INDEX DEL HOME "
            ];
            $this->vista('presupuestos/transaccionPresupuestaria');       
         }
          
    }

}

?>