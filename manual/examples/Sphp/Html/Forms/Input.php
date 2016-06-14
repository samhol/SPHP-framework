<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Input\Input as Input;
use Sphp\Html\Forms\Input\TextInput as TextInput;
use Sphp\Html\Forms\Input\PasswordInput as PasswordInput;
use Sphp\Html\Forms\Input\EmailInput as EmailInput;
use Sphp\Html\Forms\Textarea as Textarea;

$form = (new Form());

$form[] = (new Input("text", "text[]"));

$form[] = (new TextInput("text[]"))
        ->setPlaceholder("&lt;input:text&gt;")
        ->setLabel("&lt;input:text&gt;");

$form[] = (new PasswordInput("password"))
        ->setPlaceholder("&lt;input:password&gt;")
        ->setLabel("&lt;input:password&gt;");

$form[] = (new EmailInput("email"))
        ->setPlaceholder("&lt;input:email&gt;")
        ->setLabel("&lt;input:email&gt;");

$form[] = (new Textarea("textarea", "", 4))
        ->setPlaceholder("&lt;textarea&gt;")
        ->setLabel("Notes:");

$form->printHtml();
?>