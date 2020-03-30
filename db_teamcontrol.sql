-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Mar-2020 às 00:25
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teamcontrol`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descricao` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `descricao`, `valor`) VALUES
(1, 'Cerimônia de Casamento', 30000.00),
(2, 'Festa de Aniversário', 5000.00),
(3, 'Festa de Formatura', 25000.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `nome`, `telefone`, `celular`, `data_nascimento`, `cpf`) VALUES
(1, 'Jamal', '1800000000', '18900000000', '1995-04-06', '11111111111'),
(2, 'Sara', '1800000000', '18900000000', '1983-06-24', '11111111111'),
(3, 'Fiona', '1800000000', '18900000000', '1982-03-26', '11111111111'),
(4, 'Macaulay', '1800000000', '18900000000', '1990-07-19', '11111111111'),
(5, 'Rebekah', '1800000000', '18900000000', '1997-11-07', '11111111111'),
(6, 'Camden', '1800000000', '18900000000', '1994-06-30', '11111111111'),
(7, 'Patience', '1800000000', '18900000000', '1991-08-02', '11111111111'),
(8, 'Kim', '1800000000', '18900000000', '1986-10-24', '11111111111'),
(9, 'Lois', '1800000000', '18900000000', '1990-07-30', '11111111111'),
(10, 'Ciara', '1800000000', '18900000000', '1982-05-24', '11111111111'),
(11, 'Drew', '1800000000', '18900000000', '1995-11-15', '11111111111'),
(12, 'Elaine', '1800000000', '18900000000', '1992-11-27', '11111111111'),
(13, 'Kylee', '1800000000', '18900000000', '1985-02-04', '11111111111'),
(14, 'Aphrodite', '1800000000', '18900000000', '1985-08-23', '11111111111'),
(15, 'Tucker', '1800000000', '18900000000', '1988-07-21', '11111111111'),
(16, 'Jackson', '1800000000', '18900000000', '1991-01-30', '11111111111'),
(17, 'Gay', '1800000000', '18900000000', '1995-11-04', '11111111111'),
(18, 'Angelica', '1800000000', '18900000000', '1990-09-05', '11111111111'),
(19, 'Wayne', '1800000000', '18900000000', '1997-11-29', '11111111111'),
(20, 'Quinn', '1800000000', '18900000000', '1996-06-23', '11111111111'),
(21, 'Felicia', '1800000000', '18900000000', '1986-08-08', '11111111111'),
(22, 'Burke', '1800000000', '18900000000', '1989-05-25', '11111111111'),
(23, 'Isaiah', '1800000000', '18900000000', '1986-11-11', '11111111111'),
(24, 'Basil', '1800000000', '18900000000', '1985-10-27', '11111111111'),
(25, 'Kevin', '1800000000', '18900000000', '1995-08-17', '11111111111'),
(26, 'Kermit', '1800000000', '18900000000', '1990-06-21', '11111111111'),
(27, 'Xanthus', '1800000000', '18900000000', '1983-07-28', '11111111111'),
(28, 'Fiona', '1800000000', '18900000000', '1988-03-21', '11111111111'),
(29, 'Jelani', '1800000000', '18900000000', '2000-03-14', '11111111111'),
(30, 'Elmo', '1800000000', '18900000000', '1983-01-21', '11111111111'),
(31, 'Jana', '1800000000', '18900000000', '1989-09-14', '11111111111'),
(32, 'Ulric', '1800000000', '18900000000', '1987-09-09', '11111111111'),
(33, 'Jelani', '1800000000', '18900000000', '1995-06-09', '11111111111'),
(34, 'Kirsten', '1800000000', '18900000000', '1984-07-22', '11111111111'),
(35, 'Shay', '1800000000', '18900000000', '1991-07-09', '11111111111'),
(36, 'Todd', '1800000000', '18900000000', '1995-11-06', '11111111111'),
(37, 'Eaton', '1800000000', '18900000000', '1993-09-10', '11111111111'),
(38, 'Burton', '1800000000', '18900000000', '1990-12-01', '11111111111'),
(39, 'Tyrone', '1800000000', '18900000000', '1987-01-27', '11111111111'),
(40, 'Kaye', '1800000000', '18900000000', '1997-07-18', '11111111111'),
(41, 'Lysandra', '1800000000', '18900000000', '1988-07-18', '11111111111'),
(42, 'Paki', '1800000000', '18900000000', '1997-04-10', '11111111111'),
(43, 'Minerva', '1800000000', '18900000000', '1984-03-03', '11111111111'),
(44, 'Haviva', '1800000000', '18900000000', '1989-10-27', '11111111111'),
(45, 'Delilah', '1800000000', '18900000000', '1982-11-28', '11111111111'),
(46, 'Stephen', '1800000000', '18900000000', '1999-03-23', '11111111111'),
(47, 'Silas', '1800000000', '18900000000', '1991-12-26', '11111111111'),
(48, 'Maile', '1800000000', '18900000000', '1983-12-21', '11111111111'),
(49, 'Hadassah', '1800000000', '18900000000', '1987-02-19', '11111111111'),
(50, 'Raven', '1800000000', '18900000000', '1986-02-23', '11111111111'),
(51, 'Tara', '1800000000', '18900000000', '1991-06-16', '11111111111'),
(52, 'Fulton', '1800000000', '18900000000', '1995-01-10', '11111111111'),
(53, 'Ferris', '1800000000', '18900000000', '1985-08-05', '11111111111'),
(54, 'Rooney', '1800000000', '18900000000', '1993-12-15', '11111111111'),
(55, 'Desirae', '1800000000', '18900000000', '1989-11-26', '11111111111'),
(56, 'Valentine', '1800000000', '18900000000', '2000-08-27', '11111111111'),
(57, 'Zeph', '1800000000', '18900000000', '1998-11-07', '11111111111'),
(58, 'Kieran', '1800000000', '18900000000', '1986-03-04', '11111111111'),
(59, 'Connor', '1800000000', '18900000000', '1987-01-07', '11111111111'),
(60, 'Martina', '1800000000', '18900000000', '1996-10-24', '11111111111'),
(61, 'Isaiah', '1800000000', '18900000000', '1980-11-29', '11111111111'),
(62, 'Hasad', '1800000000', '18900000000', '1988-08-16', '11111111111'),
(63, 'Kareem', '1800000000', '18900000000', '1998-01-13', '11111111111'),
(64, 'Harlan', '1800000000', '18900000000', '1993-12-06', '11111111111'),
(65, 'Eve', '1800000000', '18900000000', '1984-08-10', '11111111111'),
(66, 'Eagan', '1800000000', '18900000000', '1985-08-04', '11111111111'),
(67, 'Rashad', '1800000000', '18900000000', '2000-12-29', '11111111111'),
(68, 'Jordan', '1800000000', '18900000000', '1980-03-28', '11111111111'),
(69, 'Stuart', '1800000000', '18900000000', '1990-03-17', '11111111111'),
(70, 'Leo', '1800000000', '18900000000', '1981-05-26', '11111111111'),
(71, 'Hu', '1800000000', '18900000000', '1982-01-18', '11111111111'),
(72, 'August', '1800000000', '18900000000', '1993-01-31', '11111111111'),
(73, 'Whilemina', '1800000000', '18900000000', '1985-09-26', '11111111111'),
(74, 'Laith', '1800000000', '18900000000', '1980-07-30', '11111111111'),
(75, 'Stephen', '1800000000', '18900000000', '1984-04-20', '11111111111'),
(76, 'Judah', '1800000000', '18900000000', '1999-02-26', '11111111111'),
(77, 'Illiana', '1800000000', '18900000000', '1989-02-06', '11111111111'),
(78, 'Stone', '1800000000', '18900000000', '1999-12-25', '11111111111'),
(79, 'Ruby', '1800000000', '18900000000', '1997-04-25', '11111111111'),
(80, 'Chaim', '1800000000', '18900000000', '1980-05-13', '11111111111'),
(81, 'Piper', '1800000000', '18900000000', '1994-06-16', '11111111111'),
(82, 'Sasha', '1800000000', '18900000000', '1985-02-18', '11111111111'),
(83, 'Dai', '1800000000', '18900000000', '1997-09-09', '11111111111'),
(84, 'Vernon', '1800000000', '18900000000', '1986-06-28', '11111111111'),
(85, 'Isaac', '1800000000', '18900000000', '1987-04-26', '11111111111'),
(86, 'Sophia', '1800000000', '18900000000', '1997-10-01', '11111111111'),
(87, 'Jakeem', '1800000000', '18900000000', '1999-06-20', '11111111111'),
(88, 'Geraldine', '1800000000', '18900000000', '1994-05-31', '11111111111'),
(89, 'Herman', '1800000000', '18900000000', '1992-03-04', '11111111111'),
(90, 'Raya', '1800000000', '18900000000', '1992-10-09', '11111111111'),
(91, 'Cruz', '1800000000', '18900000000', '1981-04-09', '11111111111'),
(92, 'Liberty', '1800000000', '18900000000', '1980-01-31', '11111111111'),
(93, 'Chester', '1800000000', '18900000000', '1991-05-02', '11111111111'),
(94, 'Jacob', '1800000000', '18900000000', '1991-06-03', '11111111111'),
(95, 'Francesca', '1800000000', '18900000000', '1984-04-09', '11111111111'),
(96, 'Robin', '1800000000', '18900000000', '1982-03-15', '11111111111'),
(97, 'Chancellor', '1800000000', '18900000000', '1991-10-03', '11111111111'),
(98, 'Louis', '1800000000', '18900000000', '1985-04-19', '11111111111'),
(99, 'Amy', '1800000000', '18900000000', '1995-04-11', '11111111111'),
(100, 'Nasim', '1800000000', '18900000000', '1999-09-27', '11111111111');

