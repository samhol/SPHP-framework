<?php

namespace Sphp\Html\Apps\Slick;

$settings = [
    'adaptiveHeight' => true,
    'dots' => true,
    'infinite' => true,
    'speed' => 3000,
    'slidesToShow' => 3,
    'slidesToScroll' => 1,
    'autoplay' => true,
    'autoplaySpeed' => 2000,
    'responsive' =>
    [
        [
            'breakpoint' => 1200,
            'settings' => [
                'slidesToShow' => 3,
                'dots' => true
            ]
        ],
        [
            'breakpoint' => 1024,
            'settings' => [
                'slidesToShow' => 2,
                'dots' => true
            ]
        ],
        [
            'breakpoint' => 640,
            'settings' => [
                'slidesToShow' => 1,
                'dots' => false
            ]
        ],
    ]
];
//echo "<pre>";
//print_r($settings);
//echo "</pre>";
$carousel = new Carousel();
$carousel->setProperty($settings);
$carousel->addCssClass('manual-info-text');

namespace Sphp\Html\Foundation;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$toolsLink = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);

namespace Sphp\Html\Foundation\Sites\Grids;

$grid = \Sphp\Manual\api()->classLinker(Grid::class);
$blockGrid = \Sphp\Manual\api()->classLinker(BlockGrid::class);
$core = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);

namespace Sphp\Html\Foundation\Sites\Buttons;

$btn_ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);

namespace Sphp\Html\Foundation\Sites\Navigation;

$navi_ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);

namespace Sphp\Html\Foundation\Sites\Forms;

$forms_ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);

namespace Sphp\Html\Foundation\Sites\Containers;

$cont_ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);

namespace Sphp\Html\Foundation\Sites\Media;

$media_ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);
$carousel->appendMd(<<<MD
<article class="wrapper" markdown="1">
##Grids:

<div class="button-group small">
  <a class="foundation button" href="https://foundation.zurb.com/sites/docs/xy-grid.html">Foundation</a>
  <a class="sphp button" href="Sphp.Html.Foundation.Sites.Grids.XY">Manual</a>
  <a class="sphp-api button" href="API/sami/Sphp/Html/Foundation/Sites/Forms.html">API</a>
</div>

The $core namespace includes Foundation based multi-device nestable 12-column $grid implementation and a
Foundation $blockGrid to evenly split contents of a list within the grid...

</article>
MD
);

$carousel->appendMd(<<<MD
<article class="wrapper" markdown="1">
##Typography:

Framework's typography is based on a golden ratio modular scale that creates relationships between the elements.
Typography is easily updated using Scss.
</article>
MD
);
$carousel->appendMd(<<<MD
<article class="wrapper" markdown="1">
##Buttons:
<div class="button-group small">
  <a class="sphp button" href="Sphp.Html.Foundation.Sites.Buttons">Manual</a>
  <a class="sphp-api button" href="API/sami/Sphp/Html/Foundation/Sites/Forms.html">PHP API</a>
</div>
Buttons in $btn_ns namespace are interactive elements that can be used for many purposes. 
A basic Foundation styled button can be based on almost any HTML tag that has one CSS-class.

</article>
MD
);

use Sphp\Html\Foundation\Sites\Media\ResponsiveEmbedInterface;

$responsiveEmbed = \Sphp\Manual\api()->classLinker(ResponsiveEmbedInterface::class);
$carousel->appendMd(<<<MD
<article class="wrapper" markdown="1">
##Media:
<div class="button-group small">
  <a class="sphp button" href="Sphp.Html.Foundation.Sites.Buttons">Manual</a>
  <a class="sphp-api button" href="API/sami/Sphp/Html/Foundation/Sites/Forms.html">PHP API</a>
</div>
Foundation based UI components for multimedia are located in $media_ns namespace. 
        
As an example $responsiveEmbed is a container for embedded content like videos, maps, 
and calendars that allows to maintain the correct aspect ratio regardless of screen size.

</article>
MD
);
$carousel->appendMd(<<<MD
<article class="wrapper" markdown="1">
##Navigation:
<div class="button-group small">
  <a class="alert button" href="Sphp.Html.Foundation.Sites.Forms">Manual</a>
  <a class="sphp-api button" href="API/sami/Sphp/Html/Foundation/Sites/Forms.html">PHP API</a>
</div>
$navi_ns namespace contains many Foundation navigation components implemented in object oriented PHP.
These  components can be combined to form more complex, robust responsive navigation 
solutions. For example this namespace contains a complex top bar that supports dropdown navigation, 
sidebars and many other menu structures.

</article>
MD
);
$carousel->appendMd(<<<MD
<article class="wrapper" markdown="1">
##Forms:
<div class="button-group small">
  <a class="alert button" href="Sphp.Html.Foundation.Sites.Forms">Manual</a>
  <a class="sphp-api button" href="API/sami/Sphp/Html/Foundation/Sites/Forms.html">PHP API</a>
</div>
PHP Implementations of Foundation based Forms and Form components are in The $forms_ns namespace.
This namespace includes layouts and controllers for responsive HTML form design.
Visual presentation of these forms is built using Foundation Grid.

</article>
MD
);


$carousel->appendMd(<<<MD
<article class="wrapper" markdown="1">
##Containers:
        
<div class="button-group small rounded">
  <a class="sphp button" href="Sphp.Html.Foundation.Sites.Containers">Manual</a>
  <a class="sphp-api button" href="API/sami/Sphp/Html/Foundation/Sites/Containers.html">PHP API</a>
</div>

The $cont_ns namespace includes PHP implementations of useful container elements 
like Accordions, Tabs and Dropdowns for HTML UI presentation.

</article>
MD
);
$carousel->printHtml();
