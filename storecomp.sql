-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/05/2025 às 23:38
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `storecomp`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Desktop'),
(2, 'Monitor'),
(3, 'Notebook'),
(4, 'Hardware');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categorias_id` int(11) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `qtd_estoque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `categorias_id`, `imagem`, `qtd_estoque`) VALUES
(1, 'Notebook-Gamer-Acer-Nitro-V15-Intel-Core-i5-13-Gera-o-8GB-RTX-3050-SSD-512GB-Tela-15-6-Full-HD-Linux', 4599.00, 3, 'img/notebook.webp', 5),
(2, 'Monitor-gamer-lg-ultragear-24-full-hd-ips-180hz-1ms-displayport-e-hdmi-nvidia-g-sync-amd-freesync-hdr10-srgb-99-24gs60f', 899.99, 2, 'img/monitor.webp', 3),
(3, 'PC-Gamer-BluePC-Legacy-AMD-Ryzen-5-5600GT-16GB-RAM-Radeon-VEGA-7-SSD-480GB-Fonte-500W-PGBP-1001LEG_1744900832', 2399.00, 1, 'img/desktop.webp', 10),
(5, 'Placa-de-Video-rx-7800xt-gaming-16g-xfx-speedster-qick319-radeon-16gb-ddr6-hdmi-3xdp-3-fan-rx-78tqickf9_1719595732_m', 3899.99, 4, 'img/Placa-de-Video-Rx-Gaming.webp', 50),
(6, 'Water-Cooler-Husky-Freezy-argb-240mm-amd-e-intel-preto-hwt200pt_1732644962_m', 207.90, 4, 'img/Water-Cooler-Husky.webp', 5),
(15, 'teste', 55.00, 3, 'img/download.webp', 25);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` int(15) NOT NULL,
  `adm` tinyint(1) NOT NULL DEFAULT 0,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `senha`, `email`, `telefone`, `adm`, `criado_em`, `id`) VALUES
('Ryan', '10', 'admin@storecomp.com', 2147483647, 1, '2025-05-28 02:29:31', 1),
('teste', '1', 'teste@teste', 1452, 0, '2025-05-28 02:51:42', 2),
('cliente', '20', 'cliente@cliente.com.br', 2147483647, 0, '2025-05-28 02:53:23', 3),
('Lucas', '20', 'lucas@storecomp.com', 2147483647, 1, '2025-05-28 03:16:00', 6),
('teste', '123456', 'admin@storecomp.com', 189999999, 1, '2025-05-28 11:11:32', 8),
('cmendonca', '1234', 'cliente@cliente.com.br', 2147483647, 0, '2025-05-28 11:15:24', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `data_venda` date NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `endereco_entrega` varchar(255) DEFAULT NULL,
  `metodo_pagamento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas`
--

INSERT INTO `vendas` (`id`, `data_venda`, `id_usuario`, `endereco_entrega`, `metodo_pagamento`) VALUES
(1, '2025-05-28', 3, 'Rua Luiz Amo Luna 243', 'Pix'),
(2, '2025-05-28', 3, 'Rua Augusto Joao 2-34', 'Cartão de Crédito'),
(3, '2025-05-28', 3, 'Teste', 'Boleto'),
(4, '2025-05-28', 3, 'teste', 'Boleto');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas_itens`
--

CREATE TABLE `vendas_itens` (
  `id` int(11) NOT NULL,
  `vendas_id` int(11) DEFAULT NULL,
  `produtos_id` int(11) DEFAULT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendas_itens`
--

INSERT INTO `vendas_itens` (`id`, `vendas_id`, `produtos_id`, `quantidade`, `preco_unitario`) VALUES
(1, 1, 1, 2, 4599.00),
(2, 4, 5, 1, 3899.99);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorias_id` (`categorias_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Índices de tabela `vendas_itens`
--
ALTER TABLE `vendas_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendas_id` (`vendas_id`),
  ADD KEY `produtos_id` (`produtos_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `vendas_itens`
--
ALTER TABLE `vendas_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`);

--
-- Restrições para tabelas `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `vendas_itens`
--
ALTER TABLE `vendas_itens`
  ADD CONSTRAINT `vendas_itens_ibfk_1` FOREIGN KEY (`vendas_id`) REFERENCES `vendas` (`id`),
  ADD CONSTRAINT `vendas_itens_ibfk_2` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
