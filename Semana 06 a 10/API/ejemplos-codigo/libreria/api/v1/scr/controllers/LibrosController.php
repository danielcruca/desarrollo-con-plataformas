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

    // leyendo los datos del body
    // llamammos al modelo enviar los datos.
    // devolvemos el resultado
    public function crearLibro() {
    $data = json_decode(file_get_contents(filename: 'php://input'), true);
    $resultado = $this->model->crear($data);
        echo json_encode($resultado);
    }


    public function actualizarLibro($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $modeloLibro = new Libro(); 
        $resultado = $modeloLibro->actualizar($id,$data);       
        echo json_encode(value: ["Resultado" =>   $resultado]);
    }

    public function actualizar($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $modeloLibro = new Libro();        
        echo json_encode(value: ["Resultado" =>   $modeloLibro->update($id,$data)]);
        
    }

    public function eliminarLibro($id) {
        echo json_encode($this->model->eliminar($id));
    }
}
        
?>
