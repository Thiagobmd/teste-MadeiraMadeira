-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 04-Fev-2019 às 02:55
-- Versão do servidor: 5.7.23
-- versão do PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teste-madeira`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_agenda`
--

DROP TABLE IF EXISTS `tbl_agenda`;
CREATE TABLE IF NOT EXISTS `tbl_agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `number` varchar(200) NOT NULL,
  `date_insert` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_agenda`
--

INSERT INTO `tbl_agenda` (`id`, `first_name`, `last_name`, `number`, `date_insert`) VALUES
(58, 'Thiago', 'Gomez', '5511946275', '2017-02-04'),
(60, 'Marcelo', 'Pereira', '4155447799', '2017-02-06'),
(61, 'Maria', 'Fonseca', '3144556677', '2017-02-11'),
(62, 'Julio', 'Mendes', '4468557788', '2017-03-05'),
(63, 'Pedro', 'Silva', '8255478847', '2018-01-04'),
(64, 'Ruan', 'Santos', '1126558877', '2018-01-07'),
(65, 'Sophia', 'Ribeiro', '4266887755', '2019-02-04'),
(66, 'Leandro', 'Garcia', '1362554877', '2019-02-05'),
(67, 'Tatiana', 'GonÃ§alves', '4125447899', '2019-02-08'),
(68, 'Gabriel', 'Carvalho', '7266558877', '2019-02-22'),
(69, 'Mayara', 'Navarro', '5623950012', '2019-02-04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
