<?php

/**
 * Subject.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Observers;

/**
 * Defines the subject part of the Observer Design Pattern
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-01-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Subject {

  /**
   * Attach an observer to the observable
   *
   * @param Observer|callable $obs the attached observer
   */
  public function attach($obs);

  /**
   * Detaches an observer from the observable
   *
   * @param Observer|callable $obs the detached observer
   */
  public function detach($obs);

  /**
   * Notifies all observers
   */
  public function notify();
}
