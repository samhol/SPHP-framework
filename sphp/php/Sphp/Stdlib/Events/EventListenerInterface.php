<?php

/**
 * EventListenerInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Stdlib\Events;

/**
 * Defines an event listener
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface EventListenerInterface {

  /**
   * The method called when a listened event occurs
   *
   * @param EventInterface $event
   */
  public function on(EventInterface $event);
}
