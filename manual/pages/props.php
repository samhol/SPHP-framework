<?php

namespace Sphp\Html\Apps\Forms;

$ss360FormBuilder = new SiteSearch360FormBuilder('playground.samiholck.com');
$ss360FormBuilder->getSearchField()->setPlaceholder('Search manual');
echo $ss360FormBuilder->buildInputGroupForm();
echo $ss360FormBuilder->buildInputGroupForm('SiteSearch360');
echo $ss360FormBuilder->buildMenuForm();
?>
<h1>foo</h1>
<?php
$samiFormBuilder = new SamiApiSearchFormBuilder('/API/sami/');
$samiFormBuilder->getSearchField()->setPlaceholder('Search Sami API');
echo $samiFormBuilder->buildInputGroupForm();
echo $samiFormBuilder->buildInputGroupForm('Sami PHP API');
echo $samiFormBuilder->buildMenuForm();
?>
