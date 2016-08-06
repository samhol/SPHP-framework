<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\TextInput as TextInput;
use Sphp\Html\Forms\Inputs\PasswordInput as PasswordInput;
use Sphp\Html\Forms\Inputs\Textarea as Textarea;

$form = (new Form());
$textInput = (new TextInput("text[]"))
        ->setPlaceholder("&lt;input:text&gt;");
$form[] = $textInput->createLabel("&lt;label&gt; for &lt;input:text&gt;");
$form[] = $textInput;

$pwInput = (new PasswordInput("password"))
        ->setPlaceholder("&lt;input:password&gt;");
$form[] = $pwInput->createLabel("&lt;label&gt; for &lt;input:password&gt;");
$form[] = $pwInput;

$textarea = (new Textarea("textarea"))
        ->setPlaceholder("&lt;textarea&gt;");
$form[] = $textarea->createLabel("&lt;label&gt; for &lt;textarea&gt;");
$form[] = $textarea;

$form->printHtml();
?>
