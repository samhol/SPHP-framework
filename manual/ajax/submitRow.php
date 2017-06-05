<?php

namespace Sphp\Html\Foundation\Sites;

error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('../settings.php');

use Sphp\Html\Foundation\Sites\Grids\Column;
use Sphp\Html\Foundation\Sites\Containers\Callout;
use Sphp\Html\Div;
use Sphp\Html\Forms\Buttons\Button;
use Sphp\Html\Foundation\Sites\Forms\FormRow;

$submitter = (new Button('See submission data'))
        ->addCssClass('button alert small submitter');
$panel = (new Callout($submitter))->setColor('alert')->addCssClass('form-submitter small');
//$panel->setCallout();
$panel[] = new Div('This row is automatically generated for form data viewing');
$inputCol = (new Column($panel));

$submitRow = new FormRow($panel);
$submitRow->printHtml();
