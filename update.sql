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
CREATE TRIGGER `deletem` AFTER DELETE ON `itemmasterd` FOR EACH ROW delete from item where id=old.iddetail;


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



CREATE TABLE `scanlog` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `scan` varchar(300) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `scanlog`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `scanlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `itemcamera` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `var_1` varchar(200) DEFAULT NULL,
  `var_2` varchar(200) DEFAULT NULL,
  `var_3` varchar(100) DEFAULT NULL,
  `var_4` varchar(100) DEFAULT NULL,
  `var_5` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT 0,
  `hitung` int(11) DEFAULT 0,
  `gagal` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
ALTER TABLE `itemcamera`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itemcamera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;





CREATE TABLE `itemmasterk` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `itemmasterk`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itemmasterk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `itemmasterkd` (
  `id` int(11) NOT NULL,
  `idmaster` int(11) DEFAULT NULL,
  `iddetail` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `itemmasterkd`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itemmasterkd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  

CREATE TRIGGER `deletej` AFTER DELETE ON `itemmasterk` FOR EACH ROW DELETE from itemmasterkd where idmaster=old.id;
CREATE TRIGGER `deletejm` AFTER DELETE ON `itemmasterkd` FOR EACH ROW delete from itemkardus where id=old.iddetail;

CREATE TABLE `itemmasterp` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `itemmasterp`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itemmasterp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `itemmasterpd` (
  `id` int(11) NOT NULL,
  `idmaster` int(11) DEFAULT NULL,
  `iddetail` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `itemmasterpd`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itemmasterpd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  

CREATE TRIGGER `deletep` AFTER DELETE ON `itemmasterp` FOR EACH ROW DELETE from itemmasterpd where idmaster=old.id;
CREATE TRIGGER `deletepm` AFTER DELETE ON `itemmasterpd` FOR EACH ROW delete from itempallet where id=old.iddetail;


alter table `itemmaster` add `linenm` varchar(100) DEFAULT NULL, add `shift` int(2) DEFAULT '0', add `machine` int(11) DEFAULT NULL;

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama` varchar(100) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

alter table `itemmaster` add `var_1` varchar(100) DEFAULT NULL,add `var_2` varchar(100) DEFAULT NULL,
add `var_3` varchar(100) DEFAULT NULL,add `var_4` varchar(100) DEFAULT NULL,add `var_5` varchar(100) DEFAULT NULL,
add `job_id` int(11) DEFAULT NULL;

CREATE TABLE `linenm` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `linenm`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `linenm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  alter table `itemmaster` add `id_line` int(11) DEFAULT NULL;
  alter table `item` add `edit_date` datetime DEFAULT NULL;
  alter table `item` add `machine` int(11) DEFAULT NULL;


CREATE TABLE `itemmasterscan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `nama` varchar(100) DEFAULT NULL,
  `status` int(2) DEFAULT 0,
  `linenm` varchar(100) DEFAULT NULL,
  `shift` int(2) DEFAULT 0,
  `machine` int(11) DEFAULT NULL,
  `var_1` varchar(100) DEFAULT NULL,
  `var_2` varchar(100) DEFAULT NULL,
  `var_3` varchar(100) DEFAULT NULL,
  `var_4` varchar(100) DEFAULT NULL,
  `var_5` varchar(100) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `id_line` int(11) DEFAULT NULL
) ENGINE=InnoDB ;
CREATE TRIGGER `deletesc` AFTER DELETE ON `itemmasterscan` FOR EACH ROW DELETE from itemmasterscand where idmaster=old.id;

