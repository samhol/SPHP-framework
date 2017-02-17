<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

include_once('manual/settings.php');
include_once('manual/htmlHead.php');
?>
<body class="manual">
  <div class="row expanded small-collapse medium-uncollapse">
    <pre>
      <?php

      namespace Sphp\Core\Config\ErrorHandling;

$handler = new ExceptionHandler();

      $handler->attach(new ExceptionLogger(__DIR__ . '/logs/exception_log.log'));
      $handler->attach((new ExceptionPrinter())->showTrace());
      ?>
    </pre>
  </div>
  <?php

  use Sphp\Html\Apps\BackToTopButton;

(new BackToTopButton())
          ->setTitle('Back To Top')
          ->printHtml();
  $html->documentClose();





  