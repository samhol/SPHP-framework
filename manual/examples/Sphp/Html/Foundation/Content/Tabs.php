<?php

namespace Sphp\Html\Foundation\Content;
use Sphp\Html\Div as Div;

(new Tabs())->addTab("First Tab", (new Div())
				->ajaxAppend("http://sphp.samiholck.com/sphpManual/examples/loremIpsum.txt"))
		->addTab("Second Tab", "Nothing intresting here")
		->printHtml();
?>