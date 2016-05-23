<?php

namespace Sphp\Html\Foundation\F6\Forms;

include_once "../settings.php";

use Sphp\Html\Forms\Buttons\Button as Button;

$submitter = (new Button("button", "Submit", "submitted"))
        ->addCssClass("button secondary small submitter");
$panel = new \Sphp\Html\Foundation\F6\Containers\Callout($submitter);
//$panel->setCallout();
$inputCol = (new \Sphp\Html\Foundation\F6\Core\Column($panel));

$submitRow = new FormRow($panel);
$submitRow->printHtml();
