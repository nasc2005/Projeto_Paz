/* resumo das vendas */
CREATE VIEW vw_get_resumo_vendas AS
SELECT 
    v.id_venda, v.data_criacao, v.status_venda, v.formaPagamento, SUM(iv.quantidade * p.valor_venda) AS valor_total
    FROM vendas v
    JOIN itens_venda iv ON iv.id_venda = v.id_venda
    JOIN produtos p ON p.id_produto = iv.id_produto

/* detalhes da venda */
CREATE VIEW vw_get_detalhe_vendas AS
SELECT 
    v.id_venda, v.data_criacao, v.status_venda, v.formaPagamento,
    iv.quantidade,
    p.nome, (iv.quantidade * p.preco) AS valor_item, p.valor_custo, p.valor_venda 
    imgv.*
FROM vendas v
JOIN itens_venda iv ON iv.id_venda = v.id_venda
JOIN produtos p ON p.id_produto = iv.id_produto
JOIN 
    LEFT JOIN imagens_venda imgv ON imgv.id_imgsVenda = v.id_imgsVenda

/* quanto falta para atingir meta */
CREATE VIEW vw_get_atingir_meta AS
SELECT 
    m.id_meta, m.id_lugarMeta, m.usuarioCriador, 
    m.nome, m.valor, m.marca, m.imagem, m.status_meta, (i.saldo - m.valor) AS falta
FROM metas m
JOIN 
    LEFT JOIN lugares l ON l.id_lugar = m.id_lugarMeta
JOIN instituicoes i ON i.id_instituicoes = l.id_instituicaoLugar