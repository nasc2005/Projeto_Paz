-- historico de vendas
CREATE VIEW vw_get_historico_vendas AS
SELECT 
    total, 
    status_venda, 
    forma_pagamento,
    quantidade,
    preco_unitario,
    subtotal,
    nome,
    imagem,
    img_pix,
    img_dinheiro,
    img_comprovante
FROM itens_vendas iv
JOIN vendas v ON iv.id_venda = v.id_venda;
JOIN produto p ON iv.id_produto = p.id_produto;
JOIN imgs_vendas imgv ON v.id_imgVenda = imgv.id_imgVenda;

-- vendas de tal lugar

-- vendas dos usuarios

-- metas de tal lugar

-- usuarios de tal instituição

-- produtos de tal instituição

-- 