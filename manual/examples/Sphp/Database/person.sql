CREATE TABLE `person` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Primary key',
  `fnames` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'List of given names',
  `lname` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'Last name',
  `sex` set('f','m','unknown') COLLATE utf8_bin NOT NULL DEFAULT 'unknown' COMMENT 'Sex',
  `dob` date DEFAULT NULL COMMENT 'Date of birth',
  `address` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Home address'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Personal information';

ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fnames` (`fnames`,`lname`),
  ADD KEY `address` (`address`);

ALTER TABLE `person`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=0;

ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`address`) REFERENCES `address` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;
