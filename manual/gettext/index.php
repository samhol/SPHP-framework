<?php

namespace Sphp;

require_once('../settings.php');
require_once('../htmlHead.php');
require_once('GettextTable.php');
require_once('GettextForm.php');
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
      $gettextTable = new GettextForm($k);
      $gettextTable->printHtml();
      use Sphp\Html\Foundation\Sites\Navigation\Pagination\Pagination;
      ?>
    </div>
  </div>
  <?php $html->documentClose(); 
    
