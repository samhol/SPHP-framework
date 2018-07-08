<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC;

use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

/**
 * Description of PageLoader
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PageLoader {

  public function loadNotFound() {
    include 'manual/templates/error.php';
    //Document::body()->addCssClass('error');
  }

  public function loadCalendar($par) {
    //var_dump($par);
    include 'manual/pages/calendar-app.php';
  }

  public function loadPage($par, string $file = 'index') {
    //var_dump(func_get_args());
    try {
      ob_start();
      $page = "manual/pages/$file.php";
      if (is_file($page)) {
        include $page;
      } else {
        $this->loadNotFound($par);
      }
      $content = ob_get_contents();
    } catch (\Throwable $e) {
      $content = ThrowableCalloutBuilder::build($e, true, true);
    }
    ob_end_clean();
    echo $content;
  }

  public function loadIndex() {
    $this->loadPage('index');
  }

}
