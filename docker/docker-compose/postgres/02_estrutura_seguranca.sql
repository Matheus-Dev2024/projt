-- Conexão com o banco de dados policia
\c policia;

-- Criação do schema seguranca
CREATE SCHEMA seguranca;

CREATE TABLE IF NOT EXISTS seguranca.usuario (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    ativo BOOLEAN NOT NULL,
    dt_cadastro TIMESTAMP(0) DEFAULT timezone('America/Belem', now()),
    excluido BOOLEAN DEFAULT FALSE,
    primeiro_acesso BOOLEAN,
    cpf CHAR(11),
    nascimento DATE,
    remember_token VARCHAR(100),
    unidade VARCHAR(255),
    status INT DEFAULT 1,
    fk_usuario_correicao INT,
    senha2 char(60),
    diretor BOOLEAN DEFAULT FALSE,
    fk_unidade INT,
    updated_at TIMESTAMP(0) DEFAULT timezone('America/Belem', now()),
    FOREIGN KEY (fk_unidade) REFERENCES policia.unidade(id)
);

CREATE TABLE IF NOT EXISTS seguranca.status (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    descricao VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS seguranca.sistema (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    link VARCHAR(100),
    imagem VARCHAR(50),
    descricao VARCHAR(100),
    fk_status INT,
    FOREIGN KEY (fk_status) REFERENCES seguranca.status(id)
);

CREATE TABLE IF NOT EXISTS seguranca.usuario_sistema (
    id SERIAL,
    sistema_id INT NOT NULL,
    usuario_id INT NOT NULL,
    ultimo_acesso date now(),
    status INT DEFAULT 1,
    fk_usuario_cadastro INT,
    fk_usuario_edicao INT,
    created_at TIMESTAMP(0) DEFAULT timezone('America/Belem', now()),
    updated_at TIMESTAMP(0) DEFAULT timezone('America/Belem', now()),
    PRIMARY KEY (sistema_id, usuario_id),
    FOREIGN KEY (fk_usuario_cadastro) REFERENCES seguranca.usuario(id),
    FOREIGN KEY (fk_usuario_edicao) REFERENCES seguranca.usuario(id)
);

CREATE TABLE IF NOT EXISTS seguranca.acesso (
    id SERIAL PRIMARY KEY,
    fk_usuario INT NOT NULL,
    ip VARCHAR(15),
    login TIMESTAMP(0) NOT NULL,
    logout TIMESTAMP(0),
    user_agent VARCHAR(255),
    ultimo_acesso TIMESTAMP(0),
    session_id char(36),
    fk_sistema_login INT,
    fk_sistema_logout INT,
    FOREIGN KEY (fk_usuario) REFERENCES seguranca.usuario(id),
    FOREIGN KEY (fk_sistema_login) REFERENCES seguranca.sistema(id),
    FOREIGN KEY (fk_sistema_logout) REFERENCES seguranca.sistema(id)
);

CREATE TABLE IF NOT EXISTS seguranca.link_temporario (
    id SERIAL PRIMARY KEY,
    fk_usuario INT NOT NULL,
    data_expiracao TIMESTAMP(0) NOT NULL,
    usado BOOLEAN DEFAULT FALSE,
    hash VARCHAR(40) NOT NULL,
    data_gerado TIMESTAMP(0) NOT NULL DEFAULT timezone('America/Belem', now()),
    FOREIGN KEY (fk_usuario) REFERENCES seguranca.usuario(id)
);