CREATE TABLE `itemmasterscand` (
  `id` int(11) NOT NULL,
  `idmaster` int(11) DEFAULT NULL,
  `iddetail` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB;

CREATE TRIGGER `deletescm` AFTER DELETE ON `itemmasterscand` FOR EACH ROW delete from itemcamera where id=old.iddetail;
ALTER TABLE `itemmasterscan`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itemmasterscand`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `itemmasterscan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `itemmasterscand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

alter table `scanlog` add machine int(11) DEFAULT NULL;
ALTER TABLE `item` ADD INDEX(`var_5`);
alter table `scanlog` add process int(2) DEFAULT '0';
alter table `itemmasterd` add `statusc` int(2) DEFAULT '0';
alter table `scanlog` add dbs varchar(10) DEFAULT NULL;
alter table `scanlog` add stat varchar(10) DEFAULT NULL;

alter table `scanlog` add id_job int(11) DEFAULT NULL;
alter table `scanlog` add id_item int(11) DEFAULT NULL;
alter table `logitem` add machine int(11) DEFAULT NULL;
alter table `logitem` add ip varchar(30) DEFAULT NULL;



CREATE TABLE `scanlogcarton` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `scan` varchar(300) DEFAULT NULL,
  `status` int(2) DEFAULT 0,
  `machine` int(11) DEFAULT NULL,
  `process` int(2) DEFAULT 0,
  `dbs` varchar(10) DEFAULT NULL,
  `stat` varchar(10) DEFAULT NULL,
  `id_job` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `scanlogcarton`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `scanlogcarton`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `scanlogpallet` (
  `id` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `scan` varchar(300) DEFAULT NULL,
  `status` int(2) DEFAULT 0,
  `machine` int(11) DEFAULT NULL,
  `process` int(2) DEFAULT 0,
  `dbs` varchar(10) DEFAULT NULL,
  `stat` varchar(10) DEFAULT NULL,
  `id_job` int(11) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `scanlogpallet`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `scanlogpallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;





alter table `itemmasterk` add `var_1` varchar(100) DEFAULT NULL,add `var_2` varchar(100) DEFAULT NULL,
add `var_3` varchar(100) DEFAULT NULL,add `var_4` varchar(100) DEFAULT NULL,add `var_5` varchar(100) DEFAULT NULL,
add `job_id` int(11) DEFAULT NULL, add `id_line` int(11) DEFAULT NULL;
alter table `itemmasterp` add `var_1` varchar(100) DEFAULT NULL,add `var_2` varchar(100) DEFAULT NULL,
add `var_3` varchar(100) DEFAULT NULL,add `var_4` varchar(100) DEFAULT NULL,add `var_5` varchar(100) DEFAULT NULL,
add `job_id` int(11) DEFAULT NULL, add `id_line` int(11) DEFAULT NULL;


CREATE TABLE `kardusitem` (
  `id` int(11) NOT NULL,
  `idkardus` int(11) DEFAULT NULL,
  `iddetail` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `kardusitem`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `kardusitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `palletkardus` (
  `id` int(11) NOT NULL,
  `idpallet` int(11) DEFAULT NULL,
  `idkardus` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT 0
) ENGINE=InnoDB ;
ALTER TABLE `palletkardus`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `palletkardus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TRIGGER `deleteki` AFTER DELETE ON `itemmasterk` FOR EACH ROW DELETE from kardusitem where idkardus=old.id;
CREATE TRIGGER `deletepk` AFTER DELETE ON `itemmasterp` FOR EACH ROW DELETE from palletkardus where idpallet=old.id;


alter table `itemmasterk` add shift int(2) DEFAULT '0';
alter table `itemmasterp` add shift int(2) DEFAULT '0';
alter table `itemmasterk` add machine int(11) DEFAULT NULL;
alter table `itemmasterp` add machine int(11) DEFAULT NULL;

alter table `itemmasterk` add `linenm` varchar(100) DEFAULT NULL;
alter table `itemmasterp` add `linenm` varchar(100) DEFAULT NULL;


16-9-2022
alter table `kardusitem` add `tanggal` datetime DEFAULT current_timestamp();
alter table `palletkardus` add `tanggal` datetime DEFAULT current_timestamp();

