CREATE TABLE autor(
id SERIAL,
nome VARCHAR(10),
sobrenome VARCHAR(20),
cpf CHAR(11) UNIQUE,
PRIMARY KEY (id)
)

INSERT INTO autor(nome, sobrenome, cpf) VALUES ('Dante', 'Alighieri', '00000000001'), 
('William', 'Shakespeare', '00000000002'), ('Platão', '', '00000000003'),
('Adam', 'Smith', '00000000004'), ('Homero', '', '00000000005'),

DROP TABLE emprestimo_livro;
DROP TABLE reserva_livro;
DROP TABLE livro;
DROP TABLE autor;
DROP TABLE emprestimo;
DROP TABLE reserva;
DROP TABLE aluno;