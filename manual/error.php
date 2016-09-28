<?php

namespace Sphp\Html\Media;

$root = \Sphp\HTTP_ROOT;
echo (new \ParsedownExtra())->text(<<<TEXT

<h1 class="error">Manual page not found!</h1>

**The page you requested does not exist**!
TEXT
);
$s25 = new Size(25, 25);
$s50 = new Size(50, 50);
$s100 = new Size(100, 100);
$s150 = new Size(150, 150);
Img::scaleToFit($root . "manual/pics/error.png", $s25)->setLazy()->setAlt("25+9px")->printHtml();
Img::scaleToFit($root . "manual/pics/error.png", $s50)->setLazy()->setAlt("50px")->printHtml();
Img::scaleToFit($root . "manual/pics/error.png", $s100)->setLazy()->setAlt("150px")->printHtml();
Img::scaleToFit($root . "manual/pics/error.png", $s150)->setLazy()->setAlt("150px")->printHtml();
Img::scaleToFit($root . "manual/pics/error.png", $s100)->setLazy()->setAlt("200px")->printHtml();
Img::scaleToFit($root . "manual/pics/error.png", $s50)->setLazy()->setAlt("250px")->printHtml();
Img::scaleToFit($root . "manual/pics/error.png", $s25)->setLazy()->setAlt("25+9px")->printHtml();
?>
<pre>
	<?php
	/*print_r($_SERVER);
	print_r($_FILES);
	print_r(headers_list());
	print_r(http_response_code());*/
	?>
</pre>

