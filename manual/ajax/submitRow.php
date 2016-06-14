<?php

namespace Sphp\Html\Foundation\F6;

include_once "../settings.php";

use Sphp\Html\Forms\Buttons\Button as Button;

$submitter = (new Button("button", "See submission data", "submitted"))
        ->addCssClass("button alert small submitter");
$panel = (new Containers\Callout($submitter))->setColor("alert")->addCssClass("form-submitter small");
//$panel->setCallout();
$panel[] = new \Sphp\Html\Div("This row is automatically generated for form data viewing");
$inputCol = (new Core\Column($panel));

$submitRow = new Forms\FormRow($panel);
$submitRow->printHtml();
