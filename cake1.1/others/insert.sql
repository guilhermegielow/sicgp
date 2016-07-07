INSERT INTO `usuarios` (`id`, `departamento_id`, `ds_usuario`, `ds_senha`, `nm_usuario`, `ds_email`, `dt_alt_senha`, `prazo_senha`, `dt_fim_usuario`, `ativo`, `nr_telefone`, `created`, `modified`, `user_created`, `user_modified`) VALUES 
(1, 1, 'ggielow', '123', 'Guilherme Gielow', 'guilhermegielow@gmail.com', '2008-12-31', 30, '2008-12-31', 1, 33292322, '2008-03-19 22:06:24', '2008-05-19 14:50:33', NULL, 'agielow'),
(2, 1, 'agielow', '123', 'Alexandre Gielow', 'guilhermegielow@gmail.com', '1969-12-31', 30, '1969-12-31', 1, 33216789, '2008-03-21 17:12:52', '2008-05-19 08:04:25', NULL, 'agielow'),
(3, 1, 'wgielow', '123', 'Wilhelm Gielow', 'guilhermegielow@gmail.com', '2008-12-31', 30, '2008-12-31', 1, 33213567, '2008-05-19 08:05:37', '2008-05-19 08:05:37', 'agielow', 'agielow'),
(4, 2, 'sbugmann', '123', 'Simone Bugmann', 'simoneflower@gmail.com', '0000-00-00', 30, '0000-00-00', 1, 33214567, '2008-05-19 08:06:26', '2008-06-22 16:26:19', 'agielow', 'agielow'),
(5, 3, 'dgielow', '123', 'Daniel Gielow', 'guilhermegielow@gmail.com', '0000-00-00', 30, '0000-00-00', 1, 33213456, '2008-05-21 08:51:32', '2008-05-21 08:51:32', 'agielow', 'agielow'),
(6, 4, 'rgielow', '123', 'Roseane Gielow', 'guilhermegielow@gmail.com', '0000-00-00', 30, '0000-00-00', 1, 3321, '2008-05-26 09:09:35', '2008-06-22 12:27:43', 'agielow', 'agielow');

INSERT INTO `aros` (`id`, `foreign_key`, `alias`, `lft`, `rght`) VALUES 
(2, 2, 'grupo.administrador', 2, 100),
(3, 3, 'grupo.gerente', 101, 500),
(4, 4, 'grupo.analista', 501, 800),
(5, 5, 'grupo.controle', 801, 999),
(6, 101, 'agielow', 3, 4),
(7, 102, 'ggielow', 102, 103),
(8, 103, 'wgielow', 502, 503),
(9, 104, 'sbugmann', 802, 803),
(10, 6, 'grupo.patrocinador', 1000, 1200),
(11, 105, 'dgielow', 1001, 1002);

