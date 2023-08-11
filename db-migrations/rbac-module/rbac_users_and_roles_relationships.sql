--
-- Database table: `rbac_users_and_roles_relationships`
--

DROP TABLE IF EXISTS `rbac_users_and_roles_relationships`;

CREATE TABLE `rbac_users_and_roles_relationships` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    `role_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE (`user_id`,`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `rbac_users_and_roles_relationships` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 3, 2),
(4, 1, 2);