-- --------------------------------------------------------

--
-- Estrutura da tabela `colab_funcoes`
--

CREATE TABLE `colab_funcoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `colab_funcoes`
--

INSERT INTO `colab_funcoes` (`id`, `nome`) VALUES
(1, 'Garçom'),
(2, 'Segurança');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipes`
--

CREATE TABLE `equipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_evento` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `equipes`
--

INSERT INTO `equipes` (`id`, `id_evento`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descricao` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_evento` date NOT NULL,
  `qtde_pessoas` int(11) NOT NULL,
  `local_evento` bigint(20) UNSIGNED NOT NULL,
  `categ_evento` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `descricao`, `data_evento`, `qtde_pessoas`, `local_evento`, `categ_evento`) VALUES
(1, 'Casamento do Sr. Lucas', '2020-12-06', 100, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos_colab`
--

CREATE TABLE `eventos_colab` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_colab` bigint(20) UNSIGNED NOT NULL,
  `id_funcao` bigint(20) UNSIGNED NOT NULL,
  `id_equipe` bigint(20) UNSIGNED NOT NULL,
  `valor_pago` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `eventos_colab`
--

INSERT INTO `eventos_colab` (`id`, `id_colab`, `id_funcao`, `id_equipe`, `valor_pago`) VALUES
(25, 1, 1, 1, 1.00),
(26, 4, 1, 1, 1000.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locais`
--

CREATE TABLE `locais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `endereco` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `locais`
--

INSERT INTO `locais` (`id`, `nome`, `endereco`) VALUES
(1, 'Salão de Festas', 'Rua Tiradentes, 1 - Pirapozinho - 19200-000'),
(2, 'Chácara Test', 'Rodovia Raposo Tavares, KM 1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `participantes`
--

CREATE TABLE `participantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `id_evento` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `participantes`
--

INSERT INTO `participantes` (`id`, `nome`, `cpf`, `id_evento`) VALUES
(1, 'Gabriel Pellin', '11111111111', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `pass_hash` varchar(255) DEFAULT NULL,
  `full_name` varchar(128) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `pass_hash`, `full_name`, `email`, `email_verified_at`, `created_at`, `deleted_at`) VALUES
(1, 'usuario', '$2y$10$U.sIzvBPOFKJqJP8Ycm/gOIxZW7yKJcdET/ssS61ooAotSazQUbza', 'Usuário', 'usuario@teamcontrol.com.br', '2020-03-30 00:00:00', '2020-03-30 00:00:00', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `colab_funcoes`
--
ALTER TABLE `colab_funcoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_equipe_evento` (`id_evento`);

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_categ_evento` (`categ_evento`),
  ADD KEY `fk_local_evento` (`local_evento`);

--
-- Índices para tabela `eventos_colab`
--
ALTER TABLE `eventos_colab`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_colab_evento` (`id_colab`),
  ADD KEY `fk_colab_funcao` (`id_funcao`),
  ADD KEY `fk_colab_equipe` (`id_equipe`);

--
-- Índices para tabela `locais`
--
ALTER TABLE `locais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fk_participante_evento` (`id_evento`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `colab_funcoes`
--
ALTER TABLE `colab_funcoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `eventos_colab`
--
ALTER TABLE `eventos_colab`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `locais`
--
ALTER TABLE `locais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `fk_equipe_evento` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`);

--
-- Limitadores para a tabela `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_categ_evento` FOREIGN KEY (`categ_evento`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_local_evento` FOREIGN KEY (`local_evento`) REFERENCES `locais` (`id`);

--
-- Limitadores para a tabela `eventos_colab`
--
ALTER TABLE `eventos_colab`
  ADD CONSTRAINT `fk_colab_equipe` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id`),
  ADD CONSTRAINT `fk_colab_evento` FOREIGN KEY (`id_colab`) REFERENCES `colaboradores` (`id`),
  ADD CONSTRAINT `fk_colab_funcao` FOREIGN KEY (`id_funcao`) REFERENCES `colab_funcoes` (`id`);

--
-- Limitadores para a tabela `participantes`
--
ALTER TABLE `participantes`
  ADD CONSTRAINT `fk_participante_evento` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
