<?php
class Controlador{

    public function modelo($modelo){

        if(file_exists('../app/modelos/'.$modelo.".php")){
            
            require_once '../app/modelos/'.$modelo.'.php';
            return new $modelo();
            
        }else{
            echo "<h1>ARCHIVO  NO EXITE</h1>";
        }

    }
    

    public function vista($vista,$data=[]){
        
        if(file_exists('../app/vistas/'.$vista.".php")){
            require_once ('../app/vistas/'.$vista.".php"); 
        }else{
            die('Vista solicitada no existe '.$vista);
        }
    }
    
    public function isLoggedIn()
    {
        if (isset($_SESSION['user_rol']) && isset($_SESSION['user_id']) && isset($_SESSION['user_nombres']) && isset($_SESSION['user_email'])) {
                return true;
        } else {
                return false;
        } 
    }

}


?>