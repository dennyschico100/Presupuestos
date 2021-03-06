<?php

class Categorias extends Controlador
{

    function __construct()
    {
        session_start();
        $this->CategoriaModelo = $this->modelo('Categoria');
    }

    private $data = ['errores' => ''];
    private $dataUsuario = ['errores' => ''];
    private $idCategoria;

    public function sanitizar_campos($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function index()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $input = json_decode(file_get_contents('php://input'));
        $method = $_SERVER['REQUEST_METHOD'];

        if ($this->isLoggedIn()) {
            $this->vista("home/index");
        } else {
            echo "otra vez";
            $this->vista("usuarios/login");
        }
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_rol_presupuestos']) && isset($_SESSION['user_id_presupuestos']) && isset($_SESSION['user_nombres_presupuestos']) && isset($_SESSION['user_email_presupuestos'])) {

            if ($_SESSION['user_rol_presupuestos'] == 1) {

                return true;
            } else {
                return false;
            }
        }
    }


    public function obtenerTodos()
    {

        $resultado = $this->CategoriaModelo->listar();
    }

    public function listar()
    {
        $this->vista('Categorias/index');
    }



    public function show()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_NUMBER_INT);

            if (!empty($_GET['id'])) {

                $this->idCategoria = $_GET['id'];
                $this->CategoriaModelo->buscarCategoria($this->idCategoria);
            }
        }
    }

    public function store()
    {
        $categories = $this->CategoriaModelo;

        $input = json_decode(file_get_contents("php://input"));

        foreach ($input as $key => $value) {
            $this->data[$key] = $this->sanitizar_campos($value);
        }

        $dataCategory = (object) $this->data;

        $categories->name = $dataCategory->name;

        $categories->store();
    }

    public function update()
    {

        $categories = $this->CategoriaModelo;

        $input = json_decode(file_get_contents("php://input"));

        foreach ($input as $key => $value) {
            $this->data[$key] = $this->sanitizar_campos($value);
        }

        $dataCategory = (object) $this->data;

        $categories->id = $dataCategory->id;
        $categories->name = $dataCategory->name;
        $categories->update();
    }

    public function delete()
    {
        if($_SERVER['REQUEST_METHOD'] == "DELETE"){
            $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_NUMBER_INT);

            if (!empty($_GET['id'])) {

                $this->idCategoria = $_GET['id'];
                $this->CategoriaModelo->delete($this->idCategoria);
            }
        }
        
    }
}
