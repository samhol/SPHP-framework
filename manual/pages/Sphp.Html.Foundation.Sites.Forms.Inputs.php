<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\FormInterface as FormInterface;
use Sphp\Html\Apps\Manual\Apis;

$formInterface = \Sphp\Manual\api()->classLinker(FormInterface::class);
$gridForm = \Sphp\Manual\api()->classLinker(GridForm::class);
$formsNS = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__, false);
\Sphp\Manual\parseDown(<<<MD
##Foundation based input components
        
Foundation based input components extend interfaces defined in $formsNS namespace.
MD
);

\Sphp\Manual\loadPage("Sphp.Html.Foundation.Sites.Forms.Buttons.php");
\Sphp\Manual\loadPage("Sphp.Html.Foundation.Sites.Forms.Choiceboxes.php");
\Sphp\Manual\loadPage("Sphp.Html.Foundation.Sites.Forms.Switch.php");
\Sphp\Manual\loadPage("Sphp.Html.Foundation.Sites.Forms.Slider.php");
\Sphp\Manual\loadPage("Sphp.Html.Foundation.Sites.Forms.RangeSlider.php");
