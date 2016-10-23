CREATE TABLE `opemedios`.`tarifarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_fuente` INT NULL,
  `nombre` VARCHAR(150) NOT NULL,
  `columnas` VARCHAR(250) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

  CREATE TABLE `opemedios`.`tarifario_secciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tarifario_id` INT NOT NULL,
  `seccion` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

  CREATE TABLE `opemedios`.`tarifario_detalles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `id_seccion` INT NOT NULL,
  `valores` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));


ALTER TABLE `opemedios`.`tarifarios` 
ADD COLUMN `path_file` VARCHAR(100) NOT NULL AFTER `columnas`;
