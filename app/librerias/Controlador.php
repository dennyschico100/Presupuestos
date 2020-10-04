<?php
class Controlador{
   
    public function modelo($modelo){

        if(file_exists('../app/modelos/'.$modelo.".php")){
            
            require_once '../app/modelos/'.$modelo.'.php';
            return new $modelo();
            
        }else{
            echo "<h1>ARCHOV NMOEXITE</h1>";
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
        if (isset($_SESSION['user_rol_presupuestos']) && isset($_SESSION['user_id_presupuestos']) && isset($_SESSION['user_nombres_presupuestos']) &&
         isset($_SESSION['user_email_presupuestos'])) {
            
            //echo "<br>".$_SESSION['user_email_presupuestos'];
                
                return true;
        } else {
                return false;
        } 
    }

}


?>