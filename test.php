<?php

namespace Sphp\Stdlib;

include_once('manual/settings.php');

?>
<body class="manual">
  <div class="row expanded small-collapse medium-uncollapse">
    <pre>
      <?php
      echo 'foo';
      print_r($_SERVER);
      echo URL::getCurrentURL()."\n";
      echo URL::getCurrent()."\n";
      print_r(URL::getCurrent()->toArray());
      ?>
    </pre>
  </div>
  <?php






  
