-- atualizar metas
CREATE PROCEDURE atualizar_meta
AS 
BEGIN
    DECLARE
    @SALDO FLOAT,
    @VALOR FLOAT,
    @META FLOAT,

    SELECT @SALDO = saldo, @VALOR = valor 
    FROM metas m
    JOIN lugares l ON m.id_lugarMeta = id_meta;
    JOIN instituicoes i ON l.id_instLugar = i.id_instituicao 
    
    @META = @SALDO - @VALOR
END