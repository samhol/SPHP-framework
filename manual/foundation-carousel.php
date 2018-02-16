<?php

namespace Sphp\Html\Apps\Slick;

$settings = [
    'dots' => true,
    'infinite' => true,
    'speed' => 1000,
    'slidesToShow' => 3,
    'slidesToScroll' => 1,
    'autoplay' => true,
    'autoplaySpeed' => 2000,
    'responsive' =>
    [
        [
            'breakpoint' => 1024,
            'settings' => [
                'slidesToShow' => 3,
                'dots' => true
            ],
            [
                'breakpoint' => 600,
                'settings' => [
                    'slidesToShow' => 2,
                    'dots' => false
                ]
            ],
            [
                'breakpoint' => 480,
                'settings' => [
                    'slidesToShow' => 2,
                    'dots' => false
                ]
            ],
        ]
    ]
];
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
$carousel->appendMd(<<<MD
##Grid components:
The $core namespace includes Foundation based multi-device nestable 12-column $grid implementation and a
Foundation $blockGrid to evenly split contents of a list within the grid...
MD
);

$carousel->appendMd(<<<MD
##Typography:

Framework's typography is based on a golden ratio modular scale that creates relationships between the elements.
Typography is easily updated using Scss.
MD
);
$carousel->appendMd(<<<MD
##Buttons

Buttons in $btn_ns namespace are interactive elements that can be used for many purposes. 
A basic Foundation styled button can be based on almost any HTML tag that has one CSS-class.
MD
);
$carousel->appendMd(<<<MD
##Navigation:
$navi_ns namespace includes a complex top bar that supports dropdown navigation, 
sidebars and many other menu structures.
MD
);
$carousel->appendMd(<<<MD
##Forms:

The $forms_ns namespace includes Foundation based forms layouts and client-side form components.
Visual presentation of Foundation based Forms are built with the Grid. These forms 
extend basic SPHP forms.
MD
);


$carousel->appendMd(<<<MD
##Containers:

The $cont_ns namespace includes PHP implementations of useful container elements 
like Accordions, Tabs and Dropdowns for HTML presentation.
MD
);
$carousel->printHtml();

