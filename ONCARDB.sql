-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 12-Ago-2020 às 18:32
-- Versão do servidor: 5.7.28
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `oncar`
--
CREATE DATABASE IF NOT EXISTS `oncar` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `oncar`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_veiculos`
--

DROP TABLE IF EXISTS `tb_veiculos`;
CREATE TABLE IF NOT EXISTS `tb_veiculos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `veiculo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `marca` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ano` smallint(5) UNSIGNED NOT NULL,
  `descricao` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `vendido` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `vw_veiculos`
-- (Veja abaixo para a view atual)
--
DROP VIEW IF EXISTS `vw_veiculos`;
CREATE TABLE IF NOT EXISTS `vw_veiculos` (
`id_veiculo` bigint(20) unsigned
,`veiculo` varchar(255)
,`marca_veiculo` varchar(255)
,`ano_veiculo` smallint(5) unsigned
,`descricao_veiculo` longtext
,`vendido_veiculo` tinyint(1) unsigned
,`veiculo_created` datetime
,`veiculo_updated` datetime
);

-- --------------------------------------------------------

--
-- Estrutura para vista `vw_veiculos`
--
DROP TABLE IF EXISTS `vw_veiculos`;

CREATE VIEW `vw_veiculos`  AS  select `v`.`id` AS `id_veiculo`,`v`.`veiculo` AS `veiculo`,`v`.`marca` AS `marca_veiculo`,`v`.`ano` AS `ano_veiculo`,`v`.`descricao` AS `descricao_veiculo`,`v`.`vendido` AS `vendido_veiculo`,`v`.`created` AS `veiculo_created`,`v`.`updated` AS `veiculo_updated` from `tb_veiculos` `v` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
