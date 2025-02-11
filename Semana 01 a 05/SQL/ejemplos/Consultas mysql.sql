#1 Clonar una tabla
-- Create table basado en una  ya creado.
CREATE TABLE libros_backup LIKE libros;

-- Insert into con los datos de otra tabla.
INSERT INTO libros_backup SELECT * FROM libros;

#2 Compara si ambas filas tienen la misma cantidad de filas
SELECT
    (SELECT COUNT(*) FROM libros) AS libros_count,
    (SELECT COUNT(*) FROM libros_backup) AS libros_backup_count;


#3 Compara si ambas filas tienen los mismos datos
--- Si devuelven nada significa que  tiene los mismos datos.
---  Esto nos dice: de libros saque lo que no esta en libros backup.
SELECT *
FROM libros
EXCEPT
SELECT *
FROM libros_backup;

SELECT *
FROM libros_backup
EXCEPT
SELECT *
FROM libros;



--#4  Cálculo de promedios
SELECT AVG(precio) AS promedio_precio FROM libros;



--#5 Cálculo de la moda
SELECT precio
FROM libros
GROUP BY precio
ORDER BY COUNT(*) DESC
LIMIT 1;


--#6 Aritmética de fechas
SELECT CURDATE() + INTERVAL 10 DAY AS nueva_fecha; -- Sumar 10 días
SELECT CURDATE() - INTERVAL 5 DAY AS nueva_fecha; -- Restar 5 días
SELECT DATEDIFF('2024-05-27', '2024-05-20') AS diferencia_dias; -- Diferencia entre dos fechas


--#6
SELECT *
FROM transacciones_ventas
WHERE fecha_venta BETWEEN '2024-05-01' AND '2024-05-3';

--7 Libros disponibles
CREATE VIEW libros_disponibles AS
SELECT *
FROM libros
WHERE cantidad_stock > 0;


-- Crear una vista jerárquica de autores y sus libros
CREATE VIEW autores_libros AS
SELECT a.id_autor, a.nombre, a.apellido, l.id_libro, l.titulo
FROM autores a
LEFT JOIN libros l ON a.id_autor = l.id_autor;


--# 8 Transaciones



-- Iniciar la transacción
START TRANSACTION;

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

-- Si todo es correcto, confirma la transacción
COMMIT;



-- # CRUD
-- Insertar un nuevo libro
START TRANSACTION;

INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES ('Nuevo Libro', 1, 10.99, 50);

-- Actualizar el precio de un libro
UPDATE libros SET precio = 12.99 WHERE titulo = 'Nuevo Libro';

-- Eliminar un libro
DELETE FROM libros WHERE titulo = 'Nuevo Libro';

-- Confirmar la transacción
COMMIT;

-- Insertar un autor con valores predeterminados para nacionalidad (provocará error si nacionalidad no permite NULL)
START TRANSACTION;

INSERT INTO autores (nombre, apellido) VALUES ('Juan', 'Pérez');

-- Provocando un error intencionalmente (asumiendo que la columna 'nacionalidad' es NOT NULL)
INSERT INTO autores (nombre, apellido, nacionalidad) VALUES ('María', 'López', NULL);

-- Confirmar la transacción si todo está bien
COMMIT;

-- Si ocurre un error, hacer rollback
ROLLBACK;
