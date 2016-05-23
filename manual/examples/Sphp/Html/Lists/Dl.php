<?php

namespace Sphp\Html\Lists;

use Sphp\Html\Foundation\F6\Core\Row as Row;

$dl1 = (new Dl("About lists:"))
		->setWrapperType(Dd::class)
		->appendLink("http://www.w3schools.com/html/html_lists.asp", "w3schools", "_blank")
		->appendLink("http://www.w3.org/TR/html-markup/dl.html", "w3.org", "_blank");

$dl2 = (new Dl(["one", "two", "three", "four"], Dd::class))
		->prepend("zero")
		->setWrapperType(Dt::class)
		->prepend("NUMBERS:")
		->setWrapperType(Dd::class);
$dl2[] = "five";
$dl2[] = "six";

$dl3 = (new Dl("Alphabets:"))
		->appendDescriptions(range("A", "E"));

(new Row([$dl1, $dl2, $dl3]))->printHtml();
?>
