<?php

namespace Sphp\Html\Foundation;

$grid = $api->classLinker(F6\Grids\Grid::class);
$blockGrid = $api->classLinker(F6\Grids\BlockGrid::class);
$toolsLink = $api->getNamespaceLink(__NAMESPACE__, false);
\Sphp\Manual\parseDown(<<<MD
#The $toolsLink namespace

Foundation framework is included in SPHP and therefore also all of Foundation 
clientside properties are available. Here is a small collection of features available.
MD
);
?>
<div class="intro">
  <div class="row small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-on="medium" data-equalize-by-row="true" id="f-r-1">
    <div class="column">
      <div class="callout" data-equalizer-watch>
        <?php

        namespace Sphp\Html\Foundation\Sites\Grids;

        $core = $api->getNamespaceLink(__NAMESPACE__, false);
        \Sphp\Manual\parseDown(<<<MD
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
        \Sphp\Manual\parseDown(<<<MD
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

        namespace Sphp\Html\Foundation\Sites\Buttons;

        $btn_ns = $api->getNamespaceLink(__NAMESPACE__, false);
        \Sphp\Manual\parseDown(<<<MD
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

        namespace Sphp\Html\Foundation\Sites\Navigation;

        $navi_ns = $api->getNamespaceLink(__NAMESPACE__, false);
        
        \Sphp\Manual\parseDown(<<<MD
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

        namespace Sphp\Html\Foundation\Sites\Forms;

        $forms_ns = $api->getNamespaceLink(__NAMESPACE__, false);
        
        \Sphp\Manual\parseDown(<<<MD
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

        namespace Sphp\Html\Foundation\Sites\Containers;

        $cont_ns = $api->getNamespaceLink(__NAMESPACE__, false);
        
        \Sphp\Manual\parseDown(<<<MD
#####Containers:

The $cont_ns namespace includes PHP implementations of useful container elements like Accordions, Tabs and Dropdowns for HTML presentation.
MD
        );
        ?></div>
    </div>
  </div>
</div>
<?php


