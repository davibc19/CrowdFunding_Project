-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 30-Out-2016 às 19:13
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crowdfunding`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `idAvaliacao` int(11) NOT NULL,
  `idProjeto` int(11) NOT NULL,
  `cpfAval` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `criterios` text COLLATE utf8_unicode_ci NOT NULL,
  `notaFinal` int(11) NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`idAvaliacao`, `idProjeto`, `cpfAval`, `criterios`, `notaFinal`, `descricao`) VALUES
(3, 2, '115.726.956-76', 'Viabilidade Financeira', 5, ''),
(12, 9, '115.726.956-76', ', Aspectos Tecnicos, Utilidade', 8, 'OK');

-- --------------------------------------------------------

--
-- Estrutura da tabela `criterios`
--

CREATE TABLE `criterios` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `criterio` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `peso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `criterios`
--

INSERT INTO `criterios` (`id`, `categoria`, `criterio`, `descricao`, `status`, `peso`) VALUES
(1, 'Pesquisa', 'Viabilidade Financeira', 'Analisa a viabilidade financeira do projeto proposto', 'ativado', 5),
(2, 'Pequenas Obras', 'Viabilidade Espacial', 'Analisa se e possivel aplicar o projeto no local especificado', 'desativado', 10),
(3, 'CompetiÃ§Ã£o TecnolÃ³gica', 'Aspectos Tecnicos', 'Informa se os aspectos tecnicos apresentados sao coerentes com a realidade', 'ativado', 7),
(4, 'CompetiÃ§Ã£o TecnolÃ³gica', 'Utilidade', 'Analisa a utilidade do projeto', 'ativado', 6),
(7, 'Pesquisa', 'CritÃ©rio Teste de AvaliaÃ§Ã£o', '13', 'desativado', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `doacoes`
--

CREATE TABLE `doacoes` (
  `idDoacao` int(11) NOT NULL,
  `idProjeto` int(11) NOT NULL,
  `idUsr` varchar(14) NOT NULL,
  `valor` float NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `editalorcamento`
--

CREATE TABLE `editalorcamento` (
  `ano` int(4) NOT NULL,
  `valTotal` float NOT NULL,
  `cotaAluno` float NOT NULL,
  `cotaProfessor` float NOT NULL,
  `cotaServ` float NOT NULL,
  `qtdAluno` int(11) NOT NULL,
  `qtdProfessor` int(11) NOT NULL,
  `qtdServ` int(11) NOT NULL,
  `valTotalAluno` float NOT NULL,
  `valTotalProfessor` float NOT NULL,
  `valTotalServ` float NOT NULL,
  `valIndAluno` float NOT NULL,
  `valIndProfessor` float NOT NULL,
  `valIndServ` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `editalorcamento`
--

INSERT INTO `editalorcamento` (`ano`, `valTotal`, `cotaAluno`, `cotaProfessor`, `cotaServ`, `qtdAluno`, `qtdProfessor`, `qtdServ`, `valTotalAluno`, `valTotalProfessor`, `valTotalServ`, `valIndAluno`, `valIndProfessor`, `valIndServ`) VALUES
(2015, 10000000, 0, 0.7, 0.3, 0, 1, 1, 0, 7000000, 3000000, 0, 7000000, 3000000),
(2016, 100000, 0.1, 0.8, 0.1, 0, 1, 1, 10000, 80000, 10000, 0, 80000, 10000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(14) NOT NULL,
  `valorTotal` double NOT NULL,
  `duracao` int(11) NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `descricao` text NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `valArrecadado` float NOT NULL,
  `resumo` text NOT NULL,
  `imagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`id`, `status`, `titulo`, `autor`, `valorTotal`, `duracao`, `dataInicio`, `dataFim`, `descricao`, `categoria`, `valArrecadado`, `resumo`, `imagem`) VALUES
(2, 'aprovado', 'TituloTeste', '418.417.478-74', 100, 123, '2016-09-16', '0000-00-00', 'rem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.rem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.rem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.', 'Pesquisa', 0, 'rem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.', '../../Imagens/img01.jpg'),
(3, 'candidato', 'Teste3', '418.417.478-74', 1200.5, 100, '2016-09-16', '2017-02-07', 'rem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.rem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.', 'Pesquisa', 793, 'rem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.', '../../Imagens/img02.jpg'),
(9, 'aprovado', 'Projeto de CompetiÃ§Ã£o TecnolÃ³gica', '115.726.956-76', 1000, 100, '2016-10-23', '2017-02-07', 'Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla ', 'CompetiÃ§Ã£o TecnolÃ³gica', 0, 'Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla ', '../../Imagens/NoImage.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cpf` varchar(14) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(25) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `cep` int(8) NOT NULL,
  `rua` varchar(45) NOT NULL,
  `numero` int(5) NOT NULL,
  `bairro` varchar(25) NOT NULL,
  `cidade` varchar(25) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `categoria` varchar(40) NOT NULL,
  `dataNasc` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cpf`, `tipo`, `nome`, `email`, `senha`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `categoria`, `dataNasc`, `status`) VALUES
('115.726.956-76', 'Avaliador de Projetos', 'Davi Braga da Cruz', 'davibc19@hotmail.com', '1234', 37505122, 'Rua Belo Horizonte', 69, 'Boa Vista', 'ItajubÃ¡', 'MG', 'CompetiÃ§Ã£o TecnolÃ³gica', '1996-04-19', 'ativo'),
('418.417.478-74', 'Gestor de Projetos', 'Vitor Pio', 'vitormarquespio@gmail.com', '1234', 37501150, 'Avenida Henriqueto Cardinali', 485, 'Varginha', 'ItajubÃ¡', 'MG', '', '1994-05-28', 'ativo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`idAvaliacao`),
  ADD UNIQUE KEY `cpfAval` (`cpfAval`,`idProjeto`),
  ADD UNIQUE KEY `idAvaliacao` (`idAvaliacao`),
  ADD UNIQUE KEY `idAvaliacao_2` (`idAvaliacao`),
  ADD KEY `idProjeto` (`idProjeto`);

--
-- Indexes for table `criterios`
--
ALTER TABLE `criterios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doacoes`
--
ALTER TABLE `doacoes`
  ADD PRIMARY KEY (`idDoacao`);

--
-- Indexes for table `editalorcamento`
--
ALTER TABLE `editalorcamento`
  ADD PRIMARY KEY (`ano`);

--
-- Indexes for table `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cpf`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `idAvaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `criterios`
--
ALTER TABLE `criterios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `doacoes`
--
ALTER TABLE `doacoes`
  MODIFY `idDoacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`idProjeto`) REFERENCES `projeto` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
