<?php

class Home extends Controlador{
    /*
    public function isLoggedIn(){
        return true;
    }*/

    public function index(){
        session_start();
        
        if(!$this->isLoggedIn() ) {
            
            if(isset($_SESSION['user_email'])){
                echo "".$_SESSION['user_email'];
            }
                
            $this->vista('usuarios/login');
                
         }else{
            $data=[
                "titulo"=>"Home",
                "mensaje"=>"METODO INDEX DEL HOME "
            ];
            $this->vista('home/index',$data);
         }

    }

}

?>