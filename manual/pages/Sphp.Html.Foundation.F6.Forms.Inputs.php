<?php

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\FormInterface as FormInterface;
use Sphp\Html\Apps\Manual\Apis as Apis;
$formInterface = $api->classLinker(FormInterface::class);
$gridForm = $api->classLinker(GridForm::class);

$formsNS = Apis::apigen()->namespaceLink(FormInterface::class, false);
echo $parsedown->text(<<<MD
##Foundation based input components
        
Foundation based input components extend interfaces defined in $formsNS namespace.
MD
);

$load("Sphp.Html.Foundation.F6.Forms.Buttons.php");
$load("Sphp.Html.Foundation.F6.Forms.Choiceboxes.php");
$load("Sphp.Html.Foundation.F6.Forms.Switch.php");
$load("Sphp.Html.Foundation.F6.Forms.Slider.php");
$load("Sphp.Html.Foundation.F6.Forms.RangeSlider.php");
