<?php

namespace Sphp;

require_once('../settings.php');
require_once('../htmlHead.php');
require_once('GettextTable.php');
require_once('GettextForm.php');

use Sphp\Html\Foundation\Sites\Navigation\Pagination\Pagination;

$currentPage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, ['options' => array('default' => 1, 'min_range' => 1)]);
echo $currentPage;
?>
<body class="manual">
  <div class="row">
    <div class="column small-12 large-10 large-offset-1 end">

      <?php

      use Sphp\I18n\Gettext\PoFileIterator;
      use Sphp\Stdlib\Filesystem;

$p = new PoFileIterator(Filesystem::getFullPath('sphp/locale/fi_FI/LC_MESSAGES/Sphp.Defaults.po'));
      $k = $p->filter(function(\Sphp\I18n\Gettext\GettextData $d) {
        return true;
      });

      use Zend\Paginator\Paginator;
      use Zend\Paginator\Adapter\ArrayAdapter;

$p = new Paginator(new ArrayAdapter($k->toArray()));
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

      for ($i = 1; $i <= $p->getPages()->last; $i++) {
        $urls[$i] = $_SERVER['PHP_SELF'] . "?page=$i";
      }
      print_r($p->getPages());
      $pag = new Pagination('_self');
      $pag->setPages($urls);
      $pag->visibleBeforeCurrent(10)->visibleAfterCurrent(10)->setCurrentPage($currentPage);
      $pag->printHtml();
      ?>
      <div class="row collapse">
        <div class="column small-3">
          <div class="input-group">
            <span class="input-group-label">Search for:</span>
            <select class="input-group-field">
              <option>singular</option>
              <option>plural</option>
              <option>both</option>
            </select>
          </div>
        </div>
        <div class="column small-2">
            <select class="input-group-field">
              <option>originals</option>
              <option>translations</option>
              <option>any</option>
            </select>
          </div>
        <div class="column small-5">
          <div class="input-group">
            <input class="input-group-field" type="search" placeholder="keywords">

          </div>
        </div>
        <div class="column small-2">
          <div class="input-group">
            <select class="input-group-field">
              <option>Show 10 rows</option>
              <option>Show 10 rows</option>
              <option>Show 10 rows</option>
              <option>Show 10 rows</option>
            </select>
            <div class="input-group-button">
              <button type="submit" class="button" value="search" data-sphp-qtip-viewport="#freefind" data-sphp-qtip data-sphp-qtip-at="top center" data-sphp-qtip-my="bottom right" title="Suorita haku"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  $html->documentClose();











  
