CREATE TABLE `instrumento` (
  `ID` int(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL,
  `preco` int(6) NOT NULL,
  `quantidade` int(4) NOT NULL,
  `entrada` char(1) NOT NULL,
  `imagem` varchar(100) DEFAULT NULL
)