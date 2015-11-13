# Colocando campo de data de admissão nos usuários.

# Quem tiver data de admissão aparecerá no sistema de férias

ALTER TABLE usuario ADD COLUMN admissao date;


CREATE TABLE ferias (
	pront VARCHAR(8) NOT NULL,
	created_on datetime NOT NULL,
	abono BOOLEAN DEFAULT TRUE,
	adiantamento BOOLEAN DEFAULT FALSE, 
	aquisicao_ini DATE NOT NULL,
	ferias_ini DATE NOT NULL
) ENGINE=INNODB;