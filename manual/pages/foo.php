<?php

use Sphp\Config\ShutDownRegister1;

echo '<pre>';

echo '</pre>';
use Sphp\Html\Foundation\Sites\Containers\Tabs\Tabs;

$tabs = new Tabs();
$tab = new \Sphp\Html\Foundation\Sites\Containers\Tabs\Tab('Syntax hl');
$tab->appendMd(
'##The $syntaxHighligher component'
        );

$syntax1 = (new Sphp\Html\Apps\Syntaxhighlighting\GeSHiSyntaxHighlighter())
        ->loadFromFile('manual/snippets/example1.js');
$tabs->appendTab('PHP code', $syntax1);
echo $tabs;

?>
<div class="tabs-content" data-tabs-content="example-tabs">
  <div class="tabs-panel is-active" id="panel1">
    <p>Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
  </div>
  <div class="tabs-panel" id="panel2">
    <p>Suspendisse dictum feugiat nisl ut dapibus.  Vivamus hendrerit arcu sed erat molestie vehicula. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.  Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
  </div>
</div>
<ul class="tabs" data-tabs id="example-tabs">
  <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Tab 1</a></li>
  <li class="tabs-title"><a data-tabs-target="panel2" href="#panel2">Tab 2</a></li>
</ul>