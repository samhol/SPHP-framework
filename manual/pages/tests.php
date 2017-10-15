<?php

namespace Sphp\Html\Attributes;


$div1 = new \Sphp\Html\Div();
$div1->ajaxAppend('manual/snippets/sleep.php');
$div1->printHtml();
$div2 = new \Sphp\Html\Div();
$div2->ajaxPrepend('manual/snippets/sleep.php');
$div2->printHtml();
?>
