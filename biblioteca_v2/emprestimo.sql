CREATE TABLE emprestimo(
id SERIAL,
id_aluno INT,
data_emprestimo DATE,
PRIMARY KEY (id),
CONSTRAINT fk_id_aluno FOREIGN KEY (id_aluno) REFERENCES aluno(id)
);
alter table emprestimo
alter column data_emprestimo set default CURRENT_TIMESTAMP
