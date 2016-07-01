<?php

namespace Sphp\Html\Foundation\F6;

use Sphp\Html\Foundation\F6\Media\Orbit\Orbit as Orbit;

$ns = $api->getNamespaceLink(__NAMESPACE__, false);
$toolsLink = $api->getNamespaceLink(__NAMESPACE__, false);
$btn = $api->classLinker(Buttons\ButtonInterface::class);
$orbitIntro = new Orbit();
$orbitIntro->addCssClass("foundation-intro");

namespace Sphp\Html\Foundation\F6\Grids;

$gridExample = \Sphp\Util\FileUtils::executePhpToString(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Grids/Row-array-constructor.php');
$grids_ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
$grid = $api->classLinker(GridInterface::class);
$row = $api->classLinker(Row::class);
$column = $api->classLinker(Column::class);
$blockGrid = $api->classLinker(BlockGrid::class);
$orbitIntro->append($parsedown->text(<<<MD
##Foundation 6 Grid components:
$grids_ns
This namespace includes for example Foundation based multi-device nestable 12-column $grid implementation in object oriented PHP and a
Foundation $blockGrid to evenly split contents of a list within the grid...
        
###$grid example:
MD
)
 . '<div class="example-area grid-example">' . $gridExample . "</div>");

namespace Sphp\Html\Foundation\F6\Navigation;

$btn_ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
$orbitIntro->append($parsedown->text(<<<MD
##Foundation 6 Buttons and Button containers
$btn_ns
This namespace includes Foundation 6 styled buttons for many purposes. Because buttons 
are a core interactive element, it's important to use the right one for each occasion.
A basic Foundation styled button can be based on almost any HTML tag that has one CSS-class.
MD
));

namespace Sphp\Html\Foundation\F6\Navigation;

$navi_ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
$orbitIntro->append($parsedown->text(<<<MD
##Foundation 6 Navigation components:
        
$navi_ns

This namespace includes many Foundation 6 navigation patterns implemented in object oriented PHP.
These navigation components can be combined to form more complex, robust responsive navigation 
solutions. For example this namespace contains a complex top bar that supports dropdown navigation, 
sidebars and many other menu structures.
MD
));

namespace Sphp\Html\Foundation\F6\Media;

$media_ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
$flexVideo = $api->getClassLink(FlexVideo::class);
//$mediaExample = new FlexVideo("7aPvNA0tPWY", FlexVideo::YOUTUBE);
$mediaExample = \Sphp\Util\FileUtils::executePhpToString(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Media/FlexVideo.php');
$manLink = new \Sphp\Html\Foundation\F6\Buttons\HyperlinkButton("?page=Sphp.Html.Foundation.F6.Media", "Manual page", "_self");
$orbitIntro->append($parsedown->text(<<<MD
##Foundation 6 Media components:

$media_ns
        
$manLink
        
This namespace contains components for handling different media types
using the tools provided by Foundation framework.

###$flexVideo example:
        
$mediaExample
MD
));

namespace Sphp\Html\Foundation\F6\Forms;

$forms_ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
$orbitIntro->append($parsedown->text(<<<MD


##Foundation 6 Form components:

$forms_ns
        
This namespace includes Foundation front-end framework based forms layouts and form components implemented in PHP.
Visual presentation of Foundation based Forms are built with the Grid. These forms 
extend basic SPHP forms.

MD
));

$orbitIntro->append($parsedown->text(<<<MD
##Foundation 6 Typography:

Framework's typography is based on a golden ratio modular scale that creates relationships between the elements.
Typography is easily updated using Scss.
MD
));

$orbitIntro->printHtml();
?>



