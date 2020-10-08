<?php
class UsuariosRoles extends Controlador{
    public function __construct(){
        session_start();
        //$this->usuarioModelo = $this->modelo('Usuario');
        $this->usuarioRolModelo = $this->modelo('UsuarioRoles');
    
    }

    public function sanitizar_campos($data) {
        $data = trim($data);
        $data = stripslashes($data);		
        $data = htmlspecialchars($data);
        return $data;
    }


    public function isLoggedIn()
    {
        if (  isset($_SESSION['user_rol_presupuestos']) && isset($_SESSION['user_id_presupuestos']) && isset($_SESSION['user_nombres_presupuestos']) && isset($_SESSION['user_email_presupuestos'])) {
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

    //Retorna la vista que muestra a los usuario con sus roles del sistema
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
            $this->vista('usuarioRoles/listar');       
         }
          
    }
    
    public function obtenerTodos(){
        
        $resultado=$this->usuarioRolModelo->obtenerUsuarioRoles();
        $data= array();
  
        foreach($resultado as $row){
           $sub_array = array();
           
           $est='';
           $atr='';
           switch ($row['ID_ROL']) {
               case 1:
                    $est='Analista Presupuestario';
            
                break;

                case 2:
                    $est='Administrador';

                break;

                case 3:
                    $est='Jefe de presupuesto';

                break;
                
                case 4:
                $est='Tesorero';

                break;

               
                default:
                   
                    $est='No definido';

                break;
           }
           $atr='btn btn-secondary';
                    
           
           $sub_array[]=$row['ID_USUARIO']; 
           $sub_array[]=$row['NOMBRES'];
           $sub_array[]=$row['APELLIDOS'];
           $sub_array[]=$row['EMAIL'];
           
           $sub_array[]="<button type='button' name='estado' id='btn-estado'  class='".$atr." ' >".$est."</button>";
           
           $sub_array[]="<button type='button' name='estado' id='' class='btn btn-success btn-md update' onClick='mostrar(".$row["ID_USUARIO"].")' ><i class='fas fa-pen'></i></button>";
           
           $data[]=$sub_array;
           
        }
        
      $response['status_code_header'] = 'HTTP/1.1 200 OK';
      //$response['body']=json_encode($resultado);
      $response['body']=json_encode($data );
      
      echo json_encode($data);

    }

}


?>