-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06-Nov-2016 às 06:23
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
(12, 9, '115.726.956-76', ', Aspectos Tecnicos, Utilidade', 8, 'OK'),
(15, 19, '444.444.444-44', ', Viabilidade Financeira', 8, 'AvaliaÃ§Ã£o ');

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
(2, 'Pequenas Obras', 'Viabilidade Espacial', 'Analisa se e possivel aplicar o projeto no local especificado', 'ativado', 10),
(3, 'CompetiÃ§Ã£o TecnolÃ³gica', 'Aspectos Tecnicos', 'Informa se os aspectos tecnicos apresentados sao coerentes com a realidade', 'ativado', 3),
(4, 'CompetiÃ§Ã£o TecnolÃ³gica', 'Utilidade', 'Analisa a utilidade do projeto', 'ativado', 6),
(7, 'Pesquisa', 'CritÃ©rio Teste de AvaliaÃ§Ã£o', '13', 'desativado', 7),
(9, 'CompetiÃ§Ã£o TecnolÃ³gica', 'PertinÃªncia para a universidade', 'Validar a pertinÃªncia deste projeto para o renome da universidade', 'ativado', 5);

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
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `dataPublicacao` date NOT NULL,
  `dataTermino` date NOT NULL,
  `valTotal` float NOT NULL,
  `valMin` float NOT NULL,
  `valMax` float NOT NULL,
  `arquivo` varchar(30) NOT NULL,
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

INSERT INTO `editalorcamento` (`id`, `nome`, `dataPublicacao`, `dataTermino`, `valTotal`, `valMin`, `valMax`, `arquivo`, `cotaAluno`, `cotaProfessor`, `cotaServ`, `qtdAluno`, `qtdProfessor`, `qtdServ`, `valTotalAluno`, `valTotalProfessor`, `valTotalServ`, `valIndAluno`, `valIndProfessor`, `valIndServ`) VALUES
(2017, 'Cadastro Teste de Edital 2016', '2016-11-06', '2016-12-25', 1000, 10, 100, '', 0.1, 0.5, 0.4, 1, 2, 1, 100, 500, 400, 100, 250, 400);

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
(3, 'aprovado', 'Teste3', '418.417.478-74', 1200.5, 100, '2016-09-16', '2017-02-08', 'rem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.rem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.', 'Pesquisa', 793, 'rem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat.', '../../Imagens/img02.jpg'),
(9, 'aprovado', 'Projeto de CompetiÃ§Ã£o TecnolÃ³gica', '115.726.956-76', 1000, 100, '2016-10-23', '2017-02-07', 'Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla ', 'CompetiÃ§Ã£o TecnolÃ³gica', 0, 'Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla Blablabla Resumo Balbalblblabla ', '../../Imagens/NoImage.jpg'),
(19, 'aprovado', 'Projeto 1', '111.111.111-11', 120, 200, '2016-10-31', '2017-05-19', 'Meu primeiro projeto', 'Pesquisa', 0, 'Meu primeiro projeto', '../../Imagens/NoImage.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `repassefinanceiro`
--

CREATE TABLE `repassefinanceiro` (
  `id` int(11) NOT NULL,
  `idProjeto` int(11) NOT NULL,
  `valor` float NOT NULL,
  `necessidade` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `repassefinanceiro`
--

INSERT INTO `repassefinanceiro` (`id`, `idProjeto`, `valor`, `necessidade`, `date`, `status`) VALUES
(1, 9, 10, 'Compra de Materiais', '2016-11-05', 'NÃ£o Quitado'),
(3, 9, 80.25, 'Compra de Computador', '2016-11-05', 'Quitado');

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
('111.111.111-11', 'Gestor de Projetos', 'Vitor Pio', 'vitor@gmail.com', '1234', 37501150, 'Avenida Henriqueto Cardinali', 485, 'Varginha', 'ItajubÃ¡', 'MG', '', '1994-05-28', 'ativo'),
('115.726.956-76', 'Gestor de Projetos', 'Davi Braga da Cruz', 'davibc19@hotmail.com', '1234', 37505122, 'Rua Belo Horizonte', 69, 'Boa Vista', 'ItajubÃ¡', 'MG', 'CompetiÃ§Ã£o TecnolÃ³gica', '1996-04-19', 'ativo'),
('222.222.222-22', 'Financiador Publico', 'Davi Cruz', 'davi@gmail.com', '1234', 37501151, 'Rua JosÃ© Nogueira Leite', 122, 'VarginhaÂ ', 'ItajubÃ¡', 'MG', '', '1993-10-12', ''),
('333.333.333-33', 'Financiador Academico', 'Pedro Henrique', 'pedro@gmail.com', '1234', 37501152, 'Rua Euclides Miranda', 57, 'Varginha', 'ItajubÃ¡', 'MG', '', '1990-01-01', ''),
('444.444.444-44', 'Avaliador de Projetos', 'Vagner Marques', 'vagner@gmail.com', '1234', 37501153, 'Avenida Henriqueto Cardinali - de 259/260 a 5', 91, 'VarginhaÂ ', 'ItajubÃ¡', 'MG', 'Pesquisa', '1995-05-28', '');

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repassefinanceiro`
--
ALTER TABLE `repassefinanceiro`
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
  MODIFY `idAvaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `criterios`
--
ALTER TABLE `criterios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `doacoes`
--
ALTER TABLE `doacoes`
  MODIFY `idDoacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `editalorcamento`
--
ALTER TABLE `editalorcamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2019;
--
-- AUTO_INCREMENT for table `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `repassefinanceiro`
--
ALTER TABLE `repassefinanceiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
