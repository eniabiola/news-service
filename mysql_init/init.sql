-- appcakenews.doctrine_migration_versions definition

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;



-- appcakenews.news definition

CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- appcakenews.`user` definition

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO appcakenews.doctrine_migration_versions
(version, executed_at, execution_time)
VALUES('DoctrineMigrations\\Version20220929162426', '2022-11-14 20:26:35', 943);
INSERT INTO appcakenews.doctrine_migration_versions
(version, executed_at, execution_time)
VALUES('DoctrineMigrations\\Version20220929163657', '2022-11-14 20:26:36', 107);




INSERT INTO appcakenews.`user`
(id, email, roles, password)
VALUES(1, 'admin@test.com', '["ROLE_ADMIN"]', '$2y$13$FPbevjYtlb7pLgbdimJcM.t7x9GAjB4nF8I2lFhIwr0t2VT/zcVRy');
INSERT INTO appcakenews.`user`
(id, email, roles, password)
VALUES(2, 'moderator@test.com', '[]', '$2y$13$FPbevjYtlb7pLgbdimJcM.t7x9GAjB4nF8I2lFhIwr0t2VT/zcVRy');