INSERT INTO `acos` (`id`, `object_id`, `alias`, `lft`, `rght`) VALUES 
(1, 1, '/', 1, 1000),
(2, 2, '/projetos', 2, 3),
(3, 3, '/usuarios', 3, 4),
(4, 4, '/departamentos', 5, 6),
(5, 5, '/acoes', 7, 8),
(6, 6, '/acoesrelatorios', 9, 10),
(7, 7, '/acos', 11, 12),
(8, 8, '/alteracoes', 13, 14),
(9, 9, '/anexos', 15, 16),
(10, 10, '/aros', 17, 18),
(11, 11, '/assuntostratados', 19, 20),
(12, 12, '/atasreunioes', 21, 22),
(13, 13, '/atividades', 23, 24),
(14, 14, '/atividades_estudosviabilidades_recursos', 25, 26),
(15, 15, '/contascustos', 27, 28),
(16, 16, '/controlesmudancas', 29, 30),
(17, 17, '/criteriosaceitacoes', 31, 32),
(18, 18, '/cronogramas', 33, 34),
(19, 19, '/decisoes', 35, 36),
(20, 20, '/declaracoesescopos', 37, 38),
(21, 21, '/dicionarioseaps', 39, 40),
(22, 22, '/elementoseaps', 41, 42),
(23, 23, '/elementosrelatorios', 43, 44),
(24, 24, '/dicionarioseaps', 45, 46),
(25, 25, '/escoposnaoincluidos', 47, 48),
(26, 26, '/estados', 49, 50),
(27, 27, '/estrategiasconducoes', 51, 52),
(28, 28, '/estudosviabilidades', 53, 54),
(29, 29, '/fatorescriticos', 55, 56),
(30, 30, '/forcas', 57, 58),
(31, 31, '/fornecedores', 59, 60),
(32, 32, '/gruposrecursos', 61, 62),
(78, 78, '/estudosviabilidades/classificarcontabil', 153, 154),
(34, 34, '/historicos', 65, 66),
(35, 35, '/itensmelhoras', 67, 68),
(36, 36, '/itenssucessos', 69, 70),
(37, 37, '/dicionarioseaps', 71, 72),
(38, 38, '/justificativas', 73, 74),
(39, 39, '/licoesaprendidas', 75, 76),
(40, 40, '/mapascomunicacoes', 77, 78),
(41, 41, '/marcos', 79, 80),
(42, 42, '/mensagens', 81, 82),
(43, 43, '/objetivos', 83, 84),
(44, 44, '/objetivosescopos', 85, 86),
(45, 45, '/obstaculoscriticos', 87, 88),
(46, 46, '/oportunidades', 89, 90),
(47, 47, '/orcamentos', 91, 92),
(48, 48, '/passosworkflows', 93, 94),
(49, 49, '/planosaquisicoes', 95, 96),
(50, 50, '/planoscomunicacoes', 97, 98),
(51, 51, '/planoscustos', 99, 100),
(52, 52, '/planosprojetos', 101, 102),
(53, 53, '/premissas', 103, 104),
(54, 54, '/prioridades', 105, 106),
(55, 55, '/processosaquisicoes', 107, 108),
(56, 56, '/produtos', 109, 110),
(57, 57, '/produtosescopos', 111, 112),
(58, 58, '/recomendacoes', 113, 114),
(59, 59, '/recursos', 115, 116),
(60, 60, '/relatoriosdesempenhos', 117, 118),
(61, 61, '/requisitos', 119, 120),
(62, 62, '/responsabilidades', 121, 122),
(63, 63, '/restricoes', 123, 124),
(64, 64, '/restricoesescopos', 125, 126),
(65, 65, '/servicos', 127, 128),
(66, 66, '/servicosescopos', 129, 130),
(67, 67, '/termosaceitesprojetos', 131, 132),
(68, 68, '/tiposatividades', 133, 134),
(69, 69, '/tiposcomunicacoes', 135, 136),
(70, 70, '/tiposcontas', 137, 138),
(71, 71, '/tiposespecificacoes', 139, 140),
(72, 72, '/tiposmudancas', 141, 142),
(73, 73, '/tiposrecursosviabilidades', 143, 144),
(74, 74, '/tiposresponsabilidades', 145, 146),
(75, 75, '/tiposreunioes', 147, 148),
(76, 76, '/tiposservicos', 149, 150),
(77, 77, '/unidades', 151, 152),
(79, 79, '/elementoseaps/atualizareap', 155, 156),
(80, 80, '/mapas', 153, 154),
(81, 81, '/mensagens', 155, 156);

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES 
(2, 3, 2, 1, 1, 1, 1),
(3, 2, 3, 1, 1, 1, 1),
(4, 2, 4, 1, 1, 1, 1),
(5, 2, 7, 1, 1, 1, 1),
(6, 2, 10, 1, 1, 1, 1),
(7, 2, 75, 1, 1, 1, 1),
(8, 2, 54, 1, 1, 1, 1),
(9, 2, 72, 1, 1, 1, 1),
(10, 2, 15, 1, 1, 1, 1),
(11, 2, 68, 1, 1, 1, 1),
(12, 2, 76, 1, 1, 1, 1),
(13, 2, 32, 1, 1, 1, 1),
(14, 2, 31, 1, 1, 1, 1),
(15, 2, 77, 1, 1, 1, 1),
(16, 2, 26, 1, 1, 1, 1),
(17, 2, 73, 1, 1, 1, 1),
(18, 2, 70, 1, 1, 1, 1),
(19, 2, 69, 1, 1, 1, 1),
(20, 2, 71, 1, 1, 1, 1),
(21, 4, 79, 1, 1, 1, 1),
(22, 5, 78, 1, 1, 1, 1),
(23, 3, 22, 1, 1, 1, 1),
(24, 3, 79, 1, 1, 1, 1),
(25, 3, 5, 1, 1, 1, 1),
(26, 3, 6, 1, 1, 1, 1),
(27, 3, 8, 1, 1, 1, 1),
(28, 3, 9, 1, 1, 1, 1),
(29, 3, 11, 1, 1, 1, 1),
(30, 3, 12, 1, 1, 1, 1),
(31, 3, 13, 1, 1, 1, 1),
(32, 3, 14, 1, 1, 1, 1),
(33, 3, 16, 1, 1, 1, 1),
(34, 3, 17, 1, 1, 1, 1),
(35, 3, 18, 1, 1, 1, 1),
(36, 3, 19, 1, 1, 1, 1),
(37, 3, 20, 1, 1, 1, 1),
(38, 3, 21, 1, 1, 1, 1),
(39, 3, 23, 1, 1, 1, 1),
(40, 3, 24, 1, 1, 1, 1),
(41, 3, 25, 1, 1, 1, 1),
(42, 3, 27, 1, 1, 1, 1),
(43, 3, 28, 1, 1, 1, 1),
(44, 3, 29, 1, 1, 1, 1),
(45, 3, 30, 1, 1, 1, 1),
(46, 3, 35, 1, 1, 1, 1),
(47, 3, 36, 1, 1, 1, 1),
(48, 3, 38, 1, 1, 1, 1),
(49, 3, 39, 1, 1, 1, 1),
(50, 3, 40, 1, 1, 1, 1),
(51, 3, 41, 1, 1, 1, 1),
(52, 3, 43, 1, 1, 1, 1),
(53, 3, 44, 1, 1, 1, 1),
(54, 3, 45, 1, 1, 1, 1),
(55, 3, 46, 1, 1, 1, 1),
(56, 3, 47, 1, 1, 1, 1),
(57, 3, 48, 1, 1, 1, 1),
(58, 3, 49, 1, 1, 1, 1),
(59, 3, 50, 1, 1, 1, 1),
(60, 3, 51, 1, 1, 1, 1),
(61, 3, 52, 1, 1, 1, 1),
(62, 3, 53, 1, 1, 1, 1),
(63, 3, 55, 1, 1, 1, 1),
(64, 3, 56, 1, 1, 1, 1),
(65, 3, 57, 1, 1, 1, 1),
(66, 3, 58, 1, 1, 1, 1),
(67, 3, 59, 1, 1, 1, 1),
(68, 3, 60, 1, 1, 1, 1),
(69, 3, 61, 1, 1, 1, 1),
(70, 3, 62, 1, 1, 1, 1),
(71, 3, 63, 1, 1, 1, 1),
(72, 3, 64, 1, 1, 1, 1),
(73, 3, 65, 1, 1, 1, 1),
(74, 3, 66, 1, 1, 1, 1),
(75, 3, 67, 1, 1, 1, 1),
(77, 4, 80, 1, 1, 1, 1),
(78, 4, 79, 1, 1, 1, 1),
(79, 2, 81, 1, 1, 1, 1),
(80, 2, 74, 1, 1, 1, 1);


