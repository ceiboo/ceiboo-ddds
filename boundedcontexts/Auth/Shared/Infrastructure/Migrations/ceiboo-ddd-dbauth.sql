DROP TABLE IF EXISTS `ceiboo-ddd-dbauth`.`users`;
DROP TABLE IF EXISTS `ceiboo-ddd-dbauth`.`companies`;

CREATE TABLE  `ceiboo-ddd-dbauth`.`companies` (
  `id` char(36) NOT NULL,
  `name` varchar(120) NOT NULL,
  `address` varchar(120) NOT NULL,
  `city_id` varchar(36) NULL DEFAULT NULL,
  `status` enum('on','off') DEFAULT 'on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE  `ceiboo-ddd-dbauth`.`users` (
  `id` char(36) NOT NULL,
  `company_id` char(36) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('on','off') DEFAULT 'on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX company_id (id),
    FOREIGN KEY (company_id)
        REFERENCES companies(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
