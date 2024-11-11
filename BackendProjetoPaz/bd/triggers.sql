/* alterar quantidade de produtos */
CREATE TRIGGER atualizar_estoque
ON itens_vendas
FOR INSERT
AS
BEGIN
    DECLARE
    @QNT INT,
    @IDPROD INT,

    SELECT @QNT = quantidade, @IDPROD = id_produto
    FROM INSERTED

    UPDATE produto
    SET estoque = estoque - @QNT
    WHERE id_produto = @IDPROD
END
/* atualizar o saldo da instituição */
CREATE TRIGGER atualizar_saldo
ON vendas
FOR INSERT
AS
BEGIN
    DECLARE
    @TOTAL FLOAT,
    @IDLUGAR INT,
    @IDINST INT,

    SELECT 
        @QNT = quantidade, 
        @IDLUGAR = id_lugar
    FROM INSERTED

    UPDATE instituicoes
    SET saldo = saldo + @TOTAL
    WHERE id_instituicao = @IDINST
END