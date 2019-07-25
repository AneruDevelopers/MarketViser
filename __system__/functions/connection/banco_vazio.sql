-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 25-Jul-2019 às 20:51
-- Versão do servidor: 5.7.26
-- versão do PHP: 7.3.5

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

DROP TABLE IF EXISTS `armazem`;
CREATE TABLE IF NOT EXISTS `armazem` (
  `armazem_id` int(11) NOT NULL AUTO_INCREMENT,
  `armazem_nome` varchar(150) NOT NULL,
  `armazem_supervisor` varchar(150) NOT NULL,
  `armazem_supervisor_cpf` char(14) NOT NULL,
  `armazem_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `cidade_id` int(11) NOT NULL,
  PRIMARY KEY (`armazem_id`),
  KEY `fk_CidArm` (`cidade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimento`
--

DROP TABLE IF EXISTS `atendimento`;
CREATE TABLE IF NOT EXISTS `atendimento` (
  `id_atd` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usu` varchar(50) NOT NULL,
  `email_usu` varchar(150) NOT NULL,
  `tp_problema` varchar(100) NOT NULL,
  `desc_problema` text,
  `dataenv_pro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_atd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atend_resposta`
--

DROP TABLE IF EXISTS `atend_resposta`;
CREATE TABLE IF NOT EXISTS `atend_resposta` (
  `resp_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_atd` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `resp_atend` text NOT NULL,
  `registro_resp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`resp_id`),
  KEY `fk_AtendResp` (`id_atd`),
  KEY `fk_FuncResp` (`funcionario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_nome` varchar(50) DEFAULT NULL,
  `banner_path` varchar(70) NOT NULL,
  `banner_status` bit(1) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categ`
--

DROP TABLE IF EXISTS `categ`;
CREATE TABLE IF NOT EXISTS `categ` (
  `categ_id` int(11) NOT NULL AUTO_INCREMENT,
  `categ_nome` varchar(30) NOT NULL,
  `subcateg_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`categ_id`),
  KEY `FK_SubCateg` (`subcateg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

DROP TABLE IF EXISTS `cidade`;
CREATE TABLE IF NOT EXISTS `cidade` (
  `cid_id` int(11) NOT NULL AUTO_INCREMENT,
  `cid_nome` varchar(50) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`cid_id`),
  KEY `fk_Est` (`est_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `compra_id` int(11) NOT NULL AUTO_INCREMENT,
  `armazem_id` int(11) NOT NULL,
  `compra_hash` varchar(255) NOT NULL,
  `compra_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `compra_total` decimal(10,2) NOT NULL,
  `compra_link` varchar(255) DEFAULT NULL,
  `usu_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `forma_id` int(11) NOT NULL,
  PRIMARY KEY (`compra_id`),
  KEY `fk_UsuCompra` (`usu_id`),
  KEY `fk_CompraStatus` (`status_id`),
  KEY `fk_CompraPag` (`forma_id`),
  KEY `fk_CompArm` (`armazem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conf_mail`
--

DROP TABLE IF EXISTS `conf_mail`;
CREATE TABLE IF NOT EXISTS `conf_mail` (
  `cf_id` int(11) NOT NULL AUTO_INCREMENT,
  `cf_link` varchar(255) NOT NULL,
  `cf_status` bit(1) NOT NULL DEFAULT b'0',
  `cf_expiracao` datetime DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`cf_id`),
  KEY `fk_usu_conf` (`usu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom`
--

DROP TABLE IF EXISTS `cupom`;
CREATE TABLE IF NOT EXISTS `cupom` (
  `cupom_id` int(11) NOT NULL AUTO_INCREMENT,
  `cupom_codigo` varchar(30) NOT NULL,
  `cupom_desconto_porcent` float NOT NULL,
  PRIMARY KEY (`cupom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_armazem`
--

DROP TABLE IF EXISTS `dados_armazem`;
CREATE TABLE IF NOT EXISTS `dados_armazem` (
  `dados_id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `armazem_id` int(11) NOT NULL,
  `produto_qtd` int(11) NOT NULL,
  `produto_preco` decimal(10,2) NOT NULL,
  `produto_desconto_porcent` float DEFAULT NULL,
  PRIMARY KEY (`dados_id`),
  KEY `fk_ProdArm` (`produto_id`),
  KEY `fk_ArmProd` (`armazem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_atend_func`
--

DROP TABLE IF EXISTS `dados_atend_func`;
CREATE TABLE IF NOT EXISTS `dados_atend_func` (
  `dados_id` int(11) NOT NULL AUTO_INCREMENT,
  `atendimento_id` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  PRIMARY KEY (`dados_id`),
  KEY `fk_AtdFunc` (`atendimento_id`),
  KEY `fk_FuncAtd` (`funcionario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_entrega`
--

DROP TABLE IF EXISTS `dados_entrega`;
CREATE TABLE IF NOT EXISTS `dados_entrega` (
  `dados_id` int(11) NOT NULL AUTO_INCREMENT,
  `entrega_id` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  PRIMARY KEY (`dados_id`),
  KEY `fk_DataCompra` (`entrega_id`),
  KEY `fk_DataFunc` (`funcionario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_horario_entrega`
--

DROP TABLE IF EXISTS `dados_horario_entrega`;
CREATE TABLE IF NOT EXISTS `dados_horario_entrega` (
  `dados_id` int(11) NOT NULL AUTO_INCREMENT,
  `dados_horario` int(11) NOT NULL,
  `dados_armazem` int(11) NOT NULL,
  PRIMARY KEY (`dados_id`),
  KEY `fk_DadoHora` (`dados_horario`),
  KEY `fk_DadoArm` (`dados_armazem`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_horario_subcidade`
--

DROP TABLE IF EXISTS `dados_horario_subcidade`;
CREATE TABLE IF NOT EXISTS `dados_horario_subcidade` (
  `dados_id` int(11) NOT NULL AUTO_INCREMENT,
  `dados_horario` int(11) NOT NULL,
  `dados_subcidade` int(11) NOT NULL,
  PRIMARY KEY (`dados_id`),
  KEY `fk_SubHor` (`dados_horario`),
  KEY `fk_SubSub` (`dados_subcidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_promocao`
--

DROP TABLE IF EXISTS `dados_promocao`;
CREATE TABLE IF NOT EXISTS `dados_promocao` (
  `dados_id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `armazem_id` int(11) NOT NULL,
  `promo_id` int(11) NOT NULL,
  PRIMARY KEY (`dados_id`),
  KEY `fk_ProdPromo` (`produto_id`),
  KEY `fk_PromoArm` (`armazem_id`),
  KEY `fk_PromoProd` (`promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `depart_id` int(11) NOT NULL AUTO_INCREMENT,
  `depart_nome` varchar(30) NOT NULL,
  `depart_icon` varchar(70) NOT NULL,
  `depart_desc` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`depart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `duvida_frequente`
--

DROP TABLE IF EXISTS `duvida_frequente`;
CREATE TABLE IF NOT EXISTS `duvida_frequente` (
  `duvida_id` int(11) NOT NULL AUTO_INCREMENT,
  `duvida_pergunta` varchar(255) NOT NULL,
  `duvida_resposta` mediumtext NOT NULL,
  PRIMARY KEY (`duvida_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entrega`
--

DROP TABLE IF EXISTS `entrega`;
CREATE TABLE IF NOT EXISTS `entrega` (
  `entrega_id` int(11) NOT NULL AUTO_INCREMENT,
  `compra_id` int(11) NOT NULL,
  `entrega_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `entrega_horario` datetime NOT NULL,
  `entrega_cep` char(9) NOT NULL,
  `entrega_end` varchar(150) NOT NULL,
  `entrega_num` int(11) NOT NULL,
  `entrega_complemento` varchar(150) DEFAULT NULL,
  `entrega_bairro` varchar(50) NOT NULL,
  `entrega_cidade` varchar(50) NOT NULL,
  `entrega_uf` char(2) NOT NULL,
  PRIMARY KEY (`entrega_id`),
  KEY `fk_EntCompra` (`compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE IF NOT EXISTS `estado` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_uf` char(2) NOT NULL,
  PRIMARY KEY (`est_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pag`
--

DROP TABLE IF EXISTS `forma_pag`;
CREATE TABLE IF NOT EXISTS `forma_pag` (
  `forma_id` int(11) NOT NULL AUTO_INCREMENT,
  `forma_nome` varchar(40) NOT NULL,
  PRIMARY KEY (`forma_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor_nome` varchar(60) NOT NULL,
  `fornecedor_responsavel_nome` varchar(150) NOT NULL,
  `fornecedor_cnpj` char(18) NOT NULL,
  `fornecedor_data_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fornecedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `forn_prod`
--

DROP TABLE IF EXISTS `forn_prod`;
CREATE TABLE IF NOT EXISTS `forn_prod` (
  `forn_prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `produto_qtd` int(11) NOT NULL,
  `forn_prod_data_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `armazem_id` int(11) NOT NULL,
  PRIMARY KEY (`forn_prod_id`),
  KEY `fk_FornProd` (`fornecedor_id`),
  KEY `fk_ProdForn` (`produto_id`),
  KEY `fk_FornArm` (`armazem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `funcionario_id` int(11) NOT NULL AUTO_INCREMENT,
  `funcionario_nome` varchar(150) NOT NULL,
  `funcionario_email` varchar(200) DEFAULT NULL,
  `funcionario_senha` varchar(255) NOT NULL,
  `funcionario_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `funcionario_cpf` char(14) NOT NULL,
  `funcionario_datanasc` date NOT NULL,
  `funcionario_setor` int(11) NOT NULL,
  PRIMARY KEY (`funcionario_id`),
  KEY `fk_FuncSetor` (`funcionario_setor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarios_entrega`
--

DROP TABLE IF EXISTS `horarios_entrega`;
CREATE TABLE IF NOT EXISTS `horarios_entrega` (
  `hora_id` int(11) NOT NULL AUTO_INCREMENT,
  `hora` time NOT NULL,
  `dia` int(1) NOT NULL,
  PRIMARY KEY (`hora_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_compra`
--

DROP TABLE IF EXISTS `lista_compra`;
CREATE TABLE IF NOT EXISTS `lista_compra` (
  `lista_id` int(11) NOT NULL AUTO_INCREMENT,
  `compra_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `produto_qtd` int(11) NOT NULL,
  PRIMARY KEY (`lista_id`),
  KEY `fk_CompraLista` (`compra_id`),
  KEY `fk_ListaProd` (`produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca_prod`
--

DROP TABLE IF EXISTS `marca_prod`;
CREATE TABLE IF NOT EXISTS `marca_prod` (
  `marca_id` int(11) NOT NULL AUTO_INCREMENT,
  `marca_nome` varchar(30) NOT NULL,
  `marca_promocao` int(3) DEFAULT NULL,
  PRIMARY KEY (`marca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagem`
--

DROP TABLE IF EXISTS `postagem`;
CREATE TABLE IF NOT EXISTS `postagem` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `post_title` varchar(255) NOT NULL,
  `post_text` text NOT NULL,
  `post_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `produto_id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_nome` varchar(100) NOT NULL,
  `produto_descricao` text,
  `produto_img` varchar(255) NOT NULL,
  `produto_marca` int(11) NOT NULL,
  `produto_tamanho` varchar(30) NOT NULL,
  `produto_categ` int(11) NOT NULL,
  PRIMARY KEY (`produto_id`),
  KEY `fk_MarcaProd` (`produto_marca`),
  KEY `fk_CategProd` (`produto_categ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_favorito`
--

DROP TABLE IF EXISTS `produtos_favorito`;
CREATE TABLE IF NOT EXISTS `produtos_favorito` (
  `favorito_id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`favorito_id`),
  KEY `fk_ProdUsu` (`produto_id`),
  KEY `fk_UsuProd` (`usu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `promocao_temp`
--

DROP TABLE IF EXISTS `promocao_temp`;
CREATE TABLE IF NOT EXISTS `promocao_temp` (
  `promo_id` int(11) NOT NULL AUTO_INCREMENT,
  `promo_nome` varchar(40) NOT NULL,
  `promo_subtit` varchar(100) DEFAULT NULL,
  `promo_desconto` int(3) NOT NULL,
  `promo_expira` datetime DEFAULT NULL,
  `promo_status` bit(1) NOT NULL,
  PRIMARY KEY (`promo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `setor`
--

DROP TABLE IF EXISTS `setor`;
CREATE TABLE IF NOT EXISTS `setor` (
  `setor_id` int(11) NOT NULL AUTO_INCREMENT,
  `setor_nome` varchar(50) NOT NULL,
  `setor_permicao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`setor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_compra`
--

DROP TABLE IF EXISTS `status_compra`;
CREATE TABLE IF NOT EXISTS `status_compra` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_nome` varchar(40) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcateg`
--

DROP TABLE IF EXISTS `subcateg`;
CREATE TABLE IF NOT EXISTS `subcateg` (
  `subcateg_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcateg_nome` varchar(50) NOT NULL,
  `depart_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`subcateg_id`),
  KEY `FK_Departamento` (`depart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcidade`
--

DROP TABLE IF EXISTS `subcidade`;
CREATE TABLE IF NOT EXISTS `subcidade` (
  `subcid_id` int(11) NOT NULL AUTO_INCREMENT,
  `subcid_nome` varchar(30) NOT NULL,
  `subcid_frete` decimal(10,2) DEFAULT NULL,
  `cid_id` int(11) NOT NULL,
  `est_id` int(11) NOT NULL,
  PRIMARY KEY (`subcid_id`),
  KEY `fk_SubCid` (`cid_id`),
  KEY `fk_SubEst` (`est_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

DROP TABLE IF EXISTS `telefone`;
CREATE TABLE IF NOT EXISTS `telefone` (
  `tel_id` int(11) NOT NULL AUTO_INCREMENT,
  `tel_num` varchar(15) NOT NULL,
  `tpu_tel` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  PRIMARY KEY (`tel_id`),
  KEY `fk_TipoTel` (`tpu_tel`),
  KEY `fk_usuarioTel` (`usu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipousu`
--

DROP TABLE IF EXISTS `tipousu`;
CREATE TABLE IF NOT EXISTS `tipousu` (
  `tpu_id` int(11) NOT NULL AUTO_INCREMENT,
  `tpu_usu_nome` varchar(30) NOT NULL,
  PRIMARY KEY (`tpu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_tel`
--

DROP TABLE IF EXISTS `tipo_tel`;
CREATE TABLE IF NOT EXISTS `tipo_tel` (
  `tpu_tel_id` int(11) NOT NULL AUTO_INCREMENT,
  `tpu_tel_nome` varchar(30) NOT NULL,
  PRIMARY KEY (`tpu_tel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `usu_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usu_id`),
  KEY `fk_Tipo` (`usu_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produto`
--
ALTER TABLE `produto` ADD FULLTEXT KEY `produto_nome` (`produto_nome`,`produto_descricao`,`produto_tamanho`);

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
  ADD CONSTRAINT `fk_CompArm` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`armazem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_CompraPag` FOREIGN KEY (`forma_id`) REFERENCES `forma_pag` (`forma_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_CompraStatus` FOREIGN KEY (`status_id`) REFERENCES `status_compra` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_UsuCompra` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `conf_mail`
--
ALTER TABLE `conf_mail`
  ADD CONSTRAINT `fk_usu_conf` FOREIGN KEY (`usu_id`) REFERENCES `usuario` (`usu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `dados_armazem`
--
ALTER TABLE `dados_armazem`
  ADD CONSTRAINT `fk_ArmProd` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`armazem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `fk_DataEnt` FOREIGN KEY (`entrega_id`) REFERENCES `entrega` (`entrega_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_DataFunc` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionario` (`funcionario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `dados_horario_entrega`
--
ALTER TABLE `dados_horario_entrega`
  ADD CONSTRAINT `fk_DadoArm` FOREIGN KEY (`dados_armazem`) REFERENCES `armazem` (`armazem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_DadoHora` FOREIGN KEY (`dados_horario`) REFERENCES `horarios_entrega` (`hora_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `dados_horario_subcidade`
--
ALTER TABLE `dados_horario_subcidade`
  ADD CONSTRAINT `fk_SubHor` FOREIGN KEY (`dados_horario`) REFERENCES `horarios_entrega` (`hora_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_SubSub` FOREIGN KEY (`dados_subcidade`) REFERENCES `subcidade` (`subcid_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_FornArm` FOREIGN KEY (`armazem_id`) REFERENCES `armazem` (`armazem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_FornProd` FOREIGN KEY (`fornecedor_id`) REFERENCES `fornecedor` (`fornecedor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ProdForn` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_FuncSetor` FOREIGN KEY (`funcionario_setor`) REFERENCES `setor` (`setor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `lista_compra`
--
ALTER TABLE `lista_compra`
  ADD CONSTRAINT `fk_CompraLista` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`compra_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ListaProd` FOREIGN KEY (`produto_id`) REFERENCES `produto` (`produto_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_CategProd` FOREIGN KEY (`produto_categ`) REFERENCES `categ` (`categ_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_MarcaProd` FOREIGN KEY (`produto_marca`) REFERENCES `marca_prod` (`marca_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FK_Departamento` FOREIGN KEY (`depart_id`) REFERENCES `departamento` (`depart_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `subcidade`
--
ALTER TABLE `subcidade`
  ADD CONSTRAINT `fk_SubCid` FOREIGN KEY (`cid_id`) REFERENCES `cidade` (`cid_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_SubEst` FOREIGN KEY (`est_id`) REFERENCES `estado` (`est_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_Tipo` FOREIGN KEY (`usu_tipo`) REFERENCES `tipousu` (`tpu_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
