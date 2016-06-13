<?php

namespace Sphp\Html\Foundation\F6\Forms;

$boxes[] = (new SwitchBox("box[]", "a"))->setInnerLabels("Yes", "No");
$boxes[] = (new SwitchBox("box[]", "b"));
$boxes[] = (new SwitchBox("box[]", "c"));
$boxes[] = (new SwitchBox("box[]", "d"));

$radios[] = (new RadioSwitch("foo", "bar", true))->setInnerLabels("Foo", "Bar");
$radios[] = (new RadioSwitch("foo", "foo", false))->setInnerLabels("Foo", "Bar");

$form = new GridForm();
$form->append([$boxes]);
$form->append([$radios]);
echo $form;
?>
