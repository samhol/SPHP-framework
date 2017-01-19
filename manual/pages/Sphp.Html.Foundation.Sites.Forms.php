<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Document;

$formIfLink = $api->classLinker(FormInterface::class);
$gridForm = $api->classLinker(GridForm::class);

Document::html()->scripts()->appendSrc('manual/js/formTools.js');
echo $parsedown->text(<<<MD
#Foundation based forms and form components
MD
);

$load('Sphp.Html.Foundation.Sites.Forms.GridForm.php');
$load('Sphp.Html.Foundation.Sites.Forms.Inputs.php');
