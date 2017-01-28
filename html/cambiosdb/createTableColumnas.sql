
CREATE TABLE `opemedios`.`columnas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fuente_id` INT NOT NULL,
  `tipo_columna` ENUM('COLUMNA_FINANCIERA', 'COLUMNA_POLITICA') NOT NULL,
  `titulo` VARCHAR(150) NOT NULL,
  `autor` VARCHAR(80) NOT NULL,
  `contenido` LONGTEXT NOT NULL,
  `imaneges_contenido` VARCHAR(250) NULL,
  `imagen` VARCHAR(250) NULL,
  `thumb` VARCHAR(250) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

CREATE TABLE `columnas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fuente_id` INT NOT NULL,
  `tipo_columna` ENUM('COLUMNA_FINANCIERA', 'COLUMNA_POLITICA') NOT NULL,
  `titulo` VARCHAR(150) NOT NULL,
  `autor` VARCHAR(80) NOT NULL,
  `contenido` LONGTEXT NOT NULL,
  `imaneges_contenido` VARCHAR(250) NULL,
  `imagen` VARCHAR(250) NULL,
  `thumb` VARCHAR(250) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));
