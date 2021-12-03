CREATE TABLE reserva(
id SERIAL,
id_aluno INT,
PRIMARY KEY (id),
CONSTRAINT fk_id_aluno FOREIGN KEY (id_aluno) REFERENCES aluno(id)
)