--
-- Database table: `user_users`
--

DROP TABLE IF EXISTS `user_users`;

CREATE TABLE `user_users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(128) NOT NULL,
    `alias` varchar(128) NOT NULL,
    `password` varchar(255) NOT NULL,
    `status` bit NOT NULL,
    `created_on` datetime NOT NULL,
    `updated_on` datetime DEFAULT NULL,
    `pwd_reset_token` varchar(32) DEFAULT NULL,
    `pwd_reset_token_created_on` datetime DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`),
    UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `user_users` (`id`, `email`, `alias`, `password`, `status`, `created_on`, `updated_on`, `pwd_reset_token`, `pwd_reset_token_created_on`) VALUES
(1, 'admin@nik-test.de', 'Admin', '$2y$10$fZHNOU.ExLjtKW2xUTOk.uLv8U7WeIiGrfQ28XVmFkyRmfJJ5NRpS', b'1', '2017-06-25 07:34:31', '2019-05-24 10:54:04', NULL, NULL),
(2, 'moderator@nik-test.de', 'Moderator', '$2y$10$UtNh0feAbIdeC6zpWZFQneqZs3X25YUl5rLgL3UxCVRMbhszmFX6O', b'1', '2017-06-25 07:43:11', NULL, NULL, NULL),
(3, 'editor@nik-test.de', 'Editor', '$2y$10$UtNh0feAbIdeC6zpWZFQneqZs3X25YUl5rLgL3UxCVRMbhszmFX6O', b'1', '2017-06-25 07:43:11', '2019-04-15 10:44:59', NULL, NULL);
