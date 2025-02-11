-- Obtener las transacciones y marcar si la cantidad vendida es mayor a 5
SELECT tv.*, 
    CASE 
        WHEN tv.cantidad > 5 THEN 'Mayor a 5'
        ELSE '5 o menos'
    END AS cantidad_marca
FROM transacciones_ventas tv;

-- Insertar un nuevo autor y libro dentro de una transacción con punto de guardado
START TRANSACTION;

SAVEPOINT sp1;
INSERT INTO autores (nombre, apellido, nacionalidad) VALUES ('Isabel', 'Allende', 'Chile');
-- Asumimos que el id_autor generado es 4
INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES ('La casa de los espíritus', 4, 20.00, 100);

-- Si todo es correcto, confirmar los cambios
COMMIT;


-- Encontrar libros que han sido vendidos al menos una vez
SELECT DISTINCT l.titulo
FROM libros l
JOIN transacciones_ventas tv ON l.id_libro = tv.id_libro;

-- SUM
-- Obtener la cantidad total de libros vendidos por cada autor
SELECT a.nombre, a.apellido, SUM(tv.cantidad) AS total_vendidos
FROM autores a
JOIN libros l ON a.id_autor = l.id_autor
JOIN transacciones_ventas tv ON l.id_libro = tv.id_libro
GROUP BY a.id_autor;


-- Obtener los libros junto con el nombre completo del autor
SELECT l.titulo, CONCAT(a.nombre, ' ', a.apellido) AS autor_completo
FROM libros l
JOIN autores a ON l.id_autor = a.id_autor;


-- Calcular el precio promedio de los libros
SELECT AVG(precio) AS precio_promedio FROM libros;

-- Obtener las ventas realizadas en el último mes
SELECT * FROM transacciones_ventas
WHERE fecha_venta >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);

-- Obtener la cantidad de días desde la primera venta hasta hoy
SELECT DATEDIFF(CURDATE(), MIN(fecha_venta)) AS dias_desde_primera_venta
FROM transacciones_ventas;