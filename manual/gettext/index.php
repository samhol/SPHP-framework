<?php

namespace Sphp;

require_once('../settings.php');
require_once('../htmlHead.php');
require_once('GettextTable.php');
?>
<body class="manual">
  <div class="row">
    <div class="column small-12 large-10 large-offset-1 end">
      <pre>
        <?php

        use Sphp\I18n\Gettext\PoFileIterator;

        $p = new PoFileIterator(\Sphp\LOCALE_PATH . '/fi_FI/LC_MESSAGES/Sphp.Defaults.po');
        $k = $p->filter(function(\Sphp\I18n\Gettext\GettextData $d) {
          return $d instanceof \Sphp\I18n\Gettext\PluralGettextData;
        });
        $gettextTable = new GettextTable($k);
        $gettextTable->printHtml();

        include('../_footer_.php');

        use Sphp\Html\Apps\BackToTopButton;

(new BackToTopButton())
                ->setTitle('Back To Top')
                ->printHtml();
        ?>
</div>
</div>
  <?php $html->documentClose(); ?>
    
