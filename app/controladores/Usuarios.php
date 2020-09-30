<?php
class Usuarios  extends Controlador{

    public function __construct(){
        session_start();
        $this->usuarioModelo = $this->modelo('Usuario');
        
    }
    
    private $data = ['errores' => ''];
    private $idUsuario;

    
    public function sanitizar_campos($data) {
        $data = trim($data);
        $data = stripslashes($data);		
        $data = htmlspecialchars($data);
        return $data;
    }

    public function listar(){
        
        if(!$this->isLoggedIn() ) {
            
            if(isset($_SESSION['user_email'])){
                //echo "".$_SESSION['user_email'];

            }
                
            $this->vista('usuarios/login');
            
         }else{
            $data=[
                "titulo"=>"Home",
                "mensaje"=>"METODO INDEX DEL HOME "
            ];
            $this->vista('usuarios/listar');       
         }
          
    }

    public function login(){    
        
         if ($_SERVER['REQUEST_METHOD']=='POST') {
            // Process form
            // Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            
            foreach($_POST as $key=>$value)
            {            
                $this->data[$key]=$this->sanitizar_campos($value);
                
                           
            }    
            
            //Make sure are empty
            if ( empty($data['email_err']) && empty($data['password_err']) ) {
                
                //Convirtiedno $data en fomrato JSON PARA PODER ACCEDER  A SUS
                //atributos  sin ningun problema , cuando son recividos en el modelo
                $this->data=json_encode($this->data);
                
                
                $userAuthenticated = $this->usuarioModelo->login($this->data);

                //echo json_encode($userAuthenticated);



                if ( $userAuthenticated['success'] === 1 ) {
                    echo "crear sesion";
                    // Create session
                    $this->createUserSession($userAuthenticated);
                    echo "despues de crear sesion";

                } else {
                    echo json_encode($userAuthenticated);

                    $this->data = [ 
                        'errores' => 'Email o contraseña incorrecta',
                    ];
                    $this->vista('usuarios/login',$this->data);
            
                }
            } else {
                // Load view with errors
                $this->vista('usuarios/login',$this->data);
            }
        } else {
            //$this->vista("usuarios/login");
           
            $this->vista('usuarios/login',$this->data);
        }
        
    }

    public function isLoggedIn()
    {
        if (  isset($_SESSION['user_rol']) && isset($_SESSION['user_id']) && isset($_SESSION['user_nombres']) && isset($_SESSION['user_email'])) {
                return true;
        } else {
                return false;
        } 
    }
    
    
    public function index(){
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $input = json_decode(file_get_contents('php://input'));
        $method = $_SERVER['REQUEST_METHOD'];
         
        /*
        if ('PUT' === $method) {
        parse_str(file_get_contents('php://input'), $_PUT);
        var_dump($_PUT); 
        }*/

        if($this->isLoggedIn()){ 
            $this->vista("home/index");
        }else{
            echo "otra vez";
            $this->vista("usuarios/login");
        }
        
    }

    public function createUserSession($user)
    {
            $_SESSION['user_id'] = $user['usuario']['id_usuario'];            
            $_SESSION['user_email'] = $user['usuario']['email'];
            $_SESSION['user_nombres'] = $user['usuario']['nombres'];
            $_SESSION['user_rol'] = $user['rol_usuario'];
            
           //return $this->editarUsuario();
            
          $this->vista('home/index');
    }

    public function logout(){
        //rEVISRA SI HAY SESION INICIALIZADA valor cero
        if(isset($_SESSION['user_rol']) && isset($_SESSION['user_id']) && isset($_SESSION['user_nombres']) && isset($_SESSION['user_email'])    ){
            
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_nombre']);
            unset($_SESSION['user_rol']);
            session_destroy();
            $this->vista("usuarios/login");
        }else{
            $this->vista("usuarios/login");
        }
        
    
    
    
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
                $this->usuarioModelo->guardar($this->data);
                 
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
    


    public function obtenerTodos(){
        
        $resultado=$this->usuarioModelo->listar();
      
        $data= array();
  
        
        foreach($resultado as $row){
           $sub_array = array();
           
           $est='';
           $atr='';
                      
           switch ($row['estado']) {
               case 1:
                    $est='ACTIVO';
                    $atr='btn-md estado';
                
                break;
                case 2:
                    $est='INACTIVO';
                    $atr=' btn btn-warning  estado';

                break;

                case 3:
                    $est='PENDIENTE';
                    //$atr=' btn btn-success  ';
                    $atr='btn btn-warning';
                break;
               
                default:
                   
                break;
           }
           
           $sub_array[]=$row['nombres'];
           $sub_array[]=$row['apellidos'];
           $sub_array[]=$row['telefono'];
           $sub_array[]=$row['email'];
           $sub_array[]=$row['created_at'];
           
           
           $sub_array[]="<button type='button' name='estado' id='btn-estado'  class='".$atr." ' >".$est."</button>";
           $sub_array[]="<button type='button' name='estado' id='' class='btn btn-success btn-md update' onClick='mostrar(".$row["id_usuario"].")' ><i class='fas fa-pen'></i></button>";
           $sub_array[]="<button type='button' name='estado' id='' 
           class='btn btn-danger  btn-md update'  onClick='eliminar(".$row["id_usuario"].")'  ><i class='fas fa-trash'></i></button>";
          
           
           $data[]=$sub_array;
           
        }
        
      $response['status_code_header'] = 'HTTP/1.1 200 OK';
      //$response['body']=json_encode($resultado);
      $response['body']=json_encode($data );
      
      echo json_encode($data);

    }

    public function obtenerUsuario(){

        if($_SERVER["REQUEST_METHOD"]==="GET"){

            //$idUsuario=$_POST["REQUEST_METHOD"];
            $_GET = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->idUsuario=$this->sanitizar_campos($_GET["id_usuario"]);

            $this->modeloUsuario->buscarUsuario($this->idUsuario);
        
        }
        

    }

    public function modificar(){

        if ($_SERVER['REQUEST_METHOD']=='PUT') {
             
            $input = json_decode(file_get_contents('php://input'));   
           // Sanitize POST Data
           //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           //var_dump($_POST);
           foreach($input as $key=>$value)
           {            
               $this->data[$key]=$this->sanitizar_campos($value);    
           }             

           if ( true) {
               //Convirtiedno $data en fomrato JSON PARA PODER ACCEDER  A SUS
               //atributos  sin ningun problema , cuando son recividos en el modelo
               //var_dump($this->);
               $this->data=(object) $this->data;
               $this->usuarioModelo->guardar($this->data);
                
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

}

?>