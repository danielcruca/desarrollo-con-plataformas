-- Eliminar la base de datos si ya existe
DROP DATABASE IF EXISTS libreria;

-- Crear la base de datos
CREATE DATABASE libreria;

-- Seleccionar la base de datos
USE libreria;

-- Creación de la tabla "autores"
CREATE TABLE autores (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    nacionalidad VARCHAR(50)
);

-- Creación de la tabla "libros"
CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    id_autor INT,
    precio DECIMAL(10, 2),
    cantidad_stock INT,
    FOREIGN KEY (id_autor) REFERENCES autores(id_autor)
);

-- Creación de la tabla "transacciones_ventas"
CREATE TABLE transacciones_ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_libro INT,
    fecha_venta DATE,
    cantidad INT,
    total DECIMAL(10, 2),
    FOREIGN KEY (id_libro) REFERENCES libros(id_libro)
);

-- Datos para la tabla "autores"
INSERT INTO autores (nombre, apellido, nacionalidad) VALUES
    ('Gabriel', 'García Márquez', 'Colombia'),
    ('J.K.', 'Rowling', 'Reino Unido'),
    ('Stephen', 'King', 'Estados Unidos');

-- Datos para la tabla "libros"
INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES
    ('Cien años de soledad', 1, 19.99, 100),
    ('Harry Potter y la piedra filosofal', 2, 15.99, 150),
    ('El resplandor', 3, 12.99, 80),
    ('El amor en los tiempos del cólera', 1, 18.50, 120),
    ('It', 3, 14.75, 90);

-- Datos para la tabla "transacciones_ventas"
INSERT INTO transacciones_ventas (id_libro, fecha_venta, cantidad, total) VALUES
    (1, '2024-05-01', 5, 99.95),
    (2, '2024-05-03', 10, 159.90),
    (3, '2024-05-05', 3, 38.97),
    (4, '2024-05-07', 8, 148.00),
    (5, '2024-05-10', 6, 88.50);

-- # CRUD
-- Insertar un nuevo libro
INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES ('Nuevo Libro', 1, 10.99, 50);

-- Actualizar el precio de un libro
SET SQL_SAFE_UPDATES = 0;
UPDATE libros SET precio = 12.99 WHERE titulo = 'Nuevo Libro';

-- Eliminar un libro
DELETE FROM libros WHERE titulo = 'Nuevo Libro';

-- Insertar un autor con valores predeterminados para nacionalidad
INSERT INTO autores (nombre, apellido) VALUES ('Juan', 'Pérez');

--- Calculos:

-- Calcular el precio promedio de los libros
SELECT AVG(precio) AS precio_promedio FROM libros;

--- Order by
-- Obtener todos los libros ordenados por título
SELECT * FROM libros
ORDER BY titulo;


/*1. Obtener libros vendidos y su cantidad restante en stock
 */
SELECT l.id_libro, l.titulo, l.cantidad_stock, SUM(tv.cantidad) AS cantidad_vendida
FROM libros l
JOIN transacciones_ventas tv ON l.id_libro = tv.id_libro
GROUP BY l.id_libro, l.titulo, l.cantidad_stock;

/*
2. Obtener el listado de las 5 autores más vendidos y su cantidad de ventas

*/
SELECT a.nombre AS autor_nombre, a.apellido AS autor_apellido, SUM(tv.cantidad) AS total_ventas
FROM autores a
JOIN libros l ON a.id_autor = l.id_autor
JOIN transacciones_ventas tv ON l.id_libro = tv.id_libro
GROUP BY a.nombre, a.apellido
ORDER BY total_ventas DESC
LIMIT 5;

/* vista  */

-- Crear una vista jerárquica de autores y sus libros
CREATE VIEW autores_libros AS
SELECT a.id_autor, a.nombre, a.apellido, l.id_libro, l.titulo
FROM autores a
LEFT JOIN libros l ON a.id_autor = l.id_autor;


--- Inner join simple:

SELECT libros.id_libro, libros.titulo, autores.nombre, autores.apellido, libros.cantidad_stock FROM libros JOIN autores ON libros.id_autor = autores.id_autor;
