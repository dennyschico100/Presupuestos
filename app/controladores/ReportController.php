<?php
class ReportController extends Controlador
{

    public function __construct()
    {
        session_start();
    }

    public function show(){
        $this->vista('Reportes/report');
    }
}
