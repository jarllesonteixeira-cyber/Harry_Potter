CREATE TABLE feiticos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    movimento_varinha VARCHAR(150),
    efeito VARCHAR(255) NOT NULL,
    nivel_dificuldade VARCHAR(20) NOT NULL,
    proibido TINYINT(1) DEFAULT 0
);