USE superhero;

SELECT * FROM alignment; 	-- Bandos
SELECT * FROM attribute;	-- Atributos / Características
SELECT * FROM colour;		-- Lista de colores
SELECT * FROM comic;		-- No se utilizará
SELECT * FROM gener;		-- Géneros
SELECT * FROM publisher;	-- Casa publicación / distribuidores
SELECT * FROM race;			-- Razas
SELECT * FROM superhero;	-- Superheroe
SELECT * FROM superpower;	-- Talento / Habilidadsuperhero

DELIMITER $$
CREATE PROCEDURE spu_publishers_listar()
BEGIN
	SELECT
    id,
    publisher_name
    FROM publisher
    ORDER BY id;
END$$

DELIMITER $$
CREATE PROCEDURE spu_superheroes_listar()
BEGIN
	SELECT 
	  sh.id, 
	  sh.superhero_name, 
	  sh.full_name, 
	  g.gender, 
	  r.race
	FROM superhero.superhero sh
	INNER JOIN superhero.gender g ON sh.gender_id = g.id
	INNER JOIN superhero.race r ON sh.race_id = r.id
    GROUP BY sh.id
    ORDER BY sh.id;
END$$
    
DELIMITER $$
CREATE PROCEDURE spu_superheroes_por_editor(IN publisherId INT)
BEGIN
    SELECT s.id,
    s.superhero_name,
    s.full_name,
    g.gender,
    r.race
    FROM superhero s
    INNER JOIN gender g ON s.gender_id = g.id
    INNER JOIN race r ON s.race_id = r.id
    WHERE s.publisher_id = publisherId;
END$$

DELIMITER $$
CREATE PROCEDURE spu_alignment_listar()
BEGIN
	SELECT 
    id,
    alignment
    FROM alignment
    ORDER BY id;
END$$

DELIMITER $$
CREATE PROCEDURE spu_resumen_alignment()
BEGIN
	SELECT
		ali.alignment,count(alignment) AS 'totalalineamientos'
        FROM superhero sph
        INNER JOIN alignment ali ON sph.alignment_id = ali.id
        GROUP BY sph.alignment_id
        ORDER BY totalalineamientos;
END $$


DELIMITER $$
CREATE PROCEDURE spu_alignment_por_editor(
    IN publisherId INT
)
BEGIN
    SELECT a.alignment, COUNT(a.alignment) AS 'TotalAliPubli'
    FROM superhero sh
    INNER JOIN alignment a ON sh.alignment_id = a.id
    WHERE sh.publisher_id = publisherId
    GROUP BY a.alignment;
END$$

CALL spu_alignment_por_editor(1);