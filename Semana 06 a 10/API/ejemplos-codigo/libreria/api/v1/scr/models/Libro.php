<?php
require_once __DIR__ . '/../db/Database.php';

class Libro {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function obtenerTodos() {
        $stmt = $this->db->query("
        SELECT 
                libros.id_libro,
                libros.titulo,
                libros.precio,
                libros.cantidad_stock,
                libros.id_autor,
                CONCAT(autores.nombre, ' ', autores.apellido) AS autor
            FROM 
                libros
            JOIN 
                autores
            ON 
                libros.id_autor = autores.id_autor;
        ");
        return $stmt->fetchAll();
    }

    public function buscarPorID($id) {
        $stmt = $this->db->prepare("SELECT * FROM libros WHERE id_libro = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


    public function crear($data)
    {
        $stmt = $this->db->prepare("INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['titulo'], $data['id_autor'], $data['precio'], $data['cantidad_stock']]);
        return ['id' => $this->db->lastInsertId()];   
    }


    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['titulo'], $data['id_autor'], $data['precio'], $data['cantidad_stock']]);
        return ['id' => $this->db->lastInsertId()];
    }


    public function actualizar($id, $data){

        // crear funcion
        // crear sql consulta
        //return algo
        $stmt = $this->db->prepare("UPDATE libros SET titulo = ?, id_autor = ?, precio = ?, cantidad_stock = ? WHERE id_libro = ?");
        $stmt->execute([$data['titulo'], $data['id_autor'], $data['precio'], $data['cantidad_stock'], $id]);
        return ['success' => true];
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE libros SET titulo = ?, id_autor = ?, precio = ?, cantidad_stock = ? WHERE id_libro = ?");
        $stmt->execute([$data['titulo'], $data['id_autor'], $data['precio'], $data['cantidad_stock'], $id]);
        return ['success' => true];
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM libros WHERE id_libro = ?");
        $stmt->execute([$id]);
        return ['success' => true];
    }


    public function eliminar($id){
        try 
        {
            $stmt = $this->db->prepare("DELETE FROM libros WHERE id_libro = ?");
            $stmt->execute([$id]);
            return ['Eliminado' => true];

        } catch(Exception $e)
        {
            echo $e;
            // escribir en un log
            return ['Eliminado' => false];
        }
      

    }
}
?>
