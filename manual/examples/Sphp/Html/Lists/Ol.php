<?php

namespace Sphp\Html\Lists;

use Sphp\Html\Foundation\F6\Grids\Row as Row;

$ol1 = (new Ol())
		->append("Second")
		->prepend("First")
		->appendLink("http://www.w3schools.com/html/html_lists.asp", "w3schools Lists", "w3schools");
$dl1[] = new Li("Fourth");

$ol2 = (new Ol(["Second", "Third"]))
		->append("Fourth")
		->prepend("First")
		->appendLink("http://www.w3schools.com/html/html_lists.asp", "w3schools Lists", "w3schools");
$ol2[] = "Sixth";


(new Row([$ol1, $ol2]))->printHtml();
?>
