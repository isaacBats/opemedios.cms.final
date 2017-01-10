

CREATE TABLE `opemedios`.`encabezado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `logo` VARCHAR(200) NULL DEFAULT '/assets/images/logo_150X40.png',
  `impactos` INT NULL,
  `costo_cm` VARCHAR(45) NULL,
  `costo_nota` VARCHAR(45) NULL,
  `fecha` VARCHAR(45) NULL,
  `fraccion` VARCHAR(10) NULL,
  `num_pagina` INT NULL,
  `porcentaje` VARCHAR(10) NULL,
  `seccion` VARCHAR(150) NULL,
  `tamanio` VARCHAR(20) NULL,
  `tiraje` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));


ALTER TABLE `opemedios`.`adjunto` 
ADD COLUMN `encabezado_id` INT UNSIGNED NULL AFTER `nombre_archivo`,
ADD UNIQUE INDEX `encabezado_id_UNIQUE` (`encabezado_id` ASC);
