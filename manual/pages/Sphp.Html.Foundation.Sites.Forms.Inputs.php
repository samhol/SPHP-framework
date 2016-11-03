<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\FormInterface as FormInterface;
use Sphp\Html\Apps\Manual\Apis;
$formInterface = $api->classLinker(FormInterface::class);
$gridForm = $api->classLinker(GridForm::class);

$formsNS = Apis::apigen()->namespaceLink(__NAMESPACE__, false);
echo $parsedown->text(<<<MD
##Foundation based input components
        
Foundation based input components extend interfaces defined in $formsNS namespace.
MD
);

$load("Sphp.Html.Foundation.Sites.Forms.Buttons.php");
$load("Sphp.Html.Foundation.Sites.Forms.Choiceboxes.php");
$load("Sphp.Html.Foundation.Sites.Forms.Switch.php");
$load("Sphp.Html.Foundation.Sites.Forms.Slider.php");
$load("Sphp.Html.Foundation.Sites.Forms.RangeSlider.php");
