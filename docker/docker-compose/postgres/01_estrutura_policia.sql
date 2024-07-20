-- Criação do banco de dados policia
CREATE DATABASE policia;

-- Conexão com o banco de dados policia
\c policia;

-- Criação do schema seguranca
CREATE SCHEMA policia;

-- Criação da tabela uf
CREATE TABLE policia.uf (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    sigla CHAR(2) NOT NULL,
    UNIQUE (sigla)
);

-- Criação da tabela cidade
CREATE TABLE policia.cidade (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    nome_det VARCHAR(255),
    cep VARCHAR(8),
    uf CHAR(2),
    situacao smallint,
    codigo_ibge VARCHAR(7),
    codigo_sefa INT,
    FOREIGN KEY (uf) REFERENCES policia.uf(sigla)
);

-- Criação da tabela bairro
CREATE TABLE policia.bairro (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cidade_id INT,
    nome_abrev VARCHAR(150),
    FOREIGN KEY (cidade_id) REFERENCES policia.cidade(id)
);

-- Criação da tabela unidade
CREATE TABLE policia.unidade (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    endereco VARCHAR(255),
    complemento VARCHAR(255),
    cep CHAR(10),
    numero VARCHAR(45),
    bairro_id INT,
    cidade_id INT,
    lat real,
    lng real,
    email VARCHAR(255),
    sigla VARCHAR(45),
    sede VARCHAR(45),
    codigo VARCHAR(45),
    status char NOT NULL,
    unidade_id INT,
    telefone VARCHAR(100),
    telefone2 VARCHAR(100),
    ip_rede VARCHAR(100),
    ip_satelite VARCHAR(100),
    ip_navega_para VARCHAR(100),
    circuito_fisp VARCHAR(100),
    link SMALLINT,
    contato VARCHAR(100),
    observacao TEXT,
    tipo_unidade_id INT,
    unidade_pai_id INT,
    orgao_externo BOOLEAN DEFAULT FALSE,
    fk_unidade_sisp INT,
    fk_risp INT,
    ordem INT,
    fk_especie_unidade INT,
    predio_dg BOOLEAN,
    atuacao_unidade CHAR,
    tipo_horario CHAR,
    horario VARCHAR(255),
    dpc_ideal INT,
    epc_ideal INT,
    ipc_ideal INT,
    ppc_ideal INT,
    dt_cadastro TIMESTAMP(6) DEFAULT timezone('America/Belem', now()),
    condicao_predio INT,

    FOREIGN KEY (unidade_pai_id) REFERENCES policia.unidade(id),
    FOREIGN KEY (cidade_id) REFERENCES policia.cidade(id)
);
