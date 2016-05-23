<?php

namespace Sphp\Html\Foundation;

use Sphp\Html\Tools\PHPExampleViewer as CodeExampleViewer;

$grid = $api->classLinker(F6\Core\Grid::class);
$blockGrid = $api->classLinker(F6\Core\BlockGrid::class);
$toolsLink = $api->getNamespaceLink(__NAMESPACE__, false);
echo $parsedown->text(<<<MD
#The $toolsLink namespace

Foundation framework is included in SPHP and therefore also all of Foundation clientside properties are available. Here is a small collection of features available.
MD
);
?>
<div class="intro">
  <div class="row small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-on="medium" data-equalize-by-row="true" id="f-r-1">
    <div class="column">
      <div class="callout" data-equalizer-watch>
        <?php

        namespace Sphp\Html\Foundation\F6\Core;

        $core = $api->getNamespaceLink(__NAMESPACE__, false);
        echo $parsedown->text(<<<MD
#####Core components:
The $core namespace includes for example Foundation based multi-device nestable 12-column $grid implementation and a
Foundation $blockGrid to evenly split contents of a list within the grid...
MD
        );
        ?>
      </div>
    </div>
    <div class="column">
      <div class="callout" data-equalizer-watch>
        <?php
        echo $parsedown->text(<<<MD
#####Typography:

Framework's typography is based on a golden ratio modular scale that creates relationships between the elements.
Typography is easily updated using Scss.
MD
        );
        ?>
      </div>
    </div>
    <div class="column">
      <div class="callout" data-equalizer-watch>
        <?php

        namespace Sphp\Html\Foundation\F6\Buttons;

        $btn_ns = $api->getNamespaceLink(__NAMESPACE__, false);
        echo $parsedown->text(<<<MD
#####Buttons

Buttons in $btn_ns namespace are a core interactive element of the Web and can be used for many purposes. 
A basic Foundation styled button can be based on almost any HTML tag that has one CSS-class.
MD
        );
        ?>
      </div>
    </div>
    <div class="column">
      <div class="callout" data-equalizer-watch>
        <?php

        namespace Sphp\Html\Foundation\F6\Navigation;

        $navi_ns = $api->getNamespaceLink(__NAMESPACE__, false);
        
        echo $parsedown->text(<<<MD
#####Navigation:
$navi_ns namespace includes a complex top bar that supports dropdown navigation, 
sidebars and many other menu structures.
MD
        );
        ?>
      </div>
    </div>
    <div class="column">
      <div class="callout" data-equalizer-watch>
        <?php

        namespace Sphp\Html\Foundation\F6\Forms;

        $forms_ns = $api->getNamespaceLink(__NAMESPACE__, false);
        
        echo $parsedown->text(<<<MD
#####Forms:

The $forms_ns namespace includes Foundation based forms layouts and client-side form components.
Visual presentation of Foundation based Forms are built with the Grid. These forms 
extend basic SPHP forms.
MD
        );
        ?>
      </div>
    </div>
    <div class="column">
      <div class="callout" data-equalizer-watch>
        <?php

        namespace Sphp\Html\Foundation\F6\Containers;

        $cont_ns = $api->getNamespaceLink(__NAMESPACE__, false);
        
        echo $parsedown->text(<<<MD
#####Containers:

The $cont_ns namespace includes PHP implementations of useful container elements like Accordions, Tabs and Dropdowns for HTML presentation.
MD
        );
        ?></div>
    </div>
  </div>
</div>
<?php


