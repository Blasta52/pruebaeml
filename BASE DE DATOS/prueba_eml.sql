
CREATE TABLE `cuentas` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `cuentas` (`id`, `email`, `password`, `fullname`) VALUES
(1, 'prueba@eml.com', '25d55ad283aa400af464c76d713c07ad', 'Brayan Parra');


CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_de_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_de_modificacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `cedula`, `correo`, `telefono`, `fecha_de_registro`, `fecha_de_modificacion`) VALUES
(31, 'Brayan Adilson', 'Parra Baron', '1013672344', 'yanbra37@hotmail.com', '3213213212', '2020-09-14 04:11:09', '2020-09-14 04:11:09'),
(32, 'Fernando', 'Parra Pineda', '101010101010', 'fernando@eml.com', '3213213213', '2020-09-14 04:11:33', '2020-09-14 04:11:33'),
(33, 'David Mauricio', 'Parra Baron', '101010918181', 'david@eml.com', '3213223232', '2020-09-14 04:11:58', '2020-09-14 04:11:58'),
(34, 'Neider Fernando', 'Parra Baron', '102823848382', 'neider@eml.com', '3213213232', '2020-09-14 04:12:18', '2020-09-14 04:12:18'),
(35, 'Yolima', 'Baron Echeverria', '1339292929', 'yolima@eml.com', '3232323212', '2020-09-14 04:12:45', '2020-09-14 04:12:45');

ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `IND EMAIL` (`email`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `IDX_cedula` (`cedula`),
  ADD UNIQUE KEY `IDX_correo` (`correo`);

ALTER TABLE `cuentas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

