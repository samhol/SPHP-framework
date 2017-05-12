<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

include_once('manual/settings.php');
include_once('manual/htmlHead.php');
?>
<body class="manual">
  <div class="row expanded small-collapse medium-uncollapse">
    <pre>
      <?php

      namespace Sphp\Db\Objects;

      $locations = new LocationStorage(EntityManagerFactory::get());
      
      ?>
    </pre>
  </div>
  <?php

  use Sphp\Html\Apps\BackToTopButton;

(new BackToTopButton())
          ->setTitle('Back To Top')
          ->printHtml();
  $html->documentClose();





  
