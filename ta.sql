-- Adminer 4.8.1 MySQL 8.0.36-0ubuntu0.20.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11,	'2013_05_11_000001_create_users_identifies_table',	1),
(12,	'2014_10_12_000002_create_users_table',	1),
(13,	'2014_10_12_100000_create_password_resets_table',	1),
(14,	'2019_08_19_000000_create_failed_jobs_table',	1),
(15,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(16,	'2024_05_11_115753_create_permission_tables',	1),
(17,	'2024_05_11_122443_create_pengaduan_categories_table',	1),
(18,	'2024_05_11_123959_create_pengaduan_statuses_table',	1),
(19,	'2024_05_11_124557_create_pengaduans_table',	1),
(20,	'2024_05_11_162500_create_pengaduan_counts_table',	1);

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1,	'App\\Models\\User',	1),
(2,	'App\\Models\\User',	2),
(3,	'App\\Models\\User',	3),
(3,	'App\\Models\\User',	4),
(3,	'App\\Models\\User',	5),
(3,	'App\\Models\\User',	6),
(3,	'App\\Models\\User',	7),
(3,	'App\\Models\\User',	8),
(3,	'App\\Models\\User',	9),
(3,	'App\\Models\\User',	10),
(3,	'App\\Models\\User',	13),
(4,	'App\\Models\\User',	14),
(4,	'App\\Models\\User',	15),
(4,	'App\\Models\\User',	16),
(4,	'App\\Models\\User',	17);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pengaduan_categories`;
CREATE TABLE `pengaduan_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengaduan_categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pengaduan_categories` (`id`, `image`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1,	'zOhUVTXV7Y1r0xTkBEvXMlUwTzGJWf0jhvtcLtXb.jpg',	'Sarana',	'sarana',	'2024-05-18 08:38:53',	'2024-05-18 08:38:53'),
(2,	'jMbdXrNDDJAGT1Zi1urV1DYgY39LSYtYQcfoN5Oj.jpg',	'Prasarana',	'prasarana',	'2024-05-18 08:39:09',	'2024-05-18 08:39:09'),
(3,	'rQMlZhXgnQBjJZypw5YrOKxgVktZaVWDpJpdXSMN.jpg',	'Kelas',	'kelas',	'2024-05-18 08:39:20',	'2024-05-18 08:39:20'),
(4,	'yAaLWN3uP3c9yaZoUbDy2jJxSi8FVrQfmt3sAuDg.png',	'Parkiran',	'parkiran',	'2024-05-18 08:39:39',	'2024-05-18 08:39:39'),
(5,	'u96jCmKfFNf87FPdY8P0vfhUyS2gncTUzQM0NxYH.jpg',	'Lainnya',	'lainnya',	'2024-05-18 08:39:50',	'2024-05-18 08:39:50');

DROP TABLE IF EXISTS `pengaduan_counts`;
CREATE TABLE `pengaduan_counts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pengaduan_id` bigint unsigned NOT NULL,
  `counts` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengaduan_counts_pengaduan_id_foreign` (`pengaduan_id`),
  CONSTRAINT `pengaduan_counts_pengaduan_id_foreign` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pengaduan_statuses`;
CREATE TABLE `pengaduan_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengaduan_statuses_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pengaduan_statuses` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1,	'Pending',	'pending',	'2024-05-18 08:40:04',	'2024-05-18 08:40:04'),
(2,	'Sedang diproses',	'sedang-diproses',	'2024-05-18 08:40:12',	'2024-05-18 08:40:12'),
(3,	'Terselesaikan',	'terselesaikan',	'2024-05-18 08:40:20',	'2024-05-18 08:40:20');

DROP TABLE IF EXISTS `pengaduans`;
CREATE TABLE `pengaduans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `pengaduan_category_id` bigint unsigned NOT NULL,
  `pengaduan_status_id` bigint unsigned NOT NULL DEFAULT '1',
  `users_identifies_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggapan_description` text COLLATE utf8mb4_unicode_ci,
  `tanggapan_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengaduans_slug_unique` (`slug`),
  KEY `pengaduans_user_id_foreign` (`user_id`),
  KEY `pengaduans_pengaduan_category_id_foreign` (`pengaduan_category_id`),
  KEY `pengaduans_pengaduan_status_id_foreign` (`pengaduan_status_id`),
  KEY `pengaduans_users_identifies_id_foreign` (`users_identifies_id`),
  CONSTRAINT `pengaduans_pengaduan_category_id_foreign` FOREIGN KEY (`pengaduan_category_id`) REFERENCES `pengaduan_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengaduans_pengaduan_status_id_foreign` FOREIGN KEY (`pengaduan_status_id`) REFERENCES `pengaduan_statuses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengaduans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengaduans_users_identifies_id_foreign` FOREIGN KEY (`users_identifies_id`) REFERENCES `users_identifies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pengaduans` (`id`, `user_id`, `pengaduan_category_id`, `pengaduan_status_id`, `users_identifies_id`, `title`, `description`, `location`, `image`, `slug`, `created_at`, `updated_at`, `tanggapan_description`, `tanggapan_image`) VALUES
