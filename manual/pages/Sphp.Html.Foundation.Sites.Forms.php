<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Document;

$formIfLink = $api->classLinker(FormInterface::class);
$gridForm = $api->classLinker(GridForm::class);

Document::html()->scripts()->appendSrc('manual/js/formTools.js');
echo $parsedown->text(<<<MD
#Foundation for sites: <small>Forms and input components</small>
MD
);

$load('Sphp.Html.Foundation.Sites.Forms.GridForm.php');
$load('Sphp.Html.Foundation.Sites.Forms.Inputs.php');
