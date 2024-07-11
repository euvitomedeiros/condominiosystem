-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jul-2024 às 03:24
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_condominio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comunicacao`
--

CREATE TABLE `comunicacao` (
  `id_comunicacao` int(11) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `titulo` varchar(255) NOT NULL,
  `mensagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `moradores`
--

CREATE TABLE `moradores` (
  `morador_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `num_apartamento` varchar(255) NOT NULL,
  `bloco` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `moradores`
--

INSERT INTO `moradores` (`morador_id`, `nome`, `sobrenome`, `num_apartamento`, `bloco`, `telefone`) VALUES
(0, 'Cassia ', 'Martins', '203', '1', '51984783212'),
(1, 'Mauro', 'Freitas', '101', '1', '5189269828');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `pagamento_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `ValorCondominio` decimal(10,2) NOT NULL,
  `data_vencimento` date NOT NULL,
  `status_pagamento` enum('Pago','Pendente','Atrasado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reclamacao`
--

CREATE TABLE `reclamacao` (
  `reclamacao_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipoPostagem` varchar(20) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `mensagem` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `reclamacao`
--

INSERT INTO `reclamacao` (`reclamacao_id`, `usuario_id`, `data_criacao`, `tipoPostagem`, `titulo`, `mensagem`) VALUES
(9, 13, '2024-07-03 02:20:50', 'reclamacao', 'Lâmpada do corredor de entrada do condomínio', 'Lâmpada do corredor de entrada do condomínio'),
(10, 16, '2024-07-03 04:11:15', 'aviso', 'Muro rachado', 'O muro que divide o condomínio está rachando');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `reserva_id` int(11) NOT NULL,
  `morador_id` int(11) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `data_reserva` date DEFAULT NULL,
  `hora_reserva` time DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`reserva_id`, `morador_id`, `area`, `data_reserva`, `hora_reserva`, `usuario_id`) VALUES
(2, 0, 'churrasqueira', '2024-07-06', '18:20:00', 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `solicitacao_acesso`
--

CREATE TABLE `solicitacao_acesso` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_solicitacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidade`
--

CREATE TABLE `unidade` (
  `unidade_id` int(11) NOT NULL,
  `morador_id` int(11) NOT NULL,
  `num_unidade` varchar(10) NOT NULL,
  `andar` varchar(10) NOT NULL,
  `num_apartamento` varchar(10) NOT NULL,
  `num_quarto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `unidade`
--

INSERT INTO `unidade` (`unidade_id`, `morador_id`, `num_unidade`, `andar`, `num_apartamento`, `num_quarto`) VALUES
(1, 1, '1', '4º', '410', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `senha_usuario` varchar(255) NOT NULL,
  `tipo_acesso` enum('normal','administrador') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `nome_usuario`, `email`, `telefone`, `cpf`, `rg`, `senha_usuario`, `tipo_acesso`) VALUES
(13, 'Vitor Freitas', 'vitor_freitas@morador.com', '1234567890', '11111', '111111', '$2y$10$i8VJgd8snEPVoMvV.XB37OnOeh.kDzfd/nuZuh0OS/PAyDl5Cinhq', 'normal'),
(16, 'Cassia Martins', 'cassia@morador.com.br', '1234567890', '11111', '111111', '$2y$10$yAoM.2strnnE0yZVWfcMP.PGpbc.OVucpQrwvUrgRNleXA5G7b37i', 'normal'),
(17, 'Usuario admin', 'admin@administrador.com.br', '1234567890', '11111', '111111', '$2y$10$JlQCah2vJHt3OGWehA408.yRPl1rx5eyJFJtQ5MT.6rNX.p9W174e', 'administrador');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comunicacao`
--
ALTER TABLE `comunicacao`
  ADD PRIMARY KEY (`id_comunicacao`);

--
-- Índices para tabela `moradores`
--
ALTER TABLE `moradores`
  ADD PRIMARY KEY (`morador_id`);

--
-- Índices para tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`pagamento_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `reclamacao`
--
ALTER TABLE `reclamacao`
  ADD PRIMARY KEY (`reclamacao_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`reserva_id`),
  ADD KEY `morador_id` (`morador_id`),
  ADD KEY `fk_usuario` (`usuario_id`);

--
-- Índices para tabela `solicitacao_acesso`
--
ALTER TABLE `solicitacao_acesso`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `unidade`
--
ALTER TABLE `unidade`
  ADD PRIMARY KEY (`unidade_id`),
  ADD KEY `morador_id` (`morador_id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comunicacao`
--
ALTER TABLE `comunicacao`
  MODIFY `id_comunicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `pagamento_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `reclamacao`
--
ALTER TABLE `reclamacao`
  MODIFY `reclamacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `reserva_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `solicitacao_acesso`
--
ALTER TABLE `solicitacao_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `unidade`
--
ALTER TABLE `unidade`
  MODIFY `unidade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `reclamacao`
--
ALTER TABLE `reclamacao`
  ADD CONSTRAINT `reclamacao_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Limitadores para a tabela `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`),
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`morador_id`) REFERENCES `moradores` (`morador_id`);

--
-- Limitadores para a tabela `unidade`
--
ALTER TABLE `unidade`
  ADD CONSTRAINT `unidade_ibfk_1` FOREIGN KEY (`morador_id`) REFERENCES `moradores` (`morador_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
