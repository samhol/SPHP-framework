<?php

namespace Sphp\Stdlib;

echo "empty:\n";
var_dump(
		Strings::isEmpty(NULL),
		Strings::isEmpty(""),
		Strings::isEmpty(FALSE));
echo "matching:\n";
var_dump(
		Strings::match("0 1 2", '/^[0-9]+$/'),
		Strings::match("123abc", "/^([0-9a-zA-ZäöåÄÖÅ])*$/"));
echo "start & end:\n";
var_dump(
		Strings::startsWith("0 1", "0 1 2"),
		Strings::endsWith("bcd", "123abc"));
