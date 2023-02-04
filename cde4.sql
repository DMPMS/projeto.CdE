-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Fev-2023 às 17:54
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

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
-- Estrutura stand-in para vista `cadastros_de_usuarios_ultimos_meses`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `cadastros_de_usuarios_ultimos_meses` (
`mesAtualCliente` bigint(21)
,`mesAtualAdministrador` bigint(21)
,`mesAtual` varchar(7)
,`umMesAtrasCliente` bigint(21)
,`umMesAtrasAdministrador` bigint(21)
,`umMesAtras` varchar(7)
,`doisMesesAtrasCliente` bigint(21)
,`doisMesesAtrasAdministrador` bigint(21)
,`doisMesesAtras` varchar(7)
,`tresMesesAtrasCliente` bigint(21)
,`tresMesesAtrasAdministrador` bigint(21)
,`tresMesesAtras` varchar(7)
,`quatroMesesAtrasCliente` bigint(21)
,`quatroMesesAtrasAdministrador` bigint(21)
,`quatroMesesAtras` varchar(7)
,`cincoMesesAtrasCliente` bigint(21)
,`cincoMesesAtrasAdministrador` bigint(21)
,`cincoMesesAtras` varchar(7)
,`seisMesesAtrasCliente` bigint(21)
,`seisMesesAtrasAdministrador` bigint(21)
,`seisMesesAtras` varchar(7)
,`seteMesesAtrasCliente` bigint(21)
,`seteMesesAtrasAdministrador` bigint(21)
,`seteMesesAtras` varchar(7)
,`oitoMesesAtrasCliente` bigint(21)
,`oitoMesesAtrasAdministrador` bigint(21)
,`oitoMesesAtras` varchar(7)
,`noveMesesAtrasCliente` bigint(21)
,`noveMesesAtrasAdministrador` bigint(21)
,`noveMesesAtras` varchar(7)
,`dezMesesAtrasCliente` bigint(21)
,`dezMesesAtrasAdministrador` bigint(21)
,`dezMesesAtras` varchar(7)
,`onzeMesesAtrasCliente` bigint(21)
,`onzeMesesAtrasAdministrador` bigint(21)
,`onzeMesesAtras` varchar(7)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `ultimosmeses`
--

CREATE TABLE `ultimosmeses` (
  `idMes` int(11) NOT NULL,
  `mes` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ultimosmeses`
--

INSERT INTO `ultimosmeses` (`idMes`, `mes`) VALUES
(1, '2023-02-01'),
(2, '2023-01-01'),
(3, '2022-12-01'),
(4, '2022-11-01'),
(5, '2022-10-01'),
(6, '2022-09-01'),
(7, '2022-08-01'),
(8, '2022-07-01'),
(9, '2022-06-01'),
(10, '2022-05-01'),
(11, '2022-04-01'),
(12, '2022-03-01');

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
(3, 'Excluir Administrador', 5, 1, '.1.', '2022-03-11 18:33:05', 0),
(4, 'Novo Usuario', 8, 1, '.1.', '2023-02-03 16:19:48', 0),
(5, 'Novo Usuario', 9, 1, '.1.', '2023-02-03 16:20:37', 0),
(6, 'Novo Usuario', 10, 1, '.1.', '2023-02-03 16:20:47', 0),
(7, 'Novo Usuario', 11, 1, '.1.', '2023-02-03 16:20:55', 0),
(8, 'Novo Usuario', 12, 1, '.1.', '2023-02-03 16:21:04', 0),
(9, 'Novo Usuario', 13, 1, '.1.', '2023-02-03 16:21:10', 0),
(10, 'Novo Usuario', 14, 1, '.1.', '2023-02-03 16:21:16', 0),
(11, 'Novo Usuario', 15, 1, '.1.', '2023-02-03 16:21:22', 0),
(12, 'Novo Usuario', 16, 1, '.1.', '2023-02-03 16:21:31', 0),
(13, 'Novo Usuario', 17, 1, '.1.', '2023-02-03 16:21:43', 0),
(14, 'Novo Usuario', 18, 1, '.1.', '2023-02-03 16:21:50', 0),
(15, 'Novo Usuario', 19, 1, '.1.', '2023-02-03 16:21:58', 0),
(16, 'Novo Usuario', 20, 1, '.1.', '2023-02-04 13:37:20', 0);

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
(1, 'Admin geral', 'admin@gmail.com', 'admin', 'Administrador Geral', '', '', '', 0, '2022-02-04 00:00:00', 0),
(2, 'Maria Isadora', 'mariaisadora@gmail.com', '', 'Cliente', '(88) 98347-4912', '849.322.394-92', '', 1, '2022-02-11 14:21:50', 0),
(3, 'Igor Carius', '', '', 'Cliente', '(88) 92042-2192', '392.120.302-90', '', 1, '2022-03-11 14:28:50', 0),
(4, 'Juliana Senna', 'juliana@gmail.com', '', 'Cliente', '', '665.456.765-43', 'Rua Pedro Vasques, Bairro Alto, 123', 1, '2022-03-11 14:45:35', 0),
(5, 'Deyverson', 'deyverson@gmail.com', 'deyverson', 'Administrador', '', '', '', 1, '2022-03-11 16:11:06', 0),
(6, 'Raphael Veiga', 'raphael@gmail.com', 'raphael', 'Administrador', '(88) 97371-7217', '434.432.345-21', '', 1, '2022-03-11 16:51:53', 0),
(7, 'Weverton', 'weverton@gmail.com', 'weverton', 'Administrador', '', '', '', 1, '2022-03-11 17:45:43', 0),
(8, 'Fernando Lazaro', '', '', 'Cliente', '', '', '', 1, '2022-04-03 16:23:54', 0),
(9, 'Isabella Santos', '', '', 'Cliente', '', '', '', 1, '2022-05-03 16:20:37', 0),
(10, 'Ikaro Lima', '', '', 'Cliente', '', '', '', 1, '2022-06-03 16:20:47', 0),
(11, 'Luis Roberto', '', '', 'Cliente', '', '', '', 1, '2022-08-03 16:20:55', 0),
(12, 'Roberto Marinho', '', '', 'Cliente', '', '', '', 1, '2022-08-03 16:21:04', 0),
(13, 'Eliezer', '', '', 'Cliente', '', '', '', 1, '2022-09-03 16:21:10', 0),
(14, 'Gustavo', '', '', 'Cliente', '', '', '', 1, '2022-10-03 16:21:16', 0),
(15, 'Lauany', '', '', 'Cliente', '', '', '', 1, '2022-11-03 16:21:22', 0),
(16, 'Joaneide', '', '', 'Cliente', '', '', '', 1, '2022-12-03 16:21:31', 0),
(17, 'Ricardo', '', '', 'Cliente', '', '', '', 1, '2023-01-03 16:21:43', 0),
(18, 'Lucas Emanoel', '', '', 'Cliente', '', '', '', 1, '2023-01-03 16:21:50', 0),
(19, 'Ikaro Lima', '', '', 'Cliente', '', '', '', 1, '2023-02-03 16:21:58', 0),
(20, 'Testeee 2', '', '', 'Cliente', '', '', '', 1, '2023-02-04 13:37:20', 0);

-- --------------------------------------------------------

--
-- Estrutura para vista `cadastros_de_usuarios_ultimos_meses`
--
DROP TABLE IF EXISTS `cadastros_de_usuarios_ultimos_meses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cadastros_de_usuarios_ultimos_meses`  AS SELECT DISTINCT (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate(),'%Y-%m')) AS `mesAtualCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate(),'%Y-%m')) AS `mesAtualAdministrador`, (select date_format(curdate(),'%Y-%m')) AS `mesAtual`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 1 month,'%Y-%m')) AS `umMesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 1 month,'%Y-%m')) AS `umMesAtrasAdministrador`, (select date_format(curdate() - interval 1 month,'%Y-%m')) AS `umMesAtras`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 2 month,'%Y-%m')) AS `doisMesesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 2 month,'%Y-%m')) AS `doisMesesAtrasAdministrador`, (select date_format(curdate() - interval 2 month,'%Y-%m')) AS `doisMesesAtras`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 3 month,'%Y-%m')) AS `tresMesesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 3 month,'%Y-%m')) AS `tresMesesAtrasAdministrador`, (select date_format(curdate() - interval 3 month,'%Y-%m')) AS `tresMesesAtras`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 4 month,'%Y-%m')) AS `quatroMesesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 4 month,'%Y-%m')) AS `quatroMesesAtrasAdministrador`, (select date_format(curdate() - interval 4 month,'%Y-%m')) AS `quatroMesesAtras`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 5 month,'%Y-%m')) AS `cincoMesesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 5 month,'%Y-%m')) AS `cincoMesesAtrasAdministrador`, (select date_format(curdate() - interval 5 month,'%Y-%m')) AS `cincoMesesAtras`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 6 month,'%Y-%m')) AS `seisMesesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 6 month,'%Y-%m')) AS `seisMesesAtrasAdministrador`, (select date_format(curdate() - interval 6 month,'%Y-%m')) AS `seisMesesAtras`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 7 month,'%Y-%m')) AS `seteMesesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 7 month,'%Y-%m')) AS `seteMesesAtrasAdministrador`, (select date_format(curdate() - interval 7 month,'%Y-%m')) AS `seteMesesAtras`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 8 month,'%Y-%m')) AS `oitoMesesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 8 month,'%Y-%m')) AS `oitoMesesAtrasAdministrador`, (select date_format(curdate() - interval 8 month,'%Y-%m')) AS `oitoMesesAtras`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 9 month,'%Y-%m')) AS `noveMesesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 9 month,'%Y-%m')) AS `noveMesesAtrasAdministrador`, (select date_format(curdate() - interval 9 month,'%Y-%m')) AS `noveMesesAtras`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 10 month,'%Y-%m')) AS `dezMesesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 10 month,'%Y-%m')) AS `dezMesesAtrasAdministrador`, (select date_format(curdate() - interval 10 month,'%Y-%m')) AS `dezMesesAtras`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Cliente' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 11 month,'%Y-%m')) AS `onzeMesesAtrasCliente`, (select count(0) from `usuarios_usuarios` where `usuarios_usuarios`.`ativo` = 0 and `usuarios_usuarios`.`tipo` = 'Administrador' and date_format(`usuarios_usuarios`.`dataDeCadastro`,'%Y-%m') = date_format(curdate() - interval 11 month,'%Y-%m')) AS `onzeMesesAtrasAdministrador`, (select date_format(curdate() - interval 11 month,'%Y-%m')) AS `onzeMesesAtras``onzeMesesAtras`  ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ultimosmeses`
--
ALTER TABLE `ultimosmeses`
  ADD PRIMARY KEY (`idMes`);

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
-- AUTO_INCREMENT de tabela `ultimosmeses`
--
ALTER TABLE `ultimosmeses`
  MODIFY `idMes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios_atualizacoes`
--
ALTER TABLE `usuarios_atualizacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuarios_usuarios`
--
ALTER TABLE `usuarios_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
