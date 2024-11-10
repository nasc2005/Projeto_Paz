-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 14/10/2024 às 19:05
-- Versão do servidor: 8.0.39
-- Versão do PHP: 8.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_paz`
--

CREATE DATABASE IF NOT EXISTS `bd_paz` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bd_paz`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imgs_vendas`
--

DROP TABLE IF EXISTS `imgs_vendas`;
CREATE TABLE `imgs_vendas` (
  `id_imgsVenda` int NOT NULL,
  `img_pix` text,
  `img_dinheiro` text,
  `img_comprovante` text,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `instituicoes`
--

DROP TABLE IF EXISTS `instituicoes`;
CREATE TABLE `instituicoes` (
  `id_instituicao` int NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` text,
  `logo` text,
  `saldo` float DEFAULT NULL,
  `data_cricao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_vendas`
--

DROP TABLE IF EXISTS `itens_vendas`;
CREATE TABLE `itens_vendas` (
  `id_itensVenda` int NOT NULL,
  `id_produto` int NOT NULL,
  `id_venda` int NOT NULL,
  `quantidade` int DEFAULT NULL,
  `preco_unitario` float DEFAULT NULL,
  `subtotal` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lugares`
--

DROP TABLE IF EXISTS `lugares`;
CREATE TABLE `lugares` (
  `id_lugar` int NOT NULL,
  `id_instituicao` int NOT NULL,
  `apelido` varchar(100) DEFAULT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `arranjo` varchar(45) DEFAULT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `metas`
--

DROP TABLE IF EXISTS `metas`;
CREATE TABLE `metas` (
  `id_meta` int NOT NULL,
  `id_lugar` int NOT NULL,
  `id_usuarioCriador` int NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `imagem` text,
  `status_meta` varchar(50) DEFAULT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id_produto` int NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `valor_custo` float DEFAULT NULL,
  `imagem` text,
  `categoria` varchar(45) DEFAULT NULL,
  `valor_venda` float DEFAULT NULL,
  `descricao` text,
  `estoque` int DEFAULT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL,
  `id_instituicao` int NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `perfil` varchar(45) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `imagem` text,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE `vendas` (
  `id_venda` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_lugar` int NOT NULL,
  `id_imgsVenda` int NOT NULL,
  `total` float DEFAULT NULL,
  `forma_pagamento` varchar(50) DEFAULT NULL,
  `status_venda` varchar(50) DEFAULT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `imgs_vendas`
--
ALTER TABLE `imgs_vendas`
  ADD PRIMARY KEY (`id_imgsVenda`);

--
-- Índices de tabela `instituicoes`
--
ALTER TABLE `instituicoes`
  ADD PRIMARY KEY (`id_instituicao`);

--
-- Índices de tabela `itens_vendas`
--
ALTER TABLE `itens_vendas`
  ADD PRIMARY KEY (`id_itensVenda`),
  ADD KEY `id_produto_idx` (`id_produto`),
  ADD KEY `id_venda_idx` (`id_venda`);

--
-- Índices de tabela `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`id_lugar`),
  ADD KEY `id_instituicao_idx` (`id_instituicaoLugar`);

--
-- Índices de tabela `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id_meta`),
  ADD KEY `id_lugar_idx` (`id_lugar`),
  ADD KEY `id_usuarioCriador_idx` (`id_usuarioCriador`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_instituicao_idx` (`id_instituicao`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id_venda`),
  ADD KEY `id_usuario_idx` (`id_usuarioVenda`),
  ADD KEY `id_imgsVenda_idx` (`id_imgsVenda`),
  ADD KEY `id_lugarVenda_idx` (`id_lugarVenda`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `imgs_vendas`
--
ALTER TABLE `imgs_vendas`
  MODIFY `id_imgsVenda` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `instituicoes`
--
ALTER TABLE `instituicoes`
  MODIFY `id_instituicao` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens_vendas`
--
ALTER TABLE `itens_vendas`
  MODIFY `id_itensVenda` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lugares`
--
ALTER TABLE `lugares`
  MODIFY `id_lugar` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `metas`
--
ALTER TABLE `metas`
  MODIFY `id_meta` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id_venda` int NOT NULL AUTO_INCREMENT; 

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_vendas`
--
ALTER TABLE `itens_vendas`
  ADD CONSTRAINT `fk_itens_vendas_id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`),
  ADD CONSTRAINT `fk_itens_vendas_id_venda` FOREIGN KEY (`id_venda`) REFERENCES `vendas` (`id_venda`);

--
-- Restrições para tabelas `lugares`
--
ALTER TABLE `lugares`
  ADD CONSTRAINT `fk_lugares_id_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicoes` (`id_instituicao`);

--
-- Restrições para tabelas `metas`
--
ALTER TABLE `metas`
  ADD CONSTRAINT `fk_metas_id_lugar` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id_lugar`),
  ADD CONSTRAINT `fk_metas_id_usuarioCriador` FOREIGN KEY (`id_usuarioCriador`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_id_instituicao` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicoes` (`id_instituicao`);

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_vendas_id_imgsVenda` FOREIGN KEY (`id_imgsVenda`) REFERENCES `imgs_vendas` (`id_imgsVenda`),
  ADD CONSTRAINT `fk_vendas_id_lugar` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id_lugar`),
  ADD CONSTRAINT `fk_vendas_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
