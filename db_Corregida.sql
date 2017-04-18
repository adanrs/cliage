-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;




-- Dumping structure for table cliage.accountant
CREATE TABLE IF NOT EXISTS `accountant` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `x` varchar(100) NOT NULL,
  `ion_user_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.accountant: 0 rows
/*!40000 ALTER TABLE `accountant` DISABLE KEYS */;
/*!40000 ALTER TABLE `accountant` ENABLE KEYS */;

-- Dumping structure for table cliage.appointment
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `patient` varchar(100) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time_slot` varchar(100) NOT NULL,
  `s_time` varchar(100) NOT NULL,
  `e_time` varchar(100) NOT NULL,
  `remarks` varchar(500) NOT NULL,
  `add_date` varchar(100) NOT NULL,
  `s_time_key` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`s_time`,`e_time`,`doctor`),
  UNIQUE KEY `date` (`date`,`time_slot`,`s_time`,`e_time`,`patient`,`doctor`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.appointment: 3 rows
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
INSERT INTO `appointment` (`id`, `patient`, `doctor`, `date`, `time_slot`, `s_time`, `e_time`, `remarks`, `add_date`, `s_time_key`) VALUES
	(71, '165', '113', '1491084000', '07:15 PM A 08:15 PM', '07:15 PM', '08:15 PM', 'Revisión ', '04/03/17', '231'),
	(70, '166', '113', '1491084000', '07:15 PM A 08:15 PM', '07:15 PM', '08:15 PM', 'Revisión ', '04/03/17', '231');
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;

-- Dumping structure for table cliage.bankb
CREATE TABLE IF NOT EXISTS `bankb` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `group` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.bankb: 0 rows
/*!40000 ALTER TABLE `bankb` DISABLE KEYS */;
/*!40000 ALTER TABLE `bankb` ENABLE KEYS */;

-- Dumping structure for table cliage.department
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `x` varchar(10) NOT NULL,
  `y` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.department: 0 rows
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
/*!40000 ALTER TABLE `department` ENABLE KEYS */;

-- Dumping structure for table cliage.doctor
CREATE TABLE IF NOT EXISTS `doctor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `x` varchar(100) NOT NULL,
  `y` varchar(10) NOT NULL,
  `ion_user_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.doctor: 1 rows
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` (`id`, `img_url`, `name`, `email`, `address`, `phone`, `department`, `profile`, `x`, `y`, `ion_user_id`) VALUES
	(113, '', 'Carlos Perez Escalante', 'carlos.escalante@escalante.com', 'Heredia, San francisco de Heredia casa  residencial el trebol 67', '+(506)87841249', '0', 'Carlos Perez Escalante', '', '', '');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;

-- Dumping structure for table cliage.expense
CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.expense: 0 rows
/*!40000 ALTER TABLE `expense` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense` ENABLE KEYS */;

-- Dumping structure for table cliage.expense_category
CREATE TABLE IF NOT EXISTS `expense_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `x` varchar(100) NOT NULL,
  `y` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.expense_category: 0 rows
/*!40000 ALTER TABLE `expense_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense_category` ENABLE KEYS */;

-- Dumping structure for table cliage.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table cliage.groups: ~8 rows (approximately)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1, 'admin', 'Administrator'),
	(2, 'members', 'General User'),
	(3, 'Accountant', 'For Financial Activities'),
	(4, 'Doctor', ''),
	(5, 'Patient', ''),
	(6, 'Nurse', ''),
	(7, 'Pharmacist', ''),
	(8, 'Laboratorist', '');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;

-- Dumping structure for table cliage.laboratorist
CREATE TABLE IF NOT EXISTS `laboratorist` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `x` varchar(100) NOT NULL,
  `y` varchar(100) NOT NULL,
  `ion_user_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.laboratorist: 0 rows
/*!40000 ALTER TABLE `laboratorist` DISABLE KEYS */;
/*!40000 ALTER TABLE `laboratorist` ENABLE KEYS */;

-- Dumping structure for table cliage.login_attempts
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table cliage.login_attempts: ~0 rows (approximately)
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;

-- Dumping structure for table cliage.medical_history
CREATE TABLE IF NOT EXISTS `medical_history` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `img_url` varchar(500) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.medical_history: 0 rows
/*!40000 ALTER TABLE `medical_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `medical_history` ENABLE KEYS */;

-- Dumping structure for table cliage.medicine
CREATE TABLE IF NOT EXISTS `medicine` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `generic` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `effects` varchar(100) NOT NULL,
  `e_date` varchar(70) NOT NULL,
  `add_date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.medicine: 0 rows
/*!40000 ALTER TABLE `medicine` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicine` ENABLE KEYS */;

-- Dumping structure for table cliage.medicine_category
CREATE TABLE IF NOT EXISTS `medicine_category` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.medicine_category: 0 rows
/*!40000 ALTER TABLE `medicine_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicine_category` ENABLE KEYS */;

-- Dumping structure for table cliage.nurse
CREATE TABLE IF NOT EXISTS `nurse` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `x` varchar(100) NOT NULL,
  `y` varchar(100) NOT NULL,
  `z` varchar(100) NOT NULL,
  `ion_user_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.nurse: 0 rows
/*!40000 ALTER TABLE `nurse` DISABLE KEYS */;
/*!40000 ALTER TABLE `nurse` ENABLE KEYS */;

-- Dumping structure for table cliage.patient
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `birthdate` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `bloodgroup` varchar(100) NOT NULL,
  `ion_user_id` varchar(100) NOT NULL,
  `patient_id` varchar(100) NOT NULL,
  `add_date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=168 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.patient: 3 rows
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` (`id`, `img_url`, `name`, `email`, `doctor`, `address`, `phone`, `sex`, `birthdate`, `age`, `bloodgroup`, `ion_user_id`, `patient_id`, `add_date`) VALUES
	(165, '', 'Sergio Arguedas', 'sergio.arguedas@hotmail.com', 'Carlos Perez Escalante', 'Heredia, San francisco de Heredia casa  residencial el trebol 67', '+(506)87841249', 'Male', '01-11-2016', '', '0', '', '429831', '11/28/16'),
	(166, '', 'Adan Rivera', 'adan-rivera-sanchez@hotmail.com', 'Carlos Perez Escalante', 'Heredia, San francisco de Heredia casa  residencial el trebol 67', '+(506)87841249', 'Male', '09-11-2016', '', '0', '', '887761', '11/28/16'),
	(167, '', 'd.godinez@test.com', 'rivedansancheasdz19@gmail.com', 'Carlos Perez Escalante', 'Heredia, San francisco de Heredia casa  residencial el trebol 67', '+(506)87841249', 'Male', '', '', '0', '', '203691', '11/28/16');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;

-- Dumping structure for table cliage.payment
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `patient` varchar(100) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `vat` varchar(100) NOT NULL DEFAULT '0',
  `x_ray` varchar(100) NOT NULL,
  `flat_vat` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL DEFAULT '0',
  `flat_discount` varchar(100) NOT NULL,
  `gross_total` varchar(100) NOT NULL,
  `hospital_amount` varchar(100) NOT NULL,
  `doctor_amount` varchar(100) NOT NULL,
  `category_amount` varchar(1000) NOT NULL,
  `category_name` varchar(1000) NOT NULL,
  `amount_received` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=506 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.payment: 0 rows
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;

-- Dumping structure for table cliage.payment_category
CREATE TABLE IF NOT EXISTS `payment_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `c_price` varchar(100) NOT NULL,
  `d_commission` int(100) NOT NULL,
  `h_commission` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.payment_category: 0 rows
/*!40000 ALTER TABLE `payment_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_category` ENABLE KEYS */;

-- Dumping structure for table cliage.pharmacist
CREATE TABLE IF NOT EXISTS `pharmacist` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `img_url` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `x` varchar(100) NOT NULL,
  `y` varchar(100) NOT NULL,
  `ion_user_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.pharmacist: 0 rows
/*!40000 ALTER TABLE `pharmacist` DISABLE KEYS */;
/*!40000 ALTER TABLE `pharmacist` ENABLE KEYS */;

-- Dumping structure for table cliage.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `system_vendor` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `facebook_id` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `vat` varchar(100) NOT NULL,
  `codec_username` varchar(100) NOT NULL,
  `codec_purchase_code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table cliage.settings: 1 rows
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `system_vendor`, `title`, `address`, `phone`, `email`, `facebook_id`, `currency`, `discount`, `vat`, `codec_username`, `codec_purchase_code`) VALUES
	(1, 'CLIAGE', 'CLIAGE', 'Moravia , Mall El Dorado', '60555560', 'administracion@cliage.com', '#', 'CRC', 'percentage', 'percentage', '', '');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table cliage.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=342 DEFAULT CHARSET=utf8;

