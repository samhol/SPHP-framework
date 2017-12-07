CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  `street` varchar(256) COLLATE utf8_bin NOT NULL,
  `zipcode` varchar(30) COLLATE utf8_bin NOT NULL,
  `city` varchar(60) COLLATE utf8_bin NOT NULL,
  `country` varchar(60) COLLATE utf8_bin NOT NULL,
  `maplink` varchar(256) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=498;COMMIT;
