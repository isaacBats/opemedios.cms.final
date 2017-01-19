

CREATE TABLE `opemedios`.`encabezados` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_adjunto` INT NOT NULL,
  `id_fuente` INT NOT NULL,
  `id_seccion` INT NOT NULL,
  `logo` VARCHAR(200) NULL DEFAULT '/assets/images/logo_150X40.png',
  `impactos` INT NULL,
  `costo_cm` VARCHAR(45) NULL,
  `costo_nota` VARCHAR(45) NULL,
  `fecha` VARCHAR(45) NULL,
  `fraccion` VARCHAR(200) NULL,
  `num_pagina` INT NULL,
  `porcentaje` VARCHAR(10) NULL,
  `seccion` VARCHAR(150) NULL,
  `tamanio` VARCHAR(20) NULL,
  `tiraje` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

-- Desarrollo
CREATE TABLE `encabezados` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_adjunto` INT NOT NULL,
  `id_fuente` INT NOT NULL,
  `id_seccion` INT NOT NULL,
  `logo` VARCHAR(200) NULL DEFAULT '/assets/images/logo_150X40.png',
  `impactos` INT NULL,
  `costo_cm` VARCHAR(45) NULL,
  `costo_nota` VARCHAR(45) NULL,
  `fecha` VARCHAR(45) NULL,
  `fraccion` VARCHAR(200) NULL,
  `num_pagina` INT NULL,
  `porcentaje` VARCHAR(10) NULL,
  `seccion` VARCHAR(150) NULL,
  `tamanio` VARCHAR(20) NULL,
  `tiraje` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));



--Anteriormente el campo de fraccion estava con 10 de valor. Se modifico a 200
ALTER TABLE `opemedios`.`encabezados` 
CHANGE COLUMN `fraccion` `fraccion` VARCHAR(200) NULL DEFAULT NULL ;

-- Se anula este cambio en la tabla adjunto ya que el id del archivo al que pertenece se pone en la tabla de encabezados
ALTER TABLE `opemedios`.`adjunto` 
ADD COLUMN `encabezado_id` INT UNSIGNED NULL AFTER `nombre_archivo`,
ADD UNIQUE INDEX `encabezado_id_UNIQUE` (`encabezado_id` ASC);

ALTER TABLE `opemedios`.`adjunto` 
DROP COLUMN `encabezado_id`,
DROP INDEX `encabezado_id_UNIQUE` ;
