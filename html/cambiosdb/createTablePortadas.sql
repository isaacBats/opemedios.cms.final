  CREATE TABLE `opemedios`.`portadas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fuente_id` INT NOT NULL,
  `imagen` VARCHAR(250) NOT NULL,
  `thumb` VARCHAR(250) NOT NULL,
  `tipo_portada` ENUM('PORTADA_POLITICA', 'PORTADA_FINANCIERA', 'CARTON') NOT NULL,
  `orden` INT NULL,
  `created_at` DATE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

ALTER TABLE `opemedios`.`portadas` 
CHANGE COLUMN `tipo_portada` `tipo_portada` ENUM('PRIMERAS_PLANAS', 'PORTADA_FINANCIERA', 'CARTON') NOT NULL ;


ALTER TABLE `opemedios`.`portadas` 
CHANGE COLUMN `created_at` `created_at` DATETIME NOT NULL ;
