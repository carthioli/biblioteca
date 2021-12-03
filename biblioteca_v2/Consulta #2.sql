

DROP TABLE login

SELECT * FROM livro




SELECT l.id, l.nome, a.nome AS autor, e.nome AS editora
FROM livro AS l
JOIN autor AS a ON a.id = l.id_autor
JOIN editora AS e ON e.id = l.id_editora
WHERE l.nome = 'hiojee'