-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-05-2014 a las 22:53:46
-- Versión del servidor: 5.5.37
-- Versión de PHP: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `reserveyourplace`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `cif_restaurant` varchar(9) NOT NULL,
  `src` varchar(120) DEFAULT NULL,
  `featured_image` tinyint(1) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_image`),
  KEY `fk_Gallery_Images_Restaurant1_idx` (`cif_restaurant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Volcado de datos para la tabla `gallery_images`
--

INSERT INTO `gallery_images` (`id_image`, `cif_restaurant`, `src`, `featured_image`, `position`) VALUES
(1, 'A12345678', 'images/volcanic-ambiente-caluroso_0.jpg', 1, 0),
(7, 'B12345678', 'images/yokomo-logo_0.jpg', 1, 0),
(13, 'C12345678', 'images/capita-vista-exterior_0.jpg', 1, 0),
(19, 'D12345678', 'images/alegra-logo_0.jpg', 1, 0),
(20, 'D12345678', 'images/alegra-mesas-con-sofa_0.jpg', 0, 0),
(21, 'D12345678', 'images/alegra-plato-arroz_0.jpg', 0, 1),
(22, 'D12345678', 'images/alegra-especialidad-de-pescado_0.jpg', 0, 2),
(23, 'D12345678', 'images/alegra-sugerencia-pescado-con-garbanzos_0.jpg', 0, 3),
(24, 'D12345678', 'images/alegra-souffle-con-helado_0.jpg', 0, 4),
(25, 'A12345678', 'images/volcanic-chimenea-en-la-sala_0.jpg', 0, 0),
(26, 'A12345678', 'images/volcanic-sala-principal_1.jpg', 0, 1),
(27, 'A12345678', 'images/volcanic-sala-roja_1.jpg', 0, 2),
(28, 'A12345678', 'images/volcanic-sugerencia-canelones_0.jpg', 0, 3),
(29, 'A12345678', 'images/volcanic-sugerencia-ensalada-de-cabra_0.jpg', 0, 4),
(30, 'B12345678', 'images/yokomo-sala_0.jpg', 0, 0),
(31, 'B12345678', 'images/yokomo-barra_0.jpg', 0, 1),
(32, 'B12345678', 'images/yokomo-carne_0.jpg', 0, 2),
(33, 'B12345678', 'images/yokomo-comida_0.jpg', 0, 3),
(34, 'B12345678', 'images/yokomo-postre_0.jpg', 0, 4),
(35, 'C12345678', 'images/capita-vista-interior_0.jpg', 0, 0),
(36, 'C12345678', 'images/capita-vista-mesas_0.jpg', 0, 1),
(37, 'C12345678', 'images/capita-vista-puerto_0.jpg', 0, 2),
(38, 'C12345678', 'images/capita-vista-terraza_0.jpg', 0, 3),
(39, 'C12345678', 'images/capita-detalle-copas_0.jpg', 0, 4),
(40, 'F12345678', 'images/ushuaia-1_0.jpeg', 1, 0),
(41, 'F12345678', 'images/ushuaia-2_0.jpg', 0, 0),
(42, 'F12345678', 'images/ushuaia-3_0.jpg', 0, 1),
(43, 'F12345678', 'images/ushuaia-4_0.jpg', 0, 2),
(44, 'G12345678', 'images/la-terraza1_0.jpg', 1, 0),
(45, 'G12345678', 'images/la-terraza2_0.jpeg', 0, 0),
(46, 'G12345678', 'images/la-terraza3_0.jpeg', 0, 1),
(47, 'G12345678', 'images/la-terraza4_0.jpg', 0, 2),
(48, 'H12345678', 'images/bouquet-1_0.jpg', 1, 0),
(49, 'H12345678', 'images/bouquet-2_0.jpg', 0, 0),
(50, 'H12345678', 'images/bouquet-3_0.jpg', 0, 1),
(51, 'H12345678', 'images/bouquet-4_0.jpg', 0, 2),
(52, 'H12345678', 'images/bouquet-5_0.jpg', 0, 3),
(53, 'I12345678', 'images/la-pava1_0.jpg', 1, 0),
(54, 'I12345678', 'images/la-pava1_1.jpg', 0, 0),
(55, 'I12345678', 'images/la-pava2_0.jpg', 0, 1),
(57, 'E12345678', 'images/el-pou-vista-de-la-fachada_0.jpg', 1, 0),
(58, 'E12345678', 'images/el-pou-elemento-decorativo_1.jpg', 0, 0),
(59, 'E12345678', 'images/el-pou-vista-de-la-terraza-2_0.jpg', 0, 2),
(60, 'E12345678', 'images/el-pou-vista-exterior_0.jpg', 0, 1),
(61, 'E12345678', 'images/el-pou-vista-interior_0.jpg', 0, 3),
(62, 'E12345678', 'images/el-pou-vista-de-la-terraza_0.jpg', 0, 4),
(63, 'I12345678', 'images/la-pava1_2.jpg', 0, 2),
(65, 'I12345678', 'images/la-pava3_1.jpg', 0, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gourmet`
--

CREATE TABLE IF NOT EXISTS `gourmet` (
  `id_gourmet` int(11) NOT NULL AUTO_INCREMENT,
  `cif_restaurant` varchar(9) NOT NULL,
  `type_gourmet` int(11) NOT NULL,
  `name_gourmet` varchar(60) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `recomendation` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_gourmet`),
  KEY `fk_Gourmet_Restaurant1_idx` (`cif_restaurant`),
  KEY `fk_Gourmet_Type_Gourmet1_idx` (`type_gourmet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Volcado de datos para la tabla `gourmet`
--

INSERT INTO `gourmet` (`id_gourmet`, `cif_restaurant`, `type_gourmet`, `name_gourmet`, `price`, `description`, `recomendation`) VALUES
(1, 'A12345678', 1, 'Milhojas de verduras tibias con queso de cabra gratinado', 5.2, '', 1),
(2, 'A12345678', 3, 'Calamares salteados con buqué de tomate confitado', 7.8, '', 1),
(3, 'A12345678', 4, 'Crema catalana', 3.7, '', 1),
(4, 'A12345678', 5, 'Botella de agua mineral', 1.5, '', 1),
(5, 'A12345678', 2, 'crema verde', 7, '', 0),
(6, 'A12345678', 3, 'Pollo al horno', 10, '', 0),
(7, 'A12345678', 4, 'Ensalada de frutas', 4, '', 0),
(8, 'A12345678', 5, 'Coca Cola 2L', 2, '', 0),
(9, 'B12345678', 1, 'Ensalada de wakame', 3.1, '', 1),
(10, 'B12345678', 3, 'Mariawase variado de Sushi (20 piezas)', 19.5, '', 1),
(11, 'B12345678', 4, 'Gateau de chocolate y sésamo', 4, '', 1),
(12, 'B12345678', 5, 'Coca Cola 2L', 2.5, '', 1),
(13, 'B12345678', 1, 'Escalibada Yokomo con vinagreta de miso', 3.5, '', 0),
(14, 'B12345678', 3, 'Sashimi de Arún, Salmón o Pez mantequilla', 10.5, '', 0),
(15, 'B12345678', 4, 'Trufón de sake', 4, '', 0),
(16, 'B12345678', 5, 'Fanta de  2L', 2.3, '', 0),
(17, 'C12345678', 1, 'Ensalada de aguacates y langostinos', 14.05, '', 1),
(18, 'C12345678', 1, 'Erizos de mar gratinados', 13.5, '', 0),
(19, 'C12345678', 3, 'Paella marinera', 14.4, '', 0),
(20, 'C12345678', 4, 'Pudin de fruta', 4.95, '', 0),
(21, 'C12345678', 5, 'Coca Cola 2L', 2, '', 0),
(22, 'C12345678', 3, 'Caldero de arroz con bogavante', 21, '', 1),
(23, 'C12345678', 4, 'Mousse de chocolate con nata', 5.2, '', 1),
(24, 'C12345678', 5, 'Coca Cola 2L', 2, '', 1),
(25, 'D12345678', 1, 'Pulpo a la brasa con crema de céleri y papada confitada', 21, '', 1),
(27, 'D12345678', 3, 'Pescado salvaje a la plancha o al horno', 20, '', 1),
(28, 'D12345678', 4, 'Soufflé de avellanas', 8, '', 1),
(29, 'D12345678', 1, 'Mejillones al vapor con tomate o albahaca', 10, '', 0),
(30, 'D12345678', 3, 'Arroz caldoso de bogavante', 20, '', 0),
(31, 'D12345678', 4, 'Choco cake Alegra', 8, '', 0),
(32, 'D12345678', 5, 'Coca Cola 2L', 2.5, '', 1),
(33, 'D12345678', 5, 'Agua Mineral', 1.5, '', 0),
(34, 'I12345678', 2, 'Pizza Peperoni', 5, '', 1),
(36, 'E12345678', 1, 'Mousse de escalivada', 6.25, '', 1),
(38, 'E12345678', 3, 'Entrecots y filetes de ternera a la brasa', 13.95, '', 1),
(39, 'E12345678', 4, 'Iogurt artesano tostado con pasas y nueces', 5.25, '', 1),
(40, 'E12345678', 5, 'Coca Cola 2L', 2, '', 1),
(41, 'E12345678', 1, 'Croquetas de la casa de pollo y ternera', 6.25, '', 0),
(42, 'E12345678', 3, 'Bacalao a la muselina', 9.25, '', 0),
(43, 'E12345678', 4, 'Pastel de la casa', 4.25, '', 0),
(44, 'E12345678', 5, 'Agua Mineral', 1, '', 0),
(45, 'I12345678', 4, 'Helado nata', 1, '', 1),
(46, 'I12345678', 1, 'Ensalada', 4, '', 1),
(47, 'I12345678', 2, 'Pizza Peperoni', 5, '', 0),
(48, 'I12345678', 2, 'Sopa', 6, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `cif_restaurant` varchar(9) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_menu`),
  KEY `fk_Menu_Restaurant1_idx` (`cif_restaurant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_menu`, `cif_restaurant`, `name`, `price`, `description`) VALUES
