CREATE TABLE `homeschooling-edu`.`kategori` ( `id_kategori` INT NOT NULL AUTO_INCREMENT , `nama` VARCHAR(50) NOT NULL , PRIMARY KEY (`id_kategori`)) ENGINE = InnoDB;

CREATE TABLE `homeschooling-edu`.`galeri` ( `id_galeri` INT NOT NULL AUTO_INCREMENT , `id_kategori` INT NOT NULL , `gambar` VARCHAR(255) NOT NULL , PRIMARY KEY (`id_galeri`)) ENGINE = InnoDB;

ALTER TABLE `galeri` ADD `tgl_update` DATE NOT NULL AFTER `gambar`;
