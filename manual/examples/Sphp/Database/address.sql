CREATE TABLE `address` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Primary key',
  `street` varchar(256) COLLATE utf8_bin NOT NULL COMMENT 'Street address',
  `zipcode` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT 'Zipcode',
  `city` varchar(256) COLLATE utf8_bin NOT NULL COMMENT 'City or district',
  `country` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Country name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Geographical addresses';

ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=0;
