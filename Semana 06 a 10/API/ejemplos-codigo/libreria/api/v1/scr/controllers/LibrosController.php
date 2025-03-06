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


    public function get($id) {

     
        echo json_encode($this->model->obtenerTodos());
           
        // echo json_encode($this->model->all());
    }
    }
        
?>
