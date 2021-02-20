-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jan-2021 às 02:40
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `usuarios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--
DROP DATABASE IF EXISTS usuarios;
CREATE DATABASE IF NOT EXISTS usuarios;
use usuarios;
CREATE TABLE `usuario` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`user_id`, `username`, `user_email`, `user_password`, `telefone`, `endereco`) VALUES
(61, 'Caique Ponjjar', 'caiqueponjjar@gmail.com', '$2y$10$GTaVT5H8VulClp.Kdwkrwun8ld19WuzMuIYP49ErwYeTN3hcG5kfO', '(19) 99872-0313', 'Rua Christina Giordano Miguel, 320'),
(48, 'Administrador ?', 'admin@ifsp.edu.br', '$2y$10$RgW2xNgpYAKIpgow3hISvOWXVzLhyr2UWtEqYZzdlSmDzoqLkK6sm', '', ''),
(54, 'Rhyan Santos de Oliveira', 'rhyan.oliveira@aluno.ifsp.edu.br', '$2y$10$XkHNRZqYw.WnAMpQ8aUXIOwTnIovht3Va2FzeyHfsMARJOvXLb4ue', '(19) 99769-8769', 'Rua José Custódio de Oliveira, 188');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
