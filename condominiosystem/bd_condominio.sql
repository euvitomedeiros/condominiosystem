-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Jul-2020 às 04:57
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.7

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
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `CatCodigo` int(10) NOT NULL,
  `CatNome` varchar(200) NOT NULL,
  `CatGrupo` varchar(200) NOT NULL,
  `CatSubGrupo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`CatCodigo`, `CatNome`, `CatGrupo`, `CatSubGrupo`) VALUES
(3, 'Refrigerante de Cola', 'Bebidas', 'Refrigerante');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(10) NOT NULL,
  `nomeCliente` varchar(250) NOT NULL,
  `cpfCliente` varchar(14) NOT NULL,
  `cnpjCliente` varchar(15) NOT NULL,
  `endereco` varchar(250) NOT NULL,
  `bairro` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `idFornecedor` int(10) NOT NULL,
  `nomeFornecedor` varchar(250) NOT NULL,
  `fantasiaForn` varchar(250) NOT NULL,
  `ForCNPJ` varchar(25) NOT NULL,
  `ForEndereco` varchar(250) NOT NULL,
  `ForFone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`idFornecedor`, `nomeFornecedor`, `fantasiaForn`, `ForCNPJ`, `ForEndereco`, `ForFone`) VALUES
(1, 'Jota PÊ', 'Jota Pê Cia', '02912182345', 'Rua da Pátria', '55 51 34452527'),
(2, 'Vonpar Ltda', 'Coca-Cola', '02912182345', 'Av. Assis Brasil', '55 51 34560909');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProduto` int(10) NOT NULL,
  `ProDescricao` varchar(250) NOT NULL,
  `CatCodigo` int(50) NOT NULL,
  `ProFornecedor` int(50) NOT NULL,
  `ProPrecoVenda` float NOT NULL,
  `ProMargemLucro` float NOT NULL,
  `ProEstoque` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `idVenda` int(10) NOT NULL,
  `VenData` date NOT NULL,
  `CliCodigoFK` int(20) NOT NULL,
  `VenValor` double NOT NULL,
  `VenDesconto` float NOT NULL,
  `VenFrete` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas_produtos`
--

CREATE TABLE `vendas_produtos` (
  `VenCodigoFK` int(10) NOT NULL,
  `ProCodigoFK` int(20) NOT NULL,
  `VenQuantidade` int(20) NOT NULL,
  `VenValor` float NOT NULL,
  `VenDesconto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`CatCodigo`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`idFornecedor`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`idVenda`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `CatCodigo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `idFornecedor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `idVenda` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
