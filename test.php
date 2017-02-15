<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Core\Path;
use Sphp\Core\Util\FileUtils;

include_once('manual/settings.php');
include_once('manual/htmlHead.php');
?>
<body class="manual">
  <div class="row expanded small-collapse medium-uncollapse">
    <pre>
      <?php
      $data = FileUtils::parseYaml(Path::get()->local('manual/yaml/documentation_links.yaml'));

      function array_filter_recursive(array $array, callable $callback = null, $flag = 0) {
        $array = is_callable($callback) ? array_filter($array, $callback, $flag) : array_filter($array);
        foreach ($array as &$value) {
          if (is_array($value)) {
            $value = call_user_func(__FUNCTION__, $value, $callback, $flag);
          }
        }

        return $array;
      }

      var_dump(array_filter_recursive($data, function($v, $k) {
                return $v == 'page';
              }, \ARRAY_FILTER_USE_BOTH));
      $titleGenerator = new \Sphp\Manual\MVC\TitleGenerator($data);
      echo $titleGenerator->createTitleFor('Sphp.Data');
      ?>
    </pre>
  </div>
  <?php

  use Sphp\Html\Apps\BackToTopButton;

(new BackToTopButton())
          ->setTitle('Back To Top')
          ->printHtml();
  $html->documentClose();





  