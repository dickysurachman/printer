ALTER TABLE `item` CHANGE `var_1` `var_1` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL, 
CHANGE `var_2` `var_2` VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
 CHANGE `biner` `biner` VARCHAR(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL, 
 CHANGE `var_3` `var_3` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;

alter TABLE `item` add ulang int(11) NOT NULL DEFAULT '0';


alter TABLE `item` add `var_4` varchar(100) NULL;
alter TABLE `item` add `var_5` varchar(100) NULL;


ALTER TABLE `item` CHANGE `biner` `biner` VARCHAR(500) 
#
alter TABLE `item` add `gagal` int(11) DEFAULT '0';

CREATE TABLE `itemkardus` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `var_1` varchar(200) DEFAULT NULL,
  `var_2` varchar(200) DEFAULT NULL,
  `biner` varchar(500) DEFAULT NULL,
  `var_3` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT 0,
  `ulang` int(11) NOT NULL DEFAULT 0,
  `var_4` varchar(100) DEFAULT NULL,
  `var_5` varchar(100) DEFAULT NULL,
  `var_6` varchar(100) DEFAULT NULL,
  `var_7` varchar(100) DEFAULT NULL,
  `var_8` varchar(100) DEFAULT NULL,
  `var_9` varchar(100) DEFAULT NULL,
  `var_10` varchar(100) DEFAULT NULL,
  `hitung` int(11) DEFAULT 0,
  `gagal` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `itemkardus`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itemkardus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
CREATE TABLE `itempallet` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `var_1` varchar(200) DEFAULT NULL,
  `var_2` varchar(200) DEFAULT NULL,
  `biner` varchar(500) DEFAULT NULL,
  `var_3` varchar(100) DEFAULT NULL,
  `var_6` varchar(100) DEFAULT NULL,
  `var_7` varchar(100) DEFAULT NULL,
  `var_8` varchar(100) DEFAULT NULL,
  `var_9` varchar(100) DEFAULT NULL,
  `var_10` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT 0,
  `ulang` int(11) NOT NULL DEFAULT 0,
  `var_4` varchar(100) DEFAULT NULL,
  `var_5` varchar(100) DEFAULT NULL,
  `hitung` int(11) DEFAULT 0,
  `gagal` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `itempallet`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itempallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

create table `logitem`(
`id` int(11) NOT NULL,
`tanggal` datetime DEFAULT current_timestamp(),
`status` int(2) DEFAULT 0,
`logbaca` text null
);
ALTER TABLE `logitem`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `logitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

create table `perusahaan`(
`id` int(11) NOT NULL,
`tanggal` datetime DEFAULT current_timestamp(),
`nama` varchar(100) DEFAULT NULL,
`telp` varchar(100) DEFAULT NULL,
`alamat` varchar(100) DEFAULT NULL,
`status` int(2) DEFAULT 0
);
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `itemkardus` CHANGE `var_6` `var_6` int(11) NULL;
ALTER TABLE `itemkardus` CHANGE `var_8` `var_8` int(11) NULL;

ALTER TABLE `itempallet` CHANGE `var_6` `var_6` int(11) NULL;
ALTER TABLE `itempallet` CHANGE `var_8` `var_8` int(11) NULL;



CREATE TABLE `itemmaster` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `itemmaster`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itemmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `itemmasterd` (
  `id` int(11) NOT NULL,
  `idmaster` int(11) DEFAULT NULL,
  `iddetail` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `itemmasterd`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itemmasterd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
  ALTER TABLE `itemmasterd` CHANGE `idmaster` `idmaster` INT(11) NULL, CHANGE `iddetail` `iddetail` INT(11) NULL;


CREATE TRIGGER `delete` AFTER DELETE ON `itemmaster` FOR EACH ROW DELETE from itemmasterd where idmaster=old.id;
CREATE TRIGGER `deletem` AFTER DELETE ON `itemmasterd` FOR EACH ROW delete from item where id=old.iddetail


CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama` varchar(100) DEFAULT NULL,
  `nie` varchar(100) DEFAULT NULL,
  `gtin` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
