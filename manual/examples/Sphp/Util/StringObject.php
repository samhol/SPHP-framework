<?php

namespace Sphp\Util;
$string = 'лдэфвәәуүйәуйүәу034928348539857әшаыдларорашһһрлоавы';
echo '$string length: ' . strlen($string);
$str1 = new StringObject($string);
echo '$str1 length: ' . $str1->count();
$str2 = new StringObject(mb_convert_encoding("üöäå", 'ISO-8859-2', "UTF-8"));
echo "\nstr1:\n";
var_dump(
		$str1->count(), 
		$str1->contains("йүәу0349"),
		$str1->lengthBetween(2, 50),
		$str1->lengthBetween(2, 50),
		$str1->contains("a"),
		$str1->charAt(1),
		$str1->charAt(6),
		$str1->notEmpty(),
		$str1->__toString());
echo "str2:\n";
var_dump(
		$str2->count(), 
		$str2->contains("ä"),
		$str2->contains("a"),
		$str2->charAt(1),
		$str2->charAt(6),
		$str2->isEmpty(),
		$str2->__toString());
?>