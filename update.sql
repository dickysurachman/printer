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