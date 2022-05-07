-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Mar-2022 às 03:01
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `nossavoz`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamado`
--

CREATE TABLE `chamado` (
  `chamado_cod` int(11) NOT NULL,
  `chamado_titulo` varchar(300) NOT NULL,
  `chamado_descricao` longtext NOT NULL,
  `chamado_bairro` mediumtext NOT NULL,
  `chamado_data_relato` date NOT NULL,
  `chamado_data_acontecimento` date NOT NULL,
  `chamado_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `chamado`
--

INSERT INTO `chamado` (`chamado_cod`, `chamado_titulo`, `chamado_descricao`, `chamado_bairro`, `chamado_data_relato`, `chamado_data_acontecimento`, `chamado_usuario`) VALUES
(16, 'Falta de luz', 'O bairro está com falta de luz recorrente, o que prejudica todos, ficamos horas e horas e quando tentamos ligar para a companhia, não nos atendem, muito menos resolvem.', 'Bom Princípio', '2022-03-20', '2022-03-17', 2),
(17, 'Vans escolares atrasando', 'Sou da RS 020 e tenho percebido um atraso muito grande das vans escolares, meu filho estuda na escola Padre Réus e hoje, atrasou 20 minutos por causa do transporte municipal, precisamos corrigir isso o mais rápido possível.', 'Neópolis', '2022-03-20', '2022-03-01', 2),
(21, 'Estrada Ruim', 'Agora com tempo de chuvas, a estrada são gonçalo está horrível! Não consigo mais passar de moto, ônibus e crianças com dificuldades para passar, isso é uma vergonha!', 'Águas Mortas', '2022-03-21', '2022-03-05', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `comentario_cod` int(11) NOT NULL,
  `comentario_descricao` longtext NOT NULL,
  `comentario_data` date NOT NULL,
  `comentario_usuario` int(11) NOT NULL,
  `comentario_chamado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`comentario_cod`, `comentario_descricao`, `comentario_data`, `comentario_usuario`, `comentario_chamado`) VALUES
(5, 'Aqui tem acontecido muito isso, moro na bom princípio e levo meu filho para o parque florido de van, pois é mais seguro, ontem, esperamos por 1 hora', '2022-03-21', 3, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usuario_cod` int(11) NOT NULL,
  `usuario_nome` varchar(60) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_senha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usuario_cod`, `usuario_nome`, `usuario_email`, `usuario_senha`) VALUES
(2, ' Maria Vitória', 'mariavitoria1137@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'Lucas Santos', 'mariacentraldofranqueado@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `chamado`
--
ALTER TABLE `chamado`
  ADD PRIMARY KEY (`chamado_cod`),
  ADD KEY `chamado_usuario` (`chamado_usuario`);

--
-- Índices para tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`comentario_cod`),
  ADD KEY `comentario_usuario` (`comentario_usuario`),
  ADD KEY `comentario_chamado` (`comentario_chamado`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_cod`),
  ADD UNIQUE KEY `usuario_email` (`usuario_email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chamado`
--
ALTER TABLE `chamado`
  MODIFY `chamado_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `comentario_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `chamado`
--
ALTER TABLE `chamado`
  ADD CONSTRAINT `chamado_ibfk_1` FOREIGN KEY (`chamado_usuario`) REFERENCES `usuario` (`usuario_cod`);

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`comentario_usuario`) REFERENCES `usuario` (`usuario_cod`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`comentario_chamado`) REFERENCES `chamado` (`chamado_cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
