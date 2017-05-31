<?php

namespace Sphp\Html\Media;

$path = 'manual/pics/error.png';

echo \ParsedownExtra::instance()->text(<<<TEXT

#404: <small>Manual page not found!</small>{.error}

**The page you requested does not exist**!
        
   
TEXT
);


/*$s25 = new Size(25, 25);
$s50 = new Size(50, 50);
$s100 = new Size(100, 100);
$s150 = new Size(150, 150);
Img::scaleToFit($path, $s25)->setLazy()->setAlt('25px')->printHtml();
Img::scaleToFit($path, $s50)->setLazy()->setAlt('50px')->printHtml();
Img::scaleToFit($path, $s100)->setLazy()->setAlt('100px')->printHtml();
Img::scaleToFit($path, $s150)->setLazy()->setAlt('150px')->printHtml();
Img::scaleToFit($path, $s100)->setLazy()->setAlt('100px')->printHtml();
Img::scaleToFit($path, $s50)->setLazy()->setAlt('50px')->printHtml();
Img::scaleToFit($path, $s25)->setLazy()->setAlt('25px')->printHtml();
*/
namespace Sphp\Html\Apps\Freefind;
use Sphp\Html\Adapters\QtipAdapter;
$form = new FreefindSearchForm('r', '51613081', '&#247;', '0');
$form->showLabel(true);

$form->getSearchField()->setName('query')->setPlaceholder('keywords in documentation');
echo "\n";
(new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setQtip('Execute Search')->setViewport($form);
$form->printHtml();

?>

<pre>
  <?php
  /* print_r($_SERVER);
    print_r($_FILES);
    print_r(headers_list());
    print_r(http_response_code()); */

  ?>
</pre>
