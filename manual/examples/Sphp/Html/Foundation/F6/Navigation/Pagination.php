<?php

namespace Sphp\Html\Foundation\Navigation\Pagination;

$pages = [];
for ($i = 1; $i <= 20; $i++) {
	$pages[] = "http://sphp.samiholck.com/?page=Sphp.Html.Foundation.Navigation&amp;i=$i";
}

$pagination = (new Pagination($pages))
		//->set((new Page(1, "http://sphp.samiholck.com/?page=Sphp.Html.Foundation.Navigation"))->setCurrent())
		->printHtml();
echo (new PreviousPage())->attrExists("href");

?>