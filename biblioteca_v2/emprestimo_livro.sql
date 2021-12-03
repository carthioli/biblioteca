CREATE TABLE emprestimo_livro(
id SERIAL,
id_livro INT UNIQUE,
id_emprestimo INT,
dias_emprestimo INT,
data_devolucao DATE,
PRIMARY KEY (id),
CONSTRAINT fk_id_livro FOREIGN KEY (id_livro) REFERENCES livro(id),
CONSTRAINT fk_id_emprestimo FOREIGN KEY (id_emprestimo) REFERENCES emprestimo(id)
);

DROP TABLE emprestimo_livro