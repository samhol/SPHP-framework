<?php

require_once('/home/int48291/public_html/playground/manual/settings.php');

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Media\Icons\DevIcons;
use Sphp\Html\Tags;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$data = ParseFactory::fromFile('DevIcons.json');

$section = Tags::section();
$section->addCssClass('container', 'devicons');
$section->appendH2('Devicons <small>FONT versions</small>')->addCssClass('devicons');
$grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8');

foreach ($data as $item) {
  $name = $item['name'];
  // echo "\n$name";
  foreach ($item['versions']['font'] as $version) {
    $method = $name . ucfirst($version);
    $icon = DevIcons::i("$name-$version")->setTitle("devicon-$name-$version icon")->setAttribute('title', "devicon-$name-$version icon");
    $content = Tags::div()->addCssClass('icon-container');
    $iconContainer = Tags::div()->addCssClass('icon', 'font', 'devicons');
    $content->append($iconContainer);
    $iconContainer->append($icon);
    $content->append('<div class="card card-reveal-wrapper">
  <img src="https://placehold.it/568x150">
  <div class="card-section">
    <i class="fa fa-angle-up open-button"><span class="show-for-sr">More</span></i>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga et voluptas, praesentium temporibus est? Recusandae blanditiis eaque ea quam omnis, expedita amet, et eius ipsum quod ipsa, veritatis doloribus enim.</p>
    <div class="card-reveal">
      <span class="card-reveal-title">
        <h4>Card Title</h4>
        <i class="fa fa-angle-down close-button"><span class="show-for-sr">Close</span></i>
      </span>
      <p>Here is some more information. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.</p>
    </div> <!-- /.card-reveal -->
  </div> <!-- /.card-section -->
</div> <!-- /.card -->

');
    $ext = Tags::div($name)->addCssClass('ext', 'devicons');
    $content->append($ext);
    $grid->append($content);
  }
}

$section->append($grid);
echo $section;
