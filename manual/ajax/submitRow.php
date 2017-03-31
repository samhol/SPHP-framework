<?php

namespace Sphp\Html\Foundation\Sites;

include_once '../settings.php';

use Sphp\Html\Foundation\Sites\Grids\Column;
use Sphp\Html\Foundation\Sites\Containers\Callout;
use Sphp\Html\Div;
use Sphp\Html\Forms\Buttons\ButtonTag;
use Sphp\Html\Foundation\Sites\Forms\FormRow;

$submitter = (new ButtonTag('button', 'See submission data', 'submitted'))
        ->addCssClass('button alert small submitter');
$panel = (new Callout($submitter))->setColor('alert')->addCssClass('form-submitter small');
//$panel->setCallout();
$panel[] = new Div('This row is automatically generated for form data viewing');
$inputCol = (new Column($panel));

$submitRow = new FormRow($panel);
$submitRow->printHtml();
