<?php

namespace Sphp\Db;

echo (new Conditions())
		->compare("anything", "<>", null)
		->compare("nothing", "=", null)
		->compare("one", ">", 0)
		->compare("zero", "<", 1)
		->compare("A", "=", "A")
		->compare("two", "=", 2) . "\n";
echo (new Conditions())
		->equals(["first" => 1])
		->isNull("nothing")
		->isNot("zero", "<", 1)
		->compare("A", "=", "A")
		->compare("two", "=", 2) . "\n";
echo (new Conditions())
		->isIn("value1", range("a", "d"))
		->isNotIn("value2", range(-1, 3)) . "\n";
?>