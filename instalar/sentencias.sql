CREATE USER 'anunciosDB'@'%' IDENTIFIED VIA mysql_native_password USING '***';GRANT USAGE ON *.* TO 'anunciosDB'@'%'
 REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;

 CREATE DATABASE IF NOT EXISTS `anunciosDB`;

 GRANT ALL PRIVILEGES ON `anunciosDB`.* TO 'anunciosDB'@'%';

CREATE TABLE `usuarios` (
  `login` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rol` set('administrador','registrado') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`login`);
COMMIT;
