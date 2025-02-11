-- Create table basado en una  ya creado.
CREATE TABLE libros_backup LIKE libros;

-- Insert into con los datos de otra tabla.
INSERT INTO libros_backup SELECT * FROM libros;

--- count(*)
---Sirve para contar cuantos datos datos hay en una tabla

---  Compara si ambas filas tienen la misma cantidad de filas
SELECT
    (SELECT COUNT(*) FROM libros) AS libros_count,
    (SELECT COUNT(*) FROM libros_backup) AS libros_backup_count;


-- Insertar este libro para probar queries de abajo.
INSERT INTO `libreria`.`libros` (`titulo`, `id_autor`, `precio`, `cantidad_stock`) VALUES ('Quijotoe', '1', '11', '10');


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
