<?php

namespace Sphp\Html\Foundation\F6\Media\Orbit;

$orbit = new Orbit();

$orbit->appendYoutubeVideo("CdMs7eqMvNg")
        ->appendDailymotionVideo("x2p4pkp")
        ->appendVimeoVideo("174190102");
foreach ($orbit as $slide) {
  $slide->setWidescreen(true);
}
$orbit->printHtml();
?>
