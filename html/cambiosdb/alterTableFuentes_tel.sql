ALTER TABLE fuente_tel MODIFY horario varchar(25) null;
update fuente_tel set horario = NULL;

ALTER TABLE `opemedios`.`fuente_tel` 
CHANGE COLUMN `horario` `desde` DATETIME NULL DEFAULT NULL ,
ADD COLUMN `hasta` DATETIME NULL DEFAULT NULL AFTER `desde`;

