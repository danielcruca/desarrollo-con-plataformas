-- Cálculo de promedios
SELECT AVG(precio) AS promedio_precio FROM libros;

-- Cálculo de la mediana
SELECT AVG(precio) AS mediana_precio
FROM (
    SELECT precio
    FROM libros
    ORDER BY precio
    LIMIT 2 - (SELECT COUNT(*) FROM libros) % 2
    OFFSET (SELECT (COUNT(*) - 1) / 2 FROM libros)
) AS medianas;


-- Recuerda  actualizar para ver comportamiento: UPDATE `libreria`.`libros` SET `precio` = '15.99' WHERE (`id_libro` = '7');

-- Cálculo de la moda
SELECT precio
FROM libros
GROUP BY precio
ORDER BY COUNT(*) DESC
LIMIT 1;

-- Cálculo de diferencias acumuladas
SELECT 
    fecha_venta,
    total,
    @diferencia_acumulada := @diferencia_acumulada + total AS diferencia_acumulada
FROM 
    (SELECT fecha_venta, SUM(total) AS total FROM transacciones_ventas GROUP BY fecha_venta) t,
    (SELECT @diferencia_acumulada := 0) r
ORDER BY fecha_venta;



-- Aritmética de fechas
SELECT CURDATE() + INTERVAL 10 DAY AS nueva_fecha; -- Sumar 10 días
SELECT CURDATE() - INTERVAL 5 DAY AS nueva_fecha; -- Restar 5 días
SELECT DATEDIFF('2024-05-27', '2024-05-20') AS diferencia_dias; -- Diferencia entre dos fechas

SELECT *
FROM transacciones_ventas
WHERE fecha_venta BETWEEN '2024-05-01' AND '2024-05-3';


-- Creación de vista jerárquica
CREATE VIEW vista_autores_libros AS
SELECT 
    a.id_autor,
    a.nombre,
    a.apellido,
    l.id_libro,
    l.titulo,
    l.precio,
    l.cantidad_stock
FROM 
    autores a
LEFT JOIN 
    libros l ON a.id_autor = l.id_autor;

-- Consultar la vista jerárquica
SELECT * FROM vista_autores_libros ORDER BY id_autor, id_libro;



CREATE VIEW libros_disponibles AS
SELECT *
FROM libros
WHERE cantidad_stock > 0;


SELECT * FROM libros_disponibles;
