<?php

namespace Sphp\Html\Apps\Forms;

use Sphp\Html\Adapters\QtipAdapter;

echo \ParsedownExtra::instance()->text(<<<TEXT

# 404 <small>PAGE NOT FOUND</small>
        
<p class="large">Keep on looking ...</p>

TEXT
);

$form = new SiteSearch360FormBuilder('playground.samiholck.com');
$form->getSearchField()->setPlaceholder('keywords in documentation');
$ss360Form = $form->buildInputGroupForm('Search manual:');
(new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setQtip('Execute Search')->setViewport($ss360Form);
echo $ss360Form;
//echo $form->createResultComponent();

$samiFormBuilder = new SamiApiSearchFormBuilder('/API/sami/');

$samiFormBuilder->getSearchField()->setPlaceholder('namespaces, classes, interfaces, traits, functions, or methods');
$samiForm = $samiFormBuilder->buildInputGroupForm('Search PHP API:');
(new QtipAdapter($samiFormBuilder->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setQtip('Execute Search')->setViewport($samiForm);
echo $samiForm;

\Sphp\Manual\md('Double check the URL or head back to the homepage. If you continue to get this page, email me at sami.holck@samiholck.com.');
