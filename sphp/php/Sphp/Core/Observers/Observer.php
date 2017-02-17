<?php

/**
 * Observer.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Observers;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-01-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Observer {

  //put your code here
  public function update(Subject $subject);
}
