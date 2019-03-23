<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\Form as FormInterface;
use Sphp\Manual;

$formInterface = Manual\api()->classLinker(FormInterface::class);
$gridForm = Manual\api()->classLinker(GridForm::class);
$formsNS = Manual\api()->namespaceLink(__NAMESPACE__, false);
Manual\md(<<<MD
##Foundation based input components
        
Foundation based input components extend interfaces defined in $formsNS namespace.
MD
);

Manual\printPage('Sphp.Html.Foundation.Sites.Forms.Buttons');
Manual\printPage('Sphp.Html.Foundation.Sites.Forms.Choiceboxes');
Manual\printPage('Sphp.Html.Foundation.Sites.Forms.Switch');
Manual\printPage('Sphp.Html.Foundation.Sites.Forms.Slider');
Manual\printPage('Sphp.Html.Foundation.Sites.Forms.RangeSlider');


