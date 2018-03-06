-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2018 a las 22:38:39
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `books`
--

CREATE TABLE `books` (
  `Title` varchar(255) DEFAULT NULL,
  `Author` varchar(255) DEFAULT NULL,
  `Publisher` varchar(255) DEFAULT NULL,
  `Publish date` date DEFAULT NULL,
  `IBAN` varchar(255) DEFAULT NULL,
  `ItemID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cans`
--

CREATE TABLE `cans` (
  `Brand` varchar(255) DEFAULT NULL,
  `Flavor` varchar(255) DEFAULT NULL,
  `Quantity` int(5) DEFAULT NULL,
  `Year` year(4) DEFAULT NULL,
  `Barcode` varchar(255) DEFAULT NULL,
  `ItemID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `collections`
--

CREATE TABLE `collections` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT 'Mi colección',
  `Description` varchar(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Category` varchar(100) NOT NULL,
  `UsersLogin` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `ID` int(20) NOT NULL,
  `CollectionsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemimages`
--

CREATE TABLE `itemimages` (
  `imageID` int(20) NOT NULL,
  `Path` varchar(255) DEFAULT NULL,
  `Description` int(11) DEFAULT NULL,
  `ItemID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movies`
--

CREATE TABLE `movies` (
  `Title` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Year` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Starring` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Directed_By` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Format` enum('DVD','VHS','Blu-Ray','Digital','Betamax') COLLATE utf8_spanish_ci NOT NULL,
  `ItemID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `music`
--

CREATE TABLE `music` (
  `Artist` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Publish Date` date DEFAULT NULL,
  `Total discs` int(3) DEFAULT NULL,
  `Record Company` varchar(255) DEFAULT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Barcode` varchar(255) DEFAULT NULL,
  `ItemID` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userdefinedcollections`
--

CREATE TABLE `userdefinedcollections` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Description` int(11) DEFAULT NULL,
  `User_TableID` text COLLATE utf8_spanish_ci,
  `Image` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `UsersLogin` varchar(16) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `userdefinedcollections`
--

INSERT INTO `userdefinedcollections` (`ID`, `Name`, `Description`, `User_TableID`, `Image`, `UsersLogin`) VALUES
(1, 'ColecciÃ³n de bolÃ­grafos.', 0, 'adammartin_1', 'img/adammartin_1.jpg', 'adammartin'),
(2, 'ColecciÃ³n de bolÃ­grafos.', 0, NULL, 'img/0_default.png', 'adammartin'),
(3, 'ColecciÃ³n de bolÃ­grafos.', 0, NULL, 'img/0_default.png', 'adammartin'),
(4, 'ColecciÃ³n de bolÃ­grafos.', 0, NULL, 'img/0_default.png', 'adammartin'),
(5, 'ColecciÃ³n de bolÃ­grafos.', 0, NULL, 'img/0_default.png', 'adammartin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userdefinedcolumn`
--

CREATE TABLE `userdefinedcolumn` (
  `Name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Type` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Order` int(2) DEFAULT NULL,
  `UserDefinedCollectionsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userdefineditem`
--

CREATE TABLE `userdefineditem` (
  `ItemID` int(11) NOT NULL,
  `column1` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `column2` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `column3` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `column4` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `column5` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `column6` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `userdefinedcollectionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `Login` varchar(16) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `First Name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Last Name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Birth Date` date DEFAULT NULL,
  `Rol` enum('administrator','registered') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'registered',
  `Activated Account` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`Login`, `Password`, `First Name`, `Last Name`, `Email`, `Birth Date`, `Rol`, `Activated Account`) VALUES
('adammartin', '*640ED42F42153C25E1C4DE985A8CDAD27734E905', 'Adam', 'Martin', 'disadamsdsdnts@gmail.com', '0000-00-00', 'registered', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `books`
--
ALTER TABLE `books`
  ADD KEY `FKBooks135814` (`ItemID`);

--
-- Indices de la tabla `cans`
--
ALTER TABLE `cans`
  ADD KEY `FKCans412427` (`ItemID`);

--
-- Indices de la tabla `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `poseen` (`UsersLogin`);

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Contienen` (`CollectionsID`);

--
-- Indices de la tabla `itemimages`
--
ALTER TABLE `itemimages`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `DeleteImageIfItemIsDelete` (`ItemID`);

--
-- Indices de la tabla `movies`
--
ALTER TABLE `movies`
  ADD KEY `ItemID` (`ItemID`);

--
-- Indices de la tabla `music`
--
ALTER TABLE `music`
  ADD KEY `ItemID` (`ItemID`);

--
-- Indices de la tabla `userdefinedcollections`
--
ALTER TABLE `userdefinedcollections`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Tienen` (`UsersLogin`);

--
-- Indices de la tabla `userdefinedcolumn`
--
ALTER TABLE `userdefinedcolumn`
  ADD KEY `FKUserDefine458760` (`UserDefinedCollectionsID`);

--
-- Indices de la tabla `userdefineditem`
--
ALTER TABLE `userdefineditem`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `IfCollectionIsDeletedOrUpdated` (`userdefinedcollectionID`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `collections`
--
ALTER TABLE `collections`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `item`
--
ALTER TABLE `item`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `itemimages`
--
ALTER TABLE `itemimages`
  MODIFY `imageID` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `userdefinedcollections`
--
ALTER TABLE `userdefinedcollections`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `userdefineditem`
--
ALTER TABLE `userdefineditem`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `FKBooks135814` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ID`);

--
-- Filtros para la tabla `cans`
--
ALTER TABLE `cans`
  ADD CONSTRAINT `FKCans412427` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ID`);

--
-- Filtros para la tabla `collections`
--
ALTER TABLE `collections`
  ADD CONSTRAINT `poseen` FOREIGN KEY (`UsersLogin`) REFERENCES `users` (`Login`);

--
-- Filtros para la tabla `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `Contienen` FOREIGN KEY (`CollectionsID`) REFERENCES `collections` (`ID`);

--
-- Filtros para la tabla `itemimages`
--
ALTER TABLE `itemimages`
  ADD CONSTRAINT `DeleteImageIfItemIsDelete` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `IfItemIsDeleted` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `music`
--
ALTER TABLE `music`
  ADD CONSTRAINT `DeleteIfItemIsDeleted` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `userdefinedcollections`
--
ALTER TABLE `userdefinedcollections`
  ADD CONSTRAINT `Tienen` FOREIGN KEY (`UsersLogin`) REFERENCES `users` (`Login`);

--
-- Filtros para la tabla `userdefinedcolumn`
--
ALTER TABLE `userdefinedcolumn`
  ADD CONSTRAINT `FKUserDefine458760` FOREIGN KEY (`UserDefinedCollectionsID`) REFERENCES `userdefinedcollections` (`ID`);

--
-- Filtros para la tabla `userdefineditem`
--
ALTER TABLE `userdefineditem`
  ADD CONSTRAINT `IfCollectionIsDeletedOrUpdated` FOREIGN KEY (`userdefinedcollectionID`) REFERENCES `userdefinedcollections` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
