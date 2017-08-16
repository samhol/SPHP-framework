CREATE TABLE `address` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Primary key',
  `street` varchar(256) COLLATE utf8_bin NOT NULL COMMENT 'Street address',
  `zipcode` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT 'Zipcode',
  `city` varchar(256) COLLATE utf8_bin NOT NULL COMMENT 'City or district',
  `country` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Country name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Geographical addresses';

CREATE TABLE `person` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Primary key',
  `fnames` varchar(256) COLLATE utf8_bin NOT NULL COMMENT 'List of given names',
  `lname` varchar(256) COLLATE utf8_bin NOT NULL COMMENT 'Last name',
  `sex` set('f','m','unknown') COLLATE utf8_bin NOT NULL DEFAULT 'unknown' COMMENT 'Sex',
  `age` tinyint(3) UNSIGNED DEFAULT NULL COMMENT 'Person''s age',
  `address` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Home address'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Personal information';


ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `address` (`address`);


ALTER TABLE `address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key';
ALTER TABLE `person`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key';

ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`address`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
