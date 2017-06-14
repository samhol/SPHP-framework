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
    //print_r($p->getPages());
    $pag = new Pagination('_self');
    $pag->setPages($urls);
    $pag->visibleBeforeCurrent(10)->visibleAfterCurrent(10)->setCurrentPage($currentPage);
    $pag->printHtml();
    
    
    ?>
      <?php
      include('form.php');
      ?>
    <form data-abide novalidate id="freefind">
      <div data-abide-error class="alert callout" style="display: none;">
        <p><i class="fi-alert"></i> There are some errors in your form.</p>
      </div>
      <fieldset class="fieldset"><legend>Search for:</legend>
        <div class="row collapse">
          <div class="column small-12">
            <div class="input-group">
              <label for="id_30e17745bbb15717">Singular</label>
              <input type="radio" name="type" value="1" id="id_30e17745bbb15717" required>
              <label for="id_68e99aba209032d3">Plural</label>
              <input type="radio" name="type" value="2" id="id_68e99aba209032d3" required>
              <label for="id_1b797d868dd5c90d">Both</label>
              <input type="radio" name="type" value="4" id="id_1b797d868dd5c90d" checked required>
            </div>
          </div>
        </div>
        <div class="row collapse">
          <div class="column small-8">
            <div class="input-group">
              <input class="input-group-field" type="search" placeholder="keywords" required>
            </div>
          </div>
          <div class="column small-4">
            <div class="input-group">
              <span class="input-group-label">Show</span>
              <input type="number" class="input-group-field" value="10">
              <span class="input-group-label">rows per page</span>
              <div class="input-group-button">
                <button type="submit" class="button" value="search" data-sphp-qtip-viewport="#freefind" data-sphp-qtip data-sphp-qtip-at="top center" data-sphp-qtip-my="bottom right" title="Suorita haku"><i class="fa fa-search" aria-hidden="true"></i></button>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
    </form>
  </div>
</div>
<?php
$html->documentClose();

















