<?php
class Usuarios  extends Controlador{

    public function __construct(){
        session_start();
        $this->usuarioModelo = $this->modelo('Usuario');
        $this->usuarioRolModelo = $this->modelo('UsuarioRoles');
        
    }
    
    private $data = ['errores' => ''];
    private $dataUsuario = ['errores' => ''];
    private $userActivado=false;
    private $idUsuario;

    
    public function sanitizar_campos($data) {
        $data = trim($data);
        $data = stripslashes($data);		
        $data = htmlspecialchars($data);
        return $data;
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
            $this->vista('usuarios/listar');       
         }
          
    }

    public function login(){    
         
         if ($_SERVER['REQUEST_METHOD']=='POST') {

            // Process form
            // Sanitize POST Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            echo var_dump($this->dataUsuario);   

            if($this->userActivado){

                foreach($_POST as $key=>$value)
                {            
                    $this->dataUsuario [$key]=$this->sanitizar_campos($value);
                                
                }

            }else{

                foreach($_POST as $key=>$value)
                {            
                    $this->data [$key]=$this->sanitizar_campos($value);
                                
                } 
            }
            
            //Make sure are empty
            if ( empty($dataUsuario['email_err']) && empty($dataUsuario['password_err']) ) {
                
                //Convirtiedno $data en fomrato JSON PARA PODER ACCEDER  A SUS
                //atributos  sin ningun problema , cuando son recividos en el modelo
                $this->data=json_encode($this->data);
                
                
                $userAuthenticated = $this->usuarioModelo->login($this->data);

               
                if ( $userAuthenticated['success'] === 1  ) {
                    //echo "crear sesion";
                    if($userAuthenticated['usuario']['ESTADO'] === "3" ){
                        $this->cambiarPassword();
                        //presupuestos012456789

                    }else{
                            
                        // Crer session
                        //$userAuthenticated['usuario']['ID_USUARIO']
                
                        $this->usuarioModelo->registrarInicioSesion($userAuthenticated['usuario']['ID_USUARIO']);
                        $this->createUserSession($userAuthenticated);
                        echo "<h1>despues de crear sesion</h1>";
                    }

                } else {
                    //echo json_encode($userAuthenticated);

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

    public function cambiarPassword(){
        
        $this->vista('usuarios/cambiarPassword');

    }

    public function activarCuenta(){

        if ($_SERVER['REQUEST_METHOD']=='POST') {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                      
            //echo var_dump($_POST);

            foreach($_POST as $key=>$value)
            {            
                $this->data[$key]=$this->sanitizar_campos($value);
                               
            }           
            //Make sure are empty
            if ( !empty($_POST) ) {
                
                $this->data=(object) $this->data;
                //echo var_dump($this->data);
                $usuarioActivado=$this->usuarioModelo->activarCuenta($this->data);
                //echo var_dump($usuarioActivado);
                echo $usuarioActivado["cuentaActivada"];
                if($usuarioActivado["cuentaActivada"] === 1 ){
                    echo "<br>SE ACTIVO DIO ....".$usuarioActivado["cuentaActivada"];
                    $this->userActivado=true;

                    $this->login();
        
                }else{
                    echo "NO ACTIVO DIO FALSO";
                    
                }

               //echo json_encode($userAuthenticated);          
            } else {
               // Load view with errors
               //$this->vista('usuarios/login',$this->data);

            }

       } else {
           //$this->vista("usuarios/login");
          
           //$this->vista('usuarios/login',$this->data);

       }


    }


    public function isLoggedIn()
    {
        if (  isset($_SESSION['user_rol_presupuestos']) && isset($_SESSION['user_id_presupuestos']) && isset($_SESSION['user_nombres_presupuestos']) && isset($_SESSION['user_email_presupuestos'])) {
                
            if($_SESSION['user_rol_presupuestos'] == 2 ){
                return true;
                
            }else{
                           
                return false;
            }          

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
            $_SESSION['user_id_presupuestos'] = $user['usuario']['ID_USUARIO'];            
            $_SESSION['user_email_presupuestos'] = $user['usuario']['EMAIL'];
            $_SESSION['user_nombres_presupuestos'] = $user['usuario']['NOMBRES'];
            $_SESSION['user_rol_presupuestos'] = $user['rol_usuario'];
        
            //return $this->editarUsuario();
           $this->vista('home/index');
           
    }  

    public function logout(){
        //rEVISRA SI HAY SESION INICIALIZADA valor cero
        if(isset($_SESSION['user_rol_presupuestos']) && isset($_SESSION['user_id_presupuestos']) && isset($_SESSION['user_nombres_presupuestos']) && isset($_SESSION['user_email_presupuestos'])    ){
            $id=$_SESSION['user_id_presupuestos'];

            unset($_SESSION['user_id_presupuestos']);
            unset($_SESSION['user_email_presupuestos']);
            unset($_SESSION['user_nombre_presupuestos']);
            unset($_SESSION['user_rol_presupuestos']);
            session_destroy();
            $this->usuarioModelo->registrarCierreSesion($id);
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
                $res= [];

                $res= (object) $this->usuarioModelo->guardar($this->data);
                if($res->success == 1 ){

                    $_idUsuario=(int)$res->id;
                    $this->usuarioRolModelo->asignarRol($_idUsuario,$this->data->rol);    
                    
                }else{
                    echo json_encode($res);

                }         
            } else {

                $this->vista('usuarios/login',$this->data);
            }
        } else {
           
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
                      
           switch ($row['ESTADO']) {
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
           
           $sub_array[]=$row['ID_USUARIO'];
           $sub_array[]=$row['NOMBRES'];
           $sub_array[]=$row['APELLIDOS'];
           $sub_array[]=$row['TELEFONO'];
           $sub_array[]=$row['EMAIL'];
           $sub_array[]=$row['FECHA_CREACION'];
           
           $sub_array[]="<button type='button' name='estado' id='btn-estado'  class='".$atr." ' >".$est."</button>";
           $sub_array[]="<button type='button' name='estado' id='' class='btn btn-success btn-md update' onClick='mostrar(".$row["ID_USUARIO"].")' ><i class='fas fa-pen'></i></button>";
           $sub_array[]="<button type='button' name='estado' id='' 
           class='btn btn-danger  btn-md update' data-toggle='modal' data-target='#eliminarModal'  onClick='eliminar(".$row["ID_USUARIO"].")'  ><i class='fas fa-trash'></i></button>";
          
           
           $data[]=$sub_array;
           
        }
        
      $response['status_code_header'] = 'HTTP/1.1 200 OK';
      //$response['body']=json_encode($resultado);
      $response['body']=json_encode($data );
      
      echo json_encode($data);

    }
    
    public function obtenerUsuario(){
        //?id_usuario=1
        if($_SERVER["REQUEST_METHOD"]=="GET"){

            //$idUsuario=$_POST["REQUEST_METHOD"];
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_NUMBER_INT);
            if(!empty($_GET["id_usuario"])){
                    
                $this->idUsuario= $_GET["id_usuario"];
                //echo "".$this->idUsuario;
                $this->usuarioModelo->buscarUsuario($this->idUsuario);  

            }              
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
               $this->usuarioModelo->modificar($this->data);
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


    public function eliminar(){

        
        if($_SERVER['REQUEST_METHOD'] == 'DELETE') {

            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = explode( '/', $uri );
            if(!empty($uri[4])){
                    
                $this->idUsuario= $uri[4];

                $res= [];

                $res=(object) $this->usuarioRolModelo->eliminarUsuarioRol($this->idUsuario);
                
                if($res->success== 1 ){
                    
                    $this->usuarioModelo->eliminar($this->idUsuario);
                    
                }else{
                    
                    echo json_encode($res);
                                  
                }
                
            }else{
                
            }
        }
    }

    public function actividad(){
        $this->vista("usuarios/actividad");
    }

}

?>