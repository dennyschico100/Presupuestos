<?php

class Core{
    
    protected $controladorActual='Home';
    protected $metodoActual='index';
    protected $params = [];
    
    public function __construct(){

        $url=$this->getUrl();
        $r=["message"=>"Hello from the construcot","status"=>true];
        //echo json_encode($r);
        
        
        // Look in controllers for first value
        if(file_exists('../app/controladores/'.ucwords($url[0]).'.php')){
            
            $this->controladorActual=ucwords($url[0]);
            unset($url[0]);
                
        }else{
            //debo de redirecinarlo a otro lugar
        }

        require_once '../app/controladores/'. $this->controladorActual.'.php';
        
        // Instanciar la clase del controlador
        $this->controladorActual= new $this->controladorActual();

         // Revisnado la segunda parte de la rul
         if (isset($url[1])) {
            if(method_exists($this->controladorActual, $url[1]))
            {   
                $this->metodoActual = $url[1];
                unset($url[1]);
            }
        }
        
        
        // Obtenr los parametros
        $this->params = $url ? array_values($url) : [];
        //Llamando un   callback con un arreglo  como parametro
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->params);
        
    }



    public function getUrl(){
        
        if(isset($_GET['url'])){
            $url=rtrim($_GET['url'],'/');
            $url=filter_var($url,FILTER_SANITIZE_URL);
            $url=explode('/',$url);
            return $url;
        }
    }

}

?>