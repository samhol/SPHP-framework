<?php

namespace Sphp\Html\Flow;

use Sphp\Manual;

$main = Manual\api()->classLinker(Main::class);
$section = Manual\api()->classLinker(Section::class);
$aside = Manual\api()->classLinker(Aside::class);
$article = Manual\api()->classLinker(Article::class);
$w3schools = Manual\w3schools();
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\md(<<<MD
#HTML content creation
$ns

Classes in this namespace enables the creation of modern HTML documents in object oriented PHP.

 * $main implements HTML $w3schools->main tag
 * $article implements HTML $w3schools->article tag
 * $section implements HTML $w3schools->section tag
 * $aside implements HTML $w3schools->aside tag

MD
);

Manual\visualize('Sphp/Html/Content/Main.php', 'html5');
