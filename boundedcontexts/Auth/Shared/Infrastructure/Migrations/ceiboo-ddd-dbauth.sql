CREATE TABLE IF NOT EXISTS `ceiboo-ddd-dbauth`.`companies` (
  `id` char(36) NOT NULL,
  `name` varchar(120) NOT NULL,
  `address` varchar(120) NOT NULL,
  `country` varchar(60) NOT NULL,
  `status` enum('on','off') DEFAULT 'on',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `ceiboo-ddd-dbauth`.`users` (
  `id` char(36) NOT NULL,
  `company_id` char(36) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('on','off') DEFAULT 'on',
  PRIMARY KEY (`id`),
  INDEX company_id (id),
    FOREIGN KEY (company_id)
        REFERENCES companies(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
