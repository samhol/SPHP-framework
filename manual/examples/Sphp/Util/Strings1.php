<?php

namespace Sphp\Util;

echo "empty:\n";
var_dump(
		Strings::isEmpty(NULL),
		Strings::isEmpty(""),
		Strings::isEmpty(FALSE));
echo "not empty:\n";
var_dump(
		Strings::notEmpty(0), 
		Strings::notEmpty(TRUE));
echo "matching:\n";
var_dump(
		Strings::match(Strings::NUMBERS_ONLY_PATTERN, "0 1 2"),
		Strings::match(Strings::ALPHANUMERIC_PATTERN, "123abc"));
echo "start & end:\n";
var_dump(
		Strings::startsWith("0 1", "0 1 2"),
		Strings::endsWith("bcd", "123abc"));
?>