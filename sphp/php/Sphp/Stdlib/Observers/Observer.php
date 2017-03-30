<?php

/**
 * Observer.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Observers;

/**
 * Defines the observer part of the Observer Design Pattern
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-01-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Observer {

  /**
   * Receives an update from a subject
   * 
   * @param Subject $subject
   */
  public function update(Subject $subject);
}
