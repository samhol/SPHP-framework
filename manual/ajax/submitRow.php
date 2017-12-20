<?php

namespace Sphp\Html\Foundation\Sites;

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../settings.php');

use Sphp\Html\Foundation\Sites\Containers\Callout;
use Sphp\Html\Div;
use Sphp\Html\Foundation\Sites\Buttons\Button;
use Sphp\Html\Foundation\Sites\Forms\FormRow;

$submitter = Button::pushButton('See submission data')
        ->setColor('alert')
        ->setSize('small');

$submitter->cssClasses()->add('submitter');
$panel = (new Callout($submitter))->setColor('alert')->addCssClass('form-submitter small');
$panel[] = new Div('This row is automatically generated for form data viewing');
$submitRow = new FormRow($panel);
$submitRow->printHtml();
