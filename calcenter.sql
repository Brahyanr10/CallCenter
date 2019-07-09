


CREATE TABLE `barrio` (

`idbarrio` int(11) NOT NULL,

`nom_barrio` varchar(45) COLLATE utf8_spanish_ci NOT NULL,

`idcomuna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `comuna` (

`idcomuna` int(11) NOT NULL,

`nom_comuna` varchar(45)
COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `datos` (

`iddatos` int(11) NOT NULL,

`num_planilla` varchar(45)
COLLATE utf8_spanish_ci DEFAULT NULL,

`lider_referido` varchar(60)
COLLATE utf8_spanish_ci DEFAULT NULL,

`nombres` varchar(60)
COLLATE utf8_spanish_ci DEFAULT NULL,

`apellidos` varchar(45)
COLLATE utf8_spanish_ci DEFAULT NULL,

`identificacion` int(11) DEFAULT NULL,

`celular` int(11) DEFAULT NULL,

`direccion` varchar(100)
COLLATE utf8_spanish_ci DEFAULT NULL,

`idbarrio` int(11) DEFAULT NULL,

`email` varchar(60)
COLLATE utf8_spanish_ci DEFAULT NULL,

`id_puesto_votacion` int(11) DEFAULT NULL
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto_votacion`
--


CREATE TABLE `puesto_votacion` (

`idpuesto_votacion` int(11) NOT NULL,

`nombre` varchar(80) COLLATE utf8_spanish_ci NOT NULL,

`direccion` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,

`idbarrio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;




-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--


CREATE TABLE `tipo_usuario` (

`idtipo_usuario` int(11) NOT NULL,
  `
descripcion` varchar(45)
COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--


CREATE TABLE `usuarios`(

`idUsuarios` int(11) NOT NULL,

`identificacion` int(11) NOT NULL,

`nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,

`apellido` varchar(45) COLLATE utf8_spanish_ci NOT NULL,

`Correo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,

`telefono` int(11) DEFAULT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci NOT NULL,

`id_tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;




ALTER TABLE `barrio`
  ADD PRIMARY KEY (`idbarrio`),
  ADD KEY `barrio_comuna` (`idcomuna`);



ALTER TABLE `comuna`
  ADD PRIMARY KEY (`idcomuna`);



ALTER TABLE `datos`
  ADD PRIMARY KEY (`iddatos`),

ADD KEY `datos_barrio` (`idbarrio`),

ADD KEY `datos_puestos` (`id_puesto_votacion`);




ALTER TABLE `puesto_votacion`
  ADD PRIMARY KEY (`idpuesto_votacion`),

ADD KEY `puesto_barrio` (`idbarrio`);


ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`idtipo_usuario`);




ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),

ADD KEY `usuario_tipo` (`id_tipo_usuario`);


ALTER TABLE `barrio`
  MODIFY `idbarrio` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT=1;


ALTER TABLE `comuna`
  MODIFY `idcomuna` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT=1;

ALTER TABLE `datos`
  MODIFY `iddatos` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT=1;

ALTER TABLE `puesto_votacion`
  MODIFY `idpuesto_votacion` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT=1;



ALTER TABLE `tipo_usuario`
  MODIFY `idtipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT=1;


ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT=1;


ALTER TABLE `barrio`
  ADD CONSTRAINT `barrio_comuna` FOREIGN KEY (`idcomuna`) REFERENCES `comuna` (`idcomuna`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `datos`
  ADD CONSTRAINT `datos_barrio` FOREIGN KEY (`idbarrio`) REFERENCES `barrio` (`idbarrio`) ON DELETE CASCADE ON UPDATE CASCADE,

ADD CONSTRAINT `datos_puestos` FOREIGN KEY (`id_puesto_votacion`) REFERENCES `puesto_votacion` (`idpuesto_votacion`) ON DELETE CASCADE ON UPDATE CASCADE;



ALTER TABLE `puesto_votacion`
  ADD CONSTRAINT `puesto_barrio` FOREIGN KEY (`idbarrio`) REFERENCES `barrio` (`idbarrio`) ON DELETE CASCADE ON UPDATE CASCADE;



ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuario_tipo` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`idtipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
