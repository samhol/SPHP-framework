<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Form;

$form = new Form();

$form["money"] = new NumberInput("number");
$form["e"] = new TextInput("text");

$form->printHtml();

?>
