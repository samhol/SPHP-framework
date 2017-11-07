<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\FormInterface as FormInterface;
use Sphp\Manual;

$formInterface = Manual\api()->classLinker(FormInterface::class);
$gridForm = Manual\api()->classLinker(GridForm::class);
$formsNS = Manual\api()->namespaceLink(__NAMESPACE__, false);
Manual\parseDown(<<<MD
##Foundation based input components
        
Foundation based input components extend interfaces defined in $formsNS namespace.
MD
);

Manual\loadPage('Sphp.Html.Foundation.Sites.Forms.Buttons');
Manual\loadPage('Sphp.Html.Foundation.Sites.Forms.Choiceboxes');
Manual\loadPage('Sphp.Html.Foundation.Sites.Forms.Switch');
Manual\loadPage('Sphp.Html.Foundation.Sites.Forms.Slider');
Manual\loadPage('Sphp.Html.Foundation.Sites.Forms.RangeSlider');


