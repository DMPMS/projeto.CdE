-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Mar-2022 às 22:34
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cde4`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_atualizacoes`
--

CREATE TABLE `usuarios_atualizacoes` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idResponsavel` int(11) NOT NULL,
  `idsQueVizualizaram` text NOT NULL,
  `dataDeCadastro` datetime NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios_atualizacoes`
--

INSERT INTO `usuarios_atualizacoes` (`id`, `tipo`, `idUsuario`, `idResponsavel`, `idsQueVizualizaram`, `dataDeCadastro`, `ativo`) VALUES
(1, 'Excluir Cliente', 3, 1, '.1.', '2022-03-11 18:23:59', 0),
(2, 'Excluir Cliente', 3, 1, '.1.', '2022-03-11 18:32:14', 0),
(3, 'Excluir Administrador', 5, 1, '.1.', '2022-03-11 18:33:05', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_usuarios`
--

CREATE TABLE `usuarios_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `contato` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `idResponsavel` int(11) NOT NULL,
  `dataDeCadastro` datetime NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios_usuarios`
--

INSERT INTO `usuarios_usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `contato`, `cpf`, `endereco`, `idResponsavel`, `dataDeCadastro`, `ativo`) VALUES
(1, 'Admin geral', 'admin@gmail.com', 'admin', 'Administrador Geral', '', '', '', 0, '2022-03-04 00:00:00', 0),
(2, 'Maria Isadora', 'mariaisadora@gmail.com', '', 'Cliente', '(88) 98347-4912', '849.322.394-92', '', 1, '2022-03-11 14:21:50', 0),
(3, 'Igor Carius', '', '', 'Cliente', '(88) 92042-2192', '392.120.302-90', '', 1, '2022-03-11 14:28:50', 0),
(4, 'Juliana Senna', 'juliana@gmail.com', '', 'Cliente', '', '665.456.765-43', 'Rua Pedro Vasques, Bairro Alto, 123', 1, '2022-03-11 14:45:35', 0),
(5, 'Deyverson', 'deyverson@gmail.com', 'deyverson', 'Administrador', '', '', '', 1, '2022-03-11 16:11:06', 0),
(6, 'Raphael Veiga', 'raphael@gmail.com', 'raphael', 'Administrador', '(88) 97371-7217', '434.432.345-21', '', 1, '2022-03-11 16:51:53', 0),
(7, 'Weverton', 'weverton@gmail.com', 'weverton', 'Administrador', '', '', '', 1, '2022-03-11 17:45:43', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuarios_atualizacoes`
--
ALTER TABLE `usuarios_atualizacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios_usuarios`
--
ALTER TABLE `usuarios_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios_atualizacoes`
--
ALTER TABLE `usuarios_atualizacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios_usuarios`
--
ALTER TABLE `usuarios_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
