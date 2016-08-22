<?php

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\FormInterface as FormInterface;
use Sphp\Html\Document as Document;

$formIfLink = $api->classLinker(FormInterface::class);
$gridForm = $api->classLinker(GridForm::class);

Document::html("manual")->scripts()->appendSrc("manual/js/formTools.js");
echo $parsedown->text(<<<MD
#Foundation based forms and form components
MD
);

$load("Sphp.Html.Foundation.F6.Forms.GridForm.php");
$load("Sphp.Html.Foundation.F6.Forms.Inputs.php");
