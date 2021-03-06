------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
      id bigserial PRIMARY KEY
    , dni varchar(9) NOT NULL UNIQUE
    , password varchar(255)
);

DROP TABLE IF EXISTS reservas CASCADE;

CREATE TABLE reservas
(
    id bigserial PRIMARY KEY
    , dia date NOT NULL
    , hora time NOT NULL
    , usuario_id bigint REFERENCES usuarios(id)
);

INSERT INTO usuarios(dni,password)
VALUES ('31597394V', crypt('pepe', gen_salt('bf', 11)))
     , ('49038938V', crypt('pepe', gen_salt('bf', 11)));
