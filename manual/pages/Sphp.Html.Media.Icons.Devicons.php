<?php

namespace Sphp\Html\Media\Icons;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$icon = \Sphp\Manual\api()->classLinker(IconTag::class);
$devIcons = \Sphp\Manual\api()->classLinker(DevIcons::class);


\Sphp\Manual\md(<<<MD

## Devicons <small>$devIcons icon factory</small> 

Devicon v2 library is a set of icons representing programming languages, 
designing and development tools. These icons are available as fonts and SVG 
images and they support assistive reading technologies.

MD
);


include './manual/snippets/icons/devicon/app.php';
