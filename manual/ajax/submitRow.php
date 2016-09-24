<?php

namespace Sphp\Html\Foundation\F6;

include_once "../settings.php";

use Sphp\Html\Foundation\F6\Grids\Column as Column;
use Sphp\Html\Foundation\F6\Containers\Callout as Callout;
use Sphp\Html\Div;
use Sphp\Html\Forms\Buttons\ButtonTag as Button;
use Sphp\Html\Foundation\F6\Forms\FormRow as FormRow;

$submitter = (new Button("button", "See submission data", "submitted"))
        ->addCssClass("button alert small submitter");
$panel = (new Callout($submitter))->setColor("alert")->addCssClass("form-submitter small");
//$panel->setCallout();
$panel[] = new Div("This row is automatically generated for form data viewing");
$inputCol = (new Column($panel));

$submitRow = new FormRow($panel);
$submitRow->printHtml();
