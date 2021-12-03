CREATE TABLE reserva_livro(
id SERIAL,
id_livro INT UNIQUE,
data_reserva DATE,
id_reserva INT, 
PRIMARY KEY (id),
CONSTRAINT fk_id_livro FOREIGN KEY (id_livro) REFERENCES livro(id),
CONSTRAINT fk_id_reserva FOREIGN KEY (id_reserva) REFERENCES reserva(id)
);
alter table reserva_livro
alter column data_reserva set default CURRENT_TIMESTAMP
