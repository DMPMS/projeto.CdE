-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jul-2020 às 17:01
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cde`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cde_produto`
--

CREATE TABLE `cde_produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `preco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qtdrestante` int(11) NOT NULL,
  `criadoem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cde_produto`
--

INSERT INTO `cde_produto` (`id`, `nome`, `foto`, `id_tipo`, `preco`, `qtdrestante`, `criadoem`) VALUES
(1, 'J7 Prime 16GB', '1.png', 1, '1919.99', 86, '01/06/2020 às 20:59'),
(2, 'Galaxy A10s', '2.png', 0, '941.00', 93, '01/06/2020 às 21:00'),
(3, 'Motorola E6', '3.jpg', 1, '749.99', 94, '01/06/2020 às 21:04'),
(4, 'Redmi Note 8', '4.jpg', 1, '1199.99', 95, '01/06/2020 às 21:06'),
(5, 'JBL Flip 5', '5.jpg', 3, '699.00', 88, '01/06/2020 às 21:07'),
(6, 'JBL Boombox', '6.jpg', 3, '1804.05', 90, '01/06/2020 às 21:07'),
(8, 'Logitech G203', '8.jpg', 4, '152.90', 89, '01/06/2020 às 21:10'),
(9, 'Dell MS117', '9.jpg', 4, '85.90', 92, '01/06/2020 às 21:11'),
(10, 'Multilaser MO07', '10.jpg', 4, '16.99', 89, '01/06/2020 às 21:12'),
(11, 'Fone de Ouvido JBL', '11.jpg', 2, '129.00', 89, '01/06/2020 às 21:13'),
(12, 'PFO01BT Philco', '12.jpg', 2, '179.99', 97, '01/06/2020 às 21:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cde_produto_tipo`
--

CREATE TABLE `cde_produto_tipo` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cde_produto_tipo`
--

INSERT INTO `cde_produto_tipo` (`id`, `nome`) VALUES
(1, 'Celular'),
(2, 'Fone de Ouvido'),
(3, 'Caixa de Som'),
(4, 'Mouse');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cde_tarefa`
--

CREATE TABLE `cde_tarefa` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `local` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_prazo` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_responsavel_conclusao` int(11) NOT NULL,
  `nome_responsavel_conclusao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_conclusao` datetime NOT NULL,
  `criadoem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cde_tarefa`
--

