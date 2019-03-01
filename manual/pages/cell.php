<div class="grid-example">
  <div class="grid-x">
    <div class="cell small-1">One</div>
    <div class="cell small-1">Two</div>
    <div class="cell small-1">Three</div>
    <div class="cell small-1 small-offset-3">Four</div>
    <div class="cell small-1">Five</div>
    <div class="cell small-1">Six</div>
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
echo '<pre>';

$settings = Sphp\Html\Foundation\Sites\Core\FoundationSettings::default();
var_dump($settings->isValidCellSize(13));

var_dump($settings->getScreenSizes());


var_dump(implode('|',$settings->getScreenSizes()));
echo '</pre>';