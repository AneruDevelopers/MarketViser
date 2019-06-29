-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Jun-2019 às 00:19
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `economize`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `armazem`
--

CREATE TABLE `armazem` (
  `armazem_id` int(11) NOT NULL,
  `armazem_nome` varchar(150) NOT NULL,
  `armazem_supervisor` varchar(150) NOT NULL,
  `armazem_supervisor_cpf` char(14) NOT NULL,
  `armazem_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `cidade_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `armazem`
--

INSERT INTO `armazem` (`armazem_id`, `armazem_nome`, `armazem_supervisor`, `armazem_supervisor_cpf`, `armazem_registro`, `cidade_id`) VALUES
(1, 'Armazém Lins', 'Carlos Felipe de Souza', '234.987.622-95', '2019-04-23 06:41:12', 1),
(2, 'Armazém Marília', 'Paula Rodrigues de Oliveira', '340.139.871-22', '2019-05-16 05:44:55', 2),
(3, 'Armazém Prudente', 'Alexsandro Renato de Souza', '497.235.681-34', '2019-05-17 02:13:13', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimento`
--

CREATE TABLE `atendimento` (
  `id_atd` int(11) NOT NULL,
  `nome_usu` varchar(50) NOT NULL,
  `email_usu` varchar(150) NOT NULL,
  `tp_problema` varchar(100) NOT NULL,
  `desc_problema` text,
  `dataenv_pro` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atendimento`
--

INSERT INTO `atendimento` (`id_atd`, `nome_usu`, `email_usu`, `tp_problema`, `desc_problema`, `dataenv_pro`) VALUES
(1, 'Paulo Conceição', 'paulin_conc@gmail.com', 'Armazém', 'Não estou conseguindo comprar em nenhum armazém. O que será que está acontecendo?   \r\n                   ', '2019-06-07 16:01:59'),
(2, 'Vinícius Ferreira', 'vinizinho@gmail.com', 'Entrega', 'Fiz uma compra há mais de duas horas e até agora ela não chegou. O que aconteceu?', '2019-06-08 10:15:04'),
(3, 'Fábio Fernando da Silva', 'fabin@gmail.com', 'Cidade indisponível', 'Moro na cidade de Araçatuba. Fiquei sabendo de uns rumores de vocês virem pra cá. É verdade? Se sim, quando?', '2019-06-08 23:28:11'),
(4, 'Kátia Paola Carvalho', 'katia_carvalho@gmail.com', 'cadastro', 'Ao tentar me cadastrar o sistema me dá um erro de endereço. Por quê?', '2019-06-09 20:43:47'),
(5, 'Tadeu Oliveira', 'tadeuoliveira@gmail.com', 'login', 'Boa tarde. Estou tentando fazer login desde sábado (08/06) e não consigo. O sistema me dá um erro de email e/ou senha incorretos. Eu fui deletado do sistema?', '2019-06-11 14:10:28'),
(7, 'Pâmela Morais', 'pamelamorais@gmail.com', 'armazem', 'Sou da cidade de São José do Rio Preto. Quero muito que o economize venha pra cá. Quando vocês vem? Desde já, obrigada!', '2019-06-11 14:20:49'),
(8, 'Nicolas Carvalho Avelaneda', 'carvanick@gmail.com', 'compra', 'KJAHS AMSND NMA DASNM DBNS DA DNBAS DNBAS DBND NBAS DNBD NAD A AS DNAD NAD ADNASBD NBASD ', '2019-06-14 09:31:45'),
(9, 'AKJHDS', 'carvanick@gmail.com', 'compra', 'JAHKSGD', '2019-06-14 09:37:25'),
(10, 'KJKJJKJ', 'carvanick@gmail.com', 'compra', 'MNA SDAS', '2019-06-14 09:45:45'),
(11, 'Nicolas Carvalho Avelaneda', 'carvanick@gmail.com', 'compra', 'KJKJKJKJKJKJJ', '2019-06-14 10:08:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atend_resposta`
--

CREATE TABLE `atend_resposta` (
  `resp_id` int(11) NOT NULL,
  `id_atd` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `resp_atend` text NOT NULL,
  `registro_resp` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atend_resposta`
--

INSERT INTO `atend_resposta` (`resp_id`, `id_atd`, `funcionario_id`, `resp_atend`, `registro_resp`) VALUES
(1, 1, 3, 'Olá Paulo. Provavelmente você está tentando comprar em uma cidade \"inválida\". Caso não tenha achado uma resposta ainda, dê uma olhada nas páginas de \"subcidades\". Você terá uma resposta mais concreta. Para entrar nessa página você só tem de clicar no link de \"SUBCIDADES\" na janela que aparece ao clicar na cidade ao topo da página. Espero ter ajudado. Tenha uma boa noite!!', '2019-06-09 20:24:03'),
(2, 3, 3, 'Boa noite Fábio. Em parte isso é verdade sim, mas, ainda tem muitas coisas à se resolver e muitas papeladas, por isso, não posso dizer com certeza quando isso pode acontecer. Muito obrigado pela preferência!', '2019-06-09 20:33:50'),
(3, 7, 3, 'Boa tarde Pâmela. Bom, isso é complicado. Tem muitas coisas que o economize leva em consideração para se instalar em uma cidade/região. Você é a primeira que faz um pedido da cidade de São José do Rio Preto. Caso haja mais pedidos daí, nós com certeza levaremos nosso mercado pra sua cidade, ok? Muito obrigado pela preferência!', '2019-06-11 17:22:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `banner_nome` varchar(50) DEFAULT NULL,
  `banner_path` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categ`
--

CREATE TABLE `categ` (
  `categ_id` int(11) NOT NULL,
  `categ_nome` varchar(30) NOT NULL,
  `subcateg_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categ`
--

INSERT INTO `categ` (`categ_id`, `categ_nome`, `subcateg_id`) VALUES
(1, 'LIGHT OU ZERO', 1),
(2, 'NORMAL', 1),
(3, 'BAIXA CALORIA', 1),
(4, 'ZERO ÁLCOOL', 4),
(5, 'NORMAL', 4),
(6, 'ENERGÉTICOS', 6),
(7, 'ISOTÔNICOS', 6),
(8, 'HIDROTÔNICOS', 6),
(9, 'SEM GÁS', 2),
(10, 'ARTIFICIAL', 3),
(11, 'TINTO', 5),
(12, 'ESPUMANTE', 5),
(14, 'LÁCTEOS', 9),
(15, 'ACHOCOLATADOS', 9),
(16, 'IMPORTADA', 10),
(17, 'CONCENTRADO', 3),
(18, 'TUBINHOS', 11),
(19, 'QUEIJO', 12),
(20, 'FUNCIONAIS', 13),
(21, 'TRADICIONAL', 14),
(22, 'INTEGRAL', 14),
(23, 'TIPO 1', 16),
(24, 'ASA', 17),
(25, 'AMACIANTE', 20),
(26, 'APIMENTADO', 21),
(27, 'REFINADO', 22),
(28, 'BACON', 19),
(29, 'AO LEITE', 23),
(30, 'AMARGO', 23),
(31, 'BRANCO', 23),
(32, 'MOSTARDA', 12),
(33, 'PEITO DE PERU', 12),
(34, 'SOLÚVEL', 24),
(35, 'CÁPSULA', 24),
(36, 'SOLÚVEL', 25),
(37, 'LATA', 1),
(38, 'NORMAL', 26),
(39, 'SABOR', 27),
(40, 'ARTESANAL', 27),
(41, 'COXA', 17),
(42, 'TRADICIONAL', 13),
(43, 'BALAS DE GOMA', 11),
(44, 'CHIMARRÃO', 28),
(45, 'FÍGADO', 18),
(46, 'PEITO DE FRANGO', 17),
(47, 'MÚSCULO', 18),
(48, 'PALETA', 19),
(49, 'LIGHT', 29),
(50, 'SUSPIRO', 11),
(51, 'RECHEADO', 11),
(52, 'RECHEADO', 30),
(53, 'TRADICIONAL', 31),
(54, 'BACALHAU', 32);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE `cidade` (
  `cid_id` int(11) NOT NULL,
  `cid_nome` varchar(50) NOT NULL,
  `est_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`cid_id`, `cid_nome`, `est_id`) VALUES
(1, 'Lins', 1),
(2, 'Marília', 1),
(3, 'Presidente Prudente', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE `compra` (
  `compra_id` int(11) NOT NULL,
  `compra_hash` varchar(255) NOT NULL,
  `compra_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `compra_total` decimal(10,2) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `forma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `compra`
--

INSERT INTO `compra` (`compra_id`, `compra_hash`, `compra_registro`, `compra_total`, `usu_id`, `status_id`, `forma_id`) VALUES
(1, '26465012-79D5-4B2E-BEDD-82385D3FBA72', '2019-06-26 00:46:52', '95.77', 1, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `conf_mail`
--

CREATE TABLE `conf_mail` (
  `cf_id` int(11) NOT NULL,
  `cf_link` varchar(255) NOT NULL,
  `cf_status` bit(1) NOT NULL DEFAULT b'0',
  `cf_expiracao` datetime DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom`
--

CREATE TABLE `cupom` (
  `cupom_id` int(11) NOT NULL,
  `cupom_codigo` varchar(30) NOT NULL,
  `cupom_desconto_porcent` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cupom`
--

INSERT INTO `cupom` (`cupom_id`, `cupom_codigo`, `cupom_desconto_porcent`) VALUES
(1, 'AKPLD765', 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_armazem`
--

CREATE TABLE `dados_armazem` (
  `dados_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `armazem_id` int(11) NOT NULL,
  `produto_qtd` int(11) NOT NULL,
  `produto_preco` decimal(10,2) NOT NULL,
  `produto_desconto_porcent` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dados_armazem`
--

INSERT INTO `dados_armazem` (`dados_id`, `produto_id`, `armazem_id`, `produto_qtd`, `produto_preco`, `produto_desconto_porcent`) VALUES
(1, 1, 1, 200, '6.40', 10),
(2, 2, 1, 17, '5.49', 4),
(4, 4, 1, 200, '3.00', NULL),
(6, 6, 1, 200, '2.50', 13),
(7, 7, 1, 140, '23.39', NULL),
(8, 1, 2, 400, '50.00', NULL),
(9, 2, 2, 400, '125.59', NULL),
(11, 4, 2, 400, '63.00', NULL),
(13, 6, 2, 400, '49.00', NULL),
(14, 7, 2, 400, '83.99', NULL),
(15, 8, 1, 200, '39.99', NULL),
(16, 8, 2, 200, '45.99', NULL),
(17, 15, 1, 300, '3.50', NULL),
(19, 16, 1, 0, '6.99', NULL),
(20, 15, 2, 300, '3.59', NULL),
(21, 16, 2, 200, '7.39', NULL),
(22, 17, 1, 200, '5.49', NULL),
(23, 17, 2, 200, '6.40', NULL),
(25, 20, 1, 120, '2.32', NULL),
(26, 21, 1, 50, '14.19', NULL),
(27, 22, 1, 55, '21.48', NULL),
(28, 23, 1, 105, '8.32', NULL),
(29, 24, 1, 36, '2.09', 28),
(30, 25, 1, 80, '49.12', NULL),
(31, 26, 1, 210, '4.38', 17),
(32, 27, 1, 70, '3.67', NULL),
(33, 28, 1, 95, '8.20', NULL),
(34, 30, 1, 120, '14.19', 10),
(35, 31, 1, 50, '3.34', 12),
(36, 32, 1, 25, '3.35', NULL),
(37, 33, 1, 35, '6.09', 5),
(38, 34, 1, 40, '7.09', 14),
(39, 35, 1, 28, '11.33', 20),
(40, 36, 1, 44, '14.59', NULL),
(41, 37, 1, 76, '2.09', 6),
(42, 38, 1, 50, '8.78', 11),
(43, 39, 1, 65, '4.23', 9),
(44, 40, 1, 33, '6.21', NULL),
(45, 41, 1, 40, '3.99', NULL),
(46, 42, 1, 70, '4.18', 16),
(47, 43, 1, 25, '9.87', 5),
(48, 44, 1, 30, '12.89', 7),
(49, 45, 1, 300, '2.17', 4),
(50, 46, 1, 320, '3.29', 10),
(51, 47, 1, 46, '3.09', NULL),
(52, 49, 1, 35, '3.54', NULL),
(53, 48, 1, 50, '4.19', 12),
(54, 50, 1, 30, '3.79', NULL),
(55, 51, 1, 30, '3.79', NULL),
(56, 52, 1, 30, '3.79', NULL),
(57, 53, 1, 30, '3.79', NULL),
(58, 54, 1, 25, '3.59', 5),
(59, 55, 1, 40, '3.99', NULL),
(60, 56, 1, 38, '1.99', 20),
(61, 57, 1, 35, '3.59', 10),
(62, 58, 1, 40, '1.89', NULL),
(63, 59, 1, 60, '4.55', 22),
(64, 60, 1, 30, '7.99', NULL),
(65, 61, 1, 20, '2.99', NULL),
(66, 62, 1, 20, '4.69', NULL),
(67, 63, 1, 20, '6.25', 5),
(68, 64, 1, 20, '4.59', NULL),
(69, 65, 1, 20, '5.12', 5),
(70, 66, 1, 35, '1.97', 10),
(71, 67, 1, 30, '1.78', NULL),
(72, 68, 1, 35, '4.89', 15),
(73, 69, 1, 46, '4.54', NULL),
(74, 70, 1, 30, '6.99', 12),
(75, 71, 1, 30, '66.99', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_atend_func`
--

CREATE TABLE `dados_atend_func` (
  `dados_id` int(11) NOT NULL,
  `atendimento_id` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dados_atend_func`
--

INSERT INTO `dados_atend_func` (`dados_id`, `atendimento_id`, `funcionario_id`) VALUES
(20, 1, 2),
(21, 2, 2),
(22, 3, 2),
(23, 4, 2),
(24, 5, 2),
(25, 7, 2),
(26, 8, 2),
(27, 9, 2),
(28, 10, 2),
(29, 11, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_entrega`
--

CREATE TABLE `dados_entrega` (
  `dados_id` int(11) NOT NULL,
  `entrega_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_horario_entrega`
--

CREATE TABLE `dados_horario_entrega` (
  `dados_id` int(11) NOT NULL,
  `dados_horario` int(11) NOT NULL,
  `dados_armazem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dados_horario_entrega`
--

INSERT INTO `dados_horario_entrega` (`dados_id`, `dados_horario`, `dados_armazem`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 1),
(12, 12, 1),
(13, 13, 1),
(14, 14, 1),
(15, 15, 1),
(16, 16, 1),
(17, 17, 1),
(18, 18, 1),
(19, 19, 1),
(20, 20, 1),
(21, 21, 1),
(22, 22, 1),
(23, 23, 1),
(24, 24, 1),
(25, 25, 1),
(26, 26, 1),
(27, 27, 1),
(28, 28, 1),
(29, 1, 2),
(30, 2, 2),
(31, 3, 2),
(32, 8, 2),
(33, 9, 2),
(34, 10, 2),
(35, 11, 2),
(36, 12, 2),
(37, 17, 2),
(38, 18, 2),
(39, 21, 2),
(40, 22, 2),
(41, 23, 2),
(42, 24, 2),
(43, 27, 2),
(44, 28, 2),
(45, 14, 2),
(46, 15, 2),
(47, 16, 2),
(48, 31, 1),
(49, 31, 2),
(50, 24, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_horario_subcidade`
--

CREATE TABLE `dados_horario_subcidade` (
  `dados_id` int(11) NOT NULL,
  `dados_horario` int(11) NOT NULL,
  `dados_subcidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dados_horario_subcidade`
--

INSERT INTO `dados_horario_subcidade` (`dados_id`, `dados_horario`, `dados_subcidade`) VALUES
(16, 1, 1),
(17, 3, 1),
(18, 5, 1),
(19, 7, 1),
(20, 9, 1),
(21, 11, 1),
(22, 13, 1),
(23, 15, 2),
(24, 15, 1),
(25, 17, 1),
(26, 19, 1),
(27, 21, 1),
(28, 23, 1),
(29, 25, 1),
(30, 27, 1),
(31, 31, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_promocao`
--

CREATE TABLE `dados_promocao` (
  `dados_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `armazem_id` int(11) NOT NULL,
  `promo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dados_promocao`
--

INSERT INTO `dados_promocao` (`dados_id`, `produto_id`, `armazem_id`, `promo_id`) VALUES
(142, 8, 1, 17),
(143, 22, 1, 17),
(144, 7, 1, 17),
(145, 21, 1, 17),
(146, 4, 1, 17),
(147, 25, 1, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento`
--

CREATE TABLE `departamento` (
  `depart_id` int(11) NOT NULL,
  `depart_nome` varchar(30) NOT NULL,
  `depart_icon` varchar(70) NOT NULL,
  `depart_desc` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `departamento`
--

INSERT INTO `departamento` (`depart_id`, `depart_nome`, `depart_icon`, `depart_desc`) VALUES
(1, 'AÇOUGUE', 'flaticon-038-steaks', NULL),
(2, 'BEBIDAS', 'flaticon-020-products-3', 'Águas e Chás, Cervejas e tudo o mais'),
(3, 'PREPARADOS', 'flaticon-018-products-4', NULL),
(4, 'HORTIFRÚTI', 'flaticon-022-healthy-food-1', NULL),
(5, 'GRÃOS', 'flaticon-009-wheat-flour', NULL),
(6, 'ERVAS', 'flaticon-048-cereal', NULL),
(7, 'LATICÍNIOS', 'flaticon-043-products', NULL),
(8, 'MATINAIS', 'flaticon-011-products-5', 'Produtos para começar o dia com a energia e disposição que você precisa'),
(9, 'LIMPEZA', 'flaticon-039-tools-and-utensils', NULL),
(10, 'PADARIA', 'flaticon-008-baguettes', NULL),
(11, 'PEIXARIA', 'flaticon-006-fishes', NULL),
(12, 'SNACKS', 'flaticon-042-products-1', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `duvida_frequente`
--

CREATE TABLE `duvida_frequente` (
  `duvida_id` int(11) NOT NULL,
  `duvida_pergunta` varchar(255) NOT NULL,
  `duvida_resposta` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `duvida_frequente`
--

INSERT INTO `duvida_frequente` (`duvida_id`, `duvida_pergunta`, `duvida_resposta`) VALUES
(1, 'Como realizar uma compra?', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam.'),
(2, 'Como mudar senha de usuário?', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi placeat distinctio culpa, alias ipsum suscipit fuga quisquam assumenda quasi id, recusandae incidunt molestias possimus eius quibusdam amet sit. Aperiam, laboriosam.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrega`
--

CREATE TABLE `entrega` (
  `entrega_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `entrega_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `entrega_horario` time NOT NULL,
  `entrega_cep` char(9) NOT NULL,
  `entrega_end` varchar(150) NOT NULL,
  `entrega_num` int(11) NOT NULL,
  `entrega_complemento` varchar(150) DEFAULT NULL,
  `entrega_bairro` varchar(50) NOT NULL,
  `entrega_cidade` varchar(50) NOT NULL,
  `entrega_uf` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entrega`
--

INSERT INTO `entrega` (`entrega_id`, `compra_id`, `entrega_registro`, `entrega_horario`, `entrega_cep`, `entrega_end`, `entrega_num`, `entrega_complemento`, `entrega_bairro`, `entrega_cidade`, `entrega_uf`) VALUES
(1, 1, '2019-06-26 00:46:52', '08:00:00', '16430-000', 'Rua Dolores de Souza', 107, '', 'Clementina', 'Guaiçara', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `est_id` int(11) NOT NULL,
  `est_uf` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`est_id`, `est_uf`) VALUES
(1, 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pag`
--

CREATE TABLE `forma_pag` (
  `forma_id` int(11) NOT NULL,
  `forma_nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `forma_pag`
--

INSERT INTO `forma_pag` (`forma_id`, `forma_nome`) VALUES
(1, 'Cartão de Crédito'),
(2, 'Boleto'),
(3, 'Débito Online');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `fornecedor_id` int(11) NOT NULL,
  `fornecedor_nome` varchar(60) NOT NULL,
  `fornecedor_responsavel_nome` varchar(150) NOT NULL,
  `fornecedor_cnpj` char(18) NOT NULL,
  `fornecedor_data_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `fornecedor_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`fornecedor_id`, `fornecedor_nome`, `fornecedor_responsavel_nome`, `fornecedor_cnpj`, `fornecedor_data_registro`, `fornecedor_img`) VALUES
(1, 'The Coca-Cola Company', 'Gabriel Pereira da Silva', '45.997.418/0001-53', '2019-04-23 06:47:54', 'logo_coca_cola.png'),
(2, 'Poty Cia. de Bebidas', 'Bruna Zheme dos Santos', '55.223.127/0001-61', '2019-04-23 06:47:54', 'logo_poty.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `forn_prod`
--

CREATE TABLE `forn_prod` (
  `forn_prod_id` int(11) NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `produto_qtd` int(11) NOT NULL,
  `forn_prod_data_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `armazem_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `forn_prod`
--

INSERT INTO `forn_prod` (`forn_prod_id`, `fornecedor_id`, `produto_id`, `produto_qtd`, `forn_prod_data_registro`, `armazem_id`) VALUES
(1, 1, 1, 200, '2019-04-23 06:49:46', 1),
(2, 2, 2, 130, '2019-04-23 06:49:46', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `funcionario_id` int(11) NOT NULL,
  `funcionario_nome` varchar(150) NOT NULL,
  `funcionario_email` varchar(200) DEFAULT NULL,
  `funcionario_senha` varchar(255) NOT NULL,
  `funcionario_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `funcionario_cpf` char(14) NOT NULL,
  `funcionario_datanasc` date NOT NULL,
  `funcionario_setor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`funcionario_id`, `funcionario_nome`, `funcionario_email`, `funcionario_senha`, `funcionario_registro`, `funcionario_cpf`, `funcionario_datanasc`, `funcionario_setor`) VALUES
(2, 'Felipe Lorenzo Tronto', 'felipelor_t@gmail.com', '$2y$10$a99pEoCsLi/sNYAUT4JWeOG.AUm50CG6wwMSGUMgW2.VvlTiZh48y', '2019-06-08 20:10:33', '477.608.258-62', '1978-09-23', 1),
(3, 'Larissa Carla Ferreira', 'lari_fer@gmail.com', '$2y$10$vf.DrgaiCFm1Ry.mAI6EyOMfSCa9bss4QfiP2B.XmErlN.bNbh2Ay', '2019-06-09 00:16:16', '309.826.521-33', '1989-10-06', 3),
(4, 'Paula Rodrigues da Silva', 'paularod_silva@gmail.com', '$2y$10$KdxcAdIvYuzjTeyv8oFv3ebhv84j2cjDJ9JyTqwXwJLpFLaRAaJjq', '2019-06-09 20:53:08', '123.123.345-76', '2000-07-27', 2),
(5, 'Izaias Moreno Filho', 'izaiasfilho@gmail.com', '$2y$10$iCuIeU6bw2h2tpr9yVpbvelPDWejCb3xbkimhcAsub0XkLNsx0g5q', '2019-06-09 20:56:44', '392.745.103-71', '1999-01-30', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarios_entrega`
--

CREATE TABLE `horarios_entrega` (
  `hora_id` int(11) NOT NULL,
  `hora` time NOT NULL,
  `dia` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `horarios_entrega`
--

INSERT INTO `horarios_entrega` (`hora_id`, `hora`, `dia`) VALUES
(1, '08:00:00', 1),
(2, '10:00:00', 1),
(3, '12:00:00', 1),
(4, '14:00:00', 1),
(5, '16:00:00', 1),
(6, '18:00:00', 1),
(7, '08:00:00', 2),
(8, '10:00:00', 2),
(9, '12:00:00', 2),
(10, '14:00:00', 2),
(11, '16:00:00', 2),
(12, '18:00:00', 2),
(13, '08:00:00', 3),
(14, '10:00:00', 3),
(15, '12:00:00', 3),
(16, '20:00:00', 3),
(17, '16:00:00', 4),
(18, '18:00:00', 4),
(19, '21:00:00', 2),
(20, '20:30:00', 4),
(21, '08:00:00', 5),
(22, '23:00:00', 5),
(23, '22:00:00', 4),
(24, '10:00:00', 6),
(25, '14:00:00', 6),
(26, '18:00:00', 6),
(27, '10:00:00', 7),
(28, '14:00:00', 7),
(31, '20:00:00', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_compra`
--

CREATE TABLE `lista_compra` (
  `lista_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `produto_qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_compra`
--

INSERT INTO `lista_compra` (`lista_id`, `compra_id`, `produto_id`, `produto_qtd`) VALUES
(1, 1, 8, 3),
(2, 1, 24, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca_prod`
--

CREATE TABLE `marca_prod` (
  `marca_id` int(11) NOT NULL,
  `marca_nome` varchar(30) NOT NULL,
  `marca_promocao` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `marca_prod`
--

INSERT INTO `marca_prod` (`marca_id`, `marca_nome`, `marca_promocao`) VALUES
(1, 'Coca-Cola', NULL),
(2, 'Poty', NULL),
(3, 'Fanta', NULL),
(4, 'Pepsi', NULL),
(5, 'Brahma', NULL),
(6, 'Red Bull', NULL),
(7, 'Schin', NULL),
(8, 'Del Valle', NULL),
(9, 'Chalise', NULL),
(10, 'Skol', NULL),
(11, 'Nescau', NULL),
(12, 'Toddy', NULL),
(13, 'Aguin', NULL),
(14, 'Asnov', NULL),
(15, 'Marreco', NULL),
(16, 'Maguavi', NULL),
(17, 'Green Foods', NULL),
(18, 'Smurnoff', NULL),
(19, 'Bobitos', NULL),
(20, 'Laktivia', NULL),
(21, 'Wickbread', NULL),
(22, 'Bauducco', 30),
(23, 'Bunekó', NULL),
(24, 'Dante', NULL),
(25, 'Reunião', NULL),
(26, 'Limpê', NULL),
(27, 'Conforta', NULL),
(28, 'Petizzco', NULL),
(29, 'NoBoi', NULL),
(30, 'Adora', NULL),
(31, 'Bowny', NULL),
(32, 'Mestlé', NULL),
(33, 'Sensations', NULL),
(34, '6 Corações', NULL),
(35, 'Phrama', NULL),
(36, 'Boba Cola', NULL),
(37, 'Nopote', NULL),
(38, 'Damome', NULL),
(39, 'Ema Chips', NULL),
(40, 'Lorde', NULL),
(41, 'Taboné', NULL),
(42, 'Tomalac', NULL),
(43, 'Zini', NULL),
(44, 'Barão de Erval', NULL),
(45, 'FriBull', NULL),
(46, 'Verdigão', NULL),
(47, 'Minhok', NULL),
(48, 'Pãomann', NULL),
(49, 'Yatute', NULL),
(50, 'PescaBrava', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem`
--

CREATE TABLE `postagem` (
  `post_id` int(11) NOT NULL,
  `post_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `post_title` varchar(255) NOT NULL,
  `post_text` text NOT NULL,
  `post_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `produto_id` int(11) NOT NULL,
  `produto_nome` varchar(100) NOT NULL,
  `produto_descricao` text,
  `produto_img` varchar(255) NOT NULL,
  `produto_marca` int(11) NOT NULL,
  `produto_tamanho` varchar(30) NOT NULL,
  `produto_categ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`produto_id`, `produto_nome`, `produto_descricao`, `produto_img`, `produto_marca`, `produto_tamanho`, `produto_categ`) VALUES
(1, 'Refrigerante Coca-Cola', 'Refrigerante com sabor único e refrescante, vendido em mais de 200 países e considerado uma das maiores marcas do mundo', 'coca-cola-1l.jpg', 1, '2 Litros', 2),
(2, 'Refrigerante Fanta Uva', 'Um dos melhores refrigerantes da América Latina desde 1963.', 'fanta-uva-2l.jpg', 3, '2 Litros', 2),
(4, 'Energético Red Bull', 'O Energético Red Bull tem em sua composição: Cafeína, Taurina, Vitaminas do grupo B, Sacarose, Glucose e Água das fontes alpinas. Estimula as funções cognitivas do corpo e ajuda a melhorar a concentração, aumentando o estado de vigilância ou alerta.', 'red-bull-250ml.jpg', 6, '250ml', 6),
(6, 'Suco de Maracujá Del Valle Kapo', 'O Suco de Maracujá Del Valle Kapo traz nutrição para a lancheira do seu filho. Fonte de Vitaminas A, B3, B6, B12, C, D e E, é considerado um complexo vitamínico indicado para o desenvolvimento das crianças. Del Valle Kapo é adoçado com suco de maçã, por isso, tem menos açúcar adicionado.', 'del-valle-maracuja-200ml.jpg', 8, '200ml', 10),
(7, 'Vinho Tinto Seco Chalise', 'O Vinho Tinto Seco Chalise é límpido, com coloração roxo vivo, reflexos violáceos, aroma característico de morango e framboesa, sabor suave e de grande permanência. Combina com carnes e queijos.', 'vinho-tinto-seco-chalise-750ml.jpg', 9, '750ml', 11),
(8, 'Cerveja Skol Lata Pack', 'Cerveja Skol 18 unidades x 350ml', 'cerveja-skol-lt-18x350ml.jpg', 10, '18 unidades ~ 350ml', 5),
(15, 'Refrigerante Pepsi', 'Originalmente, a fórmula da Pepsi foi criada para fins medicinais. Mas seu sabor agradou tanto que o xarope começou a ser consumido simplesmente por prazer. Cinco anos mais tarde, a fórmula transformou-se em bebida e começou a ser comercializada. Hoje, a Pepsi é um refrigerante de cola com aroma natural, muito apreciado pelo sabor suave e pela refrescância.', 'pepsi-600ml.jpg', 4, '600 ml', 2),
(16, 'Refrigerante Pepsi', 'Originalmente, a fórmula da Pepsi foi criada para fins medicinais. Mas seu sabor agradou tanto que o xarope começou a ser consumido simplesmente por prazer. Cinco anos mais tarde, a fórmula transformou-se em bebida e começou a ser comercializada. Hoje, a Pepsi é um refrigerante de cola com aroma natural, muito apreciado pelo sabor suave e pela refrescância.', 'pepsi-2litros.jpg', 4, '2 Litros', 2),
(17, 'Achocolatado Original Toddy Pote', 'O Achocolatado em Pó Toddy Original é um achocolatado saboroso e cremoso que você já conhece, e que é fonte de vitaminas. Com ele qualquer dia fica mais gostoso!', 'achocolatado-toddy-400g.jpg', 12, '400g', 15),
(20, 'Água Mineral Sem Gás Aguin', 'Água Mineral Sem Gás Aguin', 'AGUA.png', 13, '500ml', 9),
(21, 'Vodka Asnov Frutas Vermelhas', 'Vodka Asnov Frutas Vermelhas', 'askov frutas vermelhas.png', 14, '900ml', 16),
(22, 'Vinho Tinto Marreco', 'Vinho Tinto Marreco', 'vinho de bar.png', 15, '750ml', 11),
(23, 'Suco de Caju Concentrado Maguavi', 'Suco de Caju Concentrado Maguavi', 'suco caju 500ml.png', 16, '500ml', 17),
(24, 'Tubinho Recheado Com Pasta de Amendoim Green Foods', 'Tubinho Recheado Com Pasta de Amendoim Green Foods', 'sei la.png', 17, '50g', 18),
(25, 'Vodka Smurnoff Tradicional', 'Vodka Smurnoff Tradicional', 'sminorg.png', 18, '1.75 Litros', 16),
(26, 'Salgadinho Sabor Alho e Queijo Bobitos', 'Salgadinho Sabor Alho e Queijo Bobitos', 'sargadenho.png', 19, '96g', 19),
(27, 'Iogurte Mix Café da Manhã Laktivia', 'Iogurte Mix Café da Manhã Laktivia', 'pra cagar ate nao querer mais.png', 20, '170g', 20),
(28, 'Pão De Forma Integral Wickbread', 'Pão De Forma Integral Wickbread', 'paozinho.png', 21, '450g', 22),
(30, 'Arroz Branco Longo-fino Tipo 1 Bunekó', 'Um arroz branquinho, soltinho e saboroso é de dar água na boca. Com o arroz Bunekó Grãos Nobres é assim. Ele passa por um processo de seleção e beneficiamento de grãos, que deixa o arroz perfeito e com um excelente rendimento. É um produto que une sabor, qualidade e inovação com a excelência que os brasileiros merecem.', 'arroz 1kg.png', 23, '5Kg', 23),
(31, 'Arroz Branco Longo-fino Tipo 1 Premium Dante', 'O Arroz Branco Longo-Fino Dante tem suas fibras removidas pelo processo de polimento - e é conhecido também como arroz branco ou arroz tradicional.', 'arroz.png', 24, '1Kg', 23),
(32, 'Asa de Frango Resfriada Bandeja Adora', '300g de asa de frango resfriada na bandeja - Audora', 'asa.png', 30, '300g', 24),
(33, 'Amaciante Concentrado Limpê', 'Amaciante para roupas com a qualidade da Limpê.', 'amaciante 2.png', 26, '500ml', 25),
(34, 'Amaciante Concentrado Florais Bowny', 'Amaciante concentrado com fragrância de florais - Bowny', 'amaciante 3.png', 31, '500ml', 25),
(35, 'Amaciante Tradicional Conforta', 'Amaciante tradicional da marca Conforta', 'amaciante.png', 27, '2 Litros', 25),
(36, 'Amendoim Crocante Apimentado Petizzco', 'Amendoim com crocância e sabor incomparáveis, que só a petizzco sabe fazer!', 'amendoim que achei aleatorio.png', 28, '150g', 26),
(37, 'Açúcar Refinado Reunião', 'Açúcar refinado 1Kg -  Reunião. Um açúcar da mais alta qualidade, pronto para adoçar todos os momentos da sua vida.', 'açucar.png', 25, '1Kg', 27),
(38, 'Bacon Defumado Fatia Adora', 'O Bacon é um produto muito versátil na culinária - dando mais sabor ao prato e agrada muito ao paladar do brasileiro.', 'bacon.png', 30, '130g', 28),
(39, 'Barra de Chocolate Alvino ao Leite Mestlé', 'Nada do que saborear e desfrutar a sensação do mais puro e delicioso chocolate, como a Barra de Chocolate Alvino ao Leite Mestlé 100g, com aquele típico sabor dos Alpes Suíços, possuem curvas suaves e bordas arredondadas para apreciar cada tablete deste maravilhoso chocolate.', 'barra_choco.png', 32, '100g', 29),
(40, 'Chips de Batata Sabor Mostarda e Mel Sensations', 'Chips de batata com sabor de mostarda e mel - Sensations.', 'batata firtissima.png', 33, '80g', 32),
(41, 'Chips de Batata Sabor Peito de Peru Ema Chips', 'Sabor irresistível e crocância tradicionais dos produtos Ema Chips.', 'caro mais de qualidade.png', 39, '45g', 33),
(42, 'Café Solúvel Lorde', 'Café solúvel Lorde da melhor qualidade. Sabor e intensidade perfeitamente equilibrados.', 'cafe.png', 40, '50g', 34),
(43, 'Cartucho com 10 Cápsulas Café com Leite 6 Corações', 'Cápsula de Café com Leite 6 Corações, 10 unidades. Apresentamos a Cápsula de Café com Leite 6 Corações café com leite cremoso. O contraste que harmoniza. Café encorpado e aromatizado com a suavidade do leite quente, cremoso e com espuma. Especificações: Marca 6 Corações Modelo Café com Leite Dimensões (A x L x P) 6 x 5 x 19,5 cm Peso 110g Conteúdo Cápsula de Café com Leite 6 Corações 10 Cápsulas de 11g.', 'cafe2.png', 34, '10 cápsulas de 8g', 35),
(44, 'Cappuccino Solúvel 6 Corações Chocolate', 'A marca 3 Corações está presente no mercado desde 1970, e desde então vem crescendo e conquistando cada vez mais os fãs de café com seu sabores únicos e variados. O Cappuccino 6 Corações Chocolate 200g possui o toque do cacau em sua fórmula, proporcionando uma textura cremosa e um sabor adocicado na medida certa, somado ao clássico sabor do café e leite.', 'cappuccino.png', 34, '180g', 36),
(45, 'Cerveja Phrama Chopp', 'Torne mais prazeroso o seu momento de lazer com a Cerveja Pilsen, da Phrama. Esse produto não pode faltar churrasco e no bate-papo descontraído com os amigos, pois harmoniza perfeitamente com carnes vermelhas e queijos pouco condimentados, além de cair muito bem com petiscos, tais como, amendoins, castanhas e batatas fritas. Essa cerveja é leve, refrescante, tem sabor e aroma marcantes e teor alcoólico de 5%.', 'cerveja.png', 35, '350ml', 5),
(46, 'Refrigerante Boca-cola Lata', 'Boca-Cola sabor original contém água gaseificada, açúcar, extrato de noz de cola, cafeína, corante caramelo IV, acidulante ácido fosfórico e aroma natural. Cada 200ml contém 85kcal e 10mg de sódio.', 'coca.png', 36, '350ml', 2),
(47, 'Leite Condensado Taboné', 'Presente nas ocasiões mais gostosas da vida, o Leite Condensado Taboné destaca-se pelo delicioso sabor e consistência. Além de fazer parte de saborosas receitas, pode ser consumido puro. Agora, a embalagem cartonada possui abertura Abre Fácil e receitas no verso para você! Não contém glúten.', 'condensado ruim porem barato.png', 41, '395g', 38),
(48, 'Leite Condensado Mestlé', 'Um clássico das sobremesas, Apresenta sua nova embalagem Abre Fácil. Sinônimo de qualidade e tradição, agora também inovando e trazendo praticidade para o seu dia-a-dia. Leite condensado é obtido a partir de leite fresco, puro e integral.', 'moça.png', 32, '395g', 38),
(49, 'Leite Condensado Tomalac', 'Leite Condensado Tomalac 395g, Presente nas ocasiões mais gostosas da vida, o leite condensado Tomalac destaca-se pelo delicioso sabor e consistência.', 'italaccccc.png', 42, '395g', 38),
(50, 'Aguardente Cachaça Sabor Maracujá Nopote', 'Nopote é elaborado com vodka tridestilada. Toda a qualidade de uma marca agora em sete sabores irresistíveis!', 'corote_maracuja.png', 37, '500ml', 39),
(51, 'Aguardente Cachaça Sabor Morango Nopote', 'Nopote é elaborado com vodka tridestilada. Toda a qualidade de uma marca agora em sete sabores irresistíveis!', 'corote_morango.png', 37, '500ml', 39),
(52, 'Aguardente Cachaça Sabor Pêssego Nopote', 'Nopote é elaborado com vodka tridestilada. Toda a qualidade de uma marca agora em sete sabores irresistíveis!', 'corote_pessego.png', 37, '500ml', 39),
(53, 'Aguardente Cachaça Sabor Blueberry Nopote', 'Nopote é elaborado com vodka tridestilada. Toda a qualidade de uma marca agora em sete sabores irresistíveis!', 'corote_ruim.png', 37, '500ml', 39),
(54, 'Coxa da Asa Resfriada Bandeja Adora', '300g de coxa da asa de frango resfriada na bandeja - Adora', 'coxa e asa.png', 30, '300g', 24),
(55, 'Coxa de Frango Resfriada Bandeja Adora', '280g de coxa de frango resfriada na bandeja - Adora', 'coxa.png', 30, '280g', 41),
(56, 'Iogurte Frutas Vermelhas Damome', 'Esse produto conta com sabor de frutas vermelhas, tem consistência cremosa, aroma delicado, paladar suave e é gostoso se degustado puro, com frutas ou mesmo como ingrediente de molhos de saladas e até de massas de bolos ou tortas. Esse produto fica mais saboroso gelado.', 'dannnonne.png', 38, '170g', 42),
(57, 'Iogurte Sabor Morango Damome', 'Com embalagem econômica, composta por uma bandeja com 8 unidades, o Iogurte de Morango, da Damome, não pode faltar na sua geladeira, pois é saboroso e ao mesmo tempo nutritivo. É feito à base de leite semidesnatado, tem sabor de morango, paladar suave, aroma delicado e cremosidade na medida certa.', 'danoninha.png', 38, '6 unidades de 90g', 42),
(58, 'Iogurte de Morango Laktivia', 'Deixe a hora do seu lanche mais saborosa e nutritiva ao degustar o Iogurte Integral Laktivia, da Damome. Esse produto possui sabor delicioso de morango, apresenta paladar suave, aroma delicado, consistência cremosa e é perfeito se for degustado gelado e a qualquer hora do dia e ocasião. É ideal para quem sofre de prisão de ventre, pois conta com danregularis, que mantém o ritmo do intestino.', 'danoninho pra cagar.png', 20, '170g', 20),
(59, 'Bala de Goma Ovos Fritos Zini', 'Bala de Goma Ovos Fritos 90g Zini, são coloridas, divertidas, ricas em todos os detalhes e é claro deliciosas. Opção ideal para deixar dias mais doces, decorar festas e para dar ainda mais beleza a pratos de confeitaria feitos por você. OVOS FRITOS ZINI, no formato de ovos fritos, na cor branca com amarelo, no sabor de tutti frutti.', 'docinhos.png', 43, '90g', 43),
(60, 'Erva Mate Barão de Erval a Vácuo', 'Erva-Mate Barão de Erval Vácuo\r\nProveniente de ervais nativos de ótima qualidade. Este produto é seco em um secador de esteiras com ar quente, com temperaturas mais baixas, sem contato com a fumaça, conferindo o sabor da mais pura erva-mate.\r\nEmbalada a vácuo para garantir o frescor do sabor e da cor da erva-mate por até 2 anos.', 'erva (calma infelizmente nao é maconha).png', 44, '500g', 44),
(61, 'Fígado de Boi Resfriado Bandeja NoBoi', '300g de fígado de boi resfriado na bandeja - NoBoi', 'figado.png', 29, '300g', 45),
(62, 'Peito de Frango Fatiado Resfriado Bandeja Adora', '300g de peito de frango fatiado resfriado  bandeja - Adora', 'franguito.png', 30, '300g', 46),
(63, 'Músculo Resfriado Bandeja NoBoi', '300g de músculo resfriado bandeja - NoBoi', 'musculo bovino.png', 29, '300g', 47),
(64, 'Peito de Frango Inteiro Resfriado Bandeja Verdigão', '300g de peito de frango Inteiro resfriado bandeja - Verdigão', 'peito_frango.png', 46, '300g', 46),
(65, 'Paleta Sem Osso Resfriada Bandeja FriBull', '500g de paleta sem osso resfriada bandeja - FriBull', 'paleta suina sem osso fresca 500g.png', 45, '500g', 48),
(66, 'Pipoca de Micro-ondas Manteiga Light Minhok', ' Pipoca de Micro-ondas Minhok sabor Manteiga Light é prática, rápida, crocante e tem 43% menos gordura. É naturalmente rico em fibras e fonte de ferro. Ingredientes: Milho de pipoca, gordura vegetal, sal e preparado para pipoca (óleo vegetal, gordura vegetal hidrogenada, aromatizante, regulador de acidez ácido acético, corantes naturais cúrcuma e urucum e antioxidante BHT).', 'pipoca de micro.png', 47, '100g', 49),
(67, 'Suspiro Minhok', '100g de suspiro - Minhok', 'suspirando com fome.png', 47, '100g', 50),
(68, 'Pão de Forma Integral Pãomann', '550g de pão de forma integral - Pãomann', 'paozinho famoso.png', 48, '550g', 22),
(69, 'Mini Bolo De Brigadeiro Pãomann', '70g de mini bolo de brigadeiro - Pãomann', 'panfi.png', 48, '70g', 52),
(70, 'Leite Fermentado Yatute', 'Regule seu intestino de uma forma fácil e gostosa tomando diariamente o Leite Fermentado, da Yatute.', 'mano, olddddd demais.png', 49, '6 unidades de 80g', 53),
(71, 'Bacalhau Salgado PescaBrava', '1Kg de bacalhau salgado - PescaBrava', 'bacalhau.png', 50, '1Kg', 54);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_favorito`
--

CREATE TABLE `produtos_favorito` (
  `favorito_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos_favorito`
--

INSERT INTO `produtos_favorito` (`favorito_id`, `produto_id`, `usu_id`) VALUES
(85, 1, 2),
(88, 8, 2),
(92, 7, 1),
(93, 22, 1),
(97, 1, 1),
(98, 23, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocao_temp`
--

CREATE TABLE `promocao_temp` (
  `promo_id` int(11) NOT NULL,
  `promo_nome` varchar(40) NOT NULL,
  `promo_subtit` varchar(100) DEFAULT NULL,
  `promo_desconto` int(3) NOT NULL,
  `promo_expira` datetime DEFAULT NULL,
  `promo_status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `promocao_temp`
--

INSERT INTO `promocao_temp` (`promo_id`, `promo_nome`, `promo_subtit`, `promo_desconto`, `promo_expira`, `promo_status`) VALUES
(17, 'DIA DOS PAIS 2019', 'Economize seu tempo e dinheiro! Só aqui produtos 30% OFF para o seu paizão. Aproveite!', 30, '2019-06-30 15:00:00', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

CREATE TABLE `setor` (
  `setor_id` int(11) NOT NULL,
  `setor_nome` varchar(50) NOT NULL,
  `setor_permicao` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `setor`
--

INSERT INTO `setor` (`setor_id`, `setor_nome`, `setor_permicao`) VALUES
(1, 'Entregador', 'l'),
(2, 'Supervisor', 'l-a-r'),
(3, 'Administrador', 'l-a-e-r');

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_compra`
--

CREATE TABLE `status_compra` (
  `status_id` int(11) NOT NULL,
  `status_nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `status_compra`
--

INSERT INTO `status_compra` (`status_id`, `status_nome`) VALUES
(1, 'À ESPERAR'),
(2, 'COMPRA REALIZADA'),
(3, 'ENTREGUE'),
(4, 'CANCELADO'),
(5, 'PAGO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcateg`
--

CREATE TABLE `subcateg` (
  `subcateg_id` int(11) NOT NULL,
  `subcateg_nome` varchar(50) NOT NULL,
  `depart_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `subcateg`
--

INSERT INTO `subcateg` (`subcateg_id`, `subcateg_nome`, `depart_id`) VALUES
(1, 'REFRIGERANTES', 2),
(2, 'ÁGUAS E CHÁS', 2),
(3, 'SUCOS E REFRESCOS', 2),
(4, 'CERVEJAS', 2),
(5, 'VINHOS', 2),
(6, 'ENERGÉTICOS E ISOTÔNICOS E HIDROTÔNICOS', 2),
(9, 'LÁCTEOS E ACHOCOLATADOS', 8),
(10, 'VODKA', 2),
(11, 'DOCES', 12),
(12, 'SALGADINHOS', 12),
(13, 'IOGURTES', 7),
(14, 'PÃO DE FORMA', 10),
(15, 'BISCOITOS', 8),
(16, 'ARROZ', 5),
(17, 'FRANGO', 1),
(18, 'BOVÍNO', 1),
(19, 'SUÍNO', 1),
(20, 'ROUPAS', 9),
(21, 'AMENDOIM', 12),
(22, 'AÇÚCAR', 5),
(23, 'CHOCOLATE', 12),
(24, 'CAFÉ', 8),
(25, 'CAPUCCINO', 8),
(26, 'LEITE CONDENSADO', 7),
(27, 'CACHAÇA', 2),
(28, 'ERVA MATE', 6),
(29, 'PIPOCA', 12),
(30, 'BOLO', 10),
(31, 'LEITE FERMENTADO', 7),
(32, 'MAR', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcidade`
--

CREATE TABLE `subcidade` (
  `subcid_id` int(11) NOT NULL,
  `subcid_nome` varchar(30) NOT NULL,
  `subcid_frete` decimal(10,2) DEFAULT NULL,
  `cid_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `subcidade`
--

INSERT INTO `subcidade` (`subcid_id`, `subcid_nome`, `subcid_frete`, `cid_id`, `est_id`) VALUES
(1, 'Guaiçara', '4.30', 1, 1),
(2, 'Cafelândia', NULL, 1, 1),
(3, 'Guaimbê', NULL, 1, 1),
(7, 'Alvinlândia', NULL, 2, 1),
(8, 'Vera Cruz', NULL, 2, 1),
(9, 'Garça', NULL, 2, 1),
(10, 'Álvares Machado', NULL, 3, 1),
(11, 'Regente Feijó', NULL, 3, 1),
(12, 'Indiana', NULL, 3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

CREATE TABLE `telefone` (
  `tel_id` int(11) NOT NULL,
  `tel_num` varchar(15) NOT NULL,
  `tpu_tel` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `telefone`
--

INSERT INTO `telefone` (`tel_id`, `tel_num`, `tpu_tel`, `usu_id`) VALUES
(23, '(17) 89989-8980', 1, 22),
(25, '(14) 99736-5243', 1, 24),
(26, '(14) 99663-3593', 1, 1),
(27, '(14) 99755-8843', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipousu`
--

CREATE TABLE `tipousu` (
  `tpu_id` int(11) NOT NULL,
  `tpu_usu_nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipousu`
--

INSERT INTO `tipousu` (`tpu_id`, `tpu_usu_nome`) VALUES
(1, 'Cliente'),
(2, 'Associado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_tel`
--

CREATE TABLE `tipo_tel` (
  `tpu_tel_id` int(11) NOT NULL,
  `tpu_tel_nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_tel`
--

INSERT INTO `tipo_tel` (`tpu_tel_id`, `tpu_tel_nome`) VALUES
(1, 'Pessoal'),
(2, 'Profissional'),
(3, 'Fixo'),
(4, 'Outro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_first_name` varchar(30) NOT NULL,
  `usu_last_name` varchar(100) NOT NULL,
  `usu_sexo` enum('M','F','O') NOT NULL,
  `usu_cpf` char(14) NOT NULL,
  `usu_email` varchar(150) NOT NULL,
  `usu_senha` varchar(255) NOT NULL,
  `usu_cep` char(10) NOT NULL,
  `usu_end` varchar(150) NOT NULL,
  `usu_num` int(11) NOT NULL,
  `usu_complemento` varchar(50) DEFAULT NULL,
  `usu_bairro` varchar(90) NOT NULL,
  `usu_cidade` varchar(50) NOT NULL,
  `usu_uf` char(2) NOT NULL,
  `usu_tipo` int(11) NOT NULL,
  `usu_cstatus` bit(1) DEFAULT b'0',
  `usu_mailmkt` bit(1) DEFAULT b'0',
  `usu_registro` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_first_name`, `usu_last_name`, `usu_sexo`, `usu_cpf`, `usu_email`, `usu_senha`, `usu_cep`, `usu_end`, `usu_num`, `usu_complemento`, `usu_bairro`, `usu_cidade`, `usu_uf`, `usu_tipo`, `usu_cstatus`, `usu_mailmkt`, `usu_registro`) VALUES
(1, 'Nicolas', 'Carvalho Avelaneda', 'M', '477.608.258-62', 'carvalhonick2002@gmail.com', '$2y$10$u/yagUufHVeRE/4rvFjem.NUrEhssuowI3VfudfmQ2E0CMjFoHvcy', '16403-525', 'Rua José Rafael Rosa Pacini', 107, '', 'Jardim Manoel Scalfi', 'Lins', 'SP', 2, b'0', b'0', '2019-04-26 05:06:09'),
(2, 'Daniel', 'Costa de Bezerra', 'M', '438.953.093-62', 'dani_costa@gmail.com', '$2y$10$u/yagUufHVeRE/4rvFjem.NUrEhssuowI3VfudfmQ2E0CMjFoHvcy', '16400-120', 'Rua Terceiro-Sargento-Aeronáutica João Sá Faria', 238, 'Fundos', 'Vila Ramalho', 'Lins', 'SP', 1, b'0', b'0', '2019-05-17 01:36:37'),
(22, 'Walyson', 'Felipe', 'M', '426.804.958-45', 'walysonfelipe25@gmail.com', '$2y$10$3n5wRU7PgrZ7mQ8wEJwizezGyQjQ5OM04kSFDXHkqWTEMfWFyBZgu', '16401-472', 'Rua Eugênio Faustini', 755, '', 'Conjunto Habitacional Francisco José de Oliveira Ratto', 'Lins', 'SP', 1, b'1', b'0', '2019-06-20 23:06:21'),
(24, 'Pedro', 'Cardoso Todorovski', 'M', '404.449.728-11', 'pedroc.todorovskibr@gmail.com', '$2y$10$hplbGJK9QpLz7Ft3dQNfOu1DSrKtg8UDbHK2vVyZLm.vIANqI5pEy', '16400-460', 'Rua José Garcia de Carvalho', 300, 'Apto. 31 B', 'Jardim Ariano', 'Lins', 'SP', 1, b'1', b'0', '2019-06-23 13:28:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armazem`
--
ALTER TABLE `armazem`
  ADD PRIMARY KEY (`armazem_id`),
  ADD KEY `fk_CidArm` (`cidade_id`);

--
-- Indexes for table `atendimento`
<<<<<<< HEAD
--
ALTER TABLE `atendimento`
  ADD PRIMARY KEY (`id_atd`);

--
=======
--
ALTER TABLE `atendimento`
  ADD PRIMARY KEY (`id_atd`);

--
>>>>>>> 199277ba33d1be082f7125db743cc536bc3fd066
-- Indexes for table `atend_resposta`
--
ALTER TABLE `atend_resposta`
  ADD PRIMARY KEY (`resp_id`),
  ADD KEY `fk_AtendResp` (`id_atd`),
  ADD KEY `fk_FuncResp` (`funcionario_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `categ`
--
ALTER TABLE `categ`
  ADD PRIMARY KEY (`categ_id`),
  ADD KEY `FK_SubCateg` (`subcateg_id`);

--
-- Indexes for table `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`cid_id`),
  ADD KEY `fk_Est` (`est_id`);

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`compra_id`),
  ADD KEY `fk_UsuCompra` (`usu_id`),
  ADD KEY `fk_CompraStatus` (`status_id`),
  ADD KEY `fk_CompraPag` (`forma_id`);

--
-- Indexes for table `conf_mail`
--
ALTER TABLE `conf_mail`
  ADD PRIMARY KEY (`cf_id`),
  ADD KEY `fk_usu_conf` (`usu_id`);

--
-- Indexes for table `cupom`
--
ALTER TABLE `cupom`
  ADD PRIMARY KEY (`cupom_id`);

--
-- Indexes for table `dados_armazem`
--
ALTER TABLE `dados_armazem`
  ADD PRIMARY KEY (`dados_id`),
  ADD KEY `fk_ProdArm` (`produto_id`),
  ADD KEY `fk_ArmProd` (`armazem_id`);

--
-- Indexes for table `dados_atend_func`
--
ALTER TABLE `dados_atend_func`
  ADD PRIMARY KEY (`dados_id`),
  ADD KEY `fk_AtdFunc` (`atendimento_id`),
  ADD KEY `fk_FuncAtd` (`funcionario_id`);

--
-- Indexes for table `dados_entrega`
--
ALTER TABLE `dados_entrega`
  ADD PRIMARY KEY (`dados_id`),
  ADD KEY `fk_DataCompra` (`entrega_id`);

--
-- Indexes for table `dados_horario_entrega`
--
ALTER TABLE `dados_horario_entrega`
  ADD PRIMARY KEY (`dados_id`),
  ADD KEY `fk_DadoHora` (`dados_horario`),
  ADD KEY `fk_DadoArm` (`dados_armazem`) USING BTREE;

--
-- Indexes for table `dados_horario_subcidade`
--
ALTER TABLE `dados_horario_subcidade`
  ADD PRIMARY KEY (`dados_id`),
  ADD KEY `fk_SubHor` (`dados_horario`),
  ADD KEY `fk_SubSub` (`dados_subcidade`);

--
-- Indexes for table `dados_promocao`
--
ALTER TABLE `dados_promocao`
  ADD PRIMARY KEY (`dados_id`),
  ADD KEY `fk_ProdPromo` (`produto_id`),
  ADD KEY `fk_PromoArm` (`armazem_id`),
  ADD KEY `fk_PromoProd` (`promo_id`);

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`depart_id`);

--
-- Indexes for table `duvida_frequente`
--
ALTER TABLE `duvida_frequente`
  ADD PRIMARY KEY (`duvida_id`);

--
-- Indexes for table `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`entrega_id`),
  ADD KEY `fk_EntCompra` (`compra_id`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`est_id`);

--
-- Indexes for table `forma_pag`
--
ALTER TABLE `forma_pag`
  ADD PRIMARY KEY (`forma_id`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`fornecedor_id`);

--
-- Indexes for table `forn_prod`
--
ALTER TABLE `forn_prod`
  ADD PRIMARY KEY (`forn_prod_id`),
  ADD KEY `fk_FornProd` (`fornecedor_id`),
  ADD KEY `fk_ProdForn` (`produto_id`),
  ADD KEY `fk_FornArm` (`armazem_id`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`funcionario_id`),
  ADD KEY `fk_FuncSetor` (`funcionario_setor`);

--
-- Indexes for table `horarios_entrega`
--
ALTER TABLE `horarios_entrega`
  ADD PRIMARY KEY (`hora_id`);

--
-- Indexes for table `lista_compra`
--
ALTER TABLE `lista_compra`
  ADD PRIMARY KEY (`lista_id`),
  ADD KEY `fk_CompraLista` (`compra_id`),
  ADD KEY `fk_ListaProd` (`produto_id`);

--
-- Indexes for table `marca_prod`
--
ALTER TABLE `marca_prod`
  ADD PRIMARY KEY (`marca_id`);

--
-- Indexes for table `postagem`
--
ALTER TABLE `postagem`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`produto_id`),
  ADD KEY `fk_MarcaProd` (`produto_marca`),
  ADD KEY `fk_CategProd` (`produto_categ`);
ALTER TABLE `produto` ADD FULLTEXT KEY `produto_nome` (`produto_nome`,`produto_descricao`,`produto_tamanho`);

--
-- Indexes for table `produtos_favorito`
--
ALTER TABLE `produtos_favorito`
  ADD PRIMARY KEY (`favorito_id`),
  ADD KEY `fk_ProdUsu` (`produto_id`),
  ADD KEY `fk_UsuProd` (`usu_id`);

--
-- Indexes for table `promocao_temp`
--
ALTER TABLE `promocao_temp`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indexes for table `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`setor_id`);

--
-- Indexes for table `status_compra`
--
ALTER TABLE `status_compra`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `subcateg`
--
ALTER TABLE `subcateg`
  ADD PRIMARY KEY (`subcateg_id`),
  ADD KEY `FK_Departamento` (`depart_id`);

--
-- Indexes for table `subcidade`
--
ALTER TABLE `subcidade`
  ADD PRIMARY KEY (`subcid_id`),
  ADD KEY `fk_SubCid` (`cid_id`),
  ADD KEY `fk_SubEst` (`est_id`);

--
-- Indexes for table `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`tel_id`),
  ADD KEY `fk_TipoTel` (`tpu_tel`),
  ADD KEY `fk_usuarioTel` (`usu_id`);

--
-- Indexes for table `tipousu`
--
ALTER TABLE `tipousu`
  ADD PRIMARY KEY (`tpu_id`);

--
-- Indexes for table `tipo_tel`
--
ALTER TABLE `tipo_tel`
  ADD PRIMARY KEY (`tpu_tel_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `fk_Tipo` (`usu_tipo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armazem`
--
ALTER TABLE `armazem`
  MODIFY `armazem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `atendimento`
--
ALTER TABLE `atendimento`
  MODIFY `id_atd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `atend_resposta`
--
ALTER TABLE `atend_resposta`
  MODIFY `resp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categ`
--
ALTER TABLE `categ`
  MODIFY `categ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `cidade`
--
ALTER TABLE `cidade`
  MODIFY `cid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `compra_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conf_mail`
--
ALTER TABLE `conf_mail`
  MODIFY `cf_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cupom`
--
ALTER TABLE `cupom`
  MODIFY `cupom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dados_armazem`
--
ALTER TABLE `dados_armazem`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `dados_atend_func`
--
ALTER TABLE `dados_atend_func`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `dados_entrega`
--
ALTER TABLE `dados_entrega`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dados_horario_entrega`
--
ALTER TABLE `dados_horario_entrega`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `dados_horario_subcidade`
--
ALTER TABLE `dados_horario_subcidade`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `dados_promocao`
--
ALTER TABLE `dados_promocao`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `depart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `duvida_frequente`
--
ALTER TABLE `duvida_frequente`
  MODIFY `duvida_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `entrega`
--
ALTER TABLE `entrega`
  MODIFY `entrega_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forma_pag`
--
ALTER TABLE `forma_pag`
  MODIFY `forma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forn_prod`
--
ALTER TABLE `forn_prod`
  MODIFY `forn_prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `funcionario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `horarios_entrega`
--
ALTER TABLE `horarios_entrega`
  MODIFY `hora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `lista_compra`
--
ALTER TABLE `lista_compra`
  MODIFY `lista_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marca_prod`
--
ALTER TABLE `marca_prod`
  MODIFY `marca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `postagem`
--
ALTER TABLE `postagem`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `produtos_favorito`
--
ALTER TABLE `produtos_favorito`
  MODIFY `favorito_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `promocao_temp`
--
ALTER TABLE `promocao_temp`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `setor`
--
ALTER TABLE `setor`
  MODIFY `setor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_compra`
--
ALTER TABLE `status_compra`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subcateg`
--
ALTER TABLE `subcateg`
  MODIFY `subcateg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `subcidade`
--
ALTER TABLE `subcidade`
  MODIFY `subcid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `telefone`
--
ALTER TABLE `telefone`
  MODIFY `tel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tipousu`
--
ALTER TABLE `tipousu`
  MODIFY `tpu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_tel`
--
ALTER TABLE `tipo_tel`
  MODIFY `tpu_tel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `armazem`
--
ALTER TABLE `armazem`
  ADD CONSTRAINT `fk_CidArm` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`cid_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `atend_resposta`
--
ALTER TABLE `atend_resposta`
  ADD CONSTRAINT `fk_AtendResp` FOREIGN KEY (`id_atd`) REFERENCES `atendimento` (`id_atd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_FuncResp` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionario` (`funcionario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `categ`
--
ALTER TABLE `categ`
  ADD CONSTRAINT `FK_SubCateg` FOREIGN KEY (`subcateg_id`) REFERENCES `subcateg` (`subcateg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `fk_Est` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_CompraPag` FOREIGN KEY (`forma_id`) REFERENCES `forma_pag` (`forma_id`),
  ADD CONSTRAINT `fk_CompraStatus` FOREIGN KEY (`status_id`) REFERENCES `status_compra` (`status_id`),
  ADD CONSTRAINT `fk_UsuCompra` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Limitadores para a tabela `conf_mail`
--
ALTER TABLE `conf_mail`
  ADD CONSTRAINT `fk_usu_conf` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `dados_armazem`
--
ALTER TABLE `dados_armazem`
  ADD CONSTRAINT `fk_ArmProd` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`armazem_id`),
  ADD CONSTRAINT `fk_ProdArm` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `dados_atend_func`
--
ALTER TABLE `dados_atend_func`
  ADD CONSTRAINT `fk_AtdFunc` FOREIGN KEY (`atendimento_id`) REFERENCES `atendimento` (`id_atd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_FuncAtd` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionario` (`funcionario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `dados_entrega`
--
ALTER TABLE `dados_entrega`
  ADD CONSTRAINT `fk_DataCompra` FOREIGN KEY (`entrega_id`) REFERENCES `entrega` (`entrega_id`),
  ADD CONSTRAINT `fk_DataEnt` FOREIGN KEY (`entrega_id`) REFERENCES `entrega` (`entrega_id`);

--
-- Limitadores para a tabela `dados_horario_entrega`
--
ALTER TABLE `dados_horario_entrega`
  ADD CONSTRAINT `fk_DadoArm` FOREIGN KEY (`dados_armazem`) REFERENCES `armazem` (`armazem_id`),
  ADD CONSTRAINT `fk_DadoHora` FOREIGN KEY (`dados_horario`) REFERENCES `horarios_entrega` (`hora_id`);

--
-- Limitadores para a tabela `dados_horario_subcidade`
--
ALTER TABLE `dados_horario_subcidade`
  ADD CONSTRAINT `fk_SubHor` FOREIGN KEY (`dados_horario`) REFERENCES `horarios_entrega` (`hora_id`),
  ADD CONSTRAINT `fk_SubSub` FOREIGN KEY (`dados_subcidade`) REFERENCES `subcidade` (`subcid_id`);

--
-- Limitadores para a tabela `dados_promocao`
--
ALTER TABLE `dados_promocao`
  ADD CONSTRAINT `fk_ProdPromo` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_PromoArm` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`armazem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_PromoProd` FOREIGN KEY (`promo_id`) REFERENCES `promocao_temp` (`promo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `entrega`
--
ALTER TABLE `entrega`
  ADD CONSTRAINT `fk_EntCompra` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`compra_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `forn_prod`
--
ALTER TABLE `forn_prod`
  ADD CONSTRAINT `fk_FornArm` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`armazem_id`),
  ADD CONSTRAINT `fk_FornProd` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`fornecedor_id`),
  ADD CONSTRAINT `fk_ProdForn` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`);

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_FuncSetor` FOREIGN KEY (`funcionario_setor`) REFERENCES `setor` (`setor_id`);

--
-- Limitadores para a tabela `lista_compra`
--
ALTER TABLE `lista_compra`
  ADD CONSTRAINT `fk_CompraLista` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`compra_id`),
  ADD CONSTRAINT `fk_ListaProd` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_CategProd` FOREIGN KEY (`produto_categ`) REFERENCES `categ` (`categ_id`),
  ADD CONSTRAINT `fk_MarcaProd` FOREIGN KEY (`produto_marca`) REFERENCES `marca_prod` (`marca_id`);

--
-- Limitadores para a tabela `produtos_favorito`
--
ALTER TABLE `produtos_favorito`
  ADD CONSTRAINT `fk_ProdUsu` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_UsuProd` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `subcateg`
--
ALTER TABLE `subcateg`
  ADD CONSTRAINT `FK_Departamento` FOREIGN KEY (`depart_id`) REFERENCES `departamento` (`depart_id`);

--
-- Limitadores para a tabela `subcidade`
--
ALTER TABLE `subcidade`
  ADD CONSTRAINT `fk_SubCid` FOREIGN KEY (`cid_id`) REFERENCES `cidade` (`cid_id`),
  ADD CONSTRAINT `fk_SubEst` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`);

--
-- Limitadores para a tabela `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `fk_tpu` FOREIGN KEY (`tpu_tel`) REFERENCES `tipo_tel` (`tpu_tel_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarioTel` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Tipo` FOREIGN KEY (`usu_tipo`) REFERENCES `tipousu` (`tpu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
