<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Observers;

/**
 * Defines the subject part of the Observer Design Pattern
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
