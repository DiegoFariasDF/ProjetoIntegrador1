-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/04/2025 às 03:54
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
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id` int(11) NOT NULL,
  `leitor_id` int(11) NOT NULL,
  `data_emprestimo` date NOT NULL,
  `livro` varchar(60) NOT NULL,
  `qtd_renovacao` int(11) NOT NULL DEFAULT 0,
  `status` enum('emprestado','devolvido') NOT NULL DEFAULT 'emprestado',
  `atraso` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id`, `leitor_id`, `data_emprestimo`, `livro`, `qtd_renovacao`, `status`, `atraso`) VALUES
(1, 2, '2025-03-30', 'Teste 1', 0, 'devolvido', 0),
(2, 1, '2025-03-30', 'teste 2', 0, 'devolvido', 0),
(3, 1, '2025-04-03', 'Frases da vida', 0, 'devolvido', 0),
(4, 7, '2025-04-04', 'Frases da vida', 0, 'emprestado', 1),
(5, 2, '2025-04-04', 'sEila 122', 0, 'emprestado', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_alteracao`
--

CREATE TABLE `historico_alteracao` (
  `id` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `acao` varchar(255) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `leitores`
--

CREATE TABLE `leitores` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `qtd_atrasos` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `leitores`
--

INSERT INTO `leitores` (`id`, `nome`, `telefone`, `qtd_atrasos`) VALUES
(1, 'teste1', '12999999999', 0),
(2, 'teste2', '12999999999', 0),
(3, 'Jublisclede', '12999999999', 0),
(4, 'Hdhshsjs', '12999999999', 0),
(5, 'Ehdhdhdjjd', '12999999999', 0),
(6, 'Ejdshdjdjshs', '12999999999', 0),
(7, 'Usjsjsjsjskxk', '12999999999', 0),
(8, 'Uehsjsjsjsjx', '12999999999', 0),
(9, 'Hshsjsjs', '12999999999', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `permissao` varchar(30) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `permissao`, `senha`) VALUES
(1, 'Administrador', 'admin', 'admin', '$2y$10$H4GFGilPmJs5IS0Y2CjaLerY0Vq1THalwhEsShwlLf5qOOKPkPbZ.'),
(2, 'Diego Farias', 'diego.farias', 'padrao', '$2y$10$FJS6ZS0ftvmUdcg1EOLKIuaeP9qB/rqdtZatxregIcTY12E7n6VL.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leitor_id` (`leitor_id`);

--
-- Índices de tabela `historico_alteracao`
--
ALTER TABLE `historico_alteracao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionario_id` (`funcionario_id`);

--
-- Índices de tabela `leitores`
--
ALTER TABLE `leitores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `historico_alteracao`
--
ALTER TABLE `historico_alteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `leitores`
--
ALTER TABLE `leitores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`leitor_id`) REFERENCES `leitores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `historico_alteracao`
--
ALTER TABLE `historico_alteracao`
  ADD CONSTRAINT `historico_alteracao_ibfk_1` FOREIGN KEY (`funcionario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
