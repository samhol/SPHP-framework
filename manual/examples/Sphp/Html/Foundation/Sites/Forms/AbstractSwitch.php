<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm;

$answer = new SwitchBox('like', 'yes');
$answer->setScreenReaderLabel("Do you like me?");
$answer->setInnerLabels("yes", "no");

$boxes[] = (new SwitchBox("box[]", "a", true, "select alphabet a"))
        ->setInnerLabels("a", "")
        ->setSize("tiny");
$boxes[] = (new SwitchBox("box[]", "b", false, "select alphabet b"))
        ->setInnerLabels("b", "")
        ->setSize("small");
$boxes[] = (new SwitchBox("box[]", "c", false, "select alphabet c"))
        ->setInnerLabels("c", "");
$boxes[] = (new SwitchBox("box[]", "d", false, "select alphabet d"))
        ->setInnerLabels("d", "")
        ->setSize("large");

$radios[] = (new RadioSwitch("foo", "bar", true))->setInnerLabels("bar", "bar");
$radios[] = (new RadioSwitch("foo", "foo", false))->setInnerLabels("foo", "foo");

$form = new GridForm();
$form->append($answer);
$form->append($boxes);
$form->append($radios);
echo $form;
?>