(1,	1,	3,	3,	2,	'sempro',	'seminar proposal',	'unpam',	'O8Ap6B68DVWrxegFgUapyOTuk1yywGsmFMz460oB.png',	'sempro',	'2024-05-18 15:51:21',	'2024-05-18 15:55:40',	'beres jon!',	'tlkgWYK6KFLySo5dYRXrqBmktX1zPkmOizNdQZRr.png'),
(2,	1,	3,	3,	2,	'cak nun fasilitas',	'kurang oke',	'depan gedung vokasi',	'FZ3epbuNebbbWVOs7zIkOAmUBPEn6ZruPhtLU9bM.jpg',	'cak-nun-fasilitas',	'2024-05-18 15:52:47',	'2024-05-18 15:55:56',	'beres om!',	'XoZWll553iA2FBCkmK4GuhevVmyupvVxzsRyASSr.png'),
(3,	3,	5,	2,	NULL,	'pembelian kelas udemy',	'eror udemy',	'online',	'JlSDI5DHMjTIqzvZfo61UAlwfwERZqHRvVx1euWi.png',	'pembelian-kelas-udemy',	'2024-05-18 16:02:11',	'2024-05-18 22:02:50',	'proses',	'y17sRRcbPnnLuQpdQEqixhZptLDEPAREUUbEIHKc.png'),
(5,	3,	1,	1,	NULL,	'kedai roti ibu',	'kopi matcha',	'cisauk',	'FuFfXH9vcaD5cCMLsvPB9FXnO3DUWaVOvzGxMS9c.png',	'kedai-roti-ibu',	'2024-05-18 22:54:11',	'2024-05-18 22:54:11',	NULL,	NULL),
(6,	9,	5,	3,	2,	'bug code',	'bug in module login',	'online',	'QyjgYaoWS8ZS38p3WwfhwhYoMPEaeIbK04o10Omb.png',	'bug-code',	'2024-05-19 13:30:37',	'2024-05-19 14:08:12',	'DONE GAN!',	'IH8U9euxmSetLwF8TTJX43NxuWzN5mPKoOuyxU1D.png'),
(7,	9,	1,	1,	NULL,	'gatau apa',	'gatau apa ajadeh',	'Ruang K4',	'vGkZBwu1fXTosPsDCyBdulDhO4R2jZ0q2GdezRf5.png',	'gatau-apa',	'2024-05-19 14:16:48',	'2024-05-19 14:16:48',	NULL,	NULL),
(8,	9,	4,	1,	NULL,	'e',	'e',	'e',	'div2356AvcEgqp92H7Xjn8kUB19QNaAg5Lt709Sl.jpg',	'e',	'2024-05-19 18:39:46',	'2024-05-19 18:39:46',	NULL,	NULL),
(9,	9,	5,	1,	NULL,	'tes',	'ijgh',	'xfgh',	'82jSLPGPpR6yDFwQp8xxzKhVvjEczDux4H3WeoST.jpg',	'tes',	'2024-05-19 18:42:42',	'2024-05-19 18:42:42',	NULL,	NULL),
(10,	13,	5,	1,	NULL,	'tes again',	'15161hshs',	'hsjsiaia',	'QhC3tRpmvIXUVpUmZMygUdg37U7A58IANkVMd0c0.jpg',	'tes-again',	'2024-05-19 19:15:20',	'2024-05-19 19:15:20',	NULL,	NULL);

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'roles.index',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(2,	'roles.create',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(3,	'roles.edit',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(4,	'roles.delete',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(5,	'permissions.index',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(6,	'users.identifies.index',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(7,	'users.identifies.create',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(8,	'users.identifies.edit',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(9,	'users.identifies.delete',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(10,	'users.index',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(11,	'users.create',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(12,	'users.edit',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(13,	'users.delete',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(14,	'pengaduan.categories.index',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(15,	'pengaduan.categories.create',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(16,	'pengaduan.categories.edit',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(17,	'pengaduan.categories.delete',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(18,	'pengaduan.statuses.index',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(19,	'pengaduan.statuses.create',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(20,	'pengaduan.statuses.edit',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(21,	'pengaduan.statuses.delete',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(22,	'pengaduan.index',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(23,	'pengaduan.create',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(24,	'pengaduan.edit',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(25,	'pengaduan.delete',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(26,	'pengaduan.index.all',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(27,	'pengaduan.create.all',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(28,	'pengaduan.statuses.all',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(29,	'pengaduan.categories.all',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(30,	'pengaduan.export',	'api',	'2024-05-19 00:09:48',	'2024-05-19 00:09:48');

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1,	1),
(2,	1),
(3,	1),
(4,	1),
(5,	1),
(6,	1),
(7,	1),
(8,	1),
(9,	1),
(10,	1),
(11,	1),
(12,	1),
(13,	1),
(14,	1),
(15,	1),
(16,	1),
(17,	1),
(18,	1),
(19,	1),
(20,	1),
(21,	1),
(22,	1),
(23,	1),
(24,	1),
(25,	1),
(30,	1),
(6,	2),
(14,	2),
(18,	2),
(22,	2),
(24,	2),
(30,	2),
(14,	3),
(18,	3),
(23,	3),
(26,	3),
(27,	3),
(28,	3),
(29,	3),
(14,	4),
(18,	4),
(23,	4),
(26,	4),
(27,	4),
(28,	4),
(29,	4);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'admin',	'api',	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(2,	'operator',	'api',	'2024-05-18 08:43:55',	'2024-05-18 08:43:55'),
(3,	'mahasiswa',	'api',	'2024-05-18 15:57:53',	'2024-05-18 15:57:53'),
(4,	'dosen',	'api',	'2024-05-18 15:58:36',	'2024-05-18 15:58:36');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `users_identifies_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_induk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_users_identifies_id_foreign` (`users_identifies_id`),
  CONSTRAINT `users_users_identifies_id_foreign` FOREIGN KEY (`users_identifies_id`) REFERENCES `users_identifies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `users_identifies_id`, `name`, `no_induk`, `no_hp`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	1,	'Admin Tampan',	'123456',	'https://wa.me/62085749463854',	'admintampan@gmail.com',	NULL,	'$2y$10$cjeiQV5b8qi3r4zCEBb7b.SMCRKURO3ZIsCgBg70FLnDrAbA8V5oa',	NULL,	'2024-05-18 08:37:19',	'2024-05-18 08:37:19'),
(2,	2,	'Operator Tampan',	'1234',	'https://wa.me/62081123045701',	'operatortampan@gmail.com',	NULL,	'$2y$10$kSWgvIh/qdgiK7N3TKxUxehLIqDy0p2v96.VsvOZPyQc6NuUD7B2y',	NULL,	'2024-05-18 08:44:46',	'2024-05-18 08:44:46'),
(3,	NULL,	'kiki',	'1212',	'https://wa.me/62085749463854',	'kiki@gmail.com',	NULL,	'$2y$10$36Ig.lLrtAikC4tEzmTc0ulMCSeuglb.X2LIWFdHGXMKe4yOUNQ/.',	NULL,	'2024-05-18 16:01:16',	'2024-05-18 16:01:16'),
(4,	NULL,	'kopisusu',	'880',	'https://wa.me/621789',	'susukopi@gmail.com',	NULL,	'$2y$10$RLqjGnSIwqci4f140HNvxu1CYGEdVywEWlYsrqdWG30OXp5oR7d2e',	NULL,	'2024-05-18 23:06:07',	'2024-05-18 23:06:07'),
(5,	NULL,	'kikibae',	'9837434',	'https://wa.me/62857468098',	'ki@gmail.com',	NULL,	'$2y$10$CAg9PFAjzjWwt6gHcwbxyuhYQZiWTDVlVkubmO2gGbJ/sHcQb9a1i',	NULL,	'2024-05-19 00:43:28',	'2024-05-19 00:43:28'),
(6,	NULL,	'Aan CItra L.',	'112312132',	'https://wa.me/6212829138820',	'citranadin@gmail.com',	NULL,	'$2y$10$ILmA0RVbDm3RLG/3wLtYYukbfZJiY1wUW5FtyUrXIAAEJngtRaKay',	NULL,	'2024-05-19 01:15:50',	'2024-05-19 01:15:50'),
(7,	NULL,	'Bububb',	'121231312',	'https://wa.me/628898403',	'bububb@gmail.com',	NULL,	'$2y$10$KSF5paxE5Q1kIi6rye3FJe/TSfFUdzySV/PJOF7tlkReecC8XanBG',	NULL,	'2024-05-19 01:25:22',	'2024-05-19 01:25:22'),
(8,	NULL,	'tesbae',	'123891793789',	'https://wa.me/6221897172938173',	'tesbae@gmail.com',	NULL,	'$2y$10$G5kLL6aFhA/cSId1ua5p9ud/o8gwHv3m1MbAfNG3ovX1YSU.JDn5e',	NULL,	'2024-05-19 01:29:39',	'2024-05-19 01:29:39'),
(9,	NULL,	'tes',	'12313123',	'https://wa.me/62121313',	't@gmail.com',	NULL,	'$2y$10$VbauU6BHCP2c5w4rMlWseu04aiGnEf3T0FV.7m7cAPNiCoO3dqOsG',	NULL,	'2024-05-19 01:34:46',	'2024-05-19 01:34:46'),
(10,	NULL,	'Cicit',	'211231231',	'https://wa.me/62123892138',	'cicit@gmail.com',	NULL,	'$2y$10$YPjYO8egzv3YF5XciX6SGeBTpFdMbSPGhOnSCy3z.Z2nellbTyRB2',	NULL,	'2024-05-19 18:53:01',	'2024-05-19 18:53:01'),
(11,	NULL,	'bububc',	'272427272',	'https://wa.me/622242424525',	'fuf@gmail.com',	NULL,	'$2y$10$U9IrsaHX2rNRTMrzsufeQOe7vRDF/oREomhh0vdnL.Al3ajbkoKR6',	NULL,	'2024-05-19 19:04:23',	'2024-05-19 19:04:23'),
(12,	NULL,	'bangaziz',	'34834343',	'https://wa.me/62275757573',	'kfjf@gmail.com',	NULL,	'$2y$10$f8KUKJjCsiglliNTa6GKP.iUCG6v2Bd2EvTRXhaS7Tkxz6mPuKnvm',	NULL,	'2024-05-19 19:12:20',	'2024-05-19 19:12:20'),
(13,	NULL,	'kiw',	'616161',	'https://wa.me/62616161',	'kiw@gmail.com',	NULL,	'$2y$10$MEZYJKrcY2nzVh5Lmng6f.T/Mw7jhdrxTEZ00ZjEf73eD8oSHIwRG',	NULL,	'2024-05-19 19:14:23',	'2024-05-19 19:14:23'),
(14,	NULL,	'Dosen Tampan',	'132123123',	'https://wa.me/6213132123',	'dosentampan@gmail.com',	NULL,	'$2y$10$PxKVD4bRaKSdRSzf1rHrce6djnEjPa9N8WAV.42kHtVriolSJsH/i',	NULL,	'2024-05-22 07:14:57',	'2024-05-22 07:14:57'),
(15,	NULL,	'asdos',	'211231231',	'https://wa.me/62123892138',	'asdos@gmail.com',	NULL,	'$2y$10$TP53M1AxN6SMWuVpG.yr8OXQZkAtI7Yy9fOmTBRH6Ee8Kfuu38ofa',	NULL,	'2024-05-22 07:18:09',	'2024-05-22 07:18:09'),
(16,	NULL,	'asdos1',	'211231231',	'https://wa.me/62123892138',	'asdos1@gmail.com',	NULL,	'$2y$10$07etMc4Aex7w94yZZGK9.OF4BQBHXyAV.6aFID6cSuSYML1NLASdm',	NULL,	'2024-05-22 07:28:10',	'2024-05-22 07:28:10'),
(17,	NULL,	'cit',	'123131',	'https://wa.me/6213131231',	'tic@gmail.com',	NULL,	'$2y$10$iIVix0ttNL9OKXCH86Lq/eNv1OzSLTaK3OaldQ9p4RMaS8qD4xQ1u',	NULL,	'2024-05-22 07:32:16',	'2024-05-22 07:32:16');

DROP TABLE IF EXISTS `users_identifies`;
CREATE TABLE `users_identifies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_identifies_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users_identifies` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1,	'Operator 1',	'operator-1',	NULL,	NULL),
(2,	'Operator 2',	'operator-2',	NULL,	NULL),
(3,	'Operator 3',	'operator-3',	NULL,	NULL);

-- 2024-05-23 06:09:26
