CREATE TABLE livro(
id SERIAL,
nome VARCHAR(30),
id_autor INT,
id_editora INT,
PRIMARY KEY (id),
CONSTRAINT fk_id_autor FOREIGN KEY (id_autor) REFERENCES autor(id),
CONSTRAINT fk_id_editora FOREIGN KEY (id_editora) REFERENCES editora(id)
)