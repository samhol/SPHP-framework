<?php

echo '<div class="icon-example-popup grid-x small-up-3 medium-up-5 large-up-8">';

$foo = \Sphp\Html\Tags::div();
$foo->inlineStyles()->setProperty('max-width', '40px')->setProperty('margin', '10px');
$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/home/int48291/public_html/data.samiholck.com/svg/flags'));
foreach ($objects as $name => $object) {
  if ($object->isFile()) {
    echo '<div class="cell"><div class="icon-container"><div class="icon national-flag">';
    echo Sphp\Html\Media\Icons\SvgLoader::fromFile($object->getRealPath());
    echo "</div><div class=\"ext\">flag</div>";
    echo '</div></div>';
  }
}
//$foo->ajaxAppend('http://playground.samiholck.com/manual/snippets/country_flags.php');
//echo $foo;
echo '</div>';
