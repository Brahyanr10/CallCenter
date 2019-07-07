
CREATE TABLE IF NOT EXISTS `callcenter`.`tipo_usuario`(
`idtipo_usuario` INT NOT NULL AUTO_INCREMENT,

`descripcion` VARCHAR(45) NOT NULL,

PRIMARY KEY (`idtipo_usuario`))
ENGINE = InnoDB;




CREATE TABLE IF NOT EXISTS `callcenter`.`Usuarios` (

`idUsuarios` INT NOT NULL AUTO_INCREMENT,

`identificacion` INT NOT NULL,

`nombre` VARCHAR(45) NOT NULL,

`apellido` VARCHAR(45) NOT NULL,
`Correo` VARCHAR(45) NOT NULL,

`telefono` INT NULL,

`password` VARCHAR(45) NOT NULL,

`id_tipo_usuario` INT NOT NULL,
  PRIMARY KEY (`idUsuarios`),

CONSTRAINT `usuario_tipo`
 FOREIGN KEY (`id_tipo_usuario`)
REFERENCES `callcenter`.`tipo_usuario` (`idtipo_usuario`)

ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `callcenter`.`comuna` (

`idcomuna` INT NOT NULL AUTO_INCREMENT,

`nom_comuna` VARCHAR(45) NOT NULL,

PRIMARY KEY (`idcomuna`))
ENGINE = InnoDB;




CREATE TABLE IF NOT EXISTS `callcenter`.`barrio` (

`idbarrio` INT NOT NULL AUTO_INCREMENT,

`nom_barrio` VARCHAR(45) NOT NULL,

`idcomuna` INT NULL,

PRIMARY KEY (`idbarrio`),


CONSTRAINT `barrio_comuna`

FOREIGN KEY (`idcomuna`)

REFERENCES `callcenter`.`comuna` (`idcomuna`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



CREATE TABLE IF NOT EXISTS `callcenter`.`puesto_votacion` (

`idpuesto_votacion` INT NOT NULL AUTO_INCREMENT,

`nombre` VARCHAR(80) NOT NULL,

`direccion` VARCHAR(80) NULL,

`idbarrio` INT NOT NULL,

PRIMARY KEY (`idpuesto_votacion`),

CONSTRAINT `puesto_barrio`
    FOREIGN KEY (`idbarrio`)

 REFERENCES `callcenter`.`barrio` (`idbarrio`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `callcenter`.`datos` (

`iddatos` INT NOT NULL AUTO_INCREMENT,

`num_planilla` VARCHAR(45) NULL,

` nombres` VARCHAR(45) NOT NULL,

`apellidos` VARCHAR(45) NOT NULL,

`celular` INT NULL,

`direccion` VARCHAR(100) NULL,

`idbarrio` INT NULL,

`email` VARCHAR(60) NULL,

`id_puesto_votacion` INT NULL,

`idusuario` INT NOT NULL,

PRIMARY KEY (`iddatos`),

CONSTRAINT `datos_barrio`

FOREIGN KEY (`idbarrio`)

REFERENCES `callcenter`.`barrio` (`idbarrio`)

ON DELETE CASCADE
    ON UPDATE CASCADE,

CONSTRAINT `datos_usuario`

FOREIGN KEY (`idusuario`)

REFERENCES `callcenter`.`Usuarios` (`idUsuarios`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

CONSTRAINT `datos_puestos`

FOREIGN KEY (`id_puesto_votacion`)

REFERENCES `callcenter`.`puesto_votacion` (`idpuesto_votacion`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