-- Dumping data for table cliage.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
	(1, '127.0.0.1', 'admin', '$2y$08$Rk0QYGiJg9lDvvzIt9xZpOlqe2U43XNfdbXAq4AB2.wmEoW12vOG.', '', 'rivedansanchez19@gmail.com', '', 'hl8HUMdvLwfbOS3dwjAXnuab099f75ecca1eddc7', 1487205126, 'zCeJpcj78CKqJ4sVxVbxcO', 1268889823, 1491178608, 1, 'Admin', 'istrator', 'ADMIN', '0'),
	(339, '::1', 'Sergio Arguedas', '$2y$08$J5iYt8ncHn11P.O/gifYzOfQFoQa020bfhn6FHMXWPpGftr7N2uRO', NULL, 'sergio.arguedas@hotmail.com', NULL, NULL, NULL, NULL, 1480289474, 1480289948, 1, NULL, NULL, NULL, NULL),
	(340, '::1', 'Carlos Perez Escalante', '$2y$08$2iW/gPO4kslJTZLSn2sSmuui8XTqpZs0k1mv/zWehnFbDZvXuCKgO', NULL, 'carlos.escalante@escalante.com', NULL, NULL, NULL, NULL, 1480289504, NULL, 1, NULL, NULL, NULL, NULL),
	(341, '::1', 'Adan Rivera', '$2y$08$hApFJ0.YQi3tGsXv400Rh.OQPrjR58YowQ081gU/VByi3PPN8PmFe', NULL, 'adan-rivera-sanchez@hotmail.com', NULL, NULL, NULL, NULL, 1480291272, NULL, 1, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table cliage.users_groups
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=344 DEFAULT CHARSET=utf8;

-- Dumping data for table cliage.users_groups: ~6 rows (approximately)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(341, 339, 5),
	(342, 340, 4),
	(343, 341, 5);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;


ALTER TABLE `patient`
	ADD UNIQUE INDEX `patient_id` (`patient_id`);