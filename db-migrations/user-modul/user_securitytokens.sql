--
-- Database table: `user_securitytokens`
--

DROP TABLE IF EXISTS `user_securitytokens`;

CREATE TABLE `user_securitytokens` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `identity` int(11) NOT NULL,
    `identifier` varchar(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `created_on` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `identity` (`identity`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

