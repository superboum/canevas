--
-- MySQL 5.5.33a
-- Mon, 09 Dec 2013 21:01:47 +0000
--

CREATE TABLE `cdb_people` (
   `id` int(10) not null auto_increment,
   `entreprise` varchar(255),
   `name` varchar(255),
   `poste` varchar(255),
   `phone` varchar(20),
   `email` varchar(255),
   `1place` varchar(255),
   `1date` date,
   `ndate` date,
   `answer` text,
   `notes` text,
   `member` varchar(255),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `cdb_mailing` (
   `id` int(10) not null auto_increment,
   `email` varchar(255) not null,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
