-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Ago-2021 às 16:46
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema`
--

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
(1, 'Davi Monteiro', '1.jpg', 'admin@gmail.com', 'admin', 'Administrador Geral', '', '', '', 0, '2021-05-02 23:40:38', 0),
(2, 'Luiz Fernando', '2.jpg', '', '', 'Cliente', '', '(11) 11111-1111', '', 1, '2021-05-02 19:03:38', 1),
(3, 'Ana Clara', '3.png', '', '', 'Cliente', 'Rua Maria da Silva, 862, Cidade Nova', '(88) 99682-4752', '548.294.790-10', 1, '2021-05-02 19:05:39', 0),
(4, 'Maria Júlia', '4.png', 'maria@gmail.com', 'maria', 'Administrador', 'São Paulo - SP - Brasil', '(88) 99284-0923', '475.839.284-92', 1, '2021-05-02 19:17:30', 0),
(5, 'Jean', '5.jpg', '', '', 'Cliente', '', '', '', 1, '2021-05-04 00:22:45', 1),
(6, 'kkkk6', '6.png', '', '', 'Cliente', '', '', '', 1, '2021-05-04 00:24:50', 0),
(7, 'rebeca', '7.png', '', '', 'Cliente', '', '', '', 1, '2021-05-04 00:32:23', 0),
(8, 'teste cadawd', '8.jpg', '', '', 'Cliente', '', '', '', 1, '2021-05-04 18:16:36', 1),
(9, 'Jessica', '9.png', '', '', 'Cliente', '', '', '', 1, '2021-05-05 23:31:47', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuario_usuarios`
--
ALTER TABLE `usuario_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuario_usuarios`
--
ALTER TABLE `usuario_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
