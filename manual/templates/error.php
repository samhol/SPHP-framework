<?php

namespace Sphp\Html\Apps\Forms;

use Sphp\Html\Adapters\QtipAdapter;

echo \ParsedownExtra::instance()->text(<<<TEXT

#<small>SORRY</small> 404 ERROR <small>The page cannot be found</small>{.error}

We cannot find the page you are looking for.

It might have been removed, had its name changed, or is temporarily unavailable.

Please check that the Web site address is spelled correctly.

Or go to our home page, and use the menus to navigate to a specific section.

TEXT
);

$form = new FreefindSearchForm(['pid' => 'r', 'si' => '51613081', 'bcd' => '&#247;', 'n' => '0']);
$form->setLabelText('Search from manual:');

$form->setPlaceholder('keywords in documentation');

(new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setQtip('Execute Search')->setViewport($form);
$form->printHtml();

echo \ParsedownExtra::instance()->text(<<<TEXT
This page allows you to search through the API documentation for specific terms. Enter your search words into the box below and click "submit". The search will be performed on namespaces, classes, interfaces, traits, functions, and methods.
TEXT
);
$samiForm = new SamiApiSearchForm('http://playground.samiholck.com/API/sami/');
$samiForm->setLabelText('Search from PHP API:');

$samiForm->setPlaceholder('namespaces, classes, interfaces, traits, functions, or methods');

(new QtipAdapter($samiForm->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setQtip('Execute Search')->setViewport($samiForm);
$samiForm->printHtml();
?>

<img src="manual/pics/corrupt.png" alt="Resource not found" class="float-center">

