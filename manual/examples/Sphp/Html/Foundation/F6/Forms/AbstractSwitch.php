<?php

namespace Sphp\Html\Foundation\F6\Forms;

$hours = (new SwitchBox("foobar", "yes"));

$score1 = (new RadioSwitch("foo", "bar", true));
$score2 = (new RadioSwitch("foo", "foo", false));

$form = new GridForm();
$form->append([$hours, $score1, $score2]);
echo $form;
?>
