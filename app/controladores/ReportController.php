<?php
class ReportController extends Controlador
{

    public function __construct()
    {
        session_start();
    }

    public function index(){

    }
    public function show(){
        $this->vista('Reportes/report');

    }
    public function reporteUsuarios(){
    $this->vista('Reportes/usuarios');

        
    }
}
