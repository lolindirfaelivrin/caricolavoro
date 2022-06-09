CREATE TABLE IF NOT EXISTS `carico_lavoro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `giorno` date NOT NULL,
  `inizio` time NOT NULL,
  `fine` time NOT NULL,
  `rpe` int NOT NULL,
  `allenamento` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `carico_lavoro`
--

INSERT INTO `carico_lavoro` (`id`, `giorno`, `inizio`, `fine`, `rpe`, `allenamento`, `tipo`, `modifica`) VALUES
(1, '2022-06-09', '15:45:00', '17:45:00', 7, 'wl', 'allenamento', '2022-06-09 20:15:48');
