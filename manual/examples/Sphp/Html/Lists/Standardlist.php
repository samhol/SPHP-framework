<?php

namespace Sphp\Html\Lists;

use Sphp\Html\Foundation\Sites\Grids\BasicRow;

$layout = new BasicRow();
$colors = ['yellow', 'blue', 'white'];
$ul = new Ul($colors);
$ulCopy = clone $ul;
$ulCopy->prepend('red')->inlineStyles()->setProperty('color', 'red');
$ulCopy->appendLink('http://www.w3schools.com/html/html_lists.asp', 'w3schools', '_blank');
$ulCopy->append("magenta")->inlineStyles()->setProperty('color', 'magenta');

$ol = new Ol($colors);
$ol->appendLink('http://www.w3schools.com/colors/color_tryit.asp?color=Black', 'w3schools', '_blank');

$olCopy = clone $ol;
$olCopy->setListType('I');
$olCopy->append('magenta')->inlineStyles()->setProperty('color', 'magenta');
$olCopy->prepend('red')->inlineStyles()->setProperty('color', 'red');


$dl = new Dl();
$dl->appendTerm("Colors:");
$dl->appendDescription('red')->inlineStyles()->setProperty('color', 'red');
foreach ($colors as $color) {
  $dl->appendDescription($color);
}
$dl->appendDescription('magenta')->inlineStyles()->setProperty('color', 'magenta');

$layout->appendCell($ul)->small(12)->large('auto');
$layout->appendCell($ulCopy)->small(12)->large('auto');
$layout->appendCell($ol)->small(12)->large('auto');
$layout->appendCell($olCopy)->small(12)->large('auto');
$layout->appendCell($dl)->small(12)->large('auto');
$layout->printHtml();
