<?php

namespace Sphp\Html\Apps\Forms;

use Sphp\Html\Adapters\QtipAdapter;

echo \ParsedownExtra::instance()->text(<<<TEXT

# 404 <small>PAGE NOT FOUND</small>
        
<p class="large">Keep on looking ...</p>

TEXT
);

$form = SiteSearch360Form::create('playground.samiholck.com');
$form->setLabelText('Search manual:');

$form->setPlaceholder('keywords in documentation');

(new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setQtip('Execute Search')->setViewport($form);
$form->printHtml();
echo $form->createResultComponent();

$samiForm = new SamiApiSearchForm('http://playground.samiholck.com/API/sami/');
$samiForm->setLabelText('Search PHP API:');

$samiForm->setPlaceholder('namespaces, classes, interfaces, traits, functions, or methods');

(new QtipAdapter($samiForm->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setQtip('Execute Search')->setViewport($samiForm);
$samiForm->printHtml();

\Sphp\Manual\md('Double check the URL or head back to the homepage. If you continue to get this page, email me at sami.holck@samiholck.com.');
?>


