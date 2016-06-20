<?php

namespace Sphp\Html\Foundation\F6;

use Sphp\Html\Foundation\F6\Media\Orbit\Orbit as Orbit;

$grid = $api->classLinker(Grids\Grid::class);
$grids_ns = $grid->namespaceLink();
$blockGrid = $api->classLinker(Grids\BlockGrid::class);
$toolsLink = $api->getNamespaceLink(__NAMESPACE__, false);

$btn_ns = $api->getNamespaceLink(__NAMESPACE__, false);
$navi_ns = $api->getNamespaceLink(__NAMESPACE__, false);
$forms_ns = $api->getNamespaceLink(__NAMESPACE__, false);
$orbitIntro = new Orbit();
$orbitIntro->addCssClass("foundation-intro");
$orbitIntro->append($parsedown->text(<<<MD
#####Grid components:
The $grids_ns namespace includes for example Foundation based multi-device nestable 12-column $grid implementation and a
Foundation $blockGrid to evenly split contents of a list within the grid...
MD
));
$orbitIntro->append($parsedown->text(<<<MD
#####Grid components:
The $grids_ns namespace includes for example Foundation based multi-device nestable 12-column $grid implementation and a
Foundation $blockGrid to evenly split contents of a list within the grid...
MD
));
$orbitIntro->append($parsedown->text(<<<MD
#####Typography:

Framework's typography is based on a golden ratio modular scale that creates relationships between the elements.
Typography is easily updated using Scss.
MD
));
$orbitIntro->append($parsedown->text(<<<MD
##Buttons

Buttons in $btn_ns namespace are a core interactive element of the Web and can be used for many purposes. 
A basic Foundation styled button can be based on almost any HTML tag that has one CSS-class.
MD
));

$orbitIntro->append($parsedown->text(<<<MD
##Navigation:
$navi_ns namespace includes a complex top bar that supports dropdown navigation, 
sidebars and many other menu structures.
MD
));
$orbitIntro->append($parsedown->text(<<<MD
<div class="callout">

#####Forms:

The $forms_ns namespace includes Foundation based forms layouts and client-side form components.
Visual presentation of Foundation based Forms are built with the Grid. These forms 
extend basic SPHP forms.
</div>
MD
));

echo $parsedown->text(<<<MD
#The $toolsLink namespace

Foundation framework is included in SPHP and therefore also all of Foundation 
clientside properties are available. Here is a small collection of features available.
MD
);

$orbitIntro->printHtml();

?>



