---- Supongamos que queremos encontrar el total de ventas por autor. Para esto, necesitamos combinar las tablas libros y transacciones_ventas, y luego usar funciones de agregado.


SELECT a.nombre, a.apellido, SUM(tv.total) AS total_ventas
FROM autores a
INNER JOIN libros l ON a.id_autor = l.id_autor
INNER JOIN transacciones_ventas tv ON l.id_libro = tv.id_libro
GROUP BY a.id_autor, a.nombre, a.apellido;
