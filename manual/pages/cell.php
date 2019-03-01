<div class="grid-example">
  <div class="grid-x">
    <div class="cell auto small-4">One</div>
    <div class="cell auto">Two</div>
    <div class="cell shrink">Three</div>
    <div class="cell auto">Four</div>
    <div class="cell auto">Five</div>
    <div class="cell auto">Six</div>
  </div>
    <div class="grid-x">
    <div class="cell small-2 small-order-2 medium-order-1">One</div>
    <div class="cell small-2 small-order-1 medium-order-2">Two</div>
    <div class="cell auto">Four</div>
    <div class="cell auto">Five</div>
    <div class="cell auto">Six</div>
  </div>
  <div class="grid-x grid-padding-x small-up-2 medium-up-4 large-up-6">
  <div class="cell small-order-2 medium-order-1">1</div>
  <div class="cell small-order-1 medium-order-2">2</div>
  <div class="cell small-order-3">3</div>
  <div class="cell small-order-4">4</div>
  <div class="cell small-order-5">5</div>
  <div class="cell">6</div>
</div>
</div>
<?php

use Sphp\Html\Tags;
use Sphp\Html\Foundation\Sites\Grids\ContainerCell;

$div = Tags::div();
$mngr = new ContainerCell();
$mngr->small('shrink');
$mngr->medium('auto');
$mngr->large(5);
$mngr->xlarge(6);
$mngr->xxlarge(7);
$mngr->smallOffset(0);
$mngr->mediumOffset(1);
$mngr->largeOffset(5);
$mngr->xlargeOffset(6);
$mngr->xxlargeOffset(7);
print_r($div->cssClasses()->toArray());
$mngr->setLayouts('small-3', 'large-offset-2');
print_r($mngr->cssClasses()->toArray());
