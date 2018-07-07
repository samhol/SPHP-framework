<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Manual\MVC;

/**
 * Description of PageLoader
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PageLoader {

  function loadNotFound() {
    include 'manual/templates/error.php';
    Document::body()->addCssClass('error');
  }

  function loadCalendar($par) {
    var_dump($par);
    include 'manual/pages/calendar-app.php';
  }

  function loadPage($par, string $file = 'index') {
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

  function loadIndex() {
    $this->loadPage('index');
  }

}
