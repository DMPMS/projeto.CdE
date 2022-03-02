-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Out-2021 às 20:51
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cde3`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atualizacao_atualizacoes`
--

CREATE TABLE `atualizacao_atualizacoes` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `acao` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `unidades_antigo` int(11) NOT NULL,
  `unidades_novo` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `total_venda` double NOT NULL,
  `id_tarefa` int(11) NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `ids_vizualizados` varchar(255) NOT NULL,
  `criadoem` datetime NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `atualizacao_atualizacoes`
--

INSERT INTO `atualizacao_atualizacoes` (`id`, `tipo`, `acao`, `id_usuario`, `id_produto`, `unidades_antigo`, `unidades_novo`, `id_tipo`, `id_venda`, `total_venda`, `id_tarefa`, `id_responsavel`, `ids_vizualizados`, `criadoem`, `ativo`) VALUES
(1, 'Usuário', 'Cadastrar-Administrador', 2, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-06-27 23:44:30', 0),
(2, 'Usuário', 'Cadastrar-Administrador', 3, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-06-27 23:47:37', 0),
(3, 'Usuário', 'Cadastrar-Cliente', 4, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-06-27 23:50:54', 0),
(4, 'Usuário', 'Cadastrar-Cliente', 5, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-06-27 23:51:45', 0),
(5, 'Usuário', 'Cadastrar-Cliente', 6, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-06-27 23:53:31', 0),
(6, 'Usuário', 'Cadastrar-Cliente', 7, 0, 0, 0, 0, 0, 0, 0, 2, '.2..1..14.', '2021-06-27 23:54:53', 0),
(7, 'Usuário', 'Cadastrar-Cliente', 8, 0, 0, 0, 0, 0, 0, 0, 2, '.2..1..14.', '2021-06-27 23:55:20', 0),
(8, 'Usuário', 'Cadastrar-Cliente', 9, 0, 0, 0, 0, 0, 0, 0, 2, '.2..1..14.', '2021-06-27 23:56:08', 0),
(9, 'Usuário', 'Cadastrar-Cliente', 10, 0, 0, 0, 0, 0, 0, 0, 2, '.2..1..14.', '2021-06-27 23:56:42', 0),
(10, 'Usuário', 'Editar-Cliente', 4, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-06-27 23:57:53', 0),
(11, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 1, 0, 0, 0, 1, '.1..2.', '2021-06-27 23:59:02', 0),
(12, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 2, 0, 0, 0, 1, '.1..2.', '2021-06-27 23:59:14', 0),
(13, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 3, 0, 0, 0, 1, '.1..2.', '2021-06-27 23:59:26', 0),
(14, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 4, 0, 0, 0, 1, '.1..2.', '2021-06-27 23:59:35', 0),
(15, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 5, 0, 0, 0, 1, '.1..2.', '2021-06-27 23:59:50', 0),
(16, 'Produto', 'Editar-Tipo', 0, 0, 0, 0, 2, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:00:07', 0),
(17, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 6, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:00:32', 0),
(18, 'Produto', 'Excluir-Tipo', 0, 0, 0, 0, 5, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:00:43', 0),
(19, 'Produto', 'Cadastrar-Produto', 0, 1, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:02:18', 0),
(20, 'Produto', 'Editar-Produto', 0, 1, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:02:47', 0),
(21, 'Produto', 'Editar-Produto', 0, 1, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:04:44', 0),
(22, 'Produto', 'Cadastrar-Produto', 0, 2, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:06:55', 0),
(23, 'Produto', 'Cadastrar-Produto', 0, 3, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:09:10', 0),
(24, 'Produto', 'Cadastrar-Produto', 0, 4, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:10:37', 0),
(25, 'Produto', 'Cadastrar-Produto', 0, 5, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:12:20', 0),
(26, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 7, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:12:33', 0),
(27, 'Produto', 'Excluir-Tipo', 0, 0, 0, 0, 7, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:12:39', 0),
(28, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 8, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:12:49', 0),
(29, 'Produto', 'Editar-Produto', 0, 5, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 00:14:12', 0),
(30, 'Produto', 'Editar-Produto-Estoque', 0, 4, 4, 10, 0, 0, 0, 0, 2, '.2..1.', '2021-06-28 00:15:30', 0),
(31, 'Produto', 'Editar-Produto', 0, 4, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 14:37:41', 0),
(32, 'Produto', 'Cadastrar-Produto', 0, 6, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 14:43:12', 0),
(33, 'Produto', 'Editar-Produto', 0, 6, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-06-28 14:43:51', 0),
(34, 'Produto', 'Editar-Tipo', 0, 0, 0, 0, 2, 0, 0, 0, 1, '.1..2.', '2021-06-29 22:28:15', 0),
(35, 'Usuário', 'Cadastrar-Cliente', 11, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-07-04 13:55:14', 0),
(36, 'Usuário', 'Excluir-Cliente', 11, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-07-04 13:55:52', 0),
(37, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 9, 0, 0, 0, 1, '.1..2.', '2021-07-04 13:58:17', 0),
(38, 'Produto', 'Editar-Tipo', 0, 0, 0, 0, 9, 0, 0, 0, 1, '.1..2.', '2021-07-04 14:05:54', 0),
(39, 'Produto', 'Excluir-Tipo', 0, 0, 0, 0, 9, 0, 0, 0, 1, '.1..2.', '2021-07-04 14:07:55', 0),
(40, 'Produto', 'Editar-Produto-Estoque', 0, 5, 6, 7, 0, 0, 0, 0, 2, '.2..1.', '2021-07-04 14:10:44', 0),
(41, 'Produto', 'Editar-Produto-Estoque', 0, 5, 7, 3, 0, 0, 0, 0, 2, '.2..1.', '2021-07-04 14:11:06', 0),
(42, 'Produto', 'Editar-Produto', 0, 5, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-07-04 14:16:42', 0),
(43, 'Produto', 'Editar-Produto', 0, 5, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-07-04 14:16:54', 0),
(44, 'Produto', 'Cadastrar-Produto', 0, 7, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-07-04 14:33:57', 0),
(45, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 10, 0, 0, 0, 1, '.1..2.', '2021-07-04 14:34:10', 0),
(46, 'Produto', 'Editar-Produto', 0, 7, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-07-04 14:34:26', 0),
(47, 'Produto', 'Editar-Produto', 0, 5, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-07-04 15:12:45', 0),
(48, 'Produto', 'Editar-Produto', 0, 7, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-07-04 15:21:07', 0),
(49, 'Usuário', 'Cadastrar-Cliente', 12, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-09-05 10:00:33', 0),
(50, 'Produto', 'Cadastrar-Produto', 0, 8, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-09-05 10:01:48', 0),
(51, 'Usuário', 'Editar-Cliente', 10, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-09-13 20:44:57', 0),
(52, 'Produto', 'Editar-Produto', 0, 8, 0, 0, 0, 0, 0, 0, 1, '.1..2.', '2021-09-13 20:46:16', 0),
(53, 'Produto', 'Editar-Produto-Estoque', 0, 8, 4, 3, 0, 0, 0, 0, 2, '.2..1.', '2021-09-13 20:47:19', 0),
(54, 'Usuário', 'Cadastrar-Cliente', 13, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-09-13 20:50:52', 0),
(55, 'Usuário', 'Editar-Cliente', 13, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-09-13 20:51:50', 0),
(56, 'Usuário', 'Editar-Cliente', 13, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-09-13 20:52:09', 0),
(57, 'Usuário', 'Cadastrar-Administrador', 14, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-09-13 20:57:14', 0),
(58, 'Usuário', 'Editar-Cliente', 8, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-09-13 20:59:15', 0),
(59, 'Produto', 'Editar-Produto', 0, 7, 0, 0, 0, 0, 0, 0, 1, '.1.', '2021-09-13 21:18:45', 0),
(60, 'Produto', 'Editar-Produto', 0, 7, 0, 0, 0, 0, 0, 0, 1, '.1.', '2021-09-13 21:18:51', 0),
(61, 'Usuário', 'Excluir-Cliente', 8, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-09-14 13:39:28', 0),
(62, 'Usuário', 'Cadastrar-Administrador', 15, 0, 0, 0, 0, 0, 0, 0, 1, '.1..2..14.', '2021-09-14 13:40:07', 0),
(63, 'Usuário', 'Cadastrar-Cliente', 16, 0, 0, 0, 0, 0, 0, 0, 15, '.15..1..2..14.', '2021-09-14 13:43:23', 0),
(64, 'Produto', 'Editar-Produto', 0, 8, 0, 0, 0, 0, 0, 0, 1, '.1.', '2021-09-14 14:39:17', 0),
(65, 'Produto', 'Editar-Produto', 0, 8, 0, 0, 0, 0, 0, 0, 1, '.1.', '2021-09-14 14:39:39', 0),
(66, 'Produto', 'Editar-Produto', 0, 8, 0, 0, 0, 0, 0, 0, 1, '.1.', '2021-09-14 17:00:54', 0),
(67, 'Produto', 'Cadastrar-Tipo', 0, 0, 0, 0, 11, 0, 0, 0, 1, '.1.', '2021-09-21 14:08:56', 0),
(68, 'Produto', 'Editar-Produto', 0, 7, 0, 0, 0, 0, 0, 0, 1, '.1.', '2021-09-21 15:56:18', 0),
(69, 'Produto', 'Editar-Produto', 0, 1, 0, 0, 0, 0, 0, 0, 1, '.1.', '2021-09-21 15:56:30', 0),
(70, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 3, 5, 3, 0, 0, 0, 0, 1, '.1.', '2021-10-23 15:16:54', 0),
(71, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 5, 5, 2, 0, 0, 0, 0, 1, '.1.', '2021-10-23 15:16:54', 0),
(72, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 6, 5, 4, 0, 0, 0, 0, 1, '.1.', '2021-10-23 15:16:54', 0),
(73, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 8, 3, 1, 0, 0, 0, 0, 1, '.1.', '2021-10-23 15:16:54', 0),
(74, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 22, 182, 0, 1, '.1.', '2021-10-23 15:43:53', 0),
(75, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 2, 50, 49, 0, 0, 0, 0, 1, '.1.', '2021-10-23 16:11:24', 0),
(76, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 23, 282, 0, 1, '.1.', '2021-10-23 16:11:24', 0),
(77, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 2, 49, 48, 0, 0, 0, 0, 1, '.1.', '2021-10-23 16:11:52', 0),
(78, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 24, 141, 0, 1, '.1.', '2021-10-23 16:11:52', 0),
(79, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 2, 48, 47, 0, 0, 0, 0, 1, '.1.', '2021-10-23 16:12:21', 0),
(80, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 25, 240, 0, 1, '.1.', '2021-10-23 16:12:21', 0),
(81, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 2, 47, 46, 0, 0, 0, 0, 1, '.1.', '2021-10-23 16:13:32', 0),
(82, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 26, 282, 0, 1, '.1.', '2021-10-23 16:13:32', 0),
(83, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 1, 546, 0, 1, '.1.', '2021-10-23 23:54:41', 0),
(84, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 2, 46, 42, 0, 0, 0, 0, 1, '.1.', '2021-10-24 00:00:26', 0),
(85, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 5, 2, 1, 0, 0, 0, 0, 1, '.1.', '2021-10-24 00:00:26', 0),
(86, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 2, 6483.8, 0, 1, '.1.', '2021-10-24 00:00:26', 0),
(87, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 3, 4000, 0, 1, '.1.', '2021-10-24 00:01:02', 0),
(88, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 4, 300, 0, 1, '.1.', '2021-10-24 00:01:29', 0),
(89, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 5, 10164, 0, 1, '.1.', '2021-10-24 00:09:59', 0),
(90, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 2, 41, 38, 0, 0, 0, 0, 1, '.1.', '2021-10-24 00:11:52', 0),
(91, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 4, 9, 8, 0, 0, 0, 0, 1, '.1.', '2021-10-24 00:11:52', 0),
(92, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 6, 928, 0, 1, '.1.', '2021-10-24 00:11:52', 0),
(93, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 7, 846, 0, 1, '.1.', '2021-10-24 00:14:11', 0),
(94, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 2, 38, 35, 0, 0, 0, 0, 1, '.1.', '2021-10-24 00:14:46', 0),
(95, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 8, 846, 0, 1, '.1.', '2021-10-24 00:14:46', 0),
(96, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 2, 35, 34, 0, 0, 0, 0, 1, '.1.', '2021-10-24 00:15:18', 0),
(97, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 9, 282, 0, 1, '.1.', '2021-10-24 00:15:18', 0),
(98, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 10, 282, 0, 1, '.1.', '2021-10-24 00:16:57', 0),
(99, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 11, 82, 0, 1, '.1.', '2021-10-24 00:17:28', 0),
(100, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 12, 82, 0, 1, '.1.', '2021-10-24 00:17:53', 0),
(101, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 13, 82, 0, 1, '.1.', '2021-10-24 00:18:43', 0),
(102, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 4, 6, 5, 0, 0, 0, 0, 1, '.1.', '2021-10-24 00:19:12', 0),
(103, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 14, 82, 0, 1, '.1.', '2021-10-24 00:19:12', 0),
(104, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 4, 5, 4, 0, 0, 0, 0, 1, '.1.', '2021-10-24 00:19:50', 0),
(105, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 15, 82, 0, 1, '.1.', '2021-10-24 00:19:50', 0),
(106, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 16, 82, 0, 1, '.1.', '2021-10-24 18:52:17', 0),
(107, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 4, 3, 2, 0, 0, 0, 0, 1, '.1.', '2021-10-24 18:52:26', 0),
(108, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 17, 82, 0, 1, '.1.', '2021-10-24 18:52:26', 0),
(109, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 2, 33, 32, 0, 0, 0, 0, 1, '.1.', '2021-10-24 20:23:18', 0),
(110, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 4, 2, 1, 0, 0, 0, 0, 1, '.1.', '2021-10-24 20:23:18', 0),
(111, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 6, 3, 2, 0, 0, 0, 0, 1, '.1.', '2021-10-24 20:23:18', 0),
(112, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 18, 4564, 0, 1, '.1.', '2021-10-24 20:23:18', 0),
(113, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 19, 731, 0, 1, '.1.', '2021-10-24 20:25:56', 0),
(114, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 3, 2, 1, 0, 0, 0, 0, 1, '.1.', '2021-10-24 22:29:54', 0),
(115, 'Produto', 'Editar-Produto-Estoque-PósVenda', 0, 4, 1, 0, 0, 0, 0, 0, 1, '.1.', '2021-10-24 22:29:54', 0),
(116, 'Venda', 'Cadastrar-Venda', 0, 0, 0, 0, 0, 20, 162, 0, 1, '.1.', '2021-10-24 22:29:54', 0),
(117, 'Venda', 'Cancelar-Venda', 0, 0, 0, 0, 0, 15, 0, 0, 1, '.1.', '2021-10-24 22:46:33', 0),
(118, 'Venda', 'Cancelar-Venda', 0, 0, 0, 0, 0, 17, 0, 0, 1, '.1.', '2021-10-24 22:51:11', 0),
(119, 'Venda', 'Cancelar-Venda', 0, 0, 0, 0, 0, 10, 0, 0, 1, '.1.', '2021-10-24 22:51:32', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_produtos`
--

CREATE TABLE `produto_produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `id_tipo` varchar(255) NOT NULL,
  `preco` double NOT NULL,
  `unidades` int(11) NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `criadoem` datetime NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto_produtos`
--

INSERT INTO `produto_produtos` (`id`, `nome`, `foto`, `codigo`, `id_tipo`, `preco`, `unidades`, `id_responsavel`, `criadoem`, `ativo`) VALUES
(1, 'XIAOMI REDMI 9T 128GB 6,53', '1.png', '8B2NG84N28DN2', '(1)', 1269.99, 0, 1, '2021-06-28 00:02:17', 0),
(2, 'Xiaomi Redmi AirDots 3', '2.png', 'S29DM38FN2N5BJ2J', '(2)', 282, 32, 1, '2021-06-28 00:06:55', 0),
(3, 'Hunterspider v3', '3.png', 'KJ2J4N2N34N2D', '(2)', 100, 1, 1, '2021-06-28 00:09:10', 0),
(4, 'Power Bank - Backers', '4.png', '3KJ2HN4J5J2', '(4)', 82, 0, 1, '2021-06-28 00:10:37', 0),
(5, 'Helios 300 i7-9th, 1660ti, 16GB', '5.png', 'K2342B342BV3', '(3)(8)', 6500, 0, 1, '2021-06-28 00:12:19', 0),
(6, 'Nitro 5 i5-9th 1650, 128GB, 1TB, 8GB ', '6.png', 'JVKDO34857UHT', '(8)', 4200, 2, 1, '2021-06-28 14:43:12', 0),
(7, 'AOC Roku TV Smart TV LED 43” Full HD', '7.png', 'NSJ3HTN', '(10)', 1899.99, 0, 1, '2021-07-04 14:33:57', 0),
(8, 'Acer Nitro 5', '8.png', '489023984', '(8)', 5002, 1, 1, '2021-09-05 10:01:48', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_tipos`
--

CREATE TABLE `produto_tipos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `criadoem` datetime NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produto_tipos`
--

INSERT INTO `produto_tipos` (`id`, `nome`, `id_responsavel`, `criadoem`, `ativo`) VALUES
(1, 'Celular', 1, '2021-06-27 23:59:02', 0),
(2, 'Fones de Ouvidos', 1, '2021-06-27 23:59:13', 0),
(3, 'Eletrônicos', 1, '2021-06-27 23:59:25', 0),
(4, 'Power Bank', 1, '2021-06-27 23:59:35', 0),
(5, 'Capa de Celular', 1, '2021-06-27 23:59:49', 1),
(6, 'Acessórios', 1, '2021-06-28 00:00:31', 0),
(7, 'Fones de Ouvido', 1, '2021-06-28 00:12:33', 1),
(8, 'Notebook', 1, '2021-06-28 00:12:48', 0),
(9, 'Roupas', 1, '2021-07-04 13:58:16', 1),
(10, 'Televisão', 1, '2021-07-04 14:34:10', 0),
(11, 'Cosméticos', 1, '2021-09-21 14:08:56', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_usuarios`
--

CREATE TABLE `usuario_usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `endereco` text NOT NULL,
  `celular` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `criadoem` datetime NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario_usuarios`
--

INSERT INTO `usuario_usuarios` (`id`, `nome`, `foto`, `email`, `senha`, `tipo`, `endereco`, `celular`, `cpf`, `id_responsavel`, `criadoem`, `ativo`) VALUES
(1, 'Davi Monteiro', '1.jpg', 'admin@gmail.com', 'admin', 'Administrador Geral', '', '', '', 0, '2021-06-28 04:41:31', 0),
(2, 'Rony Rústico', '2.png', 'rony@gmail.com', 'rony', 'Administrador', '', '(88) 99629-3479', '748.938.409-28', 1, '2021-06-27 23:44:29', 0),
(3, 'Arthuria Pendragon', '3.png', 'saber@gmail.com', 'saber', 'Administrador', '', '(88) 99612-9812', '928.340.929-01', 1, '2021-06-27 23:47:37', 0),
(4, 'Amauri Souza', '4.png', 'amauri@gmail.com', '', 'Cliente', 'Rua Vasconcellos, 932, Aldeota', '(74) 87283-9464', '893.874.892-89', 1, '2021-06-27 23:50:52', 0),
(5, 'Lucas Evangelista', '5.png', 'lucas@gmail.com', '', 'Cliente', 'Avenida Santiago Santos, 2932, Fortaleza', '(88) 99238-9283', '239.209.301-90', 1, '2021-06-27 23:51:45', 0),
(6, 'Igor Benevenuto', '6.png', 'igor@gmail.com', '', 'Cliente', 'Rua Escarlate Watson, 09, Remanso', '(88) 20398-9029', '675.843.728-39', 1, '2021-06-27 23:53:31', 0),
(7, 'Michelle Sanchez', '7.png', '', '', 'Cliente', 'Rua Lindon Russ, 72, Parque Antártica', '(78) 39823-9819', '', 2, '2021-06-27 23:54:52', 0),
(8, 'Lucas Lucco', '8.png', '', '', 'Cliente', '', '(88) 99829-8329', '239.230.230-49', 2, '2021-06-27 23:55:18', 1),
(9, 'Steve Jobs', '9.png', 'steve@gmail.com', '', 'Cliente', 'Alameda Santos, 212, Cidade Nova', '(78) 98273-8982', '', 2, '2021-06-27 23:56:07', 0),
(10, 'Ellen Santos', '10.png', 'ellen@gmail.com', '', 'Cliente', '', '', '232.348.765-45', 2, '2021-06-27 23:56:41', 0),
(11, 'Faris Lopes', '11.png', 'faris@gmail.com', '', 'Cliente', 'Sem endereço', '(98) 34903-2332', '834.756.574-32', 1, '2021-07-04 13:55:13', 1),
(12, 'Thug faast', '12.png', '', '', 'Cliente', 'Campinas', '(88) 97349-2334', '', 1, '2021-09-05 10:00:33', 0),
(13, 'Ricardo Bueno', '13.png', 'ricardo@gmail.com', '', 'Cliente', '', '(88) 99853-2312', '234.433.434-34', 1, '2021-09-13 20:50:52', 0),
(14, 'Erika Bernardo', '14.png', 'erika@gmail.com', 'erika', 'Administrador', '', '', '345.678.987-65', 1, '2021-09-13 20:57:14', 0),
(15, 'Jean Gray', '15.png', 'Jean@gmail.com', 'jean', 'Administrador', '', '', '', 1, '2021-09-14 13:40:07', 0),
(16, 'Marcinha Santos', '16.png', 'marcinha@gmail.com', '', 'Cliente', '', '', '', 15, '2021-09-14 13:43:23', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda_produtos`
--

CREATE TABLE `venda_produtos` (
  `id` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `preco` double NOT NULL,
  `qtd` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `criadoem` datetime NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `venda_produtos`
--

INSERT INTO `venda_produtos` (`id`, `id_venda`, `id_produto`, `preco`, `qtd`, `id_cliente`, `id_responsavel`, `criadoem`, `ativo`) VALUES
(1, 1, 2, 282, 1, 13, 1, '2021-10-23 23:54:41', 0),
(2, 1, 3, 100, 1, 13, 1, '2021-10-23 23:54:41', 0),
(3, 1, 4, 82, 2, 13, 1, '2021-10-23 23:54:41', 0),
(4, 2, 2, 282, 4, 13, 1, '2021-10-24 00:00:26', 0),
(5, 2, 5, 6500, 1, 13, 1, '2021-10-24 00:00:26', 0),
(6, 3, 6, 4200, 1, 13, 1, '2021-10-24 00:01:02', 0),
(7, 4, 3, 100, 3, 13, 1, '2021-10-24 00:01:29', 0),
(8, 5, 2, 282, 1, 13, 1, '2021-10-24 00:09:59', 0),
(9, 5, 3, 100, 1, 13, 1, '2021-10-24 00:09:59', 0),
(10, 5, 4, 82, 1, 13, 1, '2021-10-24 00:09:59', 0),
(11, 5, 5, 6500, 1, 13, 1, '2021-10-24 00:09:59', 0),
(12, 5, 6, 4200, 1, 13, 1, '2021-10-24 00:09:59', 0),
(13, 6, 2, 282, 3, 13, 1, '2021-10-24 00:11:52', 0),
(14, 6, 4, 82, 1, 13, 1, '2021-10-24 00:11:52', 0),
(15, 7, 2, 282, 3, 13, 1, '2021-10-24 00:14:11', 0),
(16, 8, 2, 282, 3, 13, 1, '2021-10-24 00:14:46', 0),
(17, 9, 2, 282, 1, 13, 1, '2021-10-24 00:15:18', 0),
(18, 10, 2, 282, 1, 13, 1, '2021-10-24 00:16:57', 0),
(19, 11, 4, 82, 1, 13, 1, '2021-10-24 00:17:28', 0),
(20, 12, 4, 82, 1, 13, 1, '2021-10-24 00:17:53', 0),
(21, 13, 4, 82, 1, 13, 1, '2021-10-24 00:18:43', 0),
(22, 14, 4, 82, 1, 13, 1, '2021-10-24 00:19:12', 0),
(23, 15, 4, 82, 1, 13, 1, '2021-10-24 00:19:50', 0),
(24, 16, 4, 82, 1, 13, 1, '2021-10-24 18:52:17', 0),
(25, 17, 4, 82, 1, 13, 1, '2021-10-24 18:52:26', 0),
(26, 18, 2, 282, 1, 16, 1, '2021-10-24 20:23:18', 0),
(27, 18, 4, 82, 1, 16, 1, '2021-10-24 20:23:18', 0),
(28, 18, 6, 4200, 1, 16, 1, '2021-10-24 20:23:18', 0),
(29, 19, 2, 282, 2, 5, 1, '2021-10-24 20:25:56', 0),
(30, 19, 3, 100, 1, 5, 1, '2021-10-24 20:25:56', 0),
(31, 19, 4, 82, 1, 5, 1, '2021-10-24 20:25:56', 0),
(32, 20, 3, 100, 1, 6, 1, '2021-10-24 22:29:54', 0),
(33, 20, 4, 82, 1, 6, 1, '2021-10-24 22:29:54', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda_vendas`
--

CREATE TABLE `venda_vendas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_responsavel` int(11) NOT NULL,
  `tipo_desconto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desconto` double NOT NULL,
  `subtrair_estoque` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atualizacoes_produtos` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_responsavel_cancelamento` int(11) NOT NULL,
  `data_cancelamento` datetime NOT NULL,
  `criadoem` datetime NOT NULL,
  `ativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `venda_vendas`
--

INSERT INTO `venda_vendas` (`id`, `id_cliente`, `id_responsavel`, `tipo_desconto`, `desconto`, `subtrair_estoque`, `atualizacoes_produtos`, `id_responsavel_cancelamento`, `data_cancelamento`, `criadoem`, `ativo`) VALUES
(1, 13, 1, 'SemDesconto', 0, 'Não', '', 0, '0000-00-00 00:00:00', '2021-10-23 23:54:41', 0),
(2, 13, 1, 'EmPorcentagem', 15, 'Sim', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:00:26', 0),
(3, 13, 1, 'EmReais', 200, 'Não', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:01:02', 0),
(4, 13, 1, 'SemDesconto', 0, 'Não', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:01:29', 0),
(5, 13, 1, 'EmReais', 1000, 'Sim', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:09:59', 0),
(6, 13, 1, 'SemDesconto', 0, 'Sim', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:11:52', 0),
(7, 13, 1, 'SemDesconto', 0, 'Não', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:14:11', 0),
(8, 13, 1, 'SemDesconto', 0, 'Sim', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:14:46', 0),
(9, 13, 1, 'SemDesconto', 0, 'Sim', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:15:18', 0),
(10, 13, 1, 'SemDesconto', 0, 'Sim', '', 1, '2021-10-24 22:51:32', '2021-10-24 00:16:57', 1),
(11, 13, 1, 'SemDesconto', 0, 'Sim', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:17:28', 0),
(12, 13, 1, 'SemDesconto', 0, 'Não', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:17:53', 0),
(13, 13, 1, 'SemDesconto', 0, 'Sim', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:18:43', 0),
(14, 13, 1, 'SemDesconto', 0, 'Sim', '', 0, '0000-00-00 00:00:00', '2021-10-24 00:19:12', 0),
(15, 13, 1, 'SemDesconto', 0, 'Sim', '', 1, '2021-10-24 22:46:33', '2021-10-24 00:19:50', 1),
(16, 13, 1, 'SemDesconto', 0, 'Sim', 'Não', 0, '0000-00-00 00:00:00', '2021-10-24 18:52:17', 0),
(17, 13, 1, 'SemDesconto', 0, 'Sim', 'Sim', 1, '2021-10-24 22:51:11', '2021-10-24 18:52:26', 1),
(18, 16, 1, 'SemDesconto', 0, 'Sim', 'Sim', 0, '0000-00-00 00:00:00', '2021-10-24 20:23:18', 0),
(19, 5, 1, 'EmReais', 15, 'Não', 'Sim', 0, '0000-00-00 00:00:00', '2021-10-24 20:25:56', 0),
(20, 6, 1, 'EmReais', 20, 'Sim', 'Sim', 0, '0000-00-00 00:00:00', '2021-10-24 22:29:54', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atualizacao_atualizacoes`
--
ALTER TABLE `atualizacao_atualizacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto_produtos`
--
ALTER TABLE `produto_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto_tipos`
--
ALTER TABLE `produto_tipos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario_usuarios`
--
ALTER TABLE `usuario_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `venda_produtos`
--
ALTER TABLE `venda_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `venda_vendas`
--
ALTER TABLE `venda_vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atualizacao_atualizacoes`
--
ALTER TABLE `atualizacao_atualizacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de tabela `produto_produtos`
--
ALTER TABLE `produto_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `produto_tipos`
--
ALTER TABLE `produto_tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuario_usuarios`
--
ALTER TABLE `usuario_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `venda_produtos`
--
ALTER TABLE `venda_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `venda_vendas`
--
ALTER TABLE `venda_vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
