<?php
namespace Sphp\Html\Foundation\F6\Forms;

$gridForm = $api->getClassLink(GridForm::class);

echo $parsedown->text(<<<MD
#Foundation based  form components

##The $gridForm component

MD
);
PHPExampleViewer::visualize(EXAMPLE_DIR . 'Sphp/Html/Forms/GridForm.php');