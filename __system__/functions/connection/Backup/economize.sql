-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/05/2019 às 21:08
-- Versão do servidor: 10.1.38-MariaDB
-- Versão do PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `economize`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `armazem`
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
-- Despejando dados para a tabela `armazem`
--

INSERT INTO `armazem` (`armazem_id`, `armazem_nome`, `armazem_supervisor`, `armazem_supervisor_cpf`, `armazem_registro`, `cidade_id`) VALUES
(1, 'Armazém Lins', 'Carlos Felipe de Souza', '234.987.622-95', '2019-04-23 06:41:12', 1),
(2, 'Armazém Promissão', 'Paula Rodrigues de Oliveira', '340.139.871-22', '2019-05-16 05:44:55', 2),
(3, 'Armazém Garça', 'Alexsandro Renato de Souza', '497.235.681-34', '2019-05-17 02:13:13', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `banner_nome` varchar(50) DEFAULT NULL,
  `banner_path` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categ`
--

CREATE TABLE `categ` (
  `categ_id` int(11) NOT NULL,
  `categ_nome` varchar(30) NOT NULL,
  `subcateg_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `categ`
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
(15, 'ACHOCOLATADOS', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidade`
--

CREATE TABLE `cidade` (
  `cid_id` int(11) NOT NULL,
  `cid_nome` varchar(50) NOT NULL,
  `est_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `cidade`
--

INSERT INTO `cidade` (`cid_id`, `cid_nome`, `est_id`) VALUES
(1, 'Lins', 1),
(2, 'Promissão', 1),
(3, 'Garça', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `compra`
--

CREATE TABLE `compra` (
  `compra_id` int(11) NOT NULL,
  `compra_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `compra_total` float NOT NULL,
  `usu_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `forma_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cupom`
--

CREATE TABLE `cupom` (
  `cupom_id` int(11) NOT NULL,
  `cupom_codigo` varchar(30) NOT NULL,
  `cupom_desconto_porcent` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `cupom`
--

INSERT INTO `cupom` (`cupom_id`, `cupom_codigo`, `cupom_desconto_porcent`) VALUES
(1, 'AKPLD765', 50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_armazem`
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
-- Despejando dados para a tabela `dados_armazem`
--

INSERT INTO `dados_armazem` (`dados_id`, `produto_id`, `armazem_id`, `produto_qtd`, `produto_preco`, `produto_desconto_porcent`) VALUES
(1, 1, 1, 200, '6.40', 24),
(2, 2, 1, 17, '5.49', NULL),
(3, 3, 1, 300, '2.30', 14),
(4, 4, 1, 200, '3.00', 9),
(5, 5, 1, 200, '2.50', NULL),
(6, 6, 1, 200, '2.50', 15),
(7, 7, 1, 140, '23.39', NULL),
(8, 1, 2, 400, '50.00', 68),
(9, 2, 2, 400, '125.59', 50),
(10, 3, 2, 400, '45.99', 35),
(11, 4, 2, 400, '63.00', 87),
(12, 5, 2, 400, '35.39', 77),
(13, 6, 2, 400, '49.00', 37),
(14, 7, 2, 400, '83.99', 62),
(15, 8, 1, 200, '39.99', NULL),
(16, 8, 2, 200, '45.99', 18),
(17, 15, 1, 300, '3.50', 12),
(19, 16, 1, 0, '6.99', NULL),
(20, 15, 2, 300, '3.59', NULL),
(21, 16, 2, 200, '7.39', 22),
(22, 17, 1, 200, '5.49', 11),
(23, 17, 2, 200, '6.40', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_entrega`
--

CREATE TABLE `dados_entrega` (
  `dados_id` int(11) NOT NULL,
  `entrega_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_horario_entrega`
--

CREATE TABLE `dados_horario_entrega` (
  `dados_id` int(11) NOT NULL,
  `dados_horario` int(11) NOT NULL,
  `dados_armazem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `dados_horario_entrega`
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
(49, 31, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_horario_subcidade`
--

CREATE TABLE `dados_horario_subcidade` (
  `dados_id` int(11) NOT NULL,
  `dados_horario` int(11) NOT NULL,
  `dados_subcidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `dados_horario_subcidade`
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
-- Estrutura para tabela `departamento`
--

CREATE TABLE `departamento` (
  `depart_id` int(11) NOT NULL,
  `depart_nome` varchar(30) NOT NULL,
  `depart_icon` varchar(70) NOT NULL,
  `depart_desc` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `departamento`
--

INSERT INTO `departamento` (`depart_id`, `depart_nome`, `depart_icon`, `depart_desc`) VALUES
(1, 'AÇOUGUE', 'flaticon-038-steaks', NULL),
(2, 'BEBIDAS', 'flaticon-020-products-3', 'Águas e Chás, Cervejas e tudo o mais'),
(3, 'CEREAIS', 'flaticon-048-cereal', NULL),
(4, 'HORTIFRÚTI', 'flaticon-022-healthy-food-1', NULL),
(5, 'GRÃOS', 'flaticon-009-wheat-flour', NULL),
(6, 'HORTA', 'flaticon-031-healthy-food', NULL),
(7, 'LATICÍNIOS', 'flaticon-043-products', NULL),
(8, 'MATINAIS', 'flaticon-011-products-5', 'Produtos para começar o dia com a energia e disposição que você precisa'),
(9, 'LIMPEZA', 'flaticon-039-tools-and-utensils', NULL),
(10, 'PADARIA', 'flaticon-008-baguettes', NULL),
(11, 'PEIXARIA', 'flaticon-006-fishes', NULL),
(12, 'SNACKS', 'flaticon-042-products-1', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `entrega`
--

CREATE TABLE `entrega` (
  `entrega_id` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE `estado` (
  `est_id` int(11) NOT NULL,
  `est_uf` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `estado`
--

INSERT INTO `estado` (`est_id`, `est_uf`) VALUES
(1, 'SP');

-- --------------------------------------------------------

--
-- Estrutura para tabela `forma_pag`
--

CREATE TABLE `forma_pag` (
  `forma_id` int(11) NOT NULL,
  `forma_nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `forma_pag`
--

INSERT INTO `forma_pag` (`forma_id`, `forma_nome`) VALUES
(1, 'CARTÃO CRÉDITO'),
(2, 'CARTÃO DÉBITO'),
(3, 'BOLETO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedor`
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
-- Despejando dados para a tabela `fornecedor`
--

INSERT INTO `fornecedor` (`fornecedor_id`, `fornecedor_nome`, `fornecedor_responsavel_nome`, `fornecedor_cnpj`, `fornecedor_data_registro`, `fornecedor_img`) VALUES
(1, 'The Coca-Cola Company', 'Gabriel Pereira da Silva', '45.997.418/0001-53', '2019-04-23 06:47:54', 'logo_coca_cola.png'),
(2, 'Poty Cia. de Bebidas', 'Bruna Zheme dos Santos', '55.223.127/0001-61', '2019-04-23 06:47:54', 'logo_poty.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `forn_prod`
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
-- Despejando dados para a tabela `forn_prod`
--

INSERT INTO `forn_prod` (`forn_prod_id`, `fornecedor_id`, `produto_id`, `produto_qtd`, `forn_prod_data_registro`, `armazem_id`) VALUES
(1, 1, 1, 200, '2019-04-23 06:49:46', 1),
(2, 2, 2, 130, '2019-04-23 06:49:46', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `funcionario_id` int(11) NOT NULL,
  `funcionario_nome` varchar(150) NOT NULL,
  `funcionario_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `funcionario_cpf` char(14) NOT NULL,
  `funcionario_datanasc` date NOT NULL,
  `funcionario_setor` int(11) NOT NULL,
  `horario_entrada` time NOT NULL,
  `horario_saida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`funcionario_id`, `funcionario_nome`, `funcionario_registro`, `funcionario_cpf`, `funcionario_datanasc`, `funcionario_setor`, `horario_entrada`, `horario_saida`) VALUES
(1, 'Otávio Henrique Perene', '2019-04-23 07:04:33', '305.983.437-12', '1985-03-26', 1, '06:30:00', '12:30:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `horarios_entrega`
--

CREATE TABLE `horarios_entrega` (
  `hora_id` int(11) NOT NULL,
  `hora` time NOT NULL,
  `dia` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `horarios_entrega`
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
-- Estrutura para tabela `lista_compra`
--

CREATE TABLE `lista_compra` (
  `lista_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca_prod`
--

CREATE TABLE `marca_prod` (
  `marca_id` int(11) NOT NULL,
  `marca_nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `marca_prod`
--

INSERT INTO `marca_prod` (`marca_id`, `marca_nome`) VALUES
(1, 'Coca-Cola'),
(2, 'Poty'),
(3, 'Fanta'),
(4, 'Pepsi'),
(5, 'Brahma'),
(6, 'Red Bull'),
(7, 'Schin'),
(8, 'Del Valle'),
(9, 'Chalise'),
(10, 'Skol'),
(11, 'Nescau'),
(12, 'Toddy');

-- --------------------------------------------------------

--
-- Estrutura para tabela `postagem`
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
-- Estrutura para tabela `produto`
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
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`produto_id`, `produto_nome`, `produto_descricao`, `produto_img`, `produto_marca`, `produto_tamanho`, `produto_categ`) VALUES
(1, 'Refrigerante Coca-Cola', 'Refrigerante com sabor único e refrescante, vendido em mais de 200 países e considerado uma das maiores marcas do mundo', 'coca-cola-1l.jpg', 1, '2 Litros', 2),
(2, 'Refrigerante Fanta Uva', 'Um dos melhores refrigerantes da América Latina desde 1963.', 'fanta-uva-2l.jpg', 3, '2 Litros', 2),
(3, 'Cerveja Brahma Lata', 'Criada por um suíço que procurava um sabor mais europeu em solo brasileiro em 1888, no Rio de Janeiro; Brahma Chopp é uma cerveja de cor clara e aparência cristalina. Ela é leve e com aroma neutro, sabor encorpado mas com amargor suave. Foi a primeira cerveja brasileira a ser exportada e hoje está presente em mais de 15 países, entre América do Norte e Europa.', 'brahma_lata_350ml.jpg', 5, '350ml', 5),
(4, 'Energético Red Bull', 'O Energético Red Bull tem em sua composição: Cafeína, Taurina, Vitaminas do grupo B, Sacarose, Glucose e Água das fontes alpinas. Estimula as funções cognitivas do corpo e ajuda a melhorar a concentração, aumentando o estado de vigilância ou alerta.', 'red-bull-250ml.jpg', 6, '250ml', 6),
(5, 'Água Mineral sem Gás Schin', 'A Água Mineral Sem Gás Schin é produzida a partir de oito fontes naturais. É uma água de altíssima qualidade, que atende aos mais exigentes requisitos de qualidade e segurança.', 'agua-mineral-500ml.jpg', 7, '500ml', 9),
(6, 'Suco de Maracujá Del Valle Kapo', 'O Suco de Maracujá Del Valle Kapo traz nutrição para a lancheira do seu filho. Fonte de Vitaminas A, B3, B6, B12, C, D e E, é considerado um complexo vitamínico indicado para o desenvolvimento das crianças. Del Valle Kapo é adoçado com suco de maçã, por isso, tem menos açúcar adicionado.', 'del-valle-maracuja-200ml.jpg', 8, '200ml', 10),
(7, 'Vinho Tinto Seco Chalise', 'O Vinho Tinto Seco Chalise é límpido, com coloração roxo vivo, reflexos violáceos, aroma característico de morango e framboesa, sabor suave e de grande permanência. Combina com carnes e queijos.', 'vinho-tinto-seco-chalise-750ml.jpg', 9, '750ml', 11),
(8, 'Cerveja Skol Lata Pack', 'Cerveja Skol 18 unidades x 350ml', 'cerveja-skol-lt-18x350ml.jpg', 10, '18 unidades ~ 350ml', 5),
(15, 'Refrigerante Pepsi', 'Originalmente, a fórmula da Pepsi foi criada para fins medicinais. Mas seu sabor agradou tanto que o xarope começou a ser consumido simplesmente por prazer. Cinco anos mais tarde, a fórmula transformou-se em bebida e começou a ser comercializada. Hoje, a Pepsi é um refrigerante de cola com aroma natural, muito apreciado pelo sabor suave e pela refrescância.', 'pepsi-600ml.jpg', 4, '600 ml', 2),
(16, 'Refrigerante Pepsi', 'Originalmente, a fórmula da Pepsi foi criada para fins medicinais. Mas seu sabor agradou tanto que o xarope começou a ser consumido simplesmente por prazer. Cinco anos mais tarde, a fórmula transformou-se em bebida e começou a ser comercializada. Hoje, a Pepsi é um refrigerante de cola com aroma natural, muito apreciado pelo sabor suave e pela refrescância.', 'pepsi-2litros.jpg', 4, '2 Litros', 2),
(17, 'Achocolatado Original Toddy Pote', 'O Achocolatado em Pó Toddy Original é um achocolatado saboroso e cremoso que você já conhece, e que é fonte de vitaminas. Com ele qualquer dia fica mais gostoso!', 'achocolatado-toddy-400g.jpg', 12, '400g', 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos_favorito`
--

CREATE TABLE `produtos_favorito` (
  `favorito_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `produtos_favorito`
--

INSERT INTO `produtos_favorito` (`favorito_id`, `produto_id`, `usu_id`) VALUES
(85, 1, 2),
(87, 3, 2),
(88, 8, 2),
(106, 7, 1),
(109, 1, 1),
(110, 6, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `setor`
--

CREATE TABLE `setor` (
  `setor_id` int(11) NOT NULL,
  `setor_nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `setor`
--

INSERT INTO `setor` (`setor_id`, `setor_nome`) VALUES
(1, 'Entregador'),
(2, 'Balconista'),
(3, 'Recepcionista');

-- --------------------------------------------------------

--
-- Estrutura para tabela `status_compra`
--

CREATE TABLE `status_compra` (
  `status_id` int(11) NOT NULL,
  `status_nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `status_compra`
--

INSERT INTO `status_compra` (`status_id`, `status_nome`) VALUES
(1, 'COMPRA REALIZADA'),
(2, 'À ESPERAR'),
(3, 'ENTREGUE'),
(4, 'CANCELADO'),
(5, 'PAGO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcateg`
--

CREATE TABLE `subcateg` (
  `subcateg_id` int(11) NOT NULL,
  `subcateg_nome` varchar(50) NOT NULL,
  `depart_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `subcateg`
--

INSERT INTO `subcateg` (`subcateg_id`, `subcateg_nome`, `depart_id`) VALUES
(1, 'REFRIGERANTES', 2),
(2, 'ÁGUAS E CHÁS', 2),
(3, 'SUCOS E REFRESCOS', 2),
(4, 'CERVEJAS', 2),
(5, 'VINHOS', 2),
(6, 'ENERGÉTICOS E ISOTÔNICOS E HIDROTÔNICOS', 2),
(9, 'LÁCTEOS E ACHOCOLATADOS', 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcidade`
--

CREATE TABLE `subcidade` (
  `subcid_id` int(11) NOT NULL,
  `subcid_nome` varchar(30) NOT NULL,
  `cid_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `subcidade`
--

INSERT INTO `subcidade` (`subcid_id`, `subcid_nome`, `cid_id`, `est_id`) VALUES
(1, 'Guaiçara', 1, 1),
(2, 'Cafelândia', 1, 1),
(3, 'Guaimbê', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `telefone`
--

CREATE TABLE `telefone` (
  `tel_id` int(11) NOT NULL,
  `tel_num` varchar(15) NOT NULL,
  `tpu_tel` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `telefone`
--

INSERT INTO `telefone` (`tel_id`, `tel_num`, `tpu_tel`, `usu_id`) VALUES
(1, '(14) 99755-8843', 1, 1),
(2, '(14) 95104-7655', 2, 1),
(3, '(14) 99543-0912', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipousu`
--

CREATE TABLE `tipousu` (
  `tpu_id` int(11) NOT NULL,
  `tpu_usu_nome` varchar(30) NOT NULL,
  `tpu_desc` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tipousu`
--

INSERT INTO `tipousu` (`tpu_id`, `tpu_usu_nome`, `tpu_desc`) VALUES
(1, 'Cliente', NULL),
(2, 'Associado', 20),
(3, 'Administrador', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_tel`
--

CREATE TABLE `tipo_tel` (
  `tpu_tel_id` int(11) NOT NULL,
  `tpu_tel_nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tipo_tel`
--

INSERT INTO `tipo_tel` (`tpu_tel_id`, `tpu_tel_nome`) VALUES
(1, 'Pessoal'),
(2, 'Profissional'),
(3, 'Fixo'),
(4, 'Outro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
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
  `usu_bairro` varchar(50) NOT NULL,
  `usu_cidade` varchar(50) NOT NULL,
  `usu_uf` char(2) NOT NULL,
  `usu_tipo` int(11) NOT NULL,
  `usu_registro` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_first_name`, `usu_last_name`, `usu_sexo`, `usu_cpf`, `usu_email`, `usu_senha`, `usu_cep`, `usu_end`, `usu_num`, `usu_complemento`, `usu_bairro`, `usu_cidade`, `usu_uf`, `usu_tipo`, `usu_registro`) VALUES
(1, 'Nicolas', 'Carvalho Avelaneda', 'M', '477.608.355-98', 'carvanick@gmail.com', '$2y$10$u/yagUufHVeRE/4rvFjem.NUrEhssuowI3VfudfmQ2E0CMjFoHvcy', '16403-525', 'Rua José Rafael Rosa Pacini', 107, '', 'Jardim Manoel Scalfi', 'Lins', 'SP', 3, '2019-04-26 05:06:09'),
(2, 'Daniel', 'Costa de Bezerra', 'M', '438.953.093-62', 'dani_costa@gmail.com', '$2y$10$u/yagUufHVeRE/4rvFjem.NUrEhssuowI3VfudfmQ2E0CMjFoHvcy', '16400-120', 'Rua Terceiro-Sargento-Aeronáutica João Sá Faria', 238, 'Fundos', 'Vila Ramalho', 'Lins', 'SP', 1, '2019-05-17 01:36:37');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `armazem`
--
ALTER TABLE `armazem`
  ADD PRIMARY KEY (`armazem_id`),
  ADD KEY `fk_CidArm` (`cidade_id`);

--
-- Índices de tabela `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Índices de tabela `categ`
--
ALTER TABLE `categ`
  ADD PRIMARY KEY (`categ_id`),
  ADD KEY `FK_SubCateg` (`subcateg_id`);

--
-- Índices de tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`cid_id`),
  ADD KEY `fk_Est` (`est_id`);

--
-- Índices de tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`compra_id`),
  ADD KEY `fk_UsuCompra` (`usu_id`),
  ADD KEY `fk_CompraStatus` (`status_id`),
  ADD KEY `fk_CompraPag` (`forma_id`);

--
-- Índices de tabela `cupom`
--
ALTER TABLE `cupom`
  ADD PRIMARY KEY (`cupom_id`);

--
-- Índices de tabela `dados_armazem`
--
ALTER TABLE `dados_armazem`
  ADD PRIMARY KEY (`dados_id`),
  ADD KEY `fk_ProdArm` (`produto_id`),
  ADD KEY `fk_ArmProd` (`armazem_id`);

--
-- Índices de tabela `dados_entrega`
--
ALTER TABLE `dados_entrega`
  ADD PRIMARY KEY (`dados_id`),
  ADD KEY `fk_DataCompra` (`entrega_id`);

--
-- Índices de tabela `dados_horario_entrega`
--
ALTER TABLE `dados_horario_entrega`
  ADD PRIMARY KEY (`dados_id`),
  ADD KEY `fk_DadoHora` (`dados_horario`),
  ADD KEY `fk_DadoArm` (`dados_armazem`) USING BTREE;

--
-- Índices de tabela `dados_horario_subcidade`
--
ALTER TABLE `dados_horario_subcidade`
  ADD PRIMARY KEY (`dados_id`),
  ADD KEY `fk_SubHor` (`dados_horario`),
  ADD KEY `fk_SubSub` (`dados_subcidade`);

--
-- Índices de tabela `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`depart_id`);

--
-- Índices de tabela `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`entrega_id`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`est_id`);

--
-- Índices de tabela `forma_pag`
--
ALTER TABLE `forma_pag`
  ADD PRIMARY KEY (`forma_id`);

--
-- Índices de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`fornecedor_id`);

--
-- Índices de tabela `forn_prod`
--
ALTER TABLE `forn_prod`
  ADD PRIMARY KEY (`forn_prod_id`),
  ADD KEY `fk_FornProd` (`fornecedor_id`),
  ADD KEY `fk_ProdForn` (`produto_id`),
  ADD KEY `fk_FornArm` (`armazem_id`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`funcionario_id`),
  ADD KEY `fk_FuncSetor` (`funcionario_setor`);

--
-- Índices de tabela `horarios_entrega`
--
ALTER TABLE `horarios_entrega`
  ADD PRIMARY KEY (`hora_id`);

--
-- Índices de tabela `lista_compra`
--
ALTER TABLE `lista_compra`
  ADD PRIMARY KEY (`lista_id`),
  ADD KEY `fk_CompraLista` (`compra_id`),
  ADD KEY `fk_ListaProd` (`produto_id`);

--
-- Índices de tabela `marca_prod`
--
ALTER TABLE `marca_prod`
  ADD PRIMARY KEY (`marca_id`);

--
-- Índices de tabela `postagem`
--
ALTER TABLE `postagem`
  ADD PRIMARY KEY (`post_id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`produto_id`),
  ADD KEY `fk_MarcaProd` (`produto_marca`),
  ADD KEY `fk_CategProd` (`produto_categ`);
ALTER TABLE `produto` ADD FULLTEXT KEY `produto_nome` (`produto_nome`,`produto_descricao`,`produto_tamanho`);

--
-- Índices de tabela `produtos_favorito`
--
ALTER TABLE `produtos_favorito`
  ADD PRIMARY KEY (`favorito_id`),
  ADD KEY `fk_ProdUsu` (`produto_id`),
  ADD KEY `fk_UsuProd` (`usu_id`);

--
-- Índices de tabela `setor`
--
ALTER TABLE `setor`
  ADD PRIMARY KEY (`setor_id`);

--
-- Índices de tabela `status_compra`
--
ALTER TABLE `status_compra`
  ADD PRIMARY KEY (`status_id`);

--
-- Índices de tabela `subcateg`
--
ALTER TABLE `subcateg`
  ADD PRIMARY KEY (`subcateg_id`),
  ADD KEY `FK_Departamento` (`depart_id`);

--
-- Índices de tabela `subcidade`
--
ALTER TABLE `subcidade`
  ADD PRIMARY KEY (`subcid_id`),
  ADD KEY `fk_SubCid` (`cid_id`),
  ADD KEY `fk_SubEst` (`est_id`);

--
-- Índices de tabela `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`tel_id`),
  ADD KEY `fk_TipoTel` (`tpu_tel`),
  ADD KEY `fk_usuarioTel` (`usu_id`);

--
-- Índices de tabela `tipousu`
--
ALTER TABLE `tipousu`
  ADD PRIMARY KEY (`tpu_id`);

--
-- Índices de tabela `tipo_tel`
--
ALTER TABLE `tipo_tel`
  ADD PRIMARY KEY (`tpu_tel_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `fk_Tipo` (`usu_tipo`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `armazem`
--
ALTER TABLE `armazem`
  MODIFY `armazem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categ`
--
ALTER TABLE `categ`
  MODIFY `categ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `cid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `compra_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cupom`
--
ALTER TABLE `cupom`
  MODIFY `cupom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `dados_armazem`
--
ALTER TABLE `dados_armazem`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `dados_entrega`
--
ALTER TABLE `dados_entrega`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dados_horario_entrega`
--
ALTER TABLE `dados_horario_entrega`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `dados_horario_subcidade`
--
ALTER TABLE `dados_horario_subcidade`
  MODIFY `dados_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `departamento`
--
ALTER TABLE `departamento`
  MODIFY `depart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `entrega`
--
ALTER TABLE `entrega`
  MODIFY `entrega_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `forma_pag`
--
ALTER TABLE `forma_pag`
  MODIFY `forma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `forn_prod`
--
ALTER TABLE `forn_prod`
  MODIFY `forn_prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `funcionario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `horarios_entrega`
--
ALTER TABLE `horarios_entrega`
  MODIFY `hora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `lista_compra`
--
ALTER TABLE `lista_compra`
  MODIFY `lista_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marca_prod`
--
ALTER TABLE `marca_prod`
  MODIFY `marca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `postagem`
--
ALTER TABLE `postagem`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `produtos_favorito`
--
ALTER TABLE `produtos_favorito`
  MODIFY `favorito_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de tabela `setor`
--
ALTER TABLE `setor`
  MODIFY `setor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `status_compra`
--
ALTER TABLE `status_compra`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `subcateg`
--
ALTER TABLE `subcateg`
  MODIFY `subcateg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `subcidade`
--
ALTER TABLE `subcidade`
  MODIFY `subcid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `telefone`
--
ALTER TABLE `telefone`
  MODIFY `tel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipousu`
--
ALTER TABLE `tipousu`
  MODIFY `tpu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipo_tel`
--
ALTER TABLE `tipo_tel`
  MODIFY `tpu_tel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `armazem`
--
ALTER TABLE `armazem`
  ADD CONSTRAINT `fk_CidArm` FOREIGN KEY (`cidade_id`) REFERENCES `cidade` (`cid_id`);

--
-- Restrições para tabelas `categ`
--
ALTER TABLE `categ`
  ADD CONSTRAINT `FK_SubCateg` FOREIGN KEY (`subcateg_id`) REFERENCES `subcateg` (`subcateg_id`);

--
-- Restrições para tabelas `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `fk_Est` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`);

--
-- Restrições para tabelas `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_CompraPag` FOREIGN KEY (`forma_id`) REFERENCES `forma_pag` (`forma_id`),
  ADD CONSTRAINT `fk_CompraStatus` FOREIGN KEY (`status_id`) REFERENCES `status_compra` (`status_id`),
  ADD CONSTRAINT `fk_UsuCompra` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Restrições para tabelas `dados_armazem`
--
ALTER TABLE `dados_armazem`
  ADD CONSTRAINT `fk_ArmProd` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`armazem_id`),
  ADD CONSTRAINT `fk_ProdArm` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`);

--
-- Restrições para tabelas `dados_entrega`
--
ALTER TABLE `dados_entrega`
  ADD CONSTRAINT `fk_DataCompra` FOREIGN KEY (`entrega_id`) REFERENCES `entrega` (`entrega_id`),
  ADD CONSTRAINT `fk_DataEnt` FOREIGN KEY (`entrega_id`) REFERENCES `entrega` (`entrega_id`);

--
-- Restrições para tabelas `dados_horario_entrega`
--
ALTER TABLE `dados_horario_entrega`
  ADD CONSTRAINT `fk_DadoArm` FOREIGN KEY (`dados_armazem`) REFERENCES `armazem` (`armazem_id`),
  ADD CONSTRAINT `fk_DadoHora` FOREIGN KEY (`dados_horario`) REFERENCES `horarios_entrega` (`hora_id`);

--
-- Restrições para tabelas `dados_horario_subcidade`
--
ALTER TABLE `dados_horario_subcidade`
  ADD CONSTRAINT `fk_SubHor` FOREIGN KEY (`dados_horario`) REFERENCES `horarios_entrega` (`hora_id`),
  ADD CONSTRAINT `fk_SubSub` FOREIGN KEY (`dados_subcidade`) REFERENCES `subcidade` (`subcid_id`);

--
-- Restrições para tabelas `forn_prod`
--
ALTER TABLE `forn_prod`
  ADD CONSTRAINT `fk_FornArm` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`armazem_id`),
  ADD CONSTRAINT `fk_FornProd` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`fornecedor_id`),
  ADD CONSTRAINT `fk_ProdForn` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`);

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_FuncSetor` FOREIGN KEY (`funcionario_setor`) REFERENCES `setor` (`setor_id`);

--
-- Restrições para tabelas `lista_compra`
--
ALTER TABLE `lista_compra`
  ADD CONSTRAINT `fk_CompraLista` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`compra_id`),
  ADD CONSTRAINT `fk_ListaProd` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_CategProd` FOREIGN KEY (`produto_categ`) REFERENCES `categ` (`categ_id`),
  ADD CONSTRAINT `fk_MarcaProd` FOREIGN KEY (`produto_marca`) REFERENCES `marca_prod` (`marca_id`);

--
-- Restrições para tabelas `produtos_favorito`
--
ALTER TABLE `produtos_favorito`
  ADD CONSTRAINT `fk_ProdUsu` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`),
  ADD CONSTRAINT `fk_UsuProd` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Restrições para tabelas `subcateg`
--
ALTER TABLE `subcateg`
  ADD CONSTRAINT `FK_Departamento` FOREIGN KEY (`depart_id`) REFERENCES `departamento` (`depart_id`);

--
-- Restrições para tabelas `subcidade`
--
ALTER TABLE `subcidade`
  ADD CONSTRAINT `fk_SubCid` FOREIGN KEY (`cid_id`) REFERENCES `cidade` (`cid_id`),
  ADD CONSTRAINT `fk_SubEst` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`);

--
-- Restrições para tabelas `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `fk_TipoTel` FOREIGN KEY (`tpu_tel`) REFERENCES `tipo_tel` (`tpu_tel_id`),
  ADD CONSTRAINT `fk_usuarioTel` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Tipo` FOREIGN KEY (`usu_tipo`) REFERENCES `tipousu` (`tpu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;