INSERT INTO `cde_tarefa` (`id`, `nome`, `descricao`, `id_responsavel`, `local`, `data_prazo`, `status`, `id_responsavel_conclusao`, `nome_responsavel_conclusao`, `data_conclusao`, `criadoem`) VALUES
(1, 'Tarefa 1', '', 5, '', '2020-06-10 14:01:00', 'Concluída', 1, 'Davi Sales', '2020-07-01 14:19:46', '08/06/2020 às 14:01'),
(2, 'Tarefa 2', '', 47, '', '2020-06-12 14:01:00', 'Concluída', 47, 'Júlio Guerra', '2020-06-08 14:05:30', '08/06/2020 às 14:01'),
(3, 'Tarefa 3', '', 0, '', '2020-06-26 14:02:00', 'Concluída', 47, 'Júlio Guerra', '2020-06-13 13:12:10', '08/06/2020 às 14:02'),
(4, 'Tarefa 4', '', 47, '', '2020-06-20 14:02:00', 'Concluída', 1, 'Davi Sales', '2020-07-01 14:23:41', '08/06/2020 às 14:02'),
(5, 'Tarefa 5', '', 0, '', '2020-06-26 14:02:00', 'Concluída', 1, '', '2020-06-08 14:05:42', '08/06/2020 às 14:02'),
(6, 'Tarefa 6', '', 0, '', '2020-06-26 14:02:00', 'Pendente', 0, '', '0000-00-00 00:00:00', '08/06/2020 às 14:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cde_usuario`
--

CREATE TABLE `cde_usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nascimento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criadoem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `nome_responsavel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cde_usuario`
--

INSERT INTO `cde_usuario` (`id`, `nome`, `foto`, `email`, `senha`, `tipo`, `endereco`, `telefone`, `cpf`, `nascimento`, `criadoem`, `id_responsavel`, `nome_responsavel`) VALUES
(1, 'Davi Sales', '1.jpeg', 'monteiro_davi@yahoo.com', 'joaneide', 'Administrador Geral', '', '', '', '', '', 1, ''),
(2, 'Carlos Augusto', '2.png', '', '', 'Cliente', 'ssssssssssss', '', '', '', '01/06/2020 às 20:40', 1, ''),
(3, 'Sebastião Ferreira', '3.png', '', '', 'Cliente', '', '', '', '', '01/06/2020 às 20:50', 1, ''),
(5, 'Diego Santos', '5.png', 'dieguinho@gmail.com', '', 'Cliente', 'Nenhum Endereço', '(88) 99754-3521', '738.290.422-31', '2003-02-11', '01/06/2020 às 20:52', 1, ''),
(6, 'Roberto Sales', '6.png', '', '', 'Cliente', '', '', '', '', '01/06/2020 às 20:52', 1, ''),
(8, 'Larissa Siqueira', '8.jpg', '', '', 'Cliente', '', '', '', '', '01/06/2020 às 20:52', 1, ''),
(49, 'awdawdawdaw', '48.png', '', '', 'Cliente', '', '', '', '', '12/06/2020 às 16:18', 1, 'Davi Sales'),
(50, 'redwadadadawd', '50.png', '', '', 'Cliente', '', '', '', '', '12/06/2020 às 20:21', 51, 'Júlio Guerra'),
(51, 'Admin ssss', '51.png', 'adm@gmail.com', 'joaneide', 'Administrador', '', '', '', '', '12/06/2020 às 20:22', 1, 'Júlio Guerra');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cde_venda`
--

CREATE TABLE `cde_venda` (
  `id` int(11) NOT NULL,
  `num_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_produto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qtd_produto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cde_venda`
--

INSERT INTO `cde_venda` (`id`, `num_venda`, `id_produto`, `nome_produto`, `preco_produto`, `qtd_produto`, `id_cliente`) VALUES
(5, 4, 1, 'J7 Prime 16GB', '1919.99', 2, 8),
(6, 5, 6, 'JBL Boombox', '1804.05', 1, 5),
(7, 6, 9, 'Dell MS117', '84.99', 1, 5),
(11, 8, 10, 'Multilaser MO07', '16.99', 1, 8),
(12, 9, 1, 'J7 Prime 16GB', '1919.99', 1, 5),
(14, 11, 11, 'Fone de Ouvido JBL', '129.00', 2, 5),
(15, 12, 6, 'JBL Boombox', '1804.05', 2, 6),
(16, 12, 8, 'Logitech G203', '152.90', 2, 6),
(21, 14, 1, 'J7 Prime 16GB', '1919.99', 1, 3),
(22, 15, 1, 'J7 Prime 16GB', '1919.99', 1, 2),
(23, 16, 1, 'J7 Prime 16GB', '1919.99', 1, 5),
(24, 17, 1, 'J7 Prime 16GB', '1919.99', 1, 8),
(25, 17, 2, 'Galaxy A10s', '941.00', 1, 8),
(26, 18, 4, 'Redmi Note 8', '1199.99', 1, 2),
(27, 18, 5, 'JBL Flip 5', '699.00', 1, 2),
(28, 19, 4, 'Redmi Note 8', '1199.99', 1, 6),
(29, 19, 5, 'JBL Flip 5', '699.00', 1, 6),
(30, 20, 1, 'J7 Prime 16GB', '1919.99', 1, 2),
(31, 21, 6, 'JBL Boombox', '1804.05', 2, 5),
(32, 22, 5, 'JBL Flip 5', '699.00', 1, 2),
(34, 26, 4, 'Redmi Note 8', '1199.99', 1, 3),
(35, 26, 8, 'Logitech G203', '152.90', 1, 3),
(36, 26, 11, 'Fone de Ouvido JBL', '129.00', 1, 3),
(37, 27, 9, 'Dell MS117', '84.90', 2, 3),
(38, 28, 9, 'Dell MS117', '84.90', 1, 2),
(39, 29, 11, 'Fone de Ouvido JBL', '129.00', 2, 6),
(40, 30, 3, 'Motorola E6', '749.99', 1, 8),
(41, 30, 10, 'Multilaser MO07', '16.99', 2, 8),
(42, 31, 3, 'Motorola E6', '749.99', 1, 6),
(43, 31, 10, 'Multilaser MO07', '16.99', 2, 6),
(44, 32, 3, 'Motorola E6', '749.99', 1, 3),
(45, 32, 10, 'Multilaser MO07', '16.99', 2, 3),
(46, 33, 1, 'J7 Prime 16GB', '1919.99', 1, 2),
(47, 34, 3, 'Motorola E6', '749.99', 1, 2),
(48, 35, 8, 'Logitech G203', '152.90', 1, 2),
(49, 36, 3, 'Motorola E6', '749.99', 1, 2),
(50, 37, 5, 'JBL Flip 5', '699.00', 1, 8),
(51, 38, 4, 'Redmi Note 8', '1199.99', 1, 2),
(52, 39, 5, 'JBL Flip 5', '699.00', 1, 2),
(53, 40, 5, 'JBL Flip 5', '699.00', 1, 5),
(54, 41, 10, 'Multilaser MO07', '16.99', 1, 5),
(55, 41, 11, 'Fone de Ouvido JBL', '129.00', 1, 5),
(56, 42, 10, 'Multilaser MO07', '16.99', 1, 8),
(57, 42, 11, 'Fone de Ouvido JBL', '129.00', 1, 8),
(58, 43, 5, 'JBL Flip 5', '699.00', 1, 2),
(59, 44, 8, 'Logitech G203', '152.90', 1, 2),
(60, 44, 9, 'Dell MS117', '85.90', 1, 2),
(61, 45, 8, 'Logitech G203', '152.90', 1, 5),
(62, 45, 9, 'Dell MS117', '85.90', 1, 5),
(63, 46, 12, 'PFO01BT Philco', '179.99', 1, 2),
(64, 47, 12, 'PFO01BT Philco', '179.99', 1, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cde_venda_detalhe`
--

CREATE TABLE `cde_venda_detalhe` (
  `num_venda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nome_cliente` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `criadoem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `nome_responsavel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cde_venda_detalhe`
--

INSERT INTO `cde_venda_detalhe` (`num_venda`, `id_cliente`, `nome_cliente`, `valor`, `criadoem`, `id_responsavel`, `nome_responsavel`) VALUES
(4, 8, 'Larissa Siqueira', '3839.98', 'S:20. 01/03/2020 às 21:30', 0, '0'),
(5, 5, 'Diego Santos', '1804.05', 'S:20. 01/03/2020 às 21:30', 0, '0'),
(6, 5, 'Diego Santos', '84.99', 'S:21. 01/04/2020 às 21:30', 0, '0'),
(8, 8, 'Larissa Siqueira', '16.99', 'S:21. 01/04/2020 às 21:33', 0, '0'),
(9, 5, 'Diego Santos', '1919.99', 'S:21. 01/04/2020 às 21:37', 0, '0'),
(11, 5, 'Diego Santos', '258', 'S:22. 01/05/2020 às 21:40', 0, '0'),
(12, 6, 'Roberto Sales', '3913.9', 'S:22. 01/05/2020 às 21:41', 0, '0'),
(15, 3, 'Sebastião Ferreira', '1919.99', 'S:23. 01/06/2020 às 21:42', 0, '0'),
(16, 5, 'Diego Santos', '1919.99', 'S:23. 01/06/2020 às 21:59', 0, '0'),
(17, 8, 'Larissa Siqueira', '2860.99', 'S:23. 01/06/2020 às 22:00', 0, '0'),
(18, 2, 'Carlos Augusto', '1898.99', 'S:23. 01/06/2020 às 22:02', 0, '0'),
(19, 6, 'Roberto Sales', '1898.99', 'S:23. 01/06/2020 às 22:02', 0, '0'),
(20, 2, 'Carlos Augusto', '1919.99', 'S:23. 01/06/2020 às 22:02', 0, '0'),
(21, 5, 'Diego Santos', '3608.1', 'S:23. 01/06/2020 às 22:40', 0, '0'),
(22, 2, 'Carlos Augusto', '699', 'S:23. 02/06/2020 às 08:52', 0, '0'),
(26, 3, 'Sebastião Ferreira', '1481.89', 'S:23. 03/06/2020 às 09:43', 0, '0'),
(27, 3, 'Sebastião Ferreira', '169.8', 'S:23. 03/06/2020 às 09:45', 0, '0'),
(28, 2, 'Carlos Augusto', '84.9', 'S:23. 03/06/2020 às 09:54', 0, '0'),
(29, 6, 'Roberto Sales', '258', 'S:23. 03/06/2020 às 09:55', 0, '0'),
(30, 8, 'Larissa Siqueira', '783.97', 'S:23. 03/06/2020 às 09:55', 0, '0'),
(31, 6, 'Roberto Sales', '783.97', 'S:23. 03/06/2020 às 09:55', 0, '0'),
(32, 3, 'Sebastião Ferreira', '783.97', 'S:23. 03/06/2020 às 09:55', 0, '0'),
(33, 2, 'Carlos Augusto', '1919.99', 'S:23. 06/06/2020 às 17:46', 0, '0'),
(34, 2, 'Carlos Augusto', '749.99', 'S:23. 07/06/2020 às 13:57', 0, '0'),
(35, 2, 'Carlos Augusto', '152.9', 'S:24. 08/06/2020 às 12:04', 0, '0'),
(36, 2, 'Carlos Augusto', '749.99', 'S:24. 09/06/2020 às 15:32', 0, '0'),
(37, 8, 'Larissa Siqueira', '699', 'S:24. 10/06/2020 às 13:38', 0, '0'),
(38, 2, 'Carlos Augusto', '1199.99', 'S:24. 12/06/2020 às 09:52', 0, '0'),
(39, 2, 'Carlos Augusto', '699', 'S:24. 12/06/2020 às 15:42', 0, '0'),
(40, 5, 'Diego Santos', '699', 'S:24. 12/06/2020 às 16:27', 1, 'Davi Sales'),
(41, 5, 'Diego Santos', '145.99', 'S:24. 12/06/2020 às 16:28', 1, 'Davi Sales'),
(42, 8, 'Larissa Siqueira', '145.99', 'S:24. 12/06/2020 às 16:28', 1, 'Davi Sales'),
(43, 2, 'Carlos Augusto', '699', 'S:24. 12/06/2020 às 16:45', 47, 'Júlio Guerra'),
(44, 2, 'Carlos Augusto', '238.8', 'S:24. 13/06/2020 às 10:25', 47, 'Júlio Guerra'),
(45, 5, 'Diego Santos', '238.8', 'S:24. 13/06/2020 às 10:25', 47, 'Júlio Guerra'),
(46, 2, 'Carlos Augusto', '179.99', 'S:24. 14/06/2020 às 18:16', 51, 'Admin ssss'),
(47, 5, 'Diego Santos', '179.99', 'S:27. 02/07/2020 às 15:08', 1, 'Davi Sales');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cde_produto`
--
ALTER TABLE `cde_produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cde_produto_tipo`
--
ALTER TABLE `cde_produto_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cde_tarefa`
--
ALTER TABLE `cde_tarefa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cde_usuario`
--
ALTER TABLE `cde_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cde_venda`
--
ALTER TABLE `cde_venda`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cde_venda_detalhe`
--
ALTER TABLE `cde_venda_detalhe`
  ADD PRIMARY KEY (`num_venda`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cde_produto`
--
ALTER TABLE `cde_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `cde_produto_tipo`
--
ALTER TABLE `cde_produto_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cde_tarefa`
--
ALTER TABLE `cde_tarefa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `cde_usuario`
--
ALTER TABLE `cde_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `cde_venda`
--
ALTER TABLE `cde_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de tabela `cde_venda_detalhe`
--
ALTER TABLE `cde_venda_detalhe`
  MODIFY `num_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
