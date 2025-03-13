<?php
require_once __DIR__ . '/../models/Libro.php';

class LibrosController {
    private $model;

    public function __construct() {
        $this->model = new Libro();
    }



    public function ObtenerTodos() {
        

        $todosLosDatos = $this->model->obtenerTodos();
        echo json_encode($todosLosDatos);
    }


    public function obtenerLibro($id) {

     
        echo json_encode($this->model->buscarPorID($id));
           
        // echo json_encode($this->model->all());
    }

    public function crearLibro() {
        $data = json_decode(file_get_contents('php://input'), true);


       // var_dump($data);
        echo json_encode($this->model->crear($data));
    }
}
        
?>
