<?php

namespace Sphp;

require_once('GettextTable.php');
require_once('GettextForm.php');

use Sphp\Html\Foundation\Sites\Navigation\Pagination\Pagination;

$currentPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, ['options' => array('default' => 1, 'min_range' => 1)]);
echo $currentPage;
?>

<div class="row">
  <div class="column small-12 large-10 large-offset-1 end">

    <?php

    use Sphp\I18n\Gettext\PoFileIterator;
    use Sphp\Stdlib\Filesystem;

$pos = PoFileIterator::parseFrom(Filesystem::getFullPath('sphp/locale/fi_FI/LC_MESSAGES/Sphp.Defaults.po'));
    $filtered = $pos->filter(function(\Sphp\I18n\Gettext\GettextData $d) {
      return true;
    });
    var_dump(Filesystem::getFullPath('sphp/locale/fi_FI/LC_MESSAGES/Sphp.Defaults.po'),$pos);
    print_r($filtered);
    use Zend\Paginator\Paginator;
    use Zend\Paginator\Adapter\ArrayAdapter;

$p = new Paginator(new ArrayAdapter($filtered->toArray()));
    $p->setCurrentPageNumber($currentPage);
    $gettextTable = new GettextForm($p->getIterator());
    $gettextTable->getTableGenerator()->setFirstRowNumber($p->getPages()->firstItemNumber);
    $gettextTable->printHtml();

    // echo "<pre>";
    //print_r($k->toArray());
    foreach ($p->getIterator() as $page) {
      //var_dump($page);
      //echo "<strong>$page</strong>, ";
    }
    //$p->getPages();
    //var_dump($p->getPageRange(), $p->count(), $p->getPages());
    $urls = [];
    $c = 1;

    $pag = new Pagination();
    for ($i = 1; $i <= $p->getPages()->last; $i++) {
      $urls[$i] = "/gettext/?page=$i";
      $page = $pag->insertPage(new Html\Foundation\Sites\Navigation\Pagination\Page("/gettext/?page=$i"));
      if ($i === $currentPage) {
        $page->setCurrent(true);
      }
    }
    //print_r($p->getPages());
    $pag->printHtml();
    ?>
    <?php
    //include('form.php');
    ?>


    <?php
    echo '<pre>';
    print_r($_GET);
    echo '</pre>';
    