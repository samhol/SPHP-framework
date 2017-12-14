<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

$orbit = new Orbit();

$orbit->slides()->appendYoutubeVideo("CdMs7eqMvNg");
$orbit->slides()->appendDailymotionVideo("x2p4pkp");
$orbit->slides()->appendVimeoVideo("174190102");
foreach ($orbit as $slide) {
  $slide->setAspectRatio('panorama');
}
$orbit->printHtml();
?>
