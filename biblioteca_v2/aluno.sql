CREATE TABLE aluno(
id SERIAL,
nome VARCHAR(10),
sobrenome VARCHAR(20),
cpf CHAR(11) UNIQUE NOT NULL,
telefone VARCHAR(11),
PRIMARY KEY (id)
)

INSERT INTO aluno(id, nome, sobrenome, cpf, telefone) VALUES (0,'Admin', '', 0, '')

DROP TABLE aluno

CREATE TABLE login(
id SERIAL, 
id_usuario INT UNIQUE,
nivel INT NOT NULL DEFAULT '1',
nome VARCHAR(20),
senha VARCHAR(40),
PRIMARY KEY (id)
);

INSERT INTO login(id_usuario, nome, senha) VALUES (0, 'Admin', 12345)