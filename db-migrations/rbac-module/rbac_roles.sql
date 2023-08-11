--
-- Database table: `rbac_roles`
--

DROP TABLE IF EXISTS `rbac_roles`;

CREATE TABLE `rbac_roles` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(128) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `rbac_roles` (`id`, `name`) VALUES
(1, 'guest'),
(2, 'user'),
(3, 'admin');
