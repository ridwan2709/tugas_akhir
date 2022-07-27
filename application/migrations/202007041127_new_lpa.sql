CREATE TABLE `build` (
 `build_id` int(11) NOT NULL AUTO_INCREMENT,
 `student_id` int(11) NOT NULL,
 `user_id` varchar(100) NOT NULL,
 `class_id` int(11) NOT NULL,
 `section_id` int(11) NOT NULL,
 `date` date NOT NULL,
 `adb_1a` int(11) DEFAULT 0,
 `adb_1b` int(11) DEFAULT 0,
 `adb_1c` int(11) DEFAULT 0,
 `adb_1d` int(11) DEFAULT 0,
 `adb_2a` int(11) DEFAULT 0,
 `adb_2b` int(11) DEFAULT 0,
 `adb_2c` int(11) DEFAULT 0,
 `adb_2d` int(11) DEFAULT 0,
 `adb_2e` int(11) DEFAULT 0,
 `adb_3a` int(11) DEFAULT 0,
 `adb_3b` int(11) DEFAULT 0,
 `adb_4a` int(11) DEFAULT 0,
 `adb_4b` int(11) DEFAULT 0,
 `adb_5a` int(11) DEFAULT 0,
 `adb_5b` int(11) DEFAULT 0,
 `adb_6a` int(11) DEFAULT 0,
 `adb_6b` int(11) DEFAULT 0,
 `adb_6c` int(11) DEFAULT 0,
 `adb_6d` int(11) DEFAULT 0,
 `adb_7a` int(11) DEFAULT 0,
 `adb_7b` int(11) DEFAULT 0,
 `adb_7c` int(11) DEFAULT 0,
 `adb_7d` int(11) DEFAULT 0,
 `adb_7e` int(11) DEFAULT 0,
 `adb_8a` int(11) DEFAULT 0,
 `adb_8b` int(11) DEFAULT 0,
 `adb_9a` int(11) DEFAULT 0,
 `adb_9b` int(11) DEFAULT 0,
 PRIMARY KEY (`build_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
