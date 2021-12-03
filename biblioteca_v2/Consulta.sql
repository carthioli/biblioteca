DROP TABLE reserva;
DROP TABLE reserva_livro;

DROP TABLE emprestimo_livro;
DROP TABLE emprestimo;
DROP TABLE livro;
DROP TABLE aluno


SELECT l.nome as titulo, a.nome as nome_autor, e.nome as nome_editora
FROM livro as l
JOIN autor AS a ON a.id = l.id_autor
JOIN editora as e ON e.id = l.id_editora

SELECT id, id_aluno 
FROM emprestimo
ORDER BY id DESC 
LIMIT 1

DROP TABLE emprestimo_livro;
DROP TABLE reserva_livro;
DROP TABLE reserva;
DROP TABLE emprestimo;
DROP TABLE login;


ALTER TABLE emprestimo_livro
ADD data_devolucao DATE 

insert into emprestimo_livro(data_devolucao) VALUES ("d/m/Y", strtotime( '+'['dias_emprestimo']. 'days', strtotime(['data_emprestimo']) ) )