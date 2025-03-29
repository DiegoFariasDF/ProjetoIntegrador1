-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 29/03/2025 às 14:52
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
  `status` enum('emprestado','devolvido') NOT NULL DEFAULT 'emprestado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id`, `leitor_id`, `data_emprestimo`, `livro`, `qtd_renovacao`, `status`) VALUES
(2, 1, '2025-02-20', 'A Cabana', 0, 'devolvido'),
(3, 6, '2025-03-20', 'A Cabana 2', 0, 'devolvido'),
(4, 4, '2025-03-20', 'A Cabana 3', 0, 'devolvido'),
(5, 3, '2025-03-20', 'A Cabana 4', 0, 'devolvido'),
(6, 7, '2025-03-20', 'A Cabana 5', 0, 'emprestado'),
(7, 1, '2025-03-29', 'teste29/03', 0, 'emprestado');

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
(1, 'Diego Farias', '12999999999', 0),
(2, 'teste2', '12999999999', 0),
(3, 'mario', '1288888888', 1),
(4, 'Mauricio', '12981717465', 1),
(5, 'Rodrigo', '12981727468', 0),
(6, 'Joyce', '12997588000', 0),
(7, 'Rubiscleide', '129785456', 0),
(8, 'Diego Farias', '1298880033', 0),
(9, 'Rodrigao', '1291888888', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`) VALUES
(1, 'teste', 'teste', 'teste'),
(2, 'teste2', 'teste2', 'teste2');

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `emprestimo_ibfk_1` FOREIGN KEY (`leitor_id`) REFERENCES `leitores` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `historico_alteracao`
--
ALTER TABLE `historico_alteracao`
  ADD CONSTRAINT `historico_alteracao_ibfk_1` FOREIGN KEY (`funcionario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;