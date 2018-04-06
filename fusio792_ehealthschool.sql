/*
Navicat MySQL Data Transfer

Source Server         : fusion2
Source Server Version : 50551
Source Host           : fusioncomunicacao.com:3306
Source Database       : fusio792_ehealthschool

Target Server Type    : MYSQL
Target Server Version : 50551
File Encoding         : 65001

Date: 2018-04-06 14:01:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `banners`
-- ----------------------------
DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `is_mobile` tinyint(4) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of banners
-- ----------------------------
INSERT INTO `banners` VALUES ('1', '2018-02-23 15:00:23', '2018-02-25 16:47:12', '62158ff8cf5b5fc54b785bd2dc6e6d3d.jpg', null, '', '0', null);
INSERT INTO `banners` VALUES ('2', '2018-02-23 15:00:23', '2018-02-25 16:47:21', 'ebfbdabef533cc0c8f8394f257f32cef.jpg', null, '', '0', null);
INSERT INTO `banners` VALUES ('3', '2018-02-23 15:00:23', '2018-02-25 16:47:27', 'e56e1aab3d2b2f756db35d279f0c7020.jpg', null, '', '0', null);
INSERT INTO `banners` VALUES ('4', '2018-02-23 15:00:35', '2018-02-25 16:48:01', '02c8d101f92407f738da3c98cab99f31.jpg', null, '', '1', null);
INSERT INTO `banners` VALUES ('5', '2018-02-23 15:00:35', '2018-02-25 16:48:05', '21f943e8e98f8625b7ba3691a16de838.jpg', null, '', '1', null);
INSERT INTO `banners` VALUES ('6', '2018-02-23 15:00:35', '2018-02-25 16:48:08', '22fff0d08e2ffd6bac83fed7c5e0a8c9.jpg', null, '', '1', null);

-- ----------------------------
-- Table structure for `course_categories`
-- ----------------------------
DROP TABLE IF EXISTS `course_categories`;
CREATE TABLE `course_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of course_categories
-- ----------------------------
INSERT INTO `course_categories` VALUES ('1', null, '2018-02-07 22:57:49', 'Dermatologia');

-- ----------------------------
-- Table structure for `courses`
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `course_details` text,
  `curricular_grade` text,
  `more_information` text,
  `classrooms` int(11) DEFAULT NULL,
  `modules` int(11) DEFAULT NULL,
  `learning_objects` int(11) DEFAULT NULL,
  `workload` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `certificate` tinyint(4) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `value` decimal(20,2) DEFAULT NULL,
  `teachers` varchar(255) DEFAULT NULL,
  `course_category_id` int(11) DEFAULT NULL,
  `eadbox_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES ('1', '2018-02-07 23:24:52', '2018-02-27 10:04:15', 'curso_de_alopecias', 'wGJLb0-OKe4', 'Curso de Alopecias', '<p>O curso é destinado a associados e residentes da SBD ou afiliados da ABCRC. Para se inscrever com os valores acima favor enviar um email para contato@ehealthschool.com.brinformando seu nome completo, CRM e comprovante de sua afiliação.</p>', '<p><b>Detalhes do Curso</b></p>\r\n<p>O curso é destinado a associados e residentes da SBD ou afiliados da ABCRC. Para se inscrever com os valores acima favor enviar um email para contato@ehealthschool.com.brinformando seu nome completo, CRM e comprovante de sua afiliação.</p>\r\n\r\n<div class=\"accordions\">\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">Sobre o curso</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>O curso de alopecia da eHealthSchool é totalmente OnLine.</p>\r\n			<p>Serão 4 módulos com 8 aulas em cada. O primeiro módulo vai ao ar no dia 08 de setembro e o último no dia 20 de outubro e o aluno poderá assistir as aulas de cada módulo por 4 semanas.<br>\r\n			Em um grupo de discussão secreto do Facebook serão discutidas eventuais dúvidas.</p>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">A quem se destina</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>Dermatologistas aspirantes, contribuintes e titulares da SBD, dermatologistas com RQE e residentes dos serviços credenciados da Sociedade Brasileira de Dermatologia (SBD) e médicos afiliados a Associação Brasileira de Cirurgia da Restauração Capilar (ABCRC).</p>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">O que você vai aprender</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>O objetivo do curso é que o aluno se sinta confortável para o diagnóstico e tratamento de um paciente com alopecia e que o conhecimento adquirido no curso de Alopecias OnLine possa ser fonte de inspiração para mais estudos e especialização na área das doenças do cabelo e couro cabeludo.</p>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">Pré requisitos</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>Ser médico dermatologista da SBD, residente de dermatologia de serviço credenciado ou médico afiliado da ABCRC. Não há necessidade de conhecimento prévio em doenças dos cabelos ou tricoscopia.</p>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">Investimento</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>Nova turma em 8 de Setemmbro de 2017</p>\r\n			<p>Inscrições até 13 de agosto (30% OFF) &nbsp;– De R$ 1380,00 por R$ 966,00</p>\r\n			<p>14 de Agosto até 7 de Setembro (20% OFF) De R$ 1380,00 por R$ 1104,00</p>\r\n			<p>Depois do início do curso valor final – R$ 1380,00</p>\r\n			<p>O curso é destinado a associados e residentes da SBD ou afiliados da ABCRC. Para se inscrever com os valores acima favor enviar um email para&nbsp;contato@ehealthschool.com.br&nbsp;informando seu nome completo, CRM e comprovante de sua afiliação.</p>\r\n			<p>Para outros médicos o valor é de: R$ 10.000,00</p>\r\n			<p>*Obs: Se o aluno se inscrever e não comprovar a sua afiliação, será cobrado uma taxa de R$ 380,00 (trezentos e oitenta) reais para ser realizado o extorno ou o valor para outra categoria de médicos.</p>\r\n		</div>\r\n	</div>\r\n</div>', '<p><b>Introdução</b></p><ul>    <li>Protocolo no atendimento do paciente com alopecia</li>    <li>Técnicas e equipamentos para fotografia e tricoscopia</li>    <li>Anatomia e ciclo folicular</li>    <li>Fisiopatologia hormonal e genética na AAG</li>    <li>Al. androgenética: diagnóstico, conduta e diagnósticos diferenciais</li>    <li>Eflúvio telógeno diagnóstico e conduta</li>    <li>Exames laboratoriais na AAG e ET: o que pedir?</li>    <li>Alopecia Senescente e Envelhecimento capilar</li></ul><p></p><p><b>Alopecia androgenética e Eflúvio telógeno</b></p><ul>    <li>Tricoscopia e seguimento das alopecias difusas (AGA e ET)</li>    <li>Minoxidil e outros tópicos</li>    <li>Anti-andrôgenos orais em homens: tratamento e cuidados</li>    <li>Anti-andrôgenos orais em mulheres: tratamento e cuidados</li>    <li>Cosmética capilar</li>    <li>Mesoterapia, Microagulhamento, MMP®, LED e laser</li>    <li>Transplante capilar quando indicar?</li>    <li>Camuflagem e micropigmentação</li></ul><p></p><p><b>Alopecias cicatriciais linfocíticas e Alopecia por tração</b></p><ul>    <li>Abordagem ao paciente com LPP e AFF</li>    <li>Acometimento cutâneo no LPP e AFF</li>    <li>Abordagem ao paciente com LED no CC</li>    <li>Patogênese e histórico da ACCC</li>    <li>Alopecia por tração: cuidados</li>    <li>Tricoscopia</li>    <li>Estratégias terapêuticas das alopecias cicatriciais</li>    <li>MMP® nas alopecias cicatriciais perspetivas futuras</li></ul><p></p><p><b>Miscelânia</b></p><ul>    <li>Curso de alopecias on line, módulo 4</li>    <li>Alopecia Areata, tricotilomania e tinea capitis</li>    <li>Estratégias terapêuticas na AA</li>    <li>Tinea Capitis</li>    <li>Patogênese das alopecias neutrofílicas</li>    <li>Abordagem e terapêutica das alopecias neutrofílicas</li>    <li>Como e onde biópsiar o couro cabeludo</li>    <li>Nutracêuticos: falando cientificamente</li></ul>', '<p>Não será permitido gravar, filmar ou fotografar qualquer imagem/áudio/vídeo das aulas em qualquer mídia (facebook, Instagram, You Tube ou outras redes sociais) sem prévia autorização, sob pena de multa de 10 vezes o valor normal do curso e rescisão unilateral do contrato com o aluno.</p>', '31', '4', '36', '13:18:30', 'Básico', '0', 'd421b61eb215aac9de90da5ed51764fd.jpeg', '1380.00', '9,8,7,4,5,6', null, '5a8e4981ad6957003fedc18c');
INSERT INTO `courses` VALUES ('2', '2018-02-26 00:59:16', '2018-02-27 10:05:04', 'toxina-botulinica-o-dia-a-dia-do-consultorio-baseado-em-evidencias', '2os2zblkFhY', 'Toxina botulínica: o dia a dia do consultório baseado em evidências', '<p>Este é um curso completo e definitivo sobre toxina botulínica. A programação é completa, com demonstrações práticas e conteúdo teórico de apoio. Todo o curso é baseado na mais recente evidência cientifica.</p>', '<div class=\"accordions\">\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">Sobre o Curso</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>Este é um curso completo e definitivo sobre toxina botulínica. A programação é completa, com demonstrações práticas e conteúdo teórico de apoio. Todo o curso é baseado na mais recente evidência cientifica.</p>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">O que você vai aprender</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>Como otimizar o uso da Toxina botulínica no seu consultório, com novas indicações de uso baseadas em evidências. Sair da mesmice com ciência! Será que você está realmente aproveitando o uso da toxina botulínica na sua rotina? Vamos te abrir um leque de novos usos com seriedade e segurança.</p>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">A quem se destina</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>É exclusivo para dermatologistas aspirantes, afiliados, contribuintes e titulares da Sociedade Brasileira de Dermatologia (SBD), dermatologistas com RQE e residentes dos serviços credenciados da SBD.</p>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">Pré requisitos</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>Ser médico dermatologista ou residente de dermatologia. Não há necessidade de conhecimento prévio em toxina botulínica.</p>\r\n		</div>\r\n	</div>\r\n</div>', '<div class=\"accordions\">\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">MÓDULO I - Princípios básicos</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<ul>\r\n				<li>Conceitos fundamentais: Mecanismo de ação; Indicações e anos de aprovação pelo FDA</li>\r\n				<li>Características das toxinas comercializadas no Brasil: Vamos ver as peculiaridades de cada uma (tamanho do complexo, quantidade de proteína, excipientes)</li>\r\n				<li>Revisando a anatomia das áreas de tratamento facial e cervical: tirando a poeira do seu antigo Atlas de Anatomia, vamos juntos pormenorizar cada músculo!</li>\r\n				<li>Contraindicações, precauções</li>\r\n				<li>Interações medicamentosas</li>\r\n				<li>Zonas de risco: onde é preferível ficar longe!</li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">MÓDULO II – Roteiro básico do procedimento</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<ul>\r\n				<li>Como deve ser a consulta pré-Toxina: Você tem seu checklist pré-procedimento?</li>\r\n				<li>Termo de consentimento informado</li>\r\n				<li>Documentação fotográfica: Poses padronizadas e arquivo das imagens</li>\r\n				<li>Material necessário para a aplicação de toxina</li>\r\n				<li>Reconstituição, concentrações e dosagem: Diluir em quanto? Aplicar com qual seringa?</li>\r\n				<li>Potência, razão de conversão, equivalência de doses: você já se confundiu com as Unidades Speywood? Afinal qual toxina escolher?</li>\r\n				<li>Armazenamento e duração após diluição</li>\r\n				<li>Anestesia: o que fazer para o máximo conforto do seu paciente!</li>\r\n				<li>Técnicas gerais de injeção</li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">MÓDULO III - Demonstração prática de aplicação</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<ul>\r\n				<li>Rugas glabelares</li>\r\n				<li>Rugas frontais</li>\r\n				<li>Lifting de sobrancelhas</li>\r\n				<li>Rugas periorbitárias</li>\r\n				<li>Rugas infraorbitárias</li>\r\n				<li>Rugas nasais</li>\r\n				<li>Rugas labiais</li>\r\n				<li>Sorriso gengival</li>\r\n				<li>Rugas da região das bochechas</li>\r\n				<li>Linhas de marionete (depressor do ângulo da boca)</li>\r\n				<li>Mento</li>\r\n				<li>Terço inferior; Nefertiti; Contorno facial</li>\r\n				<li>Bandas cervicais</li>\r\n				<li>Rugas do colo</li>\r\n				<li>Mesobotox</li>\r\n				<li>Toxina botulínica no HOMEM</li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">MÓDULO V – Cuidados pós aplicação</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<ul>\r\n				<li>Cuidados pós-toxina – o que fazer e o que não fazer para durar mais</li>\r\n				<li>O que esperar de resultados e acompanhamento do paciente</li>\r\n				<li>Combinando tratamentos estéticos e aumentando os resultados:</li>\r\n				<li>Complicações e o que fazer com elas! (relacionadas com a injeção, relacionadas à toxina)</li>\r\n				<li>Blefaroptose: porque aconteceu comigo? Como consertar?</li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">MÓDULO VI – Considerações finais</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<ul>\r\n				<li>Vantagens e desvantagens comparando com outros procedimentos estéticos</li>\r\n				<li>Tratamentos combinados</li>\r\n				<li>Noções básicas de Marketing</li>\r\n				<li>Precificação:  Vamos sim falar de dinheiro!</li>\r\n				<li>Novos produtos e atuais avanços: o que esperar da próxima década?</li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n</div>', '<p>Não será permitido gravar, filmar ou fotografar qualquer imagem/áudio/vídeo das aulas em qualquer mídia (facebook, Instagram, You Tube ou outras redes sociais) sem prévia autorização, sob pena de multa de 10 vezes o valor normal do curso e rescisão unilateral do contrato com o aluno.</p>', '31', '4', '36', '13:18:30', 'Básico', '0', '3020465b86f771665aa41f857e352edd.jpg', '1200.00', '10', null, '5a9493cbad6957005a83bef4');
INSERT INTO `courses` VALUES ('3', '2018-02-26 01:27:32', '2018-02-27 10:04:46', 'toxina-botulinica-o-dia-dia-consultorio-baseado-em-evidencias', 'rbl-iZeeEIc', 'Formulação Magistral: Como otimizar a prescrição do dermatologista', '<p>O curso de cosmecêuticos propiciará aos seus participantes uma visão ampla da habilidade galênica, atualizando-os a oferecer uma prescrição individualizada e moderna para seus pacientes, o que, sem dúvida alguma, ajudará na performance da prática clíni', '<div class=\"accordions\">\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">Sobre o Curso</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>O curso de cosmecêuticos propiciará aos seus participantes uma visão ampla da habilidade galênica, atualizando-os a oferecer uma prescrição individualizada e moderna para seus pacientes, o que, sem dúvida alguma, ajudará na performance da prática clínica diária.</p>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">O que você vai aprender</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>Desde conceitos básicos a avançados de legislação, cosmetotécnica e manipulação de cosmecêuticos, com exemplos de formulações de performance clínica diferenciada.</p>\r\n			<p>A quem se destina: Médicos dermatologistas sócios da SBD e residentes de dermatologia de serviços credenciados da SBD que desejam aprender ou reciclar conhecimentos sobre formulação magistral.</p>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">Pré requisitos</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<p>Ser médico dermatologista ou residente de dermatologia. Não há necessidade de conhecimento prévio em formulação magistral.</p>\r\n		</div>\r\n	</div>\r\n</div>', '<div class=\"accordions\">\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">MÓDULO I - Introdução – 20/04 a 20-05</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<ul>\r\n				<li>Aspectos gerais: conceito, segurança dos princípios e regulamentação</li>\r\n				<li>Aspectos físicos químicos das bases e veículos – Parte 1</li>\r\n				<li>Aspectos físicos químicos das bases e veículos – Parte 2</li>\r\n				<li>Princípios ativos seguros e como combiná-los? – Parte 1</li>\r\n				<li>Princípios ativos seguros e como combiná-los? – Parte 2</li>\r\n				<li>Exercícios de fixação</li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">MÓDULO II – Princípios Ativos I 04/05 a 04/06</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<ul>\r\n				<li>Explorando: Hidratantes</li>\r\n				<li>Explorando: Retinoides</li>\r\n				<li>Explorando: Hidroxiácidos</li>\r\n				<li>Explorando: Antiglicantes</li>\r\n				<li>Explorando: Antioxidantes</li>\r\n				<li>Exercícios de fixação</li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">MÓDULO III – Príncípios ativos II de 18/05 a 18/06</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<ul>\r\n				<li>Explorando: peptídeos</li>\r\n				<li>Explorando: miotensores</li>\r\n				<li>Explorando: fatores de crescimento</li>\r\n				<li>Explorando: filtros solares</li>\r\n				<li>Explorando: limpadores</li>\r\n				<li>Exercícios de fixação</li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<div class=\"accordion\">\r\n		<h3 class=\"no-margin mgb-10\">\r\n			<span class=\"accordion-icon\"></span>\r\n			<a href=\"#\" class=\"accordion-link\">MÓDULO IV – Condições especiais</a>\r\n		</h3>\r\n		<div class=\"accordion-content\">\r\n			<ul> \r\n				<li>Condições especiais: pele sensível</li>\r\n				<li>Condições especiais: idoso</li>\r\n				<li>Condições especiais: gravidez</li>\r\n				<li>Condições especiais: pele étnica</li>\r\n				<li>Condições especiais: pele oleosa e acneica</li>\r\n				<li>Exercícios de fixação e encerramento</li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n</div>', '<p>Não será permitido gravar, filmar ou fotografar qualquer imagem/áudio/vídeo das aulas em qualquer mídia (facebook, Instagram, You Tube ou outras redes sociais) sem prévia autorização, sob pena de multa de 10 vezes o valor normal do curso e rescisão unilateral do contrato com o aluno.</p>', '31', '4', '36', '13:18:30', 'Básico', '0', 'd2c39a205f56a3a8042936e096881ad5.jpg', '1500.00', '11', null, '5a94938c52e88d004a3a1772');

-- ----------------------------
-- Table structure for `newsletters`
-- ----------------------------
DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of newsletters
-- ----------------------------
INSERT INTO `newsletters` VALUES ('5', '2018-02-25 18:55:20', '2018-02-25 18:55:20', 'Alan Quidornne de Souza', '(21) 9999-99999', 'noplayalan@gmail.com');

-- ----------------------------
-- Table structure for `role_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=240;

-- ----------------------------
-- Records of role_permissions
-- ----------------------------
INSERT INTO `role_permissions` VALUES ('1', '0', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '1', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '2', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '3', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '4', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '5', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '6', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '8', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '9', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '10', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '11', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '12', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '13', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '14', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '15', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '16', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '17', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '18', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '19', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '20', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '21', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '22', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '23', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '24', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '25', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '26', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '27', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '28', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '29', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '30', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '31', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '32', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '33', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '34', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '35', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '36', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '37', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '38', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '39', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '40', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '41', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '42', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '43', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '44', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '45', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '46', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '47', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '48', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '49', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '50', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '51', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '52', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '53', '2', null);
INSERT INTO `role_permissions` VALUES ('1', '54', '2', null);
INSERT INTO `role_permissions` VALUES ('2', '0', null, null);
INSERT INTO `role_permissions` VALUES ('2', '1', null, null);
INSERT INTO `role_permissions` VALUES ('2', '2', null, null);
INSERT INTO `role_permissions` VALUES ('2', '3', null, null);
INSERT INTO `role_permissions` VALUES ('2', '4', null, null);
INSERT INTO `role_permissions` VALUES ('2', '5', null, null);
INSERT INTO `role_permissions` VALUES ('2', '6', null, null);
INSERT INTO `role_permissions` VALUES ('2', '7', null, null);
INSERT INTO `role_permissions` VALUES ('2', '8', null, null);
INSERT INTO `role_permissions` VALUES ('2', '9', null, null);
INSERT INTO `role_permissions` VALUES ('3', '0', null, null);
INSERT INTO `role_permissions` VALUES ('3', '1', null, null);
INSERT INTO `role_permissions` VALUES ('3', '2', null, null);
INSERT INTO `role_permissions` VALUES ('6', '0', null, null);
INSERT INTO `role_permissions` VALUES ('6', '2', null, null);
INSERT INTO `role_permissions` VALUES ('6', '3', null, null);

-- ----------------------------
-- Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=16384;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Administrador', null, null);
INSERT INTO `roles` VALUES ('2', 'Cliente', null, null);

-- ----------------------------
-- Table structure for `sales`
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `step` int(11) DEFAULT NULL,
  `mp_id` varchar(255) DEFAULT NULL,
  `mp_code` varchar(255) DEFAULT NULL,
  `mp_checkout_url` varchar(255) DEFAULT NULL,
  `mp_created_at` datetime DEFAULT NULL,
  `mp_paid_at` datetime DEFAULT NULL,
  `mp_payment_method` int(11) DEFAULT NULL,
  `mp_value` decimal(20,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales
-- ----------------------------
INSERT INTO `sales` VALUES ('7', '2018-02-27 08:15:04', '2018-02-27 08:15:04', null, null, '2', 'or_maO4gzzhdC3AYb5n', 'PYW1UN3HDO', 'https://api.mundipagg.com/checkout/v1/orders/chk_JDBKZ7aFqSoRgPz3', '2018-02-27 14:15:03', null, null, '1380.00', '25', '1', '0');
INSERT INTO `sales` VALUES ('8', '2018-02-27 08:46:36', '2018-02-27 10:15:06', null, '-1', '2', 'or_9oLB6Qpf3iRnGrwn', '7JZ8I6U0JP', 'https://api.mundipagg.com/checkout/v1/orders/chk_Bo0dyJmhGPf80vR8', '2018-02-27 14:46:36', null, null, '1380.00', '25', '1', 'paid');
INSERT INTO `sales` VALUES ('9', '2018-02-27 12:06:43', '2018-02-27 12:15:01', null, '-1', '2', 'or_ozlpL0orUNSaPOZb', 'R833AXPFEY', 'https://api.mundipagg.com/checkout/v1/orders/chk_l9jQO44HM8U92WEp', '2018-02-27 18:06:43', null, null, '1500.00', '26', '3', 'paid');
INSERT INTO `sales` VALUES ('10', '2018-02-27 12:37:42', '2018-02-27 12:38:38', null, '-1', '2', 'or_82P3Bp3UOEcWaMzw', 'MOWWAGH8OK', 'https://api.mundipagg.com/checkout/v1/orders/chk_a16PMeDH9MS7EPvb', '2018-02-27 18:37:42', null, null, '1200.00', '27', '2', 'paid');
INSERT INTO `sales` VALUES ('11', '2018-02-27 13:43:24', '2018-02-27 13:43:24', null, null, '2', 'or_0jJGzQlu4FJgX2nM', '6ZXMIZXH8V', 'https://api.mundipagg.com/checkout/v1/orders/chk_mN7B1Z0t9nu7KMk4', '2018-02-27 19:43:22', null, null, '1500.00', '25', '3', 'pending');

-- ----------------------------
-- Table structure for `teachers`
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of teachers
-- ----------------------------
INSERT INTO `teachers` VALUES ('4', '2018-02-25 19:46:02', '2018-02-25 19:46:02', 'Gustavo Alonso Pereira', 'Professor dos cursos de Dermatoscopia e Gestao de Consultórios.');
INSERT INTO `teachers` VALUES ('5', '2018-02-25 19:46:19', '2018-02-25 19:46:19', 'Leonardo Spagnol Abraham', 'Professor do curso de Alopecias On line.');
INSERT INTO `teachers` VALUES ('6', '2018-02-25 19:46:35', '2018-02-25 19:46:35', 'Yanna Kelly Formiga da Silva', 'Professora do curso de Alopecias On line.');
INSERT INTO `teachers` VALUES ('7', '2018-02-25 19:46:49', '2018-02-25 19:46:49', 'Débora Cadore de Farias', 'Professora do curso de Alopecias On line.');
INSERT INTO `teachers` VALUES ('8', '2018-02-25 19:47:07', '2018-02-25 19:47:07', 'Celso Sodre', 'Professora do curso de Alopecias On line.');
INSERT INTO `teachers` VALUES ('9', '2018-02-25 19:47:25', '2018-02-25 19:47:25', 'Bruna Duque Estrada', 'Professora do curso de Alopecias On line.');
INSERT INTO `teachers` VALUES ('10', '2018-02-26 00:37:09', '2018-02-26 00:37:09', 'Leticia Krause Schenato Bisch', '<p>Médica Dermatologista, sócia efetiva da Sociedade Brasileira de Dermatologia e da Sociedade Brasileira de Cirurgia Dermatológica</p>\r\n<p>Coordenadora do GRAPE-SBD de ACNE.</p>\r\n<p>Mestre em Ciências Médicas pela UFRGS.</p>');
INSERT INTO `teachers` VALUES ('11', '2018-02-26 01:28:46', '2018-02-26 01:28:46', 'Adilson da Costa', 'Formado em Medicina pela Faculdade de Ciências médicas da Santa Casa de São Paulo (FCMSCSP)<br><br>Especializado em Dermatologia pela Irmandade da Santa Casa de Misericórdia de São Paulo (ISCMSP)<br><br>Título de Especialista em Dermatologia pela Sociedade Brasileira de Dermatologia (SBD)<br><br>Ex-chefe do Serviço de Dermatologia da Pontifícia Universidade Católica de Campinas (PUC-Campinas)<br><br>Avaliador de Segurança Cosmética na Europa pela Vrije Universiteit Brussels, Bruxelas, Bélgica <br><br>Mestre em Dermatologia pela Escola Paulista de Medicina Universidade Federal de São Paulo (EPM/UNIFESP)<br><br>Doutor em Dermatologia pela Faculdade de Medicina da Universidade de São Paulo (FMUSP)<br><br>Pós-doutorado em Pesquisa em Dermatologia pela Emory University, Atlanta, GA, EUA<br>');

-- ----------------------------
-- Table structure for `user_courses`
-- ----------------------------
DROP TABLE IF EXISTS `user_courses`;
CREATE TABLE `user_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_courses
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `password_2` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_2` varchar(255) DEFAULT NULL,
  `phone_3` varchar(255) DEFAULT NULL,
  `email_2` varchar(255) DEFAULT NULL,
  `email_3` varchar(255) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `neighborhood` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `complement` varchar(255) DEFAULT NULL,
  `eadbox_id` varchar(255) DEFAULT NULL,
  `eadbox_slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('4', '2015-05-07 09:55:14', '2018-02-26 20:23:13', 'Alan', 'aquidornne@gmail.com', '6edfe3caf10528cbed1599e5913b7cf513f75ce9', '123', '1', '1', '86208d4e152ef52c2da09f3f798c2ff2.JPG', 'b790e8d42e0453eb9803aab1b7ecd34b', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `users` VALUES ('5', '2018-01-26 20:43:37', '2018-02-27 10:16:34', 'Visana', 'contato@visanacomunicacao.com.br', '6edfe3caf10528cbed1599e5913b7cf513f75ce9', null, '1', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `users` VALUES ('25', '2018-02-26 18:03:42', '2018-02-27 13:43:24', 'Alan Quidornne de Souza', 'alan.fusioncomunicacao@gmail.com', 'b9014def59a576fcfa7a79c337ab16ee13add66d', '123456', '2', '1', null, null, null, null, '151.721.667-26', '(21) 9999-99999', '(21) 9999-9999', null, null, null, '1993-08-23', '26545-787', 'Rua Sargento Manuel Rodrigues', 'RJ', 'Nilópolis', 'Cabuis', '706', '...', '5a94762f52e88d00323a112c', 'alan-quidornne-de-souza-1');
INSERT INTO `users` VALUES ('26', '2018-02-27 12:06:43', '2018-02-27 12:06:43', 'dejair silva', 'daniel@visanacomunicacao.com.br', '36de0b28a4e11131ac80c623d47817366fe16ace', 'Bananada@1', '2', '1', null, null, null, null, '989.652.750-40', '(21) 9976-23124', '(21) 3232-6565', null, null, null, '1889-05-18', '22755-155', 'Estrada de Jacarepaguá - de 6985 ao fim - lado ímpar', 'RJ', 'Rio de Janeiro', 'Freguesia (Jacarepaguá) ', '7679', '37', null, null);
INSERT INTO `users` VALUES ('27', '2018-02-27 12:37:42', '2018-02-27 12:38:39', 'daniel souza', 'dgsouza1337@gmail.com', '0e68b59b3d7a35830b0f9a0c81fc80287e02e0e9', 'dg180589', '2', '1', null, null, null, null, '130.392.337-85', '(21) 9997-76112', '(21) 3172-6658', null, null, null, '1989-05-18', '22755-155', 'Estrada de Jacarepaguá - de 6985 ao fim - lado ímpar', 'RJ', 'Rio de Janeiro', 'Freguesia (Jacarepaguá) ', '7679', 'casa 37', '5a95a5af493a26003f9bf9b1', 'daniel-souza');