(1, 'A12345678', 'Menú Amigos', 18, 'Compartelo entre tus amigos!'),
(2, 'B12345678', 'Menú Yokomo', 15, 'Sabroso y delicioso'),
(3, 'C12345678', 'Menú El Capità', 25, 'Para chuparse los dedos'),
(4, 'D12345678', 'Menú Alegra tu dia', 22.5, ''),
(5, 'I12345678', 'Menu comida', 8, 'Incluye: Primero, segundo y postre'),
(6, 'E12345678', 'Menú de temporada', 18.95, 'Aprovechalo'),
(7, 'I12345678', 'Menu Cena', 10, 'Incluye: primero, segundo y postre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_complete`
--

CREATE TABLE IF NOT EXISTS `menu_complete` (
  `id_gourmet` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`id_gourmet`,`id_menu`),
  KEY `fk_Gourmet_has_Menu_Menu1_idx` (`id_menu`),
  KEY `fk_Gourmet_has_Menu_Gourmet1_idx` (`id_gourmet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `menu_complete`
--

INSERT INTO `menu_complete` (`id_gourmet`, `id_menu`) VALUES
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(29, 4),
(30, 4),
(31, 4),
(33, 4),
(45, 5),
(41, 6),
(42, 6),
(43, 6),
(44, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id_rating` int(11) NOT NULL AUTO_INCREMENT,
  `cif_restaurant` varchar(9) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `note` float NOT NULL,
  PRIMARY KEY (`id_rating`),
  KEY `fk_Ratings_Restaurant1_idx` (`cif_restaurant`),
  KEY `fk_Ratings_User1_idx` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ratings`
--

INSERT INTO `ratings` (`id_rating`, `cif_restaurant`, `id_user`, `date`, `time`, `description`, `note`) VALUES
(1, 'A12345678', 4, '2014-05-28', '18:08:02', 'Los controles no son deslizantes', 0),
(2, 'I12345678', 1, '2014-05-28', '18:18:39', '', 5.33333);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rating_notes`
--

CREATE TABLE IF NOT EXISTS `rating_notes` (
  `id_rating` int(11) NOT NULL,
  `id_type_rating` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`id_rating`,`id_type_rating`),
  KEY `fk_Type_raitings_has_Ratings_Ratings1_idx` (`id_rating`),
  KEY `fk_Type_raitings_has_Ratings_Type_raitings1_idx` (`id_type_rating`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rating_notes`
--

INSERT INTO `rating_notes` (`id_rating`, `id_type_rating`, `note`) VALUES
(1, 1, 0),
(1, 2, 0),
(1, 3, 0),
(1, 4, 0),
(1, 5, 0),
(1, 6, 0),
(2, 1, 0),
(2, 2, 9),
(2, 3, 3),
(2, 4, 7),
(2, 5, 6),
(2, 6, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `id_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `cif_restaurant` varchar(9) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `number_people` int(11) NOT NULL DEFAULT '0',
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `fk_Reservations_Restaurant1_idx` (`cif_restaurant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id_reservation`, `cif_restaurant`, `date`, `time`, `number_people`, `description`) VALUES
(1, 'A12345678', '2014-05-30', '21:00:00', 5, ''),
(2, 'C12345678', '2014-05-30', '21:00:00', 50, ''),
(3, 'A12345678', '2014-06-01', '10:00:00', 3, ''),
(4, 'I12345678', '2014-05-30', '17:00:00', 4, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurant`
--

CREATE TABLE IF NOT EXISTS `restaurant` (
  `cif_restaurant` varchar(9) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `location` varchar(50) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `city` varchar(40) NOT NULL,
  `capacity` int(11) NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_code` varchar(100) DEFAULT NULL,
  `confirmed` int(11) DEFAULT '0',
  `generated_string` varchar(35) DEFAULT '0',
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`cif_restaurant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `restaurant`
--

INSERT INTO `restaurant` (`cif_restaurant`, `name`, `description`, `location`, `zipcode`, `city`, `capacity`, `parking`, `email`, `email_code`, `confirmed`, `generated_string`, `password`) VALUES
('A12345678', 'Volcànic', 'Un nombre explosivo. Una brasería que está en llamas. El restaurante Volcánic le hace honor a su nombre regalando unas carnes a la brasa que parecen diseñadas para satisfacer a los auténticos amantes de la carne de Badalona. El viernes por la noche, el restaurante hace monólogos con el actor Andres Torres (hay un menú de 12 euros). ¡Reserva tu mesa!', 'C/ Electrónica, 2', '08915', 'Badalona', 100, 1, 'elmer_03_12@hotmail.com', 'code_53846522210fc7.06533377', 1, '0', '$2y$12$671996717653846522211u54ACmtfkMqVqE3DYT3bGVrXeXqcN9rK'),
('B12345678', 'Yokomo', 'Nos hemos acostumbrado a que la oferta de japoneses es siempre igual, por suerte hay nuevas propuestas dispuestas a desmentirlo. Es el caso del restaurante Yokomo, un japonés diferente en el barrio de Gràcia con una nueva variedad de combinaciones gastronómicas niponas. Su decoración de líneas simples y tranquilas, donde la luz juega un papel principal para crear un ambiente acogedor. ¡Yokomo se convertirá en una aventura placida para tu mente e intensa para tu paladar!', 'C/ Séneca, 4', '08006', 'Barcelona', 28, 1, 'juaan1394@hotmail.com', 'code_5384653a5a5b05.43837976', 1, '0', '$2y$12$31505212815384653a5a5Ol8L/detYTSd74D8Fs6kiDJJpWJXVvPu'),
('C12345678', 'El Capità', 'Situado entre el parque del Garraf y la playa de Castelldefels y enmarcado por el Port Ginesta, encontramos este encantador restaurante: El Capità, una invitación gastronómica moderna y desenfadada cuyas hermosas instalaciones se componen de un comedor interior, delicado y elegante además de una privilegiada terraza con magníficas vistas al puerto. Restaurante ideal para celebrar eventos de alta exigencia gracias a la capacidad de sus espacios y a la profesionalidad de un servicio atento.', 'C/ Port Ginesta, s/n', '08860', 'Castelldefels', 80, 1, 'elmersito13@hotmail.com', 'code_5384655670c6d7.45125990', 1, '0', '$2y$12$03352130225384655670cuybCvLbmqCk2059JxVP1yRUQb.mNKfD2'),
('D12345678', 'Alegra', 'Si te gusta descubrir sitios especiales y animados, el restaurante Alegra Barcelona tiene una ubicación tan privilegiada como es la última planta de Maremagnum con vistas que abarcan desde el puerto al Tibidabo tanto desde el interior como desde su impresionante terraza. Es un lugar perfecto para cualquier acontecimiento o evento y no quieras dejar a nadie indiferente. Haz tu re', 'Moll d''Espanya, 5', '08039', 'Barceloneta', 130, 1, 'mani_13_03@hotmail.com', 'code_5384656fb88543.32148350', 1, '0', '$2y$12$90765112775384656fb88uvyKgDAfhJILzZrwknfDUh9KYiqgve.S'),
('E12345678', 'El Pou', 'En una incomparable masía fortificada en el municipio de Girona se encuentra el restaurante El Pou. Allí podrás degustar una cocina catalana tradicional bajo un ambiente lleno de tranquilidad, sobriedad y acogimiento dentro de su local cálido y agradable o en su amplia terraza. De fácil acceso, parking propio, música ambiental, una terraza agradable, un servicio profesional y amable y sobre todo una cocina de calidad, El Pou te invita a disfrutar de un momento lleno de satisfacción!', 'C/ Montnegre, 51', '17006', 'Girona', 60, 1, 'bloomer94@hotmail.com', 'code_5384658c5d4d04.37563714', 1, '0', '$2y$12$11747984355384658c5d4euOCBdBMI6mfgAZ2eZ0hV030b/QURn/a'),
('F12345678', 'Ushuaia', 'En Parrilla argentina Usuhaia encontraremos el autentico trato argentino, con su tango y su variedad de carnes cocinadas a la brasa de leña y carbón.\r\n\r\nTienen el Solomillo angus flambeado con coñac al roquefort o la parrillada de carnes para dos , ensaladas varias y postres caseros argentinos, tambien empanadas criollas,Matambre casero con ensaladilla rusa y el panqueque con dulce de leche. Tenemos menús para grupos y vino argentino.', 'Passeig Marítim 237', '08860', 'Castelldefels', 250, 0, 'louu.92@gmail.com', 'code_538504b02c39d0.10159817', 1, '0', '$2y$12$2353236503538504b02c3OwckZ0dtl3OXqm346y/qbxRw9A7Tf1qW'),
('G12345678', 'Restaurante La Terraza', 'Somos Restaurante La Terraza, uno de los mejores restaurantes de cocina casera que usted encontrará en la localidad de Cornellà de Llobregat. Tenemos años de experiencia en el sector gastronómico. \r\n\r\nContamos con terraza exterior, baños adaptados, 2 barras y salón con capacidad para 460 comensales. Asimismo, nuestras instalaciones están implementadas con pantallas de TV, mesas redondas y cuadradas, además de aire acondicionado.', 'Avenida San Ferrán', '08940', 'Cornellà de Llobregat', 200, 0, 'louu.rc9@hotmail.com', 'code_5385a33dd635d1.17352452', 1, '0', '$2y$12$21180141715385a33dd63udguJQNDes.hbRTNzG81s8Y9U0zmCz.i'),
('H12345678', 'Bouquet Hotel Hesperia Tower', 'El restaurante Bouquet, situado en la segunda planta del singular Hotel Hesperia Tower, consigue romper con los clichés de que los restaurantes de hotel son fríos y sin alma, mediante una fuerte personalidad mediterránea y sólidos valores que defienden el producto fresco y de calidad.\r\n\r\nEn su carta los platos tradicionales se codean sin complejos con propuestas creativas a las que el chef Juan Cornejo les da un plus de sabor y distinción.', 'Gran via 144', '08038', 'Hospitalet de Llobregat', 300, 0, 'lara.rodriguez93@gmail.com', 'code_5385a6a7af7eb9.96751105', 1, '0', '$2y$12$1084676385385a6a7af7fODhgt57BfriJmCihQMmrMZx4j4USKHsu'),
('I12345678', 'Restaurante La Pava', 'A medio camino entre Barcelona y Castelldefels, muy cerca del Aeropuerto del Prat del Llobregat, se encuentra desde el año 1961 el complejo del Grupo La Pava. Allí podrás encontrar un área de descanso y reposo cerca de la playa. Contamos con una fantástica pizzería, un restaurante brasería especializado en bacalao, una tienda de pollos, un kiosko y una panadería.', 'Autov Castelldefels 600', '08850', 'Gava', 250, 0, 'lara_roma88@hotmail.com', 'code_5385af56862195.21988704', 1, '0', '$2y$12$6287930455385af568622ucii9tuzCpK1sTGs1180gNpAM75JHjdO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurant_transport`
--

CREATE TABLE IF NOT EXISTS `restaurant_transport` (
  `cif_restaurant` varchar(9) NOT NULL,
  `id_transport` int(11) NOT NULL,
  PRIMARY KEY (`cif_restaurant`,`id_transport`),
  KEY `fk_Restaurant_has_Transport_Transport1_idx` (`id_transport`),
  KEY `fk_Restaurant_has_Transport_Restaurant1_idx` (`cif_restaurant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `restaurant_transport`
--

INSERT INTO `restaurant_transport` (`cif_restaurant`, `id_transport`) VALUES
('D12345678', 3),
('A12345678', 7),
('B12345678', 8),
('C12345678', 9),
('F12345678', 10),
('F12345678', 11),
('F12345678', 12),
('G12345678', 13),
('G12345678', 14),
('H12345678', 15),
('E12345678', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `id_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `day_week_start` int(11) NOT NULL,
  `day_week_finish` int(11) NOT NULL,
  `time_start` time DEFAULT NULL,
  `time_finish` time DEFAULT NULL,
  PRIMARY KEY (`id_schedule`),
  KEY `fk_Schedules_Type_Day_Week1_idx` (`day_week_start`),
  KEY `fk_Schedules_Type_Day_Week2_idx` (`day_week_finish`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `schedules`
--

INSERT INTO `schedules` (`id_schedule`, `day_week_start`, `day_week_finish`, `time_start`, `time_finish`) VALUES
(6, 4, 7, '12:00:00', '00:00:00'),
(7, 1, 3, '12:00:00', '16:00:00'),
(8, 1, 7, '13:00:00', '16:00:00'),
(9, 5, 6, '21:00:00', '00:30:00'),
(10, 1, 5, '12:00:00', '16:00:00'),
(11, 1, 6, '20:00:00', '23:30:00'),
(12, 2, 7, '13:00:00', '16:00:00'),
(13, 2, 6, '20:30:00', '23:30:00'),
(14, 1, 7, '10:00:00', '23:00:00'),
(15, 1, 5, '10:00:00', '21:00:00'),
(16, 6, 7, '11:00:00', '23:30:00'),
(17, 1, 4, '10:00:00', '20:00:00'),
(19, 1, 7, '11:00:00', '23:00:00'),
(20, 1, 7, '13:00:00', '16:00:00'),
(21, 5, 6, '20:00:00', '22:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedule_restaurants`
--

CREATE TABLE IF NOT EXISTS `schedule_restaurants` (
  `cif_restaurant` varchar(9) NOT NULL,
  `id_schedule` int(11) NOT NULL,
  PRIMARY KEY (`cif_restaurant`,`id_schedule`),
  KEY `fk_Schedules_has_Restaurant_Restaurant1_idx` (`cif_restaurant`),
  KEY `fk_Schedules_has_Restaurant_Schedules1_idx` (`id_schedule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `schedule_restaurants`
--

INSERT INTO `schedule_restaurants` (`cif_restaurant`, `id_schedule`) VALUES
('D12345678', 6),
('D12345678', 7),
('A12345678', 8),
('A12345678', 9),
('B12345678', 10),
('B12345678', 11),
('C12345678', 12),
('C12345678', 13),
('F12345678', 14),
('G12345678', 15),
('G12345678', 16),
('H12345678', 17),
('I12345678', 19),
('E12345678', 20),
('E12345678', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `speciality`
--

CREATE TABLE IF NOT EXISTS `speciality` (
  `id_speciality` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `src` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_speciality`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `speciality`
--

INSERT INTO `speciality` (`id_speciality`, `name`, `src`) VALUES
(1, 'Cocina Americana', 'americana.jpg'),
(2, 'Cocina Argentina', 'argentina.jpg'),
(3, 'Cocina India', 'india.jpg'),
(4, 'Torradas', 'torradas.jpg'),
(5, 'Cocina Mexicana', 'mexicana.jpg'),
(6, 'Cocina Andaluza', 'andaluza.jpg'),
(7, 'Cocina Gallega', 'gallega.jpg'),
(8, 'Cocina Alemana', 'alemana.jpg'),
(9, 'Cocina Francesa', 'francesa.jpg'),
(10, 'Cocina Catalana', 'catalana.jpg'),
(11, 'Carne a la brasa', 'carnes.jpg'),
(12, 'Cocina Italiana', 'italiana.jpg'),
(13, 'Cocina Africana', 'africana.jpg'),
(14, 'Cocina Turca', 'turca.jpg'),
(15, 'Cocina Española', 'espanola.jpg'),
(16, 'Cocina Vasca', 'vasca.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `speciality_restaurants`
--

CREATE TABLE IF NOT EXISTS `speciality_restaurants` (
  `cif_restaurant` varchar(9) NOT NULL,
  `speciality` int(11) NOT NULL,
  PRIMARY KEY (`cif_restaurant`,`speciality`),
  KEY `fk_Restaurant_has_Speciality_Speciality1_idx` (`speciality`),
  KEY `fk_Restaurant_has_Speciality_Restaurant1_idx` (`cif_restaurant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `speciality_restaurants`
--

INSERT INTO `speciality_restaurants` (`cif_restaurant`, `speciality`) VALUES
('B12345678', 4),
('H12345678', 5),
('H12345678', 7),
('H12345678', 8),
('H12345678', 9),
('C12345678', 10),
('D12345678', 10),
('E12345678', 10),
('H12345678', 10),
('A12345678', 11),
('C12345678', 14),
('D12345678', 15),
('E12345678', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tables_restaurant`
--

CREATE TABLE IF NOT EXISTS `tables_restaurant` (
  `id_table` int(11) NOT NULL AUTO_INCREMENT,
  `cif_restaurant` varchar(9) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `number_people` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_table`),
  KEY `fk_Table_Restaurant1_idx` (`cif_restaurant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=143 ;

--
-- Volcado de datos para la tabla `tables_restaurant`
--

INSERT INTO `tables_restaurant` (`id_table`, `cif_restaurant`, `name`, `number_people`) VALUES
(1, 'F12345678', '1', 2),
(2, 'F12345678', '2', 1),
(3, 'F12345678', '3', 4),
(4, 'F12345678', '4', 4),
(5, 'F12345678', '5', 4),
(6, 'F12345678', '6', 5),
(7, 'F12345678', '7', 3),
(8, 'F12345678', '8', 6),
(9, 'F12345678', '9', 6),
(10, 'F12345678', '10', 6),
(11, 'F12345678', '11', 12),
(12, 'F12345678', '12', 14),
(13, 'F12345678', '13', 10),
(14, 'F12345678', '14', 8),
(15, 'F12345678', '15', 9),
(16, 'F12345678', '16', 7),
(17, 'F12345678', '17', 15),
(18, 'A12345678', '1', 2),
(19, 'A12345678', '2', 1),
(20, 'A12345678', '3', 4),
(21, 'A12345678', '4', 5),
(22, 'A12345678', '5', 6),
(23, 'A12345678', '7', 8),
(24, 'A12345678', '8', 10),
(25, 'A12345678', '9', 9),
(26, 'A12345678', '10', 3),
(27, 'A12345678', '11', 7),
(28, 'A12345678', '12', 14),
(29, 'A12345678', '13', 12),
(30, 'A12345678', '14', 11),
(31, 'A12345678', '15', 13),
(32, 'A12345678', '16', 15),
(33, 'B12345678', '1', 2),
(34, 'B12345678', '2', 4),
(35, 'B12345678', '3', 6),
(36, 'B12345678', '4', 1),
(37, 'B12345678', '5', 3),
(38, 'B12345678', '6', 5),
(39, 'B12345678', '7', 9),
(40, 'B12345678', '8', 10),
(41, 'B12345678', '9', 7),
(42, 'B12345678', '10', 8),
(43, 'B12345678', '11', 13),
(44, 'B12345678', '12', 14),
(45, 'B12345678', '13', 11),
(46, 'B12345678', '14', 12),
(47, 'B12345678', '15', 15),
(48, 'C12345678', '1', 4),
(49, 'C12345678', '2', 6),
(50, 'C12345678', '3', 1),
(51, 'C12345678', '4', 7),
(52, 'C12345678', '5', 2),
(53, 'C12345678', '6', 3),
(54, 'C12345678', '7', 5),
(55, 'C12345678', '8', 10),
(56, 'C12345678', '9', 12),
(57, 'C12345678', '10', 11),
(58, 'C12345678', '11', 9),
(59, 'C12345678', '12', 8),
(60, 'C12345678', '13', 15),
(61, 'C12345678', '14', 13),
(62, 'C12345678', '15', 14),
(63, 'D12345678', '1', 4),
(64, 'D12345678', '2', 6),
(65, 'D12345678', '3', 1),
(66, 'D12345678', '4', 2),
(67, 'D12345678', '5', 7),
(68, 'D12345678', '6', 8),
(69, 'D12345678', '7', 3),
(70, 'D12345678', '8', 10),
(71, 'D12345678', '9', 13),
(72, 'D12345678', '10', 15),
(73, 'D12345678', '11', 5),
(74, 'D12345678', '12', 9),
(75, 'D12345678', '13', 11),
(76, 'D12345678', '14', 12),
(77, 'D12345678', '15', 14),
(78, 'G12345678', '1', 4),
(79, 'G12345678', '2', 4),
(80, 'G12345678', '3', 1),
(81, 'G12345678', '4', 2),
(82, 'G12345678', '5', 3),
(83, 'G12345678', '6', 6),
(84, 'G12345678', '7', 7),
(85, 'G12345678', '8', 10),
(86, 'G12345678', '9', 11),
(87, 'G12345678', '10', 12),
(88, 'G12345678', '11', 8),
(89, 'G12345678', '12', 9),
(90, 'G12345678', '13', 15),
(91, 'G12345678', '14', 1),
(92, 'G12345678', '15', 2),
(93, 'G12345678', '16', 5),
(94, 'H12345678', '1', 5),
(95, 'H12345678', '2', 4),
(96, 'H12345678', '3', 4),
(97, 'H12345678', '4', 1),
(98, 'H12345678', '5', 2),
(99, 'H12345678', '6', 6),
(100, 'H12345678', '7', 7),
(101, 'H12345678', '8', 8),
(102, 'H12345678', '9', 9),
(103, 'H12345678', '10', 2),
(104, 'H12345678', '11', 4),
(105, 'H12345678', '12', 12),
(106, 'H12345678', '13', 10),
(107, 'H12345678', '14', 15),
(108, 'H12345678', '15', 2),
(109, 'H12345678', '16', 11),
(110, 'H12345678', '17', 15),
(111, 'H12345678', '18', 2),
(112, 'I12345678', '1', 4),
(113, 'I12345678', '2', 3),
(114, 'I12345678', '3', 3),
(115, 'I12345678', '4', 3),
(116, 'I12345678', '5', 6),
(117, 'I12345678', '6', 1),
(118, 'I12345678', '7', 8),
(119, 'I12345678', '8', 9),
(120, 'I12345678', '9', 10),
(121, 'I12345678', '10', 2),
(122, 'I12345678', '11', 2),
(123, 'I12345678', '12', 3),
(124, 'I12345678', '13', 10),
(125, 'I12345678', '14', 8),
(126, 'I12345678', '15', 8),
(127, 'E12345678', '1', 4),
(128, 'E12345678', '2', 7),
(129, 'E12345678', '3', 5),
(130, 'E12345678', '4', 9),
(131, 'E12345678', '5', 1),
(132, 'E12345678', '6', 12),
(133, 'E12345678', '7', 3),
(134, 'E12345678', '8', 15),
(135, 'E12345678', '9', 2),
(136, 'E12345678', '10', 6),
(137, 'E12345678', '11', 13),
(138, 'E12345678', '12', 8),
(139, 'E12345678', '13', 10),
(140, 'E12345678', '14', 11),
(141, 'E12345678', '15', 14),
(142, 'I12345678', '16', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `total_reservations`
--

CREATE TABLE IF NOT EXISTS `total_reservations` (
  `id_user` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_table_restaurant` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_reservation`),
  KEY `fk_User_has_Reservations_Reservations1_idx` (`id_reservation`),
  KEY `fk_User_has_Reservations_User1_idx` (`id_user`),
  KEY `fk_User_has_Reservations_Table1_idx` (`id_table_restaurant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `total_reservations`
--

INSERT INTO `total_reservations` (`id_user`, `id_reservation`, `id_table_restaurant`) VALUES
(4, 1, 21),
(7, 3, 26),
(1, 4, 112);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
  `id_transport` int(11) NOT NULL AUTO_INCREMENT,
  `type_transport` int(11) NOT NULL,
  `linea` varchar(30) DEFAULT NULL,
  `station` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_transport`),
  KEY `fk_Transport_Type_transport1_idx` (`type_transport`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `transport`
--

INSERT INTO `transport` (`id_transport`, `type_transport`, `linea`, `station`) VALUES
(3, 2, 'V17', ''),
(7, 1, 'L7', 'Badalona'),
(8, 1, 'L3', 'Diagonal'),
(9, 3, 'R2', 'Castelldefels'),
(10, 3, 'R2 Sud', 'Platja de Castelldefels'),
(11, 2, 'L94-L95-L96-N16', 'Passeig Marítim - Av. dels Valls'),
(12, 2, 'L94-L95-L96-N16', 'Passeig Marítim - Av. de la Platja'),
(13, 4, 'L8-S33-S8-S4-R5-R6', 'Almeda'),
(14, 2, 'L94-TMB', 'Av. Sant Ferran - Fortuny'),
(15, 1, 'L1', 'Hospital de Bellvitge'),
(17, 3, 'R11', 'Girona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_day_week`
--

CREATE TABLE IF NOT EXISTS `type_day_week` (
  `id_day_week` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id_day_week`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `type_day_week`
--

INSERT INTO `type_day_week` (`id_day_week`, `name`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sabado'),
(7, 'Domingo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_gourmet`
--

CREATE TABLE IF NOT EXISTS `type_gourmet` (
  `id_type_gourmet` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_type_gourmet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `type_gourmet`
--

INSERT INTO `type_gourmet` (`id_type_gourmet`, `name`) VALUES
(1, 'Entrante'),
(2, 'Primer Plato'),
(3, 'Segundo Plato'),
(4, 'Postre'),
(5, 'Bebida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_ratings`
--

CREATE TABLE IF NOT EXISTS `type_ratings` (
  `id_type_rating` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_type_rating`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `type_ratings`
--

INSERT INTO `type_ratings` (`id_type_rating`, `name`) VALUES
(1, 'Comida'),
(2, 'Servicio'),
(3, 'Instalaciones'),
(4, 'Relación calidad/precio'),
(5, 'Ambiente'),
(6, 'Tiempo de espera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_transport`
--

CREATE TABLE IF NOT EXISTS `type_transport` (
  `id_type_transport` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_type_transport`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `type_transport`
--

INSERT INTO `type_transport` (`id_type_transport`, `name`) VALUES
(1, 'Metro'),
(2, 'Autobús'),
(3, 'Renfe'),
(4, 'Ferrocarriles de la Generalitat'),
(5, 'Tramvia'),
(6, 'Funicular');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surnames` varchar(80) NOT NULL,
  `gender` varchar(25) DEFAULT 'Selecionar Opción',
  `location` varchar(80) DEFAULT NULL,
  `zipcode` varchar(5) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `email_code` varchar(100) DEFAULT NULL,
  `confirmed` int(11) DEFAULT '0',
  `generated_string` varchar(35) DEFAULT '0',
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `username`, `name`, `surnames`, `gender`, `location`, `zipcode`, `city`, `email`, `email_code`, `confirmed`, `generated_string`, `password`) VALUES
(1, 'louuis', 'Lara', 'Ramirez Carmona', 'Selecionar Opción', NULL, NULL, NULL, 'louu.92@gmail.com', 'code_5385f1277e6a71.80674990', 1, '0', '$2y$12$51604519405385f1277e6O33gcjcAoPhPfQ1GHegqktx6EJyW0Qcy'),
(2, 'elmersito', 'elmer', 'garcia', 'Selecionar Opción', NULL, NULL, NULL, 'elmer_03_12@hotmail.com', 'code_5386079f534b88.12257736', 1, '0', '$2y$12$0164282035386079f534euYy1LdCIoijX7yabypmY.eWGzn/b0gUu'),
(3, 'sperez', 'sergi', 'perez', 'Selecionar Opción', NULL, NULL, NULL, 'sperez@xtec.cat', 'code_538607d6ef4b16.83988977', 0, '0', '$2y$12$765721367538607d6ef52u66j4UfG94KRMz9UNUDSlzSrUneNx4my'),
(4, 'aaaaa', 'aaa', 'bbb', '0', 'ccc', '08940', 'Cornellà', 'avilapl5@xtec.cat', 'code_538607dfb77462.50760561', 1, '0', '$2y$12$559538049538607dfb775uu.EK30YU8BR/BMsVNfHsBTbcyryqkJ.'),
(5, 'caltabassoto', 'cristina', 'altabas', 'Mujer', '', '', '', 'caltabassoto@gmail.com', 'code_538607fdbb1e93.76175772', 1, '0', '$2y$12$023147767538607fdbb21OCI589nNFhCoIBw4.4eoFDl2HkS7eaae'),
(6, 'laara', 'lara', 'rodriguez marquez', 'Selecionar Opción', NULL, NULL, NULL, 'lara.rodriguez93@gmail.com', 'code_5386081482eb61.28244209', 0, '0', '$2y$12$62855113855386081482eOW.Tkttp8aNK68qH.EIsK6QIvC05MeSO'),
(7, 'juanluis', 'Juan', 'Alcantara', 'Hombre', 'Buganvil·lia', '08940', 'CornellÃ  de Llobregat', 'luisolano12@gmail.com', 'code_5386085ba391a6.25488545', 1, '0', '$2y$12$8128914455386085ba393uJbyFQTArCMEuWjhic0f/OF7iGOinWVy'),
(8, 'martamg', 'marta', 'lapuerta', 'Selecionar Opción', NULL, NULL, NULL, 'martamg26@hotmail.com', 'code_5386087eac9911.52742721', 1, '0', '$2y$12$8699723955386087eac9cufeRbJJdJVJ1wP88ouFXM7/R.QCwPWCS');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD CONSTRAINT `fk_Gallery_Images_Restaurant1` FOREIGN KEY (`cif_restaurant`) REFERENCES `restaurant` (`cif_restaurant`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `gourmet`
--
ALTER TABLE `gourmet`
  ADD CONSTRAINT `fk_Gourmet_Restaurant1` FOREIGN KEY (`cif_restaurant`) REFERENCES `restaurant` (`cif_restaurant`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Gourmet_Type_Gourmet1` FOREIGN KEY (`type_gourmet`) REFERENCES `type_gourmet` (`id_type_gourmet`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_Menu_Restaurant1` FOREIGN KEY (`cif_restaurant`) REFERENCES `restaurant` (`cif_restaurant`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `menu_complete`
--
ALTER TABLE `menu_complete`
  ADD CONSTRAINT `fk_Gourmet_has_Menu_Gourmet1` FOREIGN KEY (`id_gourmet`) REFERENCES `gourmet` (`id_gourmet`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Gourmet_has_Menu_Menu1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_Ratings_Restaurant1` FOREIGN KEY (`cif_restaurant`) REFERENCES `restaurant` (`cif_restaurant`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ratings_User1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rating_notes`
--
ALTER TABLE `rating_notes`
  ADD CONSTRAINT `fk_Type_raitings_has_Ratings_Ratings1` FOREIGN KEY (`id_rating`) REFERENCES `ratings` (`id_rating`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Type_raitings_has_Ratings_Type_raitings1` FOREIGN KEY (`id_type_rating`) REFERENCES `type_ratings` (`id_type_rating`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_Reservations_Restaurant1` FOREIGN KEY (`cif_restaurant`) REFERENCES `restaurant` (`cif_restaurant`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `restaurant_transport`
--
ALTER TABLE `restaurant_transport`
  ADD CONSTRAINT `fk_Restaurant_has_Transport_Restaurant1` FOREIGN KEY (`cif_restaurant`) REFERENCES `restaurant` (`cif_restaurant`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Restaurant_has_Transport_Transport1` FOREIGN KEY (`id_transport`) REFERENCES `transport` (`id_transport`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `fk_Schedules_Type_Day_Week1` FOREIGN KEY (`day_week_start`) REFERENCES `type_day_week` (`id_day_week`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Schedules_Type_Day_Week2` FOREIGN KEY (`day_week_finish`) REFERENCES `type_day_week` (`id_day_week`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `schedule_restaurants`
--
ALTER TABLE `schedule_restaurants`
  ADD CONSTRAINT `fk_Schedules_has_Restaurant_Restaurant1` FOREIGN KEY (`cif_restaurant`) REFERENCES `restaurant` (`cif_restaurant`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Schedules_has_Restaurant_Schedules1` FOREIGN KEY (`id_schedule`) REFERENCES `schedules` (`id_schedule`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `speciality_restaurants`
--
ALTER TABLE `speciality_restaurants`
  ADD CONSTRAINT `fk_Restaurant_has_Speciality_Restaurant1` FOREIGN KEY (`cif_restaurant`) REFERENCES `restaurant` (`cif_restaurant`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Restaurant_has_Speciality_Speciality1` FOREIGN KEY (`speciality`) REFERENCES `speciality` (`id_speciality`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tables_restaurant`
--
ALTER TABLE `tables_restaurant`
  ADD CONSTRAINT `fk_Table_Restaurant1` FOREIGN KEY (`cif_restaurant`) REFERENCES `restaurant` (`cif_restaurant`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `total_reservations`
--
ALTER TABLE `total_reservations`
  ADD CONSTRAINT `fk_User_has_Reservations_Reservations1` FOREIGN KEY (`id_reservation`) REFERENCES `reservations` (`id_reservation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_Reservations_Table1` FOREIGN KEY (`id_table_restaurant`) REFERENCES `tables_restaurant` (`id_table`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_User_has_Reservations_User1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `fk_Transport_Type_transport1` FOREIGN KEY (`type_transport`) REFERENCES `type_transport` (`id_type_transport`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
