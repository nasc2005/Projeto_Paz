/* TABELA DE INSTITUIÇÕES */
INSERT INTO `instituicoes` (nome, descricao, logo, saldo)
VALUES 
('Instituto de Educação e Cultura', 'Uma instituição dedicada à promoção de eventos culturais e educacionais.', 'https://example.com/logo1.png', 25000.00),
('Associação Desportiva Alvorada', 'Organização sem fins lucrativos focada na prática esportiva para jovens.', 'https://example.com/logo2.png', 15000.50),
('Fundação Vida Saudável', 'Fundação que promove atividades de saúde e bem-estar para a comunidade.', 'https://example.com/logo3.png', 10000.75),
('Centro de Artes Integradas', 'Uma instituição que oferece cursos de música, dança e teatro para crianças e adolescentes.', 'https://example.com/logo4.png', 12500.00),
('Sociedade Protetora dos Animais', 'Organização dedicada à proteção e cuidado de animais abandonados.', 'https://example.com/logo5.png', 5000.25);

/* TABELA DE USUARIOS*/
INSERT INTO `usuarios` (id_instituicao, nome, telefone, email, senha, cpf, perfil, data_nasc, imagem)
VALUES 
(1, 'João da Silva', '11987654321', 'joao.silva@example.com', 'senha123', '123.456.789-00', 'Administrador', '1990-05-15', 'https://example.com/user1.png'),
(1, 'Maria Oliveira', '11976543210', 'maria.oliveira@example.com', 'senha456', '987.654.321-00', 'Vendedor', '1992-11-25', 'https://example.com/user2.png'),
(2, 'Carlos Pereira', '11965432109', 'carlos.pereira@example.com', 'senha789', '456.789.123-00', 'Vendedor', '1985-07-30', 'https://example.com/user3.png'),
(3, 'Ana Souza', '11954321098', 'ana.souza@example.com', 'senha101', '789.123.456-00', 'Vendedor', '1988-03-10', 'https://example.com/user4.png'),
(4, 'Pedro Gomes', '11943210987', 'pedro.gomes@example.com', 'senha202', '321.654.987-00', 'Administrador', '1995-09-20', 'https://example.com/user5.png');

/* TABELA DE LUGARES */
INSERT INTO `lugares` (id_instituicaoLugar, apelido, endereco, numero, arranjo)
VALUES 
(1, 'Auditório Central', 'Rua das Flores', '123', 'Palco frontal'),
(2, 'Campo de Futebol', 'Av. Esportiva', '456', 'Gramado aberto'),
(3, 'Sala de Conferências', 'Rua da Saúde', '789', 'Cadeiras circulares'),
(4, 'Teatro Jovem', 'Av. das Artes', '101', 'Palco central'),
(5, 'Abrigo dos Animais', 'Rua dos Bichos', '202', 'Espaço cercado');

/* TABELA DE METAS */
INSERT INTO `metas` (id_lugar, id_usuarioCriador, nome, valor, marca, imagem, status_meta)
VALUES 
(1, 1, 'Reforma do Auditório', 15000.00, 'Campanha de Doações', 'https://example.com/meta1.png', 'Em andamento'),
(2, 2, 'Construção do Vestiário', 10000.00, 'Patrocínio Esportivo', 'https://example.com/meta2.png', 'Concluída'),
(3, 3, 'Renovação dos Equipamentos', 8000.00, 'Fundo de Saúde', 'https://example.com/meta3.png', 'Em andamento'),
(4, 4, 'Ampliação do Teatro', 20000.00, 'Doação Artística', 'https://example.com/meta4.png', 'Pendente'),
(5, 5, 'Criação de Novos Abrigos', 12000.00, 'Apoio Animal', 'https://example.com/meta5.png', 'Em andamento');

/* TABELA DE IMAGENS DAS VENDAS */
INSERT INTO `imgs_vendas` (img_pix, img_dinheiro, img_comprovante)
VALUES 
('https://example.com/pix1.png', 'https://example.com/dinheiro1.png', 'https://example.com/comprovante1.png'),
('https://example.com/pix2.png', 'https://example.com/dinheiro2.png', 'https://example.com/comprovante2.png'),
('https://example.com/pix3.png', 'https://example.com/dinheiro3.png', 'https://example.com/comprovante3.png'),
('https://example.com/pix4.png', 'https://example.com/dinheiro4.png', 'https://example.com/comprovante4.png'),
('https://example.com/pix5.png', 'https://example.com/dinheiro5.png', 'https://example.com/comprovante5.png');

/* TABELA DE VENDAS */
INSERT INTO `vendas` (id_usuarioVenda, id_lugarVenda, id_imgsVenda, total, forma_pagamento, status_venda)
VALUES 
(1, 1, 1, 300.00, 'PIX', 'Concluída'),
(2, 2, 2, 150.00, 'Dinheiro', 'Pendente'),
(3, 3, 3, 500.00, 'Cartão de Crédito', 'Concluída'),
(4, 4, 4, 250.00, 'PIX', 'Cancelada'),
(5, 5, 5, 100.00, 'Dinheiro', 'Em andamento');


/* TABELA DE PRODUTOS */
INSERT INTO `produtos` (nome, valor_custo, imagem, categoria, valor_venda, descricao, estoque)
VALUES 
('Camiseta Personalizada', 15.00, 'https://example.com/produto1.png', 'Vestuário', 30.00, 'Camiseta de algodão com estampa personalizada.', 100),
('Caneca Promocional', 5.00, 'https://example.com/produto2.png', 'Brindes', 12.00, 'Caneca de cerâmica com logo da instituição.', 50),
('Chaveiro', 2.00, 'https://example.com/produto3.png', 'Acessórios', 5.00, 'Chaveiro de metal com o símbolo da campanha.', 200),
('Boné Esportivo', 10.00, 'https://example.com/produto4.png', 'Vestuário', 20.00, 'Boné esportivo com design personalizado.', 75),
('Agenda 2024', 8.00, 'https://example.com/produto5.png', 'Papelaria', 18.00, 'Agenda personalizada para o ano de 2024.', 150);

/* TABELA DE ITENS DAS VENDAS */
INSERT INTO `itens_vendas` (id_produto, id_venda, quantidade, preco_unitario, subtotal)
VALUES 
(1, 1, 2, 30.00, 60.00),
(2, 1, 1, 12.00, 12.00),
(3, 2, 5, 5.00, 25.00),
(4, 3, 3, 20.00, 60.00),
(5, 4, 2, 18.00, 36.00);