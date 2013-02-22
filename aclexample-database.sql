-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2013 at 07:49 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aclexample`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `module` varchar(50) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `acl`
--

INSERT INTO `acl` (`id`, `module`, `controller`, `action`) VALUES
(1, 'admin', 'index', 'index'),
(2, 'default', 'error', 'error'),
(3, 'admin', 'error', 'error'),
(4, 'default', 'index', 'index'),
(5, 'all', 'all', 'all'),
(16, 'admin', 'index', 'page'),
(17, 'admin', 'index', 'upload'),
(18, 'admin', 'index', 'generate-resources'),
(19, 'error', 'error', 'error'),
(20, 'admin', 'index', 'logoutuser');

-- --------------------------------------------------------

--
-- Table structure for table `acl_role`
--

CREATE TABLE IF NOT EXISTS `acl_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) DEFAULT NULL,
  `acl_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id_idx` (`role_id`),
  KEY `acl_id_idx` (`acl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `acl_role`
--

INSERT INTO `acl_role` (`id`, `role_id`, `acl_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2),
(4, 1, 4),
(5, 3, 5),
(6, 1, 20),
(7, 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `allow_acl`
--

CREATE TABLE IF NOT EXISTS `allow_acl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `acl_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `acl_id_idx` (`acl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `allow_acl`
--

INSERT INTO `allow_acl` (`id`, `user_id`, `acl_id`) VALUES
(1, 1, 3),
(2, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `first_name`, `last_name`, `phone`, `email`, `address`) VALUES
(1, 'Ashish', 'patel', '234234', 'asdfa@dfas.com', 'asdfj;l');

-- --------------------------------------------------------

--
-- Table structure for table `deny_acl`
--

CREATE TABLE IF NOT EXISTS `deny_acl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `acl_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `acl_id_idx` (`acl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'guest'),
(3, 'super');

-- --------------------------------------------------------

--
-- Table structure for table `roles_inheritances`
--

CREATE TABLE IF NOT EXISTS `roles_inheritances` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_role_id` bigint(20) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `position` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles_inheritances`
--

INSERT INTO `roles_inheritances` (`id`, `parent_role_id`, `role_id`, `position`) VALUES
(5, 1, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` varchar(255) DEFAULT NULL,
  `session_data` varchar(255) DEFAULT NULL,
  `lifetime` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `session_data`, `lifetime`, `created_at`, `updated_at`) VALUES
('1lnf26kjme6ood422lnuigtm60', 'My_ACL_Namespace|a:1:{s:3:"acl";O:8:"Zend_Acl":6:{s:16:"\0*\0_roleRegistry";O:22:"Zend_Acl_Role_Registry":1:{s:9:"\0*\0_roles";a:2:{s:5:"admin";a:3:{s:8:"instance";O:13:"Zend_Acl_Role":1:{s:10:"\0*\0_roleId";s:5:"admin";}s:7:"parents";a:0:{}s:8:"children";a:0:{', 1440, '0000-00-00 00:00:00', 1361280902),
('leire0mqketbq3slf304s2t5b3', 'My_ACL_Namespace|N;Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":7:{s:2:"id";s:1:"1";s:8:"username";s:6:"ashish";s:8:"password";s:32:"900150983cd24fb0d6963f7d28e17f72";s:10:"contact_id";s:1:"1";s:7:"address";s:7:"asdfj;l";s:7:"role_id";s:1:"1";s:4:"salt";s:', 1440, '0000-00-00 00:00:00', 1361336437),
('in01pr67uc6ca2bprb4539b3e4', 'My_Control_Panel|a:1:{s:8:"clearACL";N;}Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":7:{s:2:"id";s:1:"2";s:8:"username";s:5:"super";s:8:"password";s:32:"900150983cd24fb0d6963f7d28e17f72";s:10:"contact_id";s:1:"1";s:7:"address";N;s:7:"role_id";s:1:"3";s:4:"', 1440, '0000-00-00 00:00:00', 1361365815),
('s1ktc90vccrkkeda3hgdkcmvu6', 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":7:{s:2:"id";s:1:"2";s:8:"username";s:5:"super";s:8:"password";s:32:"900150983cd24fb0d6963f7d28e17f72";s:10:"contact_id";s:1:"1";s:7:"address";N;s:7:"role_id";s:1:"3";s:4:"salt";s:0:"";}}My_Control_Panel|a:2:{s:8', 1440, '0000-00-00 00:00:00', 1361421473),
('eboltfqo5hb0ajteiqdbg2ka45', 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":7:{s:2:"id";s:1:"2";s:8:"username";s:5:"super";s:8:"password";s:32:"900150983cd24fb0d6963f7d28e17f72";s:10:"contact_id";s:1:"1";s:7:"address";N;s:7:"role_id";s:1:"3";s:4:"salt";s:0:"";}}My_Control_Panel|a:2:{s:8', 1440, '0000-00-00 00:00:00', 1361435279),
('trmoq7qtktf4ved791i8lvfau7', 'Zend_Auth|a:1:{s:7:"storage";O:8:"stdClass":7:{s:2:"id";s:1:"2";s:8:"username";s:5:"super";s:8:"password";s:32:"900150983cd24fb0d6963f7d28e17f72";s:10:"contact_id";s:1:"1";s:7:"address";N;s:7:"role_id";s:1:"3";s:4:"salt";s:0:"";}}My_Control_Panel|a:2:{s:8', 1440, '0000-00-00 00:00:00', 1361442700);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contact_id` bigint(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_id_idx` (`contact_id`),
  KEY `role_id_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `contact_id`, `address`, `role_id`, `salt`) VALUES
(1, 'ashish', '900150983cd24fb0d6963f7d28e17f72', 1, 'asdfj;l', 1, ''),
(2, 'super', '900150983cd24fb0d6963f7d28e17f72', 1, NULL, 3, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl_role`
--
ALTER TABLE `acl_role`
  ADD CONSTRAINT `acl_role_acl_id_acl_id` FOREIGN KEY (`acl_id`) REFERENCES `acl` (`id`),
  ADD CONSTRAINT `acl_role_role_id_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `allow_acl`
--
ALTER TABLE `allow_acl`
  ADD CONSTRAINT `allow_acl_acl_id_acl_id` FOREIGN KEY (`acl_id`) REFERENCES `acl` (`id`),
  ADD CONSTRAINT `allow_acl_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `deny_acl`
--
ALTER TABLE `deny_acl`
  ADD CONSTRAINT `deny_acl_acl_id_acl_id` FOREIGN KEY (`acl_id`) REFERENCES `acl` (`id`),
  ADD CONSTRAINT `deny_acl_user_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `roles_inheritances`
--
ALTER TABLE `roles_inheritances`
  ADD CONSTRAINT `roles_inheritances_role_id_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_contact_id_contact_id` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`),
  ADD CONSTRAINT `user_role_id_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
