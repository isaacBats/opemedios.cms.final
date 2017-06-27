 
 -- Query para actualizar el path de las fuentes
 update fuente set logo = concat('assets/data/fuentes/', logo) where id_fuente < 12339;