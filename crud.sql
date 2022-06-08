-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Jun-2022 às 21:47
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crud`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

CREATE TABLE `vagas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` enum('s','n') NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vagas`
--

INSERT INTO `vagas` (`id`, `titulo`, `descricao`, `ativo`, `data`) VALUES
(12, 'Coder - Java', 'Full-Stack', 's', '2022-06-09 00:06:31'),
(13, 'Coder - C#', 'Back-End', 's', '2022-06-09 00:06:55'),
(14, 'Coder - Asp.Net', 'Front-End', 's', '2022-06-09 00:06:06'),
(15, 'Developer - JavaScript', 'Front-End', 'n', '2022-06-09 00:06:59'),
(16, 'Dev - Jquery', 'Front-end', 'n', '2022-06-09 00:06:17'),
(17, 'Developer - NodeJs', 'Back-End', 's', '2022-06-09 00:06:38'),
(18, 'Coder - PHP', 'Back-End', 's', '2022-06-09 00:06:59'),
(19, 'Dev - Rust', 'Back-End', 's', '2022-06-09 00:06:17'),
(20, 'Developer - Android - Xamarin', 'Front-End', 'n', '2022-06-09 00:06:20');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
