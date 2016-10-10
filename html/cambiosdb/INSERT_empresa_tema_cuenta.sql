select e.id_empresa, e.nombre as empresa, t.id_tema, t.nombre as tema, c.id_cuenta, concat(c.nombre, ' ', c.apellidos) as cliente   from empresa e inner join tema t on e.id_empresa = t.id_empresa inner join cuenta c on e.id_empresa = c.id_empresa
INSERT INTO empresa_tema_cuenta (id_empresa, id_tema, id_cuenta) SELECT e.id_empresa, t.id_tema, c.id_cuenta FROM empresa e INNER JOIN tema t ON e.id_empresa = t.id_empresa INNER JOIN cuenta c ON e.id_empresa = c.id_empresa


CREATE TABLE `empresa_tema_cuenta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8192 DEFAULT CHARSET=latin1;
