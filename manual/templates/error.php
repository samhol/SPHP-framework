<?php

namespace Sphp\Html\Apps\Freefind;

use Sphp\Html\Adapters\QtipAdapter;

$path = 'manual/pics/error.png';

echo \ParsedownExtra::instance()->text(<<<TEXT

#404: <small>Manual page not found!</small>{.error}

**The page you requested does not exist**!

TEXT
);

$form = new FreefindSearchForm(['pid' => 'r', 'si' => '51613081', 'bcd' => '&#247;', 'n' => '0']);
$form->showLabel(true);

$form->getSearchField()->setName('query')->setPlaceholder('keywords in documentation');

(new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setQtip('Execute Search')->setViewport($form);
$form->printHtml();
?>

<img src="manual/pics/corrupt.png" alt="Resource not found" class="float-center">

