<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

$orbit = new Orbit();

$orbit->appendYoutubeVideo("CdMs7eqMvNg")
        ->appendDailymotionVideo("x2p4pkp")
        ->appendVimeoVideo("174190102");
foreach ($orbit as $slide) {
  $slide->setAspectRatio('panorama');
}
$orbit->printHtml();
?>
