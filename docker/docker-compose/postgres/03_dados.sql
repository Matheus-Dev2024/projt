\c policia;

INSERT INTO policia.unidade(id, nome, status)
    VALUES (9,'DIRETORIA DE INFORMÁTICA, MANUTENÇÃO E ESTATÍSTICA', 1);



-- Tabela usuario
INSERT INTO seguranca.usuario(id, nome, email, senha, ativo, excluido, primeiro_acesso, cpf, nascimento, remember_token, unidade, status, fk_usuario_correicao, senha2, diretor, fk_unidade, updated_at)
VALUES (1,'DIME', 'dimepolicia@gmail.com','d161f8ff0e5c858f70409616359c61c69eee8153', true, false, false, '39531406200', '2010-10-10', null, null, 1, null, '$2y$10$roe3HQJbCNjlTD1X5zoKwO44iisVQU6uBw/.rEgqH4ryfDKiiueGi', null, 9, null),
       (26,'Philipe Barra', 'philipebarra@gmail.com', 'd161f8ff0e5c858f70409616359c61c69eee8153', true, false, false, '39531406200', '2010-10-10', null, null, 1, null, '$2y$10$roe3HQJbCNjlTD1X5zoKwO44iisVQU6uBw/.rEgqH4ryfDKiiueGi', null, 9, null);

-- Tabela status
INSERT INTO seguranca.status(id, nome, descricao)
VALUES (1, 'Ativo', 'Ativo'),
       (0, 'Inativo', 'Inativo'),
       (2, 'Não Publicado', 'Não Publicado');

-- Tabela sistemas
INSERT INTO seguranca.sistema(id, nome, link, imagem, descricao, fk_status)
VALUES (35, 'Skeleton', null, null, 'Arquitetura modelo para sistemas', 1);

-- Tabela usuario_sistema
INSERT INTO seguranca.usuario_sistema(sistema_id, usuario_id, status, fk_usuario_cadastro, fk_usuario_edicao)
VALUES (35, 26, 1, 1, 1);
