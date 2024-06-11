-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/06/2024 às 02:47
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
-- Banco de dados: `clinica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `procedimento_id` int(11) NOT NULL,
  `data_hora` datetime NOT NULL,
  `observacoes` text DEFAULT NULL,
  `data_hora_termino` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `consultas`
--

INSERT INTO `consultas` (`id`, `paciente_id`, `procedimento_id`, `data_hora`, `observacoes`, `data_hora_termino`) VALUES
(26, 1, 1, '2024-05-27 09:00:00', 'Consulta de rotina', '2024-05-27 10:00:00'),
(27, 2, 2, '2024-05-28 14:30:00', 'Necessário realizar obturação', '2024-05-28 15:30:00'),
(28, 3, 3, '2024-05-29 16:45:00', 'Agendamento para limpeza', '2024-05-29 17:45:00'),
(29, 4, 4, '2024-05-30 10:00:00', 'Realizar canal em dente 25', '2024-05-30 11:00:00'),
(30, 5, 5, '2024-05-31 13:00:00', 'Consulta para avaliação de implante', '2024-05-31 14:00:00'),
(31, 6, 1, '2024-06-01 09:30:00', 'Consulta de rotina', '2024-06-01 10:30:00'),
(32, 7, 2, '2024-06-02 15:30:00', 'Obturação em dente 31', '2024-06-02 16:30:00'),
(33, 8, 3, '2024-06-03 11:00:00', 'Extração do dente 18', '2024-06-03 12:00:00'),
(34, 9, 4, '2024-06-04 14:00:00', 'Consulta de revisão', '2024-06-04 15:00:00'),
(35, 10, 5, '2024-06-05 16:00:00', 'Implante dentário', '2024-06-05 17:00:00'),
(36, 54, 14, '2024-05-28 13:12:00', 'Siso', '0000-00-00 00:00:00'),
(37, 54, 15, '2024-05-26 09:13:00', 'canal', '0000-00-00 00:00:00'),
(38, 53, 14, '2024-05-28 08:17:00', 'siso', '0000-00-00 00:00:00'),
(39, 53, 15, '2024-05-22 09:17:00', 'canal', '0000-00-00 00:00:00'),
(40, 53, 12, '2024-05-31 13:17:00', 'limpeza', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `procedimentos`
--

CREATE TABLE `procedimentos` (
  `id` int(11) NOT NULL,
  `nome_procedimento` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `procedimentos`
--

INSERT INTO `procedimentos` (`id`, `nome_procedimento`, `preco`) VALUES
(12, 'Limpeza Dental', 200.00),
(13, 'Obturação', 500.00),
(14, 'Extração de Dente', 800.00),
(15, 'Canal', 1500.00),
(16, 'Implante Dentário', 3000.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nivel_acesso` int(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `endereco` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel_acesso`, `telefone`, `cpf`, `endereco`) VALUES
(42, 'funcionario', 'funcionario@email.com', '$2y$10$q.2wQHp6SEMpCrZzm.1jJO82bRgLYZQl1lvCHMxzn8Hcv/f8ZfJKW', 0, '1234567890', '12345678901', 'Rua A, 123'),
(43, 'João Santos', 'joao@email.com', '$2y$10$u6z7lti5I9JUMGKLcT0y2eU76J2Ih/OG/nyhMnMYHo2FupVYOtZRW', 0, '9876543210', '98765432109', 'Rua B, 456'),
(44, 'Ana Oliveira', 'ana@email.com', '$2y$10$0XIfxV9alRI32ZzF/yP8g.PWnKocS0E6ofEH2Wxj/i.4la0C1.8Fa', 1, '6543210987', '65432198703', 'Rua C, 789'),
(45, 'Pedro Costa', 'pedro@email.com', '$2y$10$G5aF1rgo7yZw6TUYzJi22.yT5EjC1Qd4x6Ii9QcqG7Zn/2nBgeAWy', 1, '1230987654', '12309876501', 'Rua D, 456'),
(46, 'Luiza Pereira', 'luiza@email.com', '$2y$10$vunxKzjxAXsKANy7ckhJ2OEx89I5zhGlNo6pQiEav5wNTr/BGoW2a', 1, '9876540123', '98765401209', 'Rua E, 789'),
(47, 'Carlos Rodrigues', 'carlos@email.com', '$2y$10$rbsz/76ok9KYbVd6Goz5I.WziTw7J.LR6NTT5xQeR7lAFBu5NSqly', 3, '6540123789', '65401237803', 'Rua F, 123'),
(48, 'Amanda Souza', 'amanda@email.com', '$2y$10$HLIUKuF/eK7RltO4owKHU.V5JKInSMd3q6I/ADvLhB9eR3BY4Rha6', 3, '1237890123', '12378901201', 'Rua G, 456'),
(49, 'Lucas Fernandes', 'lucas@email.com', '$2y$10$40pTHUyGj0GtA49xQVT.oO.xmGoZ8mSY7RYPYx57SNYBC3.zQGVG6', 3, '9870123456', '98701234509', 'Rua H, 789'),
(50, 'Juliana Almeida', 'juliana@email.com', '$2y$10$zqEEWxI2sQyyfH6Gr4RmVulOG4HfEgS2r.7aMnA9W9zQ4ML32YckG', 3, '6547890123', '65478901203', 'Rua I, 123'),
(51, 'Gustavo Lima', 'gustavo@email.com', '$2y$10$FzH1N.6E8JfHtiv.BfIZteNTMj4eLX9v0euHX/EEb0QxV9NBiFTb6', 3, '1230123456', '12301234501', 'Rua J, 456'),
(1, 'Admm', 'adm@email.com', '$2y$10$STybHkcPyh6q9oYN/q2QvOVq/jbokTExyOnAvaZQd1xjZb0MC0ZsO', 1, '', '', ''),
(53, 'Gabriela', 'gabi@gmail.com', '$2y$10$IbTAdYgJ4Z.RCT04Kq3RPuG0P2fn98HLZ/YJ.RfECEOLubpxu46Eq', 3, '1243', '42342424324', 'rua da gabriela'),
(54, 'paulo', 'paulo@email.com', '$2y$10$ugOM7Lea04oWc7JBKqplROEbZ8BoVKuYEbnVVr.517at/pEAlNVV2', 3, '13213', '42343242', 'rua josee'),
(55, 'paciente', 'paciente@email.com', '$2y$10$TjTASpQUFRXxb.a9EjY.Kuztn1RJ./W196xwDg0KBafIGTuxdWc/m', 3, '3123131', '31231231', 'rua');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `procedimento_id` (`procedimento_id`);

--
-- Índices de tabela `procedimentos`
--
ALTER TABLE `procedimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `procedimentos`
--
ALTER TABLE `procedimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
