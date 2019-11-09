<?php

namespace Sphp\Manual\Vendors;

use Sphp\Stdlib\Arrays;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Media\Icons\FontAwesome;

require_once __DIR__ . '/jsonParsing.php';
$required = getComposerPackages();
$zends = Arrays::findKeysLike($required, 'zendframework');
$ul = new Ul();
$ul->addCssClass('no-bullet');
$fa = new FontAwesome();
$fa->fixedWidth(true);
foreach ($zends as $component => $version) {
  $package = str_replace('zendframework/', '', $component);
  $ul->appendLink("https://github.com/$component", "{$fa->createIcon('fab fa-github')} $package");
}
?>
# SPHPlayground SYSTEM REQUIREMENTS
Framework requires minimum of PHP <?php echo getPHPVersion() ?>; it is recommended to use the latest stable PHP version whenever possible.

Download the framework package from [github](https://github.com/samhol/SPHP-framework){.ext} and Install dependencies with Composer:

## Installation

1. Download the framework package from github
2. Install PHP dependencies with Composer
3. Install npm dependencies with npm
