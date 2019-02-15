<?php

require_once(realpath('/home/int48291/public_html/playground/manual/settings.php'));

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Tags;
use Sphp\Html\Media\Icons\SvgLoader;

$cont = Tags::section();
$cont->addCssClass('container', 'devicons');
$cont->appendH2('DevIcons <small>SVG versions</small>')->addCssClass('devicons');
$grid = new BlockGrid('small-up-3', 'medium-up-5', 'large-up-8"');
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/home/int48291/public_html/playground/manual/svg/devicons'));

foreach ($objects as $name => $object) {
  if ($object->isFile()) {
    $name = $object->getBasename('.svg');
    $splitted = explode('-', $name);
    $content = Tags::div()->addCssClass('icon-container', 'shadow');
    $iconContainer = Tags::div()->addCssClass('icon');
    $content->append($iconContainer);
    $iconContainer->append(SvgLoader::fileToString($object->getRealPath(), $name));
    $ext = Tags::div($name)->addCssClass('ext', 'devicon');
    $content->append($ext);
    $grid->append($content);
  }
}
$cont->append($grid);
echo $cont;
